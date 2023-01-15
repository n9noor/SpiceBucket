@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
</div>
<div>
Vendors
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
<button type="button" onclick="window.location.href='/administrator/add-vendor'" title="Add New Vendor" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i>Add Vendor
</button>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="main-card mb-3 card">
<div class="card-body">
<div class="table-responsive">
<table class="mb-0 table table-bordered table-striped">
<thead><tr><th>#</th><th>Active</th><th>Approved</th><th>Store Name</th><th>GST Number</th><th>Responsible Person</th><th>Business Email ID</th><th>Phone</th></tr></thead>
<tbody>
@foreach($vendors as $vendor)
<tr>
<td nowrap>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/view-vendor/{{$vendor->id}}"><i class="btn-icon-wrapper fa fa-user"></i>View vendor</a>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/delete-vendor/{{$vendor->id}}"><i class="btn-icon-wrapper fa fa-trash"></i>Delete vendor</a>
</td>
<td nowrap><input data-column="is_active" data-type="vendors" data-id="{{$vendor->id}}" type="checkbox"{{$vendor->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
<td nowrap class="text-center">
@if($vendor->is_approved == 0)
<a data-id='{{$vendor->id}}' class="btn-icon btn-shadow btn-outline-2x btn btn-outline-success vendor-approve" href="javascript:void(0)"><i class="fa fa-check"></i></a>
<a onclick="$('#vendor_id').val({{$vendor->id}});" data-bs-toggle="modal" data-bs-target="#decline-comment-modal" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-danger vendor-not-approve" href="javascript:void(0)"><i class="fa fa-times"></i></a>
@elseif($vendor->is_approved == 1)
<div class="badge bg-success">Approved</div>
@elseif($vendor->is_approved == 2)
<div class="badge bg-danger">Disapproved</div>
@endif
</td>
<td nowrap>{{$vendor->store_name}}</td>
<td nowrap>{{$vendor->gst}}&nbsp;&nbsp;<button title="{{$vendor->verified == false ? "Verify GST Number" : "Verified"}}" class="p-0 btn-icon btn-icon-only btn-pill btn btn-outline-link{{$vendor->verified == false ? " verify-vendor-btn" : " text-success"}}" data-gstnumber="{{$vendor->gst}}"><i class="fa fa-check-circle btn-icon-wrapper"></i></button></td>
<td nowrap>{{$vendor->responsible_person}}</td>
<td nowrap>{{$vendor->business_emailid}}</td>
<td nowrap>{{$vendor->phone}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection

@push('externalJavascripts')
<script type="text/javascript" src="{{asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
@endpush

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
<div class="modal fade" id="decline-comment-modal" tabindex="-1" role="dialog" aria-labelledby="decline-comment-modal-label" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="decline-comment-modal-title">Decline Modal</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
</button>
</div>
<div class="modal-body">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="vendor_id" id="vendor_id" />
<div class="position-relative mb-3">
<label for="comment" class="form-label">Comment for Decline</label>
<textarea class="form-control" name="comment" id="comment" placeholder="Enter Decline Comment"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" id="save-decline-comment" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
@endpush
