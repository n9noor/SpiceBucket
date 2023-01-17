function displayImage(fileinput, id) {
    var file = fileinput['files'][0];
    var reader = new FileReader();
    var baseString;
    reader.onloadend = function () {
        baseString = reader.result;
        $('#' + id).html('<img class="mx-5 my-3 img-thumbnail" src="' + baseString + '" width="200" height="200" />');
    };
    reader.readAsDataURL(file);
}

$(document).ready(function(){
    $(".multiselect-dropdown").select2({
        theme: "bootstrap4",
        placeholder: "Select an option",
    });
    
    $('.default-hide').hide();
    $('input[type="checkbox"][name^="varient_property"]').change(function() {
        var id = $(this).attr("id");
        if($(this).is(":checked")) {
            $('input[type="checkbox"][name^="varient_property"]').not('#' + id).prop('checked', false);
        }
        $('.default-hide').hide();
        if($('#varient_property_manual').is(":checked")){
            $('#varient_property_manual_div').show();
        }
        if($('#varient_property_copy').is(":checked")){
            $('#varient_property_copy_div').show();
        }
    });
    
    $(document).on('keyup blur', 'input[id^="variant_"][id$="_product_mrp"], input[id^="variant_"][id$="_net_price"]', function() {
        var string = $(this).attr('id').replace('variant_', '').replace('_product_mrp', '').replace('_net_price', '');
        var sellingprice = parseFloat($('#variant_' + string + '_product_mrp').val());
        if(isNaN(sellingprice)){
            sellingprice = 0;
        }
        var netprice = parseFloat($('#variant_' + string + '_net_price').val());
        if(isNaN(netprice)){
            netprice = 0;
        }
        var discount_price = sellingprice - netprice;
        if(discount_price <= 0){
            discount_price = 0;
        }
        var discount = (discount_price * 100)/sellingprice;
        $('#variant_' + string + '_discount_price').val(Math.round( discount * 100 + Number.EPSILON ) / 100);
    });
    
    $('#selling_price, #net_price').keyup(function() {
        var sellingprice = parseFloat($('#selling_price').val());
        if(isNaN(sellingprice)){
            sellingprice = 0;
        }
        var netprice = parseFloat($('#net_price').val());
        if(isNaN(netprice)){
            netprice = 0;
        }
        var discount_price = sellingprice - netprice;
        if(discount_price <= 0){
            discount_price = 0;
        }
        var discount = (discount_price * 100)/sellingprice;
        $('#discount_price').val(Math.round( discount * 100 + Number.EPSILON ) / 100);
    });
    
    $('#taxable').change(function(){
        if($('#taxable').is(":checked")){
            $('#taxable_rate').attr('readonly', false);
        } else {
            $('#taxable_rate').val('').attr('readonly', true);
            $('#taxable_amount').val('').attr('readonly', true);
            $('#net_price_without_tax').val('').attr('readonly', true);
        }
    });
    
    $('#taxable_rate').blur(function(){
        $('#taxable_amount').val('');
        $('#net_price_without_tax').val('');
    });
    
    $(document).on('click', '#generate-variant-tbl-btn', function() {
        var varient_id = $('input[type="checkbox"][id^="variant_id_"]');
        var html = '';
        
        var variantObj = {};
        for(var i in varient_id) {
            if(!isNaN(parseInt(i))){
                if(varient_id[i].checked == true) {
                    var outervalue = varient_id[i].value;
                    if(!variantObj.hasOwnProperty(outervalue)){
                        variantObj[outervalue] = {};
                    }
                    var varient_value = $('input[type="checkbox"][id^="varient_value_' + outervalue + '_"]');
                    for(var j in varient_value) {
                        if(!isNaN(parseInt(j))){
                            if(varient_value[j].checked == true) {
                                var innervalue = varient_value[j].value;
                                if(!(variantObj[outervalue]).hasOwnProperty(innervalue)){
                                    variantObj[outervalue][innervalue] = varient_value[j].getAttribute('data-text');
                                }
                            }
                        }
                    }
                }
            }
        }
        variantObj = Object.entries(variantObj);
        for(var i=1; i<=variantObj.length; i++){
            window[ "Object" + i ] = variantObj[i-1][1];
        }
        
        if(typeof(Object1) != "undefined" && Object1 != null){
            for(var i in Object1){
                if(typeof(Object2) != "undefined" && Object2 != null){
                    for(var j in Object2){
                        if(typeof(Object3) != "undefined" && Object3 != null){
                            for(var k in Object3){
                                html += "<tr><th nowrap><input class='readonly-as-label' type='text' name='variant["  + i + "][" + j + "][" + k + "][label]' id='variant_"  + i + "_" + j + "_" + k + "_label' value='" + Object1[i] + " / " + Object2[j] + " / " + Object3[k] + "' readonly /></th>";
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][product_mrp]' id='variant_"  + i + "_" + j + "_" + k + "_product_mrp'></td>";
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][net_price]' id='variant_"  + i + "_" + j + "_" + k + "_net_price'></td>";
                                html += "<td><div class='input-group'><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][discount_price]' id='variant_"  + i + "_" + j + "_" + k + "_discount_price' readonly><div class='input-group-text'><span class=''>%</span></div></div></td>";
                                /*html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][b2b_price]' id='variant_"  + i + "_" + j + "_" + k + "_b2b_price'></td>";*/
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][sku]' id='variant_"  + i + "_" + j + "_" + k + "_sku'></td>";
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][barcode]' id='variant_"  + i + "_" + j + "_" + k + "_barcode'></td>";
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][net_weight]' id='variant_"  + i + "_" + j + "_" + k + "_net_weight'></td>";
                                html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][" + k + "][quantity]' id='variant_"  + i + "_" + j + "_" + k + "_quantity'></td>";
                                html += "</tr>";
                            }
                        } else {
                            html += "<tr><th nowrap><input class='readonly-as-label' type='text' name='variant["  + i + "][" + j + "][label]' id='variant_"  + i + "_" + j + "_label' value='" + Object1[i] + " / " + Object2[j] + "' readonly /></th>";
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][product_mrp]' id='variant_"  + i + "_" + j + "_product_mrp'></td>";
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][net_price]' id='variant_"  + i + "_" + j + "_net_price'></td>";
                            html += "<td><div class='input-group'><input class='form-control' type='text' name='variant["  + i + "][" + j + "][discount_price]' id='variant_"  + i + "_" + j + "_discount_price' readonly><div class='input-group-text'><span class=''>%</span></div></div></td>";
                            /*html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][b2b_price]' id='variant_"  + i + "_" + j + "_b2b_price'></td>";*/
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][sku]' id='variant_"  + i + "_" + j + "_sku'></td>";
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][barcode]' id='variant_"  + i + "_" + j + "_barcode'></td>";
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][net_weight]' id='variant_"  + i + "_" + j + "_net_weight'></td>";
                            html += "<td><input class='form-control' type='text' name='variant["  + i + "][" + j + "][quantity]' id='variant_"  + i + "_" + j + "_quantity'></td>";
                            html += "</tr>";
                        }
                    }
                } else {
                    html += "<tr><th nowrap><input class='readonly-as-label' type='text' name='variant["  + i + "][label]' id='variant_"  + i + "_label' value='" + Object1[i] + "' readonly /></th>";
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][product_mrp]' id='variant_"  + i + "_product_mrp'></td>";
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][net_price]' id='variant_"  + i + "_net_price'></td>";
                    html += "<td><div class='input-group'><input class='form-control' type='text' name='variant["  + i + "][discount_price]' id='variant_"  + i + "_discount_price' readonly><div class='input-group-text'><span class=''>%</span></div></div></td>";
                    /*html += "<td><input class='form-control' type='text' name='variant["  + i + "][b2b_price]' id='variant_"  + i + "_b2b_price'></td>";*/
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][sku]' id='variant_"  + i + "_sku'></td>";
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][barcode]' id='variant_"  + i + "_barcode'></td>";
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][net_weight]' id='variant_"  + i + "_net_weight'></td>";
                    html += "<td><input class='form-control' type='text' name='variant["  + i + "][quantity]' id='variant_"  + i + "_quantity'></td>";
                    html += "</tr>";
                }
            }
        }
        
        $('#variant-table tbody').html(html);
        $('#variant-table').show();
    });
});