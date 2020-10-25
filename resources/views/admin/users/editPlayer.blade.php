@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تعديل الملف الشخصي للاعب
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <h5 style="margin-left:10px;">حالة اللاعب</h5>
                <span class="m-switch m-switch--icon m-switch--primary">
										<label>
											<input type="checkbox" @if($player->is_active) checked="checked"
                                                   @endif class="status"
                                                   data-status="{{$player->is_active}}"
                                                   data-link="{{ url(admin_users_url() . '/user/' . $player->id . '/status') }}"
                                                   name="">
											<span></span>
										</label>
									</span>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['method'=>'PUT','files'=>true]) !!}
            <div class="text-center profile-change-image-wrap">
                <div class="payer-rate">

                    @for($i = 0; $i<ceil($player->Rates()->avg('rate'));$i++)
                        <i class="fas fa-star active"></i>
                    @endfor

                    @for($i = 0; $i< 5 -ceil($player->Rates()->avg('rate'));$i++)
                        <i class="fas fa-star"></i>
                    @endfor

                </div>
                <div class="user-img-wrap">
                    <input type="file" class="hide" name="image" style="display: none;"/>
                    <img src="{{$player->image}}"/>
                    <a href="#" class="change-img"><i class="la la-image"></i></a>
                </div>
            </div>
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary tabs-center" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile" role="tab">الملف
                        الشخصي</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#player_card" role="tab">بطاقة اللاعب</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="profile-items">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>الاسم الكامل</label>
                                            <input type="text" class="form-control m-input" name="name"
                                                   value="{{$player->full_name}}"
                                                   placeholder="الإسم الكامل">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>اسم المستخدم</label>
                                            <input type="text" class="form-control m-input" name="username"
                                                   value="{{$player->username}}"
                                                   placeholder="إسم المستخدم">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>رقم الجوال</label>
                                            <input type="text" class="form-control m-input" name="mobile"
                                                   value="{{$player->mobile}}"
                                                   placeholder="رقم الجوال">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>المدينة</label>
                                            <select class="form-control m-bootstrap-select m_selectpicker"
                                                    name="city_id">
                                                <option disabled>المدينة</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}"
                                                            @if($player->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>البريد الالكتروني</label>
                                            <input type="email" class="form-control m-input"
                                                   value="{{$player->email}}" name="email"
                                                   placeholder="البريد الالكتروني">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>تاريخ الميلاد</label>
                                            <input type="text" class="form-control" id="m_datepicker_1"
                                                   name="birth_date"
                                                   value="{{$player->birth_date}}" readonly
                                                   placeholder="اختر تاريخ الميلاد"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>الطول</label>
                                            <input type="text" class="form-control m-input"
                                                   value="{{$player->height}}" name="height"
                                                   placeholder="ادخل طول اللاعب">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>الوزن</label>
                                            <input type="text" class="form-control m-input"
                                                   value="{{$player->weight}}" name="weight"
                                                   placeholder="أدخل وزن اللاعب">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>المركز الرئيسي</label>
                                            <select class="form-control m-bootstrap-select m_selectpicker"
                                                    name="primer_position_id">
                                                <option disabled>اختر مركز اللاعب</option>

                                                @foreach($positions as $position)
                                                    <option value="{{$position->id}}"
                                                            @if($player->primer_position_id == $position->id) selected @endif>{{$position->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>المركز الثانوي</label>
                                            <select class="form-control m-bootstrap-select m_selectpicker"
                                                    name="secondary_position_id">
                                                <option disabled>اختر مركز اللاعب</option>
                                                @foreach($positions as $position)
                                                    <option value="{{$position->id}}"
                                                            @if($player->secondary_position_id == $position->id) selected @endif>{{$position->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group m-form__group input-group">
                                            <label>السيرة الذاتية</label>
                                            <textarea class="form-control m-input"
                                                      placeholder="السيرة الذاتية للاعب" id="exampleTextarea"
                                                      name="bio"
                                                      rows="3">{{$player->bio}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="profile-form-save text-right">
                                        <button type="submit"
                                                class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air save">
                                            حفظ                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="player_card" role="tabpanel">
                    <div class="profile-items">
                        <div class="row m-row--no-padding m-row--col-separator-xl centerize-items">
                            <div class="col-md-12 col-lg-6 col-xl-2">
                                <!--begin::Total Profit-->
                                <div class="m-widget24">
                                    <div class="m-widget24__item">
                                        <h4 class="m-widget24__title">
                                            المباريات الملعوبة
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
                                            الأهداف المسجلة
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
                                            التمريرات الحاسمة
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
                                            البطاقات الصفراء
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
                                            البطاقات الحمراء
                                        </h4><br>
                                        <span class="m-widget24__stats m--font-danger">1</span>
                                        <div class="m--space-40"></div>
                                    </div>
                                </div>
                                <!--end::New Users-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3"></div>
                            <div class="col-12 col-md-6">

                                <div class="m-section__content">
                                    <div class="m--space-30"></div>
                                    <div class="progress-item">
                                        <label>السرعة</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-primary" role="progressbar"
                                                 style="width: 45%;" aria-valuenow="45" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                    <div class="progress-item">
                                        <label>التسديد</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-warning" role="progressbar"
                                                 style="width: 85%;" aria-valuenow="85" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                    <div class="progress-item">
                                        <label>التمرير</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-info" role="progressbar"
                                                 style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                    <div class="progress-item">
                                        <label>المراوغة</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-danger" role="progressbar"
                                                 style="width: 60%;" aria-valuenow="60" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                    <div class="progress-item">
                                        <label>الدفاع</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-success" role="progressbar"
                                                 style="width: 80%;" aria-valuenow="80" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                    <div class="progress-item">
                                        <label>الاحتكاك</label>
                                        <div class="progress m-progress--lg">
                                            <div class="progress-bar m--bg-brand" role="progressbar"
                                                 style="width: 70%;" aria-valuenow="70" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m--space-10"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
                type="text/javascript"></script>

        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    @endpush
@stop
