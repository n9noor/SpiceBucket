@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                {{$source}} Notification Manager
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
@if(Session::has('notification'))
<div class="alert alert-success">{{Session::get('notification')}}</div>
@endif

<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Sl.no</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Notification</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $key=>$notification)
                    <tr {{ $notification->is_active != 1 ? "class=unread_notification" : '' }}>
                        <td nowrap class="text-center"><strong>{{$key+1}}</strong></td>
                        <td nowrap class="text-center"><strong>{{$notification->subject}}</strong></td>
                        <td nowrap class="text-center"><strong>{{substr($notification->message, 0, 100)}}..</strong></td>
                        <td nowrap class="text-center"><strong>{{$notification->created_at}}</strong></td>
                        <td nowrap class="text-center delete-button">
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" 
                                href="/{{($source == 'Seller') ?'sellers' : 'customers' }}/notification/{{md5($notification->id)}}/view"
                                title="View">
                                <i class="btn-icon-wrapper fa fa-eye"></i></a>
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