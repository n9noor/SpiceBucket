@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add User
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
        <form action="/administrator/save-user" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname" value="{{old('firstname')}}" />
                        @error('firstname')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname" value="{{old('lastname')}}" />
                        @error('lastname')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="emailid" class="form-label">Email ID</label>
                        <input type="text" class="form-control" name="emailid" id="emailid" placeholder="Enter Email ID" value="{{old('emailid')}}" />
                        @error('emailid')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter contact no" value="{{old('phone')}}" />
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control form-select" name="role_id" id="role_id">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" "{{old('role_id') == $role->id ? " selected='selected'" : ""}}">{{$role->rolename}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" />
                    </div>
                </div>
            </div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection