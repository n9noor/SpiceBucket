@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Raise a Ticket
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
        <form action="/sellers/ticket/save" enctype="multipart/form-data" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" />
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Ticket Description</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Enter Description"></textarea>
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="position-relative mb-3">
                        <label for="ticketimages" class="form-label">Images</label>
                        <input type="file" multiple name="images[]" id="images" class="form-control" placeholder="Please choose" />
                        @error('images')
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
<script type="text/javascript" src="{{asset('backend/js/ticket.js')}}"></script>
@endpush