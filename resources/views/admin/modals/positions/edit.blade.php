<div class="modal fade" id="edit-position" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'PUT','url'=>url(admin_settings_url().'/positions/'.$position->id.'/edit')]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">تعديل المركز</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group input-group">
                    <input type="text" class="form-control m-input" name="title" value="{{$position->title}}"
                           placeholder="الإسم">
                </div>
                <div class="form-group m-form__group input-group">
                    <input type="text" class="form-control m-input" name="name" value="{{$position->name}}" placeholder="الاختصار">
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
