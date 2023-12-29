@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
               View Notification Template
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i> Back
            </button>
        </div>
    </div>
</div>
    @csrf
    <!-- Alert notification (start) -->
      @if(Session::has('notification'))
      <div class="alert {{ Session::get('alert-class') }}">
         {{ Session::get('notification') }}
      </div>
      @endif
    <div class="main-card mb-3 card">
        <div class="card-header">Notification Information</div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <span class="px-2">
                            {{ @$data['res']->subject }}
                        </span>
                      
                </div>
                <!-- <div class="form-group col-md-6">
                    <label for="is_active" class="col-form-label">Status:</label>
                    <span class="px-2">
                        {{ ($data['res']->is_active==1) ? 'Active' : 'Inactive' }}
                    </span>
                </div> -->
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="message" class="col-form-label">Notification Content <span class="text-danger">*</span></label>
                    <div class="px-2">
                        {{ @$data['res']->message }}
                    </div>
            </div>
        </div>
    </div>
@endsection

@push('externalJavascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.js')}}"></script>
@endpush
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/coupon.js')}}"></script>
@endpush
@push('stylesheets')
<link href="{{asset('/backend/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endpush

@push('externalJavascripts')
<script src="{{asset('/backend/summernote/summernote-lite.min.js')}}"></script>
@endpush

@push('javascripts')
<script>
    $('#coupon_description').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        dialogsInBody: true
    });
</script>
@endpush