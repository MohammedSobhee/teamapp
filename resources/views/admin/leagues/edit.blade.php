@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تعديل البطولة
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#info" role="tab">معلومات
                        البطولة</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#teams" role="tab">الفرق</a>
                </li>
                @if($league->type == 'tournament')
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link groups" data-toggle="tab" href="#groups"
                           role="tab">المجموعات</a>
                    </li>
                @endif
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#matches" role="tab">المباريات</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="info" role="tabpanel">
                    {!! Form::open(['method'=>'PUT','files'=>true,'id'=>'league']) !!}
                    <input type="hidden" name="league_id" id="league_id" value="{{$league->id}}">
                    <div class="row">
                        <div class="col-md-3 order-md-2">
                            <div class="league-change-img">
                                <div class="user-img-wrap">
                                    <input type="file" class="hide" name="logo" style="display: none;"/>
                                    <img src="{{$league->logo ?? url('assets/img/league.jpg')}}"/>
                                    <a href="#" class="change-img"><i class="la la-image"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group m-form__group input-group">
                                <input type="text" class="form-control m-input" placeholder="إسم البطولة"
                                       name="name" value="{{$league->name}}">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="المدينة"
                                                class="form-control m-bootstrap-select m_selectpicker"
                                                name="city_id">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}"
                                                        @if($league->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="نوع البطولة"
                                                class="form-control m-bootstrap-select m_selectpicker" name="type">
                                            <option value="tournament"
                                                    @if($league->type == 'tournament') selected @endif>دوري
                                            </option>
                                            <option value="cup" @if($league->type == 'cup') selected @endif>كأس</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ البداية" name="date_from" autocomplete="off"
                                               value="{{$league->date_from}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ النهاية" name="date_to" autocomplete="off"
                                               value="{{$league->date_to}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="text" class="form-control m_datepicker"
                                               placeholder="تاريخ نهاية التسجيل" name="registration_deadline"
                                               value="{{$league->registration_deadline}}"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input" placeholder="عدد الفرق"
                                               value="{{$league->teams_no}}"
                                               name="teams_no">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input"
                                               placeholder="اللاعبين الأساسيين" name="main_player_no"
                                               value="{{$league->main_player_no}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input"
                                               placeholder="اللاعبين الاحتياطيين" name="reserved_player_no"
                                               value="{{$league->reserved_player_no}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-form__group input-group">
                                        <select title="اشتراك البطولة"
                                                class="form-control m-bootstrap-select m_selectpicker payment-type"
                                                name="payment_type">
                                            <option value="paid" @if($league->payment_type == 'paid') selected @endif>
                                                مدفوع
                                            </option>
                                            <option value="free" @if($league->payment_type == 'free') selected @endif>
                                                مجاني
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 league-price"
                                     @if($league->payment_type == 'free') style="display: none;" @endif >
                                    <div class="form-group m-form__group input-group">
                                        <input type="number" class="form-control m-input" placeholder="السعر"
                                               value="{{$league->payment_cost}}"
                                               name="payment_cost">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group m-form__group input-group">
                                            <textarea class="form-control m-input" placeholder="الشروط والأحكام"
                                                      name="condition_text"
                                                      id="exampleTextarea"
                                                      rows="3">{{$league->condition_text}}</textarea>
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
                <div class="tab-pane" id="teams" role="tabpanel">

                    @if($league->status == 'new')
                        <div class="profile-form-save text-right" style="margin-bottom:20px;">
                            <a href="{{url(admin_leagues_url().'/add-team/'.$league->id)}}"
                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air add-league-team-mdl">
                                أضف جديد
                            </a>
                        </div>
                    @endif
                    <table class="m-datatable" id="league_teams_table" width="100%">
                    </table>
                </div>
                @if($league->type == 'tournament')
                    <div class="tab-pane" id="groups" role="tabpanel">
                        {!! Form::open(['method'=>'POST','url'=>url(admin_groups_url().'/create'),'files'=>true,'id'=>'group']) !!}
                        <input type="hidden" name="league_id" value="{{$league->id}}">

                        <div class="row groups">
                            @if(count($league_teams) != 0)
                                <div class="col-12 col-lg-6">
                                    <div class="add_group">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group m-form__group input-group">
                                                    <input type="text" class="form-control m-input" name="name"
                                                           placeholder="إسم المجموعة"
                                                           value="المجموعة {{$league->next_group}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group m-form__group input-group">
                                                    <input type="text" class="form-control m-input"
                                                           value="عدد الفرق المسموح اضافتها: (4)" disabled
                                                           placeholder="عدد الفرق">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="dual-list list-left col-md-6">
                                                <div class="well">
                                                    <ul class="teams-list-item list-group m-scrollable m-scroller"
                                                        data-scrollable="true" style="height: 200px">
                                                        @foreach($league_teams as $team)

                                                            <li class="list-group-item">{{$team->name}} <input
                                                                    type="hidden"
                                                                    name="teams_id[]"
                                                                    value="{{$team->id}}">
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="list-arrows col-md-1 text-center">
                                                <a href="javascript:;" class="btn btn-default btn-sm move-right">
                                                    <span class="fas fa-angle-left"></span>
                                                </a>
                                                <a href="javascript:;" class="btn btn-default btn-sm move-left">
                                                    <span class="fas fa-angle-right"></span>
                                                </a>
                                            </div>
                                            <div class="dual-list list-right col-md-5">
                                                <div class="well">
                                                    <ul class="teams-list-item list-group m-scrollable m-scroller"
                                                        data-scrollable="true" style="height: 200px">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-form-save" style="margin-top:15px;">
                                            <button type="submit"
                                                    class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air save">
                                                إضافة مجموعة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 col-lg-6">
                                <table
                                    class="table-center table-bordered table table-hover m-table m-table--head-separator-primary">
                                    <thead>
                                    <tr>
                                        <th>المجموعة</th>
                                        <th>الفريق الأول</th>
                                        <th>الفريق الثاني</th>
                                        <th>الفريق الثالث</th>
                                        <th>الفريق الرابع</th>
                                        <th>اعدادات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($league_groups as $league_group)
                                        <tr>
                                            <td>{{$league_group->name}}</td>
                                            @foreach($league_group->Teams as $team)
                                                <td>{{$team->name}}</td>
                                            @endforeach
                                            <td>
                                                {{--                                                <a href="#"--}}
                                                {{--                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"--}}
                                                {{--                                                   title="تعديل"><i class="la la-edit"></i></a>--}}
                                                <a href="{{url(admin_groups_url().'/league-group/'.$league_group->id)}}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete-group"
                                                   title="حذف"><i class="la la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endif
                <div class="tab-pane" id="matches" role="tabpanel">

                    @if(count($matches) > 0)
                        <div class="profile-form-save text-right" style="margin-bottom:20px;">
                            <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air"
                               data-toggle="modal" data-target="#m_modal_2">
                                أضف جديد
                            </a>
                        </div>
                    @endif
                    <div class="matches-wrap m-scrollable m-scroller" data-scrollable="true" style="height: 364px">

                        @foreach($matches as $match)
                            <div class="match-item">
                                <div class="match-leaque details">
                                    <span>الجولة {{trans('app.group.'.$match->level)}} - المجموعة {{$match->Group->name}}</span>
                                    <a href="{{url(admin_matches_url().'/edit/'.$match->id)}}"
                                       class="edit-left m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                       title="تعديل"><i class="la la-edit"></i></a>
                                </div>
                                <div class="match-card">
                                    <div class="team-item">
                                        <img src="{{$match->TeamOne->logo}}" width="100"/>
                                        <span>{{$match->TeamOne->name}}</span>
                                    </div>
                                    <span class="match-result">{{$match->team_one_result}}</span>
                                    <span class="match-result">{{$match->team_two_result}}</span>
                                    <div class="team-item">
                                        <img src="{{$match->TeamTwo->logo}}" width="100"/>
                                        <span>{{$match->TeamTwo->name}}</span>
                                    </div>
                                </div>
                                <div class="match-details">
                                    <div class="match-detailed-item">{{$match->City->name}}
                                        - {{\Illuminate\Support\Carbon::parse($match->match_date_time)->format('d/m/Y')}}
                                        - {{\Illuminate\Support\Carbon::parse($match->match_date_time)->format('H:i A')}}
                                    </div>
                                    <div class="match-detailed-item"> ملعب {{$match->Pitch->name ?? ' - '}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                $('.list-arrows a').click(function () {
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
