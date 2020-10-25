<!--begin::Web font -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>

<!--end::Web font -->

<!--begin::Global Theme Styles -->
<link href="<?php echo e(url('/')); ?>/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>

<!--end::Global Theme Styles -->

<!--begin::Page Vendors Styles -->
<link href="<?php echo e(url('/')); ?>/assets/custom.css" rel="stylesheet" type="text/css"/>

<!--end::Page Vendors Styles -->
<link rel="shortcut icon" href="<?php echo e(url('/')); ?>/assets/demo/default/media/img/logo/favicon.ico"/>

<style>
    td, th span {
        text-align: center;
    }

    .rounded-circle {
        width: 80px;
        height: 80px;
    }
</style>
<?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/layout/css.blade.php ENDPATH**/ ?>