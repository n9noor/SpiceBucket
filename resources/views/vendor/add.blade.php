@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Vendor
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
        <h5 class="card-title">Add Vendor</h5>
        <form action="/administrator/save-vendor" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="gst" class="form-label">Good and Service Tax (GST) Number</label>
                        <div class="input-group">
                            <input name="gst" id="gst" placeholder="GST Number" type="text" class="form-control" value="{{old('gst')}}">
                            <button type="button" class="btn btn-primary" onclick="verify($('#gst').val())"><i class="fa fa-sign"></i> Validate</button>
                        </div>
                        @error('gst')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="responsible_person" class="form-label">Responsible Person</label>
                        <input name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="{{old('responsible_person')}}">
                        @error('responsible_person')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="vendor_alias" class="form-label">Store Nick Name</label>
                        <input name="vendor_alias" id="vendor_alias" placeholder="Store nick name" type="text" class="form-control" value="{{old('vendor_alias')}}">
                        @error('vendor_alias')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="store_name" class="form-label">Store Name</label>
                        <input name="store_name" id="store_name" placeholder="Store Name" readonly="readonly" type="text" class="form-control" value="{{old('store_name')}}">
                        @error('store_name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="store_address" class="form-label">Store Address</label>
                        <textarea name="store_address" id="store_address" placeholder="Store Address" readonly="readonly" class="form-control">{{old('store_address')}}</textarea>
                        @error('store_address')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="email" class="form-label">
                            Business Email
                        </label>
                        <input name="email" id="email" placeholder="Email here..." type="email" class="form-control" value="{{old('email')}}">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="phone" class="form-label">
                            Phone
                        </label>
                        <input name="phone" id="phone" placeholder="Mobile Number" type="text" class="form-control" value="{{old('phone')}}">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="shipping_pincode" class="form-label">
                            Shipping Pincode
                        </label>
                        <input name="shipping_pincode" id="shipping_pincode" placeholder="Shipping Pincode" type="text" class="form-control" value="{{old('shipping_pincode')}}">
                        @error('shipping_pincode')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="image" class="form-label">
                            Logo
                        </label>
                        <input name="image" id="image" type="file" class="form-control">
                        @error('image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
@endpush