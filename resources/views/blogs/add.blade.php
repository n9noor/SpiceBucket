@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Blog
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
        <form action="/administrator/save-blog" enctype="multipart/form-data" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
							@foreach($categories as $category)
							<option value="{{$category->id}}"{{$category->id == old('category_id') ? " selected='selected'" : ""}}>{{$category->name}}</option>
							@endforeach
						</select>
                        @error('category_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{old('title')}}" onblur="$('#slug').val($(this).val().replace(/\W\s/g, '').replace(/ /g,'-').toLowerCase())" />
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Slug" value="{{old('slug')}}" />
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control" name="image" id="image" />
                        @error('image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{old('description')}}</textarea>
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
			</div>
			<button class="mt-1 mb-3 btn btn-primary">Save</button>
		</form>
	</div>
</div>
@endsection

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">CKEDITOR.replace('description');</script>
<script type="text/javascript" src="{{asset('backend/js/blog.js')}}"></script>
@endpush