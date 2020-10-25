@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        انشاء مقال جديد
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form>
                <div class="row">
                    <div class="col-12 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <div class="create-article">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" placeholder="العنوان">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">اختر صورة المقال</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m-input" placeholder="رابط الفيديو">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="تاريخ المقال">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
															<span class="m-switch m-switch--icon m-switch--primary">
																<label>
																	<input type="checkbox" checked="checked" name="">
																	<span></span>
																</label>
															</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="profile-form-save text-right">
                                    <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
												<span>
													<span>حفظ</span>
												</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>\
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>

    @endpush
@stop
