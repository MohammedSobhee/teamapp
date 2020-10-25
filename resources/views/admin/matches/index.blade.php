@extends(admin_layout_vw().'.index')


@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        المباريات
                    </h3>
                </div>
            </div>
{{--            <div class="m-portlet__head-tools">--}}
{{--                <a href="{{url(admin_leagues_url().'/add')}}"--}}
{{--                   class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">--}}
{{--										<span>--}}
{{--											<span>مباراة جديدة</span>--}}
{{--										</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#upcoming" role="tab">القادمة</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#current" role="tab">الحالية</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#complete" role="tab">المكتملة</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="upcoming" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="matches_upcoming_table" width="100%">
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="current" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="matches_current_table" width="100%">
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="complete" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="matches_completed_table" width="100%">
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
    @endpush
@stop
