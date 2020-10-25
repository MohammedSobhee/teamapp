@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        اضافة ملعب جديد
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['method'=>'POST','url'=>url(admin_pitches_url().'/create'),'files'=>true,'id'=>'form']) !!}

            <input type="hidden" name="latitude" id="latitude"
                   value="24.4477752">
            <input type="hidden" name="longitude" id="longitude"
                   value="47.4547187">
            <input type="hidden" name="address" id="address"
                   value="الرياض">


            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="form-group m-form__group input-group">
                        <input type="text" class="form-control m-input" name="name" placeholder="إسم الملعب">
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="owner_id">
                            <option selected disabled>مالك الملعب</option>
                            @foreach($pitch_owners as $owner)
                                <option value="{{$owner->id}}">{{$owner->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="city_id">
                            <option selected disabled>المدينة</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="مساحة الملعب / الملاعب"
                               aria-describedby="basic-addon1">
                        <div class="input-group-append"><a href="#" class="input-group-text new-size"
                                                           id="basic-addon1">+</a></div>
                    </div>
                    <div class="sizes-tags-input">
                        {{--                        <div class="tag-input-item">--}}
                        {{--                                <a href="#" class="remove-tag"><i class="fas fa-times"></i></a><span>50*50</span>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="form-group m-form__group input-group">
                        <label style="font-weight: 500;font-size: 15px;margin:8px 0 5px">أيام العمل</label>
                        <table
                            class="times-table table m-table m-table--head-separator-primary table-center table-bordered">
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
											<input type="checkbox" checked="checked" name="is_schedule[]" class="time"
                                                   value="sat">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[sat][]"
                                               placeholder="من"/> -
                                        <input
                                            class="form-control timepicker" type="text" name="to[sat][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="sun">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[sun][]"
                                               placeholder="من"/> -
                                        <input
                                            class="form-control timepicker" type="text" name="to[sun][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="mon">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[mon][]"
                                               placeholder="من"/> - <input
                                            class="form-control timepicker" type="text" name="to[mon][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="tue">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[tue][]"
                                               placeholder="من"/> - <input
                                            class="form-control timepicker" type="text" name="to[tue][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="wed">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[wed][]"
                                               placeholder="من"/> - <input
                                            class="form-control timepicker" type="text" name="to[wed][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="thur">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[thur][]"
                                               placeholder="من"/> - <input
                                            class="form-control timepicker" type="text" name="to[thur][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                                <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" value="fri">
									        <span></span>
										</label>
									</span>
                                    <div class="time-items">
                                        <input type="text" class="form-control timepicker" name="from[fri][]"
                                               placeholder="من"/> - <input
                                            class="form-control timepicker" type="text" name="to[fri][]"
                                            placeholder="الى"/>
                                    </div>
                                    <div class="add-new-time">
                                        <a href="#"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select title="الخدمات" multiple class="form-control m-bootstrap-select m_selectpicker"
                                name="services[]">
                            @foreach($services as $service)
                                <option value="{{$service->id}}"
                                        data-thumbnail="{{$service->icon ?? ''}}">
                                    {{$service->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" name="cost_hour"
                                       placeholder="السعر / الساعة">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" name="discount"
                                       placeholder="مبلغ الخصم">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group input-group">
                            <textarea class="form-control m-input" name="description" id="exampleTextarea" rows="3"
                                      placeholder="الوصف"></textarea>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <input type="file" multiple class="hide" id="pitch-imgs"
                               style="display: none;"/>
                        <a href="#" class="pitch-imgs-anchor btn btn-primary">
                            <span>تحميل صور الملعب</span>
                        </a>
                        <div class="imgs-preview">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="google-map" style="margin-top:20px;height:400px;" id="map_canvas"></div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <span>حفظ</span>
                </button>
                <a href="{{url(admin_pitches_url().'/list')}}" class="btn btn-metal">
                    <span>الغاء</span>
                </a>
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
        <script src="{{url('/')}}/assets/js/pitches.js" type="text/javascript"></script>

        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en&key={{google_api_key()}}&callback=initialize"></script>

        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js"
                type="text/javascript"></script>

        <script>
            $(".timepicker").timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: false,
                snapToStep: true,
                timeFormat: 'h:mm p',
            })
        </script>
    @endpush
@stop
