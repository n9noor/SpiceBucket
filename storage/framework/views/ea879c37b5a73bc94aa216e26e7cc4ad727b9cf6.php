
<?php $__env->startSection('content'); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Edit Product: <?php echo e($product->name); ?>

                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>
<?php if($errors->any()): ?>
<?php echo implode('', $errors->all('<div class="alert alert-danger">:message</div>')); ?>

<?php endif; ?>
<form action="/products/update-product/<?php echo e($product->id); ?>" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateProductForm()">
    <?php echo csrf_field(); ?>
    <?php echo method_field("PUT"); ?>
    <div class="main-card mb-3 card">
        <h1 class="card-header">Product Information</h1>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="main_category_id" class="form-label">Main Category</label>
                        <select class="multiselect-dropdown form-control" name="main_category_id" id="main_category_id" placeholder="Select category">
                            <option value=""></option>
                            <?php $__currentLoopData = $catgories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $product->category_id ? " selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['main_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="sub_category_id" class="form-label">Sub Category</label>
                        <select class="multiselect-dropdown form-control" name="sub_category_id" id="sub_category_id" placeholder="Select category">
                            <option value=""></option>
                            <?php if(array_key_exists($product->category_id, $subcategories)): ?>
                            <?php $__currentLoopData = $subcategories[$product->category_id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subcategory['id']); ?>" <?php echo e($subcategory['id'] == $product->sub_category_id ? " selected='selected'" : ""); ?>><?php echo e($subcategory['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['sub_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="product_type" class="form-label" style="display:block;">Product Type</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo e($product->product_type == 1 ? " checked='checked'" : ""); ?> type="radio" name="product_type" id="product_type_veg" value="1">
                            <label class="form-check-label" for="product_type_veg">Veg</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo e($product->product_type == 2 ? " checked='checked'" : ""); ?> type="radio" name="product_type" id="product_type_nonveg" value="2">
                            <label class="form-check-label" for="product_type_nonveg">Non Veg</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo e($product->product_type == 0 ? " checked='checked'" : ""); ?> type="radio" name="product_type" id="product_type_na" value="0">
                            <label class="form-check-label" for="product_type_na">N/A</label>
                        </div>
                        <?php $__errorArgs = ['product_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="<?php echo e(session('admin-logged-in') == true ? 'col-md-3' : 'col-md-5'); ?>">
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?php echo e($product->name); ?>" />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <?php if(session('admin-logged-in') == true): ?>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select class="form-control" name="vendor_id" id="vendor_id" placeholder="Select Vendor">
                            <option value=""></option>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vendor->id); ?>" <?php echo e((old('vendor_id') == $vendor->id || $vendor->id == $product->vendor_id) ? " selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?> (<?php echo e($vendor->responsible_person); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['vendor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <?php elseif(session('vendor-logged-in') == true): ?>
                <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo e($product->vendor_id); ?>" />
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea class="form-control" name="summary" id="summary" placeholder="Enter Summary"><?php echo e($product->summary); ?></textarea>
                        <?php $__errorArgs = ['summary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Description"><?php echo e($product->description); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="hsn_code" class="form-label">HSN Code</label>
                                <input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="Enter HSN Code" value="<?php echo e($product->hsn_code); ?>">
                                <?php $__errorArgs = ['hsn_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="gst_rate" class="form-label">GST Rate(%)</label>
                                <select name="gst_rate" id="gst_rate" class="form-control">
                                    <?php $gst_rate = array(0, 5, 8, 12, 15, 18); ?>
                                    <?php $__currentLoopData = $gst_rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($rate); ?>" <?php echo e($product->gst_rate == $rate || old('gst_rate') == $rate ? " selected='selected'" : ""); ?>><?php echo e($rate); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control" placeholder="Enter SKU" value="<?php echo e($product->sku); ?>">
                                <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Enter Barcode" value="<?php echo e($product->barcode); ?>">
                                <?php $__errorArgs = ['barcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" name="origin" id="origin" class="form-control" placeholder="Enter Origin" value="<?php echo e($product->origin); ?>">
                                <?php $__errorArgs = ['origin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card mb-3 card">
        <h1 class="card-header">Product Image</h1>
        <div class="card-body">
			Note: Images to upload here Product Back Image, Veg/Non-veg Logo, FASSAI No. Image, Ingrident Details
            <div class="row">
                <?php for($i=1; $i<=8; $i++): ?> <div class="col-md-3 border border-1">
                    <div class="position-relative mb-3">
                        <?php
                        $label = '';
                        switch($i){
                        default:
                        $label = 'Produt Image';
                        break;
                        }
                        ?>
                        <h5><?php echo e($label); ?></h5>
                        <label for="product_image_<?php echo e($i); ?>" class="form-label <?php if(!empty($productImages[$i-1]->id) && is_null($productImages[$i-1]->variantId)): ?> default-hide <?php endif; ?>">
                            <img class="mx-5 my-3 img-thumbnail border-0" src="<?php echo e(asset('images/upload.png')); ?>" width="200" height="200">
                        </label>
                        <div id="product-image-view-<?php echo e($i); ?>">
                            <?php if(!empty($productImages[$i-1]->id) && is_null($productImages[$i-1]->variantId)): ?>
                            <button type="button" class="btn btn-link cross-icon" onclick="removeImage('product-image-view-<?php echo e($i); ?>', <?php echo e($productImages[$i-1]->id); ?>)"><i class="fa fa-2x fa-times"></i></button><img class="mx-5 my-3 img-thumbnail border-0" src="<?php echo e((env('APP_ENV') == "production" ? url('/public/images/products/' . $productImages[$i-1]->image) : url('/images/products/' . $productImages[$i-1]->image))); ?>" width="200" height="200">
                            <?php endif; ?>
                        </div>
                        <input style="display:none" type="file" name="product_image[<?php echo e($i); ?>]" id="product_image_<?php echo e($i); ?>" class="form-control" onchange="displayImage(this, 'product-image-view-<?php echo e($i); ?>');" />
                    </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    </div>
    <div class="main-card mb-3 card">
        <h1 class="card-header">Video Code</h1>
        <div class="card-body">
            <div class="row">
                <?php for($i=1; $i<=4; $i++): ?> <?php $video_link=json_decode($product->video_url, true)
                    ?>
                    <div class="col-md-6 mb-4">
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="">https://www.youtube.com/embed/</span>
                            </div>
                            <input type="text" class="form-control" name="video_link[]" id="video_link_<?php echo e($i); ?>" value="<?php echo e($video_link != false && !is_null($video_link) ? $video_link[$i-1] : ""); ?>">
                        </div>
                    </div>
                    <?php endfor; ?>
            </div>
        </div>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-header">Pricing</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="selling_price" class="form-label">Max. Retail Price (MRP)</label>
                                <input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="Enter Selling Price" value="<?php echo e($product->product_mrp); ?>" />
                                <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="discount_price" class="form-label">Discount</label>
                                <div class="input-group">
                                    <?php
                                    $discount_rate = (($product->discount_price * 100) / $product->product_mrp);
                                    ?>
                                    <input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Discount" value="<?php echo e(round($discount_rate)); ?>" />
                                    <div class="input-group-text">
                                        <span class="">%</span>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['discount_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="net_price" class="form-label">Selling Price</label>
                                <input type="text" class="form-control" name="net_price" id="net_price" value="<?php echo e($product->net_price); ?>" readonly placeholder="Enter Net Price" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="minoq" class="form-label">Min OQ</label>
                                        <input type="text" class="form-control" name="minoq" id="minoq" value="<?php echo e($product->minoq); ?>" placeholder="Enter Min Order Quantity" />
                                        <?php $__errorArgs = ['minoq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="maxoq" class="form-label">Max OQ</label>
                                        <input type="text" class="form-control" name="maxoq" id="maxoq" value="<?php echo e($product->maxoq); ?>" placeholder="Enter Max Order Quantity" />
                                        <?php $__errorArgs = ['maxoq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="cost" class="form-label">Cost Price</label>
                                        <input type="text" class="form-control" name="cost" id="cost" value="<?php echo e($product->cost); ?>" placeholder="Enter COST" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pt-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1" id="taxable" name="taxable" <?php echo e($product->taxable == 1 ? " checked='checked'" : ""); ?>>
                        <label class="form-check-label" for="taxable">Taxable</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="taxable_rate" class="form-label">Tax Rate</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="taxable_rate" id="taxable_rate" value="<?php echo e($product->tax_rate); ?>" <?php echo e($product->taxable != 1 ? " readonly='readonly'" : ""); ?> />
                            <div class="input-group-text">
                                <span class="">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="taxable_amount" class="form-label">Tax Amount</label>
                        <input type="text" class="form-control" name="taxable_amount" id="taxable_amount" value="<?php echo e($product->tax_amount); ?>" readonly />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="net_price_without_tax" class="form-label">Net Price Without Tax</label>
                        <input type="text" class="form-control" name="net_price_without_tax" id="net_price_without_tax" value="<?php echo e($product->net_price_with_tax); ?>" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    
    <div class="main-card mb-3 card">
        <h3 class="card-header">B2B Pricing</h3>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="b2b_price" class="form-label">Price</label>
                        <input type="text" class="form-control" name="b2b_price" id="b2b_price" value="<?php echo e($product->b2b_price); ?>" placeholder="Enter B2B Price" />
                        <?php $__errorArgs = ['b2b_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="b2b_minoq" class="form-label">Min Order Quantity</label>
                        <input type="text" class="form-control" name="b2b_minoq" id="b2b_minoq" value="<?php echo e($product->b2b_minoq); ?>" placeholder="Enter B2B Min Order Quantity" />
                        <?php $__errorArgs = ['b2b_minoq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="b2b_maxoq" class="form-label">Max Order Quantity</label>
                        <input type="text" class="form-control" name="b2b_maxoq" id="b2b_maxoq" value="<?php echo e($product->b2b_maxoq); ?>" placeholder="Enter B2B Max Order Quantity" />
                        <?php $__errorArgs = ['b2b_maxoq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
    <?php $counter=0; ?>
    <div class="main-card mb-3 card">
        <h1 class="card-header">Variants</h1>
        <div class="card-body">
            <div class="my-3 border p-4" id="varient_property_manual_div">
                <?php $__currentLoopData = $variantsValueMap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $varient_id => $map): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-1">
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" <?php if($map['checked'] == 1): ?> checked <?php endif; ?> type="checkbox" value="<?php echo e($varient_id); ?>" name="variant_id[]" id="variant_id_<?php echo e($varient_id); ?>" data-text="<?php echo e($map['name']); ?>">
                            <label class="form-check-label" for="variant_id_<?php echo e($varient_id); ?>"><?php echo e($map['name']); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="multiselect-dropdown form-control" id="varient_value_<?php echo e($varient_id); ?>" name="varient_value[]" multiple>
                                <?php $__currentLoopData = $map['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($values['selected'] == 1): ?> selected <?php endif; ?> value="<?php echo e($values['id']); ?>|<?php echo e($values['value']); ?>"><?php echo e($values['value']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button class="btn btn-danger" type="button" id="generate-variant-tbl-btn">Generate Variant Table</button>
            </div>
            <div class="my-3 p-4 table-responsive">
                <table id="variant-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th nowrap>Variant</th>
                            <th>Product MRP</th>
                            <th>Discount</th>
                            <th>Selling Price</th>
                            <!-- <th>B2B Product Price</th> -->
                            <th>SKU (Optional)</th>
                            <th>Barcode (Optional)</th>
                            <th>Weight (in Grms)</th>
                            <th>Quantity (Optional)</th>
                            <th>Default</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $productVariant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[productpriceid]" id="<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_productpriceid" value="<?php echo e($variant->id); ?>" />
                        <tr id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_row'>
                            <th nowrap><input class='readonly-as-label' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[label]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_label' value="<?php if(!is_null($variant->Object1Value)): ?><?php echo e($variant->Object1Value); ?><?php endif; ?> 
<?php if(!is_null($variant->Object2Value)): ?>/ <?php echo e($variant->Object2Value); ?><?php endif; ?> 
<?php if(!is_null($variant->Object3Value)): ?>/ <?php echo e($variant->Object3Value); ?><?php endif; ?>" readonly /></th>
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[product_mrp]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_product_mrp' value="<?php echo e($variant->product_mrp); ?>"></td>
                            <td>
                                <?php
                                $discount_rate = (($variant->discount_price * 100) / $variant->product_mrp);
                                ?>
                                <div class='input-group'><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[discount_price]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_discount_price' value="<?php echo e(round($discount_rate)); ?>">
                                    <div class='input-group-text'><span class=''>%</span></div>
                                </div>
                            </td>
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[net_price]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_net_price' value="<?php echo e($variant->net_price); ?>" readonly></td>
                            <!--
    
-->
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[sku]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_sku' value="<?php echo e($variant->sku); ?>"></td>
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[barcode]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_barcode' value="<?php echo e($variant->barcode); ?>"></td>
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[net_weight]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_net_weight' value="<?php echo e($variant->net_weight); ?>"></td>
                            <td><input class='form-control' type='text' name='<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[quantity]' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_quantity' value="<?php echo e($variant->quantity); ?>"></td>
                            <td class='text-center'>
                                <div class='position-relative form-check'><label class='form-label form-check-label'><input name='variant_default' <?php if($variant->mark_as_default == 1): ?> checked <?php endif; ?> value='<?php echo e($variant->id); ?>' type='radio' class='form-check-input' id='<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_default' /></label></div>
                            </td>
                            <td><label for="<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_image" class="form-label <?php if(!empty($variant->variantImage)): ?> default-hide <?php endif; ?>"><img class="img-thumbnail border-0" src="/images/upload.png" width="50" height="50"></label>
                                <div id="<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_image-view">
                                    <?php if(!empty($variant->variantImage)): ?>
                                    <button type="button" class="btn btn-link" onclick="removeImage('<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_image-view', <?php echo e($variant->image_id); ?>)"><i class="fa fa-times"></i></button><img class="img-thumbnail border-0" src="<?php echo e((env('APP_ENV') == "production" ? url('/public/images/products/' . $variant->variantImage  ) : url('/images/products/' . $variant->variantImage))); ?>" width="50" height="50">
                                    <?php endif; ?>
                                </div>
                                <input style="display:none" type="file" name="<?php if(!is_null($variant->variant_value_id_1)): ?>variant[<?php echo e($variant->variant_value_id_1); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>[<?php echo e($variant->variant_value_id_2); ?>]<?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>[<?php echo e($variant->variant_value_id_3); ?>]<?php endif; ?>
[image]" id="<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_image" class="form-control" onchange="displayImage(this, '<?php if(!is_null($variant->variant_value_id_1)): ?>variant_<?php echo e($variant->variant_value_id_1); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_2)): ?>_<?php echo e($variant->variant_value_id_2); ?><?php endif; ?>
<?php if(!is_null($variant->variant_value_id_3)): ?>_<?php echo e($variant->variant_value_id_3); ?><?php endif; ?>
_image-view', 'img-thumbnail border-0', 50, 50, false);" />
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button class="mt-1 mb-3 btn btn-primary">Save</button>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/ckeditor/ckeditor.js')); ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
    var subcategories = <?php echo json_encode($subcategories, 15, 512) ?>;
</script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/show-image.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('wms.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/products/edit.blade.php ENDPATH**/ ?>