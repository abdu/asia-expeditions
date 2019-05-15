<!DOCTYPE html>
<html lang=en>
<head>
<link rel="shortcut icon" type="image/x-icon" href="{{asset('public/img/'. config('app.icon'))}}"/>
<meta charset=utf-8>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=keywords itemprop=keywords content="@yield('keywords')">
<meta name=description content="@yield('description')">




<link rel="stylesheet" type="text/css" href="{{asset('css/lib/csscompressed.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript" src="{{asset('js/compressed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.lazy.min.js')}}"></script>
 <link href="{{asset('add_lib/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">


  <!-- Insert to your webpage before the </head> -->
  <!-- <script src="{{asset('sliderengine/jquery.js')}}"></script> -->
    <script src="{{asset('sliderengine/amazingslider.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('sliderengine/amazingslider-1.css')}}">
    <script src="{{asset('sliderengine/initslider-1.js')}}"></script>
    <!-- End of head section HTML codes -->
     <!-- JavaScript Libraries -->

     
  <link href="{{asset('/add_lib/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('/add_lib/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('/add_lib/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="/add_lib/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  
  

  <!-- Contact Form JavaScript File -->

<title>@yield('title') | {{config('app.name')}}</title>
<style type="text/css">
	form.gsc-search-box{
		margin-bottom: -1px !important;
	}
	.cse .gsc-control-cse, .gsc-control-cse{
		padding: 0px !important;
	}
	table.gsc-search-box{
		margin-bottom: 0px !important;
	}
  .add{
    color: #4CAF50 !important;
  }
</style>

    <script type="text/javascript">
  $(document).ready(function(){  
        $('.clients-carousel').hover(function(){
          $('.owl-prev').css({"opacity":"1","background-position-x":"-5px"});
          $('.owl-next').css({"opacity":"1","background-position-x":"44px"});
        },function(){
          $('.owl-prev').css({"opacity":"0","background-position-x":"0px"});
          $('.owl-next').css({"opacity":"0","background-position-x":"40px"});
        });

    // $("li.u span.u").hover(function(){
    //   // alert('aaaa');
    //     $('.u span.u').removeClass('fa .u span.u').addClass('fa fa-user-o');
    // },function(){
    //    $('.u span.u').removeClass('fa fa-user-o').addClass('fa fa-user');
    // });    
    // $("li.c span.c").hover(function(){
    //   // alert('aaaa');
    //     $('.c span.c').removeClass('fa fa-shopping-cart').addClass('fa fa-cart-arrow-down');
    // },function(){
    //    $('.c span.c').removeClass('fa fa-cart-arrow-down').addClass('fa fa-shopping-cart');
    // });

        $("li span.u").hover(function(){
        $('span.u').toggleClass('fa-user fa-user add');
      });
        $("li span.c").hover(function(){
        $('span.c').toggleClass('fa-shopping-cart fa-cart-arrow-down');
      });
 

   });
</script>
</head>
<body >
@include('include.message')
	@yield('content')
	@include('include.footer')
  <script src="{{asset('/add_lib/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('/add_lib/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('/add_lib/lib/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('/add_lib/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('/add_lib/lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('/add_lib/lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
  <script src="{{asset('/js/main.js')}}"></script>


  <script src="/add_lib/lib/easing/easing.min.js"></script>
  <script src="/add_lib/lib/superfish/hoverIntent.js"></script>
  <script src="/add_lib/lib/superfish/superfish.min.js"></script> 
  <script src="/add_lib/lib/lightbox/js/lightbox.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>