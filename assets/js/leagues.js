// var users_table_table = $("#users_table_table");
$(document).ready(function () {

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    $('a[href="' + activeTab + '"]').tab('show');

    $(document).on('submit', '#league', function (event) {

        var _this = $(this);
        var loader = ' <i class="fa fa-spinner fa-spin"></i> ';
        _this.find('.btn.save').prepend(loader);
        // _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files
        var favorite = [];
        $.each($("input[type='checkbox']:checked"), function () {
            favorite.push($(this).val());
        });

        var formData = new FormData($(this)[0]);

        formData.append('teams_id[]', favorite);
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
                    if (data.items.url != undefined) {
                        location.href = data.items.url;
                        return;
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 2000)

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
    $(document).on('submit', '#group', function (event) {

        var _this = $(this);
        var loader = ' <i class="fa fa-spinner fa-spin"></i> ';
        _this.find('.btn.save').prepend(loader)
        // _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files

        var teams = [];
        $.each($(".list-right input"), function () {
            teams.push($(this).val());
        });

        var formData = new FormData($(this)[0]);
        formData.delete('teams_id[]');
        formData.append('teams_id[]', teams);
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

                    setTimeout(function () {
                        // location.reload();
                        window.location.reload();
                        // window.location.href = window.location.href + '#groups';
                    }, 2000)

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
                            league_teams_table.reload();

                            // swal(
                            //     'تم الحذف!',
                            //     'تم حذف ملفك.',
                            //     'success'
                            // )
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });

            }
        });


    });
    $(document).on('click', '.delete-group', function (event) {

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
                            location.reload();

                            // swal(
                            //     'تم الحذف!',
                            //     'تم حذف ملفك.',
                            //     'success'
                            // )
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });

            }
        });


    });
    //

    $(document).on('change', '.status_action', function (event) {

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
                league_teams_table.reload();
            }

        });


    });

    $(document).on('click', '.status', function (e) {

        e.preventDefault();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'PUT',
            dataType: 'json',
            data: {_token: csrf_token},
            success: function (data) {
                toastr.success(data.message);
                leagues_upcoming_table.reload();
                leagues_current_table.reload();
                leagues_completed_table.reload();
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.add-league-team-mdl', function (e) {

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
                $('#add-league-team').modal({backdrop: 'static', keyboard: false});
                _this.find('i').remove();

            }, error: function (xhr) {

            }
        });
    });

});
