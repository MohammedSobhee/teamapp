@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        إدارة مديرو النظام
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="{{url(admin_users_url().'/create-admin')}}"
                   class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air add-admin-mdl">
                    أضف جديد
                </a>
            </div>
        </div>
        <div class="m-portlet__body">

            <div class="tab-content">
                <div class="tab-pane active" id="admins" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="users_list" width="100%">
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
        <script src="{{url('/')}}/assets/js/admins.js" type="text/javascript"></script>
    @endpush
@stop
