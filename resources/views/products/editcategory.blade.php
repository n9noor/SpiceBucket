@extends('wms.layout')
@section('content')
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
</div>
<div>
Edit Product Category: {{$category->name}}
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
<form action="/products/update-product-category/{{$category->id}}" method="post" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method("PUT")
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="category_name" class="form-label">Name</label>
<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name" value="{{$category->name}}" />
@error('category_name')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="category_slug" class="form-label">Slug</label>
<input type="text" class="form-control" name="category_slug" id="category_slug" placeholder="Enter category slug" value="{{$category->slug}}" />
@error('category_slug')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="position-relative mb-3">
<label for="category_description" class="form-label">Description</label>
<textarea class="form-control" name="category_description" id="category_description" placeholder="Enter Description">{{$category->description}}</textarea>
@error('category_description')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="category_image" class="form-label">Image</label>
<input type="file" name="category_image" id="category_image" class="form-control" onchange="displayImage(this, 'category-image-view');" />
<div id="category-image-view"><img src="{{(env('APP_ENV') == "production" ? url('/public/images/products/' . $category->image) : url('/images/products/' . $category->image))}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></div>
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="category_parent" class="form-label">Parent Category</label>
<select class="multiselect-dropdown form-control" name="category_parent" id="category_parent">
<option value="">No Parent</option>
@foreach($categories as $parentcategory)
<option value="{{$parentcategory->id}}"{{ $category->parent == $parentcategory->id ? " selected='selected'" : ""}}{{(in_array($parentcategory->id, $children)) ? ' disabled="disabled"' : '' }}>{{$parentcategory->name}}</option>
@endforeach
</select>
</div>
</div>
</div>
<button class="mt-1 btn btn-primary">Save</button>
</form>
</div>
</div>
@endsection

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/show-image.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('category_description');
</script>
@endpush