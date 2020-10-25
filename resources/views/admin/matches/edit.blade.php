@extends(admin_layout_vw().'.index')

@section('content')

    {!! Form::open(['method'=>'put','url'=>url(admin_matches_url().'/edit/'.$match->id),'id'=>'save-match']) !!}
    <input type="hidden" name="type" value="{{$match->type}}">
    <input type="hidden" name="team_one_id" value="{{$match->team_one_id}}">
    <input type="hidden" name="team_two_id" value="{{$match->team_two_id}}">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        بطاقة المباراة
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="javascript:;"
                   class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air save-match">
										<span>
											<i class="fas fa-check"></i>
											<span>حفظ البيانات</span>
										</span>
                </a>

                @if($match->status == 'new')
                    <a href="{{url(admin_matches_url() . '/change-status/' . $match->id) }}"
                       class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air status_out">
										<span>
											<i class="fas fa-check"></i>
											<span>أبدأ المباراة</span>
										</span>

                    </a>
                @elseif($match->status == 'current')
                    <a href="{{url(admin_matches_url() . '/change-status/' . $match->id) }}"
                       class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air status_out">
										<span>
											<i class="fas fa-times"></i>
											<span>انهاء المباراة</span>
										</span>

                    </a>
                @endif
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="match-item">
                <div class="match-leaque">

                    {{--                                        <input class="form-control" type="text" disabled--}}
                    {{--                                                                     value="الجولة {{trans('app.group.'.$match->level)}} - المجموعة {{$match->Group->name}}"/>--}}
                    <span>الجولة {{trans('app.group.'.$match->level)}} - المجموعة {{$match->Group->name}}</span>

                </div>
                <div class="match-card">
                    <div class="team-item">
                        <a href="{{url(admin_teams_url().'/view/'.$match->team_one_id)}}"
                           target="_blank">
                            <img src="{{$match->TeamOne->logo}}" width="100"/>
                            <span>{{$match->TeamOne->name}}</span>
                        </a>
                    </div>
                    <span class="match-result"><input class="form-control" type="text" name="team_one_result"
                                                      value="{{$match->team_one_result}}"/></span>
                    <span class="match-result"><input class="form-control" type="text" name="team_two_result"
                                                      value="{{$match->team_two_result}}"/></span>
                    <div class="team-item">
                        <a href="{{url(admin_teams_url().'/view/'.$match->team_two_id)}}"
                           target="_blank">
                            <img src="{{$match->TeamTwo->logo}}" width="100"/>
                            <span>{{$match->TeamTwo->name}}</span>
                        </a>
                    </div>
                </div>
                {{--                <div class="match-details">--}}
                {{--                    <div class="match-detailed-item"><input class="form-control" type="text"--}}
                {{--                                                            value="جدة - 25/05/2019 الساعة 10:00 صباحاً"/></div>--}}
                {{--                    <div class="match-detailed-item"><input class="form-control" type="text" value="ملعب الكامب نو"/>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="match-details">
                    <div class="match-detailed-item">

                        <div class="row">
                            <div class="col-6">
                                <select title="المدينة"
                                        class="form-control m-bootstrap-select m_selectpicker"
                                        name="city_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"
                                                @if($city->id == $match->city_id) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">

                                <input class="form-control" name="match_date_time" id="m_datetimepicker_1" type="text"
                                       value="{{$match->match_date_time}}"/>

                            </div>
                        </div>
                    </div>
                    {{--                    <div class="match-detailed-item"> ملعب {{$match->Pitch->name}}</div>--}}
                    <div class="match-detailed-item">
                        <select title="اسم الملعب"
                                class="form-control m-bootstrap-select m_selectpicker" name="pitch_id">
                            @foreach($pitches as $pitch)
                                <option value="{{$pitch->id}}"
                                        @if($pitch->id == $match->pitch_id) selected @endif>{{$pitch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @if($match->status == 'current')
                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#timeline" role="tab">تفاصيل
                            المباراة</a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#players" role="tab">قائمة اللاعبين</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="timeline" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="actions-wrapper">
                                    <div class="team-actions">
                                        <div class="team-actions-name">
                                            <a href="{{url(admin_teams_url().'/view/'.$match->team_one_id)}}">
                                                <img src="{{$match->TeamOne->logo}}" width="30"/>
                                                <span>{{$match->TeamOne->name}}</span>
                                            </a>
                                        </div>
                                        <div class="actions-players-list">
                                            @foreach($match->TeamOne->LeaguePlayers as $player)
                                                <div class="player-action-wrap">
                                                    <div class="player-card">

                                                        <input type="hidden" name="team" class="team"
                                                               value="{{$match->team_one_id}}">
                                                        <input type="hidden"
                                                               name="match"
                                                               class="match"
                                                               value="{{$match->id}}">
                                                        <img
                                                            src="{{$player->image100 ?? url('assets/img/placeholder-user.png')}}"/>
                                                        <span><a href="{{url(admin_users_url().'/edit/'.$player->id)}}"
                                                                 target="_blank">{{$player->full_name}}</a></span>
                                                        <input type="hidden" name="player" class="player"
                                                               value="{{$player->id}}">
                                                        <a href="#" class="action" data-item="1"><i
                                                                class="la la-plus"></i></a>
                                                    </div>
                                                    @foreach($player->TimeLine as $record)
                                                        @if($record->match_id == $match->id && $match->team_one_id == $record->team_id)
                                                            <div class="action-item-wrapper">
                                                                <a href="#" class="saveAction"><i
                                                                        class="la la-check"></i></a>
                                                                <a href="#" class="removeAction"
                                                                   data-id="{{$record->id}}"><i
                                                                        class="la la-remove"></i></a>
                                                                <select title="اختر الحدث"
                                                                        class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-one"
                                                                        name="actionOne[]">
                                                                    <option value="goal"
                                                                            @if($record->track_type == 'goal') selected @endif>
                                                                        هدف جديد
                                                                    </option>
                                                                    <option value="penalty_kick"
                                                                            @if($record->track_type == 'penalty_kick') selected @endif>
                                                                        ضربة جزاء
                                                                    </option>
                                                                    <option value="penalty_lose"
                                                                            @if($record->track_type == 'penalty_lose') selected @endif>
                                                                        ضربة جزاء ضائعة
                                                                    </option>
                                                                    <option value="red_card"
                                                                            @if($record->track_type == 'red_card') selected @endif>
                                                                        انذار احمر
                                                                    </option>
                                                                    <option value="yellow_card"
                                                                            @if($record->track_type == 'yellow_card') selected @endif>
                                                                        انذار اصفر
                                                                    </option>
                                                                    <option value="substitution"
                                                                            @if($record->track_type == 'substitution') selected @endif>
                                                                        تبديل
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control time"
                                                                       placeholder="الوقت"
                                                                       name="timeOne[]"
                                                                       value="{{$record->track_time}}"/>

                                                                @if($record->track_type == 'substitution' && isset($record->substituted_player_id))
                                                                    <div class="players-list-select-team-one">
                                                                        <select title="اختر اللاعب"
                                                                                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                                                                                name="playerOne[]">
                                                                            @foreach($match->TeamOne->Players as $player)
                                                                                <option
                                                                                    value="{{$player->id}}"
                                                                                    @if($record->substituted_player_id == $player->id) selected @endif> {{$player->full_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="team-actions">
                                        <div class="team-actions-name">
                                            <a href="{{url(admin_teams_url().'/view/'.$match->team_two_id)}}"
                                               target="_blank">

                                                <img src="{{$match->TeamTwo->logo}}" width="30"/>
                                                <span>{{$match->TeamTwo->name}}</span>
                                            </a>
                                        </div>
                                        <div class="actions-players-list">
                                            @foreach($match->TeamTwo->LeaguePlayers as $player)
                                                <div class="player-action-wrap">
                                                    <div class="player-card">
                                                        <input type="hidden" name="team" class="team"
                                                               value="{{$match->team_two_id}}">
                                                        <input type="hidden"
                                                               name="match"
                                                               class="match"
                                                               value="{{$match->id}}">
                                                        <img
                                                            src="{{$player->image100 ?? url('assets/img/placeholder-user.png')}}"/>
                                                        <span><a href="{{url(admin_users_url().'/edit/'.$player->id)}}"
                                                                 target="_blank">{{$player->full_name}}</a></span>
                                                        <input type="hidden" name="player" class="player"
                                                               value="{{$player->id}}">
                                                        <a href="#" class="action" data-item="2"><i
                                                                class="la la-plus"></i></a>
                                                    </div>
                                                    @foreach($player->TimeLine as $record)
                                                        @if($record->match_id == $match->id && $match->team_two_id == $record->team_id)
                                                            <div class="action-item-wrapper">
                                                                <a href="#" class="saveAction"><i
                                                                        class="la la-check"></i></a>
                                                                <a href="#" class="removeAction"
                                                                   data-id="{{$record->id}}"><i
                                                                        class="la la-remove"></i></a>
                                                                <select title="اختر الحدث"
                                                                        class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-one"
                                                                        name="actionOne[]">
                                                                    <option value="goal"
                                                                            @if($record->track_type == 'goal') selected @endif>
                                                                        هدف جديد
                                                                    </option>
                                                                    <option value="penalty_kick"
                                                                            @if($record->track_type == 'penalty_kick') selected @endif>
                                                                        ضربة جزاء
                                                                    </option>
                                                                    <option value="penalty_lose"
                                                                            @if($record->track_type == 'penalty_lose') selected @endif>
                                                                        ضربة جزاء ضائعة
                                                                    </option>
                                                                    <option value="red_card"
                                                                            @if($record->track_type == 'red_card') selected @endif>
                                                                        انذار احمر
                                                                    </option>
                                                                    <option value="yellow_card"
                                                                            @if($record->track_type == 'yellow_card') selected @endif>
                                                                        انذار اصفر
                                                                    </option>
                                                                    <option value="substitution"
                                                                            @if($record->track_type == 'substitution') selected @endif>
                                                                        تبديل
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control time"
                                                                       placeholder="الوقت"
                                                                       name="timeOne[]"
                                                                       value="{{$record->track_time}}"/>

                                                                @if($record->track_type == 'substitution' && isset($record->substituted_player_id))
                                                                    <div class="players-list-select-team-one">
                                                                        <select title="اختر اللاعب"
                                                                                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                                                                                name="playerOne[]">
                                                                            @foreach($match->TeamTwo->Players as $player)
                                                                                <option
                                                                                    value="{{$player->id}}"
                                                                                    @if($record->substituted_player_id == $player->id) selected @endif> {{$player->full_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="players" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="players-list">
                                    <div class="team-actions-name">
                                        <a href="{{url(admin_teams_url().'/view/'.$match->team_one_id)}}"
                                           target="_blank">
                                            <img src="{{$match->TeamOne->logo}}" width="30"/>
                                            <span>{{$match->TeamOne->name}}</span>
                                        </a>
                                    </div>
                                    <div class="main-secondary">اللاعبين الأساسيين</div>
                                    <div class="m-widget4">
                                        @foreach($match->TeamOne->LeaguePlayers as $player)
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--logo">
                                                    <img
                                                        src="{{$player->image100 ?? url('assets/img/placeholder-user.png')}}"
                                                        alt="">
                                                </div>
                                                <div class="m-widget4__info">
																<span class="m-widget4__title">
<a href="{{url(admin_users_url().'/edit/'.$player->id)}}"
   target="_blank">{{$player->full_name}}</a>
																</span>
                                                </div>
                                                <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand">{{$player->pivot->player_no}}</span>
															</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="players-list">
                                    <div class="team-actions-name">
                                        <a href="{{url(admin_teams_url().'/view/'.$match->team_two_id)}}"
                                           target="_blank">

                                            <img src="{{$match->TeamTwo->logo}}" width="30"/>
                                            <span>{{$match->TeamTwo->name}}</span>
                                        </a>
                                    </div>
                                    <div class="main-secondary">اللاعبين الأساسيين</div>
                                    <div class="m-widget4">
                                        @foreach($match->TeamTwo->LeaguePlayers as $player)
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--logo">
                                                    <img
                                                        src="{{$player->image100 ?? url('assets/img/placeholder-user.png')}}"
                                                        alt="">
                                                </div>
                                                <div class="m-widget4__info">
																<span class="m-widget4__title">
                                                                    <a href="{{url(admin_users_url().'/edit/'.$player->id)}}"
                                                                       target="_blank">
                                                                        {{$player->full_name}}</a>
																</span>
                                                </div>
                                                <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand">{{$player->pivot->player_no}}</span>
															</span>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="players-list-select-team-one" style="display: none;">
        <select title="اختر اللاعب"
                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                name="playerOne[]">
            @foreach($match->TeamOne->Players as $player)
                <option value="{{$player->id}}"> {{$player->full_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="players-list-select-team-two" style="display: none;">
        <select title="اختر اللاعب"
                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                name="playerOne[]">
            @foreach($match->TeamTwo->Players as $player)
                <option value="{{$player->id}}"> {{$player->full_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="actions-list-select-team-one" style="display: none;">
        <select title="اختر الحدث"
                class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-one"
                name="actionOne[]">
            <option value="goal"> هدف جديد</option>
            <option value="penalty_kick"> ضربة جزاء</option>
            <option value="penalty_lose">ضربة جزاء ضائعة</option>
            <option value="red_card">انذار احمر</option>
            <option value="yellow_card">انذار اصفر</option>
            <option value="substitution">تبديل</option>
        </select>
    </div>
    <div class="actions-list-select-team-two" style="display: none;">
        <select title="اختر الحدث"
                class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-two"
                name="actionOne[]">
            <option value="goal"> هدف جديد</option>
            <option value="penalty_kick"> ضربة جزاء</option>
            <option value="penalty_lose">ضربة جزاء ضائعة</option>
            <option value="red_card">انذار احمر</option>
            <option value="yellow_card">انذار اصفر</option>
            <option value="substitution">تبديل</option>
        </select>
    </div>
    {!! Form::close() !!}
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
        <script src="{{url('/')}}/assets/js/matches.js" type="text/javascript"></script>


        <script>
        var $playersListOne = $('.players-list-select-team-one').html();
        var $playersListTwo = $('.players-list-select-team-two').html();
        var $actionsListOne = $('.actions-list-select-team-one').html();
        var $actionsListTwo = $('.actions-list-select-team-two').html();

        var $htmlOne = '<div class="action-item-wrapper">' +
            '<a href="#" class="saveAction"><i class="la la-check"></i></a>' +
            '<a href="#" class="removeAction" data-id=""><i class="la la-remove"></i></a>' +
            $actionsListOne +
            '<input type="text" class="form-control time" placeholder="الوقت"  name="timeOne[]"/> ' +
            '</div>';
        var $htmlTwo = '<div class="action-item-wrapper">' +
            '<a href="#" class="saveAction"><i class="la la-check"></i></a>' +
            '<a href="#" class="removeAction"  data-id=""><i class="la la-remove"></i></a>' +
            $actionsListTwo +
            '<input type="text" class="form-control time" placeholder="الوقت"  name="timeTwo[]"/> ' +
            '</div>';

        var $html;
        $(document).on('click', '.player-card .action', function (e) {
            e.preventDefault();

            var order = $(this).data('item');
            if (order == 1) {
                $html = $htmlOne;
            } else {
                $html = $htmlTwo;
            }
            $(this).closest('.player-action-wrap').append($html);
            $('.m_selectpicker').selectpicker();
        });
        $(document).on('click', '.removeAction', function (e) {
            e.preventDefault();

            var recordId = $(this).attr('data-id')
            if (recordId != undefined && recordId != '' && recordId != null) {
                $.ajax({
                    url: baseURL + '/matches/record/' + recordId,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: csrf_token
                    },
                    success: function (data) {

                        if (data.status) {
                            toastr.success(data.message);
                            $(this).closest('.action-item-wrapper').remove();
                        } else {
                            toastr.error(data.message);
                        }
                    }, error: function (xhr) {

                    }
                });

            } else
                $(this).closest('.action-item-wrapper').remove();


        });
        $(document).on('change', '.actions-list-select-picker-team-one', function (e) {

            if ($(this).val() == 'substitution') {
                $(this).closest('.action-item-wrapper').append($playersListOne);
                $('.m_selectpicker').selectpicker();
                return;

            }
        });
        $(document).on('change', '.actions-list-select-picker-team-two', function (e) {

            if ($(this).val() == 'substitution') {
                $(this).closest('.action-item-wrapper').append($playersListTwo);
                $('.m_selectpicker').selectpicker();
                return;
            }
        });


        </script>

    @endpush
@stop
