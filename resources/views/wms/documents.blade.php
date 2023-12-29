@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-umbrella icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Required Documents for Vendors
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="$('#document_type_id').val(0);$('#document_type').val('');" data-bs-toggle="modal" data-bs-target="#add-document-type-modal" title="Add New Document Type" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i>Add Document
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table id="document-type-table" class="table table-stripped" style="width:100%">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th class="no-sort">Active</th>
                        <th class="default-sort">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $type)
                    <tr>
                        <td>
                            <a onclick="$('#document_type_id').val({{$type->id}});$('#document_type').val('{{$type->type}}');" data-bs-toggle="modal" data-bs-target="#add-document-type-modal" class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="javascript:void(0)"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="javascript:void(0)"><i class="btn-icon-wrapper fa fa-trash"></i></a>
                        </td>
                        <td><input data-column="is_active" data-type="document_type" data-id="{{$type->id}}" type="checkbox" {{$type->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                        <td>{{$type->type}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('stylesheets')
<link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-buttons/css/bootstrap4.min.css')}}">
@endpush

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
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
<!-- Modal -->
<div class="modal" id="add-document-type-modal" tabindex="-1" role="dialog" aria-labelledby="add-document-type-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-document-type-modal-label">Document Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="document_type_id" id="document_type_id" />
                <div class="position-relative mb-3">
                    <label for="document_type" class="form-label">Document Type</label>
                    <input type="text" class="form-control" name="document_type" id="document_type" placeholder="Enter document type" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save-document-type" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endpush