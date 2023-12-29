@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Blogs
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/administrator/add-blog'" title="Add Blog" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Blogs
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
						<th>S.no.</th>
						<th>Category</th>
						<th>Title</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
					@php $counter=1; @endphp
					@foreach($blogs as $blog)
					<tr>
						<td>{{$counter++}}</td>
						<td>{{$blog->categoryname}}</td>
						<td>{{$blog->title}}</td>
						<td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-blog/{{$blog->id}}"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/delete-blog/{{$blog->id}}"><i class="btn-icon-wrapper fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection