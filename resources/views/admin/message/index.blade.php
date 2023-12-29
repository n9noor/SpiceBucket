@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Message Manager
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/administrator/message/add'" title="Add Message" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Message
            </button>
        </div>
    </div>
</div>
@if(Session::has('message'))
<div class="alert alert-success">{{Session::get('message')}}</div>
@endif

<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Sl.no</th>

                        <th class="text-center">Subject</th>
                        <th class="text-center">Message</th>
                         
                         <th class="text-center">Status</th> 
                         <th class="text-center">Action</th> 
                         
                    </tr>
                </thead>
                <tbody> 
                    
                    @foreach($messages as $key=>$message)

                    <tr>
                        
                       
                        <td nowrap class="text-center"><strong>{{$key+1}}</strong></td>
                        <td nowrap class="text-center"><strong>{{$message->subject}}</strong></td>
                        <td nowrap class="text-center"><strong>{{substr($message->message, 0, 100)}}..</strong></td>
                        <td nowrap class="text-center"><strong>{{$message->is_active?'Active':'In-Active'}}</strong></td>
                        <td nowrap class="text-center delete-button">
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/message/{{md5($message->id)}}/edit"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                        </td>  
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