@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تعديل الملف الشخصي للمدير
                    </h3>
                </div>
            </div>
        </div>
        {!! Form::open(['method'=>'PUT','files'=>true]) !!}
        <div class="m-portlet__body">
            <div class="text-center profile-change-image-wrap">
                <div class="user-img-wrap">
                    <input type="file" name="logo" class="hide" style="display: none;"/>
                    <img src="{{$admin->logo ?? url('/assets/img/placeholder-user.png')}}"/>
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
                @if(admin()->type == 'superadmin')
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#permissions" role="tab">الصلاحيات</a>
                    </li>
                @endif
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="profile-items">
                                <div class="row">
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <div class="form-group m-form__group input-group">--}}
                                    {{--                                                <label>الاسم الكامل</label>--}}
                                    {{--                                                <input type="text" class="form-control m-input" name="name" value="{{auth()->user()->name}}"--}}
                                    {{--                                                       placeholder="الإسم الكامل">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>اسم المستخدم</label>
                                            <input type="text" class="form-control m-input" name="username"
                                                   value="{{$admin->username}}"
                                                   placeholder="إسم المستخدم">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>رقم الجوال</label>
                                            <input type="text" class="form-control m-input" name="mobile"
                                                   value="{{$admin->mobile}}"
                                                   placeholder="رقم الجوال">
                                        </div>
                                    </div>
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <div class="form-group m-form__group input-group">--}}
                                    {{--                                                <label>المدينة</label>--}}
                                    {{--                                                <select class="form-control m-bootstrap-select m_selectpicker">--}}
                                    {{--                                                    <option selected>المدينة</option>--}}
                                    {{--                                                    <option>الرياض</option>--}}
                                    {{--                                                    <option selected>مكة</option>--}}
                                    {{--                                                    <option>الدمام</option>--}}
                                    {{--                                                </select>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    <div class="col-6">
                                        <div class="form-group m-form__group input-group">
                                            <label>البريد الالكتروني</label>
                                            <input type="email" class="form-control m-input" name="email"
                                                   value="{{$admin->email}}" placeholder="البريد الالكتروني">
                                        </div>
                                    </div>
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <div class="form-group m-form__group input-group">--}}
                                    {{--                                                <label>العنوان</label>--}}
                                    {{--                                                <input type="text" class="form-control m-input" value="شارع القاهرة"--}}
                                    {{--                                                       placeholder="العنوان">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
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
                                    <input type="password" class="form-control m-input" name="password"
                                           placeholder="كلمة المرور الجديدة">
                                </div>
                                <div class="form-group m-form__group input-group">
                                    <label>تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control m-input" name="password_confirmation"
                                           placeholder="تأكيد كلمة المرور">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="permissions" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="profile-items">
                                <div class="m-checkbox-list">

                                    @foreach($roles as $role)
                                        <label class="m-checkbox m-checkbox--state-primary" data-id="{{$role->id}}">
                                            <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                                   @if(in_array($role->id,$admin->Roles->pluck('id')->toArray())) checked @endif> {{$role->name}}
                                            <span></span>
                                        </label>
                                    @endforeach
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
                                    class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                حفظ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
        {{--        <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>--}}
        <script src="{{url('/')}}/assets/js/admins.js" type="text/javascript"></script>
    @endpush
@stop
