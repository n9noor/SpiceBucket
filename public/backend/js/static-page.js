$(document).ready(function () {
    $(document).on('click', '#first-add-btn', function () {
        var row = $('.first-title-div').length + 1;
        if ($('#first-div-' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#first-div-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.first-title-div').parent().append('<div class="first-title-div" id="first-div-' + row + '">'
            + '<div class="row">'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="first-subtitle-1" class="form-label">Subtitle</label>'
            + '         <input type="text" class="form-control" name="footer[firstsubtitle][]" id="first-subtitle-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mt-2">'
            + '         <label for="first-subtitle-url-1" class="first-form-label">Subtitle URL</label>'
            + '         <input type="text" class="form-control" name="footer[firstsubtitleurl][]" id="first-subtitle-url-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-1">'
            + '     <div class="position-relative mt-4">'
            + '         <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" id=delete-first-div-' + row + ' onclick="deleteFirstDiv(' + row + ')" type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '     </div>'
            + ' </div>'
            + '</div>'
            + '</div>');

    });


    $(document).on('click', '#second-add-btn', function () {
        var row = $('.second-title-div').length + 1;
        if ($('#second-div-' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#second-div-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.second-title-div').parent().append('<div class="second-title-div" id="second-div-' + row + '">'
            + '<div class="row">'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="second-subtitle-1" class="form-label">Subtitle</label>'
            + '         <input type="text" class="form-control" name="footer[secondsubtitle][]" id="second-subtitle-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mt-2">'
            + '         <label for="second-subtitle-url-1" class="second-form-label">Subtitle URL</label>'
            + '         <input type="text" class="form-control" name="footer[secondsubtitleurl][]" id="second-subtitle-url-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-1">'
            + '     <div class="position-relative mt-4">'
            + '         <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" id=delete-second-div-' + row + ' onclick="deleteSecondDiv(' + row + ')" type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '     </div>'
            + ' </div>'
            + '</div>'
            + '</div>');

    });

    $(document).on('click', '#third-add-btn', function () {
        var row = $('.third-title-div').length + 1;
        if ($('#third-div-' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#third-div-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.third-title-div').parent().append('<div class="third-title-div" id="third-div-' + row + '">'
            + '<div class="row">'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="third-subtitle-1" class="form-label">Subtitle</label>'
            + '         <input type="text" class="form-control" name="footer[thirdsubtitle][]" id="third-subtitle-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mt-2">'
            + '         <label for="third-subtitle-url-1" class="third-form-label">Subtitle URL</label>'
            + '         <input type="text" class="form-control" name="footer[thirdsubtitleurl][]" id="third-subtitle-url-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-1">'
            + '     <div class="position-relative mt-4">'
            + '         <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" id=delete-third-div-' + row + ' onclick="deleteThirdDiv(' + row + ')" type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '     </div>'
            + ' </div>'
            + '</div>'
            + '</div>');

    });

    $(document).on('click', '#fourth-add-btn', function () {
        var row = $('.fourth-title-div').length + 1;
        if ($('#fourth-div-' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#fourth-div-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.fourth-title-div').parent().append('<div class="fourth-title-div" id="fourth-div-' + row + '">'
            + '<div class="row">'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="fourth-subtitle-1" class="form-label">Subtitle</label>'
            + '         <input type="text" class="form-control" name="footer[fourthsubtitle][]" id="fourth-subtitle-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-5">'
            + '     <div class="position-relative mt-2">'
            + '         <label for="fourth-subtitle-url-1" class="fourth-form-label">Subtitle URL</label>'
            + '         <input type="text" class="form-control" name="footer[fourthsubtitleurl][]" id="fourth-subtitle-url-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + ' <div class="col-md-1">'
            + '     <div class="position-relative mt-4">'
            + '         <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" id=delete-fourth-div-' + row + ' onclick="deleteFourthDiv(' + row + ')" type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '     </div>'
            + ' </div>'
            + '</div>'
            + '</div>');

    });


    $(document).on('click', '#add-box-btn', function () {
        var row = $('.box-div').length + 1;
        if ($('#whatweprovideboxdiv' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#whatweprovideboxdiv-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.box-div').parent().append('<div class="box-div" id="whatweprovideboxdiv-' + row + '">'
            + '<div class="row">'
            + '<div class="col-md-3">'
            + '<div class="position-relative mb-3">'
            + '<label for="box-image" class="form-label">Image</label>'
            + '<input type="file" class="form-control" name="about[boximage][]" id="box-image-' + row + '" />'
            + '</div>'
            + '</div>'
            + ' <div class="col-md-4">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="box-title" class="form-label">Title</label>'
            + '         <input type="text" class="form-control" name="about[boxtitle][]" id="box-title-' + row + '" />'
            + '     </div>'
            + ' </div>'
            + '<div class="col-md-4">'
            + '     <div class="position-relative mb-3">'
            + '         <label for="box-subtitle" class="form-label">Sub Title</label>'
            + '         <input type="text" name="about[boxsubtitle][]" id="box-subtitle-' + row + '" class="form-control">'
            + '</div>'
            + ' </div>'
            + ' <div class="col-md-1">'
            + '     <div class="position-relative mt-4">'
            + '         <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" type="button" id="deleteBox-' + row + '" onclick="deleteAboutBox(' + row + ')"><i class="fa fa-fw fa-trash"></i></button>'
            + '     </div>'
            + ' </div>'
            + '</div>'
            + '</div>');
    });


    $(document).on('click', '#office-add-btn', function () {
        var row = $('.officeaddressdiv').length + 1;
        if ($('#officediv--' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#officediv-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.officeaddressdiv').parent().append('<div id="officediv-' + row + '" class="officeaddressdiv">'
            + '<div class="row">'
            + '<div class="col-md-4">'
            + '<div class="position-relative mb-3">'
            + '<label for="officename" class="form-label">Office Name</label>'
            + '<input type="text" class="form-control" name="contact[officename][]" id="officename-' + row + '">'
            + '</div>'
            + '</div>'
            + '<div class="col-md-4">'
            + '<div class="position-relative mb-3">'
            + '<label for="officeaddress" class="form-label">Office Address</label>'
            + '<input type="text" class="form-control" name="contact[officeaddress][]" id="officeaddress-' + row + '">'
            + '</div>'
            + '</div>'
            + '<div class="col-md-4">'
            + '<div class="position-relative mb-3">'
            + '<label for="officephone" class="form-label">Office Phone</label>'
            + '<input type="text" class="form-control" name="contact[officephone][]" id="officephone-' + row + '">'
            + '</div>'
            + '</div>'
            + '<div class="col-md-4">'
            + '<div class="position-relative mb-3">'
            + '<label for="officeemail" class="form-label">Office Email</label>'
            + '<input type="email" class="form-control" name="contact[officeemail][]" id="officeemail-' + row + '">'
            + '</div>'
            + '</div>'
            + '<div class="col-md-4">'
            + '<div class="position-relative mb-3">'
            + '<label for="officemapurl" class="form-label">Office Map URL</label>'
            + '<input type="text" class="form-control" name="contact[officemapurl][]" id="officemapurl-' + row + '">'
            + '</div>'
            + '</div>'
            + '<div class="col-md-1">'
            + '<div class="position-relative mt-4">'
            + '<button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteOfficeDiv(' + row + ')" id="delete-fourth-div-' + row + '" type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>')
    });

    //banner part

    $(document).on('click', '#bannner-add-btn', function () {
        var row = $('.homeBanner').length + 1;
        if ($('#home-banner-div-' + row).length > 0) {
            for (i = 1; i <= row; i++) {
                if ($('#home-banner-div-' + i).length == 0) {
                    row = i;
                    break;
                }
            }
        }
        $('.homeBanner').parent().append('<div class="homeBanner" id="home-banner-div-' + row + '">'
            + '<div class="row">'
            + '<div class="col-md-5">'
            + '<div class="position-relative mb-3">'
            + '<label for="home-banner" class="form-label">Desktop Banner</label>'
            + '<input type="file" class="form-control" name="home[banner][]" id="home-banner-' + row + '" />'
            + '</div>'
            + '</div>'
            + '<div class="col-md-5">'
            + '<div class="position-relative mb-3">'
            + '<label for="home-mobile-banner" class="form-label">Mobile Banner</label>'
            + '<input type="file" class="form-control" name="home[mobilebanner][]" id="home-mobile-banner-' + row + '" />'
            + '</div>'
            + '</div>'
            + '</div>'
            + '<div class="col-md-1 mt-3">'
            + '<div class="position-relative">'
            + '<button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteHomeBanner(' + row + ')" id="delete-home-div-' + row + '" + + type="button"><i class="fa fa-fw fa-trash"></i></button>'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>');

    });



});

function deleteFirstDiv(row) {
    var row = $('.first-title-div').length;
    if (row <= 1) {
        toastr["error"]("Atleast one subtitle should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#first-div-' + row).remove();
    }
}

function deleteSecondDiv(row) {
    var row = $('.second-title-div').length;
    if (row <= 1) {
        toastr["error"]("Atleast one subtitle should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#second-div-' + row).remove();
    }
}

function deleteThirdDiv(row) {
    var row = $('.third-title-div').length;
    if (row <= 1) {
        toastr["error"]("Atleast one subtitle should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#third-div-' + row).remove();
    }
}
function deleteFourthDiv(row) {
    var row = $('.fourth-title-div').length;
    if (row <= 1) {
        toastr["error"]("Atleast one subtitle should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#fourth-div-' + row).remove();
    }
}
function deleteAboutBox(row) {
    var row = $('.box-div').length;
    if (row <= 1) {
        toastr["error"]("Atleast one box should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#whatweprovideboxdiv-' + row).remove();
    }
}

function deleteOfficeDiv(row) {
    var row = $('.officeaddressdiv').length;
    if (row <= 1) {
        toastr["error"]("Atleast one address should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $('#officediv-' + row).remove();
    }
}
function deleteHomeBanner(row, mobilebannerimage, bannerimage) {
    var row = $('.homeBanner').length;
    if (row <= 1) {
        toastr["error"]("Atleast one banner should be there.", "Error: ");
        return false;
    }
    if (confirm("Are you sure to delete this?")) {
        $.ajax({
            type: 'post',
            url: '/administrator/edit-static-pages/delete-home-banner',
            data: {
                _token: $('#defaultcsrftoken').val(),
                mobilebannerimage: mobilebannerimage,
                bannerimage: bannerimage
            },
            success: function (result) {
                if (result.status == true) {
                    alertify.success(result.message);
                    $('#home-banner-div-' + row).remove();

                } else {
                    alertify.error(result.message);
                }
            },
            dataType: 'json'
        });
    } else {
        alertify.error(errormessage.join("<br/>"));
    }
}   
