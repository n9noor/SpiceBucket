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
    $('#department').on('change', function(){
        var value = $(this).val();
        $.get('/ticket/get-department-user', {id: value}, function(result){
            $('#agent').select2('destroy');
            var html = '<option value=""></option>';
            for(var user in result.users){
                html += '<option value="' + result.users[user].id + '">' + result.users[user].firstname + ' ' + result.users[user].lastname + '</option>';
            }
            $('#agent').html(html);
            if($('#agent').hasAttr('data-selected')){
                $('#agent').val($('#agent').attr('data-selected'));
            }
            $('#agent').select2({
                theme: "bootstrap4",
                placeholder: "Select an option",
            });
        }, 'json');
    });
    if($('#department').val() > 0){
        $('#department').trigger('change');
    }
});