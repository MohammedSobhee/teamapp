@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        إدارة المستخدمين
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="{{url(admin_users_url().'/create')}}"
                   class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air add-user-mdl">
										<span>
											<span>أضف جديد</span>
										</span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
{{--                <li class="nav-item m-tabs__item">--}}
{{--                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#admins" role="tab">المديرين</a>--}}
{{--                </li>--}}
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#pitch-owners" role="tab">مالكي الملاعب</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#players" role="tab">اللاعبين</a>
                </li>
            </ul>
            <div class="tab-content">
{{--                <div class="tab-pane active" id="admins" role="tabpanel">--}}
{{--                    <!--begin: Datatable -->--}}
{{--                    <table class="m-datatable" id="users_list" width="100%">--}}
{{--                    </table>--}}

{{--                    <!--end: Datatable -->--}}
{{--                </div>--}}
                <div class="tab-pane active" id="pitch-owners" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="users_list2" width="100%">
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="players" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="users_list3" width="100%">
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
        <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    @endpush
@stop
