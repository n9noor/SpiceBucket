
<?php $__env->startSection("content"); ?>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
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
                                        <?php if(count($categories) > 0): ?>
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" style="display: none;">
                                            <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                            <div class="custome-checkbox ps-custom-scrollbar"><span></span>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input class="form-check-input category-filter-input" name="searchcategories[]" type="checkbox" id="top-category-filter-<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, (array)request()->input('searchcategories', []))): ?> checked <?php endif; ?>>

                                                <label class="form-check-label" for="top-category-filter-<?php echo e($category->id); ?>">

                                                    <span class="d-inline-block"><?php echo e($category->name); ?></span>

                                                </label>

                                                <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(count($vendors) > 0): ?>
                                        <div class="widget-category-2 mb-30 widget-filter-item">
                                            <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Brands</h5>
                                            <div class="custome-checkbox">
                                                <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input class="form-check-input" name="searchbrands[]" type="checkbox" id="top-brand-filter-<?php echo e($brand->id); ?>" value="<?php echo e($brand->id); ?>" <?php if(in_array($brand->id, (array)request()->input('searchbrands', []))): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="top-brand-filter-<?php echo e($brand->id); ?>">
                                                    <span class="d-inline-block"><?php echo e(is_null($brand->vendor_alias) ? $brand->store_name : $brand->vendor_alias); ?></span>
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
                                                <span><i class="fi-rs-apps-sort"></i>Sort by</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span><span>Featured</span> <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">
                                            <ul>
                                                <li><a class="active" href="#">Featured</a></li>
                                                <li><a href="#">Price: Low to High</a></li>
                                                <li><a href="#">Price: High to Low</a></li>
                                                <li><a href="#">Release Date</a></li>
                                                <li><a href="#">Avg. Rating</a></li>
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
                                                <a href="/product/<?php echo e($product->slug); ?>">
                                                    <img class="default-img" src="<?php echo e((env('APP_ENV') == "production" ? url('/public/images/products/' . $product->image) : url('/images/products/' . $product->image))); ?>" alt="<?php echo e($product->name); ?>">
                                                    <img class="hover-img" src="<?php echo e((env('APP_ENV') == "production" ? url('/public/images/products/' . $product->image) : url('/images/products/' . $product->image))); ?>" alt="<?php echo e($product->name); ?>">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a data-product-id="<?php echo e($product->id); ?>" class="action-btn add-wishlist-btn fill-and-blank" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">

                                            <div class="product-category">
                                                <a href="/product-categories/<?php echo e(strtolower($product->categoryslug)); ?>"><?php echo e($product->categoryName); ?></a>
                                            </div>

                                            <h2><a href="/product/<?php echo e($product->slug); ?>"><?php echo e($product->name); ?></a></h2>
                                            <div>
                                                <span class="font-small text-muted">Visit Store: <a target="_blank" href="/brand/<?php echo e($product->vendor_slug); ?>"><?php echo e(!is_null($product->vendorNickName) && !empty($product->vendorNickName) ? $product->vendorNickName :$product->vendorName); ?></a></span>
                                            </div>
                                            <?php $discountPrice = ($product->product_mrp - $product->netPrice);
                                            $discountPercentage = ($discountPrice/$product->product_mrp)*100;
                                            ?>
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <ul>
                                                        <li><span>Price: <i class="fa fa-rupee-sign"></i>
                                                                <?php echo e($product->netPrice); ?></span>
                                                        </li>
                                                        <li>
                                                            MRP: <del><i class="fa fa-rupee-sign"></i><?php echo e($product->product_mrp); ?></del> (<?php echo e(number_format($discountPercentage,1)); ?>% off)
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--
                                        <div class="add-cart">
                                            <a class="add quick-view-btn-add-to-cart" data-productid="<?php echo e($product->id); ?>" href="javascript:void(0)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
										-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="mt__60 mb__60 text-center no-data">
                                    <!--<p>No products found!</p>-->
                                    <img src="<?php echo e(URL::to('/')); ?>/images/coming-soon.png" alt="coming soon" class="image">

                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                            <div class="sidebar-widget widget-area">
                                <form action="" method="GET">
                                    <?php if(count($categories) > 0): ?>
                                    <div class="widget-category-2 mb-30 widget-filter-item">
                                        <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Sub Categories</h5>
                                        <div class="custome-checkbox">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input class="form-check-input" name="searchcategories[]" type="checkbox" id="category-filter-<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, (array)request()->input('searchcategories', []))): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="category-filter-<?php echo e($category->id); ?>">
                                                <span class="d-inline-block"><?php echo e($category->name); ?></span>
                                            </label>
                                            <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <br>
                                    <?php if(count($vendors) > 0): ?>
                                    <div class="widget-category-2 mb-30 widget-filter-item">
                                        <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Brands</h5>
                                        <div class="custome-checkbox">
                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input class="form-check-input" name="searchbrands[]" type="checkbox" id="brand-filter-<?php echo e($brand->id); ?>" value="<?php echo e($brand->id); ?>" <?php if(in_array($brand->id, (array)request()->input('searchbrands', []))): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="brand-filter-<?php echo e($brand->id); ?>">
                                                <span class="d-inline-block"><?php echo e(is_null($brand->vendor_alias) ? $brand->store_name : $brand->vendor_alias); ?></span>
                                            </label>
                                            <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <br>
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
                                    </div>
                                    <button class="btn btn-sm btn-default mt-3"><i class="fi-rs-filter mr-5"></i> Apply</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('externaljavascript'); ?>
<script src="/assets/js/plugins/slider-range.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/shop.blade.php ENDPATH**/ ?>