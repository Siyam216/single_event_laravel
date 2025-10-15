<script src="{{ asset('dist-front/js/jquery-3.3.1.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/popper.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('dist-front/js/modernizr-2.8.3.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery.appear.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery-countTo.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery.countdown.min.js') }}"></script> 
<script src="{{ asset('dist-front/js/jquery.scrollTo.js') }}"></script> 
<script src="{{ asset('dist-front/js/typed.js') }}"></script> 
<script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('dist-front/js/custom.js') }}"></script>
@php
$home_banner_data = App\Models\HomeBanner::where('id',1)->first();
@endphp
<script>
    $(".countDown").downCount({
        date: '{{ $home_banner_data->event_date }} {{ $home_banner_data->event_time }}',
        // Format: month/date/year HH:MM:SS
    });
</script>