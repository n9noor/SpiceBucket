@extends("wms.layout")
@section("content")
<div class="main-card mb-3 card">
<div class="card-body">
<h5 class="card-title">Add Vendor</h5>
<form action="/administrator/save-vendor" method="post" class="form-horizontal">
@csrf
<div class="row">
<div class="col-md-6">
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
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="responsible_person" class="form-label">Responsible Person</label>
<input name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="{{old('responsible_person')}}">
@error('responsible_person')
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
</div>
<button class="mt-1 btn btn-primary">Save</button>
</form>
</div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
@endpush