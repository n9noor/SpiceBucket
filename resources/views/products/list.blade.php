@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
</div>
<div>
Product
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
@if(session('vendor-logged-in') == true)
<button type="button" onclick="$('#variant_value_id').val(0);$('#variant_id').val('');$('#variant_value').val('');" data-bs-toggle="modal" data-bs-target="#add-variant-value-modal" title="Add Variant Value" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i> Add Variant Value
</button>
<button type="button" onclick="$('#variant_type_id').val(0);$('#variant_type').val('');" data-bs-toggle="modal" data-bs-target="#add-variant-type-modal" title="Add Variant Type" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i> Add Variant Type
</button>
<button type="button" onclick="window.location.href='/products/add-product'" title="Add Product" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i> Add Product
</button>
@endif
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="g-0 row pt-3 pb-2 px-3">
<ul class="nav nav-pills">
<li class="nav-item">
<a data-bs-toggle="tab" href="#tab-content-product" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-danger">Product</a>
</li>
<li class="nav-item">
<a data-bs-toggle="tab" href="#tab-content-variant" class="border-0 btn-pill btn-wide btn-transition btn btn-outline-danger">Variant</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab-content-product" role="tabpanel">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead><tr><th>#</th><th>Active</th>
@if(session('admin-logged-in') == true)
<th>Vendor</th>
@endif
<th>Name</th><th>Category</th></tr></thead>
<tbody>
@foreach($products as $product)
<tr>
<td>
@if(session('vendor-logged-in') == true)
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/products/edit-product/{{$product->id}}"><i class="btn-icon-wrapper fa fa-user"></i>Edit Product</a>
@endif
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/products/delete-product/{{$product->id}}"><i class="btn-icon-wrapper fa fa-trash"></i>Delete Product</a>
</td>
<td><input data-column="is_active" data-type="product" data-id="{{$product->id}}" type="checkbox"{{$product->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
@if(session('admin-logged-in') == true)
<th>{{$product->vendor}}</th>
@endif
<td>{{$product->name}}</td>
<td>{{$product->categoryname}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="tab-pane" id="tab-content-variant" role="tabpanel">
<ul class="nav nav-pills nav-fill">
<li class="nav-item">
<a data-bs-toggle="tab" href="#tab-variant-type" class="nav-link active">Type</a>
</li>
<li class="nav-item">
<a data-bs-toggle="tab" href="#tab-variant-value" class="nav-link">Values</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab-variant-type" role="tabpanel">
<div class="table-responsive">
<table id="product-variant-type-table" class="table table-striped table-bordered">
<thead><tr><th>#</th><th>Active</th><th>Variant Type Name</th></tr></thead>
<tbody></tbody>
</table>
</div>
</div>
<div class="tab-pane" id="tab-variant-value" role="tabpanel">
<div class="table-responsive">
<table id="product-variant-value-table" class="table table-striped table-bordered">
<thead><tr><th>#</th><th>Active</th><th>Variant Type Name</th><th>Variant Type Value</th></tr></thead>
<tbody></tbody>
</table>
</div>
</div>
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
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/product-variant.js')}}"></script>

<div class="modal" id="add-variant-type-modal"  tabindex="-1" role="dialog" aria-labelledby="add-variant-type-modal-label" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="add-variant-type-modal-label">Variant Type</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<input type="hidden" name="variant_type_id" id="variant_type_id" />
<div class="position-relative mb-3">
<label for="variant_type" class="form-label">Variant Type</label>
<input type="text" class="form-control" name="variant_type" id="variant_type" placeholder="Enter variant type" />
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" id="save-variant-type" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>

<div class="modal" id="add-variant-value-modal"  tabindex="-1" role="dialog" aria-labelledby="add-variant-value-modal-label" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="add-variant-value-modal-label">Variant Value</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<input type="hidden" name="variant_value_id" id="variant_value_id" />
<div class="position-relative mb-3">
<label for="variant_id" class="form-label">Variant Type</label>
<select class="multiselect-dropdown form-control" name="variant_id" id="variant_id"></select>
</div>
<div class="position-relative mb-3">
<label for="variant_value" class="form-label">Variant value</label>
<input type="text" class="form-control" name="variant_value" id="variant_value" placeholder="Enter variant value" />
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" id="save-variant-value" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
@endpush