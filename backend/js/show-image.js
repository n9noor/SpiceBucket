$(document).ready(function () {
    if ($(".multiselect-dropdown").length > 0) {
        $(".multiselect-dropdown").select2({
            theme: "bootstrap4",
            placeholder: "Select an option",
        });
    }
    $('#gst_rate').change(function () {
        $('#taxable_rate').val($(this).val());
        $('#taxable_rate').trigger('blur');
    });
    $('select[id^="varient_value_"]').attr('disabled', true);
    $('input[type="checkbox"][id^="variant_id_"]').change(function () {
        if ($(this).is(":checked")) {
            $('#varient_value_' + $(this).attr('id').replace("variant_id_", "")).attr('disabled', false);
        } else {
            $('#varient_value_' + $(this).attr('id').replace("variant_id_", "")).attr('disabled', true);
        }
    });
    $('input[type="checkbox"][id^="variant_id_"]').each(function (i) {
        $(this).trigger('change');
    });

    $('#main_category_id').change(function () {
        var catgoryid = $(this).val();
        var html = '<option value=""></option>';
        if (subcategories.hasOwnProperty(catgoryid)) {
            for (var i in subcategories[catgoryid]) {
                html += '<option value="' + subcategories[catgoryid][i].id + '">' + subcategories[catgoryid][i].name + '</option>';
            }
        }
        $('#sub_category_id').select2('destroy');
        $('#sub_category_id').html(html);
        $('#sub_category_id').select2({
            theme: "bootstrap4",
            placeholder: "Select an option",
        });
        jQuery('.select2-container').css('width', '100%');
    });

    $('.default-hide').hide();
    $('input[type="checkbox"][name^="varient_property"]').change(function () {
        var id = $(this).attr("id");
        if ($(this).is(":checked")) {
            $('input[type="checkbox"][name^="varient_property"]').not('#' + id).prop('checked', false);
        }
        $('.default-hide').hide();
        if ($('#varient_property_manual').is(":checked")) {
            $('#varient_property_manual_div').show();
        }
        if ($('#varient_property_copy').is(":checked")) {
            $('#varient_property_copy_div').show();
        }
    });

    $(document).on('keyup blur', 'input[id^="variant_"][id$="_product_mrp"], input[id^="variant_"][id$="_discount_price"]', function () {
        var string = $(this).attr('id').replace('variant_', '').replace('_product_mrp', '').replace('_discount_price', '');
        var sellingprice = parseFloat($('#variant_' + string + '_product_mrp').val());
        if (isNaN(sellingprice)) {
            sellingprice = 0;
        }
        var discount_price = parseFloat($('#variant_' + string + '_discount_price').val());
        if (isNaN(discount_price)) {
            discount_price = 0;
        }
        var netprice = sellingprice - ((discount_price * sellingprice) / 100);
        if (netprice <= 0) {
            netprice = 0;
        }
        $('#variant_' + string + '_net_price').val(Math.round(netprice));
    });

    $('#selling_price, #discount_price').keyup(function () {
        var sellingprice = parseFloat($('#selling_price').val());
        if (isNaN(sellingprice)) {
            sellingprice = 0;
        }
        var discount_price = parseFloat($('#discount_price').val());
        if (isNaN(discount_price)) {
            discount_price = 0;
        }
        var netprice = sellingprice - ((discount_price * sellingprice) / 100);
        if (netprice <= 0) {
            netprice = 0;
        }
        $('#net_price').val(Math.round(netprice + Number.EPSILON));
        $('#taxable_rate').trigger('blur');
    });

    $('#taxable').change(function () {
        if ($('#taxable').is(":checked")) {
            $('#taxable_rate').attr('readonly', false);
        } else {
            $('#taxable_rate').val('').attr('readonly', true);
            $('#taxable_amount').val('').attr('readonly', true);
            $('#net_price_without_tax').val('').attr('readonly', true);
        }
    });

    $('#taxable_rate').blur(function () {
        var sellingprice = parseFloat($('#net_price').val());
        if (isNaN(sellingprice)) {
            sellingprice = 0;
        }
        var taxrate = parseFloat($(this).val());
        if (isNaN(taxrate)) {
            taxrate = 0;
        }
        var taxprice = (sellingprice / (1 + (taxrate / 100)));
        $('#net_price_without_tax').val(taxprice.toFixed(2));
        $('#taxable_amount').val((parseFloat(sellingprice) - parseFloat(taxprice)).toFixed(2));
    });

    $(document).on('click', '#generate-variant-tbl-btn', function () {
        var sellingprice = $('#selling_price').val();
        var discount_price = $('#discount_price').val();
        var net_price = $('#net_price').val();
        // var b2b_price = $('#b2b_price').val();
        var sku = $('#sku').val();
        var barcode = $('#barcode').val();
        var varient_id = $('input[type="checkbox"][id^="variant_id_"]');
        var html = '';

        var variantObj = {};
        for (var i in varient_id) {
            if (!isNaN(parseInt(i))) {
                if (varient_id[i].checked == true) {
                    var outervalue = varient_id[i].value;
                    if (!variantObj.hasOwnProperty(outervalue)) {
                        variantObj[outervalue] = {};
                    }
                    var varient_value = $('select[id^="varient_value_' + outervalue + '"]').val();
                    for (var j in varient_value) {
                        if (!isNaN(parseInt(j))) {
                            textArr = varient_value[j].split("|");
                            var innervalue = textArr[0];
                            if (!(variantObj[outervalue]).hasOwnProperty(innervalue)) {
                                variantObj[outervalue][innervalue] = textArr[1];
                            }
                        }
                    }
                }
            }
        }
        variantObj = Object.entries(variantObj);
        delete Object1; delete Object2; delete Object3;
        for (var i = 1; i <= variantObj.length; i++) {
            window["Object" + i] = variantObj[i - 1][1];
        }
        var availablevariantrow = [];
        var count = $('#variant-table tbody tr').length;
        if (typeof (Object1) != "undefined" && Object1 != null) {
            for (var i in Object1) {
                if (typeof (Object2) != "undefined" && Object2 != null) {
                    for (var j in Object2) {
                        if (typeof (Object3) != "undefined" && Object3 != null) {
                            for (var k in Object3) {
                                availablevariantrow.push("variant_" + i + "_" + j + "_" + k + "_row");
                                if ($("#variant_" + i + "_" + j + "_" + k + "_row").length == 0) {
                                    html += "<tr id='variant_" + i + "_" + j + "_" + k + "_row'><th nowrap><input class='readonly-as-label' type='text' name='variant[" + i + "][" + j + "][" + k + "][label]' id='variant_" + i + "_" + j + "_" + k + "_label' value='" + Object1[i] + " / " + Object2[j] + " / " + Object3[k] + "' readonly /></th>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][product_mrp]' id='variant_" + i + "_" + j + "_" + k + "_product_mrp' value='" + sellingprice + "'></td>";
                                    html += "<td><div class='input-group'><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][discount_price]' id='variant_" + i + "_" + j + "_" + k + "_discount_price' value='" + discount_price + "'><div class='input-group-text'><span class=''>%</span></div></div></td>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][net_price]' id='variant_" + i + "_" + j + "_" + k + "_net_price' value='" + net_price + "' readonly></td>";
                                    // html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][b2b_price]' id='variant_" + i + "_" + j + "_" + k + "_b2b_price' value='" + b2b_price + "'></td>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][sku]' id='variant_" + i + "_" + j + "_" + k + "_sku' value='" + sku + "'></td>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][barcode]' id='variant_" + i + "_" + j + "_" + k + "_barcode' value='" + barcode + "'></td>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][net_weight]' id='variant_" + i + "_" + j + "_" + k + "_net_weight'></td>";
                                    html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][" + k + "][quantity]' id='variant_" + i + "_" + j + "_" + k + "_quantity'></td>";
                                    html += "<td class='text-center'><div class='position-relative form-check'><label class='form-label form-check-label'><input name='variant_default' value='" + i + "_" + j + "_" + k + "' type='radio' class='form-check-input' id='variant_" + i + "_" + j + "_" + k + "_default'" + (count == 0 ? " checked" : "") + " /></label></div></td>";
                                    html += '<td><label for="variant_' + i + '_' + j + '_' + k + '_image" class="form-label"><img class="img-thumbnail border-0" src="/images/upload.png" width="50" height="50"></label><div id="variant_' + i + '_' + j + '_' + k + '_image-view"></div><input style="display:none" type="file" name="variant[' + i + '][' + j + '][' + k + '][image]" id="variant_' + i + '_' + j + '_' + k + '_image" class="form-control" onchange="displayImage(this, \'variant_' + i + '_' + j + '_' + k + '_image-view\', \'img-thumbnail border-0\', 50, 50, false);" /></td>';
                                    html += "</tr>";
                                }
                            }
                        } else {
                            availablevariantrow.push("variant_" + i + "_" + j + "_row");
                            if ($("#variant_" + i + "_" + j + "_row").length == 0) {
                                html += "<tr id='variant_" + i + "_" + j + "_row'><th nowrap><input class='readonly-as-label' type='text' name='variant[" + i + "][" + j + "][label]' id='variant_" + i + "_" + j + "_label' value='" + Object1[i] + " / " + Object2[j] + "' readonly /></th>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][product_mrp]' id='variant_" + i + "_" + j + "_product_mrp' value='" + sellingprice + "'></td>";
                                html += "<td><div class='input-group'><input class='form-control' type='text' name='variant[" + i + "][" + j + "][discount_price]' id='variant_" + i + "_" + j + "_discount_price' value='" + discount_price + "'><div class='input-group-text'><span class=''>%</span></div></div></td>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][net_price]' id='variant_" + i + "_" + j + "_net_price' value='" + net_price + "' readonly></td>";
                                // html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][b2b_price]' id='variant_" + i + "_" + j + "_b2b_price' value='" + b2b_price + "'></td>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][sku]' id='variant_" + i + "_" + j + "_sku' value='" + sku + "'></td>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][barcode]' id='variant_" + i + "_" + j + "_barcode' value='" + barcode + "'></td>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][net_weight]' id='variant_" + i + "_" + j + "_net_weight'></td>";
                                html += "<td><input class='form-control' type='text' name='variant[" + i + "][" + j + "][quantity]' id='variant_" + i + "_" + j + "_quantity'></td>";
                                html += "<td class='text-center'><div class='position-relative form-check'><label class='form-label form-check-label'><input name='variant_default' value='" + i + "_" + j + "' type='radio' class='form-check-input' id='variant_" + i + "_" + j + "_default'" + (count == 0 ? " checked" : "") + " /></label></div></td>";
                                html += '<td><label for="variant_' + i + '_' + j + '_image" class="form-label"><img class="img-thumbnail border-0" src="/images/upload.png" width="50" height="50"></label><div id="variant_' + i + '_' + j + '_image-view"></div><input style="display:none" type="file" name="variant[' + i + '][' + j + '][image]" id="variant_' + i + '_' + j + '_image" class="form-control" onchange="displayImage(this, \'variant_' + i + '_' + j + '_image-view\', \'img-thumbnail border-0\', 50, 50, false);" /></td>';
                                html += "</tr>";
                            }
                        }
                    }
                } else {
                    availablevariantrow.push("variant_" + i + "_row");
                    if ($("#variant_" + i + "_row").length == 0) {
                        html += "<tr id='variant_" + i + "_row'><th nowrap><input class='readonly-as-label' type='text' name='variant[" + i + "][label]' id='variant_" + i + "_label' value='" + Object1[i] + "' readonly /></th>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][product_mrp]' id='variant_" + i + "_product_mrp' value='" + sellingprice + "'></td>";
                        html += "<td><div class='input-group'><input class='form-control' type='text' name='variant[" + i + "][discount_price]' id='variant_" + i + "_discount_price' value='" + discount_price + "'><div class='input-group-text'><span class=''>%</span></div></div></td>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][net_price]' id='variant_" + i + "_net_price' readonly value='" + net_price + "'></td>";
                        // html += "<td><input class='form-control' type='text' name='variant[" + i + "][b2b_price]' id='variant_" + i + "_b2b_price' value='" + b2b_price + "'></td>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][sku]' id='variant_" + i + "_sku' value='" + sku + "'></td>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][barcode]' id='variant_" + i + "_barcode' value='" + barcode + "'></td>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][net_weight]' id='variant_" + i + "_net_weight'></td>";
                        html += "<td><input class='form-control' type='text' name='variant[" + i + "][quantity]' id='variant_" + i + "_quantity'></td>";
                        html += "<td class='text-center'><div class='position-relative form-check'><label class='form-label form-check-label'><input name='variant_default' value='" + i + "' type='radio' class='form-check-input' id='variant_" + i + "_default'" + (count == 0 ? " checked" : "") + " /></label></div></td>";
                        html += '<td><label for="variant_' + i + '_image" class="form-label"><img class="img-thumbnail border-0" src="/images/upload.png" width="50" height="50"></label><div id="variant_' + i + '_image-view"></div><input style="display:none" type="file" name="variant[' + i + '][image]" id="variant_' + i + '_image" class="form-control" onchange="displayImage(this, \'variant_' + i + '_image-view\', \'img-thumbnail border-0\', 50, 50, false);" /></td>';
                        html += "</tr>";
                    }
                }
            }
        }

        $('#variant-table tbody').append(html);
        variantrows = $('#variant-table tbody tr');
        for (var i in variantrows) {
            if (!isNaN(parseInt(i)) && $.inArray(variantrows[i].id, availablevariantrow) == -1) {
                $('#' + variantrows[i].id).remove();
            }
        }
        $('#variant-table').show();
    });

    $(document).on('change', 'input[type="radio"][name="variant_default"]', function () {
        var id = $('input[type="radio"][name="variant_default"]:checked').attr('id');
        var netprice = $('#' + id.replace("_default", "_net_price")).val();
        var discount = $('#' + id.replace("_default", "_discount_price")).val();
        var productmrp = $('#' + id.replace("_default", "_product_mrp")).val();

        $('#selling_price').val(productmrp);
        $('#discount_price').val(discount);
        $('#net_price').val(netprice);
    });
    $('input[type="radio"][name="variant_default"]:checked').trigger('change');
});

function displayImage(fileinput, id, imageclass = "mx-5 my-3 img-thumbnail border-0", width = 200, height = 200, dispalyCrossClass = true) {
    var fileid = fileinput.id;
    var file = fileinput['files'][0];
    var reader = new FileReader();
    var baseString;
    reader.onloadend = function () {
        baseString = reader.result;
        $('#' + id).html('<button class="btn btn-link' + (dispalyCrossClass ? " cross-icon" : "") + '" onclick="removeImage(\'' + id + '\', 0)"><i class="fa' + (dispalyCrossClass ? " fa-2x" : "") + ' fa-times"></i></button><img class="' + imageclass + '" src="' + baseString + '" width="' + width + '" height="' + height + '" />');
    };
    reader.readAsDataURL(file);
    $('label[for="' + fileid + '"]').hide();
}

function removeImage(divid, id) {
    if (id > 0) {
        if (confirm("Do you want to delete this image?")) {
            $.get('/products/delete-image', { id: id }, function (result) {
                if (result.ok == true) {
                    toastr["success"]("", "Image deleted successfully, as " + result.message);
                    $('#' + divid).html('');
                    $('label[for="' + divid.replace("-view", "").replaceAll("-", "_") + '"]').show();
                } else {
                    toastr["error"]("", "Not able to delete the image, as " + result.message);
                }
            }, 'json');
        }
    } else {
        $('#' + divid).html('');
        $('label[for="' + divid.replace("-view", "").replaceAll("-", "_") + '"]').show();
        $('#' + divid.replace("-view", "").replaceAll("-", "_")).val("");
        var parEle = $('#' + divid.replace("-view", "").replaceAll("-", "_")).parent();
        var newEle = $('#' + divid.replace("-view", "").replaceAll("-", "_")).clone()
        $('#' + divid.replace("-view", "").replaceAll("-", "_")).remove();
        $(parEle).prepend(newEle);
    }
}

function validateProductForm() {
    $('.alert').remove();
    $('input, select, textarea').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    var error = 0;
    var errorMsg = [];
    if ($('#vendor_id').val().length == 0) {
        errorMsg.push("Please re-login");
        error++;
    }
    if ($('#main_category_id').val().length == 0) {
        $('#main_category_id').addClass('is-invalid');
        $('#main_category_id').attr('aria-describedby', ($('#main_category_id').attr('id')) + '-error');
        $('#main_category_id').attr('aria-invalid', 'true');
        $('#main_category_id').parent().append("<em id='" + ($('#main_category_id').attr('id')) + "-error' class='error invalid-feedback'>Main Category is required</em>");
        error++;
    }
    if ($('#sub_category_id').val().length == 0) {
        $('#sub_category_id').addClass('is-invalid');
        $('#sub_category_id').attr('aria-describedby', ($('#sub_category_id').attr('id')) + '-error');
        $('#sub_category_id').attr('aria-invalid', 'true');
        $('#sub_category_id').parent().append("<em id='" + ($('#sub_category_id').attr('id')) + "-error' class='error invalid-feedback'>Sub Category is required</em>");
        error++;
    }
    if ($('#gst_rate').val().length == 0) {
        $('#gst_rate').addClass('is-invalid');
        $('#gst_rate').attr('aria-describedby', ($('#gst_rate').attr('id')) + '-error');
        $('#gst_rate').attr('aria-invalid', 'true');
        $('#gst_rate').parent().append("<em id='" + ($('#gst_rate').attr('id')) + "-error' class='error invalid-feedback'>GST Rate is required</em>");
        error++;
    }
    if ($('#name').val().length == 0) {
        $('#name').addClass('is-invalid');
        $('#name').attr('aria-describedby', ($('#name').attr('id')) + '-error');
        $('#name').attr('aria-invalid', 'true');
        $('#name').parent().append("<em id='" + ($('#name').attr('id')) + "-error' class='error invalid-feedback'>Product Name is required</em>");
        error++;
    }
    if ($('#summary').val().length == 0) {
        $('#summary').addClass('is-invalid');
        $('#summary').attr('aria-describedby', ($('#summary').attr('id')) + '-error');
        $('#summary').attr('aria-invalid', 'true');
        $('#summary').parent().append("<em id='" + ($('#summary').attr('id')) + "-error' class='error invalid-feedback'>Product Summary is required.</em>");
        error++;
    }
    /*
    if (CKEDITOR.instances.description.getData().length == 0) {
        $('#description').addClass('is-invalid');
        $('#description').attr('aria-describedby', ($('#description').attr('id')) + '-error');
        $('#description').attr('aria-invalid', 'true');
        $('#description').parent().append("<em id='" + ($('#description').attr('id')) + "-error' class='error invalid-feedback'>Product Description is required</em>");
        error++;
    }
    */
    if ($('#hsn_code').val().length == 0) {
        $('#hsn_code').addClass('is-invalid');
        $('#hsn_code').attr('aria-describedby', ($('#hsn_code').attr('id')) + '-error');
        $('#hsn_code').attr('aria-invalid', 'true');
        $('#hsn_code').parent().append("<em id='" + ($('#hsn_code').attr('id')) + "-error' class='error invalid-feedback'>HSN Code is required</em>");
        error++;
    }
    if ($('#sku').val().length == 0) {
        $('#sku').addClass('is-invalid');
        $('#sku').attr('aria-describedby', ($('#sku').attr('id')) + '-error');
        $('#sku').attr('aria-invalid', 'true');
        $('#sku').parent().append("<em id='" + ($('#sku').attr('id')) + "-error' class='error invalid-feedback'>SKU is required</em>");
        error++;
    }
    /*
    if ($('#barcode').val().length == 0) {
        $('#barcode').addClass('is-invalid');
        $('#barcode').attr('aria-describedby', ($('#barcode').attr('id')) + '-error');
        $('#barcode').attr('aria-invalid', 'true');
        $('#barcode').parent().append("<em id='" + ($('#barcode').attr('id')) + "-error' class='error invalid-feedback'>Barcode is required</em>");
        error++;
    }
    */
    if ($('#selling_price').val().length == 0) {
        $('#selling_price').addClass('is-invalid');
        $('#selling_price').attr('aria-describedby', ($('#selling_price').attr('id')) + '-error');
        $('#selling_price').attr('aria-invalid', 'true');
        $('#selling_price').parent().append("<em id='" + ($('#selling_price').attr('id')) + "-error' class='error invalid-feedback'>Product MRP is required</em>");
        error++;
    }
    if ($('#discount_price').val().length == 0) {
        $('#discount_price').addClass('is-invalid');
        $('#discount_price').attr('aria-describedby', ($('#discount_price').attr('id')) + '-error');
        $('#discount_price').attr('aria-invalid', 'true');
        $('#discount_price').parent().append("<em id='" + ($('#discount_price').attr('id')) + "-error' class='error invalid-feedback'>Product Discount rate is required</em>");
        error++;
    }
    if ($('#net_price').val().length == 0) {
        $('#net_price').addClass('is-invalid');
        $('#net_price').attr('aria-describedby', ($('#net_price').attr('id')) + '-error');
        $('#net_price').attr('aria-invalid', 'true');
        $('#net_price').parent().append("<em id='" + ($('#net_price').attr('id')) + "-error' class='error invalid-feedback'>Product Selling Price is required</em>");
        error++;
    }
    if ($('#minoq').val().length == 0) {
        $('#minoq').addClass('is-invalid');
        $('#minoq').attr('aria-describedby', ($('#minoq').attr('id')) + '-error');
        $('#minoq').attr('aria-invalid', 'true');
        $('#minoq').parent().append("<em id='" + ($('#minoq').attr('id')) + "-error' class='error invalid-feedback'>Minimum Order Quantity is required</em>");
        error++;
    } else if (!(/^\d+$/).test($('#minoq').val())) {
        $('#minoq').addClass('is-invalid');
        $('#minoq').attr('aria-describedby', ($('#minoq').attr('id')) + '-error');
        $('#minoq').attr('aria-invalid', 'true');
        $('#minoq').parent().append("<em id='" + ($('#minoq').attr('id')) + "-error' class='error invalid-feedback'>Minimum Order Quantity must be numeric</em>");
        error++;
    }
    if ($('#maxoq').val().length == 0) {
        $('#maxoq').addClass('is-invalid');
        $('#maxoq').attr('aria-describedby', ($('#maxoq').attr('id')) + '-error');
        $('#maxoq').attr('aria-invalid', 'true');
        $('#maxoq').parent().append("<em id='" + ($('#maxoq').attr('id')) + "-error' class='error invalid-feedback'>Maximum Order Quantity is required</em>");
        error++;
    } else if (!(/^\d+$/).test($('#maxoq').val())) {
        $('#maxoq').addClass('is-invalid');
        $('#maxoq').attr('aria-describedby', ($('#maxoq').attr('id')) + '-error');
        $('#maxoq').attr('aria-invalid', 'true');
        $('#maxoq').parent().append("<em id='" + ($('#maxoq').attr('id')) + "-error' class='error invalid-feedback'>Maximum Order Quantity must be numeric</em>");
        error++;
    }
    if ($('#varient_property_manual').length > 0 && !$('#varient_property_manual').is(":checked") && $('#varient_property_copy').length > 0 && !$('#varient_property_copy').is(":checked")) {
        $('#varient_property_manual').addClass('is-invalid');
        $('#varient_property_manual').attr('aria-describedby', ($('#varient_property_manual').attr('id')) + '-error');
        $('#varient_property_manual').attr('aria-invalid', 'true');
        $('#varient_property_manual').parent().append("<em id='" + ($('#varient_property_manual').attr('id')) + "-error' class='error invalid-feedback'>Please select the Variant data</em>");
        $('#varient_property_copy').addClass('is-invalid');
        $('#varient_property_copy').attr('aria-describedby', ($('#varient_property_copy').attr('id')) + '-error');
        $('#varient_property_copy').attr('aria-invalid', 'true');
        $('#varient_property_copy').parent().append("<em id='" + ($('#varient_property_copy').attr('id')) + "-error' class='error invalid-feedback'>Please select the Variant data</em>");
        error++;
    }
    if ($('#varient_property_copy').length > 0 && $('#varient_property_copy').is(":checked") && $('#copy_from_product').val().length == 0) {
        $('#varient_property_copy').addClass('is-invalid');
        $('#varient_property_copy').attr('aria-describedby', ($('#varient_property_copy').attr('id')) + '-error');
        $('#varient_property_copy').attr('aria-invalid', 'true');
        $('#varient_property_copy').parent().append("<em id='" + ($('#varient_property_copy').attr('id')) + "-error' class='error invalid-feedback'>Please select the Product for copying the variant data</em>");
        error++;
    }
    if (($('#varient_property_manual').length > 0 && $('#varient_property_manual').is(":checked")) || window.location.pathname.indexOf("edit-product/") > -1) {
        var variants = $('input[type="checkbox"][name="variant_id[]"]');
        var varient_values = $('select[name="varient_value[]"]');
        var checked = false;
        for (var i in variants) {
            if (variants[i].checked == true) {
                checked = true;
                if (varient_values[i].value == '') {
                    $('#' + varient_values[i].id).addClass('is-invalid');
                    $('#' + varient_values[i].id).attr('aria-describedby', ($('#' + varient_values[i].id).attr('id')) + '-error');
                    $('#' + varient_values[i].id).attr('aria-invalid', 'true');
                    $('#' + varient_values[i].id).parent().append("<em id='" + ($('#' + varient_values[i].id).attr('id')) + "-error' class='error invalid-feedback'>Please select the Product variants</em>");
                    error++;
                }
            }
        }
        if (checked == false) {
            $('#' + variants[i].id).addClass('is-invalid');
            $('#' + variants[i].id).attr('aria-describedby', ($('#' + variants[i].id).attr('id')) + '-error');
            $('#' + variants[i].id).attr('aria-invalid', 'true');
            $('#' + variants[i].id).parent().append("<em id='" + ($('#' + variants[i].id).attr('id')) + "-error' class='error invalid-feedback'>Please check and select values for the Product variants</em>");
            error++;
        } else {
            var product_mrp = $('input[id^="variant_"][id$="_product_mrp"]');
            var net_price = $('input[id^="variant_"][id$="net_price"]');
            var discount_price = $('input[id^="variant_"][id$="discount_price"]');
            var net_weight = $('input[id^="variant_"][id$="net_weight"]');
            var defaultCheckbox = $('input[name="variant_default"]:checked').val();
            if (product_mrp.length == 0) {
                errorMsg.push("Please generate the Product variants");
                error++;
            } else {
                for (var i = 0; i < product_mrp.length; i++) {
                    if (!isNaN(parseInt(i))) {
                        if ($('#' + product_mrp[i].getAttribute('id')).val().length == 0) {
                            $('#' + product_mrp[i].getAttribute('id')).addClass('is-invalid');
                            $('#' + product_mrp[i].getAttribute('id')).attr('aria-describedby', ($('#' + product_mrp[i].getAttribute('id')).attr('id')) + '-error');
                            $('#' + product_mrp[i].getAttribute('id')).attr('aria-invalid', 'true');
                            $('#' + product_mrp[i].getAttribute('id')).parent().append("<em id='" + ($('#' + product_mrp[i].getAttribute('id')).attr('id')) + "-error' class='error invalid-feedback'>Please enter Product Mrp for Variant.</em>");
                            error++;
                        }
                        if ($('#' + net_price[i].getAttribute('id')).val().length == 0) {
                            $('#' + net_price[i].getAttribute('id')).addClass('is-invalid');
                            $('#' + net_price[i].getAttribute('id')).attr('aria-describedby', ($('#' + net_price[i].getAttribute('id')).attr('id')) + '-error');
                            $('#' + net_price[i].getAttribute('id')).attr('aria-invalid', 'true');
                            $('#' + net_price[i].getAttribute('id')).parent().append("<em id='" + ($('#' + net_price[i].getAttribute('id')).attr('id')) + "-error' class='error invalid-feedback'>Please enter Selling Price for Variant</em>");
                            error++;
                        }
                        if ($('#' + discount_price[i].getAttribute('id')).val().length == 0) {
                            $('#' + discount_price[i].getAttribute('id')).addClass('is-invalid');
                            $('#' + discount_price[i].getAttribute('id')).attr('aria-describedby', ($('#' + discount_price[i].getAttribute('id')).attr('id')) + '-error');
                            $('#' + discount_price[i].getAttribute('id')).attr('aria-invalid', 'true');
                            $('#' + discount_price[i].getAttribute('id')).parent().append("<em id='" + ($('#' + discount_price[i].getAttribute('id')).attr('id')) + "-error' class='error invalid-feedback'>Please enter Discount percent for Variant.</em>");
                            error++;
                        }
                        if ($('#' + net_weight[i].getAttribute('id')).val().length == 0) {
                            $('#' + net_weight[i].getAttribute('id')).addClass('is-invalid');
                            $('#' + net_weight[i].getAttribute('id')).attr('aria-describedby', ($('#' + net_weight[i].getAttribute('id')).attr('id')) + '-error');
                            $('#' + net_weight[i].getAttribute('id')).attr('aria-invalid', 'true');
                            $('#' + net_weight[i].getAttribute('id')).parent().append("<em id='" + ($('#' + net_weight[i].getAttribute('id')).attr('id')) + "-error' class='error invalid-feedback'>Please enter Weight for Variant.</em>");
                            error++;
                        }
                        if ($('#variant_' + defaultCheckbox + '_image').get(0).files.length == 0) {
                            $('#variant_' + defaultCheckbox + '_image').addClass('is-invalid');
                            $('#variant_' + defaultCheckbox + '_image').attr('aria-describedby', ($('#variant_' + defaultCheckbox + '_image').attr('id')) + '-error');
                            $('#variant_' + defaultCheckbox + '_image').attr('aria-invalid', 'true');
                            $('#variant_' + defaultCheckbox + '_image').parent().append("<em id='" + ($('#variant_' + defaultCheckbox + '_image').attr('id')) + "-error' class='error invalid-feedback'>Please select image for default variant");
                            error++;
                        }
                    }
                }
            }
        }
    }
    console.log(error, errorMsg);
    if (error == 0) {
        return true;
    } else {
        errors = errorMsg.map(x => '<div class="alert alert-danger">' + x + '</div>');
        $('form').prepend(errors.join(""));
        $(window).scrollTop(0);
        return false;
    }
}