@extends('wms.layout')
@section('content')
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
</div>
<div>
Edit Product: {{$product->name}}
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
<form action="/products/update-product/{{$product->id}}" method="post" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method("PUT")
<div class="main-card mb-3 card">
<h1 class="card-header">Product Information</h1>
<div class="card-body">
<div class="row">
<div class="col-md-2">
<div class="position-relative mb-3">
<label for="category_id" class="form-label">Category</label>
<select class="multiselect-dropdown form-control" name="category_id" id="category_id" placeholder="Select category">
<option value=""></option>
@foreach($catgories as $category)
<option value="{{$category->id}}" {{ $category->id == $product->category_id ? " selected='selected'" : ""}}>{{$category->name}}</option>
@endforeach
</select>
@error('category_id')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="product_type" class="form-label" style="display:block;">Product Type</label>
<div class="form-check form-check-inline">
<input class="form-check-input"{{ $product->product_type == 1 ? " checked='checked'" : ""}} type="radio" name="product_type" id="product_type_veg" value="1">
<label class="form-check-label" for="product_type_veg">Veg</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input"{{ $product->product_type == 2 ? " checked='checked'" : ""}}  type="radio" name="product_type" id="product_type_nonveg" value="2">
<label class="form-check-label" for="product_type_nonveg">Non Veg</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input"{{ $product->product_type == 0 ? " checked='checked'" : ""}}  type="radio" name="product_type" id="product_type_na" value="0">
<label class="form-check-label" for="product_type_na">N/A</label>
</div>
@error('product_type')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="{{session('admin-logged-in') == true ? 'col-md-4' : 'col-md-7' }}">
<div class="position-relative mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$product->name}}" />
@error('name')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
@if(session('admin-logged-in') == true)
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="vendor_id" class="form-label">Vendor</label>
<select class="form-control" name="vendor_id" id="vendor_id" placeholder="Select Vendor">
<option value=""></option>
@foreach($vendors as $vendor)
<option value="{{$vendor->id}}"{{(old('vendor_id') == $vendor->id || $vendor->id == $product->vendor_id) ? " selected='selected'" : ""}}>{{$vendor->store_name}} ({{$vendor->responsible_person}})</option>
@endforeach
</select>
@error('vendor_id')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
@elseif(session('vendor-logged-in') == true)
<input type="hidden" name="vendor_id" id="vendor_id" value="{{$product->vendor_id}}" />
@endif
</div>
<div class="row">
<div class="col-md-12">
<div class="position-relative mb-3">
<label for="summary" class="form-label">Summary</label>
<textarea class="form-control" name="summary" id="summary" placeholder="Enter Summary">{{$product->summary}}</textarea>
@error('summary')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="position-relative mb-3">
<label for="description" class="form-label">Description</label>
<textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{$product->description}}</textarea>
@error('description')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="hsn_code" class="form-label">HSN Code</label>
<input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="Enter HSN Code" value="{{$product->hsn_code}}" />
@error('hsn_code')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="sku" class="form-label">SKU</label>
<input type="text" name="sku" id="sku" class="form-control" placeholder="Enter SKU" value="{{$product->sku}}" />
@error('sku')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="barcode" class="form-label">Barcode</label>
<input type="text" name="barcode" id="barcode" class="form-control" placeholder="Enter Barcode" value="{{$product->barcode}}" />
@error('barcode')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="origin" class="form-label">Origin</label>
<input type="text" name="origin" id="origin" class="form-control" placeholder="Enter Origin" value="{{$product->origin}}" />
@error('origin')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<h1 class="card-header">Product Image</h1>
<div class="card-body">
<div class="row">
@for($i=1; $i<=12; $i++)
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="product_image_{{$i}}" class="form-label"><div id="product-image-view-{{$i}}"><img class="mx-5 my-3 img-thumbnail" src="{{asset('images/upload.png')}}" width="200" height="200"></div></label>
<input style="display:none" type="file" name="product_image[]" id="product_image_{{$i}}" class="form-control" onchange="displayImage(this, 'product-image-view-{{$i}}');" />
</div>
</div>
@endfor
</div>
</div>
</div>
<div class="main-card mb-3 card">
<h1 class="card-header">Video Code</h1>
<div class="card-body">
<div class="row">
@for($i=1; $i<=4; $i++)
@php
$video_link = json_decode($product->video_url, true)
@endphp
<div class="col-md-6 mb-4">
<div class="input-group">
<div class="input-group-text">
<span class="">https://www.youtube.com/embed/</span>
</div>
<input type="text" class="form-control" name="video_link[]" id="video_link_{{$i}}" value="{{$video_link[$i-1]}}">
</div>
</div>
@endfor
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="card-header">Pricing</div>
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<div class="position-relative mb-3">
<label for="selling_price" class="form-label">Selling Price</label>
<input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="Enter Selling Price" value="{{$product->product_mrp}}" />
@error('selling_price')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="position-relative mb-3">
<label for="net_price" class="form-label">Net Price</label>
<input type="text" class="form-control" name="net_price" id="net_price" value="{{$product->net_price}}" placeholder="Enter Net Price" />
</div>
</div>
<div class="col-md-4">
<div class="position-relative mb-3">
<label for="discount_price" class="form-label">Discount</label>
<div class="input-group">
<input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Discount" value="{{$product->discount_price}}" readonly />
<div class="input-group-text">
<span class="">%</span>
</div>
</div>
@error('discount_price')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="moq" class="form-label">MOQ Quantity</label>
<input type="text" class="form-control" name="moq" id="moq" value="{{$product->moq}}" placeholder="Enter MOQ" />
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="cost" class="form-label">Cost Price</label>
<input type="text" class="form-control" name="cost" id="cost" value="{{$product->cost}}" placeholder="Enter COST" />
</div>
</div>
</div>
</div>
<!--
<div class="col-md-6 bg-info p-2">
<h3 class="card-title text-white">B2B Pricing</h3>
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="b2b_price" class="form-label text-white">Price</label>
<input type="text" class="form-control" name="b2b_price" id="b2b_price" value="{{$product->b2b_price}}" placeholder="Enter B2B Price" />
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="b2b_moq" class="form-label text-white">MOQ</label>
<input type="text" class="form-control" name="b2b_moq" id="b2b_moq" value="{{$product->b2b_moq}}" placeholder="Enter B2B MOQ" />
</div>
</div>
</div>
</div>
-->
</div>
</div>
</div>
<div class="row">
<div class="col-md-3 pt-4">
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" id="taxable" name="taxable"{{$product->taxable == true ? " checked='checked'" : ""}}>
<label class="form-check-label" for="taxable">Taxable</label>
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="taxable_rate" class="form-label">Tax Rate</label>
<div class="input-group">
<input type="text" class="form-control" name="taxable_rate" id="taxable_rate" value="{{$product->tax_rate}}" readonly />
<div class="input-group-text">
<span class="">%</span>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="taxable_amount" class="form-label">Tax Amount</label>
<input type="text" class="form-control" name="taxable_amount" id="taxable_amount" value="{{$product->tax_amount}}" readonly />
</div>
</div>
<div class="col-md-3">
<div class="position-relative mb-3">
<label for="net_price_without_tax" class="form-label">Net Price Without Tax</label>
<input type="text" class="form-control" name="net_price_without_tax" id="net_price_without_tax" value="{{$product->net_price_with_tax}}" readonly />
</div>
</div>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<h1 class="card-header">Variants</h1>
<div class="card-body">
<div id="variant-table" class="my-3 default-hide p-4 table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th nowrap>Variant</th>
<th>Product Price</th>
<th>Net Price</th>
<th>Discount Price</th>
<th>B2B Product Price</th>
<th>SKU (Optional)</th>
<th>Barcode (Optional)</th>
<th>Weight</th>
<th>Quantity (Optional)</th>
</tr>
</thead>
<tbody>
@foreach($productVariant as $variant)
<tr>
<th nowrap><input class='readonly-as-label' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][label]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_label' value="{{$val['label']}}" readonly /></th>
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][product_mrp]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_product_mrp' value="{{$val['product_mrp']}}"></td>
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][net_price]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_net_price' value="{{$val['net_price']}}"></td>
<td><div class='input-group'><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][discount_price]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_discount_price' readonly value="{{$val['discount_price']}}"><div class='input-group-text'><span class=''>%</span></div></div></td>
<!-- <td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][b2b_price]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_b2b_price'></td> -->
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][sku]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_sku' value="{{$val['sku']}}"></td>
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][barcode]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_barcode' value="{{$val['barcode']}}"></td>
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][net_weight]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_net_weight' value="{{$val['net_weight']}}"></td>
<td><input class='form-control' type='text' name='variant[{{$variant_id}}][{{$variant_value_id}}][{{$obj3}}][quantity]' id='variant_{{$variant_id}}_{{$variant_value_id}}_{{$obj3}}_quantity' value="{{$val['quantity']}}"></td>
</tr>
@endforeach
</tbody>
</table>    
</div>
</div>
</div>
<button class="mt-1 mb-3 btn btn-primary">Save</button>
</form>
@endsection

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/show-image.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('description');
</script>
@endpush