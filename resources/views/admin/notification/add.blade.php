@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
               {{(!empty(@$data['res']->id)) ?'Edit' : 'Add' }} Notification Template
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
<form action="/administrator/notification/{{($source == 'Seller') ?'sellers' : 'customers' }}/save" method="post" class="form-horizontal">
    @csrf
    <!-- Alert notification (start) -->
      @if(Session::has('notification'))
      <div class="alert {{ Session::get('alert-class') }}">
         {{ Session::get('notification') }}
      </div>
      @endif  
      <input type="hidden" name="id" value="{{ @$data['id'] }}">
      <input type="hidden" name="source" value="{{ @$data['source'] }}">
    <div class="main-card mb-3 card">
        <div class="card-header">Notification Information</div>
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
                        <!-- <label for="customer_id" class="col-form-label">{{$source}}</label> -->
                        <div class="pb-3">
                            <label for="sendto_sel">
                                <input type="radio" id="sendto_sel" name="sendoption" value="1" checked onclick="ShowHideDiv()"/>
                                Send to selected {{$source}}
                            </label>
                            <label for="sendto_all">
                                <input type="radio" id="sendto_all" name="sendoption" value="2"  onclick="ShowHideDiv()"/>
                                Send to All {{$source}}
                            </label>
                            <span class="text-danger">*</span>
                        </div>
                        <div id="cusDropdown" style="display: block">
                            <select id="customers" name="customers[]" multiple="" class="multiselect-dropdown form-control">
                            <option value=""></option>
                                @foreach($customers as $customer)
                                    @if( ($source == 'Seller') && !is_null($customer->vendor_alias) )
                                        <option value="{{$customer->id}}">{{$customer->vendor_alias}} ( {{$customer->gst}} )</option>
                                    @elseif( ($source == 'Customer') && !is_null($customer->name) )
                                        <option value="{{$customer->id}}">{{$customer->name}} ( {{$customer->emailid}} )</option>1
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('customers'))
                                <span class="text-danger"> The {{($source == 'Seller') ?'sellers' : 'customers' }} field is required.</span>
                            @endif
                        </div>
                        
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="message" class="col-form-label">Notification Content <span class="text-danger">*</span></label>
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
    function ShowHideDiv() {
        var sendto_sel = document.getElementById("sendto_sel");
        var cusDropdown = document.getElementById("cusDropdown");
        cusDropdown.style.display = sendto_sel.checked ? "block" : "none";
    }
</script>
@endpush