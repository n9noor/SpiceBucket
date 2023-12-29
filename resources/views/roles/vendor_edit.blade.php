@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Edit Role
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
        <form action="/sellers/update-role/{{$role->id}}" method="post" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="rolename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="rolename" id="rolename" placeholder="Enter rolename" value="{{$role->rolename}}" />
                        @error('rolename')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="parent" class="form-label">Parent</label>
                        <select class="form-control" disabled name="parent" id="parent" placeholder="Enter Firstname">
                            <option value="0"></option>
                            @foreach($roles as $selectrole)
                            <option value="{{$selectrole->id}}" {{$role->parent == $selectrole->id ? "selected='selected'" : ""}}>{{$role->rolename}}</option>
                            @endforeach
                        </select>
                        @error('parent')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{$role->description}}</textarea>
                        @error('description')
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