@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تعديل الملف الشخصي لمالك الملعب
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <h5 style="margin-left:10px;">حالة مالك الملعب</h5>
                <span class="m-switch m-switch--icon m-switch--primary">
										<label>
											<input type="checkbox" @if($pitch_owner->is_active) checked="checked"
                                                   @endif class="status"
                                                   data-status="{{$pitch_owner->is_active}}"
                                                   data-link="{{ url(admin_users_url() . '/user/' . $pitch_owner->id . '/status') }}"
                                                   name="">
											<span></span>
										</label>
									</span>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['method'=>'PUT','url'=>url(admin_users_url().'/edit-pitch-owner/'.$pitch_owner->id),'files'=>true]) !!}

            <div class="text-center profile-change-image-wrap">
                <div class="user-img-wrap">
                    <input type="file" class="hide" name="image" style="display: none;"/>
                    <img src="{{$pitch_owner->image}}"/>
                    <a href="#" class="change-img"><i class="la la-image"></i></a>
                </div>
            </div>
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary tabs-center" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile" role="tab">الملف
                        الشخصي</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#change_pass" role="tab">تغيير كلمة
                        المرور</a>
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
                                            <input type="text" class="form-control m-input"
                                                   name="name"
                                                   value="{{$pitch_owner->full_name}}"
                                                   placeholder="الإسم الكامل">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>اسم المستخدم</label>
                                            <input type="text" class="form-control m-input" name="username"
                                                   value="{{$pitch_owner->username}}"
                                                   placeholder="إسم المستخدم">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>رقم الجوال</label>
                                            <input type="text" class="form-control m-input" name="mobile"
                                                   value="{{$pitch_owner->mobile}}"
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
                                                            @if($pitch_owner->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>البريد الالكتروني</label>
                                            <input type="email" class="form-control m-input"
                                                   value="{{$pitch_owner->email}}" name="email"
                                                   placeholder="البريد الالكتروني">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>العنوان</label>
                                            <input type="text" class="form-control m-input"
                                                   value="{{$pitch_owner->address}}" name="address"
                                                   placeholder="العنوان">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>نسبة العمولة (%)</label>
                                            <input type="text" class="form-control m-input"
                                                   value="{{$pitch_owner->commission}}" name="commission"
                                                   placeholder="نسبة العمولة">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>مبلغ الخصم بعد الإلغاء</label>
                                            <input type="text" class="form-control m-input"
                                                   value="{{$pitch_owner->discount}}" name="discount"
                                                   placeholder="مبلغ الخصم بعد الإلغاء">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="change_pass" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="profile-items">
                                <div class="form-group m-form__group input-group">
                                    <label>كلمة المرور الجديدة</label>
                                    <input type="password" class="form-control m-input"
                                           name="password"
                                           placeholder="كلمة المرور الجديدة">
                                </div>
                                <div class="form-group m-form__group input-group">
                                    <label>تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control m-input"
                                           name="password_confirmation"
                                           placeholder="تأكيد كلمة المرور">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <div class="profile-form-save text-right">
                            <button type="submit"
                                    class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air save">
                                حفظ
                            </button>
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
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    @endpush
@stop
