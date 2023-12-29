function verify(gst_number) {
    if (gst_number.length == 0) {
        toastr["error"]("", "Seller GST number is required.");
        return;
    }
    $.get("/administrator/verify-vendor", { gst_number: gst_number }, function (result) {
        if (result.status == true) {
            var data = result.data;
            if ($('#store_name').length > 0) {
                $('#store_name').val(data.tradeName);
                $('#store_name').attr('readonly', true);
            }
            if ($('#shop_name').length > 0) {
                $('#shop_name').val(data.tradeName);
                $('#shop_name').attr('readonly', true);
            }
            if ($('#verified').length > 0) {
                $('#verified').val(1);
            }
            $('#store_address').val(data.address);
            $('#store_address').attr('readonly', true);
            toastr["success"]("", "Seller verified");
        } else {
            $('#store_name').attr('readonly', false);
            $('#store_address').attr('readonly', false);
            $('#shop_name').attr('readonly', false);
            toastr["error"]("", "Seller not verified");
        }
    }, 'json');
}

$(document).ready(function () {
    if ($('table').length > 0) {
        var n_index = $("table th.no-sort").map(function () {
            return $(this).index();
        }).get();
        $('table').DataTable({ dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-3'i><'col-sms-12 col-md-3'B><'col-sm-12 col-md-6'p>>", stateSave: true, scrollX: true, order: [[$('th.default-sort').index(), 'asc']], columnDefs: [{ targets: n_index, orderable: false, searchable: false }], buttons: [{ extend: 'csvHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: '<i class="fa fa-file-csv fa-3x"></i><span style="font-size:24px;margin-left:5px;">CSV</span>' }, { extend: 'excelHtml5', className: 'border-2 btn-icon btn-shadow btn btn-outline-info p-1 mx-2', title: 'Data export', text: '<i class="fa fa-file-excel fa-3x"></i><span style="font-size:24px;margin-left:5px;">Excel</span>' }] });
    }

    $('.assignqac-vendor').change(function () {
        var qacid = $(this).val();
        var vendorid = $(this).attr('data-id');
        $.post('/administrator/map-vendor-qac', { _token: $('#defaultcsrftoken').val(), qacid: qacid, vendorid: vendorid }, function (result) {
            if (result.status == true) {
                toastr["success"]("", result.message);
            } else {
                toastr['error']("", "Not able to add the type, as " + result.message);
            }
        }, 'json');
    });

    $('.tab-category-vendor').change(function () {
        var tab_category = $(this).val();
        var vendorid = $(this).attr('data-id');
        $.post('/administrator/map-tab-category-vendor', { _token: $('#defaultcsrftoken').val(), tab_category: tab_category, vendorid: vendorid }, function (result) {
            if (result.status == true) {
                toastr["success"]("", result.message);
            } else {
                toastr['error']("", "Not able to add the type, as " + result.message);
            }
        }, 'json');
    });

    $('#save-document-type').click(function () {
        var id = $('#document_type_id').val();
        var type = $('#document_type').val();
        var error = 0;
        var errorMessage = [];
        if (type.length == 0) {
            errorMessage.push("Document Type is required.");
            error++;
        }
        if (error == 0) {
            $.post('/administrator/save-document-type', { "_token": $('#token').val(), id: id, type: type }, function (result) {
                if (result.ok == true) {
                    toastr["success"]("", "Type added successfully");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr['error']("", "Not able to add the type, as " + result.message);
                }
            }, 'json');
        } else {
            toastr['error'](errorMessage.join("<br />"), "Error:");
        }
    });
    $('.vendor-approve').click(function () {
        var vendor_id = $(this).attr('data-id');
        $.post('/administrator/approve-status', { "_token": $('#token').val(), id: vendor_id, status: 1 }, function (result) {
            if (result.ok == true) {
                toastr["success"]("", "Vendor Approved successfully");
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else {
                toastr['error']("", "Not able to approve the vendor, as " + result.message);
            }
        }, 'json');
    });
    $('#save-decline-comment').click(function () {
        var vendor_id = $('#vendor_id').val();
        var comment = $('#comment').val();
        var error = 0;
        var errorMessage = [];
        if (comment.length == 0) {
            errorMessage.push("Comment is required.");
            error++;
        }
        if (error == 0) {
            $.post('/administrator/approve-status', { "_token": $('#token').val(), id: vendor_id, comment: comment, status: 2 }, function (result) {
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
    $('#verify-otp').click(function () {
        if($.trim($('#otpchar')).length == 0) {
            toastr["error"]("", "Please enter OTP.");
            return;
        }
        $.post('/sellers/verify/attribute', { "_token": $('#defaultcsrftoken').val(), type: $('#verify-type').val(), otp: $('#otpchar').val() }, function(result) {
            if(result.status == true){
                $('#verify-otp-modal').modal("hide");
                toastr["success"]("", result.message);
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            } else {
                toastr["error"]("", result.message);
            }
        }, 'json');
    });
});

function deleteSliderImage(image) {
    if (confirm("Do you really want to delete the banner?")) {
        $.post('/sellers/delete-slider-banner-image', { "_token": $('#defaultcsrftoken').val(), imageid: image }, function (result) {
            if (result.status == true) {
                $('img[src$="' + image + '"]').parent().parent().remove();
            } else {
                toastr['error']("", "Not able to delete the banner");
            }
        }, 'json');
    }
}

function verifyEmail(email) {
    $.post('/sellers/verify/email', { "_token": $('#defaultcsrftoken').val(), email: email }, function (result) {
        if (result.status == true) {
            $('#verify-otp-modal').modal({backdrop: 'static', keyboard: false});
            $('#verify-otp-modal').modal("show");
            $('#verify-type').val('email');
        }
    }, 'json');
}

function verifyAltEmail(email) {
    $.post('/sellers/verify/altemail', { "_token": $('#defaultcsrftoken').val(), email: email }, function (result) {
        if (result.status == true) {
            $('#verify-otp-modal').modal({backdrop: 'static', keyboard: false});
            $('#verify-otp-modal').modal("show");
            $('#verify-type').val('altemail');
        }
    }, 'json');
}

function verifyPhone(phone) {
    $.post('/sellers/verify/phone', { "_token": $('#defaultcsrftoken').val(), phone: phone }, function (result) {
        if (result.status == true) {
            $('#verify-otp-modal').modal({backdrop: 'static', keyboard: false});
            $('#verify-otp-modal').modal("show");
            $('#verify-type').val('phone');
        }
    }, 'json');
}