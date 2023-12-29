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
        <form action="/offer/save" enctype="multipart/form-data" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Choose Image" />
                        @error('image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Heading" />
                        @error('heading')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="sub_heading" class="form-label">Sub Heading</label>
                        <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Enter Sub Heading" />
                        @error('sub_heading')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="discount_upto" class="form-label">Discount Upto</label>
                        <input type="text" class="form-control" name="discount_upto" id="discount_upto" placeholder="Enter Discount Upto" />
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
                            <option value="{{$vendor->id}}">{{$vendor->store_name}}</option>
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
                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                        <input class="form-check-input" type="checkbox" value="1" name="is_featured" id="is_featured">
                        <label class="form-check-label" for="is_featured">
                            Is Featured?
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="featured_category" id="featured_category" placeholder="">
                        <option value=""></option>
                        <option value="most_popular_brands">Most Popular Brands</option>
                        <option value="latest_offers">Latest Offers</option>
                        <option value="top_selling_brands">Top Selling Brands</option>
                        <option value="deal_of_the_day">Deal of the Day</option>
                        <option value="highly_discounted_offers">Highly Discounted Offer</option>
                        <option value="new_at_spice_bucket">New At Spice Bucket</option>
                        <option value="daily_essential_needs">Daily Essential Needs</option>
                        <option value="popular_stores">Popular Stores</option>
                        <option value="bestsellers">Bestsellers</option>
                        <option value="recommended_for_you">Recommended For You</option>
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