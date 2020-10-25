// var users_table_table = $("#users_table_table");
$(document).ready(function () {

    $(document).on('submit', 'form', function (event) {

        var _this = $(this);
        var loader = ' <i class="fa fa-spinner fa-spin"></i> ';
        _this.find('.btn.save').prepend(loader)
        // _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files
        var formData = new FormData($(this)[0]);

        var action = $(this).attr('action');
        var method = $(this).attr('method');
        $.ajax({
            url: action,
            type: method,
            data: formData,

            contentType: false,
            processData: false,
            success: function (data) {

                if (data.status) {

                    $('.alert').hide();

                    toastr.success(data.message);
                    positions_table.reload();

                } else {
                    var $errors = '<strong>' + data.message + '</strong>';
                    $errors += '<ul>';
                    $.each(data.errors, function (i, v) {
                        $errors += '<li>' + v.message + '</li>';
                    });
                    $errors += '</ul>';
                    $('.alert').show();
                    $('.alert').html($errors);
                    toastr.error(data.message);


                }
                _this.find('.btn.save i').remove();
                // _this.find('.save').remove()

            }
        });
    });

    $(document).on('click', '.delete', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        // var target = $(event.target);
        // alert($(event.target).hasClass('service-delete'))

        swal({
            title: 'هل أنت متأكد؟',
            text: "لن تكون قادرة على التراجع عن العملية!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم احذفها!',
            cancelButtonText: 'إلغاء الامر'

        }).then(function (result) {
            if (result.value) {

                $.ajax({
                    url: action,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {_token: csrf_token},
                    success: function (data) {

                        if (data.status) {
                            toastr.success(data.message, '');
                            positions_table.reload();
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });

            }
        });


    });
    //

    $(document).on('click', '.add-positions-mdl', function (e) {

        var _this = $(this);
        var loader = ' <i class="fa fa-spinner fa-spin"></i> ';
        _this.prepend(loader);

        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-position').modal({backdrop: 'static', keyboard: false});
                _this.find('i').remove();

            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.edit-positions-mdl', function (e) {

        var _this = $(this);
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#edit-position').modal({backdrop: 'static', keyboard: false});

            }, error: function (xhr) {

            }
        });
    });
    $(document).on('change', '.status', function (event) {

        var _this = $(this);
        var action = _this.data('link');
        event.preventDefault();
        // var target = $(event.target);
        // alert($(event.target).hasClass('service-delete'))
        swal({
            title: 'هل أنت متأكد؟',
            // text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بتأكيد',
            cancelButtonText: 'إلغاء الامر'
        }).then(function (result) {
            if (result.value) {

                $.ajax({
                    url: action,
                    type: 'PUT',
                    dataType: 'json',
                    data: {_token: csrf_token},
                    success: function (data) {

                        if (data.status) {
                            toastr.success(data.message, '');
                            _this.attr('data-status', (status) ? 0 : 1)
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });

            } else {
                positions_table.reload();
            }

        });


    });

});
