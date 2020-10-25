@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تعديل الملعب
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            {!! Form::open(['method'=>'PUT','url'=>url(admin_pitches_url().'/'.$pitch->id.'/edit'),'files'=>true,'id'=>'form']) !!}

            <input type="hidden" name="latitude" id="latitude"
                   value="{{$pitch->latitude ?? ''}}">
            <input type="hidden" name="longitude" id="longitude"
                   value="{{$pitch->longitude ?? ''}}">
            <input type="hidden" name="address" id="address"
                   value="{{$pitch->address ?? ''}}">


            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="form-group m-form__group input-group">
                        <input type="text" class="form-control m-input" name="name" value="{{$pitch->name}}"
                               placeholder="إسم الملعب">
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="owner_id">
                            <option selected disabled>مالك الملعب</option>
                            @foreach($pitch_owners as $owner)
                                <option value="{{$owner->id}}"
                                        @if($pitch->owner_id == $owner->id) selected @endif>{{$owner->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="city_id">
                            <option selected disabled>المدينة</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}"
                                        @if($pitch->city_id == $city->id) selected @endif>{{$city->name}}</option>
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
                        @foreach($pitch->sizes as $size)
                            <div class="tag-input-item">
                                <input type="hidden" name="size[]" value="{{$size->type}}">
                                <a href="#" class="remove-tag"><i
                                        class="fas fa-times"></i></a><span>{{$size->type}}</span>
                            </div>
                        @endforeach
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
                                <?php $index = 0;?>
                                @foreach($schedules as $key=> $schedule)
                                    @if($original[$index] == $key)
                                        <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" class="time"
                                                   value="{{$key}}">
									        <span></span>
										</label>
									</span>
                                            @foreach($schedule as $s)
                                                <div class="time-items">
                                                    <input type="text" class="form-control timepicker"
                                                           name="from[{{$key}}][]"
                                                           placeholder="من" value="{{$s->from}}"/> -
                                                    <input
                                                        class="form-control timepicker" type="text"
                                                        name="to[{{$key}}][]"
                                                        placeholder="الى" value="{{$s->to}}"/>
                                                </div>
                                            @endforeach
                                            <div class="add-new-time">
                                                <a href="#"><i class="fas fa-plus-square"></i></a>
                                            </div>
                                        </td>
                                    @else
                                        <td>
									<span class="m-switch m-switch--icon m-switch--success m-switch--sm">
                                        <label>
											<input type="checkbox" checked="checked" name="is_schedule[]" class="time"
                                                   value="{{$original[$index]}}">
									        <span></span>
										</label>
									</span>
                                            <div class="time-items">
                                                <input type="text" class="form-control timepicker"
                                                       name="from[{{$original[$index]}}][]"
                                                       placeholder="من" value="-"/> -
                                                <input
                                                    class="form-control timepicker" type="text"
                                                    name="to[{{$original[$index]}}][]"
                                                    placeholder="الى" value="-"/>
                                            </div>
                                            <div class="add-new-time">
                                                <a href="#"><i class="fas fa-plus-square"></i></a>
                                            </div>
                                        </td>
                                    @endif
                                    <?php $index++?>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <select title="الخدمات" multiple class="form-control m-bootstrap-select m_selectpicker"
                                name="services[]">
                            @foreach($services as $service)
                                <option value="{{$service->id}}"
                                        @if(in_array($service->id,$pitch->Services->pluck('id')->toArray())) selected
                                        @endif
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
                                       value="{{$pitch->cost_hour ?? ''}}"
                                       placeholder="السعر / الساعة">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" name="discount"
                                       value="{{$pitch->discount ?? ''}}"
                                       placeholder="مبلغ الخصم">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group input-group">
                            <textarea class="form-control m-input" name="description" rows="10" id="exampleTextarea"
                                      rows="3"
                                      placeholder="الوصف">{{$pitch->description ?? ''}}</textarea>
                    </div>
                    <div class="form-group m-form__group input-group">
                        <input type="file" multiple class="hide" id="pitch-imgs"
                               style="display: none;"/>
                        <a href="#" class="pitch-imgs-anchor btn btn-primary">
                            <span>تحميل صور الملعب</span>
                        </a>
                        <div class="imgs-preview">
                            @foreach($pitch->images as $image)
                                <div class='item'><a href='#'><i class='fas fa-times'></i></a><img
                                        src='{{$image->image}}'>
                                </div>
                            @endforeach
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
