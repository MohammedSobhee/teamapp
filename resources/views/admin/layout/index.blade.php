<!DOCTYPE html>
<html lang="ar">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name')}} | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta content="{{csrf_token()}}" name="csrf-token"/>

    @include(admin_layout_vw().'.css')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body dir="rtl" class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
@include(admin_layout_vw().'.header')

<!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
    @include(admin_layout_vw().'.sidebar')

    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- END: Subheader -->
            <div class="m-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->
@include(admin_layout_vw().'.footer')

<!-- end::Footer -->
</div>

<!-- end:: Page -->


<!-- begin::Scroll Top -->


<div id="results-modals"></div>

<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->
@include(admin_layout_vw().'.js')

</body>

<!-- end::Body -->
</html>
