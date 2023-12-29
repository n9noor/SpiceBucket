$(document).ready(function () {
    $('#start_datetime').datepicker({
        format: 'dd-mm-yyyy',
        startDate: new Date()

    });
    $('#end_datetime').datepicker({
        format: 'dd-mm-yyyy',
        startDate: new Date()
    });
    $('#start_datetime, #end_datetime').datepicker('setDate', new Date());
    $('#start_datetime').on('pick.datepicker', function (e) {
        $('#end_datetime').datepicker('setStartDate', e.date);
    });
    $('#end_datetime').on('pick.datepicker', function (e) {
        $('#start_datetime').datepicker('setEndDate', e.date);
    });
    $(".multiselect-dropdown").select2({
        theme: "bootstrap4",
        placeholder: "Select an option",
        closeOnSelect: false,
        allowHtml: true,
        allowClear: true,
        tags: true
    });
    $('input[type="radio"][name="coupon_type"]').change(function () {
        var value = $('input[type="radio"][name="coupon_type"]:checked').val();
        if (value == 'flat') {
            $('#flat_coupon_div').show();
            $('#percent_coupon_div').hide();
        } else {
            $('#percent_coupon_div').show();
            $('#flat_coupon_div').hide();
        }
    });
    $('input[type="radio"][name="coupon_type"]').trigger('change');
});