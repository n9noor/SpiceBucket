

<?php $__env->startSection("content"); ?>

<main class="main pages">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Brands

                <span></span><?php if(is_null($selectedvendor->vendor_alias)): ?>

                <?php echo e($selectedvendor->store_name); ?>


                <?php else: ?>

                <?php echo e($selectedvendor->vendor_alias); ?>


                <?php endif; ?>



            </div>

        </div>

    </div>

    <section class="home-slider position-relative mb-10">

        <div class="container">

            <div class="archive-header-2 text-center">

                <!--<h4 class="display-2 mt-15 mb-15">
				
                    <?php $imagearray=array('path_folder'=>'/images/vendors/','image'=>$selectedvendor->image,'size'=>[250,250]);
                               
                    ?> 
                   <img src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e(is_null($selectedvendor->vendor_alias) ? $selectedvendor->store_name : ($selectedvendor->vendor_alias . '( ' . $selectedvendor->store_name . ' )')); ?>"  title="<?php echo e(is_null($selectedvendor->vendor_alias) ? $selectedvendor->store_name : ($selectedvendor->vendor_alias . '( ' . $selectedvendor->store_name . ' )')); ?>" width="150" height="150"/>
 
                </h4>-->

            </div>

        </div>

        <div class="container">

            <?php if(!is_null($selectedvendor->vendor_slider_image)): ?>

            <div class="home-slide-cover">

                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                    <?php $sliderImages = json_decode($selectedvendor->vendor_slider_image, true); ?>

                    <?php $__currentLoopData = $sliderImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="single-hero-slider single-animation-wrap">
                        <a href="<?php echo e(Route::current()->getName()); ?>?searchcategories[]=<?php echo e($image['category']); ?>&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                             
                           <img src="/images/vendors/<?php echo e($image['image']); ?>"  class="slider-images"/>
                        </a>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

            <?php else: ?>

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

            <?php endif; ?>

        </div>

    </section>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-6">

                <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0" style="visibility: visible;">

                    <?php if(!is_null($selectedvendor->vendor_offer_image_1) && !empty($selectedvendor->vendor_offer_image_1)): ?>
                    <?php $vendor_offer_image_1 = json_decode($selectedvendor->vendor_offer_image_1, true); ?>
                    <a href="<?php echo e(Route::current()->getName()); ?>?searchcategories[]=<?php echo e($vendor_offer_image_1['category']); ?>&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_1['image']) : url('/images/vendors/' . $vendor_offer_image_1['image'])); ?>" alt="" style="float:right;">
                    </a>
                    <?php else: ?>

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    <?php endif; ?>

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

                    <?php if(!is_null($selectedvendor->vendor_offer_image_2) && !empty($selectedvendor->vendor_offer_image_2)): ?>
                    <?php $vendor_offer_image_2 = json_decode($selectedvendor->vendor_offer_image_2, true); ?>
                    <a href="<?php echo e(Route::current()->getName()); ?>?searchcategories[]=<?php echo e($vendor_offer_image_2['category']); ?>&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_2['image']) : url('/images/vendors/' . $vendor_offer_image_2['image'])); ?>" alt="" style="float:right;">
                    </a>
                    <?php else: ?>

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    <?php endif; ?>

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
                    <?php if(!is_null($selectedvendor->vendor_offer_image_3) && !empty($selectedvendor->vendor_offer_image_3)): ?>
                    <?php $vendor_offer_image_3 = json_decode($selectedvendor->vendor_offer_image_3, true); ?>
                    <a href="<?php echo e(Route::current()->getName()); ?>?searchcategories[]=<?php echo e($vendor_offer_image_3['category']); ?>&min_price=0&max_price=10000&min_discount=0&max_discount=70">
                        <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_3['image']) : url('/images/vendors/' . $vendor_offer_image_3['image'])); ?>" alt="" style="float:right;">
                    </a>
                    <?php else: ?>

                    <img src="/assets/imgs/vendor-default-offer.jpeg" alt="" style="float:right;">

                    <?php endif; ?>

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
                                        <?php if(count($categories) > 0): ?>
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                            <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                            <div class="custome-checkbox ps-custom-scrollbar"><span></span>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input class="form-check-input category-filter-input" name="searchcategories[]" type="checkbox" id="category-filter-<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, (array)request()->input('searchcategories', []))): ?> checked <?php endif; ?>>

                                                <label class="form-check-label" for="category-filter-<?php echo e($category->id); ?>">

                                                    <span class="d-inline-block"><?php echo e($category->name); ?></span>

                                                </label>

                                                <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="price">
                                            <h5 class="mb-20 widget__title" data-title="Price">By Price</h5>
                                            <div class="price-filter range">
                                                <div class="price-filter-inner">
                                                    <div id="top-slider-range"></div>
                                                    <input type="hidden" class="min_price min-range" id="top-min-price" name="min_price" value="<?php echo e(Request::get('min_price', 0)); ?>" data-min="0" data-label="min price" />

                                                    <input type="hidden" class="min_price max-range" id="top-max-price" name="max_price" value="<?php echo e(Request::get('max_price', 10000)); ?>" data-max="10000" data-label="max price" />
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
                                                    <input type="hidden" class="min_price min-range" id="top-min-discount" name="min_discount" value="<?php echo e(Request::get('min_discount', 0)); ?>" data-min="0" data-label="min discount" />

                                                    <input type="hidden" class="min_price max-range" id="top-max-discount" name="max_discount" value="<?php echo e(Request::get('max_discount', 70)); ?>" data-max="70" data-label="max discount" />

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

                                    <p>We found <strong class="text-brand"><?php echo e(count($products)); ?></strong> items for you!</p>

                                </div>

                                <div class="sort-by-product-area">

                                    <div class="sort-by-cover products_sortby">

                                        <div class="sort-by-product-wrap">

                                            <div class="sort-by">

                                                <span><i class="fi-rs-apps-sort"></i>Sort by Relevance</span>

                                            </div>

                                            <div class="sort-by-dropdown-wrap">

                                                <span><span><?php echo e(Request::get('sortby')); ?></span> <i class="fi-rs-angle-small-down"></i></span>

                                            </div>

                                        </div>

                                        <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">

                                            <ul>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=price&orderby=asc">Price: Low to High</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=price&orderby=desc">Price: High to Low</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=created&orderby=desc">New Arrivals</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=discount&orderby=asc">Discount</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=rating&orderby=desc">Customer Top Rated</a></li>
                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row product-grid">

                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-6 col-sm-6">

                                    <div class="product-cart-wrap mb-30">

                                        <div class="product-img-action-wrap">

                                            <div class="product-img product-img-zoom">

                                                <a href="/product/<?php echo e($product->slug); ?>" target="_blank">
                                                    <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$product->image,'size'=>[150,150]);
                               
                                                    ?> 


                                                    <img class="default-img" src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e($product->name); ?>">

                                                    <img class="hover-img" src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e($product->name); ?>">

                                                </a>

                                            </div>

                                            <div class="product-action-1">

                                                <a aria-label="Add To Wishlist" data-product-id="<?php echo e($product->id); ?>" class="action-btn add-wishlist-btn" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>

                                            </div>

                                        </div>

                                        <div class="product-content-wrap">



                                            <div class="product-category">

                                                <a href="/product-categories/<?php echo e($product->categoryslug); ?>" target="_blank"><?php echo e($product->categoryName); ?></a>

                                            </div>



                                            <h2><a href="/product/<?php echo e($product->slug); ?>" target="_blank"><?php echo e($product->name); ?></a></h2>

                                            <div>

                                                <span class="font-small text-muted">Visit Store:

                                                    <?php if(url()->current() == env('APP_URL') . "/brand/$product->vendor_slug"): ?>

                                                    <a href="#">

                                                        <?php echo e(!is_null($product->vendorNickName) ? $product->vendorNickName : $product->vendorName); ?></a></span>

                                                <?php else: ?>

                                                <a href="/brand/<?php echo e($product->vendor_slug); ?>" target="_blank">

                                                    <?php echo e(!is_null($product->vendorNickName) ? $product->vendorNickName : $product->vendorName); ?></a></span>

                                                <?php endif; ?>

                                            </div>



                                            <div class="product-card-bottom">

                                                <div class="product-price">

                                                    <ul>

                                                        <li><span>Price: <i class="fa fa-rupee-sign"></i>

                                                                <?php echo e($product->net_price); ?></span>

                                                        </li>

                                                        <li>

                                                            MRP: <del><i class="fa fa-rupee-sign"></i><?php echo e($product->product_mrp); ?></del> (<?php echo e(number_format($product->discount_percentage,1)); ?>% off)

                                                        </li>

                                                    </ul>

                                                </div>

                                                <div class="add-cart">

                                                    <a class="add quick-view-btn-add-to-cart" data-productid="<?php echo e($product->id); ?>" href="javascript:void(0)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <div class="mt__60 mb__60 text-center">

                                    <p>No products found!</p>

                                </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                    <div id="seller-sidebar-product-filter" class="col-xl-3 primary-sidebar sticky-sidebar mt-30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                            <div class="sidebar-widget widget-area">

                                <form action="" method="GET">

                                    <?php if(count($cat_subcategories) > 0): ?>

                                    <div class="widget-category-2 mb-30 widget-filter-item">

                                        <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Categories</h5>

                                        <div class="custome-checkbox">
                                            <!-- <div class="accordion" id="accordionExample275"> -->
                                            <div class="wrapper center-block">
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <?php $__currentLoopData = $cat_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading active" role="tab" id="heacategory_<?php echo e($category['id']); ?>dingOne">
                                                                <input class="form-check-input" name="searchcategories[]" type="checkbox" id="seller-sidebar-category-filter-<?php echo e($category['id']); ?>"
                                                                    value="<?php echo e($category['id']); ?>" <?php if(in_array($category['id'] , (array)request()->input('searchcategories', []))): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="seller-sidebar-category-filter-<?php echo e($category['id']); ?>">
                                                                    <span class="d-inline-block"><?php echo e($category['name']); ?></span>
                                                                </label>
                                                                <span>
                                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCategory_<?php echo e($category['id']); ?>" aria-expanded="true" 
                                                                        aria-controls="collapseCategory_<?php echo e($category['id']); ?>">
                                                                        Load subcategories
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            <?php $__currentLoopData = $category['subcat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div id="collapseCategory_<?php echo e($category['id']); ?>" class="panel-collapse collapse in px-2" role="tabpanel" 
                                                                    aria-labelledby="category_<?php echo e($category['id']); ?>">
                                                                    <input class="form-check-input" name="searchcategories[]" type="checkbox" id="seller-sidebar-category-filter-<?php echo e($subcategory['id']); ?>" 
                                                                        value="<?php echo e($subcategory['id']); ?>" <?php if(in_array($subcategory['id'] , (array)request()->input('searchcategories', []))): ?> checked <?php endif; ?>>
                                                                    <label class="form-check-label" for="seller-sidebar-category-filter-<?php echo e($subcategory['id']); ?>">
                                                                        <span class="d-inline-block"><?php echo e($subcategory['name']); ?></span>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                           
                                                        </div>

                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>


                                    </div>

                                    <?php endif; ?>

                                    <div data-type="price" class="price_range range mb-30 widget-filter-item">

                                        <h5 class="section-title style-1 mb-30">Filter by price</h5>

                                        <div class="price-filter">

                                            <div class="price-filter-inner">

                                                <div class="price-filter range">

                                                    <div class="price-filter-inner">

                                                        <div id="slider-range"></div>

                                                        <input type="hidden" class="min_price min-range" id="min-price" name="min_price" value="<?php echo e(Request::get('min_price', 0)); ?>" data-min="0" data-label="min price" />

                                                        <input type="hidden" class="min_price max-range" id="max-price" name="max_price" value="<?php echo e(Request::get('max_price', 10000)); ?>" data-max="10000" data-label="max price" />

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

                                                        <input type="hidden" class="min_price min-range" id="min-discount" name="min_discount" value="<?php echo e(Request::get('min_discount', 0)); ?>" data-min="0" data-label="min discount" />

                                                        <input type="hidden" class="min_price max-range" id="max-discount" name="max_discount" value="<?php echo e(Request::get('max_discount', 70)); ?>" data-max="70" data-label="max discount" />

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

                    <?php $randombg = range(9, 15); ?>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card-2 bg-<?php echo e($randombg[array_rand($randombg)]); ?> wow animate__animated animate__fadeInUp" data-wow-delay=".1s">

                        <figure class="img-hover-scale overflow-hidden">

                            <a href="/product-categories/<?php echo e(strtolower($category->slug)); ?>"><img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $category->image) : url('/images/products/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" /></a>

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

    <?php if(count($popularstores) > 0): ?>

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

                            <?php $__currentLoopData = $popularstores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popularstore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(is_null($popularstore->vendor_id) || $popularstore->vendor_id == ""): ?>

                            <a href="/offers?category=<?php echo e($popularstore->category_id); ?>">

                                <?php else: ?>

                                <a href="/brand/<?php echo e($popularstore->vendor_slug); ?>">

                                    <?php endif; ?>

                                    <div class="product-cart-wrap">

                                        <div class="banner-img wow animate__animated animate__fadeInUp animated" data-wow-delay="0" style="visibility: visible;">

                                            <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/offers/' . $popularstore->imagepath) : url('/images/offers/' . $popularstore->imagepath)); ?>" alt="" style="float:right;">

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

</main>
<script type="text/javascript">
      setTimeout(function() {
        $('.title').trigger('click');
        }, 1000);

</script>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('externaljavascript'); ?>

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

<?php $__env->stopPush(); ?>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/brand.blade.php ENDPATH**/ ?>