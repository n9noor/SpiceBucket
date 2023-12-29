$(document).ready(function () {
    var start = moment().subtract(29, "days");
    var end = moment();
    $("#daterange").daterangepicker({
        startDate: start,
        endDate: end,
        opens: "right",
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month"),
            ],
        },
    },
        cb
    );
    cb(start, end);

    var n_index = $("table th.no-sort").map(function () {
        return $(this).index();
    }).get();
    $('table').DataTable({ dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>", stateSave: true, scrollX: true, order: [[$('th.default-sort').index(), 'desc']], columnDefs: [{ targets: n_index, orderable: false, searchable: false }], buttons: [{ extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' }, { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }] });
});

function cb(start, end) {
    $("#daterange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    $('#order-search-frm').find('input[name="fromdate"]').val(start);
    $('#order-search-frm').find('input[name="todate"]').val(end);
}
