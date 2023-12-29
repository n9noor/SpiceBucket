

<?php $__env->startSection('content'); ?>

<!-- vikash new css file starting  -->
<style>
    .container .row .pdp-image2-gallery-block {
        display: none !important;
    }

@media only screen and (min-width: 268px) and (max-width: 968px) {
    
        .container .row .pdp-image-gallery-block {
            display: none !important;


        }

        .detail-info .detail-extralink .detail-qty {
            max-width: 38px !important;
        }

        /*.product-detail .container .row>*{
    width: 100% !important;
    max-width: 100%;
}*/
        .container .row .pdp-image2-gallery-block {
            display: block !important;
        }

        .carousel-indicators [data-bs-target] {
            background-color: black;
        }
    }
</style>


<!-- vikash new css file ending -->

<main class="main pages">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span><a href="/brand/<?php echo e($product->vendor_slug); ?>"><?php echo e((is_null($product->vendorNickName) || empty($product->vendorNickName)) ? $product->vendorName : $product->vendorNickName); ?></a>

                <span></span> <?php echo e($product->name); ?>


            </div>

        </div>

    </div>

    <div class="">

        <input type="hidden" name="quickview_productid" id="quickview_productid" value="<?php echo e($product->id); ?>" />

        <input type="hidden" name="vendor_shipping_pincode" id="vendor_shipping_pincode" value="<?php echo e($product->vendor_shipping_pincode); ?>" />

        <div class="product-detail accordion-detail">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 mb-md-0 mb-sm-5 pdp-image-gallery-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="gallery_pdp_container">

                                    <div id="gallery_pdp">

                                        <?php $images = explode(",", $product->images); ?>

                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php $varianttimages = !is_null($image) ? explode("|", $image) : array(); ?>

                                        <a href="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>" data-image="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>" data-zoom-image="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>"><img class="img-thumbnail small_img" src="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>" alt="<?php echo e($product->name); ?>"></a>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                    <a href="#" id="ui-carousel-next"><i class="fa fa-solid fa-arrow-down"></i></a>
                                    <a href="#" id="ui-carousel-prev"><i class="fa fa-solid fa-arrow-up"></i></a>

                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="gallery-viewer">

                                    <img id="zoom_10" width="100%" height="100%" src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $product->defaultImage) : url('/images/products/' . $product->defaultImage)); ?>" data-zoom-image="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $product->defaultImage) : url('/images/products/' . $product->defaultImage)); ?>" class="big_img" />

                                    <p class="hint-pdp-img">Roll over the image to zoom in</p>

                                </div>
                            </div>
                        </div>
                        

                        

                    </div>


                    <!-- new crowsel add starting  -->
                    <div class="col-md-6 pdp-image2-gallery-block w-100">
                        <ul id="imageGallery">

                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $varianttimages = !is_null($image) ? explode("|", $image) : array(); ?>
                            <li data-thumb="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>" data-src="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>">
                                <img src="<?php echo e(array_key_exists(1, $varianttimages) ? (env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])) : url('/assets/imgs/no-image-placeholder.png')); ?>" data-slide-no="<?php echo e($key); ?>" />
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- new crowsel add enidng -->

                    <div class="col-md-6  product-details">

                        <div class="detail-info pr-30 pl-30">

                            <h2 class="title-detail"><?php echo e(ucfirst($product->name)); ?></h2>

                            <div class="clearfix product-price-cover">

                                <div class="product-price primary-color float-left"> 
                                    <span class="current-price text-brand">
                                        <i class="fa fa-rupee-sign"></i> 
                                        <span id="product-price"><?php echo e($product->netPrice); ?></span>
                                    </span>

                                    <span> 
                                        <span class="save-price font-md color3 ml-15"> 
                                            <span class="percentage-off">(<?php echo e(number_format($product->discountPercentage, 1)); ?>% off)</span> 
                                        </span> 
                                        
                                    </span>
                                </div>
                                

                            </div>
                            <div class="old-pricing-sec">
                                    
                                    <span class="product-mrp-name">M.R.P</span>
                                        
                                            <del><span class="old-price font-md ml-5" id="product-mrp"> <?php echo e($product->product_mrp); ?>

                                            </span></del> (Incl. of all taxes) 
                                </div>

                            <div class="short-desc mb-10">



                                <p>Visit: <a href="/brand/<?php echo e($product->vendor_slug); ?>"><strong><?php echo e((is_null($product->vendorNickName) || empty($product->vendorNickName)) ? $product->vendorName : $product->vendorNickName); ?></strong></a></p>

                                <p>

                                    <?php echo e($product->summary); ?>


                                </p>



                            </div>

                            <div class="pr_switch_wrap">

                                <div class="product-attributes">

                                    <input type="hidden" name="product-price-variant-id" id="product-price-variant-id" value="<?php echo e($product->variantpriceid); ?>" />

                                    <div class="row">

                                        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php

                                        $variantvalues = explode(',', $variant->variantvalues);
                                        if(!array_key_exists($variant->id ,$variantAvailable)) continue;  
                                        ?>

                                        <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color">

                                            <label class="attribute-name"><?php echo e($variant->name); ?></label>

                                            <div class="attribute-values">

                                                <div class="dropdown-swatch">

                                                    <label>

                                                        <ul class="text-swatch attribute-swatch color-swatch">
                                                            
                                                            <?php $__currentLoopData = $variantvalues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <?php $variantvalue = explode("|", $values) ?>

                                                            <?php if(in_array($variantvalue[1], $productsvariants)): ?>

                                                            <li data-id="<?php echo e($variantvalue[1]); ?>" class="attribute-swatch-item ">

                                                                <div><label><input type="radio" name="attribute_<?php echo e(strtolower($variant->name)); ?>" value="<?php echo e($variantvalue[1]); ?>" <?php echo e(in_array($variantvalue[1], array($product->variant1, $product->variant2, $product->variant3))?" checked='selected'":''); ?> class="product-filter-item"><span><?php echo e($variantvalue[0]); ?></span></label></div>

                                                            </li>

                                                            <?php endif; ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </ul>

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                </div>

                            </div>

                            <form class="add-to-cart-form" method="POST" action="javascript:void(0)">


                                <div class="detail-extralink mb-25 row">

                                    <div class="col-md-2 col-sm-4 pr0">
                                        <div class="quantity-design">
                                            <div class="detail-sign ">

                                                <a href="javascript:void(0)" id="quantity-minus-<?php echo e($product->id); ?>" class="qty-down quantity__minus"><i class="fi-rs-minus"></i></a>

                                            </div>

                                            <div class="detail-qty border radius">

                                                <input type="text" id="quantity-input-<?php echo e($product->id); ?>" min="<?php echo e($product->minoq); ?>" value="<?php echo e($product->minoq); ?>" name="qty" class="qty-val qty-input quantity__input" readonly />

                                                <input type="hidden" id="min-quantity-input-<?php echo e($product->id); ?>" value="<?php echo e($product->minoq); ?>" name="min-quantity-input" />

                                                <input type="hidden" id="max-quantity-input-<?php echo e($product->id); ?>" value="<?php echo e($product->maxoq); ?>" name="max-quantity-input" />

                                            </div>

                                            <div class="detail-sign">

                                                <a href="javascript:void(0)" class="qty-up quantity__plus" id="quantity-plus-<?php echo e($product->id); ?>"><i class="fi-rs-plus"></i></a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 col-sm-8">
                                        <div class="product-extra-link2 has-buy-now-buttonx">

                                            <?php if($product->qty >= $product->minoq): ?>

                                            <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i><span class="addcart-button-text">Add To Cart</span></button>
                                            <button type="submit" class="button buy-now"><i class="fi-rs-shopping-cart"></i><span class="buynow-button-text"> Buy Now</span></button>

                                            <?php else: ?>

                                            <button type="submit" class="button"><i class="fi-rs-shopping-cart"></i><span class="addcart-button-text">Item Sold Out</span></button>

                                            <?php endif; ?>

                                            <a aria-label="Add To Wishlist" class="action-btn hover-up js-add-to-wishlist-button add-wishlist-btn" aria-label="Add To Wishlist" data-product-id="<?php echo e($product->id); ?>" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>

                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="font-xs innner-bread">

                                <ul>

                                    <li class="" style="margin-top:0px;"> <span class="d-inline-block">Categories:</span> <a href="/product-categories/<?php echo e($product->category_slug); ?>" title="<?php echo e($product->categoryName); ?>"><?php echo e($product->categoryName); ?></a>

                                        > <a href="javascript:void(0)" title="<?php echo e($product->subCategoryName); ?>"><?php echo e($product->subCategoryName); ?></a> </li>

                                </ul>

                            </div>



                            <div class="row pr-30">

                                

                                
                                <div class="col-md-12 pincode-deliver-wrapper">
                                    <div class="row">
                                        <label style="margin-top:5px;" class="col-md-3 pr0 control-label" for="checkpincode">Deliver to: </label>
                                        <div class="col-md-9">

                                    <div class="input-group checkPin-input">

                                        <input class="form-control" type="text" id="checkpincode" name="checkpincode" />

                                        <button id="checkButton" type="button" class="btn btn-secondary" style="cursor:pointer" placeholder="Enter delivery code" onclick="verify()"><!--<i class="fa fa-check"></i> -->Check</button>

                                        <br>

                                    </div>

                                    <p id="check-pincode-availability-text"></p>

                                </div>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>

                            </div>









                        </div>
                    </div>
                </div>

                <div id="enlarge_gallery_pdp">

                    <div class="enl_butt">

                        <a class="enl_but enl_fclose" title="Close"></a>

                        <a class="enl_but enl_fright" title="Next"></a>

                        <a class="enl_but enl_fleft" title="Prev"></a>

                    </div>

                    <div class="mega_enl"></div>

                </div>

                <div class="product-info">

                    <div class="tab-style3">

                        <ul class="nav nav-tabs text-uppercase">

                            <li class="nav-item"><a id="Description-tab" data-bs-toggle="tab" href="#Description" class="nav-link active">Description</a></li>

                            <li class="nav-item"><a id="Reviews-tab" data-bs-toggle="tab" href="#Reviews" class="nav-link">Reviews</a></li>

                            <!-- <li class="nav-item"><a data-bs-toggle="tab" href="#tab-vendor" class="nav-link">Vendor</a></li> -->

                            <li class="nav-item"><a data-bs-toggle="tab" href="#tab-faq" class="nav-link">Q & A</a></li>

                        </ul>

                        <div class="tab-content shop_info_tab entry-main-content">

                            <div id="Description" class="tab-pane fade show active">

                                <?php echo $product->description; ?>


                            </div>

                            <!--
                            <div id="tab-vendor" class="tab-pane fade">

                                <div class="vendor-logo d-flex mb-30"><img src="/assets/imgs/no-image-available.jpg" alt="<?php echo e($product->vendorName); ?>">

                                    <div class="vendor-name ml-15">

                                        <h6><a href="/brand/<?php echo e($product->vendor_slug); ?>"><?php echo e($product->vendorName); ?></a></h6>

                                        <!-- <div class="product-rate-cover text-end">

                                        <div class="product-rate d-inline-block">

                                            <div class="product-rating page_speed_2130101604"></div>

                                        </div><span class="font-small ml-5 text-muted"> (20 reviews)</span>

                                    </div> -->


                            <!--<ul class="contact-infor mb-50">

                                    <li><img src="/assets/imgs/icon-location.svg" alt="Address"><strong>Address: </strong><span><?php echo e($product->vendor_address); ?></span></li>

                                    <li><img src="/assets/imgs/icon-contact.svg" alt="Contact Seller"><strong>Contact Seller:</strong><span>(+91) - <?php echo e($product->vendor_phone); ?></span></li>

                                </ul>

                                <div> Facere debitis autem aut officiis. Vero rem et dolor aliquam molestiae. Rerum maiores labore eum. </div> 

                            </div>
-->

                            <div id="tab-faq" class="tab-pane fade faqs-list">

                                <!-- <div id="faq-accordion" class="accordion">

                                <div class="card">

                                    <div id="heading-faq-0" class="card-header">

                                        <h2 class="mb-0"><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-0" aria-expanded="true" aria-controls="collapse-faq-0" class="btn btn-link btn-block text-left "> What Shipping Methods Are Available? </button></h2>

                                    </div>

                                    <div id="collapse-faq-0" aria-labelledby="heading-faq-0" data-parent="#faq-accordion" class="collapse show ">

                                        <div class="card-body"> Ex Portland Pitchfork irure mustache. Eutra fap before they sold out literally. Aliquip ugh bicycle rights actually mlkshk, seitan squid craft beer tempor. </div>

                                    </div>

                                </div>

                                <div class="card">

                                    <div id="heading-faq-1" class="card-header">

                                        <h2 class="mb-0"><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-1" aria-expanded="true" aria-controls="collapse-faq-1" class="btn btn-link btn-block text-left collapsed "> Do You Ship Internationally? </button></h2>

                                    </div>

                                    <div id="collapse-faq-1" aria-labelledby="heading-faq-1" data-parent="#faq-accordion" class="collapse ">

                                        <div class="card-body"> Hoodie tote bag mixtape tofu. Typewriter jean shorts wolf quinoa, messenger bag organic freegan cray. </div>

                                    </div>

                                </div>

                                <div class="card">

                                    <div id="heading-faq-2" class="card-header">

                                        <h2 class="mb-0"><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-2" aria-expanded="true" aria-controls="collapse-faq-2" class="btn btn-link btn-block text-left collapsed "> How Long Will It Take To Get My Package? </button></h2>

                                    </div>

                                    <div id="collapse-faq-2" aria-labelledby="heading-faq-2" data-parent="#faq-accordion" class="collapse ">

                                        <div class="card-body"> Swag slow-carb quinoa VHS typewriter pork belly brunch, paleo single-origin coffee Wes Anderson. Flexitarian Pitchfork forage, literally paleo fap pour-over. Wes Anderson Pinterest YOLO fanny pack meggings, deep v XOXO chambray sustainable slow-carb raw denim church-key fap chillwave Etsy. +1 typewriter kitsch, American Apparel tofu Banksy Vice. </div>

                                    </div>

                                </div>

                                <div class="card">

                                    <div id="heading-faq-3" class="card-header">

                                        <h2 class="mb-0"><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-3" aria-expanded="true" aria-controls="collapse-faq-3" class="btn btn-link btn-block text-left collapsed "> What Payment Methods Are Accepted? </button></h2>

                                    </div>

                                    <div id="collapse-faq-3" aria-labelledby="heading-faq-3" data-parent="#faq-accordion" class="collapse ">

                                        <div class="card-body"> Fashion axe DIY jean shorts, swag kale chips meh polaroid kogi butcher Wes Anderson chambray next level semiotics gentrify yr. Voluptate photo booth fugiat Vice. Austin sed Williamsburg, ea labore raw denim voluptate cred proident mixtape excepteur mustache. Twee chia photo booth readymade food truck, hoodie roof party swag keytar PBR DIY. </div>

                                    </div>

                                </div>

                                <div class="card">

                                    <div id="heading-faq-4" class="card-header">

                                        <h2 class="mb-0"><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-4" aria-expanded="true" aria-controls="collapse-faq-4" class="btn btn-link btn-block text-left collapsed "> Is Buying On-Line Safe? </button></h2>

                                    </div>

                                    <div id="collapse-faq-4" aria-labelledby="heading-faq-4" data-parent="#faq-accordion" class="collapse ">

                                        <div class="card-body"> Art party authentic freegan semiotics jean shorts chia cred. Neutra Austin roof party Brooklyn, synth Thundercats swag 8-bit photo booth. Plaid letterpress leggings craft beer meh ethical Pinterest. </div>

                                    </div>

                                </div>

                            </div> -->

                            </div>

                            <div id="Reviews" class="tab-pane fade">

                                <!--
                                <div class="my-3">

                                    <h6 class="mb-2">Images from customer (11)</h6>

                                    <div class="block--review">

                                        <div class="block__images row m-0 block__images_total">
                                            <a href="https://botble.b-cdn.net/nest/storage/products/2.jpg" class="col-lg-1 col-sm-2 col-3 more-review-images ">

                                                <div class="position-relative"><img src="https://botble.b-cdn.net/nest/storage/products/2-150x150.jpg" alt="All Natural Italian-Style Chicken Meatballs" class="img-responsive rounded border h-100"></div>

                                            </a>
                                        </div>

                                    </div>

                                </div>
-->

                                <div class="comments-area">

                                    <div class="row">

                                        <div id="product-reviews" class="col-lg-8 block--product-reviews">

                                            <h4 class="mb-30">Customer questions &amp; answers</h4>

                                            <div class="block__content comment-list">

                                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="block--review single-comment justify-content-between d-flex mb-30">

                                                    <div class="user justify-content-between d-flex">

                                                        <div class="thumb text-center"><img src="/assets/imgs/user.jpg" alt="<?php echo e($review['customer_name']); ?>"> <span class="font-heading text-brand d-block"><?php echo e($review['customer_name']); ?></span></div>

                                                        <div class="desc">

                                                            <div class="d-flex justify-content-between mb-10">

                                                                <div> <span class="font-xs text-muted"><?php echo e($review['time_difference']); ?></span></div>

                                                                <div class="product-rate d-inline-block">
                                                                <?php
                                                                $starpercent = (($review['star'] * 100) / 5);
                                                                ?>

                                                                    <div class="product-rating" style="width: <?php echo e($starpercent); ?>%;"></div>

                                                                </div>

                                                            </div>

                                                            <p class="mb-10"><?php echo e($review['description']); ?></p>

                                                            <div class="block__images">
                                                                <?php $__currentLoopData = $review['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                 <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$image,'size'=>[250,250]);
                               
                                                                ?> 
                                                                <a href="<?php echo e(ImageRender($imagearray)); ?>"><img src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e(ImageRender($imagearray)); ?>" class="img-responsive rounded h-100"></a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <div class="pagination-area mt-15 mb-md-5 mb-lg-0"></div>

                                            </div>

                                        </div>

                                        <div class="col-lg-4">

                                            <h4 class="">Customer reviews</h4>

                                            <div class="d-flex">

                                                <div class="product-rate d-inline-block mr-15">
                                                    <?php
                                                    $starpercent = (($productreviewcount['avg'] * 100) / 5);
                                                    ?>

                                                    <div class="product-rating" style="width:<?php echo e($starpercent); ?>%"></div>

                                                </div>

                                                <h6><?php echo e($productreviewcount['avg']); ?> out of 5</h6>

                                            </div>

                                            <div class="progress"><span>5 star</span>

                                                <div role="progressbar" aria-valuenow="<?php echo e($productreviewcount['star5']); ?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar page_speed_562526235"><?php echo e($productreviewcount['star5']); ?>%</div>

                                            </div>

                                            <div class="progress"><span>4 star</span>

                                                <div role="progressbar" aria-valuenow="<?php echo e($productreviewcount['star4']); ?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar page_speed_1415130164"><?php echo e($productreviewcount['star4']); ?>%</div>

                                            </div>

                                            <div class="progress"><span>3 star</span>

                                                <div role="progressbar" aria-valuenow="<?php echo e($productreviewcount['star3']); ?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar page_speed_2013111614"><?php echo e($productreviewcount['star3']); ?>%</div>

                                            </div>

                                            <div class="progress"><span>2 star</span>

                                                <div role="progressbar" aria-valuenow="<?php echo e($productreviewcount['star2']); ?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar page_speed_2013111614"><?php echo e($productreviewcount['star2']); ?>%</div>

                                            </div>

                                            <div class="progress"><span>1 star</span>

                                                <div role="progressbar" aria-valuenow="<?php echo e($productreviewcount['star1']); ?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar page_speed_2013111614"><?php echo e($productreviewcount['star1']); ?>%</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!--
                                <div class="comment-form">

                                    <h4 class="mb-15">Add a review</h4>

                                    <div class="product-rate d-inline-block mb-30"></div>

                                    <div class="row">

                                        <div class="col-lg-8 col-md-12">

                                            <form method="POST" action="javascript:void(0)" accept-charset="UTF-8" enctype="multipart/form-data" class="form-contact comment_form form-review-product">

                                                <p class="text-danger"><?php if(Session::get('customer-logged-in') != true): ?> Please <a href="/login">login</a> to write review!</p> <?php endif; ?><input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                                                <div class="form-group"><label>Quality</label>

                                                    <div class="rate"><input type="radio" id="star1" name="star" value="1"><label for="star1" title="text">1 star</label><input type="radio" id="star2" name="star" value="2"><label for="star2" title="text">2 star</label><input type="radio" id="star3" name="star" value="3"><label for="star3" title="text">3 star</label><input type="radio" id="star4" name="star" value="4"><label for="star4" title="text">4 star</label><input type="radio" id="star5" name="star" value="5" checked="checked"><label for="star5" title="text">5 star</label></div>

                                                </div>

                                                <div class="form-group"><textarea name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment" <?php echo e(Session::get('customer-logged-in') == true ? "" : 'disabled="disabled"'); ?> class="form-control w-100"></textarea></div>

                                                <div class="form-group">

                                                    <script type="text/x-custom-template" id="review-image-template"><span class="image-viewer__item" data-id="__id__"><img src=/vendor/core/core/base/images/placeholder.png alt="Preview" class="img-responsive d-block"><span class="image-viewer__icon-remove"><i class="fi-rs-cross"></i></span></span></script>

                                                    <div class="image-upload__viewer d-flex">

                                                        <div class="image-viewer__list position-relative">

                                                            <div class="image-upload__uploader-container">

                                                                <div class="d-table">

                                                                    <div class="image-upload__uploader"><i class="fi-rs-camera image-upload__icon"></i>

                                                                        <div class="image-upload__text">Upload photos</div><input type="file" name="images[]" data-max-files="6" accept="image/png,image/jpeg,image/jpg" multiple="multiple" data-max-size="2048" data-max-size-message="The __attribute__ must not be greater than __max__ kilobytes." class="image-upload__file-input">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="loading">

                                                                <div class="half-circle-spinner">

                                                                    <div class="circle circle-1"></div>

                                                                    <div class="circle circle-2"></div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div><span class="help-block d-inline-block"> You can upload up to 6 photos, each photo maximum size is 2048 kilobytes </span></div>

                                                </div>

                                                <div class="form-group"><button type="button" Session::get('customer-logged-in')==true ? "" :'disabled="disabled"'}}' class="button button-contactForm">Submit Review</button></div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
-->
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">

                <h3 class="" style="margin: 15px 0px;">You may also like</h3>

            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn you-may-also-like" data-wow-delay=".4s">

                    <div class="carausel-4-columns-cover arrow-center position-relative">

                        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-latest-arrows"></div>

                        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-latest">

                            <?php $__empty_1 = true; $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                            <div class="product-cart-wrap mb-30">

                                <div class="product-img-action-wrap">

                                    <div class="product-img product-img-zoom">

                                        <a href="/product/<?php echo e($product->slug); ?>">
                                            <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$product->image,'size'=>[350,350]);
                               
                                            ?> 
                                            <img class="default-img" src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e($product->name); ?>">

                                            <img class="hover-img" src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e($product->name); ?>">


                                        </a>

                                    </div>

                                    <div class="product-action-1">

                                        <a aria-label="Add To Wishlist" data-product-id="<?php echo e($product->id); ?>" class="action-btn add-wishlist-btn fill-and-blank" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>

                                    </div>

                                </div>

                                <div class="product-content-wrap">



                                    <div class="product-category">

                                        <a href="/product-categories/<?php echo e(strtolower($product->categorySlug)); ?>"><?php echo e($product->categoryName); ?></a>

                                    </div>



                                    <h2>

                                        <?php if(url()->current() == env('APP_URL') . "/product/$product->slug"): ?>

                                        <a href="#"><?php echo e($product->name); ?></a>

                                        <?php else: ?>

                                        <a href="/product/<?php echo e($product->slug); ?>" target="_blank"><?php echo e($product->name); ?></a>

                                        <?php endif; ?>

                                    </h2>

                                    <div>

                                        <span class="font-small text-muted">Visit Store: <a href="/brand/<?php echo e($product->vendor_slug); ?>" target="_blank"><?php echo e(!is_null($product->vendorNickName) && !empty($product->vendorNickName) ? $product->vendorNickName :$product->vendorName); ?></a></span>

                                    </div>

                                    <div class="product-card-bottom">

                                        <div class="product-price">

                                            <ul>

                                                <li><span>Price: <i class="fa fa-rupee-sign"></i>

                                                        <?php echo e($product->net_price); ?></span>

                                                </li>

                                                <li>

                                                    MRP: <del><i class="fa fa-rupee-sign"></i><?php echo e($product->product_mrp); ?></del> (<?php echo e(number_format($product->discount_percentage, 1)); ?>% off)

                                                </li>

                                            </ul>

                                        </div>
										
										
										
                                        <div class="add-cart">

                                            <a class="add quick-view-btn-add-to-cart" data-productid="<?php echo e($product->id); ?>" href="javascript:void(0)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>

                                        </div>
										
                                    </div>

                                </div>

                            </div>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>

</main>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('javascript'); ?>

<script src="/assets/js/jquery-ui.min.js"></script>

<script src="/assets/js/jquery.fancybox.js"></script>

<script src="/assets/js/jquery.elevatezoom.js"></script>

<script src="/assets/js/panZoom.js"></script>

<script src="/assets/js/ui-carousel.js"></script>

<script src="/assets/js/lightslider.min.js"></script>
<script src="/assets/js/lightgallery-all.min.js"></script>

<script src="/assets/js/izoom.js"></script>

<!--<script src="/assets/js/zoom.js"></script>-->



<script>
    var slider = $('#imageGallery').lightSlider({
        item: 1,
        autoWidth: false,
        currentPagerPosition: 'middle',
        speed: 500,
        auto: false,
        loop: true,
        currentPagerPosition: 'center',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
            $('#imageGallery li').show();
        }
    });


    /*
    $(document).ready(function() {
        $(".small_img").hover(function() {

            $(".big_img").css({

                "width": "400px",

                "height": "auto"

            });

            $(".big_img").attr('src', $(this).attr('src'));

        });

        $(".small_img").click(function() {

            $(".gallery-viewer").css({

                "width": "100%",

                "height": "100%",

                "overflow": "hidden"

            });

            $(".big_img").css({

                "width": "100%",

                "height": "100%",

                "overflow": "hidden"

            });

        });

    });
*/


    var variantpricedetail = <?php echo json_encode($productvariantprice, 15, 512) ?>;

    $(document).off('change', '.product-filter-item').on('change', '.product-filter-item', function() {

        var filteritem = $('.product-filter-item');

        var filters = [];

        for (var i in filteritem) {

            if (!isNaN(parseInt(i)) && filteritem[i].checked) {

                filters.push(filteritem[i].value);

            }

        }



        $.get('/quick-view-variant-price', {

            productid: $('#quickview_productid').val(),

            filters: filters.join(",")

        }, function(result) {

            if (result.ok == true) {

                $('li.attribute-swatch-item').removeClass('pe-none');

                $('#product-price').html(result.data.price);

                $('#product-mrp').html(result.data.prdocutmrp);

                $('#product-price-variant-id').val(result.data.variantpriceid);

                $('#product-sku .sku-text').val(result.data.productsku);

                if (variantpricedetail.hasOwnProperty(filters[0])) {

                    var basefilter = variantpricedetail[filters[0]];

                    for (var i in basefilter) {

                        if (isNaN(parseFloat(basefilter[i]['price'])) || parseFloat(basefilter[i]['price']) == 0 || basefilter[i]['quantity'] == 0 || basefilter[i]['quantity'].length == 0) {

                            $('li.attribute-swatch-item[data-id="' + i + '"]').addClass('pe-none');

                            $('li.attribute-swatch-item[data-id="' + i + '"] input[type="radio"]').attr('checked', false);

                        }

                    }

                }

                if (result.data.quantity > result.data.minoq && result.data.price > 0) {

                    $('.has-buy-now-button button:not(".buy-now")').attr('disabled', false).addClass('button-add-to-cart');

                    $('.has-buy-now-button button .addcart-button-text').text('Add To Cart');

                    if ($('.has-buy-now-button button.buy-now').length == 0) {

                        $('.has-buy-now-button button').after('<button type="submit" class="button buy-now"><i class="fi-rs-shopping-cart"></i><span class="buynow-button-text"> Buy Now</span></button>');

                    } else {

                        $('.has-buy-now-button button.buy-now').attr('disabled', false);

                    }

                } else {

                    $('.has-buy-now-button button:not(".buy-now")').attr('disabled', true).removeClass('button-add-to-cart');

                    $('.has-buy-now-button button.buy-now').attr('disabled', true);

                    $('.has-buy-now-button button .addcart-button-text').text('Item Sold Out');

                }

                $('.gallery-viewer img').attr('src', result.data.variantimage);

                $('.gallery-viewer img').attr('data-zoom-image', result.data.variantimage);

                $('.zoomContainer .tintContainer .zoomLens img').attr('src', result.data.variantimage);

                $('.zoomWindowContainer .zoomWindow').css('background-image', "url('" + result.data.variantimage + "')");
                var img_no = $("#imageGallery img[src='" + result.data.variantimage + "']").attr('data-slide-no');
                //$('#imageGallery li.active').removeClass('active');
                //$('#imageGallery .v-'+result.data.variantimageid).addClass('active');
                slider.goToSlide(img_no);
            }

        }, 'json');

    });

    $('#checkpincode').keyup(function(e) {
        if ($(this).val() == '' || $.trim($(this).val()).length == 0) {
            $('#check-pincode-availability-text').html('');
        }
        if ((e.keyCode || e.which) == 13) {
            verify();
        }
    });

    function verify() {

        var destinationPincode = $.trim($('#checkpincode').val());
        if (destinationPincode.length == 0) {
            $('#check-pincode-availability-text').html('<span class="alert alert-danger">Pincode is necessary</span>');
            return;
        }

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            type: 'post',

            url: '/check-pincode-availablity',

            data: {

                originPincode: $('#vendor_shipping_pincode').val(),

                destinationPincode: destinationPincode

            },

            success: function(result) {
                $('#check-pincode-availability-text').html('<span class="alert ' + (result.status == true ? 'alert-success' : 'alert-danger') + '">' + result.message + '</span>');
            }

        });

    }

    $('input[type="radio"][name^="attribute"]:checked').trigger('change');
</script>

<?php $__env->stopPush(); ?>



<?php $__env->startPush('externalcss'); ?>

<link rel="stylesheet" href="/assets/css/jquery.fancybox.css">

<link rel="stylesheet" href="/assets/css/jquery.fancybox-thumbs.css">

<link rel="stylesheet" href="/assets/css/zoom.css">

<link rel="stylesheet" href="/assets/css/lightslider.css">

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/product.blade.php ENDPATH**/ ?>