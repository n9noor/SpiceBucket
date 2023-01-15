@extends("wms.layout")
@section("content")
<div class="main-card mb-3 card">
<div class="card-body">
<h5 class="card-title">Add Vendor</h5>
<form action="javascript:void(0)" method="post" class="form-horizontal">
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
<input readonly="readonly" name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="{{$vendor->responsible_person}}">
@error('responsible_person')
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
@foreach($types as $type)
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="document-{{str_replace(' ', '-', strtolower($type->type))}}" class="form-label">{{$type->type}}</label>
@if(array_key_exists(str_replace(' ', '_', strtolower($type->type)), $documents))
@if(substr($documents[str_replace(' ', '_', strtolower($type->type))], -4) == ".pdf")
<a target="_blank" href="{{url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{asset('/images/pdficon.png')}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
@else
<a target="_blank" href="{{url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
@endif
@endif
@error("document[{{str_replace(' ', '_', strtolower($type->type))}}]")
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
@endforeach
</div>
</form>
</div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
@endpush