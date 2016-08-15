<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Exam Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{asset('public/frontAsset/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('public/frontAsset/css/bootstrap-responsive.css')}}">
<link rel="stylesheet" href="{{asset('public/frontAsset/css/prettyPhoto.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontAsset/css/flexslider.css')}}" />
<link rel="stylesheet" href="{{asset('public/frontAsset/css/custom-styles.css')}}">
<!--Custom-->

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]--> 

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="{{asset('public/frontAsset/img/favicon.ico')}}">
<link rel="apple-touch-icon" href="{{asset('public/frontAsset/img/apple-touch-icon.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('public/frontAsset/img/apple-touch-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('public/frontAsset/img/apple-touch-icon-114x114.png')}}">

<!-- JS
================================================== -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="{{asset('public/frontAsset/js/bootstrap.js')}}"></script>
<script src="{{asset('public/frontAsset/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontAsset/js/jquery.flexslider.js')}}"></script>
<script src="{{asset('public/frontAsset/js/jquery.custom.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>

</head>

<body class="home">
    <!-- Color Bars (above header)-->
	<div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div> 
    <div class="container" style="min-height: 600px">
    
      <div class="row header"><!-- Begin Header -->
      
        <!-- Logo
        ================================================== -->
        <div class="span5 logo">
         <a href="index.htm"><img src="frontAsset/img/piccolo-logo.png" alt="" /></a>
            <h5>An Exam Management Excellence </h5>
        </div>
        
        <!-- Main Navigation
        ================================================== -->
        @include('front.component.menue')
        @yield('menue')
        
      </div><!-- End Header -->   

    @yield('content')

      </div> <!-- End Container -->

   
 <!-- Footer Area
        ================================================== -->
    @include('front.component.footer')
    @yield('footer')
    <!-- Scroll to Top -->  
    <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>

    
  
    
</body>
</html>

