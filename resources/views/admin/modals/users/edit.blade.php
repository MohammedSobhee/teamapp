<div class="modal fade" id="edit-user" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'put','files'=>true]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">تعديل البيانات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 order-md-2">
                        <div class="user-img-wrap">
                            <input type="file" name="image" class="hide" style="display: none;"/>
                            <img src="{{$user->image ?? url('/assets/img/placeholder-user.png')}}"/>
                            <a href="#" class="change-img"><i class="la la-image"></i></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group m-form__group input-group">
                            <input type="text" class="form-control m-input" name="name" placeholder="الإسم الكامل" value="{{$user->full_name}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control m-input" name="username" value="{{$user->username}}"
                                           placeholder="إسم المستخدم">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker" name="type">
                                        <option selected disabled>اختر نوع المستخدم</option>
                                        <option value="pitch_owner" @if($user->type == 'pitch_owner') selected @endif>مالك ملعب</option>
                                        <option value="player" @if($user->type == 'player') selected @endif>لاعب</option>
                                    </select>
                                </div>
                            </div>
                            {{--                            <div class="col-6">--}}
                            {{--                                <div class="form-group m-form__group input-group">--}}
                            {{--                                    <input type="password" class="form-control m-input" placeholder="كلمة المرور">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-6">--}}
                            {{--                                <div class="form-group m-form__group input-group">--}}
                            {{--                                    <input type="password" class="form-control m-input"--}}
                            {{--                                           placeholder="تأكيد كلمة المرور">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control m-input" name="mobile"  value="{{$user->mobile}}"
                                           placeholder="رقم الجوال">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker" name="city_id">
                                        <option selected disabled>المدينة</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if($user->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="email" class="form-control m-input" name="email"  value="{{$user->email}}"
                                           placeholder="البريد الالكتروني">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control m-input" name="address" placeholder="العنوان"   value="{{$user->address}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-primary save">حفظ</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
        type="text/javascript"></script>
