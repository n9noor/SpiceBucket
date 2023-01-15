function verify(gst_number){
    if(gst_number.length == 0) {
        return;
    }
    $.get("/administrator/verify-vendor", {gst_number: gst_number}, function(result){
        if(result.status == true) {
            var data = result.data;
            if($('#store_name').length > 0){
                $('#store_name').val(data.tradeName);
            }
            if($('#shop_name').length > 0){
                $('#shop_name').val(data.tradeName);
            }
            $('#store_address').val(data.address);
            toastr["success"]("", "Vendor verified");
        } else {
            toastr["error"]("", "Vendor not verified");
        }
    }, 'json');
}

$(document).ready(function(){
    $('#save-document-type').click(function() {
        var id = $('#document_type_id').val();
        var type = $('#document_type').val();
        var error = 0;
        var errorMessage = [];
        if(type.length == 0) {
            errorMessage.push("Document Type is required.");
            error++;
        }
        if(error == 0){
            $.post('/administrator/save-document-type', {"_token": $('#token').val(), id: id, type: type}, function(result){
                if(result.ok == true){
                    toastr["success"]("", "Type added successfully");
                    setTimeout(function(){
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
    $('.vendor-approve').click(function(){
        var vendor_id = $(this).attr('data-id');
        $.post('/administrator/approve-status', {"_token": $('#token').val(), id: vendor_id, status: 1}, function(result){
            if(result.ok == true){
                toastr["success"]("", "Vendor Approved successfully");
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            } else {
                toastr['error']("", "Not able to approve the vendor, as " + result.message);
            }
        }, 'json');
    });
    $('#save-decline-comment').click(function() {
        var vendor_id = $('#vendor_id').val();
        var comment = $('#comment').val();
        var error = 0;
        var errorMessage = [];
        if(comment.length == 0) {
            errorMessage.push("Comment is required.");
            error++;
        }
        if(error == 0){
            $.post('/administrator/approve-status', {"_token": $('#token').val(), id: vendor_id, comment: comment, status: 2}, function(result){
                if(result.ok == true){
                    toastr["success"]("", "Vendor Declined successfully");
                    setTimeout(function(){
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
});