<!--begin::Global Theme Bundle -->

<script src="<?php echo e(url('/')); ?>/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<script src="<?php echo e(url('/')); ?>/assets/vendors/toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/vendors/toastr/sweetalert2.min.js" type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js"
        type="text/javascript"></script>
<!--end::Page Vendors -->
<script>
    var baseURL = '<?php echo e(url(admin_vw())); ?>';
    var baseAssets = '<?php echo e(url('assets')); ?>';

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(document).ready(function () {
        $(document).on('submit', '#add-team-league-frm', function (event) {
            var _this = $(this);
            var loader = ' <i class="fa fa-spinner fa-spin"></i> ';
            _this.find('.btn.save').append(loader);
            // _this.find('.btn.save i').addClass('fa-spinner fa-spin');
            event.preventDefault(); // Totally stop stuff happening
            // START A LOADING SPINNER HERE
            // Create a formdata object and add the files

            var teams = [];
            $.each($(".m-checkbox input:checked"), function () {
                teams.push($(this).val());
            });

            console.log(teams)
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
    });

</script>
<!--begin::Page Scripts -->

<?php echo $__env->yieldPushContent('js'); ?>
<?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/layout/js.blade.php ENDPATH**/ ?>