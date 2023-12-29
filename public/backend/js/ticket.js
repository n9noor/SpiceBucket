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
    $('#department').on('change', function () {
        var value = $(this).val();
        $.get('/ticket/get-department-user', { id: value }, function (result) {
            $('#agent').select2('destroy');
            var html = '<option value=""></option>';
            for (var user in result.users) {
                html += '<option value="' + result.users[user].id + '">' + result.users[user].firstname + ' ' + result.users[user].lastname + '</option>';
            }
            $('#agent').html(html);
            $('#agent').select2({
                theme: "bootstrap4",
                placeholder: "Select an option",
            });
        }, 'json');
    });
    if ($('#department').val() > 0) {
        $('#department').trigger('change');
    }

    $('#update-status-btn').click(function () {
        var status = $('#status').val();
        var department = $('#department').val();
        var agent = $('#agent').val();
        var id = $('#ticket-id').val();

        $.post('/ticket/update-status/' + id, { _token: $('#defaultcsrftoken').val(), status: status, department: department, agent: agent }, function (result) {
            if (result.status == true) {
                alertify.success('Ticket updated successfully.');
            } else {
                alertify.error('Ticket not updated, as ' + result.message);
            }
        }, 'json');
    });

    $('#update-comment-btn').click(function () {
        var comment = $('#comment').val();
        var id = $('#ticket-id').val();

        if ($.trim(comment).length == 0 || comment == '') {
            alertify.error('Please enter the comment');
            return false;
        }

        $.post('/ticket/update-comment/' + id, { _token: $('#defaultcsrftoken').val(), comment: comment }, function (result) {
            if (result.status == true) {
                alertify.success('Comment on ticket added successfully.');
                getNotes(id);
            } else {
                alertify.error('Not able to add comment, as ' + result.message);
            }
        }, 'json');
    });
});

function getNotes(id) {
    $.get('/ticket/read-notes/' + id, function(result){
        if (result.status == true) {
            $('#comment').val('');
            $('#notes-list').html(result.noteshtml);
        } else {
            alertify.error('Not able to add comment, as ' + result.message);
        }
}, 'json');
}