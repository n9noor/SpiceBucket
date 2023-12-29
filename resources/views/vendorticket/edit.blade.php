@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Ticket Details
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3">
    <div class="row">
        <div class="col-lg-8">
            <input type="hidden" id="ticket-id" value="{{$ticket->id}}" />
            <!-- ---------------------
                            start Ticket
                        ---------------- -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">{{$ticket->title}}</h4>
                    {{$ticket->description}}
                    <div class="clearfix mb-2"></div>
                    <div class="row">
                        @php $images = explode(",", $ticket->images); @endphp
                        @foreach($images as $image)
                        <div class="col-md-3">
                            <img src="/public/images/tickets/{{$image}}" height="200" width="200" class="img-thumbnail" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- ---------------------
                            end Ticket
                        ---------------- -->
            <!-- ---------------------
                            start Ticket Replies
                        ---------------- -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Ticket Replies</h4>
                    <ul id="notes-list" class="list-unstyled mt-5">
                        @foreach($ticketreplies as $reply)
                        <li class="d-flex align-items-start">
                            <img class="me-3 rounded" src="/backend/images/avatars/1.jpg" width="60" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">{{ucwords($reply->created_by)}}</h5>
                                {{$reply->remarks}}
                            </div>
                        </li>
                        <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- ---------------------
                            end Ticket Replies
                        ---------------- -->
            <!-- ---------------------
                            start Write a reply
                        ---------------- -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Write a reply</h4>
                    <form method="post">
                        <textarea id="comment" name="comment" class="form-control"></textarea>
                        <button type="button" id="update-comment-btn" class="mt-3 btn waves-effect waves-light btn-success">Reply</button>
                    </form>
                </div>
            </div>
            <!-- ---------------------
                            end Write a reply
                        ---------------- -->
        </div>
        <div class="col-lg-4">
            <!-- ---------------------
                            start Ticket Info
                        ---------------- -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 my-2">
                            <h4 class="card-title mb-0">Ticket Info</h4>
                        </div>
                        <div class=" col-6 my-2">
                            {{date('Y/m/d h:i A', strtotime($ticket->updated_at))}}
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row text-center">
                        <div class="col-12 my-2 text-start">
                            <select class="form-control" id="status">
                                <option value="0"{{$ticket->status == 0 ? " selected='selected'":""}}>Open</option>
                                <option value="1"{{$ticket->status == 1 ? " selected='selected'":""}}>In Progress </option>
                                <option value="2"{{$ticket->status == 2 ? " selected='selected'":""}}>Complete</option>
                                <option value="3"{{$ticket->status == 3 ? " selected='selected'":""}}>Close</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="pt-3">Ticket Creator</h5>
                    <span>{{$ticket->created_by}}</span>
                    <h5 class="mt-4">Support Department</h5>
                    <select style="width:100%" class="form-control" id="department">
                        @foreach($departments as $department)
                        <option value="{{$department->id}}"{{$ticket->department == $department->id ? " selected='selected'":""}}>{{$department->rolename}}</option>
                        @endforeach
                    </select>
                    <h5 class="mt-4">Support Staff</h5>
                    <select style="width:100%" class="form-control" id="agent" data-selected="{{$ticket->agent}}"></select>
                    <br />
                    <button type="button" id="update-status-btn" class="mt-3 btn waves-effect waves-light btn-success">Update</button>
                </div>
            </div>
            <!-- ---------------------
                            end Ticket Info
                        ---------------- -->
        </div>
    </div>
</div>
@endsection

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/vendorticket.js')}}"></script>
@endpush