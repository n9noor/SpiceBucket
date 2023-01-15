$(document).ready(function(){
    getVariantType();
    getVariantValue();
    $(".multiselect-dropdown").select2({
        theme: "bootstrap4",
        placeholder: "Select an option",
    });
    $('#save-variant-value').click(function(){
        var variant_value = $('#variant_value').val();
        var id = $('#variant_value_id').val();
        var variant_id = $('#variant_id').val();
        var error = 0;
        if(variant_value.length == 0) {
            error++;
            toastr["error"]("", "Variant Value is required");
        }
        if(variant_id.length == 0) {
            error++;
            toastr["error"]("", "Variant Type is required");
        }
        if(error == 0){
            $.post('/products/save-variant-value', {_token: $('#defaultcsrftoken').val(), variant_id: variant_id, id: id, variant_value: variant_value}, function(result){
                if(result.status == true){
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
    $('#save-variant-type').click(function(){
        var type = $('#variant_type').val();
        var id = $('#variant_type_id').val();
        var error = 0;
        if(type.length == 0) {
            error++;
            toastr["error"]("", "Variant Type is required");
        }
        if(error == 0){
            $.post('/products/save-variant-type', {_token: $('#defaultcsrftoken').val(), varianttype: type, id: id}, function(result){
                if(result.status == true){
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
});

function getVariantValue() {
    $.get('/products/variant-value', function(result){
        $('#product-variant-value-table tbody').html(result.html);
        $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle({"on": "Active", "off": "Inactive", "onstyle": "success", "offstyle": "danger"});
    }, 'json');
}

function getVariantType() {
    $.get('/products/variant-type', function(result){
        $('#product-variant-type-table tbody').html(result.html);
        $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle({"on": "Active", "off": "Inactive", "onstyle": "success", "offstyle": "danger"});
        $('#variant_id').select2('destroy');
        $('#variant_id').html(result.options);
        $('#variant_id').select2({
            theme: "bootstrap4",
            placeholder: "Select an option",
            dropdownParent: $('#add-variant-value-modal')
        });
    }, 'json');
}

function deleteVariantValue(id){
    
}

function deleteVariantType(id){
    
}