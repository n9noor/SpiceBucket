<style type="text/css">
	#image-box img {
  width: auto;
  max-width: 100%;
  margin: 10px 10px 10px 0px;
}
</style>

@extends("wms.layout")
@section("content")

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
            @csrf
			<div class="row mb-4">
				
					<div class="col-md-10"><h4>Banner (360px * 184px)</h4></div>
				
				<div id="add-mobile-app-banner-div">
				@if(array_key_exists('banner', $mobileapp))
					@foreach($mobileapp['banner'] as $key => $banner)
					<div class="row">
                        <div class="col-md-3">
                        	<div class="row">
                        		<div class="col-md-11">
                            <div class="position-relative mb-3" id="image-box">
                                <input type="file" class="form-control" name="mobileapp[banner][{{$key}}]" id="mobileapp-banner-{{$key}}" />
                                <img src="{{ $banner }}" height="100" width="100" />
                            </div>
                        </div>
						<div class="col-md-1">
							<button id="remove-mobile-app-banner-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
						</div>
                        	</div>
                        </div>
					</div>
					@endforeach
				@endif
				</div>
				<div class="col-md-2"><button id="add-mobile-app-banner" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button></div>
				
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Latest Offer (296px * 154px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-latest-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-latest-offer-div">
				@if(array_key_exists('latest_offers', $mobileapp))
					@foreach($mobileapp['latest_offers'] as $key => $latestoffer)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-latest-offer-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[latest-offer][{{$key}}][image]" id="mobileapp-latest-offer-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $latestoffer))
									<img src="{{ $latestoffer['image'] }}" height="100" width="100" data-type="latest-offer" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][{{$key}}][heading]" id="mobileapp-latest-offer-{{$key}}-heading" placeholder="Enter Heading" value="{{$latestoffer['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][{{$key}}][sub_heading]" id="mobileapp-latest-offer-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$latestoffer['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[latest-offer][{{$key}}][discount_upto]" id="mobileapp-latest-offer-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$latestoffer['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[latest-offer][{{$key}}][vendorid]" id="mobileapp-latest-offer-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$latestoffer['vendorid'] == $vendor->id ? " selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[latest-offer][{{$key}}][categoryid]" id="mobileapp-latest-offer-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$latestoffer['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Banner After Latest Offer (360px * 160px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-banner-after-latest" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-banner-after-latest-div">
				@if(array_key_exists('banner_after_latest_offer', $mobileapp))
					@foreach($mobileapp['banner_after_latest_offer'] as $key => $bannerafterlatestoffer)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-banner-after-latest-offer-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][image]" id="mobileapp-banner-after-latest-offer-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $bannerafterlatestoffer))
									<img src="{{ $bannerafterlatestoffer['image'] }}" height="100" width="100" data-type="banner-after-latest-offer" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][heading]" id="mobileapp-banner-after-latest-offer-{{$key}}-heading" placeholder="Enter Heading" value="{{$bannerafterlatestoffer['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][sub_heading]" id="mobileapp-banner-after-latest-offer-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$bannerafterlatestoffer['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][discount_upto]" id="mobileapp-banner-after-latest-offer-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$bannerafterlatestoffer['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][vendorid]" id="mobileapp-banner-after-latest-offer-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$bannerafterlatestoffer['vendorid'] == $vendor->id ? " selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[banner-after-latest-offer][{{$key}}][categoryid]" id="mobileapp-banner-after-latest-offer-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$bannerafterlatestoffer['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Highly Discounted Offer (530px * 290px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-highly-discounted-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-highly-discounted-offer-div">
				@if(array_key_exists('highly_discounted_offers', $mobileapp))
					@foreach($mobileapp['highly_discounted_offers'] as $key => $highlydiscountedoffer)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-highly-discounted-offer-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][image]" id="mobileapp-highly-discounted-offer-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $highlydiscountedoffer))
									<img src="{{ $highlydiscountedoffer['image'] }}" height="100" width="100" data-type="highly-discounted-offer" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][heading]" id="mobileapp-highly-discounted-offer-{{$key}}-heading" placeholder="Enter Heading" value="{{$highlydiscountedoffer['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][sub_heading]" id="mobileapp-highly-discounted-offer-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$highlydiscountedoffer['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][discount_upto]" id="mobileapp-highly-discounted-offer-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$highlydiscountedoffer['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][vendorid]" id="mobileapp-highly-discounted-offer-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$highlydiscountedoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[highly-discounted-offer][{{$key}}][categoryid]" id="mobileapp-highly-discounted-offer-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$highlydiscountedoffer['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Spice Bucket Offers (500px * 225px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-spice-bucket-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-spice-bucket-offer-div">
				@if(array_key_exists('spice_bucket_offer', $mobileapp))
					@foreach($mobileapp['spice_bucket_offer'] as $key => $spicebucketoffer)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-spice-bucket-offer-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-{{$key}}-image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][image]" id="mobileapp-spice-bucket-offer-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $spicebucketoffer))
									<img src="{{ $spicebucketoffer['image'] }}" height="100" width="100" data-type="spicebucket-offer" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-{{$key}}-heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][heading]" id="mobileapp-spice-bucket-offer-{{$key}}-heading" placeholder="Enter Heading" value="{{$spicebucketoffer['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="mobileapp-spice-bucket-offer-{{$key}}-sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][sub_heading]" id="mobileapp-spice-bucket-offer-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$spicebucketoffer['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][discount_upto]" id="mobileapp-spice-bucket-offer-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$spicebucketoffer['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][vendorid]" id="mobileapp-spice-bucket-offer-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$spicebucketoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[spice-bucket-offer][{{$key}}][categoryid]" id="mobileapp-spice-bucket-offer-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$spicebucketoffer['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Most Popular Brand (300px 258px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-most-popular-brand" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-most-popular-brand-div">
				@if(array_key_exists('most_popular_brands', $mobileapp))
					@foreach($mobileapp['most_popular_brands'] as $key => $mostpopularbrand)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-most-popular-brand-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[most-popular-brand][{{$key}}][image]" id="mobileapp-most-popular-brand-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $mostpopularbrand))
									<img src="{{ $mostpopularbrand['image'] }}" height="100" width="100" data-type="most-popular-brand" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][{{$key}}][heading]" id="mobileapp-most-popular-brand-{{$key}}-heading" placeholder="Enter Heading" value="{{$mostpopularbrand['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][{{$key}}][sub_heading]" id="mobileapp-most-popular-brand-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$mostpopularbrand['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[most-popular-brand][{{$key}}][discount_upto]" id="mobileapp-most-popular-brand-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$mostpopularbrand['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[most-popular-brand][{{$key}}][vendorid]" id="mobileapp-most-popular-brand-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$mostpopularbrand['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[most-popular-brand][{{$key}}][categoryid]" id="mobileapp-most-popular-brand-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$mostpopularbrand['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Featured Offer (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-featured-offer" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-featured-offer-div">
				@if(array_key_exists('featured_offer', $mobileapp))
					@foreach($mobileapp['featured_offer'] as $key => $featuredoffer)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-featured-offer-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[featured-offer][{{$key}}][image]" id="mobileapp-featured-offer-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $featuredoffer))
									<img src="{{$featuredoffer['image']}}" height="100" width="100" data-type="featured-offer" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][{{$key}}][heading]" id="mobileapp-featured-offer-{{$key}}-heading" placeholder="Enter Heading" value="{{$featuredoffer['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][{{$key}}][sub_heading]" id="mobileapp-featured-offer-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$featuredoffer['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[featured-offer][{{$key}}][discount_upto]" id="mobileapp-featured-offer-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$featuredoffer['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[featured-offer][{{$key}}][vendorid]" id="mobileapp-featured-offer-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$featuredoffer['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[featured-offer][{{$key}}][categoryid]" id="mobileapp-featured-offer-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$featuredoffer['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Bestsellers (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-bestseller" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-bestseller-div">
				@if(array_key_exists('bestsellers', $mobileapp))
					@foreach($mobileapp['bestsellers'] as $key => $bestseller)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-bestseller-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[bestseller][{{$key}}][image]" id="mobileapp-bestseller-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $bestseller))
									<img src="{{ $bestseller['image'] }}" height="100" width="100" data-type="bestseller" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][{{$key}}][heading]" id="mobileapp-bestseller-{{$key}}-heading" placeholder="Enter Heading" value="{{$bestseller['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][{{$key}}][sub_heading]" id="mobileapp-bestseller-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$bestseller['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[bestseller][{{$key}}][discount_upto]" id="mobileapp-bestseller-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$bestseller['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[bestseller][{{$key}}][vendorid]" id="mobileapp-bestseller-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$bestseller['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[bestseller][{{$key}}][categoryid]" id="mobileapp-bestseller-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$bestseller['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>New on Spice Bucket (1031px * 694px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-new-on-spicebucket" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-new-on-spicebucket-div">
				@if(array_key_exists('new_at_spice_bucket', $mobileapp))
					@foreach($mobileapp['new_at_spice_bucket'] as $key => $newonspicebucket)
				<div class="row">
					<div class="col-md-1">
						<button id="mobileapp-new-on-spicebucket-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][image]" id="mobileapp-new-on-spicebucket-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $newonspicebucket))
									<img src="{{ $newonspicebucket['image'] }}" height="100" width="100" data-type="new-on-spicebucket" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][heading]" id="mobileapp-new-on-spicebucket-{{$key}}-heading" placeholder="Enter Heading" value="{{$newonspicebucket['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][sub_heading]" id="mobileapp-new-on-spicebucket-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$newonspicebucket['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][discount_upto]" id="mobileapp-new-on-spicebucket-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$newonspicebucket['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][vendorid]" id="mobileapp-new-on-spicebucket-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$newonspicebucket['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[new-on-spicebucket][{{$key}}][categoryid]" id="mobileapp-new-on-spicebucket-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$newonspicebucket['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Daily Essentials Need (492px * 587px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-daily-essentials-need" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-daily-essentials-need-div">
				@if(array_key_exists('daily_essential_needs', $mobileapp))
					@foreach($mobileapp['daily_essential_needs'] as $key => $dailyessentialsneed)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-daily-essentials-need-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][image]" id="mobileapp-daily-essentials-need-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $dailyessentialsneed))
									<img src="{{ $dailyessentialsneed['image'] }}" height="100" width="100" data-type="daily-essentials-need" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][heading]" id="mobileapp-daily-essentials-need-{{$key}}-heading" placeholder="Enter Heading" value="{{$dailyessentialsneed['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][sub_heading]" id="mobileapp-daily-essentials-need-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$dailyessentialsneed['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][discount_upto]" id="mobileapp-daily-essentials-need-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$dailyessentialsneed['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][vendorid]" id="mobileapp-daily-essentials-need-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$dailyessentialsneed['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[daily-essentials-need][{{$key}}][categoryid]" id="mobileapp-daily-essentials-need-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$dailyessentialsneed['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Banner After Daily Essentials Need (230px * 121px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-banner-after-daily-essentials-need" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-banner-after-daily-essentials-need-div">
				@if(array_key_exists('banner_after_daily_essentials_need', $mobileapp))
					@foreach($mobileapp['banner_after_daily_essentials_need'] as $key => $bannerafterdailyessentialsneed)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-banner-after-daily-essentials-need-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][image]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $bannerafterdailyessentialsneed))
									<img src="{{ $bannerafterdailyessentialsneed['image'] }}" height="100" width="100" data-type="banner-after-daily-essentials-need" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][heading]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-heading" placeholder="Enter Heading" value="{{$bannerafterdailyessentialsneed['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][sub_heading]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$bannerafterdailyessentialsneed['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][discount_upto]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$bannerafterdailyessentialsneed['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][vendorid]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$bannerafterdailyessentialsneed['vendorid'] == $vendor->id ? " selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[banner-after-daily-essentials-need][{{$key}}][categoryid]" id="mobileapp-banner-after-daily-essentials-need-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$bannerafterdailyessentialsneed['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Top Selling Brand (512px * 512px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-top-selling-brand" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-top-selling-brand-div">
				@if(array_key_exists('top_selling_brands', $mobileapp))
					@foreach($mobileapp['top_selling_brands'] as $key => $topsellingbrand)
				<div class="row">
					<div class="col-md-1">
						<button id="remove-mobileapp-top-selling-brand-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[top-selling-brand][{{$key}}][image]" id="mobileapp-top-selling-brand-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $topsellingbrand))
									<img src="{{ $topsellingbrand['image'] }}" height="100" width="100" data-type="top-selling-brand" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][{{$key}}][heading]" id="mobileapp-top-selling-brand-{{$key}}-heading" placeholder="Enter Heading" value="{{$topsellingbrand['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][{{$key}}][sub_heading]" id="mobileapp-top-selling-brand-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$topsellingbrand['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[top-selling-brand][{{$key}}][discount_upto]" id="mobileapp-top-selling-brand-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$topsellingbrand['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[top-selling-brand][{{$key}}][vendorid]" id="mobileapp-top-selling-brand-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$topsellingbrand['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[top-selling-brand][{{$key}}][categoryid]" id="mobileapp-top-selling-brand-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$topsellingbrand['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-10"><h4>Recommend for You (450px * 562px)</h4></div>
				<div class="col-md-2"><button id="add-mobile-app-recommend-for-you" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></div>
				<div id="add-mobile-app-recommend-for-you-div">
				@if(array_key_exists('recommended_for_you', $mobileapp))
					@foreach($mobileapp['recommended_for_you'] as $key => $recommendforyou)
				<div class="row">
					<div class="col-md-1">
						<button id="mobileapp-recommend-for-you-{{$key}}" class="btn btn-danger" type="button" data-id="{{$key}}"><i class="fa fa-trash"></i></button>
					</div>
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control" name="mobileapp[recommend-for-you][{{$key}}][image]" id="mobileapp-recommend-for-you-{{$key}}-image" placeholder="Choose Image" />
									@if(array_key_exists('image', $recommendforyou))
									<img src="{{ $recommendforyou['image'] }}" height="100" width="100" data-type="recommend-for-you" data-id="{{$key}}" />
									@endif
									@error('image')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="heading" class="form-label">Heading</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][{{$key}}][heading]" id="mobileapp-recommend-for-you-{{$key}}-heading" placeholder="Enter Heading" value="{{$recommendforyou['heading']}}" />
									@error('heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="sub_heading" class="form-label">Sub Heading</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][{{$key}}][sub_heading]" id="mobileapp-recommend-for-you-{{$key}}-sub_heading" placeholder="Enter Sub Heading" value="{{$recommendforyou['sub_heading']}}" />
									@error('sub_heading')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative mb-3" id="image-box">
									<label for="discount_upto" class="form-label">Discount Upto</label>
									<input type="text" class="form-control" name="mobileapp[recommend-for-you][{{$key}}][discount_upto]" id="mobileapp-recommend-for-you-{{$key}}-discount_upto" placeholder="Enter Discount Upto" value="{{$recommendforyou['discount_upto']}}" />
									@error('discount_upto')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="vendorid" class="form-label">Vendors</label>
									<select class="form-control" name="mobileapp[recommend-for-you][{{$key}}][vendorid]" id="mobileapp-recommend-for-you-{{$key}}-vendorid" placeholder="Select Vendor">
										<option value=""></option>
										@foreach($vendors as $vendor)
										<option value="{{$vendor->id}}" {{$recommendforyou['vendorid'] == $vendor->id ? "selected='selected'" : ""}}>{{$vendor->store_name}}</option>
										@endforeach
									</select>
									@error('vendorid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative mb-3" id="image-box">
									<label for="categoryid" class="form-label">Category</label>
									<select class="form-control" name="mobileapp[recommend-for-you][{{$key}}][categoryid]" id="mobileapp-recommend-for-you-{{$key}}-categoryid" placeholder="Select Category">
										<option value=""></option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{$recommendforyou['categoryid'] == $category->id ? "selected='selected'" : ""}}>{{$category->name}}</option>
										@endforeach
									</select>
									@error('categoryid')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
					@endforeach
				@endif
				</div>
			</div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/static-page.js')}}"></script>
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[banner-after-latest-offer][' + length + '][categoryid]" id="mobileapp-banner-after-latest-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[banner-after-daily-essentials-need][' + length + '][categoryid]" id="mobileapp-banner-after-daily-essentials-need-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[latest-offer][' + length + '][categoryid]" id="mobileapp-latest-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[highly-discounted-offer][' + length + '][categoryid]" id="mobileapp-highly-discounted-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[spice-bucket-offer][' + length + '][categoryid]" id="mobileapp-spice-bucket-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[most-popular-brand][' + length + '][categoryid]" id="mobileapp-most-popular-brand-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[featured-offer][' + length + '][categoryid]" id="mobileapp-featured-offer-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[bestseller][' + length + '][categoryid]" id="mobileapp-bestseller-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[new-on-spicebucket][' + length + '][categoryid]" id="mobileapp-new-on-spicebucket-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[daily-essentials-need][' + length + '][categoryid]" id="mobileapp-daily-essentials-need-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[top-selling-brand][' + length + '][categoryid]" id="mobileapp-top-selling-brand-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
	@foreach($vendors as $vendor)
	html += '<option value="{{$vendor->id}}">{{$vendor->store_name}}</option>';
	@endforeach
	html += '</select></div></div><div class="col-md-6"><div class="position-relative mb-3"><label for="categoryid" class="form-label">Category</label><select class="form-control" name="mobileapp[recommend-for-you][' + length + '][categoryid]" id="mobileapp-recommend-for-you-' + length + '-categoryid" placeholder="Select Category"><option value=""></option>';
	@foreach($categories as $category)
	html += '<option value="{{$category->id}}">{{$category->name}}</option>';
	@endforeach
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
@endpush