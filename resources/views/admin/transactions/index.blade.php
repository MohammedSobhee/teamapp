@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        العمليات
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#new_transaction">
                    عملية جديدة
                </a>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row m-row--no-padding m-row--col-separator-xl centerize-items">
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                اجمالي الدخل
                            </h4><br>
                            <span class="m-widget24__stats m--font-brand">200</span>
                            <div class="m--space-40"></div>
                        </div>
                    </div>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                النص الثاني
                            </h4><br>
                            <span class="m-widget24__stats m--font-primary">30</span>
                            <div class="m--space-40"></div>
                        </div>
                    </div>
                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                النص الثالث
                            </h4><br>
                            <span class="m-widget24__stats m--font-info">10</span>
                            <div class="m--space-40"></div>
                        </div>
                    </div>
                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                النص الرابع
                            </h4><br>
                            <span class="m-widget24__stats m--font-warning">20</span>
                            <div class="m--space-40"></div>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                النص الخامس
                            </h4><br>
                            <span class="m-widget24__stats m--font-danger">1</span>
                            <div class="m--space-40"></div>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        جدول العمليات
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<span>تصدير الي اكسل</span>
										</span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <form class="align-items-center transaction-filter">
                    <div class="row">
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">التاريخ من</label>
                                <input id="filter_date_from" type="text" class="form-control m_datepicker" placeholder="اختر التاريخ">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">التاريخ الى</label>
                                <input id="filter_date_to" type="text" class="form-control m_datepicker" placeholder="اختر التاريخ">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">مالك الملعب</label>
                                <select id="filter_owner" class="form-control m-bootstrap-select m_selectpicker">
                                    <option selected disabled>اختر مالك الملعب</option>
                                    <option>محمد</option>
                                    <option>احمد</option>
                                    <option>محمود</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">نوع العملية</label>
                                <select id="filter_transaction_type" class="form-control m-bootstrap-select m_selectpicker">
                                    <option selected disabled>اختر نوع العملية</option>
                                    <option>دفع كلي</option>
                                    <option>دفع جزئي</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">طريقة الدفع</label>
                                <select id="filter_payment_type" class="form-control m-bootstrap-select m_selectpicker">
                                    <option selected disabled>اختر طريقة الدفع</option>
                                    <option>بطاقة ائتمانية</option>
                                    <option>دفع نقدي</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-group m-form__group input-group">
                                <label style="display: block;width:100%;text-align: right;">بحث</label>
                                <input type="text" class="form-control m-input" placeholder="ادخل كلمة البحث..." id="transaction_search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--begin: Datatable -->
            <table class="m-datatable" id="transactions_table" width="100%">
                <thead>
                <tr>
                    <th title="Field #1" data-field="Id">#</th>
                    <th title="Field #2" data-field="TransactionType">نوع العملية</th>
                    <th title="Field #2" data-field="Accounting">Accounting</th>
                    <th title="Field #3" data-field="Amount">المبلغ</th>
                    <th title="Field #3" data-field="Date">التاريخ</th>
                    <th title="Field #3" data-field="PaymentType">طريقة الدفع</th>
                    <th title="Field #3" data-field="Percentage">النسبة</th>
                    <th title="Field #3" data-field="PitcheOwner">مالك الملعب</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>دفع كلي</td>
                    <td>دفع</td>
                    <td>500</td>
                    <td>15/05/1990</td>
                    <td>دفع نقدي</td>
                    <td>50%</td>
                    <td>محمد محمود</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="new_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">عملية جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control" id="m_datepicker_1" placeholder="تاريخ العملية">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-form__group input-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker">
                                        <option selected disabled>اختر مالك الملعب</option>
                                        <option>محمد</option>
                                        <option>احمد</option>
                                        <option>محمود</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-form__group input-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker">
                                        <option selected disabled>اختر نوع العملية</option>
                                        <option>تسوية كاملة</option>
                                        <option>دفع جزئي</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-form__group input-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker">
                                        <option selected disabled>اختر طريقة الدفع</option>
                                        <option>بطاقة ائتمانية</option>
                                        <option>دفع نقدي</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="button" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>

        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
    @endpush
@stop
