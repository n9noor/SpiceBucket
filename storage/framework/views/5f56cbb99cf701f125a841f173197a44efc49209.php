

<?php $__env->startSection("content"); ?>



<main class="main pages">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Offers

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
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
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

                                        <div class="widget-category-2 mb-10 widget-filter-item">

                                            <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Brands</h5>

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

                                    <p>We found <strong class="text-brand"><?php echo e(count($offers)); ?></strong> offers for you!</p>

                                </div>

                                <div class="sort-by-product-area">

                                    <div class="sort-by-cover products_sortby">

                                        <div class="sort-by-product-wrap">

                                            <div class="sort-by">

                                                <span><i class="fi-rs-apps-sort"></i>Sort by</span>

                                            </div>

                                            <div class="sort-by-dropdown-wrap">

                                                <span><span><?php echo e(Request::get('sortby', 'Relevance')); ?></span> <i class="fi-rs-angle-small-down"></i></span>

                                            </div>

                                        </div>

                                        <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">

                                            <ul>

                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=created&orderby=asc">New Arrivals</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=discount&orderby=desc">Discount: High to Low</a></li>
                                                <li><a href="<?php echo e(Request::url()); ?>?min_price=<?php echo e(Request::get('min_price', 0)); ?>&max_price=<?php echo e(Request::get('max_price', 10000)); ?>&min_discount=<?php echo e(Request::get('min_discount', 0)); ?>&max_discount=<?php echo e(Request::get('max_discount', 70)); ?>&sortby=discount&orderby=asc">Discount: Low to High</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row product-grid">

                                <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12 col-sm-6">

                                    <?php if(is_null($offer->vendor_id) || $offer->vendor_id == ""): ?>

                                    <a href="/offers?category=<?php echo e($offer->category_id); ?>">

                                        <?php else: ?>

                                        <a href="/brand/<?php echo e($offer->vendor_slug); ?>">

                                            <?php endif; ?>

                                            <div class="product-cart-wrap mb-30 offers-grid">

                                                <div class="product-img-action-wrap">

                                                    <div class="product-img product-img-zoom">
                                                       
                                                        <img class="default-img" src="/images/offers/<?php echo e($offer->imagepath); ?>">

                                                        

                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <div class="mt__60 mb__60 text-center">

                                    <!--<p>No offer found!</p> -->
									<img src="<?php echo e(URL::to('/')); ?>/images/coming-soon.png" alt="coming soon" class="image">
                                </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                            <div class="sidebar-widget widget-area">

                                <form action="" method="GET">

                                    <?php if(count($categories) > 0): ?>

                                    <div class="widget-category-2 widget-filter-item">

                                        <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Categories</h5>

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

                                    <hr>


                                    <?php if(count($vendors) > 0): ?>

                                    <div class="widget-category-2 mb-10 widget-filter-item">

                                        <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Brands</h5>

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
                                    <button class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Apply</button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>
<script type="text/javascript">
      setTimeout(function() {
    $('.title').trigger('click');
  }, 1000);

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('externaljavascript'); ?>

<script src="/assets/js/plugins/slider-range.js"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/offers/index.blade.php ENDPATH**/ ?>