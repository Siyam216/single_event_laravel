<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\User;
use App\Models\Admin;
use App\Models\HomeBanner;
use App\Models\HomeWelcome;
use App\Models\HomeCounter;
use App\Models\HomeSpeaker;
use App\Models\HomePricing;
use App\Models\HomeBlog;
use App\Models\HomeSponsor;
use App\Models\ContactPageItem;
use App\Models\Speaker;
use App\Models\ScheduleDay;
use App\Models\SponsorCategory;
use App\Models\Sponsor;
use App\Models\Organiser;
use App\Models\Accommodation;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Package;
use App\Models\Ticket;
use App\Models\PackageFacility;
use App\Models\Message;
use App\Models\TermPageItem;
use App\Models\PrivacyPageItem;
use App\Models\Subscriber;
use App\Models\Setting;
use Hash;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{
    public function home()
    {
        $home_banner = HomeBanner::where('id',1)->first();
        $home_welcome = HomeWelcome::where('id',1)->first();
        $home_counter = HomeCounter::where('id',1)->first();
        $home_speaker = HomeSpeaker::where('id',1)->first();
        $home_pricing = HomePricing::where('id',1)->first();
        $home_blog = HomeBlog::where('id',1)->first();
        $home_sponsor = HomeSponsor::where('id',1)->first();
        $speakers = Speaker::get()->take($home_speaker->how_many);
        $packages = Package::get()->take($home_pricing->how_many);
        $posts = Post::get()->take($home_blog->how_many);
        $sponsors = Sponsor::get()->take($home_sponsor->how_many);
        return view('front.home', compact('home_banner','home_welcome','home_counter', 'home_speaker','home_pricing','home_blog','home_sponsor','speakers', 'packages', 'posts', 'sponsors'));
    }

    public function speakers()
    {
        $speakers = Speaker::get();
        return view('front.speakers', compact('speakers'));
    }

    public function speaker($slug)
    {
        $speaker = Speaker::where('slug',$slug)->first();
        if(!$speaker) {
            return redirect()->route('speakers');
        }
        $schedules = $speaker->schedules()->with('schedule_day')->get();
        return view('front.speaker', compact('speaker', 'schedules'));
    }

    public function organisers()
    {
        $organisers = Organiser::get();
        return view('front.organisers', compact('organisers'));
    }

    public function organiser($slug)
    {
        $organiser = Organiser::where('slug',$slug)->first();
        if(!$organiser) {
            return redirect()->route('organisers');
        }
        return view('front.organiser', compact('organiser'));
    }

    public function accommodations()
    {
        $accommodations = Accommodation::get();
        return view('front.accommodations', compact('accommodations'));
    }

    public function schedule()
    {
        $schedule_days = ScheduleDay::with(['schedules' => function($query) {
            $query->with('speakers');
        }])
        ->orderBy('order1','asc')->get();
        return view('front.schedule', compact('schedule_days'));
    }

    public function contact()
    {
        $contact_page_data = ContactPageItem::where('id',1)->first();
        return view('front.contact', compact('contact_page_data'));
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $admin = Admin::where('id',1)->first();
       
        $subject = "Contact Message";
        $message = "Visitor Information:<br><br>";
        $message .= "<b>Name:</b><br>".$request->name."<br><br>";
        $message .= "<b>Email:</b><br>".$request->email."<br><br>";
        $message .= "<b>Message:</b><br>".$request->message."<br><br>";

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Message is sent successfully!');
    }

    public function term()
    {
        $term_page_data = TermPageItem::where('id',1)->first();
        return view('front.term', compact('term_page_data'));
    }

    public function privacy()
    {
        $privacy_page_data = PrivacyPageItem::where('id',1)->first();
        return view('front.privacy', compact('privacy_page_data'));
    }

    public function sponsors()
    {
        $sponsor_categories = SponsorCategory::with('sponsors')->get();
        return view('front.sponsors', compact('sponsor_categories'));
    }

    public function sponsor($slug)
    {
        $sponsor = Sponsor::where('slug',$slug)->first();
        if(!$sponsor) {
            return redirect()->route('sponsors');
        }
        return view('front.sponsor', compact('sponsor'));
    }

    public function photo_gallery()
    {
        $photos = Photo::paginate(15);
        return view('front.photo_gallery', compact('photos'));
    }

    public function video_gallery()
    {
        $videos = Video::paginate(15);
        return view('front.video_gallery', compact('videos'));
    }

    public function faq()
    {
        $faqs = Faq::paginate(15);
        return view('front.faq', compact('faqs'));
    }

    public function testimonial()
    {
        $testimonials = Testimonial::get();
        return view('front.testimonial', compact('testimonials'));
    }

    public function blog()
    {
        $posts = Post::get();
        return view('front.blog', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug',$slug)->first();
        if(!$post) {
            return redirect()->route('blog');
        }
        return view('front.post', compact('post'));
    }

    public function pricing()
    {
        $packages = Package::with(['facilities' => function($query) {
            $query->orderBy('item_order','asc');
        }])
        ->orderBy('item_order','asc')->get();
        return view('front.pricing', compact('packages'));
    }

    public function buy_ticket($id)
    {
        $setting_data = Setting::where('id',1)->first();
        if($setting_data->ticket_purchase_expire_date < date('Y-m-d')) {
            return redirect()->route('home')->with('error','Ticket purchase date is expired!');
        }

        $package = Package::where('id',$id)->first();
        if(!$package) {
            return redirect()->route('pricing');
        }
        return view('front.buy_ticket', compact('package'));
    }

    public function payment(Request $request)
    {
        //dd($request->all());

        $package_id = $request->package_id;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;
        $price = $unit_price * $quantity;

        if($request->payment_method == "PayPal") 
        {
            // PayPal Start
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if(isset($response['id']) && $response['id'] != null) {
                foreach($response['links'] as $link) {
                    if($link['rel'] == 'approve') {
                        session()->put('package_id', $request->package_id);
                        session()->put('package_name', $request->package_name);
                        session()->put('quantity', $request->quantity);
                        session()->put('unit_price', $request->unit_price);
                        session()->put('price', $price);

                        session()->put('billing_name', $request->billing_name);
                        session()->put('billing_email', $request->billing_email);
                        session()->put('billing_phone', $request->billing_phone);
                        session()->put('billing_address', $request->billing_address);
                        session()->put('billing_country', $request->billing_country);
                        session()->put('billing_state', $request->billing_state);
                        session()->put('billing_city', $request->billing_city);
                        session()->put('billing_zip', $request->billing_zip);
                        session()->put('billing_note', $request->billing_note);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal_cancel');
            }
            // PayPal End
        } 
        elseif($request->payment_method == "Stripe") 
        {
            // Stripe Start
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $request->package_name,
                            ],
                            'unit_amount' => $unit_price*100,
                        ],
                        'quantity' => $quantity,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe_success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe_cancel'),
            ]);
            //dd($response);
            if(isset($response->id) && $response->id != ''){
                session()->put('package_id', $request->package_id);
                session()->put('package_name', $request->package_name);
                session()->put('quantity', $request->quantity);
                session()->put('unit_price', $request->unit_price);
                session()->put('price', $price);

                session()->put('billing_name', $request->billing_name);
                session()->put('billing_email', $request->billing_email);
                session()->put('billing_phone', $request->billing_phone);
                session()->put('billing_address', $request->billing_address);
                session()->put('billing_country', $request->billing_country);
                session()->put('billing_state', $request->billing_state);
                session()->put('billing_city', $request->billing_city);
                session()->put('billing_zip', $request->billing_zip);
                session()->put('billing_note', $request->billing_note);

                return redirect($response->url);
            } else {
                return redirect()->route('stripe_cancel');
            }
            // Stripe End
        } 
        else 
        {
            // Bank Start
            session()->put('package_id', $request->package_id);
            session()->put('package_name', $request->package_name);
            session()->put('quantity', $request->quantity);
            session()->put('unit_price', $request->unit_price);
            session()->put('price', $price);

            session()->put('billing_name', $request->billing_name);
            session()->put('billing_email', $request->billing_email);
            session()->put('billing_phone', $request->billing_phone);
            session()->put('billing_address', $request->billing_address);
            session()->put('billing_country', $request->billing_country);
            session()->put('billing_state', $request->billing_state);
            session()->put('billing_city', $request->billing_city);
            session()->put('billing_zip', $request->billing_zip);
            session()->put('billing_note', $request->billing_note);

            return view('front.bank');
            // Bank End
        }

    }



    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if(isset($response['status']) && $response['status'] == 'COMPLETED') 
        {    
            // Generate unique number
            $unique_number = time().rand(1000,9999);

            // Insert data into database
            $ticket = new Ticket;
            $ticket->user_id = Auth::guard('web')->user()->id;
            $ticket->package_id = session()->get('package_id');
            $ticket->payment_id = $unique_number;
            $ticket->package_name = session()->get('package_name');
            $ticket->billing_name = session()->get('billing_name');
            $ticket->billing_email = session()->get('billing_email');
            $ticket->billing_phone = session()->get('billing_phone');
            $ticket->billing_address = session()->get('billing_address');
            $ticket->billing_country = session()->get('billing_country');
            $ticket->billing_state = session()->get('billing_state');
            $ticket->billing_city = session()->get('billing_city');
            $ticket->billing_zip = session()->get('billing_zip');
            $ticket->billing_note = session()->get('billing_note');
            $ticket->payment_method = "PayPal";
            $ticket->payment_currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $ticket->payment_status = 'Completed';
            $ticket->transaction_id = $response['id'];
            $ticket->bank_transaction_info = '';
            $ticket->per_ticket_price = session()->get('unit_price');
            $ticket->total_tickets = session()->get('quantity');
            $ticket->total_price = session()->get('price');
            $ticket->save();

            unset($_SESSION['package_id']);
            unset($_SESSION['package_name']);
            unset($_SESSION['quantity']);
            unset($_SESSION['unit_price']);
            unset($_SESSION['price']);
            unset($_SESSION['billing_name']);
            unset($_SESSION['billing_email']);
            unset($_SESSION['billing_phone']);
            unset($_SESSION['billing_address']);
            unset($_SESSION['billing_country']);
            unset($_SESSION['billing_state']);
            unset($_SESSION['billing_city']);
            unset($_SESSION['billing_zip']);
            unset($_SESSION['billing_note']);

            return redirect()->route('attendee_dashboard')->with('success','Payment is successful!');

        } else {
            return redirect()->route('paypal_cancel');
        }
    }
    public function paypal_cancel()
    {
        return redirect()->route('attendee_dashboard')->with('error','Payment is cancelled!');
    }



    public function stripe_success(Request $request)
    {
        if(isset($request->session_id)) 
        {

            $unique_number = time().rand(1000,9999);

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            $ticket = new Ticket;
            $ticket->user_id = Auth::guard('web')->user()->id;
            $ticket->package_id = session()->get('package_id');
            $ticket->payment_id = $unique_number;
            $ticket->package_name = session()->get('package_name');
            $ticket->billing_name = session()->get('billing_name');
            $ticket->billing_email = session()->get('billing_email');
            $ticket->billing_phone = session()->get('billing_phone');
            $ticket->billing_address = session()->get('billing_address');
            $ticket->billing_country = session()->get('billing_country');
            $ticket->billing_state = session()->get('billing_state');
            $ticket->billing_city = session()->get('billing_city');
            $ticket->billing_zip = session()->get('billing_zip');
            $ticket->billing_note = session()->get('billing_note');
            $ticket->payment_method = "Stripe";
            $ticket->payment_currency = $response->currency;
            $ticket->payment_status = 'Completed';
            $ticket->transaction_id = $response->id;
            $ticket->bank_transaction_info = '';
            $ticket->per_ticket_price = session()->get('unit_price');
            $ticket->total_tickets = session()->get('quantity');
            $ticket->total_price = session()->get('price');
            $ticket->save();

            unset($_SESSION['package_id']);
            unset($_SESSION['package_name']);
            unset($_SESSION['quantity']);
            unset($_SESSION['unit_price']);
            unset($_SESSION['price']);
            unset($_SESSION['billing_name']);
            unset($_SESSION['billing_email']);
            unset($_SESSION['billing_phone']);
            unset($_SESSION['billing_address']);
            unset($_SESSION['billing_country']);
            unset($_SESSION['billing_state']);
            unset($_SESSION['billing_city']);
            unset($_SESSION['billing_zip']);
            unset($_SESSION['billing_note']);

            return redirect()->route('attendee_dashboard')->with('success','Payment is successful!');

        } else {
            return redirect()->route('stripe_cancel');
        }
    }

    public function stripe_cancel()
    {
        return redirect()->route('attendee_dashboard')->with('error','Payment is cancelled!');
    }


    public function bank_success(Request $request)
    {
        if($request->bank_transaction_info == '') {
            return redirect()->route('buy_ticket',session()->get('package_id'))->with('error','Please enter the bank transaction information!');
        }

        $unique_number = time().rand(1000,9999);

        $ticket = new Ticket;
        $ticket->user_id = Auth::guard('web')->user()->id;
        $ticket->package_id = session()->get('package_id');
        $ticket->payment_id = $unique_number;
        $ticket->package_name = session()->get('package_name');
        $ticket->billing_name = session()->get('billing_name');
        $ticket->billing_email = session()->get('billing_email');
        $ticket->billing_phone = session()->get('billing_phone');
        $ticket->billing_address = session()->get('billing_address');
        $ticket->billing_country = session()->get('billing_country');
        $ticket->billing_state = session()->get('billing_state');
        $ticket->billing_city = session()->get('billing_city');
        $ticket->billing_zip = session()->get('billing_zip');
        $ticket->billing_note = session()->get('billing_note');
        $ticket->payment_method = "Bank";
        $ticket->payment_currency = "USD";
        $ticket->payment_status = 'Pending';
        $ticket->transaction_id = "";
        $ticket->bank_transaction_info = $request->bank_transaction_info;
        $ticket->per_ticket_price = session()->get('unit_price');
        $ticket->total_tickets = session()->get('quantity');
        $ticket->total_price = session()->get('price');
        $ticket->save();
        
        $admin = Admin::where('id',1)->first();
       
        $link = url('admin/ticket/index');
        $subject = "Bank Payment Request";
        $message = "Someone paid you via bank, so please click on the following link:<br>";
        $message .= "<a href='".$link."'>Click Here</a>";

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        unset($_SESSION['package_id']);
        unset($_SESSION['package_name']);
        unset($_SESSION['quantity']);
        unset($_SESSION['unit_price']);
        unset($_SESSION['price']);
        unset($_SESSION['billing_name']);
        unset($_SESSION['billing_email']);
        unset($_SESSION['billing_phone']);
        unset($_SESSION['billing_address']);
        unset($_SESSION['billing_country']);
        unset($_SESSION['billing_state']);
        unset($_SESSION['billing_city']);
        unset($_SESSION['billing_zip']);
        unset($_SESSION['billing_note']);

        return redirect()->route('attendee_dashboard')->with('success','Payment Information that you provided will be verified by admin and then it will be successful!');
    }






    public function registration()
    {
        return view('front.registration');
    }

    public function registration_submit(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required','same:password'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $token = hash('sha256',time());
        $user->token = $token;
        $user->status = 0;
        $user->save();

        $verification_link = url('registration-verify/'.$token.'/'.$request->email);
        $subject = "Registration Verification";
        $message = "To complete the registration, please click on the link below:<br>";
        $message .= "<a href='".$verification_link."'>Click Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Your registration is completed. Please check your email for verification. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function registration_verify($token,$email)
    {
        $user = User::where('token',$token)->where('email',$email)->first();
        if(!$user) {
            return redirect()->route('login');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }

    public function login()
    {
        return view('front.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];
    
        if(Auth::guard('web')->attempt($data)) {
            return redirect()->route('attendee_dashboard')->with('success','You are logged in successfully!');
        } else {
            return redirect()->route('login')->with('error','The information you entered is incorrect! Please try again!');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Logout is successful!');
    }

    public function dashboard()
    {
        return view('attendee.dashboard');
    }

    public function profile()
    {
        return view('attendee.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'zip' => ['required'],
        ]);

        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        if($request->photo) {
            $request->validate([
                'photo' => ['mimes:jpg,jpeg,png,gif','max:2024'],
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $user->photo = $final_name;
        }

        if($request->password) {
            $request->validate([
                'password' => ['required'],
                'confirm_password' => ['required','same:password'],
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->update();

        return redirect()->back()->with('success','Profile is updated!');
    }

    public function forget_password()
    {
        return view('front.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email is not found');
        }
    
        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();
    
        $reset_link = url('reset-password/'.$token.'/'.$request->email);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";
    
        \Mail::to($request->email)->send(new Websitemail($subject,$message));
    
        return redirect()->back()->with('success','We have sent a password reset link to your email. Please check your email. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function reset_password($token,$email)
    {
        $user = User::where('email',$email)->where('token',$token)->first();
        if(!$user) {
            return redirect()->route('login')->with('error','Token or email is not correct');
        }
        return view('front.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'confirm_password' => ['required','same:password'],
        ]);

        $user = User::where('email',$request->email)->where('token',$request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success','Password reset is successful. You can login now.');
    }


    public function ticket()
    {
        $tickets = Ticket::with('package')->where('user_id',Auth::guard('web')->user()->id)->get();
        return view('attendee.ticket', compact('tickets'));
    }

    public function invoice($id)
    {
        $ticket = Ticket::with('package')->where('id',$id)->first();
        $admin = Admin::where('id',1)->first();
        $setting = Setting::where('id',1)->first();
        return view('attendee.invoice', compact('ticket', 'admin', 'setting'));
    }

    public function message()
    {
        $messages = Message::orderBy('id','asc')->where('user_id',Auth::guard('web')->user()->id)->get();
        $admin = Admin::where('id',1)->first();
        return view('attendee.message', compact('messages', 'admin'));
    }

    public function message_submit(Request $request)
    {
        $request->validate([
            'message' => ['required'],
        ]);

        $message = new Message();
        $message->user_id = Auth::guard('web')->user()->id;
        $message->message = $request->message;
        $message->save();

        $admin = Admin::where('id',1)->first();
       
        $link = url('admin/message/detail/'.Auth::guard('web')->user()->id);
        $subject = "Message from Attendee";
        $message = 'Please click on the following link to view the message from attendee:<br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Message is sent successfully!');
    }

    public function subscribe_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:subscribers'],
        ]);

        // Save data into database
        $subscriber = new Subscriber;
        $subscriber->email = $request->email;
        $subscriber->token = hash('sha256',time());
        $subscriber->save();

        // Create link and Send email
        $verification_link = url('subscriber-verify/'.$subscriber->token.'/'.$request->email);
        $subject = "Subscription Verification";
        $message = "To complete the subscription, please click on the link below:<br>";
        $message .= "<a href='".$verification_link."'>Click Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','An email is sent to your email. Please check your email. If you do not find the email in your inbox, please check your spam folder.');
    }

    public function subscriber_verify($token,$email)
    {
        $subscriber = Subscriber::where('token',$token)->where('email',$email)->first();
        if(!$subscriber) {
            return redirect()->route('home');
        }
        $subscriber->token = '';
        $subscriber->status = 'active';
        $subscriber->update();

        return redirect()->route('home')->with('success', 'Your email is verified. You will receive the latest news and updates.');
    }
    
}
