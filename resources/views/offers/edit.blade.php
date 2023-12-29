@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Offer
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
        <form action="/offer/update/{{$offer->id}}" enctype="multipart/form-data" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Choose Image" />
                        <img width="100" height="100" src="{{ env('APP_ENV') == 'production' ? url('/public/images/offers/' . $offer->imagepath) : url('/images/offers/' . $offer->imagepath) }}" class="img-thumbnail" />
                        @error('image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Heading" value="{{$offer->heading}}" />
                        @error('heading')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="sub_heading" class="form-label">Sub Heading</label>
                        <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Enter Sub Heading" value="{{$offer->heading}}" />
                        @error('sub_heading')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative mb-3">
                        <label for="discount_upto" class="form-label">Discount Upto</label>
                        <input type="text" class="form-control" name="discount_upto" id="discount_upto" placeholder="Enter Sub Heading" value="{{$offer->discount_upto}}" />
                        @error('discount_upto')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="vendorid" class="form-label">Vendors</label>
                        <select class="form-control" name="vendorid" id="vendorid" placeholder="Select Vendor">
                            <option value=""></option>
                            @foreach($vendors as $vendor)
                            <option {{$offer->vendor_id == $vendor->id ? "selected='selected'" : "" }} value="{{$vendor->id}}">{{$vendor->store_name}}</option>
                            @endforeach
                        </select>
                        @error('vendorid')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="categoryid" class="form-label">Category</label>
                        <select class="form-control" name="categoryid" id="categoryid" placeholder="Select Category">
                            <option value=""></option>
                            @foreach($categories as $category)
                            <option {{$offer->category_id == $category->id ? "selected='selected'" : "" }} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('categoryid')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" {{$offer->is_featured == 1 ? "checked='checked'" : "" }}  name="is_featured" id="is_featured">
                        <label class="form-check-label" for="is_featured">
                            Is Featured?
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="featured_category" id="featured_category" placeholder="">
                        <option value=""></option>
                        <option {{$offer->featured_category == "most_popular_brands" ? "selected='selected'" : "" }} value="most_popular_brands">Most Popular Brands</option>
                        <option {{$offer->featured_category == "latest_offers" ? "selected='selected'" : "" }} value="latest_offers">Latest Offers</option>
                        <option {{$offer->featured_category == "top_selling_brands" ? "selected='selected'" : "" }} value="top_selling_brands">Top Selling Brands</option>
                        <option {{$offer->featured_category == "deal_of_the_day" ? "selected='selected'" : "" }} value="deal_of_the_day">Deal of the Day</option>
                        <option {{$offer->featured_category == "highly_discounted_offers" ? "selected='selected'" : "" }} value="highly_discounted_offers">Highly Discounted Offer</option>
                        <option {{$offer->featured_category == "new_at_spice_bucket" ? "selected='selected'" : "" }} value="new_at_spice_bucket">New At Spice Bucket</option>
                        <option {{$offer->featured_category == "daily_essential_needs" ? "selected='selected'" : "" }} value="daily_essential_needs">Daily Essential Needs</option>
                        <option {{$offer->featured_category == "popular_stores" ? "selected='selected'" : "" }} value="popular_stores">Popular Stores</option>
                        <option {{$offer->featured_category == "bestsellers" ? "selected='selected'" : "" }} value="bestsellers">Bestsellers</option>
                        <option {{$offer->featured_category == "recommended_for_you" ? "selected='selected'" : "" }} value="recommended_for_you">Recommended For You</option>
                    </select>
                </div>
            </div>
            <button class="mt-1 mb-3 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/offers.js')}}"></script>
@endpush