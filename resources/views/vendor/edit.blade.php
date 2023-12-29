@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                View Vendor: {{$vendor->store_name}}
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
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="gst" class="form-label">Good and Service Tax (GST) Number</label>
                    <input name="gst" readonly="readonly" id="gst" placeholder="GST Number" type="text" class="form-control" value="{{$vendor->gst}}">
                    @error('gst')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="responsible_person" class="form-label">Responsible Person</label>
                    <input readonly="readonly" name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="{{$vendor->responsible_person}}">
                    @error('responsible_person')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="vendor_alias" class="form-label">Store Nick Name</label>
                    <input readonly="readonly" name="vendor_alias" id="vendor_alias" placeholder="Store nick name" type="text" class="form-control" value="{{$vendor->vendor_alias}}">
                    @error('vendor_alias')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="store_name" class="form-label">Store Name</label>
                    <input name="store_name" id="store_name" placeholder="Store Name" readonly="readonly" type="text" class="form-control" value="{{$vendor->store_name}}">
                    @error('store_name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="store_address" class="form-label">Store Address</label>
                    <textarea name="store_address" id="store_address" placeholder="Store Address" readonly="readonly" class="form-control">{{$vendor->address}}</textarea>
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
                    <input name="email" readonly="readonly" id="email" placeholder="Email here..." type="email" class="form-control" value="{{$vendor->business_emailid}}">
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
                    <input name="phone" id="phone" readonly="readonly" placeholder="Mobile Number" type="text" class="form-control" value="{{$vendor->phone}}">
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
                    <input name="shipping_pincode" id="shipping_pincode" placeholder="Shipping Pincode" type="text" class="form-control" readonly="readonly" value="{{$vendor->shipping_pincode}}">
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
                    <input disabled name="image" id="image" type="file" class="form-control" />
                    <img src="{{ !is_null($vendor->image) ? (env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)) : url('/images/no-image-available.jpg') }}" class="img-thumbnail" />
                    @error('image')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            @foreach($types as $type)
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="document-{{str_replace(' ', '-', strtolower($type->type))}}" class="form-label">{{$type->type}}</label>
                    @if(array_key_exists(str_replace(' ', '_', strtolower($type->type)), $documents))
                    @if(substr($documents[str_replace(' ', '_', strtolower($type->type))], -4) == ".pdf")
                    <a target="_blank" href="{{url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{asset('/images/pdficon.png')}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                    @else
                    <a target="_blank" href="{{url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                    @endif
                    @endif
                    @error("document[{{str_replace(' ', '_', strtolower($type->type))}}]")
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
@endpush