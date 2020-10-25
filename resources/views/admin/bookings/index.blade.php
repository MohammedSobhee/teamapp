@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        الحجوزات
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#upcoming" role="tab">القادمة</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#completed" role="tab">المكتملة</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#cancelled" role="tab">الملغاة</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="upcoming" role="tabpanel">
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input m-input--solid" placeholder="بحث..." id="booking_search">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="booking_list" width="100%">
                        <thead>
                        <tr>
                            <th title="Field #1" data-field="Id">#</th>
                            <th title="Field #2" data-field="PitcheOwner">مالك الملعب</th>
                            <th title="Field #3" data-field="Player">اللاعب</th>
                            <th title="Field #4" data-field="Date">التاريخ</th>
                            <th title="Field #5" data-field="Time">الوقت</th>
                            <th title="Field #6" data-field="Hours">عدد الساعات</th>
                            <th title="Field #7" data-field="Amount">الكمية</th>
                            <th title="Field #8" data-field="Payment">المدفوع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="completed" role="tabpanel">
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input m-input--solid" placeholder="بحث..." id="booking_search2">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="booking_list2" width="100%">
                        <thead>
                        <tr>
                            <th title="Field #1" data-field="Id">#</th>
                            <th title="Field #2" data-field="PitcheOwner">مالك الملعب</th>
                            <th title="Field #3" data-field="Player">اللاعب</th>
                            <th title="Field #4" data-field="Date">التاريخ</th>
                            <th title="Field #5" data-field="Time">الوقت</th>
                            <th title="Field #6" data-field="Hours">عدد الساعات</th>
                            <th title="Field #7" data-field="Amount">الكمية</th>
                            <th title="Field #8" data-field="Payment">المدفوع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="cancelled" role="tabpanel">
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input m-input--solid" placeholder="بحث..." id="booking_search3">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="booking_list3" width="100%">
                        <thead>
                        <tr>
                            <th title="Field #1" data-field="Id">#</th>
                            <th title="Field #2" data-field="PitcheOwner">مالك الملعب</th>
                            <th title="Field #3" data-field="Player">اللاعب</th>
                            <th title="Field #4" data-field="Date">التاريخ</th>
                            <th title="Field #5" data-field="Time">الوقت</th>
                            <th title="Field #6" data-field="Hours">عدد الساعات</th>
                            <th title="Field #7" data-field="Amount">الكمية</th>
                            <th title="Field #8" data-field="Payment">المدفوع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد محمود أحمد</td>
                            <td>محمد أحمد</td>
                            <td>15/05/2019</td>
                            <td>10:00 pm</td>
                            <td>5</td>
                            <td>50</td>
                            <td>20</td>
                        </tr>
                        </tbody>
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
