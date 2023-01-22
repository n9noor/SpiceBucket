<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<title>Spice Bucket.</title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="">

<!-- site Favicon -->
<link rel="icon" href="{{asset('images/favicon.png')}}" sizes="32x32" />
<link rel="apple-touch-icon" href="{{asset('images/favicon.png')}}" />
<meta name="msapplication-TileImage" content="{{asset('images/favicon.png')}}" />

<!-- css Icon Font -->
<link rel="stylesheet" href="{{asset('frontend/css/vendor/ecicons.min.css')}}" />

<!-- css All Plugins Files -->
<link rel="stylesheet" href="{{asset('frontend/css/plugins/animate.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/swiper-bundle.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/jquery-ui.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/countdownTimer.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/slick.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/nouislider.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/plugins/bootstrap.css')}}" />

<!-- Main Style -->
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}" />

<!-- Background css -->
<link rel="stylesheet" id="bg-switcher-css" href="{{asset('frontend/css/backgrounds/bg-4.css')}}">

</head>
<body>
<div id="ec-overlay"><span class="loader_img"></span></div>
<!-- Header start  -->
<header class="ec-header">
<!--Ec Header Top Start -->
<div class="header-top">
<div class="container">
<div class="row align-items-center">
<!-- Header Top social Start -->
<div class="col text-left header-top-left d-none d-lg-block">
<div class="header-top-social">
<span class="social-text text-upper">Follow us on:</span>
<ul class="mb-0">
<li class="list-inline-item"><a class="hdr-facebook" href="javascript:void()"><i class="ecicon eci-facebook"></i></a></li>
<li class="list-inline-item"><a class="hdr-twitter" href="javascript:void()"><i class="ecicon eci-twitter"></i></a></li>
<li class="list-inline-item"><a class="hdr-instagram" href="javascript:void()"><i class="ecicon eci-instagram"></i></a></li>
<li class="list-inline-item"><a class="hdr-linkedin" href="javascript:void()"><i class="ecicon eci-linkedin"></i></a></li>
</ul>
</div>
</div>
<!-- Header Top social End -->
<!-- Header Top Message Start -->
<div class="col text-center header-top-center">
<div class="header-top-message text-upper">
<span>Free Shipping</span>This Week Order Over - $75
</div>
</div>
<!-- Header Top Message End -->
<!-- Header Top Language Currency -->
<div class="col header-top-right d-none d-lg-block">
<div class="header-top-lan-curr d-flex justify-content-end">
<!-- Currency Start -->
<div class="header-top-curr dropdown">
<button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
class="ecicon eci-caret-down" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<li class="active"><a class="dropdown-item" href="javascript:void()">USD $</a></li>
<li><a class="dropdown-item" href="javascript:void()">EUR €</a></li>
</ul>
</div>
<!-- Currency End -->
<!-- Language Start -->
<div class="header-top-lan dropdown">
<button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
class="ecicon eci-caret-down" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<li class="active"><a class="dropdown-item" href="javascript:void()">English</a></li>
<li><a class="dropdown-item" href="javascript:void()">Italiano</a></li>
</ul>
</div>
<!-- Language End -->

</div>
</div>
<!-- Header Top Language Currency -->
<!-- Header Top responsive Action -->
<div class="col d-lg-none ">
<div class="ec-header-bottons">
<!-- Header User Start -->
<div class="ec-header-user dropdown">
<button class="dropdown-toggle" data-bs-toggle="dropdown"><img
src="{{asset('frontend/images/icons/user.svg')}}" class="svg_img header_svg" alt="" /></button>
<ul class="dropdown-menu dropdown-menu-right">
@if(Session::get('customer-logged-in') == true)
<li><a class="dropdown-item" href="/logout">Logout</a></li>
@else
<!-- <li><a class="dropdown-item" href="/registration">Customer Register</a></li> -->
<li><a class="dropdown-item" href="/login">Customer Login</a></li>
@endif
<li><a class="dropdown-item" href="/vendors/register">Vendor Register</a></li>
<li><a class="dropdown-item" href="/vendors/login">Vendor Login</a></li>
<li><a class="dropdown-item" href="/administrator/login">Administrator Login</a></li>
</ul>
</div>
<!-- Header User End -->
<!-- Header Cart Start -->
<!--
<a href="wishlist.html" class="ec-header-btn ec-header-wishlist">
<div class="header-icon"><img src="{{asset('frontend/images/icons/wishlist.svg')}}"
class="svg_img header_svg" alt="" /></div>
<span class="ec-header-count">4</span>
</a>
-->
<!-- Header Cart End -->
<!-- Header Cart Start -->
<a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
<div class="header-icon"><img src="{{asset('frontend/images/icons/cart.svg')}}"
class="svg_img header_svg" alt="" /></div>
<span class="ec-header-count cart-count-lable"></span>
</a>
<!-- Header Cart End -->
<!-- Header menu Start -->
<a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
<i class="ecicon eci-bars"></i>
</a>
<!-- Header menu End -->
</div>
</div>
<!-- Header Top responsive Action -->
</div>
</div>
</div>
<!-- Ec Header Top  End -->
<!-- Ec Header Bottom  Start -->
<div class="ec-header-bottom d-none d-lg-block">
<div class="container position-relative">
<div class="row">
<div class="ec-flex">
<!-- Ec Header Logo Start -->
<div class="align-self-center">
<div class="header-logo">
<a href="/"><img src="{{asset('images/logo-color.png')}}" alt="Site Logo" /></a>
</div>
</div>
<!-- Ec Header Logo End -->

<!-- Ec Header Search Start -->
<div class="align-self-center">
<div class="header-search">
<form class="ec-btn-group-form" action="javascript:void()">
<input class="form-control" placeholder="Enter Your Product Name..." type="text">
<button class="submit" type="submit"><img src="{{asset('frontend/images/icons/search.svg')}}"
class="svg_img header_svg" alt="" /></button>
</form>
</div>
</div>
<!-- Ec Header Search End -->

<!-- Ec Header Button Start -->
<div class="align-self-center">
<div class="ec-header-bottons">

<!-- Header User Start -->
<div class="ec-header-user dropdown">
<button class="dropdown-toggle" data-bs-toggle="dropdown"><img
src="{{asset('frontend/images/icons/user.svg')}}" class="svg_img header_svg" alt="" /></button>
<ul class="dropdown-menu dropdown-menu-right">
@if(Session::get('customer-logged-in') == true)
<li><a class="dropdown-item" href="/logout">Logout</a></li>
@else
<!-- <li><a class="dropdown-item" href="/registration">Customer Register</a></li> -->
<li><a class="dropdown-item" href="/login">Customer Login</a></li>
@endif
<li><a class="dropdown-item" href="/vendors/register">Vendor Register</a></li>
<li><a class="dropdown-item" href="/vendors/login">Vendor Login</a></li>
<li><a class="dropdown-item" href="/administrator/login">Administrator Login</a></li>
</ul>
</div>
<!-- Header User End -->
<!-- Header wishlist Start -->
<!--
<a href="wishlist.html" class="ec-header-btn ec-header-wishlist">
<div class="header-icon"><img src="{{asset('frontend/images/icons/wishlist.svg')}}"
class="svg_img header_svg" alt="" /></div>
<span class="ec-header-count">4</span>
</a>
-->
<!-- Header wishlist End -->
<!-- Header Cart Start -->
<a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
<div class="header-icon"><img src="{{asset('frontend/images/icons/cart.svg')}}"
class="svg_img header_svg" alt="" /></div>
<span class="ec-header-count cart-count-lable">{{Session::get('totalquantity')}}</span>
</a>
<!-- Header Cart End -->
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Ec Header Button End -->
<!-- Header responsive Bottom  Start -->
<div class="ec-header-bottom d-lg-none">
<div class="container position-relative">
<div class="row ">

<!-- Ec Header Logo Start -->
<div class="col">
<div class="header-logo">
<a href="/"><img src="{{asset('images/logo-color.png')}}" alt="Site Logo" /></a>
</div>
</div>
<!-- Ec Header Logo End -->
<!-- Ec Header Search Start -->
<div class="col">
<div class="header-search">
<form class="ec-btn-group-form" action="javascript:void()">
<input class="form-control" placeholder="Enter Your Product Name..." type="text">
<button class="submit" type="submit"><img src="{{asset('frontend/images/icons/search.svg')}}"
class="svg_img header_svg" alt="" /></button>
</form>
</div>
</div>
<!-- Ec Header Search End -->
</div>
</div>
</div>
<!-- Header responsive Bottom  End -->
<!-- EC Main Menu Start -->
<div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
<div class="container position-relative">
<div class="row">
<div class="col-md-12 align-self-center">
<div class="ec-main-menu">
<ul>
<li><a href="/">Home</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<!-- Ec Main Menu End -->
<!-- ekka Mobile Menu Start -->
<div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
<div class="ec-menu-title">
<span class="menu_title">My Menu</span>
<button class="ec-close">×</button>
</div>
<div class="ec-menu-inner">
<div class="ec-menu-content">
<ul>
<li><a href="/">Home</a></li>
</ul>
</div>
<div class="header-res-lan-curr">
<div class="header-top-lan-curr">
<!-- Language Start -->
<div class="header-top-lan dropdown">
<button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
class="ecicon eci-caret-down" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<li class="active"><a class="dropdown-item" href="javascript:void()">English</a></li>
<li><a class="dropdown-item" href="javascript:void()">Italiano</a></li>
</ul>
</div>
<!-- Language End -->
<!-- Currency Start -->
<div class="header-top-curr dropdown">
<button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
class="ecicon eci-caret-down" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<li class="active"><a class="dropdown-item" href="javascript:void()">USD $</a></li>
<li><a class="dropdown-item" href="javascript:void()">EUR €</a></li>
</ul>
</div>
<!-- Currency End -->
</div>
<!-- Social Start -->
<div class="header-res-social">
<div class="header-top-social">
<ul class="mb-0">
<li class="list-inline-item"><a class="hdr-facebook" href="javascript:void()"><i class="ecicon eci-facebook"></i></a></li>
<li class="list-inline-item"><a class="hdr-twitter" href="javascript:void()"><i class="ecicon eci-twitter"></i></a></li>
<li class="list-inline-item"><a class="hdr-instagram" href="javascript:void()"><i class="ecicon eci-instagram"></i></a></li>
<li class="list-inline-item"><a class="hdr-linkedin" href="javascript:void()"><i class="ecicon eci-linkedin"></i></a></li>
</ul>
</div>
</div>
<!-- Social End -->
</div>
</div>
</div>
<!-- ekka mobile Menu End -->
</header>
<!-- Header End  -->

<!-- ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
<div class="ec-cart-inner">
<div class="ec-cart-top">
<div class="ec-cart-title">
<span class="cart_title">My Cart</span>
<button class="ec-close">×</button>
</div>
<ul class="eccart-pro-items">
@foreach(Session::get('customer-cart') as $product_id => $cart)
<li data-pid="product-{{$product_id}}" data-qty="{{$cart['quantity']}}">
<a href="javascript:void(0);" class="sidekka_pro_img">
<img src="{{url('/images/products/' . $cart['image'])}}" alt="product">
</a>
<div class="ec-pro-content">
<a href="javascript:void(0);" class="cart_pro_title">{{$cart['title']}}</a>
<span class="cart-price"><span>{{$cart['price']}}</span> x <span class="cart-qty">{{$cart['quantity']}}</span></span>
<div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div>
<input class="qty-input" type="text" name="ec_qtybtn" value="{{$cart['quantity']}}">
<div class="inc ec_qtybtn">+</div></div>
<a href="javascript:void(0)" class="remove" id="remove-{{$product_id}}">×</a>
</div>
</li>
@endforeach
</ul>
</div>
<div class="ec-cart-bottom">
<div class="cart-sub-total">
<table class="table cart-table">
<tbody>
<tr>
<td class="text-left">Sub-Total :</td>
<td class="text-right">{{Session::get('subtotal-amount')}}</td>
</tr>
<tr>
<td class="text-left">GST (18%) :</td>
<td class="text-right">{{Session::get('gst-amount')}}</td>
</tr>
<tr>
<td class="text-left">Total :</td>
<td class="text-right primary-color">{{Session::get('total-amount')}}</td>
</tr>
</tbody>
</table>
</div>
<div class="cart_btn">
<a href="{{url('/cart')}}" class="btn btn-primary">View Cart</a>
<a href="/checkout" class="btn btn-secondary">Checkout</a>
</div>
</div>
</div>
</div>
<!-- ekka Cart End -->
@yield('content')
<!-- Footer Start -->
<footer class="ec-footer section-space-mt">
<div class="footer-container">
<div class="footer-top section-space-footer-p">
<div class="container">
<div class="row">
<div class="col-sm-12 col-lg-3 ec-footer-contact">
<div class="ec-footer-widget">
<div class="ec-footer-logo"><a href="javascript:void()"><img src="{{asset('images/logo-color.png')}}" alt=""></a></div>
<h4 class="ec-footer-heading">Contact us</h4>
<div class="ec-footer-links">
<ul class="align-items-center">
<li class="ec-footer-link">1234, ABC Colony, XYZ State, Country</li>
<li class="ec-footer-link"><span>Call Us:</span><a href="tel:+910123456789">+44
0123 456 789</a></li>
<li class="ec-footer-link"><span>Email:</span><a
href="mailto:example@ec-email.com">+example@ec-email.com</a></li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-2 ec-footer-info">
<div class="ec-footer-widget">
<h4 class="ec-footer-heading">Information</h4>
<div class="ec-footer-links">
<ul class="align-items-center">
<li class="ec-footer-link"><a href="javascript:void()">About us</a></li>
<li class="ec-footer-link"><a href="javascript:void()">FAQ</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Delivery Information</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Contact us</a></li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-2 ec-footer-account">
<div class="ec-footer-widget">
<h4 class="ec-footer-heading">Account</h4>
<div class="ec-footer-links">
<ul class="align-items-center">
<li class="ec-footer-link"><a href="javascript:void()">My Account</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Order History</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Wish List</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Specials</a></li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-2 ec-footer-service">
<div class="ec-footer-widget">
<h4 class="ec-footer-heading">Services</h4>
<div class="ec-footer-links">
<ul class="align-items-center">
<li class="ec-footer-link"><a href="javascript:void()">Discount Returns</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Policy & policy </a></li>
<li class="ec-footer-link"><a href="javascript:void()">Customer Service</a></li>
<li class="ec-footer-link"><a href="javascript:void()">Term & condition</a>
</li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-3 ec-footer-news">
<div class="ec-footer-widget">
<h4 class="ec-footer-heading">Newsletter</h4>
<div class="ec-footer-links">
<ul class="align-items-center">
<li class="ec-footer-link">Get instant updates about our new products and
special promos!</li>
</ul>
<div class="ec-subscribe-form">
<form id="ec-newsletter-form" name="ec-newsletter-form" method="post" action="javascript:void()">
<div id="ec_news_signup" class="ec-form">
<input class="ec-email" type="email" required="" placeholder="Enter your email here..." name="ec-email" value="" />
<button id="ec-news-btn" class="button btn-primary" type="submit" name="subscribe" value=""><i class="ecicon eci-paper-plane-o" aria-hidden="true"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer-bottom">
<div class="container">
<div class="row align-items-center">
<!-- Footer social Start -->
<div class="col text-left footer-bottom-left">
<div class="footer-bottom-social">
<span class="social-text text-upper">Follow us on:</span>
<ul class="mb-0">
<li class="list-inline-item"><a class="hdr-facebook" href="javascript:void()"><i class="ecicon eci-facebook"></i></a></li>
<li class="list-inline-item"><a class="hdr-twitter" href="javascript:void()"><i class="ecicon eci-twitter"></i></a></li>
<li class="list-inline-item"><a class="hdr-instagram" href="javascript:void()"><i class="ecicon eci-instagram"></i></a></li>
<li class="list-inline-item"><a class="hdr-linkedin" href="javascript:void()"><i class="ecicon eci-linkedin"></i></a></li>
</ul>
</div>
</div>
<!-- Footer social End -->
<!-- Footer Copyright Start -->
<div class="col-6 text-center footer-copy">
<div class="footer-bottom-copy ">
<div class="ec-copy">Copyright © {{getFinancialYear(date('Y-m-d'))}} <a class="site-name text-upper"
href="javascript:void()">SpiceBucket<span>.</span></a>. All Rights Reserved</div>
</div>
</div>
<!-- Footer Copyright End -->
<!-- Footer payment -->
<div class="col footer-bottom-right">
<div class="footer-bottom-payment d-flex justify-content-end">
<div class="payment-link">
<img src="{{asset('frontend/images/icons/payment.png')}}" alt="">
</div>

</div>
</div>
<!-- Footer payment -->
</div>
</div>
</div>
</div>
</footer>
<!-- Footer Area End -->


<!-- Footer navigation panel for responsive display -->
<div class="ec-nav-toolbar">
<div class="container">
<div class="ec-nav-panel">
<div class="ec-nav-panel-icons">
<a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
src="{{asset('frontend/images/icons/menu.svg')}}" class="svg_img header_svg" alt="" /></a>
</div>
<div class="ec-nav-panel-icons">
<a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><img
src="{{asset('frontend/images/icons/cart.svg')}}" class="svg_img header_svg" alt="" /><span
class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
</div>
<div class="ec-nav-panel-icons">
<a href="/" class="ec-header-btn"><img src="{{asset('frontend/images/icons/home.svg')}}"
class="svg_img header_svg" alt="icon" /></a>
</div>
<!--
<div class="ec-nav-panel-icons">
<a href="wishlist.html" class="ec-header-btn"><img src="{{asset('frontend/images/icons/wishlist.svg')}}"
class="svg_img header_svg" alt="icon" /><span class="ec-cart-noti">4</span></a>
</div>
-->
<div class="ec-nav-panel-icons">
<a href="/login" class="ec-header-btn"><img src="{{asset('frontend/images/icons/user.svg')}}"
class="svg_img header_svg" alt="icon" /></a>
</div>

</div>
</div>
</div>
<!-- Footer navigation panel for responsive display end -->

<!-- Cart Floating Button -->
<div class="ec-cart-float">
<a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
<div class="header-icon"><img src="{{asset('frontend/images/icons/cart.svg')}}" class="svg_img header_svg" alt="" /></div>
<span class="ec-cart-count cart-count-lable">{{Session::get('cart-count')}}</span>
</a>
</div>
<!-- Cart Floating Button end -->

<!-- Vendor JS -->
<script src="{{asset('frontend/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/modernizr-3.11.2.min.js')}}"></script>

<!--Plugins JS-->
<script src="{{asset('frontend/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/countdownTimer.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('frontend/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/infiniteslidev2.js')}}"></script>
<script src="{{asset('frontend/js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/jquery.sticky-sidebar.js')}}"></script>
<!-- Main Js -->
<script src="{{asset('frontend/js/vendor/index.js')}}"></script>
<script src="{{asset('frontend/js/cart.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>

</body>
</html>