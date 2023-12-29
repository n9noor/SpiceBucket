@extends("layout")

@section("content")

<main class="main pages">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Brands

                <span></span>@if (is_null($selectedvendor->vendor_alias))

                {{$selectedvendor->store_name}}

                @else

                {{$selectedvendor->vendor_alias}}

                @endif



            </div>

        </div>

    </div>

    <section class="home-slider position-relative mb-10">

        <div class="container">

            <div class="archive-header-2 text-center">

                <!--<h4 class="display-2 mt-15 mb-15">
				{{--
                    @if (is_null($selectedvendor->vendor_alias))

                    {{$selectedvendor->store_name}}

                    @else

                    {{$selectedvendor->vendor_alias}}

                    @endif
				--}}
                    @php $imagearray=array('path_folder'=>'/images/vendors/','image'=>$selectedvendor->image,'size'=>[250,250]);
                               
                    @endphp 
                   <img src="{{ImageRender($imagearray)}}" alt="{{is_null($selectedvendor->vendor_alias) ? $selectedvendor->store_name : ($selectedvendor->vendor_alias . '( ' . $selectedvendor->store_name . ' )')}}"  title="{{is_null($selectedvendor->vendor_alias) ? $selectedvendor->store_name : ($selectedvendor->vendor_alias . '( ' . $selectedvendor->store_name . ' )')}}" width="150" height="150"/>
 
                </h4>-->

            </div>

        </div>

        <div class="container">

            @if(!is_null($selectedvendor->vendor_slider_image))

            <div class="home-slide-cover">

                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                    @php $sliderImages = json_decode($selectedvendor->vendor_slider_image, true); @endphp

                    @foreach($sliderImages as $image)

                    <div class="single-hero-slider single-animation-wrap">
                        <a href="{{Route::current()->getName()}}?searchcategories[]={{$image['category']}}&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                             
                           <img src="/images/vendors/{{$image['image']}}"  class="slider-images"/>
                        </a>
                    </div>

                    @endforeach

                </div>

            </div>

            @else

            <div class="home-slide-cover desktop-view mt-30">

                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                    <div class="single-hero-slider single-animation-wrap">

                        <img src="/assets/imgs/vendor-default-slider.jpeg" class="slider-images">

                    </div>

                </div>

                <div class="slider-arrow hero-slider-1-arrow"></div>

            </div>

            <div class="home-slide-cover mobile-view">

                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                    <div class="single-hero-slider single-animation-wrap">

                        <img src="/assets/imgs/vendor-default-slider.jpeg" class="slider-images">

                    </div>

                </div>

                <div class="slider-arrow hero-slider-1-arrow"></div>

            </div>

            @endif

        </div>

    </section>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-6">

                <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0" style="visibility: visible;">

                    @if(!is_null($selectedvendor->vendor_offer_image_1) && !empty($selectedvendor->vendor_offer_image_1))
                    @php $vendor_offer_image_1 = json_decode($selectedvendor->vendor_offer_image_1, true); @endphp
                    <a href="{{Route::current()->getName()}}?searchcategories[]={{$vendor_offer_image_1['category']}}&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_1['image']) : url('/images/vendors/' . $vendor_offer_image_1['image']) }}" alt="" style="float:right;">
                    </a>
                    @else

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    @endif

                    <!-- <div class="banner-text">

                        <h4>

                            Everyday Fresh &amp; <br>Clean with Our<br>

                            Products

                        </h4>0

                        <a href="javascript:void(0)" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>

                    </div> -->

                </div>

            </div>

            <div class="col-lg-4 col-md-6">

                <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">

                    @if(!is_null($selectedvendor->vendor_offer_image_2) && !empty($selectedvendor->vendor_offer_image_2))
                    @php $vendor_offer_image_2 = json_decode($selectedvendor->vendor_offer_image_2, true); @endphp
                    <a href="{{Route::current()->getName()}}?searchcategories[]={{$vendor_offer_image_2['category']}}&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_2['image']) : url('/images/vendors/' . $vendor_offer_image_2['image']) }}" alt="" style="float:right;">
                    </a>
                    @else

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    @endif

                    <!-- <div class="banner-text">

                        <h4>

                            Make your Breakfast<br>

                            Healthy and Easy

                        </h4>

                        <a href="javascript:void(0)" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>

                    </div> -->

                </div>

            </div>

            <div class="col-lg-4 d-md-none d-lg-flex">

                <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s;">
                    @if(!is_null($selectedvendor->vendor_offer_image_3) && !empty($selectedvendor->vendor_offer_image_3))
                    @php $vendor_offer_image_3 = json_decode($selectedvendor->vendor_offer_image_3, true); @endphp
                    <a href="{{Route::current()->getName()}}?searchcategories[]={{$vendor_offer_image_3['category']}}&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_3['image']) : url('/images/vendors/' . $vendor_offer_image_3['image']) }}" alt="" style="float:right;">
                    </a>
                    @else

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    @endif

                    <!-- <div class="banner-text">

                        <h4>The best Organic <br>Products Online</h4>

                        <a href="javascript:void(0)" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>

                    </div> -->

                </div>

            </div>

        </div>

    </div>



    <div class="container mb-30">

        <div class="row">

            <div class="col-lg-12 m-auto">

                <div class="row flex-row-reverse">
                    <div class="col-xl-9">
                        <div id="seller-top-product-filter" class="col-lg-12 m-auto my-5">
                            <a class="shop-filter-toggle active" href="#">
                                <span class="fi-rs-filter mr-5"></span>
                                <span class="title">Filters</span>
                                <i class="fi-rs-angle-small-up angle-up"></i>
                                <i class="fi-rs-angle-small-down angle-down"></i>
                            </a>
                            <form action="" method="GET">
                                <div class="shop-product-filter-header mb-3 page_speed_1000893246">
                                    <div class="row">
                                        <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                        @if (count($categories) > 0)
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                            <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                            <div class="custome-checkbox ps-custom-scrollbar"><span></span>
                                                @foreach($categories as $category)
                                                <input class="form-check-input category-filter-input" name="searchcategories[]" type="checkbox" id="category-filter-{{ $category->id }}" value="{{ $category->id }}" @if (in_array($category->id, (array)request()->input('searchcategories', []))) checked @endif>

                                                <label class="form-check-label" for="category-filter-{{ $category->id }}">

                                                    <span class="d-inline-block">{{$category->name}}</span>

                                                </label>

                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="price">
                                            <h5 class="mb-20 widget__title" data-title="Price">By Price</h5>
                                            <div class="price-filter range">
                                                <div class="price-filter-inner">
                                                    <div id="top-slider-range"></div>
                                                    <input type="hidden" class="min_price min-range" id="top-min-price" name="min_price" value="{{Request::get('min_price', 0)}}" data-min="0" data-label="min price" />

                                                    <input type="hidden" class="min_price max-range" id="top-max-price" name="max_price" value="{{Request::get('max_price', 10000)}}" data-max="10000" data-label="max price" />
                                                    <div class="price_slider_amount">
                                                        <div class="label-input">
                                                            <span class="d-inline-block">Range: </span>
                                                            <span id="top-slider-range-value1" class="from d-inline-block"></span>
                                                            <span id="top-slider-range-value2" class="to d-inline-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="discount">
                                            <h5 class="mb-20 widget__title" data-title="Discount">By Discount</h5>
                                            <div class="price-filter range">
                                                <div class="price-filter-inner">
                                                    <div id="top-slider-range-discount"></div>
                                                    <input type="hidden" class="min_price min-range" id="top-min-discount" name="min_discount" value="{{Request::get('min_discount', 0)}}" data-min="0" data-label="min discount" />

                                                    <input type="hidden" class="min_price max-range" id="top-max-discount" name="max_discount" value="{{Request::get('max_discount', 70)}}" data-max="70" data-label="max discount" />

                                                    <div class="price_slider_amount">
                                                        <div class="label-input">
                                                            <span class="d-inline-block">Range: </span>
                                                            <span id="top-slider-range-discount1" class="from d-inline-block"></span>
                                                            <span id="top-slider-range-discount2" class="to d-inline-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget"><button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5 ml-0"></i> Filter</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="products-listing position-relative">

                            <div class="list-content-loading">

                                <div class="half-circle-spinner">

                                    <div class="circle circle-1"></div>

                                    <div class="circle circle-2"></div>

                                </div>

                            </div>



                            <div class="shop-product-filter">

                                <div class="total-product">

                                    <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>

                                </div>

                                <div class="sort-by-product-area">

                                    <div class="sort-by-cover products_sortby">

                                        <div class="sort-by-product-wrap">

                                            <div class="sort-by">

                                                <span><i class="fi-rs-apps-sort"></i>Sort by Relevance</span>

                                            </div>

                                            <div class="sort-by-dropdown-wrap">

                                                <span><span>{{Request::get('sortby')}}</span> <i class="fi-rs-angle-small-down"></i></span>

                                            </div>

                                        </div>

                                        <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">

                                            <ul>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=price&orderby=asc">Price: Low to High</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=price&orderby=desc">Price: High to Low</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=created&orderby=desc">New Arrivals</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=discount&orderby=asc">Discount</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=rating&orderby=desc">Customer Top Rated</a></li>
                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row product-grid">

                                @forelse ($products as $product)

                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-6 col-sm-6">

                                    <div class="product-cart-wrap mb-30">

                                        <div class="product-img-action-wrap">

                                            <div class="product-img product-img-zoom">

                                                <a href="/product/{{ $product->slug }}" target="_blank">
                                                    @php $imagearray=array('path_folder'=>'/images/products/','image'=>$product->image,'size'=>[150,150]);
                               
                                                    @endphp 


                                                    <img class="default-img" src="{{ImageRender($imagearray)}}" alt="{{ $product->name }}">

                                                    <img class="hover-img" src="{{ImageRender($imagearray)}}" alt="{{ $product->name }}">

                                                </a>

                                            </div>

                                            <div class="product-action-1">

                                                <a aria-label="Add To Wishlist" data-product-id="{{$product->id}}" class="action-btn add-wishlist-btn" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>

                                            </div>

                                        </div>

                                        <div class="product-content-wrap">



                                            <div class="product-category">

                                                <a href="/product-categories/{{$product->categoryslug}}" target="_blank">{{$product->categoryName}}</a>

                                            </div>



                                            <h2><a href="/product/{{ $product->slug }}" target="_blank">{{$product->name}}</a></h2>

                                            <div>

                                                <span class="font-small text-muted">Visit Store:

                                                    @if(url()->current() == env('APP_URL') . "/brand/$product->vendor_slug")

                                                    <a href="#">

                                                        {{!is_null($product->vendorNickName) ? $product->vendorNickName : $product->vendorName}}</a></span>

                                                @else

                                                <a href="/brand/{{ $product->vendor_slug }}" target="_blank">

                                                    {{!is_null($product->vendorNickName) ? $product->vendorNickName : $product->vendorName}}</a></span>

                                                @endif

                                            </div>



                                            <div class="product-card-bottom">

                                                <div class="product-price">

                                                    <ul>

                                                        <li><span>Price: <i class="fa fa-rupee-sign"></i>

                                                                {{ $product->net_price }}</span>

                                                        </li>

                                                        <li>

                                                            MRP: <del><i class="fa fa-rupee-sign"></i>{{ $product->product_mrp}}</del> ({{number_format($product->discount_percentage,1)}}% off)

                                                        </li>

                                                    </ul>

                                                </div>

                                                <div class="add-cart">

                                                    <a class="add quick-view-btn-add-to-cart" data-productid="{{$product->id}}" href="javascript:void(0)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                @empty

                                <div class="mt__60 mb__60 text-center">

                                    <p>No products found!</p>

                                </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                    <div id="seller-sidebar-product-filter" class="col-xl-3 primary-sidebar sticky-sidebar mt-30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                            <div class="sidebar-widget widget-area">

                                <form action="" method="GET">

                                    @if (count($cat_subcategories) > 0)

                                    <div class="widget-category-2 mb-30 widget-filter-item">

                                        <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Categories</h5>

                                        <div class="custome-checkbox">
                                            <!-- <div class="accordion" id="accordionExample275"> -->
                                            <div class="wrapper center-block">
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    @foreach($cat_subcategories as $category)
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading active" role="tab" id="heacategory_{{ $category['id'] }}dingOne">
                                                                <input class="form-check-input" name="searchcategories[]" type="checkbox" id="seller-sidebar-category-filter-{{ $category['id'] }}"
                                                                    value="{{ $category['id'] }}" @if (in_array($category['id'] , (array)request()->input('searchcategories', []))) checked @endif>
                                                                <label class="form-check-label" for="seller-sidebar-category-filter-{{ $category['id'] }}">
                                                                    <span class="d-inline-block">{{$category['name']}}</span>
                                                                </label>
                                                                <span>
                                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCategory_{{ $category['id'] }}" aria-expanded="true" 
                                                                        aria-controls="collapseCategory_{{ $category['id'] }}">
                                                                        Load subcategories
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            @foreach($category['subcat'] as $subcategory)
                                                                <div id="collapseCategory_{{ $category['id'] }}" class="panel-collapse collapse in px-2" role="tabpanel" 
                                                                    aria-labelledby="category_{{ $category['id'] }}">
                                                                    <input class="form-check-input" name="searchcategories[]" type="checkbox" id="seller-sidebar-category-filter-{{ $subcategory['id'] }}" 
                                                                        value="{{ $subcategory['id'] }}" @if (in_array($subcategory['id'] , (array)request()->input('searchcategories', []))) checked @endif>
                                                                    <label class="form-check-label" for="seller-sidebar-category-filter-{{ $subcategory['id'] }}">
                                                                        <span class="d-inline-block">{{$subcategory['name']}}</span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                           
                                                        </div>

                                                        
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>


                                    </div>

                                    @endif

                                    <div data-type="price" class="price_range range mb-30 widget-filter-item">

                                        <h5 class="section-title style-1 mb-30">Filter by price</h5>

                                        <div class="price-filter">

                                            <div class="price-filter-inner">

                                                <div class="price-filter range">

                                                    <div class="price-filter-inner">

                                                        <div id="slider-range"></div>

                                                        <input type="hidden" class="min_price min-range" id="min-price" name="min_price" value="{{Request::get('min_price', 0)}}" data-min="0" data-label="min price" />

                                                        <input type="hidden" class="min_price max-range" id="max-price" name="max_price" value="{{Request::get('max_price', 10000)}}" data-max="10000" data-label="max price" />

                                                        <div class="price_slider_amount">

                                                            <div class="label-input">

                                                                <span class="d-inline-block">Range: </span>

                                                                <span id="slider-range-value1" class="from d-inline-block"></span>

                                                                <span id="slider-range-value2" class="to d-inline-block"></span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <br>

                                        <h5 class="section-title style-1 mb-30">Filter by discount</h5>

                                        <div class="price-filter">

                                            <div class="price-filter-inner">

                                                <div class="price-filter range">

                                                    <div class="price-filter-inner">

                                                        <div id="slider-range-discount"></div>

                                                        <input type="hidden" class="min_price min-range" id="min-discount" name="min_discount" value="{{Request::get('min_discount', 0)}}" data-min="0" data-label="min discount" />

                                                        <input type="hidden" class="min_price max-range" id="max-discount" name="max_discount" value="{{Request::get('max_discount', 70)}}" data-max="70" data-label="max discount" />

                                                        <div class="price_slider_amount">

                                                            <div class="label-input">

                                                                <span class="d-inline-block">Range: </span>

                                                                <span id="slider-range-discount1" class="from d-inline-block"></span>

                                                                <span id="slider-range-discount2" class="to d-inline-block"></span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <button class="btn btn-sm btn-default mt-3"><i class="fi-rs-filter mr-5"></i> Apply</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

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

                            <a href="/product-categories/{{ strtolower($category->slug) }}"><img src="{{ env('APP_ENV') == 'production' ? url('/public/images/products/' . $category->image) : url('/images/products/' . $category->image) }}" alt="{{ $category->name }}" /></a>

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

    @if(count($popularstores) > 0)

    <section class="section-padding pb-5" id="popular-stores">

        <div class="container">

            <div class="section-title wow animate__animated animate__fadeIn">

                <h3 class="">Recommended Brands for You</h3>

            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">

                    <div class="carausel-6-columns-cover arrow-center position-relative">

                        <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-popular-arrows"></div>

                        <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-popular">

                            @foreach($popularstores as $popularstore)

                            @if(is_null($popularstore->vendor_id) || $popularstore->vendor_id == "")

                            <a href="/offers?category={{$popularstore->category_id}}">

                                @else

                                <a href="/brand/{{$popularstore->vendor_slug}}">

                                    @endif

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0" style="visibility: visible;">

                                            <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/offers/' . $popularstore->imagepath) : url('/images/offers/' . $popularstore->imagepath) }}" alt="" style="float:right;">

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

</main>
<script type="text/javascript">
      setTimeout(function() {
        $('.title').trigger('click');
        }, 1000);

</script>



@endsection

@push('externaljavascript')

<script src="/assets/js/plugins/slider-range.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script type="text/javascript">
        $('.panel-collapse').on('show.bs.collapse', function () {
            $(this).siblings('.panel-heading').addClass('active');
        });

        $('.panel-collapse').on('hide.bs.collapse', function () {
            $(this).siblings('.panel-heading').removeClass('active');
        });
</script>

@endpush