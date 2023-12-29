@extends("wms.layout")
@section("content")
<div class="mb-3 p-3 card">
	<h2>Invoice tax Report</h2>
	<hr>
    <form method="post" id="order-search-frm" class="form-horizontal mx-2">
        @csrf
		<div class="row">
			<div class="col-md-5">
				<div class="position-relative mb-3">
					<label for="orderno" class="form-label">Order No:</label>
					<input type="text" class="form-control" name="orderno" id="orderno" placeholder="Enter Order No" value="{{old('orderno')}}">
				</div>
			</div>
			<div class="col-md-5">
				<div class="position-relative mb-3">
					<label class="control-label form-label">Date Range:</label><br>
					<button type="button" class="btn btn-primary" id="daterange" style="width: 100%;">
						<i class="fa fa-calendar pe-1"></i>
						<span></span>
						<i class="fa ps-1 fa-caret-down"></i>
					</button>
					<input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="{{old('formdate')}}">
					<input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="{{old('todate')}}">
				</div>
			</div>
			<div class="col-md-2 mt-4">
				<button type="button" name="search-invoice-tax" id="search-invoice-tax" class="btn btn-secondary">Search</button>
			</div>
		</div>
    </form>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table id="invoice-tax-tbl" class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <tr>
						<th>#</th>
						<th class="default-sort">Created At</th>
						<th>Invoice No</th>
						<th>Seller Order No</th>
						<th>Base Amount</th>
						<th>Discount</th>
						<th>IGST</th>
						<th>CGST</th>
						<th>SGST</th>
						<th>Total Amount</th>
						<th>TDS Amount</th>
						<th>TCS Amount</th>
					</tr>
                </thead>
                <tbody></tbody>
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
<script type="text/javascript" src="{{asset('backend/vendors/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/daterangepicker/daterangepicker.js')}}"></script>
@endpush

@push('javascripts')
<script>
$(document).ready(function(){
    $('#invoice-tax-tbl').DataTable({
        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
        stateSave: true,
        scrollX: true,
        order: [[$('#invoice-tax-tbl thead th.default-sort').index(), 'desc']],
        buttons: [
            { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
            { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
        ]
    });

    var start = moment().subtract(29, "days");
    var end = moment();
    $("#daterange").daterangepicker({
		startDate: start,
		endDate: end,
		opens: "right",
		ranges: {
			"Today": [moment(), moment()],
			"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
			"Last 7 Days": [moment().subtract(6, "days"), moment()],
			"Last 30 Days": [moment().subtract(29, "days"), moment()],
			"This Month": [moment().startOf("month"), moment().endOf("month")],
			"Last Month": [
				moment().subtract(1, "month").startOf("month"),
				moment().subtract(1, "month").endOf("month"),
			],
			"This Year": [
				moment().startOf("year"),
				moment().endOf("year"),
			],
			"Last Year": [
				moment().subtract(1, "year").startOf("year"),
				moment().subtract(1, "year").endOf("year"),
			],
		},
	}, cb);
    cb(start, end);
	
	$('#search-invoice-tax').click(function() {
		var orderno = $('#orderno').val();
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		
		$.get('/report/get-invoice-tax', {orderno: orderno, fromdate: fromdate, todate: todate}, function(result){
			$('#invoice-tax-tbl').DataTable().clear().destroy();
			$('#invoice-tax-tbl tbody').html(result.html);
			$('#invoice-tax-tbl').DataTable({
				dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
				stateSave: true,
				scrollX: true,
				order: [[$('#invoice-tax-tbl thead th.default-sort').index(), 'desc']],
				buttons: [
					{ extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
					{ extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
				]
			});
		}, 'json');
	});
	$('#search-invoice-tax').trigger('click');
});

function cb(start, end) {
    $("#daterange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    $('#order-search-frm').find('input[name="fromdate"]').val(start);
    $('#order-search-frm').find('input[name="todate"]').val(end);
}
</script>
@endpush