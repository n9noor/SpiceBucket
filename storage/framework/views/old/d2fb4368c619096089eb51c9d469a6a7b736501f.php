<!DOCTYPE html>

<html class="no-js" lang="en">



<head>

    <meta charset="utf-8" />

    <title>Spice Bucket</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <meta name="description" content="" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="" />

    <meta property="og:type" content="" />

    <meta property="og:url" content="" />

    <meta property="og:image" content="" />

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicon -->


    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;1,100;1,200;1,300&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Template CSS -->

    <link rel="stylesheet" href="/assets/css/plugins/slider-range.css" />

    <link rel="stylesheet" href="/assets/css/listnav.css?v=5.6" />

    <link rel="stylesheet" href="/assets/css/main.css?v=766.6" />

    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="/assets/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="/assets/alertifyjs/css/themes/default.min.css" />
    <link rel="stylesheet" href="/assets/css/track.scss" />

	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QDSMX4G87G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QDSMX4G87G');
</script>
	
    <?php echo $__env->yieldPushContent('externalcss'); ?>

</head>



<style>

  .animated-heading {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
} 
.mobile-promotion{
    position: relative;
}

.mobile-promotion .d-inline-block{
    width:100%;
    text-align:center;
}

.loop-text2 p {
    width:100%;
    position: absolute;
    font-size: 13px;
    top: 16%;
    /* left: 26%; */
  opacity: 0; 
  
}

@keyframes moveUp {
  0%, 100% {
    opacity: 0;
    transform: translateY(20px);
  }
  20%, 80% {
    opacity: 1;
    transform: translateY(0);
  }
}




</style>



<body>

    <div id="alert-container"></div>

    <header class="header-area header-style-1 header-height-2">

        <div class="mobile-promotion">

                <div  class="d-inline-block">
                   
                         <div class="loop-text2" style="text-align: center;">
                              
                              <p class="show" style="color:white;">Flat 10% Dsicount On All Product Use SBNEWU</p>
                              <p class="show"  style="color:white;">Direct Factory To At Your Doorstep</p>
                              <p  class="show" style="color:white;">Free Delivery on Order Above <i class="fa fa-rupee-sign"> 499</i></p>
                            </div>
                          

                              

                                
         
                                

                            </div>

        </div>

       

        <div class="header-top header-top-ptb-1 d-none d-lg-block">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-xl-4 col-lg-3">

                        <div class="header-info">

                            <ul>

                                <li class="bold-font"><a href="<?php echo e(array_key_exists('firstcoloumntitleurl', $header) && strlen($header['firstcoloumntitleurl']) > 0 ? $header['firstcoloumntitleurl'] : 'javascript:void(0)'); ?>">

                                        <div class="blink-container">

                                            <!-- <h1 onclick="trackYourOrder('', '')" class="text-red blink-hard"><?php echo e(array_key_exists('firstcoloumntitle', $header) && strlen($header['firstcoloumntitle']) > 0 ? $header['firstcoloumntitle'] : 'Track Your Order'); ?></h1> -->
                       <a   href="https://www.dtdc.in/tracking.asp"  class="text-red blink-hard" target="_blank"><h1 style="color:white;">Track Your Order</h1></a>
                                        </div>
                                    </a></li>

                                <li><a href="<?php echo e(array_key_exists('firstcoloumntitlesecondparturl', $header) && strlen($header['firstcoloumntitlesecondparturl']) > 0 ? $header['firstcoloumntitlesecondparturl'] : 'javascript:void(0)'); ?>"><?php echo e(array_key_exists('firstcoloumntitlesecondpart', $header) && strlen($header['firstcoloumntitlesecondpart']) > 0 ? $header['firstcoloumntitlesecondpart'] : 'Cash On Delivery Available'); ?></a></li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-5">

                        <div class="text-center">

                            <!--<div id="news-flash" class="d-inline-block">

                                <ul>
                                    <?php if(array_key_exists('secondcoloumntitle', $header) && strlen($header['secondcoloumntitle']) > 0): ?>
                                    <li><?php echo str_replace(array("\r\n", "\n", "\r"), '</li><li>', $header['secondcoloumntitle']); ?></li>
                                    
                                    <?php endif; ?>
                                </ul>

                            </div>-->

                            <!--<div id="hideDiv">
                                Free Delivery on Order Above
                            </div>-->
                           
                            <div class="loop-text">
                              
                              <p class="show">Flat 10% Dsicount On All Product Use SBNEWU</p>
                              <p>Direct Factory To At Your Doorstep </p>
                              <p>Free Delivery on Order Above  <i class="fa fa-rupee-sign"> 499</i></p>
                            </div>

                            <style type="text/css">
                                @keyframes fade {
                                     0% {
                                         opacity: 1;
                                    }
                                     50% {
                                         opacity: 0;
                                    }
                                     100% {
                                         opacity: 1;
                                    }
                                }
                                 .loop-text {
                                     position: relative;
                                     height: 40px;
                                     overflow: hidden;
                                }
                                 .loop-text p {
                                     position: absolute;
                                     height: 30px;
                                     opacity: 0;
                                     transition: 0.5s ease-out;
                                }
                                 .loop-text p.show {
                                     opacity: 1;
                                }


                                .loop-text p {
                                  font-weight: 500;
                                  color: #fff;
                                  margin-top: 8px;
                                  text-align: center;
                                  width: 100%;
                                  display: block;

                                 
                            </style>
                            
                            <script type="text/javascript">
                                
                                let texts = document.querySelectorAll(".loop-text p");

                                    let prev = null;
                                    let animate = (curr, currIndex) => {
                                      let index = (currIndex + 1) % texts.length
                                      setTimeout(() => {
                                        if(prev) {
                                          prev.className = "";
                                        } 
                                        curr.className = "show";
                                        prev = curr;
                                        animate(texts[index], index);
                                      }, 2500);
                                    }

                                    animate(texts[0], 0);
                            </script>

                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-4">

                        <div class="header-info header-info-right">

                            <ul>

                                <li class="bold-font"><?php echo e(array_key_exists('thirdcoloumntitle', $header) && strlen($header['thirdcoloumntitle']) > 0 ? $header['thirdcoloumntitle'] : "Customer Support"); ?>:&nbsp;<strong class="text-brand">

                                        <a class="header-call" href="tel:<?php echo e(array_key_exists('customersupportnumber', $header) && strlen($header['customersupportnumber']) > 0 ? $header['customersupportnumber'] : '+917247247070'); ?>"><?php echo e(array_key_exists('customersupportnumber', $header) && strlen($header['customersupportnumber']) > 0 ? $header['customersupportnumber'] : '+91 724 724 7070'); ?></a></strong></li>

                                <li>

                                    <a class="language-dropdown-active" id="google_translate_element" href="#">English <i class="fi-rs-angle-small-down"></i></a>

                                    
                                </li>

                                

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="header-middle header-middle-ptb-1">

            <div class="container">

                <div class="header-wrap">

                    <div class="logo logo-width-1">

                        <a href="/"><img src="<?php echo e(array_key_exists('logoimage', $header) && strlen($header['logoimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $header['logoimage']) : url('/images/staticImages/' . $header['logoimage'])) : url('/assets/imgs/logoSB.png')); ?>" alt="logo" /></a>

                    </div>

                    <div class="header-right">

                        <div class="search-style-2">

                            <form action="/shop">

                                <select class="select-active" name="category">

                                    <option value='0'>All Categories</option>

                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>

                                <input type="text" name="searchquery" required placeholder="Search for items..." value="<?php echo e(old('searchquery')); ?>" />

                            </form>

                        </div>

                        <div class="header-action-right">

                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="/notification" class="mini-cart-icon-wishlist">
                                        <img class="svgInject" alt="Spice Bucket" src="/assets/imgs/theme/icons/bell.png" />
                                        <span class="pro-count green"><?php echo e(session('notificationCount')); ?></span>
                                    </a>
                                    <!--<a href="/notification"><span class="lable">Notifications</span></a>-->
                                </div>

                                <div class="header-action-icon-2">

                                    <a href="/wishlist" class="mini-cart-icon-wishlist">

                                        <img class="svgInject" alt="Spice Bucket" src="/assets/imgs/theme/icons/icon-heart.svg" />

                                        <span class="pro-count blue">0</span>

                                    </a>

                                    <!--<a href="/wishlist"><span class="lable">Wishlist</span></a>-->

                                </div>

                                <div class="header-action-icon-2">

                                    <a class="mini-cart-icon" href="/cart">

                                        <img alt="Spice Bucket" src="/assets/imgs/theme/icons/icon-cart.svg" />

                                        <span class="pro-count blue">0</span>

                                    </a>

                                    <!--<a href="/cart"><span class="lable">Cart</span></a>-->

                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 cart-dropdown-panel">

                                    </div>

                                </div>

                                <div class="header-action-icon-2">

                                    <a href="javascript:void(0)">

                                        <img class="svgInject" alt="Spice Bucket" src="/assets/imgs/theme/icons/icon-user.svg" />

                                    </a>

                                    <?php if(Session::get('customer-logged-in') == true): ?>

                                    <a href="javascript:void(0)"><span class="lable ml-0"><?php echo e(Session::get('customer-loggedin-name')); ?></span></a>

                                    <?php else: ?>

                                    <!--<a href="/login"><span class="lable ml-0">Account</span></a>-->

                                    <?php endif; ?>

                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">

                                        <ul>

                                            <?php if(Session::get('customer-logged-in') == true): ?>

                                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>

                                            <li><a class="dropdown-item"  onclick="return confirm('Are you sure you want to logout?')" href="/logout">Logout</a></li>

                                            <?php else: ?>

                                            <li><a class="dropdown-item" href="/login">Login</a></li>

                                            <?php endif; ?>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="header-bottom header-bottom-bg-color sticky-bar">

            <div class="container">

                <div class="header-wrap header-space-between position-relative">

                    <div class="logo logo-width-1 d-block d-lg-none">

                        <a href="/"><img src="/assets/imgs/logoSB.png" alt="logo" /></a>

                    </div>

                    <div class="header-nav d-none d-lg-flex">

                        <div class="main-categori-wrap d-none d-lg-block">

                            <a class="categories-button-active" href="#">

                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All Categories

                                <i class="fi-rs-angle-down"></i>

                            </a>

                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">

                                <div class="d-flex categori-dropdown-inner">

                                    <ul class="category-list">

                                        <?php $__currentLoopData = $headercategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headercategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="onhover-category-list">
                                            <?php $imagearray=array('path_folder'=>'/images/products/','image'=> $headercategory['image'],'size'=>[100,100]); 
                                             ?>  
                                             <a class="category-name" href="/offers?category=<?php echo e($headercategory['id']); ?>"> <img src="<?php echo e(imageRender($imagearray)); ?>" alt="" /><?php echo e($headercategory['name']); ?></a>
                                         </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>

                                        <?php if(url()->current() == env('APP_URL')): ?>

                                        <a class="<?php echo e($activePage == 'home' ? 'active' : ''); ?>">Home</a>

                                        <?php else: ?>

                                        <a class="<?php echo e($activePage == 'home' ? 'active' : ''); ?>" href="/" >Home</a>

                                        <?php endif; ?>

                                    </li>

                                    <li>

                                        <?php if(url()->current() == env('APP_URL') . "/about-us"): ?>



                                        <a class="<?php echo e($activePage == 'about' ? 'active' : ''); ?>">About</a>

                                        <?php else: ?>

                                        <a class="<?php echo e($activePage == 'about' ? 'active' : ''); ?>" href="/about-us" >About</a>

                                        <?php endif; ?>

                                    </li>

                                    

                                    <li class="position-static">

                                        <a class="<?php echo e($activePage == 'vendor' ? 'active' : ''); ?>" href="javascript:void(0)">Sellers</a>

                                        <ul class="mega-menu">

                                            <li class="sub-mega-menu sub-mega-menu-width-22">

                                                <input type="text" id="search-brandname" placeholder="Type To Search" />

                                                <ul id="brand-names" class="brand-names">

                                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($vendor->is_approved == 1): ?>

                                                        <?php if(url()->current() == env('APP_URL') . "/brand/$vendor->slug"): ?>
                                                            <li><a href="#"><?php echo e($vendor->vendor_alias); ?></a></li>
                                                            <?php else: ?>
                                                            <li><a href="/brand/<?php echo e($vendor->slug); ?>" target="_blank"><?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : $vendor->vendor_alias); ?></a></li>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>

                                            </li>

                                            <li class="sub-mega-menu sub-mega-menu-width-90">

                                                <div class="tabs">

                                                    <input type="radio" name="tabs" id="tabone" checked="checked">

                                                    <label for="tabone">Popular Brands</label>

                                                    <div class="tab">

                                                        <ul class="brand-logos">

                                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($vendor->is_approved == 1 && $vendor->tab_category == 'popular'): ?>
                                                            <?php if(url()->current() == env('APP_URL') . "/brand/$vendor->slug"): ?>
                                                            <li><a><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e($vendor->store_name); ?> ( <?php echo e($vendor->store_alias); ?> )" width="150" height="150" /></a></li>
                                                            <?php else: ?>
                                                            <li><a href="/brand/<?php echo e($vendor->slug); ?>" target="_blank"><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : ($vendor->vendor_alias . '( ' . $vendor->store_name . ' )')); ?>" width="150" height="150" /></a></li>
                                                            <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </ul>

                                                    </div>

                                                    <input type="radio" name="tabs" id="tabtwo">

                                                    <label for="tabtwo">Top Selling Brands</label>

                                                    <div class="tab">

                                                        <ul class="brand-logos">

                                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($vendor->is_approved == 1 && $vendor->tab_category == 'top_selling'): ?>
                                                            <?php if(url()->current() == env('APP_URL') . "/brand/$vendor->slug"): ?>
                                                            <li><a><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : ($vendor->vendor_alias . '( ' . $vendor->store_name . ' )')); ?>" width="150" height="150" /></a></li>
                                                            <?php else: ?>
                                                            <li><a href="/brand/<?php echo e($vendor->slug); ?>" target="_blank"><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : ($vendor->vendor_alias . '( ' . $vendor->store_name . ' )')); ?>" width="150" height="150" /></a></li>
                                                            <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </ul>

                                                    </div>

                                                    <input type="radio" name="tabs" id="tabthree">

                                                    <label for="tabthree">Only At Spice Bucket</label>

                                                    <div class="tab">

                                                        <ul class="brand-logos">

                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($vendor->is_approved == 1 && $vendor->tab_category == 'only_at_spicebucket'): ?>
                                                                <?php if(url()->current() == env('APP_URL') . "/brand/$vendor->slug"): ?>
                                                                <li><a><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : ($vendor->vendor_alias . '( ' . $vendor->store_name . ' )')); ?>" width="150" height="150" /></a></li>
                                                            <?php else: ?>
                                                                <li><a href="/brand/<?php echo e($vendor->slug); ?>" target="_blank"><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" title="<?php echo e(is_null($vendor->vendor_alias) ? $vendor->store_name : ($vendor->vendor_alias . '( ' . $vendor->store_name . ' )')); ?>" width="150" height="150" /></a></li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </li>

                                        </ul>

                                    </li>

                                    <li>

                                        <?php if(url()->current() == env('APP_URL') . "/offers"): ?>

                                        <a class="<?php echo e($activePage == 'offers' ? 'active' : ''); ?>" href="#

                                        ">Offers</a>

                                        <?php else: ?>

                                        <a class="<?php echo e($activePage == 'offers' ? 'active' : ''); ?>" href="/offers

                                        " target="_blank">Offers</a>

                                        <?php endif; ?>

                                    </li>

                                   

                                    <li>

                                        <?php if(url()->current() == env('APP_URL') . "/contac-us"): ?>

                                        <a class="<?php echo e($activePage == 'contact' ? 'active' : ''); ?>" href="#" >Contact</a>

                                        <?php else: ?>

                                        <a class="<?php echo e($activePage == 'contact' ? 'active' : ''); ?>" href="/contact-us">Contact</a>

                                        <?php endif; ?>

                                    </li>

                                </ul>

                            </nav>

                        </div>

                    </div>

                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">

                        <nav>

                            <ul>

                                <li>

                                   

                                    <img class="download-app-iocn" src="/assets/imgs/icons8-down.gif"><a href="">Download App</a>

                                    <ul class="sub-menu">

                                        <li>

                                            <p>Download Our App</p>

                                        </li>

                                        <li><a href="#" class="hover-up"><img src="/assets/imgs/theme/google-play.jpg" alt="" /></a></li>

                                        <li><a href="#" class="hover-up"><img class="active" src="/assets/imgs/theme/app-store.jpg" alt="" /></a></li>

                                    </ul>

                                </li>

                                <li> <a href="/sellers/register" target="_blank">Become a Seller</a> </li>

                            </ul>

                        </nav>

                    </div>

                    <!--<div class="hotline d-none d-lg-flex">

                        <img class="headset-home-nav" src="/assets/imgs/icons8-headset.gif" alt="hotline" />

                        <p><a href="tel:<?php echo e(array_key_exists('supportnumber', $header) && strlen($header['supportnumber']) > 0 ? trim($header['supportnumber']) : '+917247247070'); ?>"><?php echo e(array_key_exists('supportnumber', $header) && strlen($header['supportnumber']) > 0 ? $header['supportnumber'] : '+91 724 724 7070'); ?></a><span>24/7 Support Center</span></p>

                    </div>-->

                    <div class="header-action-icon-2 d-block d-lg-none">

                        <div class="burger-icon burger-icon-white">

                            <span class="burger-icon-top"></span>

                            <span class="burger-icon-mid"></span>

                            <span class="burger-icon-bottom"></span>

                        </div>

                    </div>

                    <div class="header-action-right d-block d-lg-none">

                        <div class="header-action-2">

                            

                            <div class="header-action-icon-2">

                                <a class="mini-cart-icon" href="/cart">

                                    <img alt="Spice Bucket" src="/assets/imgs/theme/icons/icon-cart.svg" />

                                    <span class="pro-count white">0</span>

                                </a>

                            </div>

                            <div class="header-action-icon-2">

                                <a href="javascript:void(0)">

                                    <img class="svgInject" alt="Spice Bucket" src="/assets/imgs/theme/icons/icon-user.svg" />

                                </a>

                                <?php if(Session::get('customer-logged-in') == true): ?>

                                <a href="javascript:void(0)"><span class="lable ml-0">My Account</span></a>

                                <?php else: ?>

                                <a href="#"><span class="lable ml-0">Account</span></a>

                                <?php endif; ?>

                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">

                                    <ul>

                                        <!--<li><a class="dropdown-item" href="#">Need Help?</a></li>

                                        <li><a class="dropdown-item" href="#">Authenticity</a></li>

                                        <li><a class="dropdown-item" href="#">Responsible Disclosure</a></li>

                                        <li><a class="dropdown-item" href="#">Chat Now</a></li>-->

                                        <?php if(Session::get('customer-logged-in') == true): ?>

                                        <li>

                                            <?php if(url()->current() == 'env(APP_URL)' . "/dashboard"): ?>

                                            <a class="dropdown-item" href="#">Dashboard</a>

                                            <?php else: ?>

                                            <a class="dropdown-item" href="/dashboard" target="_blank">Dashboard</a>

                                            <?php endif; ?>



                                        </li>

                                        <li>

                                            <a class="dropdown-item" onclick="return confirm('Are you sure you want to logout?')" href="/logout">Logout</a>

                                        </li>

                                        <?php else: ?>

                                        <li>

                                            <?php if(url()->current() == 'env(APP_URL)' . "/login"): ?>

                                            <a class="dropdown-item" href="#">Login</a>

                                            <?php else: ?>

                                            <a class="dropdown-item" href="/login" target="_blank">Login</a>

                                            <?php endif; ?>

                                        </li>

                                        <?php endif; ?>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container-fluid desktop-view">

                <div class="mobile-search search-style-3 mobile-header-border">

                    <form action="/shop">

                        <input type="text" name="searchquery" required placeholder="Search for items…" value="<?php echo e(old('searchquery')); ?>" />

                        <button type="submit"><i class="fi-rs-search"></i></button>

                    </form>

                </div>

            </div>

        </div>

    </header>

    <div class="mobile-header-active mobile-header-wrapper-style">

        <div class="mobile-header-wrapper-inner">

            <div class="mobile-header-top">

                <div class="mobile-header-logo">

                    <a href="/"><img src="/assets/imgs/logoSB.png" alt="logo" /></a>

                </div>

                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">

                    <button class="close-style search-close">

                        <i class="icon-top"></i>

                        <i class="icon-bottom"></i>

                    </button>

                </div>

            </div>

            <div class="mobile-header-content-area">

                <div class="mobile-menu-wrap mobile-header-border">

                    <!-- mobile menu start -->

                    <div class="accordion-tabs">
                        <!-- Toggle radio buttons -->
                        <input type="radio" name="tabs-activate" id="tab-one" class="activate-tab" />
                        <input type="radio" name="tabs-activate" id="tab-two" class="activate-tab" />

                        <div class="tabs">
                            <!-- Visible tabs -->
                            <label for="tab-one" id="tab-one-label" class="tab">Categories</label>
                            <label for="tab-two" id="tab-two-label" class="tab">Sellers</label>
                            <!-- Tab content -->

                            <div id="tab-one-tab-content" class="tab-content">
                                <div id="mobileSLider-category">
                                    <ul class="menu">
                                        <?php $__currentLoopData = $headercategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headercategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list"><a href="/offers?category=<?php echo e($headercategory['id']); ?>"><?php echo e($headercategory['name']); ?></a></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div id="tab-two-tab-content" class="tab-content">
                                <input type="text" id="mobile-search-brandname" placeholder="Type To Search" />
                                <ul id="mobile-brand-names" class="mobile-brand-names">
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($vendor->is_approved == 1): ?>
                                    <li><a href="/brand/<?php echo e($vendor->slug); ?>"><?php echo e($vendor->vendor_alias); ?></a></li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mobile menu end -->

                </div>
            </div>
            <div class="mobile-header-content-area second_part">
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <!--<li class="menu-item-has-children">
                                <a href="#">Wallet</a>
                            </li>-->



                            <li class="menu-item-has-children">
                                <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/dashboard.svg" alt="user"></span>
                                <a href="/dashboard">User Dashboard</a>

                            </li>

                            

                            <li class="menu-item-has-children">
                                <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/icon-heart.svg" alt="Wishlist"></span>
                                <a href="/wishlist">Wishlist</a>

                            </li>

                            <li class="menu-item-has-children">
                            <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/customer-support.svg" alt="Wishlist"></span>

                                <a href="Tel:+917247247070">Customer Support</a>

                            </li>

                            <li class="menu-item-has-children">
                                <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/info.png" alt="About us"></span>
                                <a href="/about-us">About Us</a>

                            </li>
                            <li class="menu-item-has-children">
                                <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/insurance.png" alt="About us"></span>
                                <a href="/privacy-policy">Privacy Policy</a>

                            </li>

                            <li class="menu-item-has-children">
                                <span class="left-menu-icon"><img src="https://spicebucket.com/assets/imgs/theme/icons/exchange.png" alt="About us"></span>
                                <a href="/payment-policy">Return Policy</a>

                            </li>

                        </ul>

                    </nav>

                    <!-- mobile menu end -->

                </div>

                

                <div class="mobile-social-icon mb-50 mt-50">

                    <h6 class="mb-15">Follow Us</h6>

<a class="facebook" href="<?php echo e(array_key_exists('fburl', $footer) && strlen($footer['fburl']) > 0 ? $footer['fburl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('fbimage', $footer) && strlen($footer['fbimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['fbimage']) : url('/images/staticImages/' . $footer['fbimage'])) : url('/assets/imgs/theme/icons/icon-facebook-white.svg')); ?>" alt="" /></a>


<a class="instagram" href="<?php echo e(array_key_exists('instagramurl', $footer) && strlen($footer['instagramurl']) > 0 ? $footer['instagramurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('instagramimage', $footer) && strlen($footer['instagramimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['instagramimage']) : url('/images/staticImages/' . $footer['instagramimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>

<a class="linkedin" href="<?php echo e(array_key_exists('linkedinurl', $footer) && strlen($footer['linkedinurl']) > 0 ? $footer['linkedinurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('linkedinimage', $footer) && strlen($footer['linkedinimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['linkedinimage']) : url('/images/staticImages/' . $footer['linkedinimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>

<a class="twitter" href="<?php echo e(array_key_exists('twitterurl', $footer) && strlen($footer['twitterurl']) > 0 ? $footer['twitterurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('twitterimage', $footer) && strlen($footer['twitterimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['twitterimage']) : url('/images/staticImages/' . $footer['twitterimage'])) : url('/assets/imgs/theme/icons/icon-twitter-white.svg')); ?>" alt="" /></a>

<a class="pintrest" href="<?php echo e(array_key_exists('pintresturl', $footer) && strlen($footer['pintresturl']) > 0 ? $footer['pintresturl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('pintrestimage', $footer) && strlen($footer['pintrestimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['pintrestimage']) : url('/images/staticImages/' . $footer['pintrestimage'])) : url('/assets/imgs/theme/icons/icon-pinterest-white.svg')); ?>" alt="" /></a>

<a class="youtube" href="<?php echo e(array_key_exists('youtubeurl', $footer) && strlen($footer['youtubeurl']) > 0 ? $footer['youtubeurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('youtubeimage', $footer) && strlen($footer['youtubeimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['youtubeimage']) : url('/images/staticImages/' . $footer['youtubeimage'])) : url('/assets/imgs/theme/icons/icon-youtube-white.svg')); ?>" alt="" /></a>
                </div>

                <div class="site-copyright">
                Copyright 2022 © Spice Bucket. All rights reserved.</div>

            </div>

        </div>

    </div>

    <!--End header-->

    <!-- <?php if(Session::has('message')): ?>
    <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
    <?php endif; ?> -->

    <?php echo $__env->yieldContent('content'); ?>

    

    <footer class="main">

        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="position-relative newsletter-inner">

                            <div class="newsletter-content">

                             
<h2 class="mb-20">Stay Home & Get Your Daily Need <br />

                                    Products From Our Online Store 
									</h2>
                               
								
								<p class="mb-45">Start Your Daily Shopping with Spice Bucket</p>

                                <!--<form class="form-subcriber d-flex">

                                    <input type="email" placeholder="Your email address" />

                                    <button class="btn" type="submit">Subscribe</button>

                                </form>-->
                                <div class="grab-latest-offer">
                                    <a href="https://spicebucket.com/offers">Grab latest offers</a>
                                </div>
                            </div>

                            <img src="<?php echo e(array_key_exists('subscribeimage', $footer) && strlen($footer['subscribeimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['subscribeimage']) : url('/images/staticImages/' . $footer['subscribeimage'])) : url("/assets/imgs/banner/banner-9.png")); ?>" alt="newsletter" />

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="featured section-padding">

            <div class="container">

                <div class="row">

                    <div class="col-lg-1-5 col-md-4 col-6 col-sm-6 mb-md-4 mb-xl-0">

                        <div class="banner-left-icon banner-left-icon1 d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">

                            <div class="banner-icon">

                                <img src="/assets/imgs/icons/tap.png" alt="" />

                            </div>

                            <div class="banner-text">

                                <h3 class="icon-box-title"><?php echo e(array_key_exists('title1', $footer) && strlen($footer['title1']) > 0 ? $footer['title1'] : 'Choose Your Favourite Brand'); ?></h3>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">

                        <div class="banner-left-icon banner-left-icon2 d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">

                            <div class="banner-icon">

                                <img src="/assets/imgs/icons/quality-assurance.png" alt="" />

                            </div>

                            <div class="banner-text">

                                <h3 class="icon-box-title"><?php echo e(array_key_exists('title2', $footer) && strlen($footer['title2']) > 0 ? $footer['title2'] : 'Assured Quality'); ?></h3>



                            </div>

                        </div>

                    </div>

                    <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">

                        <div class="banner-left-icon banner-left-icon1 d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">

                            <div class="banner-icon">

                                <img src="/assets/imgs/icons/offer.png" alt="" />

                            </div>

                            <div class="banner-text">

                                <h3 class="icon-box-title"><?php echo e(array_key_exists('title3', $footer) && strlen($footer['title3']) > 0 ? $footer['title3'] : 'Maximum Discount'); ?></h3>



                            </div>

                        </div>

                    </div>

                    <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">

                        <div class="banner-left-icon banner-left-icon2 d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">

                            <div class="banner-icon">

                                <img src="/assets/imgs/icons/fast-delivery.png" alt="" />

                            </div>

                            <div class="banner-text">

                                <h3 class="icon-box-title"><?php echo e(array_key_exists('title4', $footer) && strlen($footer['title4']) > 0 ? $footer['title4'] : 'Fast Delivery'); ?></h3>



                            </div>

                        </div>

                    </div>

                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">

                        <div class="banner-left-icon banner-left-icon1 d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">

                            <div class="banner-icon">

                                <img src="/assets/imgs/icons/returns.png" alt="" />

                            </div>

                            <div class="banner-text">

                                <h3 class="icon-box-title"><?php echo e(array_key_exists('title5', $footer) && strlen($footer['title5']) > 0 ? $footer['title5'] : 'Easy returns'); ?></h3>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="section-padding footer-mid mobile-view">

            <div class="container pt-0 pb-5">

                <div class="row">

                    

                    <div class ="footer-link-widget col-md-2 coumn-2 col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">

                        <h4 class="widget-title"><?php echo e(array_key_exists('footertitle1', $footer) && strlen($footer['footertitle1']) > 0 ? $footer['footertitle1'] : 'Company'); ?></h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            <?php $count=array_key_exists('firstsubtitleurl', $footer) ? count($footer['firstsubtitleurl']) : 0; ?>

                            <?php for($i=0; $i<($count); $i++): ?> <li><a href="<?php echo e(array_key_exists('firstsubtitleurl', $footer) && strlen($footer['firstsubtitleurl'][$i]) > 0 ? $footer['firstsubtitleurl'][$i] : '#'); ?>"><?php echo e(array_key_exists('firstsubtitle', $footer) && strlen($footer['firstsubtitle'][$i]) > 0 ? $footer['firstsubtitle'][$i] : ''); ?></a></li>

                                <?php endfor; ?>

                        </ul>

                    </div>

                    <div class="footer-link-widget col-md-2 coumn-3 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">

                        <h4 class="widget-title"><?php echo e(array_key_exists('footertitle2', $footer) && strlen($footer['footertitle2']) > 0 ? $footer['footertitle2'] : 'Account'); ?></h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            <?php $count=array_key_exists('secondsubtitleurl', $footer) ? count($footer['secondsubtitleurl']) : 0; ?>

                            <?php for($i=0; $i<($count); $i++): ?> <li><a href="<?php echo e(array_key_exists('secondsubtitleurl', $footer) && strlen($footer['secondsubtitleurl'][$i]) > 0 ? $footer['secondsubtitleurl'][$i] : '#'); ?>"><?php echo e(array_key_exists('secondsubtitle', $footer) && strlen($footer['secondsubtitle'][$i]) > 0 ? $footer['secondsubtitle'][$i] : ''); ?></a></li>

                                <?php endfor; ?>

                        </ul>

                    </div>

                    <div class="footer-link-widget col-md-2 coumn-4 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">

                        <h4 class="widget-title"><?php echo e(array_key_exists('footertitle3', $footer) && strlen($footer['footertitle3']) > 0 ? $footer['footertitle3'] : 'Corporate Services'); ?></h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            <?php $count=array_key_exists('thirdsubtitleurl', $footer) ? count($footer['thirdsubtitleurl']) : 0; ?>

                            <?php for($i=0; $i<($count); $i++): ?> <li><a href="<?php echo e(array_key_exists('thirdsubtitleurl', $footer) && strlen($footer['thirdsubtitleurl'][$i]) > 0 ? $footer['thirdsubtitleurl'][$i] : '#'); ?>"><?php echo e(array_key_exists('thirdsubtitle', $footer) && strlen($footer['thirdsubtitle'][$i]) > 0 ? $footer['thirdsubtitle'][$i] : ''); ?></a></li>

                                <?php endfor; ?>

                        </ul>

                    </div>

                    <div class="footer-link-widget col-md-2 coumn-5 col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">

                        <h4 class="widget-title"><?php echo e(array_key_exists('footertitle4', $footer) && strlen($footer['footertitle4']) > 0 ? $footer['footertitle4'] : 'Popular'); ?></h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            <?php $count=array_key_exists('fourthsubtitle', $footer) ? count($footer['fourthsubtitle']) : 0; ?>

                            <?php for($i=0; $i<($count); $i++): ?> <li><a href="<?php echo e(array_key_exists('fourthsubtitleurl', $footer) && strlen($footer['fourthsubtitleurl'][$i]) > 0 ? $footer['fourthsubtitleurl'][$i] : '#'); ?>"><?php echo e(array_key_exists('fourthsubtitle', $footer) && strlen($footer['fourthsubtitle'][$i]) > 0 ? $footer['fourthsubtitle'][$i] : ''); ?></a></li>

                                <?php endfor; ?>

                        </ul>
                    </div>

                    <div class="footer-link-widget col-md-2 coumn-5 col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">

                        <h4 class="widget-title">New at Spice Bucket</h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            
                             <li><a href="https://spicebucket.com/product-categories/seasonings-and-condiments">Seasonings & Condiments</a></li>

                             <li><a href="https://spicebucket.com/product-categories/mouth-freshener">Mouth Freshener</a></li>

                             <li><a href="https://spicebucket.com/product-categories/gifting-food-items">Gifting Food Items</a></li>

                             <li><a href="https://spicebucket.com/product-categories/poojan-hawan-samagries">Poojan/Hawan Samagries</a></li>

                             <li><a href="https://spicebucket.com/product-categories/gourmet-&-world-food">Gourmet & World Food</a></li>

                             <li><a href="https://spicebucket.com/product-categories/organic-foods">Organic Foods</a></li>

                             <li><a href="https://spicebucket.com/product-categories/premix-&-ingredients">Premix & Ingredients</a></li>

                             <li><a href="https://spicebucket.com/product-categories/sweets">Sweets</a></li>

                                
                        </ul>
                        
                        

                    </div>
                    <div class="footer-link-widget col-md-2 coumn-5 col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">

                        <h4 class="widget-title">Latest Categories</h4>

                        <ul class="footer-list mb-sm-5 mb-md-0">

                            
                             <li><a href="https://spicebucket.com/product-categories/seasonings-and-condiments">Seasonings & Condiments</a></li>

                             <li><a href="https://spicebucket.com/product-categories/mouth-freshener">Mouth Freshener</a></li>

                             <li><a href="https://spicebucket.com/product-categories/gifting-food-items">Gifting Food Items</a></li>

                             <li><a href="https://spicebucket.com/product-categories/poojan-hawan-samagries">Poojan/Hawan Samagries</a></li>

                             <li><a href="https://spicebucket.com/product-categories/gourmet-&-world-food">Gourmet & World Food</a></li>

                             <li><a href="https://spicebucket.com/product-categories/organic-foods">Organic Foods</a></li>

                             <li><a href="https://spicebucket.com/product-categories/premix-&-ingredients">Premix & Ingredients</a></li>

                             <li><a href="https://spicebucket.com/product-categories/sweets">Sweets</a></li>

                                
                        </ul>
                        
                        

                    </div>

                    

                </div>

                    

                </div>


<hr>
				<div class="row">
					

                        <div class="col-md-3">
							<div class="mFooter mFooter1">
								<h4 class="widget-title">Download our Application</h4>
							</div>
                            <div class="mFooter mFooter2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fAppImage fAImage1">
                                        <a href="#" class="hover-up"><img src="/assets/imgs/theme/google-play.jpg" alt="" /></a>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fAppImage fAImage2">
                                            <a href="#" class="hover-up mb-lg-0"><img class="active" src="/assets/imgs/theme/app-store.jpg" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            
                              
                        </div>
						</div>

                        <div class="col-md-3">
                            <div class="logo"><a href="/" class=""><img style="width:120px;" src="<?php echo e(array_key_exists('googlereviewimage', $footer) && strlen($footer['googlereviewimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['googlereviewimage']) : url('/images/staticImages/' . $footer['googlereviewimage'])) : url('/assets/imgs/slider/pngegg.png')); ?>" alt="Google review" /></a>



                            </div>
                        </div>
						
						
					
                        <div class="col-md-3">
							<div class="mFooter mFooter4">
							<h6 class="mb-15">Secured Payment Gateways</h6>
							</div>
                            <div class="mFooter mFooter5">
                            <img class="" src="/assets/imgs/payment-strip.png" alt="" />
                            </div>
						</div>

                        <div class="col-md-3">
                            <div class="mobile-social-icon">

                                    <h6>Follow Us</h6></br>

                                    <div class="mobile-social-icon-desk">
                                        <a class="facebook" href="<?php echo e(array_key_exists('fburl', $footer) && strlen($footer['fburl']) > 0 ? $footer['fburl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('fbimage', $footer) && strlen($footer['fbimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['fbimage']) : url('/images/staticImages/' . $footer['fbimage'])) : url('/assets/imgs/theme/icons/icon-facebook-white.svg')); ?>" alt="" /></a>


                                    <a class="instagram" href="<?php echo e(array_key_exists('instagramurl', $footer) && strlen($footer['instagramurl']) > 0 ? $footer['instagramurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('instagramimage', $footer) && strlen($footer['instagramimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['instagramimage']) : url('/images/staticImages/' . $footer['instagramimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>

                                    <a class="linkedin" href="<?php echo e(array_key_exists('linkedinurl', $footer) && strlen($footer['linkedinurl']) > 0 ? $footer['linkedinurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('linkedinimage', $footer) && strlen($footer['linkedinimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['linkedinimage']) : url('/images/staticImages/' . $footer['linkedinimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>


                                    <a class="twitter" href="<?php echo e(array_key_exists('twitterurl', $footer) && strlen($footer['twitterurl']) > 0 ? $footer['twitterurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('twitterimage', $footer) && strlen($footer['twitterimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['twitterimage']) : url('/images/staticImages/' . $footer['twitterimage'])) : url('/assets/imgs/theme/icons/icon-twitter-white.svg')); ?>" alt="" /></a>

                                    <a class="pintrest" href="<?php echo e(array_key_exists('pintresturl', $footer) && strlen($footer['pintresturl']) > 0 ? $footer['pintresturl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('pintrestimage', $footer) && strlen($footer['pintrestimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['pintrestimage']) : url('/images/staticImages/' . $footer['pintrestimage'])) : url('/assets/imgs/theme/icons/icon-pinterest-white.svg')); ?>" alt="" /></a>

                                    <a class="youtube" href="<?php echo e(array_key_exists('youtubeurl', $footer) && strlen($footer['youtubeurl']) > 0 ? $footer['youtubeurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('youtubeimage', $footer) && strlen($footer['youtubeimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['youtubeimage']) : url('/images/staticImages/' . $footer['youtubeimage'])) : url('/assets/imgs/theme/icons/icon-youtube-white.svg')); ?>" alt="" /></a>
                                    </div>    
                                    
                                </div>
                        </div>

                    

                       



                    
</div>

        </section>




        <section class="section-padding footer-mid desktop-view">

            <div class="container pt-15 pb-20">

                <div class="row">

                    <div class="col col coumn-1">

                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">



                            <ul class="contact-infor">

                                <div class="mobile-social-icon">

                                    <h6>Follow Us</h6>
                                    <a class="facebook" href="<?php echo e(array_key_exists('fburl', $footer) && strlen($footer['fburl']) > 0 ? $footer['fburl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('fbimage', $footer) && strlen($footer['fbimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['fbimage']) : url('/images/staticImages/' . $footer['fbimage'])) : url('/assets/imgs/theme/icons/icon-facebook-white.svg')); ?>" alt="" /></a>

                                    <a class="instagram" href="<?php echo e(array_key_exists('instagramurl', $footer) && strlen($footer['instagramurl']) > 0 ? $footer['instagramurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('instagramimage', $footer) && strlen($footer['instagramimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['instagramimage']) : url('/images/staticImages/' . $footer['instagramimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>

                                    <a class="linkedin" href="<?php echo e(array_key_exists('linkedinurl', $footer) && strlen($footer['linkedinurl']) > 0 ? $footer['linkedinurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('linkedinimage', $footer) && strlen($footer['linkedinimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['linkedinimage']) : url('/images/staticImages/' . $footer['linkedinimage'])) : url('/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>

                                    <a class="twitter" href="<?php echo e(array_key_exists('twitterurl', $footer) && strlen($footer['twitterurl']) > 0 ? $footer['twitterurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('twitterimage', $footer) && strlen($footer['twitterimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['twitterimage']) : url('/images/staticImages/' . $footer['twitterimage'])) : url('/assets/imgs/theme/icons/icon-twitter-white.svg')); ?>" alt="" /></a>

                                    <a class="pintrest" href="<?php echo e(array_key_exists('pintresturl', $footer) && strlen($footer['pintresturl']) > 0 ? $footer['pintresturl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('pintrestimage', $footer) && strlen($footer['pintrestimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['pintrestimage']) : url('/images/staticImages/' . $footer['pintrestimage'])) : url('/assets/imgs/theme/icons/icon-pinterest-white.svg')); ?>" alt="" /></a>

                                    <a class="youtube" href="<?php echo e(array_key_exists('youtubeurl', $footer) && strlen($footer['youtubeurl']) > 0 ? $footer['youtubeurl'] : '#'); ?>"><img src="<?php echo e(array_key_exists('youtubeimage', $footer) && strlen($footer['youtubeimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['youtubeimage']) : url('/images/staticImages/' . $footer['youtubeimage'])) : url('/assets/imgs/theme/icons/icon-youtube-white.svg')); ?>" alt="" /></a>
                                </div>

                                <div>



                                </div>

                            </ul>

                        </div>

                    </div>



                    <hr>





                    <div class="footer-link-widget coumn-6 col widget-install-app wow animate__animated animate__fadeInUp" data-wow-delay=".5s">

                        <h4 class="widget-title">Download our Application</h4>



                        <div class="download-app">

                            <a href="<?php echo e(array_key_exists('playstoreimageurl', $footer) && strlen($footer['playstoreimageurl']) > 0 ? $footer['playstoreimageurl'] : '#'); ?>" class="hover-up mb-sm-2"><img src="<?php echo e(array_key_exists('playstoreimage', $footer) && strlen($footer['playstoreimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['playstoreimage']) : url('/images/staticImages/' . $footer['playstoreimage'])) : url('/assets/imgs/theme/google-play.jpg')); ?>" alt="" /></a>

                            <a href="<?php echo e(array_key_exists('appstoreimageurl', $footer) && strlen($footer['appstoreimageurl']) > 0 ? $footer['appstoreimageurl'] : '#'); ?>" class="hover-up mb-sm-2 mb-lg-0"><img class="active" src="<?php echo e(array_key_exists('appstoreimage', $footer) && strlen($footer['appstoreimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['appstoreimage']) : url('/images/staticImages/' . $footer['appstoreimage'])) : url('/assets/imgs/theme/app-store.jpg')); ?>" alt="" /></a>

                        </div>

                        <hr>

                        <p class="mb-20">Secured Payment Gateways</p>

                        <img class="" src="<?php echo e(array_key_exists('securepaymentimage', $footer) && strlen($footer['securepaymentimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $footer['securepaymentimage']) : url('/images/staticImages/' . $footer['securepaymentimage'])) : url('/assets/imgs/payment-strip.png')); ?>" alt="" />

                       



                    </div>

                </div>

        </section>
			
		<section class="section1">
			<div class="whatsup-sticky">
				<a href="https://wa.me/917247247070?text=Hello%2C+I+want+to+explore+more.">

                            <img src="/assets/imgs/whatsapp.png" alt="spicebucket" /></a>
			</div>	
		</section>	

        <div class="container pb-5 wow animate__animated animate__fadeInUp" data-wow-delay="0">

            <div class="row align-items-center">

                <div class="col-12 mb-10">

                    <div class="footer-bottom"></div>

                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 footer-text-copywrite-wrapper">

                    
					<p class="footer-text-copywrite">Copyright 2022 © Spice Bucket. All rights reserved.</p>

                </div>

                <div class="col-xl-8 col-lg-6 text-center d-none d-xl-block">

                    <!--<div class="hotline d-lg-inline-flex ml-25">

                        <img src="/assets/imgs/icons8-phonelink-ring.gif" alt="spicebucket" />

                        <p><a href="tel:<?php echo e(array_key_exists('supportnumber', $footer) && strlen($footer['supportnumber']) > 0 ? $footer['supportnumber'] : '+911204268011'); ?>"><?php echo e(array_key_exists('supportnumber', $footer) && strlen($footer['supportnumber']) > 0 ? $footer['supportnumber'] : '+911204268011'); ?></a><span>24/7 Support Center</span></p>

                    </div>-->

                    <div class="hotline d-lg-inline-flex ml-25">

                        <a href="https://wa.me/917247247070?text=Hello%2C+I+want+to+explore+more.">

                            <img src="/assets/imgs/icons8-whatsapp.gif" alt="spicebucket" /></a>

                        <p><a href="https://wa.me/<?php echo e(array_key_exists('whatsappnumber', $footer) && strlen($footer['whatsappnumber']) > 0 ? $footer['whatsappnumber'] : '+917247247070'); ?>?text=Hello%2C+I+want+to+explore+more."><?php echo e(array_key_exists('whatsappnumber', $footer) && strlen($footer['whatsappnumber']) > 0 ? $footer['whatsappnumber'] : '+91 7247247070'); ?></a><span>24/7 Support Center</span></p>

                    </div>

                    <div class="hotline d-lg-inline-flex ml-25">

                        <img src="/assets/imgs/icons8-secured-letter.gif" alt="spicebucket" />

                        <p><a href="mailto:<?php echo e(array_key_exists('email', $footer) && strlen($footer['email']) > 0 ? $footer['email'] : 'info@spicebucket.com'); ?>"><?php echo e(array_key_exists('email', $footer) && strlen($footer['email']) > 0 ? $footer['email'] : 'info@spicebucket.com'); ?></a></p>

                    </div>

                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block"></div>

            </div>

        </div>

    </footer>

    <!-- Preloader Start 

    <div id="preloader-active">

        <div class="preloader d-flex align-items-center justify-content-center">

            <div class="preloader-inner position-relative">

                <div class="text-center">

                    <img src="http://spicebucket.com/assets/imgs/final_gif_sb.svg" alt="" / style="width: 100px;">
                </div>

            </div>

        </div>

    </div>-->



    <!-- Quick view -->

    <div class="modal fade custom-modal" id="quick-view-modal" tabindex="-1" aria-labelledby="quick-view-modal-label" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body">

                    <!-- <div class="half-circle-spinner loading-spinner">

                        <img src="http://spicebucket.com/assets/imgs/final_gif_sb.svg" alt="" / style="width: 100px;">

                    </div> -->

                    <div class="quick-view-content"></div>

                </div>

            </div>

        </div>

    </div>

    <!-- Track your order -->

    <div class="modal fade custom-modal" id="track-your-order-modal" tabindex="-1" aria-labelledby="track-your-order-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Track Your Order</h5>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
					<form class="form-horizontal" id="track-your-order-frm" name="track-your-order-frm" method="post" action="javascript:void()">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Order ID <span class="required"></span></label>
									<input class="form-control" id="track-your-order-orderid" name="track-your-order-orderid" type="text" placeholder="Enter Order ID" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Seller <span class="required"></span></label>
									<select class="form-control" id="track-your-order-sellerid" name="track-your-order-vendorid">
										<option value="">Select Seller</option>
									</select>
								</div>
							</div>
							<div id="track-your-order-status"></div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>



    <!-- After Login popup for customer info -->

    <div class="modal fade custom-modal after-login-modal" data-backdrop="static" data-keyboard="false" id="customerInfo-modal" tabindex="-1" aria-labelledby="customerInfo-modal-label" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body">

                   <!--  <div class="half-circle-spinner loading-spinner">

                        <img src="http://spicebucket.com/assets/imgs/final_gif_sb.svg" alt="" / style="width: 100px;">

                    </div> -->

                    <div>

                        <form method="post" name="enq">

                            <div class="row">

                                <h3>Personal Information</h3>

                                <?php $name = explode(" ", Session::get('customer-loggedin-name')); ?>

                                <div class="form-group col-md-6">

                                    <label>First Name <span class="required">*</span></label>

                                    <input required="" class="form-control" id="first_name" name="first_name" type="text" placeholder="Enter First Name" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label>Last Name <span class="required">*</span></label>

                                    <input required="" value="<?php echo e(end($name)); ?>" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label>Email Address <span class="required">*</span></label>

                                    <input required="" class="form-control" name="email" id="email" type="email" placeholder="Enter Email Id" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label>Mobile<span class="required">*</span></label>

                                    <input required="" class="form-control" name="phone" id="phone" placeholder="Enter Mobile Number" />

                                </div>

                                <hr>

                                <h3>Address Details</h3>



                                <div class="form-group col-md-12">

                                    <label>Addres Line 1<span class="required">*</span></label>

                                    <input required="" class="form-control" name="addressline1" id="adddressline1" placeholder="Enter Address Line 1" />

                                </div>

                                <div class="form-group col-md-12">

                                    <label>Address Line 2</label>

                                    <input class="form-control" name="adddressline2" id="adddressline2" placeholder="Enter Address Line 2" />

                                </div>

                                <div class="form-group col-md-12">

                                    <label>Address Line 3</label>

                                    <input class="form-control" name="adddressline3" id="adddressline3" placeholder="Enter Address Line 3" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label>City<span class="required">*</span></label>

                                    <input required="" class="form-control" name="city" id="city" placeholder="Enter City" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label>State<span class="required">*</span></label>

                                    <input required="" class="form-control" name="state" id="state" placeholder="Enter State" />

                                </div>

                                <div class="form-group col-md-4">

                                    <label>Pin Code<span class="required">*</span></label>

                                    <input required="" class="form-control" name="picode" id="pincode" placeholder="Enter Pincode" />

                                </div>

                                <div class="form-group col-md-6">

                                    <label>Country<span class="required">*</span></label>

                                    <select class="form-control" id="country">

                                        <option value="">Select an option...</option>

                                        <option value="india">India</option>

                                    </select>

                                </div>

                                
                                <div class="col-md-12">

                                    <button type="button" class="btn btn-fill-out submit font-weight-bold" id="add-customer-full-details" name="submit" value="Submit">Save</button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Custom Modal for adding new address/ updating already address -->

    <div class="modal fade custom-modal" data-backdrop="static" data-keyboard="false" id="update-address-modal" tabindex="-1" aria-labelledby="update-address-modal-label" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body">

                    <form method="post" name="enq" id="update-customer-address">

                        <input type="hidden" name="update-customer-address-id" id="update-customer-address-id" value="">

                        <div class="row">

                            <h3>Address Details</h3>

                            <div class="form-group col-md-12">

                                <label>Address Type<span class="required"></span></label>
								
								<select class="form-control" id="addresstype" name="addresstype" placeholder="Enter Address Type ex: Home / office etc.">

                                    <option value="Home">Home</option>
									
									<option value="Office">Office</option>

                                </select>


                            </div>

                            <div class="form-group col-md-12">

                                <label>Full Name <span class="required"></span></label>

                                <input required="" class="form-control" id="firstname" name="firstName" type="text" placeholder="Enter Full Name" />

                            </div>

                            <div class="form-group col-md-12">

                                <label>Email Address <span class="required"></span></label>

                                <input required="" class="form-control" name="editemail" id="editemail" type="email" placeholder="Enter Email Id" />

                            </div>

                            <div class="form-group col-md-12">

                                <label>Mobile<span class="required"></span></label>

                                <input required="" class="form-control" name="editphone" id="editphone" placeholder="Enter Mobile Number" />

                            </div>

                            <div class="form-group col-md-12">

                                <label>Address Line 1<span class="required"></span></label>

                                <input required="" class="form-control" name="addressline1" id="addressline1" placeholder="Enter Address Line 1" />

                            </div>

                            <div class="form-group col-md-12">

                                <label>Address Line 2</label>

                                <input class="form-control" name="adddressline2" id="addressline2" placeholder="Enter Address Line 2" />

                            </div>
							
							<div class="form-group col-md-12">

                                <label>Pin Code<span class="required"></span></label>

                                <input required="" class="form-control" name="picode" id="editpincode" placeholder="Enter Pincode" />

                            </div>

                            <div class="form-group col-md-12">

                                <label>City<span class="required"></span></label>

                                <input required="" class="form-control" name="city" id="editcity" placeholder="Enter City" />

                            </div>



                            <div class="form-group col-md-12">

                                <label>State<span class="required"></span></label>

                                

                           
                                             
                                 <div class="wrpper-dropdown-state">
                                 <select class="form-select" aria-label="Default select  name="state"  example" id="editstate"  >
               

              <option selected>Open this select menu</option>
                       <option value="AP">Andhra Pradesh</option>
                <option value= "AR">Arunachal Pradesh</option>
                <option value= "AS">Assam</option>
                <option value= "BR">Bihar</option>
                <option value= "CG">Chhattisgarh</option>
                 <option value="GA">Goa</option>
                 <option value="GJ">Gujarat</option>
                 <option value="HR">Haryana</option>
                 <option value="HP">Himachal Pradesh</option>
                 <option value="JK">Jammu and Kashmir</option>
                <option value= "JH">Jharkhand</option>
                 <option value="KA">Karnataka</option>
                <option value= "KL">Kerala</option>
               <option value=  "MP">Madhya Pradesh</option>
               <option value=  "MH">Maharashtra</option>
                <option value= "MN">Manipur</option>
                <option value= "ML">Meghalaya</option>
                <option value= "MZ">Mizoram</option>
                <option value= "NL">Nagaland</option>
                <option value= "OR">Odisha</option>
               <option value=  "PB">Punjab</option>
                <option value= "RJ">Rajasthan</option>
                <option value= "SK">Sikkim</option>
                <option value= "TN">Tamil Nadu</option>
                <option value= "TS">Telangana</option>
                <option value= "TR">Tripura</option>
                <option value= "UA">Uttarakhand</option>
                <option value= "UP">Uttar Pradesh</option>
                <option value= "WB">West Bengal</option>
                <option value= "AN">Andaman and Nicobar Islands</option>
                <option value= "CH">Chandigarh</option>
                <option value= "DN">Dadra and Nagar Haveli</option>
                <option value= "DD">Daman and Diu</option>
               <option value=  "DL">Delhi</option>
               <option value=  "LD">Lakshadweep</option>
              <option value= "PY">Puducherry</option>
              <option value= "LA">Ladakh</option>

                              </select>
                                 </div>
                                 </div>


                            </div>
							
                            <div class="form-group col-md-12">

                                <label>Country<span class="required"></span></label>

                                <select class="form-control" id="editcountry">

                                    <option value="India">India</option>

                                </select>

                            </div>

                            

                            <div class="col-md-12">

                                <button type="button" class="btn btn-fill-out submit font-weight-bold btn-update-customer-address" name="submit" value="Submit">Save</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



    <!-- Vendor JS-->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/1.6/modernizr.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-migrate@3.4.1/dist/jquery-migrate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--<script src="/assets/js/plugins/slick.js"></script>-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- <script src="/assets/js/plugins/jquery.syotimer.min.js"></script> -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/assets/js/plugins/select2.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js" integrity="sha512-fHXRw0CXruAoINU11+hgqYvY/PcsOWzmj0QmcSOtjlJcqITbPyypc8cYpidjPurWpCnlB8VKfRwx6PIpASCUkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js" integrity="sha512-d8F1J2kyiRowBB/8/pAWsqUl0wSEOkG5KATkVV4slfblq9VRQ6MyDZVxWl2tWd+mPhuCbpTB4M7uU/x9FlgQ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="/assets/js/plugins/jquery.countdown.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js" integrity="sha512-kfs3Dt9u9YcOiIt4rNcPUzdyNNO9sVGQPiZsub7ywg6lRW5KuK1m145ImrFHe3LMWXHndoKo2YRXWy8rnOcSKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.min.js" integrity="sha512-gAHP1RIzRzolApS3+PI5UkCtoeBpdxBAtxEPsyqvsPN950Q7oD+UT2hafrcFoF04oshCGLqcSgR5dhUthCcjdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/assets/js/plugins/jquery.vticker-min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/theia-sticky-sidebar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/2.2.3/jquery.elevatezoom.min.js" integrity="sha512-UH428GPLVbCa8xDVooDWXytY8WASfzVv3kxCvTAFkxD2vPjouf1I3+RJ2QcSckESsb7sI+gv3yhsgw9ZhM7sDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    <script type="text/javascript" src="{{ asset('assets/js/main.js' )}"></script>

    <?php echo $__env->yieldPushContent('externaljavascript'); ?>

    <!-- Template  JS -->

    <script src="/assets/js/jquery-search.js?v=5.6"></script>

    <script src="/assets/js/jquery-listnav.js?v=5.6"></script>

    /* <script src="/assets/js/main.js?v=5.7"></script> */

    <script src="/assets/js/shop.js?v=5.6"></script>

    <script src="/assets/js/cart.js?v=5.10"></script>

    <script src="/assets/alertifyjs/alertify.min.js"></script>

    

<!-- google translate -->
<!--<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
<!-- google translate ends here -->


<script>
const textElements = document.querySelectorAll('.show');
let currentIndex = 0;

function showTextOneByOne() {
  if (currentIndex < textElements.length) {
    textElements[currentIndex].style.display = 'block';
    currentIndex++;
  }
}

 showTextOneByOne();

 
const interval = 2000; // Adjust this to control the timing
setInterval(showTextOneByOne, interval);


</script>

<script>
const paragraphs = document.querySelectorAll('.loop-text2 p');

function loopAnimation(index) {
  if (index >= paragraphs.length) {
    index = 0;
  }
  
  paragraphs[index].style.animation = 'none';
  paragraphs[index].offsetHeight; // Trigger reflow
  paragraphs[index].style.animation = 'moveUp 3s linear forwards';
  
  setTimeout(() => {
    loopAnimation(index + 1);
  }, 3000); // Adjust the delay to match your animation duration
}

loopAnimation(0); // Start the loop
 
$(function() {
    setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 1000)

    })
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6558489cd600b968d31470e3/1hfgdn9p4';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->







/* <?php echo $__env->yieldPushContent('javascript'); ?> */



</body>
</html>
<?php /**PATH /var/www/spicebucket/resources/views/layout.blade.php ENDPATH**/ ?>