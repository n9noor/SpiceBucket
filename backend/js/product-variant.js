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

    if ($(".multiselect-dropdown").length > 0) {
        $(".multiselect-dropdown").select2({
            theme: "bootstrap4",
            placeholder: "Select an option",
        });
    }

    $('.product-approve').click(function () {
        var product_id = $(this).attr('data-id');
        $.post('/administrator/product-approve-status', { "_token": $('#token').val(), id: product_id, status: 1 }, function (result) {
            if (result.ok == true) {
                toastr["success"]("", "Product Approved successfully");
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else {
                toastr['error']("", "Not able to Product the vendor, as " + result.message);
            }
        }, 'json');
    });

    $('#save-decline-comment').click(function () {
        var product = $('#product').val();
        var comment = $('#comment').val();
        var error = 0;
        var errorMessage = [];
        if (comment.length == 0) {
            errorMessage.push("Comment is required.");
            error++;
        }
        if (error == 0) {
            $.post('/administrator/product-approve-status', { "_token": $('#token').val(), id: product, comment: comment, status: 2 }, function (result) {
                if (result.ok == true) {
                    toastr["success"]("", "Vendor Declined successfully");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr['error']("", "Not able to decline the vendor, as " + result.message);
                }
            }, 'json');
        } else {
            toastr['error'](errorMessage.join("<br />"), "Error:");
        }
    });

    $('#save-variant-value').click(function () {
        var variant_value = $('#variant_value').val();
        var id = $('#variant_value_id').val();
        var variant_id = $('#variant_id').val();
        var error = 0;
        if (variant_value.length == 0) {
            error++;
            toastr["error"]("", "Variant Value is required");
        }
        if (variant_id.length == 0) {
            error++;
            toastr["error"]("", "Variant Type is required");
        }
        if (error == 0) {
            $.post('/products/save-variant-value', { _token: $('#defaultcsrftoken').val(), variant_id: variant_id, id: id, variant_value: variant_value }, function (result) {
                if (result.status == true) {
                    toastr["success"]("", "Variant Type added successfully");
                    $('#variant_value').val('');
                    $('#variant_value_id').val(0);
                    getVariantValue();
                } else {
                    toastr["error"]("", "Not able to add the variant value, as " + result.message);
                }
            }, 'json');
        }
    });

    $('#save-variant-type').click(function () {
        var type = $('#variant_type').val();
        var id = $('#variant_type_id').val();
        var error = 0;
        if (type.length == 0) {
            error++;
            toastr["error"]("", "Variant Type is required");
        }
        if (error == 0) {
            $.post('/products/save-variant-type', { _token: $('#defaultcsrftoken').val(), varianttype: type, id: id }, function (result) {
                if (result.status == true) {
                    toastr["success"]("", "Variant Type added successfully");
                    $('#variant_type').val('');
                    $('#variant_type_id').val(0);
                    getVariantType();
                } else {
                    toastr["error"]("", "Not able to add the variant type, as " + result.message);
                }
            }, 'json');
        }
    });

    var n_index = $("#products-table th.no-sort").map(function () {
        return $(this).index();
    }).get();
    $('#products-table').DataTable({
        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
        stateSave: true,
        scrollX: true,
        order: [[$('#products-table thead th.default-sort').index(), 'asc']],
        columnDefs: [{ targets: n_index, orderable: false, searchable: false }],
        buttons: [
            { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
            { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
        ]
    });
    var n_index = $("#product-variant-type-table th.no-sort").map(function () {
        return $(this).index();
    }).get();
    $('#product-variant-type-table').DataTable({
        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
        stateSave: true,
        scrollX: true,
        order: [[$('#product-variant-type-table thead th.default-sort').index(), 'asc']],
        columnDefs: [{ targets: n_index, orderable: false, searchable: false }],
        buttons: [
            { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
            { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
        ]
    });
    var n_index = $("#product-variant-value-table th.no-sort").map(function () {
        return $(this).index();
    }).get();
    $('#product-variant-value-table').DataTable({
        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
        stateSave: true,
        scrollX: true,
        order: [[$('#product-variant-value-table thead th.default-sort').index(), 'asc']],
        columnDefs: [{ targets: n_index, orderable: false, searchable: false }],
        buttons: [
            { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
            { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
        ]
    });
    getVariantType();
    getVariantValue();
});

function getVariantValue() {
    $.get('/products/variant-value', function (result) {
        $('#product-variant-value-table').DataTable().clear().destroy();
        $('#product-variant-value-table tbody').html(result.html);
        var n_index = $("#product-variant-value-table th.no-sort").map(function () {
            return $(this).index();
        }).get();
        $('#product-variant-value-table').DataTable({
            dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
            stateSave: true,
            scrollX: true,
            order: [[$('th.default-sort').index(), 'asc']],
            columnDefs: [{ targets: n_index, orderable: false, searchable: false }],
            buttons: [
                { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
                { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
            ]
        });
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
        $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle({ "on": "<i class='fa fa-eye'></i>", "off": "<i class='fa fa-eye-slash'></i>", "onstyle": "success", "offstyle": "danger" });
    }, 'json');
}

function getVariantType() {
    $.get('/products/variant-type', function (result) {
        $('#product-variant-type-table').DataTable().destroy();
        $('#product-variant-type-table tbody').html(result.html);
        var n_index = $("#product-variant-type-table th.no-sort").map(function () {
            return $(this).index();
        }).get();
        $('#product-variant-type-table').DataTable({
            dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>",
            stateSave: true,
            scrollX: true,
            order: [[$('th.default-sort').index(), 'asc']],
            columnDefs: [{ targets: n_index, orderable: false, searchable: false }],
            buttons: [
                { extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'CSV' },
                { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: 'Excel' }
            ]
        });
        $('#variant_id').select2('destroy');
        $('#variant_id').html(result.options);
        $('#variant_id').select2({
            theme: "bootstrap4",
            placeholder: "Select an option",
            dropdownParent: $('#add-variant-value-modal')
        });
    }, 'json');
}

function cb(start, end) {
    $("#daterange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    $('#product-search-frm').find('input[name="fromdate"]').val(start);
    $('#product-search-frm').find('input[name="todate"]').val(end);
}
