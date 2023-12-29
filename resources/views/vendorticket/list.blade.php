 @extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Ticket List
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/sellers/ticket/add'" title="Add Offer" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Raise Ticket
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
		<div class="row mt-4">
			<!-- Column -->
			<div class="col-md-6 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<div class="p-2 rounded bg-light-primary text-center">
						<h1 class="fw-light text-primary">{{number_format($ticketcount->totalTickets)}}</h1>
						<h6 class="text-primary">Total Tickets</h6>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-6 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<div class="p-2 rounded bg-light-warning text-center">
						<h1 class="fw-light text-warning">{{number_format($ticketcount->inprogressTicket)}}</h1>
						<h6 class="text-warning">In Progress</h6>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-6 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<div class="p-2 rounded bg-light-success text-center">
						<h1 class="fw-light text-success">{{number_format($ticketcount->openedTicket)}}</h1>
						<h6 class="text-success">Opened</h6>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-6 col-lg-3 col-xlg-3">
				<div class="card card-hover">
					<div class="p-2 rounded bg-light-danger text-center">
						<h1 class="fw-light text-danger">{{number_format($ticketcount->closedTicket)}}</h1>
						<h6 class="text-danger">Closed</h6>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                    <tr>
						<th>Status</th>
						<th>Title</th>
						<th>ID</th>
						<th>Created by</th>
						<th>Date</th>
						<th>Agent</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($tickets as $ticket)
						<tr>
							<td><span class="badge bg-light-{{$ticket->status == 0 ? "danger" : ($ticket->status == 1 ? "warning" : "success")}} text-warning font-medium">{{$ticket->status == 0 ? "Opened" : ($ticket->status == 1 ? "Inprogress" : ($ticket->status == 2 ? "Completed" : "Closed"))}}</span></td>
							<td><a href="/ticket/{{$ticket->id}}" class="font-medium link">{{$ticket->title}}</a></td>
							<td><a href="/ticket/{{$ticket->id}}" class="fw-bold link">{{$ticket->ticketno}}</a></td>
							<td>{{ucwords($ticket->created_by)}}</td>
							<td>{{date('Y/m/d', strtotime($ticket->created_at))}}</td>
							<td>{{ucwords($ticket->agent)}}</td>
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
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/ticket.js')}}"></script>
@endpush