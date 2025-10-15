<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="icon" type="image/png" href="{{ asset('uploads/'.$setting_data->favicon) }}">

        <title>SingleEvent - Event & Conference Management Website</title>

        @include('front.layout.styles')

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,500,700,900" rel="stylesheet">

        <style>
            .member-login-button .inner,
            .static-banner-detail a.video_btn,
            .global_btn a:hover,
            .global_btn a.btn_two,
            ul.social-icon li a:hover,
            .main-footer .subscribe-widget button,
            .speaker-detail ul.social-icon li a,
            .projects .project-head:before,
            .faq .card-header,
            .testimonialSec1 .testimonial-content .testimonial-icon,
            .contact-inner-box,
            .contact-inner-icon,
            .contact input.btn-con-bg:hover,
            .user-sidebar li.active-item a,
            .user-sidebar li a:hover {
                background: #{{ $setting_data->theme_color }};
            }
            .static-banner-detail h4,
            .single-count h1,
            .color_green,
            a:link,
            a:visited,
            .prices .info h3,
            ul.social-icon li a,
            .speaker-detail h4,
            .speaker-box h2,
            .blog-post-meta ul.post-meta li,
            .projects .button .btn i,
            .projects .button .btn:hover i,
            .testimonialSec1 .testimonial .post,
            .message-heading {
                color: #{{ $setting_data->theme_color }};
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            textarea:focus,
            select:focus {
                border-color: #{{ $setting_data->theme_color }}!important;
            }

            .testimonialSec1 .testimonial-content .testimonial-icon::before {
                border-bottom-color: #{{ $setting_data->theme_color }};
            }

            .message-item-admin-border {
                border-left-color: #{{ $setting_data->theme_color }};
            }

            .main-footer .links-widget .list li a:hover {
                color: #{{ $setting_data->theme_color }}!important;
            }

            .login-register-bg .form-group > button:hover {
                background: #{{ $setting_data->theme_color }}!important;
            }

            .schedule-tab .nav-tabs .nav-link.active {
                border-color: #{{ $setting_data->theme_color }};
                background-color: #{{ $setting_data->theme_color }};
            }

            .global_btn a.btn_two {
                color: #fff!important;
            }
            #about-section .global_btn a {
                background: #{{ $setting_data->theme_color }};
                color: #fff;
            }
        </style>
        
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">

        @include('front.layout.nav')

        @yield('main_content')

        <footer class="main-footer"> 
            <div class="widgets-section">
                <div class="container">
                    <div class="clearfix"> 
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="row clearfix">

                                <div class="footer-column col-lg-2 col-sm-6 col-xs-12">
                                    <div class="footer-widget links-widget">
                                        <h2>Links</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><a href="{{ route('home') }}">Home</a></li>
                                                <li><a href="{{ route('sponsors'); }}">Sponsors</a></li>
                                                <li><a href="{{ route('speakers') }}">Speakers</a></li>
                                                <li><a href="{{ route('organisers') }}">Organizers</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="footer-column col-lg-2 col-sm-6 col-xs-12">
                                    <div class="footer-widget links-widget">
                                        <h2>Pages</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><a href="{{ route('term') }}">Terms of Use</a></li>
                                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                                <li><a href="{{ route('schedule') }}">Schedule</a></li>
                                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="footer-column col-lg-4 col-sm-6 col-xs-12">
                                    <div class="footer-widget links-widget">
                                        <h2>Contact</h2>
                                        <div class="widget-content">
                                            <ul class="list">
                                                @if($setting_data->footer_address != '')
                                                <li>Address: {{ $setting_data->footer_address }}</li>
                                                @endif
                                                @if($setting_data->footer_email != '')
                                                <li>Email: {{ $setting_data->footer_email }}</li>
                                                @endif
                                                @if($setting_data->footer_phone != '')
                                                <li>Phone: {{ $setting_data->footer_phone }}</li>
                                                @endif
                                            </ul>
                                            <ul class="social-icon mt_15">
                                                @if($setting_data->footer_facebook != '')
                                                <li><a href="{{ $setting_data->footer_facebook }}"><i class="fa fa-facebook"></i></a></li>
                                                @endif
                                                @if($setting_data->footer_twitter != '')
                                                <li><a href="{{ $setting_data->footer_twitter }}"><i class="fa fa-twitter"></i></a></li>
                                                @endif
                                                @if($setting_data->footer_linkedin != '')
                                                <li><a href="{{ $setting_data->footer_linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                                                @endif
                                                @if($setting_data->footer_instagram != '')
                                                <li><a href="{{ $setting_data->footer_instagram }}"><i class="fa fa-instagram"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                        
                                <div class="footer-column col-lg-4 col-sm-6 col-xs-12">
                                    <div class="footer-widget subscribe-widget">
                                        <h2>Newsletter</h2>
                                        <div class="widget-content">
                                            <div class="newsletter-form">
                                                <form method="post" action="{{ route('subscribe_submit') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="email" name="email" value="" placeholder="Enter Email Address" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="global_btn">
                                                            <button type="submit" class="btn_two">SUBSCRIBE</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <!--Footer Bottom-->
            <div class="footer-bottom">
                <div class="auto-container container">
                <div class="text">
                    {{ $setting_data->copyright }}
                </div>
                </div>
            </div>
        </footer>

        @include('front.layout.scripts')

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    iziToast.show({
                        message: '{{ $error }}',
                        color: 'red',
                        position: 'topRight',
                    });
                </script>
            @endforeach
        @endif
        @if(session('success'))
            <script>
                iziToast.show({
                    message: '{{ session("success") }}',
                    color: 'green',
                    position: 'topRight',
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                iziToast.show({
                    message: '{{ session("error") }}',
                    color: 'red',
                    position: 'topRight',
                });
            </script>
        @endif
        
    </body>
</html>