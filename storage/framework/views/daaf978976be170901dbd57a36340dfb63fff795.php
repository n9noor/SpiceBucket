<style type="text/css">
	#image-box img {
  width: auto;
  max-width: 100%;
  margin: 10px 10px 10px 0px;
}
</style>


<?php $__env->startSection("content"); ?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Mobile App Home Edit Page
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

<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="/administrator/edit-static-pages/save-mobile-app-home-page" id="save-mobile-app-home-page-frm" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php echo csrf_field(); ?>
			<div class="row mb-4">
				
					<div class="col-md-10"><h4>Banner (360px * 184px)</h4></div>
				
				<div id="add-mobile-app-banner-div">
				<?php if(array_key_exists('banner', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['banner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="row">
                        <div class="col-md-3">
                        	<div class="row">
                        		<div class="col-md-11">
                            <div class="position-relative mb-3" id="image-box">
                                <input type="file" class="form-control" name="mobileapp[banner][<?php echo e($key); ?>]" id="mobileapp-banner-<?php echo e($key); ?>" />
                                <img src="<?php echo e($banner); ?>" height="100" width="100" />
                            </div>
                        </div>
						<div class="col-md-1">
							<button id="remove-mobile-app-banner-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
						</div>
                        	</div>
                        </div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
				<div class="col-md-2"><button id="add-mobile-app-banner" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button></div>
				
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Latest Offer (296px * 154px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-latest-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-latest-offer-div">
				<?php if(array_key_exists('latest_offers', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['latest_offers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $latestoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-latest-offer-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][image]" id="mobileapp-latest-offer-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $latestoffer)): ?>
									<img src="<?php echo e($latestoffer['image']); ?>" height="100" width="100" data-type="latest-offer" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][heading]" id="mobileapp-latest-offer-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($latestoffer['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][sub_heading]" id="mobileapp-latest-offer-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($latestoffer['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][discount_upto]" id="mobileapp-latest-offer-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($latestoffer['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][vendorid]" id="mobileapp-latest-offer-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($latestoffer['vendorid'] == $vendor->id ? " selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[latest-offer][<?php echo e($key); ?>][categoryid]" id="mobileapp-latest-offer-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($latestoffer['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Banner After Latest Offer (360px * 160px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-banner-after-latest" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-banner-after-latest-div">
				<?php if(array_key_exists('banner_after_latest_offer', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['banner_after_latest_offer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerafterlatestoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-banner-after-latest-offer-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][image]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $bannerafterlatestoffer)): ?>
									<img src="<?php echo e($bannerafterlatestoffer['image']); ?>" height="100" width="100" data-type="banner-after-latest-offer" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][heading]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($bannerafterlatestoffer['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][sub_heading]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($bannerafterlatestoffer['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][discount_upto]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($bannerafterlatestoffer['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][vendorid]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($bannerafterlatestoffer['vendorid'] == $vendor->id ? " selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[banner-after-latest-offer][<?php echo e($key); ?>][categoryid]" id="mobileapp-banner-after-latest-offer-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($bannerafterlatestoffer['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Highly Discounted Offer (530px * 290px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-highly-discounted-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-highly-discounted-offer-div">
				<?php if(array_key_exists('highly_discounted_offers', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['highly_discounted_offers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $highlydiscountedoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-highly-discounted-offer-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][image]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $highlydiscountedoffer)): ?>
									<img src="<?php echo e($highlydiscountedoffer['image']); ?>" height="100" width="100" data-type="highly-discounted-offer" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][heading]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($highlydiscountedoffer['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][sub_heading]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($highlydiscountedoffer['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][discount_upto]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($highlydiscountedoffer['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][vendorid]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($highlydiscountedoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[highly-discounted-offer][<?php echo e($key); ?>][categoryid]" id="mobileapp-highly-discounted-offer-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($highlydiscountedoffer['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Spice Bucket Offers (500px * 225px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-spice-bucket-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-spice-bucket-offer-div">
				<?php if(array_key_exists('spice_bucket_offer', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['spice_bucket_offer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $spicebucketoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-spice-bucket-offer-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][image]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $spicebucketoffer)): ?>
									<img src="<?php echo e($spicebucketoffer['image']); ?>" height="100" width="100" data-type="spicebucket-offer" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][heading]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($spicebucketoffer['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][sub_heading]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($spicebucketoffer['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][discount_upto]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($spicebucketoffer['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][vendorid]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($spicebucketoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[spice-bucket-offer][<?php echo e($key); ?>][categoryid]" id="mobileapp-spice-bucket-offer-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($spicebucketoffer['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Most Popular Brand (300px 258px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-most-popular-brand" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-most-popular-brand-div">
				<?php if(array_key_exists('most_popular_brands', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['most_popular_brands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mostpopularbrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-most-popular-brand-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][image]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $mostpopularbrand)): ?>
									<img src="<?php echo e($mostpopularbrand['image']); ?>" height="100" width="100" data-type="most-popular-brand" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][heading]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($mostpopularbrand['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][sub_heading]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($mostpopularbrand['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][discount_upto]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($mostpopularbrand['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][vendorid]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($mostpopularbrand['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[most-popular-brand][<?php echo e($key); ?>][categoryid]" id="mobileapp-most-popular-brand-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($mostpopularbrand['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Featured Offer (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-featured-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-featured-offer-div">
				<?php if(array_key_exists('featured_offer', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['featured_offer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $featuredoffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-featured-offer-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][image]" id="mobileapp-featured-offer-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $featuredoffer)): ?>
									<img src="<?php echo e($featuredoffer['image']); ?>" height="100" width="100" data-type="featured-offer" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][heading]" id="mobileapp-featured-offer-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($featuredoffer['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][sub_heading]" id="mobileapp-featured-offer-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($featuredoffer['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][discount_upto]" id="mobileapp-featured-offer-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($featuredoffer['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][vendorid]" id="mobileapp-featured-offer-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($featuredoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[featured-offer][<?php echo e($key); ?>][categoryid]" id="mobileapp-featured-offer-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($featuredoffer['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Bestsellers (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-bestseller" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-bestseller-div">
				<?php if(array_key_exists('bestsellers', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['bestsellers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bestseller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-bestseller-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][image]" id="mobileapp-bestseller-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $bestseller)): ?>
									<img src="<?php echo e($bestseller['image']); ?>" height="100" width="100" data-type="bestseller" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][heading]" id="mobileapp-bestseller-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($bestseller['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][sub_heading]" id="mobileapp-bestseller-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($bestseller['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][discount_upto]" id="mobileapp-bestseller-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($bestseller['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][vendorid]" id="mobileapp-bestseller-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($bestseller['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[bestseller][<?php echo e($key); ?>][categoryid]" id="mobileapp-bestseller-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($bestseller['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>New on Spice Bucket (1031px * 694px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-new-on-spicebucket" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-new-on-spicebucket-div">
				<?php if(array_key_exists('new_at_spice_bucket', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['new_at_spice_bucket']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $newonspicebucket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][image]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $newonspicebucket)): ?>
									<img src="<?php echo e($newonspicebucket['image']); ?>" height="100" width="100" data-type="new-on-spicebucket" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][heading]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($newonspicebucket['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][sub_heading]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($newonspicebucket['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][discount_upto]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($newonspicebucket['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][vendorid]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($newonspicebucket['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[new-on-spicebucket][<?php echo e($key); ?>][categoryid]" id="mobileapp-new-on-spicebucket-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($newonspicebucket['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Daily Essentials Need (492px * 587px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-daily-essentials-need" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-daily-essentials-need-div">
				<?php if(array_key_exists('daily_essential_needs', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['daily_essential_needs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dailyessentialsneed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-daily-essentials-need-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][image]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $dailyessentialsneed)): ?>
									<img src="<?php echo e($dailyessentialsneed['image']); ?>" height="100" width="100" data-type="daily-essentials-need" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][heading]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($dailyessentialsneed['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][sub_heading]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($dailyessentialsneed['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][discount_upto]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($dailyessentialsneed['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][vendorid]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($dailyessentialsneed['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[daily-essentials-need][<?php echo e($key); ?>][categoryid]" id="mobileapp-daily-essentials-need-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($dailyessentialsneed['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Banner After Daily Essentials Need (230px * 121px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-banner-after-daily-essentials-need" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-banner-after-daily-essentials-need-div">
				<?php if(array_key_exists('banner_after_daily_essentials_need', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['banner_after_daily_essentials_need']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerafterdailyessentialsneed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][image]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $bannerafterdailyessentialsneed)): ?>
									<img src="<?php echo e($bannerafterdailyessentialsneed['image']); ?>" height="100" width="100" data-type="banner-after-daily-essentials-need" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][heading]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($bannerafterdailyessentialsneed['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][sub_heading]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($bannerafterdailyessentialsneed['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][discount_upto]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($bannerafterdailyessentialsneed['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][vendorid]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($bannerafterdailyessentialsneed['vendorid'] == $vendor->id ? " selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[banner-after-daily-essentials-need][<?php echo e($key); ?>][categoryid]" id="mobileapp-banner-after-daily-essentials-need-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($bannerafterdailyessentialsneed['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Top Selling Brand (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-top-selling-brand" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-top-selling-brand-div">
				<?php if(array_key_exists('top_selling_brands', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['top_selling_brands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topsellingbrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-top-selling-brand-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][image]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $topsellingbrand)): ?>
									<img src="<?php echo e($topsellingbrand['image']); ?>" height="100" width="100" data-type="top-selling-brand" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][heading]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($topsellingbrand['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][sub_heading]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($topsellingbrand['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][discount_upto]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($topsellingbrand['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][vendorid]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($topsellingbrand['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[top-selling-brand][<?php echo e($key); ?>][categoryid]" id="mobileapp-top-selling-brand-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($topsellingbrand['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Recommend for You (450px * 562px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-recommend-for-you" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-recommend-for-you-div">
				<?php if(array_key_exists('recommended_for_you', $mobileapp)): ?>
					<?php $__currentLoopData = $mobileapp['recommended_for_you']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recommendforyou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-md-1">
						<button id="mobileapp-recommend-for-you-<?php echo e($key); ?>" class="btn btn-danger" type="button" data-id="<?php echo e($key); ?>"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][image]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-image" placeholder="Choose Image" />
									<?php if(array_key_exists('image', $recommendforyou)): ?>
									<img src="<?php echo e($recommendforyou['image']); ?>" height="100" width="100" data-type="recommend-for-you" data-id="<?php echo e($key); ?>" />
									<?php endif; ?>
									<?php $__errorArgs = ['image'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][heading]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-heading" placeholder="Enter Heading" value="<?php echo e($recommendforyou['heading']); ?>" />
									<?php $__errorArgs = ['heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][sub_heading]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($recommendforyou['sub_heading']); ?>" />
									<?php $__errorArgs = ['sub_heading'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][discount_upto]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-discount_upto" placeholder="Enter Discount Upto" value="<?php echo e($recommendforyou['discount_upto']); ?>" />
									<?php $__errorArgs = ['discount_upto'];
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
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][vendorid]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($vendor->id); ?>" <?php echo e($recommendforyou['vendorid'] == $vendor->id ? "selected='selected'" : ""); ?>><?php echo e($vendor->store_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['vendorid'];
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
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[recommend-for-you][<?php echo e($key); ?>][categoryid]" id="mobileapp-recommend-for-you-<?php echo e($key); ?>-categoryid" placeholder="Select Category">
										<option value=""></option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->id); ?>" <?php echo e($recommendforyou['categoryid'] == $category->id ? "selected='selected'" : ""); ?>><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['categoryid'];
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
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</div>
			</div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/static-page.js')); ?>"></script>
<script>
$('#save-mobile-app-home-page-frm').submit(function (e){
	var categories = $('select[id$="-categoryid"]');
	var fileinput = $('input[type="file"][id$="-image"]');
	var error=0, errormessage=[];
	for(var i in categories){
		if(!isNaN(parseInt(i))) {
			if(fileinput[i].files.length > 0 && categories[i].value == ''){
				errormessage.push(categories[i].id.replace(/-/g, " ") + " is required");
				error++;
			}
		}
	}
	if(error != 0){
		e.preventDefault();
		alertify.error(errormessage.join("<br/>"));
		return false;
	} else {
		return true;
	}
});

$('#add-mobile-app-banner').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobile-app-banner-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="position-relative mb-3"><input type="file" class="form-control" name="mobileapp[banner][' + length + ']" id="mobileapp-banner-' + length + '" /></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobile-app-banner-"]', function(){
	var type = "banner";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-banner-after-latest').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-banner-after-latest-offer-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][image]" id="mobileapp-banner-after-latest-offer-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][heading]" id="mobileapp-banner-after-latest-offer-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][sub_heading]" id="mobileapp-banner-after-latest-offer-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][discount_upto]" id="mobileapp-banner-after-latest-offer-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][vendorid]" id="mobileapp-banner-after-latest-offer-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][categoryid]" id="mobileapp-banner-after-latest-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-banner-after-latest-offer-"]', function(){
	var type = "banner_after_latest_offer";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-banner-after-daily-essentials-need').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-banner-after-daily-essentials-need-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][image]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][heading]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][sub_heading]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][discount_upto]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][vendorid]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][categoryid]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-banner-after-daily-essentials-need-"]', function(){
	var type = "banner_after_daily_essentials_need";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-latest-offer').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-latest-offer-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[latest-offer][' + length + '][image]" id="mobileapp-latest-offer-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[latest-offer][' + length + '][heading]" id="mobileapp-latest-offer-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[latest-offer][' + length + '][sub_heading]" id="mobileapp-latest-offer-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[latest-offer][' + length + '][discount_upto]" id="mobileapp-latest-offer-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[latest-offer][' + length + '][vendorid]" id="mobileapp-latest-offer-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[latest-offer][' + length + '][categoryid]" id="mobileapp-latest-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-latest-offer-"]', function(){
	var type = "latest_offers";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-highly-discounted-offer').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-highly-discounted-offer-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][image]" id="mobileapp-highly-discounted-offer-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][heading]" id="mobileapp-highly-discounted-offer-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][sub_heading]" id="mobileapp-highly-discounted-offer-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][discount_upto]" id="mobileapp-highly-discounted-offer-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][vendorid]" id="mobileapp-highly-discounted-offer-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][categoryid]" id="mobileapp-highly-discounted-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-highly-discounted-offer"]', function(){
	var type = "highly_discounted_offers";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-spice-bucket-offer').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-spice-bucket-offer-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][image]" id="mobileapp-spice-bucket-offer-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][heading]" id="mobileapp-spice-bucket-offer-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][sub_heading]" id="mobileapp-spice-bucket-offer-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][discount_upto]" id="mobileapp-spice-bucket-offer-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][vendorid]" id="mobileapp-spice-bucket-offer-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][categoryid]" id="mobileapp-spice-bucket-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-spice-bucket-offer-"]', function(){
	var type = "spice_bucket_offer";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-most-popular-brand').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-most-popular-brand-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[most-popular-brand][' + length + '][image]" id="mobileapp-most-popular-brand-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[most-popular-brand][' + length + '][heading]" id="mobileapp-most-popular-brand-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[most-popular-brand][' + length + '][sub_heading]" id="mobileapp-most-popular-brand-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[most-popular-brand][' + length + '][discount_upto]" id="mobileapp-most-popular-brand-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[most-popular-brand][' + length + '][vendorid]" id="mobileapp-most-popular-brand-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[most-popular-brand][' + length + '][categoryid]" id="mobileapp-most-popular-brand-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-most-popular-brand-"]', function(){
	var type = "most_popular_brands";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-featured-offer').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-featured-offer-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[featured-offer][' + length + '][image]" id="mobileapp-featured-offer-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[featured-offer][' + length + '][heading]" id="mobileapp-featured-offer-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[featured-offer][' + length + '][sub_heading]" id="mobileapp-featured-offer-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[featured-offer][' + length + '][discount_upto]" id="mobileapp-featured-offer-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[featured-offer][' + length + '][vendorid]" id="mobileapp-featured-offer-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[featured-offer][' + length + '][categoryid]" id="mobileapp-featured-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-featured-offer-"]', function(){
	var type = "featured_offer";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-bestseller').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-bestseller-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[bestseller][' + length + '][image]" id="mobileapp-bestseller-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[bestseller][' + length + '][heading]" id="mobileapp-bestseller-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[bestseller][' + length + '][sub_heading]" id="mobileapp-bestseller-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[bestseller][' + length + '][discount_upto]" id="mobileapp-bestseller-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[bestseller][' + length + '][vendorid]" id="mobileapp-bestseller-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[bestseller][' + length + '][categoryid]" id="mobileapp-bestseller-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-bestseller-"]', function(){
	var type = "bestsellers";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-new-on-spicebucket').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-new-on-spicebucket-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][image]" id="mobileapp-new-on-spicebucket-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][heading]" id="mobileapp-new-on-spicebucket-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][sub_heading]" id="mobileapp-new-on-spicebucket-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][discount_upto]" id="mobileapp-new-on-spicebucket-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][vendorid]" id="mobileapp-new-on-spicebucket-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][categoryid]" id="mobileapp-new-on-spicebucket-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-new-on-spicebucket-"]', function(){
	var type = "new_at_spice_bucket";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-daily-essentials-need').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-daily-essentials-need-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[daily-essentials-need][' + length + '][image]" id="mobileapp-daily-essentials-need-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[daily-essentials-need][' + length + '][heading]" id="mobileapp-daily-essentials-need-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[daily-essentials-need][' + length + '][sub_heading]" id="mobileapp-daily-essentials-need-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[daily-essentials-need][' + length + '][discount_upto]" id="mobileapp-daily-essentials-need-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[daily-essentials-need][' + length + '][vendorid]" id="mobileapp-daily-essentials-need-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[daily-essentials-need][' + length + '][categoryid]" id="mobileapp-daily-essentials-need-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-daily-essentials-need-"]', function(){
	var type = "daily_essential_needs";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-top-selling-brand').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-top-selling-brand-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[top-selling-brand][' + length + '][image]" id="mobileapp-top-selling-brand-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[top-selling-brand][' + length + '][heading]" id="mobileapp-top-selling-brand-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[top-selling-brand][' + length + '][sub_heading]" id="mobileapp-top-selling-brand-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[top-selling-brand][' + length + '][discount_upto]" id="mobileapp-top-selling-brand-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[top-selling-brand][' + length + '][vendorid]" id="mobileapp-top-selling-brand-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[top-selling-brand][' + length + '][categoryid]" id="mobileapp-top-selling-brand-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="remove-mobileapp-top-selling-brand-"]', function(){
	var type = "top_selling_brands";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

$('#add-mobile-app-recommend-for-you').click(function(){
	var id = $(this).attr('id');
	var length = $('#' + id + '-div > .row').length + 1;
	var html = '<div class="row"><div class="col-md-1"><button id="remove-mobileapp-recommend-for-you-' + length + '" class="btn btn-danger" type="button" data-id="' + length + '"><i class="fa fa-trash"></i></button></div><div class="col-md-11"><div class="row"><div class="col-md-3"><div class="position-relative mb-3"><label for="image" class="form-label">Image</label><input type="file" class="form-control" name="mobileapp[recommend-for-you][' + length + '][image]" id="mobileapp-recommend-for-you-' + length + '-image" placeholder="Choose Image" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="heading" class="form-label">Heading</label><input type="text" class="form-control" name="mobileapp[recommend-for-you][' + length + '][heading]" id="mobileapp-recommend-for-you-' + length + '-heading" placeholder="Enter Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="sub_heading" class="form-label">Sub Heading</label><input type="text" class="form-control" name="mobileapp[recommend-for-you][' + length + '][sub_heading]" id="mobileapp-recommend-for-you-' + length + '-sub_heading" placeholder="Enter Sub Heading" /></div></div><div class="col-md-3"><div class="position-relative mb-3"><label for="discount_upto" class="form-label">Discount Upto</label><input type="text" class="form-control" name="mobileapp[recommend-for-you][' + length + '][discount_upto]" id="mobileapp-recommend-for-you-' + length + '-discount_upto" placeholder="Enter Discount Upto" /></div></div></div><div class="row"><div class="col-md-6"><div class="position-relative mb-3"><label for="vendorid" class="form-label">Vendors</label><select class="form-control" name="mobileapp[recommend-for-you][' + length + '][vendorid]" id="mobileapp-recommend-for-you-' + length + '-vendorid" placeholder="Select Vendor"><option value=""></option>';
	<?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[recommend-for-you][' + length + '][categoryid]" id="mobileapp-recommend-for-you-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	html += '</select></div></div></div></div></div>';
	$('#' + id + '-div').append(html);
});
$(document).on('click', '[id^="mobileapp-recommend-for-you-"]', function(){
	var type = "recommended_for_you";
	var elementId = $(this).attr('id');
	var id = $(this).attr('data-id');
	$.post('/administrator/edit-static-pages/delete-mobile-app-home-page-element', {"_token": $('#defaultcsrftoken').val(), type: type, key: id}, function(result) {
		if(result.status == true){
			$('#' + elementId).parent().parent().remove();location.reload();

		}
	}, 'json');
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/staticpage/mobileapphome.blade.php ENDPATH**/ ?>