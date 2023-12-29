

<?php $__env->startSection('content'); ?> 

 <section class="home-slider position-relative">

    <div class="containers">

        <div class="home-slide-cover desktop-view">

            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                <?php if(array_key_exists('banner', $home)): ?>
                <?php $__currentLoopData = $home['banner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="single-hero-slider single-animation-wrap">
                    <img src="<?php echo e(env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $banners) : url(env('APP_URL') . '/images/staticImages/' . $banners)); ?>" class="slider-images" />
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/new-slider1.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/new-slider2.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/new-slider3.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/new-slider4.png" class="slider-images">

                </div>
                <?php endif; ?>

            </div>

            <div class="slider-arrow hero-slider-1-arrow"></div>

        </div>

        <div class="home-slide-cover mobile-view">

            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                <?php if(array_key_exists('mobilebanner', $home)): ?>
                
                <?php $__currentLoopData = $home['mobilebanner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobilebanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="single-hero-slider single-animation-wrap">
                    <img src="<?php echo e(env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $mobilebanners) : url(env('APP_URL') . '/images/staticImages/' .  $mobilebanners)); ?>" class="slider-images">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/mobile-banner1.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/mobile-banner2.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/mobile-banner3.png" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="assets/imgs/slider/mobile-banner4.png" class="slider-images">

                </div>
                <?php endif; ?>

            </div>

            <div class="slider-arrow hero-slider-1-arrow"></div>

        </div>

    </div>

</section> 
<main class="main">

 
    <!--End hero slider-->

    <section class="popular-categories section-padding">

        <div class="container wow animate__animated animate__fadeIn">

            <div class="section-title">

                <div class="title">

                    <h3>Featured Categories</h3>

                </div>

            </div>

            <div class="carausel-8-columns-cover position-relative">

                <div class="slider-arrow slider-arrow-2 carausel-8-columns-arrow" id="carausel-8-columns-featuredcategory-arrows"></div>

                <div class="carausel-8-columns" id="carausel-8-columns-featuredcategory">

                    <?php $randombg = range(9, 15); ?>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card-2 bg-<?php echo e($randombg[array_rand($randombg)]); ?> wow animate__animated animate__fadeInUp" data-wow-delay=".1s">

                        <figure class="img-hover-scale overflow-hidden">
                             
                            <a href="/product-categories/<?php echo e(strtolower($category->slug)); ?>"><img src="/images/products/<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>" /></a>

                        </figure>

                        <h6><a href="/product-categories/<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></a>

                        </h6>

                        <span><?php echo e(count($category->product_category)); ?> items</span>

                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </div>

    </section>

    <!--End category slider-->

    <?php if(count($offers['mostpopularbrands'])>0): ?>

    <section class="banners" id="most-popular-brand">

        <div class="container">

            <div class="section-title wow animate__animate__fadeIn animated" data-wow-delay="0">

                <h3 class="">Most Popular Brands</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['mostpopularbrands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mostpopularbrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-4 col-sm-6">

                    <?php if(is_null($mostpopularbrand->vendor_id) || $mostpopularbrand->vendor_id == ""): ?>

                    <a href="/offers?category=<?php echo e($mostpopularbrand->category_id); ?>">

                        <?php else: ?>

                        <a href="/brand/<?php echo e($mostpopularbrand->vendor_slug); ?>">

                            <?php endif; ?>

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                 
                                  
                                <img src="/images/offers/<?php echo e($mostpopularbrand->imagepath); ?>" alt="<?php echo e($mostpopularbrand->heading); ?>" />
                                 

                                <div class="banner-text">

                                    <h4><?php echo e($mostpopularbrand->heading); ?></h4>

                                    <p><?php echo e($mostpopularbrand->sub_heading); ?></p>

                                </div>

                            </div>

                        </a>



                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>



    <section id="strip1">

        <div class="container">

            <div class="row">

                <div class="strip-sec1 stripSec stripDesktop mobile-view">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-6.jpg" alt="" />

                </div>

                <div class="strip-sec1 stripSec stripMobile desktop-view">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-6.jpg" alt="" />

                </div>

            </div>

        </div>

    </section>



    <?php if(count($offers['latestoffers'])>0): ?>

    <section class="section-padding pb-5 pt-0" id="latest-offer">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn">

                <h3 class="">Latest Offers</h3>

            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">

                    <div class="carausel-4-columns-cover arrow-center position-relative">

                        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-latest-arrows"></div>

                        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-latest">

                            <?php $__currentLoopData = $offers['latestoffers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(is_null($latestoffer->vendor_id) || $latestoffer->vendor_id == ""): ?>

                            <a href="/offers?category=<?php echo e($latestoffer->category_id); ?>">

                                <?php else: ?>

                                <a href="/brand/<?php echo e($latestoffer->vendor_slug); ?>">

                                    <?php endif; ?>

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0"> 
                                            <img src="/images/offers/<?php echo e($latestoffer->imagepath); ?>" alt="<?php echo e($latestoffer->heading); ?>" style="float:right;" />
                                             
                                        </div>

                                    </div>

                                </a>



                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End Latest Offers-->



    <section class="mt-10" id="full-width-banner1">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="promotional-banner">
                        <a href="https://spicebucket.com/brand/govind">
                        <img src="assets/imgs/banner/spice-buckket-banner-2.jpg" alt="" />
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </section>



    <?php if(count($offers['topsellingbrands'])>0): ?>

    <section class="banners" id="top-selling-brand">

        <div class="container">

            <div class="section-title wow animate__ animate__fadeIn animated" data-wow-delay="0">

                <h3 class="">Top Selling Brands</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['topsellingbrands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topsellingbrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-6 col-md-6">

                    <?php if(is_null($topsellingbrand->vendor_id) || $topsellingbrand->vendor_id == ""): ?>

                    <a href="/offers?category=<?php echo e($topsellingbrand->category_id); ?>">

                        <?php else: ?>

                        <a href="/brand/<?php echo e($topsellingbrand->vendor_slug); ?>">

                            <?php endif; ?>

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
 
                                <img src="/images/offers/<?php echo e($topsellingbrand->imagepath); ?>" alt="<?php echo e($topsellingbrand->heading); ?>" />
 

                                <div class="banner-text">

                                    <h4><?php echo e($topsellingbrand->heading); ?></h4>

                                    <p><?php echo e($topsellingbrand->sub_heading); ?></p>

                                </div>

                            </div>

                        </a>



                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End banners-->

    <?php if(count($offers['dealsoftheday'])>0): ?>

    <section class="section-padding pb-5" id="deal-of-the-day">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">

                <h3 class="">Deals Of The Day</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['dealsoftheday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealsofthedays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-xl-3 col-lg-4 col-md-6">



                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                <?php if(is_null($dealsofthedays->vendor_id) || $dealsofthedays->vendor_id == ""): ?>

                                <a href="/offers?category=<?php echo e($dealsofthedays->category_id); ?>">

                                    <?php else: ?>

                                    <a href="/brand/<?php echo e($dealsofthedays->vendor_slug); ?>">

                                        <?php endif; ?>

                                     
                                        <img src="/images/offers/<?php echo e($dealsofthedays->imagepath); ?>" alt="<?php echo e($dealsofthedays->heading); ?>" />

                                         

                                         

                                    </a>

                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2><span style="color:#e3273A; font-size: 24px;"><?php echo e($dealsofthedays->heading); ?></span></h2>

                                <p><?php echo e($dealsofthedays->sub_heading); ?></p>

                            </div>

                        </div>

                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End Deals-->

    <section id="slick-slider-1">

        <div class="container">

            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                <div class="single-hero-slider single-animation-wrap">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-1.jpg" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-2.jpg" class="slider-images">

                </div>

                <div class="single-hero-slider single-animation-wrap">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-3.jpg" class="slider-images">

                </div>
                
                <div class="single-hero-slider single-animation-wrap">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-4.jpg" class="slider-images">

                </div>
                
                <div class="single-hero-slider single-animation-wrap">

                    <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-5.jpg" class="slider-images">

                </div>

            </div>

            <div class="slider-arrow hero-slider-1-arrow"></div>

        </div>

    </section>



    <?php if(count($offers['highlydiscountedoffers'])>0): ?>

    <section class="section-padding pb-5" id="highly-discounted-offers">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn">

                <h3 class="">Highly Discounted Offers</h3>

            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">

                    <div class="carausel-4-columns-cover arrow-center position-relative">

                        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-highly-arrows"></div>

                        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-highly">

                            <?php $__currentLoopData = $offers['highlydiscountedoffers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlydiscountedoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(is_null($highlydiscountedoffer->vendor_id) || $highlydiscountedoffer->vendor_id == ""): ?>

                            <a href="/offers?category?=<?php echo e($highlydiscountedoffer->category_id); ?>">

                                <?php else: ?>

                                <a href="/brand/<?php echo e($highlydiscountedoffer->vendor_slug); ?>">

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0">
                                        
                                        <img src="/images/offers/<?php echo e($highlydiscountedoffer->imagepath); ?>" alt="<?php echo e($highlydiscountedoffer->heading); ?>" style="float:right;" />
 

                                        </div>

                                    </div>

                                </a>

                                <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php endif; ?>



    <?php if(count($offers['newatspicebucket'])>0): ?>

    <section class="banners" id="new-at-spice-bucket">

        <div class="container">

            <div class="section-title wow animate__ animate__fadeIn animated" data-wow-delay="0">

                <h3 class="">New At Spice Bucket</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['newatspicebucket']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newatspicebuckets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-6 col-md-6">

                    <?php if(is_null($newatspicebuckets->vendor_id) || $newatspicebuckets->vendor_id == ""): ?>

                    <a href="/offers?category?=<?php echo e($newatspicebuckets->category_id); ?>">

                        <?php else: ?>

                        <a href="/brand/<?php echo e($newatspicebuckets->vendor_slug); ?>">

                            <?php endif; ?>

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                              
                                <img src="/images/offers/<?php echo e($newatspicebuckets->imagepath); ?>" alt="<?php echo e($newatspicebuckets->heading); ?>" />
 

                                <div class="banner-text">

                                    <h4><?php echo e($newatspicebuckets->heading); ?></h4>

                                    <p><?php echo e($newatspicebuckets->sub_heading); ?></p>

                                </div>

                            </div>

                        </a>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End banners-->

    <?php if(count($offers['dailyessentialneeds'])>0): ?>

    <section class="section-padding pb-5" id="daily-essentials-needs">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">

                <h3 class="">Daily Essential Needs</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['dailyessentialneeds']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dailyessentialneed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                <?php if(is_null($dailyessentialneed->vendor_id) || $dailyessentialneed->vendor_id == ""): ?>

                                <a href="/offers?category=<?php echo e($dailyessentialneed->category_id); ?>">

                                    <?php else: ?>

                                    <a href="/brand/<?php echo e($dailyessentialneed->vendor_slug); ?>">

                                        <?php endif; ?>
                                         <?php $imagearray=array('path_folder'=>'/images/offers/','image'=>$dailyessentialneed->imagepath,'size'=>[250,250]);
                                   
                                         ?> 
                                        <img src="/images/offers/<?php echo e($dailyessentialneed->imagepath); ?>" alt="<?php echo e($dailyessentialneed->heading); ?>" />
          

                                    </a>

                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2>

                                    <span style="color:#e3273A; font-size: 24px;"><?php echo e($dailyessentialneed->heading); ?></span>

                                </h2>

                                <p><?php echo e($dailyessentialneed->sub_heading); ?></p>

                            </div>

                        </div>

                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End Deals-->



    <section>

        <div class="container">

            <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-1.jpg" alt="" />

        </div>

    </section>



    <?php if(count($offers['bestsellers'])>0): ?>

    <section class="banners mb-25" id="best-sellers">

        <div class="container">

            <div class="section-title wow animate__ animate__fadeIn animated" data-wow-delay="0">

                <h3 class="">Best Sellers</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['bestsellers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bestseller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-6 col-md-6">

                    <?php if(is_null($bestseller->vendor_id) || $bestseller->vendor_id == ""): ?>

                    <a href="/offers?category=<?php echo e($bestseller->category_id); ?>">

                        <?php else: ?>

                        <a href="/brand/<?php echo e($bestseller->vendor_slug); ?>">

                            <?php endif; ?>

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
 
                                <img src="/images/offers/<?php echo e($bestseller->imagepath); ?>" alt="<?php echo e($bestseller->heading); ?>" />
 

                                <div class="banner-text">

                                    <h4>

                                        <?php echo e($bestseller->heading); ?>


                                    </h4>

                                    <p><?php echo e($bestseller->sub_heading); ?></p>

                                </div>

                            </div>

                        </a>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End banners-->

    <?php if(count($offers['recommendedforyou'])>0): ?>

    <section class="section-padding pb-5" id="recommended-for-you">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">

                <h3 class="">Recommended For You</h3>

                <a class="show-all" href="/offers">

                    All Deals

                    <i class="fi-rs-angle-right"></i>

                </a>

            </div>

            <div class="row">

                <?php $__currentLoopData = $offers['recommendedforyou']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foryou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                <?php if(is_null($foryou->vendor_id) || $foryou->vendor_id == ""): ?>

                                <a href="/offers?category=<?php echo e($foryou->category_id); ?>">

                                    <?php else: ?>

                                    <a href="/brand/<?php echo e($foryou->vendor_slug); ?>">

                                        <?php endif; ?>

                                         
                                       <img src="/images/offers/<?php echo e($foryou->imagepath); ?>" alt="<?php echo e($foryou->heading); ?>" /> 

                                    </a>



                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2><a href="/offers"><span style="color:#e3273A; font-size: 24px;"><?php echo e($foryou->heading); ?></span></a></h2>

                                <p><?php echo e($foryou->sub_heading); ?></p>

                            </div>

                        </div>

                    </div>



                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End Deals-->



    <?php if(count($offers['popularstores'])>0): ?>

    <section class="section-padding pb-5" id="popular-stores">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn">

                <h3 class="">Popular Stores</h3>

            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">

                    <div class="carausel-4-columns-cover arrow-center position-relative">

                        <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-popular-arrows"></div>

                        <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-popular">

                            <?php $__currentLoopData = $offers['popularstores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popularstore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(is_null($popularstore->vendor_id) || $popularstore->vendor_id == ""): ?>

                            <a href="/offers?category=<?php echo e($popularstore->category_id); ?>">

                                <?php else: ?>

                                <a href="/brand/<?php echo e($popularstore->vendor_slug); ?>">

                                    <?php endif; ?>

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0">

                                            
                                           <img src="/images/offers/<?php echo e($popularstore->imagepath); ?>" alt="<?php echo e($popularstore->heading); ?>" />
 

                                        </div>

                                    </div>

                                </a>



                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php endif; ?>

    <!--End Latest Offers-->

 

    <!--End 4 columns-->

</main>



<!-- Main part -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/home.blade.php ENDPATH**/ ?>