@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        إضافة بطولة جديدة
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <div class="tab-content">
                <div class="tab-pane active" id="info" role="tabpanel">
                    {!! Form::open(['method'=>'POST','files'=>true,'id'=>'league']) !!}
                    <div class="row">
                        <div class="col-md-3 order-md-2">
                            <div class="league-change-img">
                                <div class="user-img-wrap">
                                    <input type="file" class="hide" name="logo" style="display: none;"/>
                                    <img src="{{url('/')}}/assets/img/league.jpg"/>
                                    <a href="#" class="change-img"><i class="la la-image"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" placeholder="إسم البطولة"
                                       name="name">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="المدينة"
                                                class="form-control m-bootstrap-select m_selectpicker"
                                                name="city_id">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="نوع البطولة"
                                                class="form-control m-bootstrap-select m_selectpicker" name="type">
                                            <option value="tournament">دوري</option>
                                            <option value="cup">كأس</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ البداية" name="date_from" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ النهاية" name="date_to" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ نهاية التسجيل" name="registration_deadline"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input" placeholder="عدد الفرق"
                                               name="teams_no">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input"
                                               placeholder="اللاعبين الأساسيين" name="main_player_no">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input"
                                               placeholder="اللاعبين الاحتياطيين" name="reserved_player_no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="اشتراك البطولة"
                                                class="form-control m-bootstrap-select m_selectpicker payment-type"
                                                name="payment_type">
                                            <option value="paid">مدفوع</option>
                                            <option value="free">مجاني</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 league-price" style="display: none;">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input" placeholder="السعر"
                                               name="payment_cost">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group m-form__group input-group">
                                            <textarea class="form-control m-input" placeholder="الشروط والأحكام"
                                                      name="condition_text"
                                                      id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-form-save">
                        <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air save">
                            حفظ
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js"
                type="text/javascript"></script>
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/js/leagues.js" type="text/javascript"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37ZOdPlm3cYT3R0PXghW3nS56nZjd0So&callback=initialize"></script>

        <script>

            $('.payment-type').on('changed.bs.select', function (e) {
                if ($(this).val() == 'paid') {
                    $('.league-price').show();
                } else {
                    $('.league-price').hide();
                }
            });


            $(function () {

                $('body').on('click', '.list-group .list-group-item', function () {
                    $(this).toggleClass('active');
                });
                $('.list-arrows button').click(function () {
                    var $button = $(this), actives = '';
                    if ($button.hasClass('move-left')) {
                        actives = $('.list-right ul li.active');
                        actives.clone().appendTo('.list-left ul');
                        actives.remove();
                    } else if ($button.hasClass('move-right')) {
                        actives = $('.list-left ul li.active');
                        actives.clone().appendTo('.list-right ul');
                        actives.remove();
                    }
                });
                $('.dual-list .selector').click(function () {
                    var $checkBox = $(this);
                    if (!$checkBox.hasClass('selected')) {
                        $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
                        $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
                    } else {
                        $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
                        $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
                    }
                });
                $('[name="SearchDualList"]').keyup(function (e) {
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    if (code == '27') $(this).val(null);
                    var $rows = $(this).closest('.dual-list').find('.list-group li');
                    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
                    $rows.show().filter(function () {
                        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                        return !~text.indexOf(val);
                    }).hide();
                });

            });

        </script>


    @endpush
@stop
