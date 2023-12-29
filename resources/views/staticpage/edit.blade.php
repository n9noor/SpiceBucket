@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Page
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
        <form action="/administrator/update-static-page/{{$page->id}}" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{$page->title}}" />
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter URL for the page" value="{{$page->url}}" />
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Description for Page"> {{$page->description}}</textarea>
                    </div>
                </div>
            </div>
            <fieldset>
                <legend>SEO Information</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="seo_title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="Enter SEO Title" value="{{$page->seo_title}}" />
                            @error('seo_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="seo_keywords" class="form-label">Keywords</label>
                            <input type="seo_keywords" class="form-control" name="seo_keywords" id="seo_keywords" placeholder="Enter  SEO Keywords" value="{{$page->seo_keywords}}" />
                            @error('seo_keywords')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="position-relative mb-3">
                            <label for="seo_description" class="form-label">Description</label>
                            <textarea name="seo_description" class="form-control" id="seo_description" placeholder="Enter SEO Description for Page">{{$page->seo_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="header_part" class="form-label">Script for HEAD Section</label>
                            <textarea name="header_part" class="form-control" id="header_part" placeholder="Script for HEAD Section">{{$page->head_part}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="footer_part" class="form-label">Script for BODY Section</label>
                            <textarea name="footer_part" class="form-control" id="footer_part" placeholder="Script for BODY Section">{{$page->foot_part}}</textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@push('stylesheets')
<link href="{{asset('/backend/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endpush

@push('externalJavascripts')
<script src="{{asset('/backend/summernote/summernote-lite.min.js')}}"></script>
@endpush

@push('javascripts')
<script>
    $('#description').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        dialogsInBody: true
    });
</script>
@endpush