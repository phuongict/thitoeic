</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('/public/front/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/public/front/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/public/front/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/public/front/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/public/front/dist/js/adminlte.min.js') }}"></script>
{{--carou--}}
<script src="{{ asset('/public/front/assets/owlcarousel/owl.carousel.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/public/front/dist/js/demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: false,
                    loop: false,
                    margin: 20
                }
            }
        });
        var d = new Date();
        var fullDate = d.getDay()+'/'+d.getMonth()+'/'+d.getFullYear();
        console.log(fullDate);
        $('._myDate').text(fullDate);
    })
</script>
@yield("script")
</body>
</html>
