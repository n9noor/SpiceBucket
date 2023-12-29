@extends('layout')

@section('content') 

 <section class="home-slider position-relative">

    <div class="containers">

        <div class="home-slide-cover desktop-view">

            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                @if(array_key_exists('banner', $home))
                @foreach($home['banner'] as $banners) <div class="single-hero-slider single-animation-wrap">
                    <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $banners) : url(env('APP_URL') . '/images/staticImages/' . $banners) }}" class="slider-images" />
                </div>
                @endforeach
                @else
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
                @endif

            </div>

            <div class="slider-arrow hero-slider-1-arrow"></div>

        </div>

        <div class="home-slide-cover mobile-view">

            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                @if(array_key_exists('mobilebanner', $home))
                
                @foreach($home['mobilebanner'] as $mobilebanners) <div class="single-hero-slider single-animation-wrap">
                    <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $mobilebanners) : url(env('APP_URL') . '/images/staticImages/' .  $mobilebanners)}}" class="slider-images">
                </div>
                @endforeach
                @else

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
                @endif

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

                    @php $randombg = range(9, 15); @endphp

                    @foreach ($categories as $category)

                    <div class="card-2 bg-{{ $randombg[array_rand($randombg)] }} wow animate__animated animate__fadeInUp" data-wow-delay=".1s">

                        <figure class="img-hover-scale overflow-hidden">
                             
                            <a href="/product-categories/{{ strtolower($category->slug) }}"><img src="/images/products/{{$category->image}}" alt="{{ $category->name }}" /></a>

                        </figure>

                        <h6><a href="/product-categories/{{ $category->slug }}">{{ $category->name }}</a>

                        </h6>

                        <span>{{ count($category->product_category) }} items</span>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

    <!--End category slider-->

    @if(count($offers['mostpopularbrands'])>0)

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

                @foreach($offers['mostpopularbrands'] as $mostpopularbrand)

                <div class="col-md-4 col-sm-6">

                    @if(is_null($mostpopularbrand->vendor_id) || $mostpopularbrand->vendor_id == "")

                    <a href="/offers?category={{$mostpopularbrand->category_id}}">

                        @else

                        <a href="/brand/{{$mostpopularbrand->vendor_slug}}">

                            @endif

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                 
                                  
                                <img src="/images/offers/{{ $mostpopularbrand->imagepath}}" alt="{{$mostpopularbrand->heading}}" />
                                 

                                <div class="banner-text">

                                    <h4>{{$mostpopularbrand->heading}}</h4>

                                    <p>{{$mostpopularbrand->sub_heading}}</p>

                                </div>

                            </div>

                        </a>



                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif



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



    @if(count($offers['latestoffers'])>0)

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

                            @foreach($offers['latestoffers'] as $latestoffer)

                            @if(is_null($latestoffer->vendor_id) || $latestoffer->vendor_id == "")

                            <a href="/offers?category={{$latestoffer->category_id}}">

                                @else

                                <a href="/brand/{{$latestoffer->vendor_slug}}">

                                    @endif

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0"> 
                                            <img src="/images/offers/{{$latestoffer->imagepath}}" alt="{{$latestoffer->heading}}" style="float:right;" />
                                             
                                        </div>

                                    </div>

                                </a>



                                @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    @endif

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



    @if(count($offers['topsellingbrands'])>0)

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

                @foreach($offers['topsellingbrands'] as $topsellingbrand)

                <div class="col-lg-6 col-md-6">

                    @if(is_null($topsellingbrand->vendor_id) || $topsellingbrand->vendor_id == "")

                    <a href="/offers?category={{$topsellingbrand->category_id}}">

                        @else

                        <a href="/brand/{{$topsellingbrand->vendor_slug}}">

                            @endif

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
 
                                <img src="/images/offers/{{$topsellingbrand->imagepath}}" alt="{{$topsellingbrand->heading}}" />
 

                                <div class="banner-text">

                                    <h4>{{$topsellingbrand->heading}}</h4>

                                    <p>{{$topsellingbrand->sub_heading}}</p>

                                </div>

                            </div>

                        </a>



                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif

    <!--End banners-->

    @if(count($offers['dealsoftheday'])>0)

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

                @foreach($offers['dealsoftheday'] as $dealsofthedays)

                <div class="col-xl-3 col-lg-4 col-md-6">



                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                @if(is_null($dealsofthedays->vendor_id) || $dealsofthedays->vendor_id == "")

                                <a href="/offers?category={{$dealsofthedays->category_id}}">

                                    @else

                                    <a href="/brand/{{$dealsofthedays->vendor_slug}}">

                                        @endif

                                     
                                        <img src="/images/offers/{{$dealsofthedays->imagepath}}" alt="{{$dealsofthedays->heading}}" />

                                         

                                         

                                    </a>

                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2><span style="color:#e3273A; font-size: 24px;">{{$dealsofthedays->heading}}</span></h2>

                                <p>{{$dealsofthedays->sub_heading}}</p>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif

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



    @if(count($offers['highlydiscountedoffers'])>0)

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

                            @foreach($offers['highlydiscountedoffers'] as $highlydiscountedoffer)

                            @if(is_null($highlydiscountedoffer->vendor_id) || $highlydiscountedoffer->vendor_id == "")

                            <a href="/offers?category?={{$highlydiscountedoffer->category_id}}">

                                @else

                                <a href="/brand/{{$highlydiscountedoffer->vendor_slug}}">

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0">
                                        
                                        <img src="/images/offers/{{$highlydiscountedoffer->imagepath}}" alt="{{$highlydiscountedoffer->heading}}" style="float:right;" />
 

                                        </div>

                                    </div>

                                </a>

                                @endif

                                @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    @endif



    @if(count($offers['newatspicebucket'])>0)

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

                @foreach($offers['newatspicebucket'] as $newatspicebuckets)

                <div class="col-lg-6 col-md-6">

                    @if(is_null($newatspicebuckets->vendor_id) || $newatspicebuckets->vendor_id == "")

                    <a href="/offers?category?={{$newatspicebuckets->category_id}}">

                        @else

                        <a href="/brand/{{$newatspicebuckets->vendor_slug}}">

                            @endif

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                              
                                <img src="/images/offers/{{$newatspicebuckets->imagepath}}" alt="{{$newatspicebuckets->heading}}" />
 

                                <div class="banner-text">

                                    <h4>{{$newatspicebuckets->heading}}</h4>

                                    <p>{{$newatspicebuckets->sub_heading}}</p>

                                </div>

                            </div>

                        </a>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif

    <!--End banners-->

    @if(count($offers['dailyessentialneeds'])>0)

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

                @foreach($offers['dailyessentialneeds'] as $dailyessentialneed)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                @if(is_null($dailyessentialneed->vendor_id) || $dailyessentialneed->vendor_id == "")

                                <a href="/offers?category={{$dailyessentialneed->category_id}}">

                                    @else

                                    <a href="/brand/{{$dailyessentialneed->vendor_slug}}">

                                        @endif
                                         @php $imagearray=array('path_folder'=>'/images/offers/','image'=>$dailyessentialneed->imagepath,'size'=>[250,250]);
                                   
                                         @endphp 
                                        <img src="/images/offers/{{$dailyessentialneed->imagepath}}" alt="{{$dailyessentialneed->heading}}" />
          

                                    </a>

                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2>

                                    <span style="color:#e3273A; font-size: 24px;">{{$dailyessentialneed->heading}}</span>

                                </h2>

                                <p>{{$dailyessentialneed->sub_heading}}</p>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif

    <!--End Deals-->



    <section>

        <div class="container">

            <img src="/assets/imgs/slider/home/Spice-Bucket-Slide-1.jpg" alt="" />

        </div>

    </section>



    @if(count($offers['bestsellers'])>0)

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

                @foreach($offers['bestsellers'] as $bestseller)

                <div class="col-lg-6 col-md-6">

                    @if(is_null($bestseller->vendor_id) || $bestseller->vendor_id == "")

                    <a href="/offers?category={{$bestseller->category_id}}">

                        @else

                        <a href="/brand/{{$bestseller->vendor_slug}}">

                            @endif

                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
 
                                <img src="/images/offers/{{$bestseller->imagepath}}" alt="{{$bestseller->heading}}" />
 

                                <div class="banner-text">

                                    <h4>

                                        {{$bestseller->heading}}

                                    </h4>

                                    <p>{{$bestseller->sub_heading}}</p>

                                </div>

                            </div>

                        </a>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    @endif

    <!--End banners-->

    @if(count($offers['recommendedforyou'])>0)

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

                @foreach($offers['recommendedforyou'] as $foryou)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">

                        <div class="product-img-action-wrap">

                            <div class="product-img">

                                @if(is_null($foryou->vendor_id) || $foryou->vendor_id == "")

                                <a href="/offers?category={{$foryou->category_id}}">

                                    @else

                                    <a href="/brand/{{$foryou->vendor_slug}}">

                                        @endif

                                         
                                       <img src="/images/offers/{{$foryou->imagepath}}" alt="{{$foryou->heading}}" /> 

                                    </a>



                            </div>

                        </div>

                        <div class="product-content-wrap">

                            <div class="deals-content">

                                <h2><a href="/offers"><span style="color:#e3273A; font-size: 24px;">{{$foryou->heading}}</span></a></h2>

                                <p>{{$foryou->sub_heading}}</p>

                            </div>

                        </div>

                    </div>



                </div>

                @endforeach



            </div>

        </div>

    </section>

    @endif

    <!--End Deals-->



    @if(count($offers['popularstores'])>0)

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

                            @foreach($offers['popularstores'] as $popularstore)

                            @if(is_null($popularstore->vendor_id) || $popularstore->vendor_id == "")

                            <a href="/offers?category={{$popularstore->category_id}}">

                                @else

                                <a href="/brand/{{$popularstore->vendor_slug}}">

                                    @endif

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0">

                                            
                                           <img src="/images/offers/{{$popularstore->imagepath}}" alt="{{$popularstore->heading}}" />
 

                                        </div>

                                    </div>

                                </a>



                                @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    @endif

    <!--End Latest Offers-->

 

    <!--End 4 columns-->

</main>



<!-- Main part -->

@endsection