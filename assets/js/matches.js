// var users_table_table = $("#users_table_table");
$(document).ready(function () {

    $(document).on('click', '.save-match', function (event) {
        $('#save-match').submit();
    });
    $(document).on('submit', '#save-match', function (event) {

        var _this = $(this);

        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files


        var formData = new FormData($(this)[0]);
        _this.find('.save-match i').addClass('fa-spinner fa-spin');

        // formData.append('teams_id[]', favorite);
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
                    //
                    setTimeout(function () {
                        window.location.href = baseURL + '/matches/view/' + data.items.id
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
                _this.find('.save-match i').removeClass('fa-spinner fa-spin');
                // _this.find('.save').remove()

            }
        });
    });

    $(document).on('click', '.status', function (e) {

        e.preventDefault();
        var action = $(this).attr('href');

        swal({
            title: 'هل أنت متأكد؟',
            text: "لن تكون قادرة على التراجع عن العملية!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بتأكيد!',
            cancelButtonText: 'إلغاء الامر'

        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: action,
                    type: 'PUT',
                    dataType: 'json',
                    data: {_token: csrf_token},
                    success: function (data) {
                        toastr.success(data.message);
                        matches_upcoming_table.reload();
                        matches_current_table.reload();
                        matches_completed_table.reload();
                    }, error: function (xhr) {

                    }
                });
            }
        });
    });
    $(document).on('click', '.status_out', function (e) {

        e.preventDefault();
        var _this = $(this);
        var action = $(this).attr('href');


        swal({
            title: 'هل أنت متأكد؟',
            text: "لن تكون قادرة على التراجع عن العملية!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بتأكيد!',
            cancelButtonText: 'إلغاء الامر'

        }).then(function (result) {
            if (result.value) {
                _this.find('i').addClass('fa-spinner fa-spin');

                $.ajax({
                    url: action,
                    type: 'PUT',
                    dataType: 'json',
                    data: {_token: csrf_token},
                    success: function (data) {
                        toastr.success(data.message);
                        location.reload();
                    }, error: function (xhr) {

                    }
                });
            }
        });
    });
    $(document).on('click', '.saveAction', function (e) {

        // `track_type`, `player_id`, `team_id`, `match_id`, `track_time`, `substituted_player_id`
        e.preventDefault();
        var _this = $(this);
        var track_type = _this.closest('.action-item-wrapper').find(".action_record option:selected").val();
        var track_time = _this.closest('.action-item-wrapper').find('.time').val();
        var substituted_player_id = _this.closest('.action-item-wrapper').find('.substituted_player option:selected').val();
        var team_id = _this.closest('.player-action-wrap').find('.team').val();
        var player_id = _this.closest('.player-action-wrap').find('.player').val();
        var match_id = _this.closest('.player-action-wrap').find('.match').val();

        $og = _this.find('i').attr('class');
        _this.find('i').removeClass('la la-check').addClass('fa fa-spinner fa-spin');

        $.ajax({
            url: baseURL + '/matches/record',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                match_id: match_id,
                player_id: player_id,
                team_id: team_id,
                substituted_player_id: substituted_player_id,
                track_time: track_time,
                track_type: track_type
            },
            success: function (data) {

                if (data.status) {
                    toastr.success(data.message);
                    _this.closest('.action-item-wrapper').find('.removeAction').attr('data-id', data.items.id);


                } else {
                    toastr.error(data.message);
                }
                _this.find('i').removeClass('fa fa-spinner fa-spin').addClass($og);
            }, error: function (xhr) {

            }
        });
    });

});
