<script type="text/javascript">{{App\Script::get('footer_script')}}</script>  
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/moment.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.slimscroll.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<!-- cs-slider start -->


<script>
    $('.cs-slider').slick({
        autoplay: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                }
            }

        ]
    });
</script>
<!-- cs-slider end -->
<!-- destination-slider start -->
<script>
    $('.destination-slider').slick({
        autoplay: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                }
            }
        ]
    });


</script>
<script>
        $(document).ready(function() {
            $('.select2').select2({
            });
        });
    </script>
    <script>
        $(document).on("focus", ".select2", function (e) {
          if (e.originalEvent) {
            var s2element = $(this).siblings("select:enabled");
            s2element.select2("open");
            // Set focus back to select2 element on closing.
            s2element.on("select2:closing", function () {
              if (s2element.val()) s2element.select2("focus");
            });
          }
        });
    </script>
<!-- destination-slider end -->

{!! Notify::render() !!}
@yield('scripts')

