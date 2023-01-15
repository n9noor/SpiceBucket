@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
</div>
<div>
Edit User: {{$user->firstname}} {{$user->lastname}}
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
<form action="/administrator/update-user/{{$user->id}}" method="post" class="form-horizontal">
@csrf
@method('PUT')
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="firstname" class="form-label">Firstname</label>
<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname" value="{{$user->firstname}}" />
@error('firstname')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="lastname" class="control-label">Lastname</label>
<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname" value="{{$user->lastname}}" />
@error('lastname')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="emailid" class="control-label">Email ID</label>
<input type="text" class="form-control" name="emailid" id="emailid" placeholder="Enter Email ID" value="{{$user->emailid}}" />
@error('emailid')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="phone" class="control-label">Phone</label>
<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter contact no" value="{{$user->phone}}" />
@error('phone')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="role_id" class="control-label">Role</label>
<select class="form-control form-select" name="role_id" id="role_id">
@foreach($roles as $role)
<option value="{{$role->id}}" {{ $role->id == $user->role_id ? " selected='selected'" : ""}}>{{$role->rolename}}</option>
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
<input type="password" name="password" id="password" class="form-control" placeholder="Enter password to change" />
</div>
</div>
</div>
<button class="mt-1 btn btn-primary">Save</button>
</form>
</div>
</div>
@endsection