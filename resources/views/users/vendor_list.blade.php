@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
</div>
<div>
Users
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
<button type="button" onclick="window.location.href='/sellers/add-user'" title="Add New User" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i>Add User
</button>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="g-0 row pt-3 pb-2 px-3">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead><tr><th>#</th><th>Active</th><th>Name</th><th>Role</th><th>Email ID</th><th>Phone</th></tr></thead>
<tbody>
@foreach($users as $user)
<tr>
<td>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/sellers/edit-user/{{$user->id}}"><i class="btn-icon-wrapper fa fa-user"></i>Edit User</a>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/sellers/delete-user/{{$user->id}}"><i class="btn-icon-wrapper fa fa-trash"></i>Delete User</a>
</td>
<td><input data-column="is_active" data-type="vendors_users" data-id="{{$user->id}}" type="checkbox"{{$user->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
<td>{{$user->firstname}} {{$user->lastname}}</td>
<td>{{$user->rolename}}</td>
<td>{{$user->emailid}}</td>
<td>{{$user->phone}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection

@push('externalJavascripts')
<script type="text/javascript" src="{{asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
@endpush
