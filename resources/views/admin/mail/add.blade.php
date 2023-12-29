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
<form action="/administrator/mail/save" method="post" class="form-horizontal">
    @csrf
    <!-- Alert message (start) -->
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class') }}">
         {{ Session::get('message') }}
      </div>
      @endif  
      <input type="hidden" name="id" value="{{ @$data['id'] }}">
    <div class="main-card mb-3 card">
        <div class="card-header">Mail Information</div>
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="title" class="col-form-label">Title<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="title" id="title"  value="{{ @$data['res']->title }}">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="subject" class="col-form-label">Subject<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="subject" id="subject"  value="{{ @$data['res']->subject }}">
                        @if ($errors->has('subject'))
                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                        @endif
                </div>
                <div class="form-group col-md-6" >
                    <label for="sent_to" class="col-form-label">Sent Email(Reciver Email )<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sent_to" id="sent_to"  value="{{ @$data['res']->sent_to }}">
                    @if ($errors->has('sent_to'))
                        <span class="text-danger">{{ $errors->first('sent_to') }}</span>
                    @endif

                    
                </div>
                <div class="form-group col-md-6">
                    <label for="from_name" class="col-form-label">From Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="from_name" id="from_name"  value="{{ @$data['res']->from_name }}">
                    @if ($errors->has('from_name'))
                        <span class="text-danger">{{ $errors->first('from_name') }}</span>
                    @endif
                    
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="from_email" class="col-form-label">From Email<span class="text-danger">*</span></label>
                   
                     <input type="text" class="form-control" name="from_email" id="from_email"  value="{{ @$data['res']->from_email }}">
                    @if ($errors->has('from_email'))
                        <span class="text-danger">{{ $errors->first('from_email') }}</span>
                    @endif
                    
                </div>

                 <div class="form-group col-md-6" style="display:none">
                    <label for="reply_to" class="col-form-label">Reply From Email<span class="text-danger">*</span></label>
                   
                      <input type="text" class="form-control" name="reply_from" id="reply_from"  value="<?php echo env('MAIL_REPLY_TO'); ?>">
                        @if ($errors->has('reply_from'))
                            <span class="text-danger">{{ $errors->first('reply_from') }}</span>
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
                    <label for="message" class="col-form-label">Mail Content <span class="text-danger">*</span></label>
                    <br>Variables: {{ @$data['res']->variables }}
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
<script type="text/javascript" src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('message', {
     allowedContent: true,
    enterMode: CKEDITOR.ENTER_BR
});
</script>
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


