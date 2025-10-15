<div class="container main-menu" id="navbar">
    <div class="row">
        <div class="col-lg-2 col-sm-12"> 
            <a href="{{ route('home') }}" id="logo" class="grid_2"> <img src="{{ asset('uploads/'.$setting_data->logo) }}"> </a> 
        </div>
        <div class="col-lg-10 col-sm-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
                    <ul id="navContent" class="navbar-nav mr-auto navigation">
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('speakers') }}">Speakers</a>
                        </li>
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('schedule') }}">Schedule</a>
                        </li>
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('pricing') }}">Pricing</a>
                        </li>
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li class="nav-item dropdown"> <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pages </a>
                            <div class="dropdown-menu" id="dropmenu" aria-labelledby="navbarDropdown"> 
                                <a class="dropdown-item" href="{{ route('sponsors') }}">Sponsors</a>
                                <a class="dropdown-item" href="{{ route('organisers') }}">Organizers</a>
                                <a class="dropdown-item" href="{{ route('accommodations') }}">Accommodations</a>
                                <a class="dropdown-item" href="{{ route('photo_gallery') }}">Photo Gallery</a>
                                <a class="dropdown-item" href="{{ route('video_gallery') }}">Video Gallery</a>
                                <a class="dropdown-item" href="{{ route('faq') }}">FAQ</a>
                                <a class="dropdown-item" href="{{ route('testimonial') }}">Testimonials</a> 
                            </div>
                        </li>
                        <li>
                            <a class="smooth-scroll nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="member-login-button">
                            <div class="inner">
                                @if(Auth::guard('web')->check())
                                <a class="smooth-scroll nav-link" href="{{ route('attendee_dashboard') }}">
                                    <i class="fa fa-user"></i> Dashboard
                                </a>
                                @else
                                <a class="smooth-scroll nav-link" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Login
                                </a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>