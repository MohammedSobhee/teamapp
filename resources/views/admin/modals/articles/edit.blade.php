<div class="modal fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'PUT','url'=>url(admin_articles_url().'/'.$post->id.'/edit')]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">تعديل المقالة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group input-group">
                    <input type="text" class="form-control m-input" name="title" placeholder="العنوان"
                           value="{{$post->title}}">
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="form-group m-form__group input-group">
                            <select class="form-control m-bootstrap-select m_selectpicker media_type" name="media_type">
                                <option disabled>اختر نوع المرفق</option>
                                <option value="image" @if($post->media_type == 'image') selected @endif>صورة</option>
                                <option value="video" @if($post->media_type == 'video') selected @endif>رابط فيديو
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 media_image" @if($post->media_type != 'image')  style="display: none" @endif>
                        <div class="form-group m-form__group input-group custom-file">
                            <input type="file" name="media_image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">اختر صورة المقال</label>
                        </div>
                    </div>
                    <div class="col-6 media_video" @if($post->media_type != 'video')  style="display: none" @endif>
                        <div class="form-group m-form__group input-group">
                            <input type="text" class="form-control m-input" placeholder="رابط الفيديو"
                                   name="media_video" value="{{$post->media}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group m-form__group input-group">
                            <input type="text" class="form-control" id="m_datepicker_1" name="published_date"
                                   autocomplete="off"
                                   placeholder="تاريخ المقال" value="{{$post->published_date}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group m-form__group input-group">
										<span class="m-switch m-switch--icon m-switch--primary">
											<label>
												<input type="checkbox" @if($post->is_active)  checked="checked"
                                                       @endif name="is_active">
												<span></span>
											</label>
										</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group m-form__group input-group">
                            <textarea class="form-control" id="detail" name="detail" rows="5"
                                      placeholder="محتوى المقالة">{{$post->detail}}</textarea>
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
<script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
        type="text/javascript"></script>

<script>
    $(document).ready(function () {
        // select-type .m_selectpicker
        $(document).on('change', '.media_type .m_selectpicker', function () {

            if ($(this).val() == 'image') {
                $('.media_image').show()
                $('.media_video').hide()
            } else {
                $('.media_image').hide()
                $('.media_video').show()
            }
        });
    });
</script>
