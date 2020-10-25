<!DOCTYPE html>
<html lang="ar">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo e(config('app.name')); ?> | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta content="<?php echo e(csrf_token()); ?>" name="csrf-token"/>

    <?php echo $__env->make(admin_layout_vw().'.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body dir="rtl" class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
<?php echo $__env->make(admin_layout_vw().'.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
    <?php echo $__env->make(admin_layout_vw().'.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- END: Subheader -->
            <div class="m-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->
<?php echo $__env->make(admin_layout_vw().'.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- end::Footer -->
</div>

<!-- end:: Page -->


<!-- begin::Scroll Top -->


<div id="results-modals"></div>

<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->
<?php echo $__env->make(admin_layout_vw().'.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

<!-- end::Body -->
</html>
<?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/layout/index.blade.php ENDPATH**/ ?>