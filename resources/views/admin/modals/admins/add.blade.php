<div class="modal fade" id="add-admin" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'post','files'=>true]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">مدير جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 order-md-2">
                        <div class="user-img-wrap">
                            <input type="file" name="logo" class="hide" style="display: none;"/>
                            <img src="{{url('/')}}/assets/img/placeholder-user.png"/>
                            <a href="#" class="change-img"><i class="la la-image"></i></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control m-input" name="username"
                                           placeholder="إسم المستخدم">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="text" class="form-control m-input" name="mobile"
                                           placeholder="رقم الجوال">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group m-form__group input-group">
                                    <input type="email" class="form-control m-input" name="email"
                                           placeholder="البريد الالكتروني">
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
