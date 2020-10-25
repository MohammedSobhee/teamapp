// var users_table_table = $("#users_table_table");
$(document).ready(function () {

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
