@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Product Category
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        @if(session('admin-logged-in') == true)
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/products/add-product-category'" title="Add Product Category" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Product Category
            </button>
        </div>
        @endif
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th class="no-sort">Active</th>
                        <th{{Session::get('vendor-logged-in') == true ? ' class="default-sort"' : ""}}>Name</th>
                        <th>Slug</th>
                        @if(Session::get('admin-logged-in') == true)
                        <th class="default-sort">Parent</th>
                        @endif
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td nowrap>
                            @if(session('admin-logged-in') == true || (session('vendor-logged-in') == true && !is_null($category->vendor_id)))
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/products/edit-product-category/{{$category->id}}"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/products/delete-product-category/{{$category->id}}"><i class="btn-icon-wrapper fa fa-trash"></i></a>
                            @endif
                        </td>
                        <td nowrap>
                            @if(session('admin-logged-in') == true)
                            <input data-column="is_active" data-type="product_category" data-id="{{$category->id}}" type="checkbox" {{$category->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                            @else
                            @if($category->is_active == true)
                            <div class="badge bg-success">Active</div>
                            @else
                            <div class="badge bg-danger">Inactive</div>
                            @endif
                            @endif
                        </td>
                        <td nowrap>{{$category->name}}</td>
                        <td nowrap>{{$category->slug}}</td>
                        @if(Session::get('admin-logged-in') == true)
                        <td nowrap>{{$category->parentName}}</td>
                        @endif
                        <td nowrap>{!!$category->description!!}</td>
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
<script type="text/javascript" src="{{asset('backend/vendors/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')}}"></script>
@endpush

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/product-category.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/show-image.js')}}"></script>
@endpush