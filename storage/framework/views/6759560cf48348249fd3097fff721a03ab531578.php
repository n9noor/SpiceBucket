<link rel="stylesheet" href="/assets/css/jquery.fancybox.css">
<link rel="stylesheet" href="/assets/css/jquery.fancybox-thumbs.css">
<link rel="stylesheet" href="/assets/css/zoom.css">
<input type="hidden" name="quickview_productid" id="qquickview_productid" value="<?php echo e($product->id); ?>" />
<link rel="stylesheet" href="/assets/css/plugins/magnific-popup.css">
<script src="/assets/js/plugins/magnific-popup.js"></script>
<div class="product-detail accordion-detail">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 mb-md-0 mb-sm-5 pdp-image-gallery-block">

            <div class="gallery_pdp_container">

                <div id="gallery_pdp">

                    <?php $images = explode(",", $product->images); ?>

                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php $varianttimages = explode("|", $image) ?>

                    <a href="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>" data-image="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>" data-zoom-image="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>"><img class="img-thumbnail small_img" src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>" alt="<?php echo e($product->name); ?>"></a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
<!--
                <a href="#" id="ui-carousel-next"><i class="fa-solid fa-arrow-down"></i></a>
                <a href="#" id="ui-carousel-prev"><i class="fa-solid fa-arrow-up"></i></a>
-->
            </div>

            <div class="qgallery-viewer quick-view-desk"><?php  $varianttimages = explode("|", $images[0]); ?>
                    
                    

                <img id="zoom_10" width="100%" height="100%" src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>" data-zoom-image="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' .$varianttimages[1]) : url('/images/products/' . $varianttimages[1])); ?>" class="big_img" />

                <p class="hint-pdp-img">Roll over the image to zoom in</p>

            </div>

        </div>

        <div class="col-md-8 col-sm-6 col-xs-12 mb-25">
            <div class="detail-info pr-30 pl-30">
                <h2 class="title-detail"><?php echo e(ucfirst($product->name)); ?></h2>
                <!--
            <div class="product-detail-rating">
             <div class="product-rate-cover text-end">
              <div class="product-rate d-inline-block">
               <div class="product-rating" style="width: 30%"></div>
              </div> <span class="font-small ml-5 text-muted">(2 reviews)</span> </div>
            </div>
                        -->
                <?php $discountPrice = ($product->product_mrp - $product->netPrice);
                $discountPercentage = ($discountPrice/$product->product_mrp)*100;
                ?>
                <div class="clearfix product-price-cover">
                    <div class="qproduct-price primary-color float-left"> <span class="current-price text-brand"><i class="fa fa-rupee-sign"></i> <span id="qproduct-price" class="mr-10"><?php echo e($product->netPrice); ?></span></span>
                        <span> <span class="save-price font-md color3 ml-5"> <span class="percentage-off">(<?php echo e(number_format($product->discount_percentage, 1)); ?>% off)</span> </span>  <span class="old-price-quick-view"></span> </span>
                    </div>
                </div>
                <div class="old-pricing-sec">
                                    
                                    <span class="product-mrp-name">M.R.P</span>
                                        
                                            <span class="old-price font-md ml-5" id="product-mrp"><del> <?php echo e($product->product_mrp); ?></del> (Incl. of all taxes)
                                            </span> 
                                </div>
                <div class="short-desc mb-10">
                    <p>Visit: <a href="/brand/<?php echo e($product->vendor_slug); ?>" target="_blank"><strong><?php echo e((is_null($product->vendorNickName) || empty($product->vendorNickName)) ? $product->vendorName : $product->vendorNickName); ?> </strong></a></p>
                    <?php echo e($product->summary); ?>

                </div>
                <div class="pr_switch_wrap">
                    <div class="product-attributes">
                        <input type="hidden" name="product-price-variant-id" id="qproduct-price-variant-id" value="<?php echo e($product->variantpriceid); ?>" />
                        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $variantvalues = explode(',', $variant->variantvalues);
                        ?>
                        <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color mb-10">
                            <label class="attribute-name"><?php echo e($variant->name); ?></label>
                            <div class="attribute-values">
                                <div class="dropdown-swatch">
                                    <label>
                                        <ul class="text-swatch attribute-swatch color-swatch">
                                            <?php $__currentLoopData = $variantvalues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $variantvalue = explode("|", $values) ?>
                                            <?php if(in_array($variantvalue[1], $productsvariants)): ?>
                                            <li data-id="<?php echo e($variantvalue[1]); ?>" class="qattribute-swatch-item ">
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
                <!--
                        <div style="margin-bottom: 20px;">
                            <label>Availability: </label> <span class="number-items-available"> <span class="text-success"> <span id="">13</span>
                                    products available </span> </span>
                        </div>
                        -->
                <form class="add-to-cart-form" method="POST" action="javascript:void(0)">
                    <div class="detail-extralink mb-50">
						<div class="quickV-quantity">
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
                        <div class="product-extra-link2 has-buy-now-button quick-view-desk">
                            <?php if($product->qty > 0): ?>
                            <button type="submit" class="button qbutton-add-to-cart"><i class="fi-rs-shopping-cart"></i><span class="qaddcart-button-text">Add To Cart</span></button>
                            <button type="submit" class="button qbuy-now"><i class="fi-rs-shopping-cart"></i><span class="buynow-button-text"> Buy Now</span></button>
                            <?php else: ?>
                            <button type="submit" class="button"><i class="fi-rs-shopping-cart"></i><span class="qaddcart-button-text">Item Sold Out</span></button>
                            <?php endif; ?>
                            <a aria-label="Add To Wishlist" class="action-btn hover-up js-add-to-wishlist-button add-wishlist-btn" aria-label="Add To Wishlist" data-product-id="<?php echo e($product->id); ?>" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>
                        </div>
                    </div>
                </form>
                <div class="font-xs">
                    <ul class="mr-50 float-start">
                        <!--<li class="mb-5" style="display: none" id="product-sku"> <span
                                        class="d-inline-block">SKU</span>: <span class="sku-text">HS-176-A0</span> </li>-->
                        <li class="mb-5"> <span class="d-inline-block">Categories:</span> <a href="/product-categories/<?php echo e($product->category_slug); ?>" title="<?php echo e($product->categoryName); ?>"><?php echo e($product->categoryName); ?></a>
                            > <a href="javascript:void(0)" title="<?php echo e($product->subCategoryName); ?>"><?php echo e($product->subCategoryName); ?></a> </li>
                    </ul>
                </div>
            </div>
            <!-- Detail Info -->
        </div>
    </div>
</div>
<script src="/assets/js/jquery-ui.min.js"></script>

<script src="/assets/js/jquery.fancybox.js"></script>

<script src="/assets/js/jquery.elevatezoom.js"></script>

<script src="/assets/js/panZoom.js"></script>

<script src="/assets/js/ui-carousel.js"></script>

<script src="/assets/js/izoom.js"></script>

<script src="/assets/js/zoom.js"></script>

<script>
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

            productid: $('#qquickview_productid').val(),

            filters: filters.join(",")

        }, function(result) {

            if (result.ok == true) {

                $('li.qattribute-swatch-item').removeClass('pe-none');

                $('#qproduct-price').html(result.data.price);

                $('#qproduct-mrp').html(result.data.prdocutmrp);

                $('#qproduct-price-variant-id').val(result.data.variantpriceid);

                $('#product-sku .sku-text').val(result.data.productsku);

                if (variantpricedetail.hasOwnProperty(filters[0])) {

                    var basefilter = variantpricedetail[filters[0]];

                    for (var i in basefilter) {

                        if (isNaN(parseFloat(basefilter[i]['price'])) || parseFloat(basefilter[i]['price']) == 0 || basefilter[i]['quantity'] == 0 || basefilter[i]['quantity'].length == 0) {

                            $('li.qattribute-swatch-item[data-id="' + i + '"]').addClass('pe-none');

                            $('li.qattribute-swatch-item[data-id="' + i + '"] input[type="radio"]').attr('checked', false);

                        }

                    }

                }

                if (result.data.quantity > result.data.minoq && result.data.price > 0) {

                    $('.has-buy-now-button button:not(".buy-now")').attr('disabled', false).addClass('qbutton-add-to-cart');

                    $('.has-buy-now-button button .qaddcart-button-text').text('Add To Cart');

                    if ($('.has-buy-now-button button.buy-now').length == 0) {

                        //$('.has-buy-now-button button').after('<button type="submit" class="button buy-now"><i class="fi-rs-shopping-cart"></i><span class="buynow-button-text"> Buy Now</span></button>');

                    } else {

                        $('.has-buy-now-button button.buy-now').attr('disabled', false);

                    }

                } else {

                    $('.has-buy-now-button button:not(".buy-now")').attr('disabled', true).removeClass('qbutton-add-to-cart');

                    $('.has-buy-now-button button.buy-now').attr('disabled', true);

                    $('.has-buy-now-button button .qaddcart-button-text').text('Item Sold Out');

                }

                $('.qgallery-viewer img').attr('src', result.data.variantimage);

                $('.qgallery-viewer img').attr('data-zoom-image', result.data.variantimage);

                $('.zoomContainer .tintContainer .zoomLens img').attr('src', result.data.variantimage);
                $('.zoomWindowContainer .zoomWindow').css('background-image', "url(" + result.data.variantimage + ")");
            }

        }, 'json');

    });



    function verify() {

        var destinationPincode = $('#checkpincode').val();

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

                if (result.status == true) {

                    $('#check-pincode-availability-text').text(result.message);

                } else {

                    $('#check-pincode-availability-text').text(result.message);

                }

            }

        });

    }

    $('input[type="radio"][name^="attribute"]:checked').trigger('change');
</script><?php /**PATH /var/www/spicebucket/resources/views/quickview.blade.php ENDPATH**/ ?>