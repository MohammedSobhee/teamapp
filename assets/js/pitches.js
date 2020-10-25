// var users_table_table = $("#users_table_table");
$(document).ready(function () {

    $(document).on('submit', 'form', function (event) {

        var _this = $(this);
        // var loader = '<i class="fa fa-spinner fa-spin"></i>';
        _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files

        var formData = new FormData($(this)[0]);
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        var totalfiles = document.getElementById('pitch-imgs').files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("files[]", document.getElementById('pitch-imgs').files[index]);
        }
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
                    location.reload();

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
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

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
                            pitches_table.reload();

                            swal(
                                'تم الحذف!',
                                'تم حذف ملفك.',
                                'success'
                            )
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });

            }
        });


    });

});
