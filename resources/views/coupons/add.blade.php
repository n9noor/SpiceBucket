@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Coupon
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i> Back
            </button>
        </div>
    </div>
</div>
<form action="/administrator/save-coupon" method="post" class="form-horizontal">
    @csrf
    <div class="main-card mb-3 card">
        <div class="card-header">Coupon Information</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Coupon Title" />
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Coupon Description</label>
                        <textarea class="form-control" name="coupon_description" id="coupon_description" placeholder="Enter Description for Coupon"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="start_datetime" class="form-label">Start DateTime</label>
                        <input type="text" class="form-control" name="start_datetime" id="start_datetime" placeholder="Enter Start Date" />
                        @error('start_datetime')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="end_datetime" class="form-label">End DateTime</label>
                        <input type="text" class="form-control" name="end_datetime" id="end_datetime" placeholder="Enter End Date" />
                        @error('end_datetime')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="coupon_code" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" />
                        @error('coupon_code')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="coupon_type" class="form-label">Which Payment Mode </label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_mode_apply" value="0" id="both" checked>
                            <label class="form-check-label" for="both">
                                Both
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_mode_apply" value="1" id="online">
                            <label class="form-check-label" for="online">
                                Online
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_mode_apply" value="2" id="cod">
                            <label class="form-check-label" for="cod">
                               Cod
                            </label>
                        </div>
                        @error('payment_mode_apply')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="minimum_cart_amount" class="form-label">Minimum Cart Amount</label>
                        <input type="text" class="form-control" name="minimum_cart_amount" id="minimum_cart_amount" placeholder="Enter Min Cart Amount" />
                        @error('minimum_cart_amount')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="coupon_type" class="form-label">Coupon Type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="coupon_type" value="flat" id="coupon_type_flat" checked>
                                    <label class="form-check-label" for="coupon_type_flat">
                                        Flat
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="coupon_type" value="percent" id="coupon_type_percent">
                                    <label class="form-check-label" for="coupon_type_percent">
                                        %
                                    </label>
                                </div>
                                @error('coupon_type')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="position-relative mb-3" id="flat_coupon_div">
                                <label for="flat_coupon_off" class="form-label">Discount Amount</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class=""><i class="fa fa-rupee-sign"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="flat_coupon_off" id="flat_coupon_off" placeholder="Enter Discount Amount" />
                                    </div>
                                    @error('flat_coupon_off')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                            </div>
                            <div class="position-relative mb-3" id="percent_coupon_div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="percent_coupon_off" class="form-label">Discount Percentage</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="percent_coupon_off" id="percent_coupon_off" placeholder="Enter Discount Amount" />
                                            <div class="input-group-text">
                                                <span class="">%</span>
                                            </div>
                                        </div>
                                        @error('percent_coupon_off')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="percent_coupon_max_off" class="form-label">Maximum Discount Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class=""><i class="fa fa-rupee-sign"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="percent_coupon_max_off" id="percent_coupon_max_off" placeholder="Enter Maximum Discount Amount" />
                                        </div>
                                        @error('percent_coupon_max_off')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="no_of_time" class="form-label">Number Of Times</label>
                        <input type="text" class="form-control" name="no_of_time" id="no_of_time" placeholder="Enter Number Of time" />
                        @error('no_of_time')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">Filters</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="vendors" class="form-label">Vendors</label>
                        <select id="vendors" name="vendors[]" multiple="" class="multiselect-dropdown form-control">
                            @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->store_name}} ( {{$vendor->vendor_alias}} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="customers" class="form-label">Customers</label>
                        <select id="customers" name="customers[]" multiple="" class="multiselect-dropdown form-control">
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="products" class="form-label">Products</label>
                        <select id="products" name="products[]" multiple="" class="multiselect-dropdown form-control">
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <select id="categories" name="categories[]" multiple="" class="multiselect-dropdown form-control">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="mt-1 mb-3 btn btn-primary">Save</button>
</form>
@endsection

@push('externalJavascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.js')}}"></script>
@endpush
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/coupon.js')}}"></script>
@endpush
@push('stylesheets')
<link href="{{asset('/backend/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endpush

@push('externalJavascripts')
<script src="{{asset('/backend/summernote/summernote-lite.min.js')}}"></script>
@endpush

@push('javascripts')
<script>
    $('#coupon_description').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        dialogsInBody: true
    });
</script>
@endpush