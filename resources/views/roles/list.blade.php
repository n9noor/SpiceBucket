@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
</div>
<div>
Departments
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
<button type="button" onclick="window.location.href='/administrator/add-role'" title="Add New Role" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i>Add Department
</button>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="g-0 row pt-3 pb-2 px-3">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead><tr><th>#</th><th>Name</th><th>Description</th></tr></thead>
<tbody>
@foreach($roles as $role)
<tr>
<td>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-role/{{$role->id}}"><i class="btn-icon-wrapper fa fa-edit"></i></a>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/delete-role/{{$role->id}}"><i class="btn-icon-wrapper fa fa-trash"></i></a>
</td>
<td>{{$role->rolename}}</td>
<td>{{$role->description}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection