@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
               {{(!empty(@$data['res']->id)) ?'Edit' : 'Add' }} Mail Template
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
<form action="/administrator/message/save" method="post" class="form-horizontal">
    @csrf
    <!-- Alert message (start) -->
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class') }}">
         {{ Session::get('message') }}
      </div>
      @endif  
      <input type="hidden" name="id" value="{{ @$data['id'] }}">
    <div class="main-card mb-3 card">
        <div class="card-header">Message Information</div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="subject" class="col-form-label">Subject<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="subject" id="subject"  value="{{ @$data['res']->subject }}">
                        @if ($errors->has('subject'))
                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                        @endif
                </div>
                
                <div class="form-group col-md-6">
                    <label for="is_active" class="col-form-label">Status<span class="text-danger">*</span></label>
                   
                        <select name="is_active" placeholder="" class="form-control">
                            <option value="1" 
                                {{ old('is_active',@$data['res']->is_active)==1 ? 'selected' : '' }}
                          >Active</option>
                           <option value="0" 
                                {{ old('is_active',@$data['res']->is_active)==0 ? 'selected' : '' }}
                          >In-Active</option> 

                      
                        </select>
                </div>


               
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="message" class="col-form-label">Message Content <span class="text-danger">*</span></label>
                   <br> Variables: {{ @$data['res']->variables }}
                    <textarea class="ckeditor form-control" cols="80" name="message" id="message" rows="10">{{ @$data['res']->message }}</textarea>

                    @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                    
            </div>    
             
        </div>
    </div>
    
    <button class="mt-1 mb-3 btn btn-primary">Save</button>
</form>
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