$(document).ready(function () {
    if ($('table').length > 0) {
        var n_index = $("table th.no-sort").map(function () {
            return $(this).index();
        }).get();
        $('table').DataTable({ dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>", stateSave: true, scrollX: true, responsive: true, order: [[$('th.default-sort').index(), 'asc']], columnDefs: [{ targets: n_index, orderable: false, searchable: false }], buttons: [{ extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: '<i class="fa fa-download fa-3x"></i><span style="font-size:24px;margin-left:5px;">CSV</span>' }, { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: '<i class="fa fa-download fa-3x"></i><span style="font-size:24px;margin-left:5px;">Excel</span>' }] });
    }
    $('select').select2({
        theme: "bootstrap4",
        placeholder: "Select an option",
    });
    $('#featured_category').prop('disabled', true);
    $('#is_featured').change(function () {
        if ($(this).is(":checked")) {
            $('#featured_category').prop('disabled', false);
        } else {
            $('#featured_category').prop('disabled', true);
        }
    });
    $('#is_featured').trigger('change');
});