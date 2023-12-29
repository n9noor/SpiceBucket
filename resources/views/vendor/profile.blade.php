@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Profile: {{$vendor->store_name}}
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
        <form action="/sellers/update-profile" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="gst" class="form-label">Good and Service Tax (GST) Number</label>
                        <input name="gst" readonly="readonly" id="gst" placeholder="GST Number" type="text" class="form-control" value="{{$vendor->gst}}">
                        @error('gst')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="responsible_person" class="form-label">Responsible Person</label>
                        <input name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="{{$vendor->responsible_person}}">
                        @error('responsible_person')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="store_name" class="form-label">Store Name</label>
                        <input name="store_name" id="store_name" placeholder="Store Name" type="text" class="form-control" value="{{$vendor->store_name}}">
                        @error('store_name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input name="brand_name" id="brand_name" placeholder="Brand Name" type="text" class="form-control" value="{{$vendor->vendor_alias}}">
                        @error('brand_name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="store_address" class="form-label">Store Address</label>
                        <textarea name="store_address" id="store_address" placeholder="Store Address" class="form-control">{{$vendor->address}}</textarea>
                        @error('store_address')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="email" class="form-label">
                            Business Email
                        </label>
                        <div class="input-group">
                            <input name="email" readonly="readonly" id="email" placeholder="Email here..." type="email" class="form-control" value="{{$vendor->business_emailid}}">
                            @if($vendor->email_verified == true)
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            @else
                            <button type="button" class="btn btn-primary" onclick="verifyEmail($('#email').val())"><i class="fa fa-sign"></i> Verify</button>
                            @endif
                        </div>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="alternateemail" class="form-label">
                            Alternate Business Email
                        </label>
                        <div class="input-group">
                            <input name="alternateemail" id="alternateemail" placeholder="Email here..." type="email" class="form-control" value="{{$vendor->alternateemail_business_emailid}}">
                            @if($vendor->alternate_email_verified == true)
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            @else
                            <button type="button" class="btn btn-primary" onclick="verifyAltEmail($('#alternateemail').val())"><i class="fa fa-sign"></i> Verify</button>
                            @endif
                        </div>
                        @error('alternateemail')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="phone" class="form-label">
                            Phone
                        </label>
                        <div class="input-group">
                            <input name="phone" id="phone" placeholder="Mobile Number" type="text" class="form-control" value="{{$vendor->phone}}">
                            @if($vendor->phone_verified == true)
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            @else
                            <button type="button" class="btn btn-primary" onclick="verifyPhone($('#phone').val())"><i class="fa fa-sign"></i> Verify</button>
                            @endif
                        </div>
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
                        <input name="shipping_pincode" id="shipping_pincode" placeholder="Shipping Pincode" type="text" class="form-control" value="{{$vendor->shipping_pincode}}">
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
                        <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image) }}" class="img-thumbnail" />
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
<div class="modal fade" id="verify-otp-modal" tabindex="-1" role="dialog" aria-labelledby="verify-otp-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verify-otp-modal-title">Enter OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="position-relative mb-3">
                            <input type="hidden" id="verify-type" name="verify-type" />
                            <input name="otpchar" id="otpchar" type="text" class="form-control" />
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id='verify-otp'>Verify</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
@endpush