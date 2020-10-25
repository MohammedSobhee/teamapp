@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        ملعب الكامب نو
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
									<span class="pitch-status m-switch m-switch--icon m-switch--sm m-switch--primary">
										<label>
											<input type="checkbox" checked="checked" name="">
											<span></span>
										</label>
									</span>
                <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل"><i class="la la-edit"></i></a>
                <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="حذف"><i class="la la-trash"></i></a>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row pitch-details-wrap">
                <div class="col-12 col-lg-8">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">المدينة: </label>
                        <div class="col-lg-9">
                            <label class="col-form-label">جدة</label>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">العنوان: </label>
                        <div class="col-lg-9">
                            <label class="col-form-label">جدة شارع الرشيد</label>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">السعر: </label>
                        <div class="col-lg-9">
                            <label class="col-form-label">500 ريال سعودي / الساعة</label>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">مبلغ الخصم: </label>
                        <div class="col-lg-9">
                            <label class="col-form-label">100 ريال سعودي / الساعة</label>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">مساحة الملعب: </label>
                        <div class="col-lg-9">
                            <div class="sizes-tags-input">
                                <div class="tag-input-item"><span>50*50</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">الخدمات: </label>
                        <div class="col-lg-9">
                            <div class="sizes-tags-input">
                                <div class="tag-input-item"><span>ملعب معشب</span></div>
                                <div class="tag-input-item"><span>موقف سيارات</span></div>
                                <div class="tag-input-item"><span>اماكن استراحة</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <label style="font-weight: 500;font-size: 15px;margin:8px 0 5px">أيام العمل</label>
                        <table class="times-table table m-table m-table--head-separator-primary table-center table-bordered">
                            <thead>
                            <tr>
                                <th>السبت</th>
                                <th>الأحد</th>
                                <th>الاثنين</th>
                                <th>الثلاثاء</th>
                                <th>الأربعاء</th>
                                <th>الخميس</th>
                                <th>الجمعة</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                                <td>
														<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
															<label>
																<input type="checkbox" disabled checked="checked" name="">
																<span></span>
															</label>
														</span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                    </span>
                                    <div class="time-items">
                                        <span>11:00 am</span> - <span>12:00pm</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">مالك الملعب: </label>
                        <div class="col-lg-9">
                            <label class="">
                                <img src="{{url('/')}}/assets/app/media/img/users/user4.jpg" alt="" width="40" style="border-radius: 100%;margin-left:10px;">
                                <span>محمد أحمد محمود</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div id="owl-carousel" class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="https://news.artnet.com/app/news-upload/2017/08/images_file_67433-1024x683.jpg" />
                        </div>
                        <div class="item">
                            <img src="https://news.artnet.com/app/news-upload/2017/08/images_file_67433-1024x683.jpg" />
                        </div>
                        <div class="item">
                            <img src="https://news.artnet.com/app/news-upload/2017/08/images_file_67433-1024x683.jpg" />
                        </div>
                    </div>
                    <div class="google-map" style="margin-top:30px;height:300px;" id="map"></div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/owl.carousel.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37ZOdPlm3cYT3R0PXghW3nS56nZjd0So&callback=initMap"></script>

    @endpush
@stop
