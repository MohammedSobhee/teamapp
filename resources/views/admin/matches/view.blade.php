@extends(admin_layout_vw().'.index')

@section('content')

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
                <a href="{{url(admin_matches_url().'/edit/'.$match->id)}}"
                   class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-edit"></i>
											<span>تعديل</span>
										</span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="match-item">
                <div class="match-leaque">
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
                    <span class="match-result">{{$match->team_one_result}}</span>
                    <span class="match-result">{{$match->team_two_result}}</span>
                    <div class="team-item">
                        <a href="{{url(admin_teams_url().'/view/'.$match->team_two_id)}}"
                           target="_blank">
                        <img src="{{$match->TeamTwo->logo}}" width="100"/>
                        <span>{{$match->TeamTwo->name}}</span>
                        </a>
                    </div>
                </div>
                <div class="match-details">
                    <div class="match-detailed-item">{{$match->city_name}} - {{$match->match_date_time}}</div>
                    <div class="match-detailed-item"> ملعب {{$match->Pitch->name ?? '-'}}  </div>
                </div>
            </div>
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
                    <div class="m-timeline-1 m-timeline-1--fixed">
                        <div class="m-timeline-1__items">
                            <div class="m-timeline-1__marker"></div>
                            @foreach($timeline as $tline)
                                <div
                                    class="m-timeline-1__item @if($tline->team_id == $match->team_one_id) m-timeline-1__item--left @else m-timeline-1__item--right @endif">
                                    <div class="m-timeline-1__item-circle">
                                        <div class="m--bg-danger">{{$tline->track_time}}</div>
                                    </div>
                                    <div class="m-timeline-1__item-content">
                                        {!! $tline->icon !!}
                                        @if($tline->track_type == 'substitution')
                                            <span>{{$tline->player->full_name}} - {{$tline->substituted_player->full_name}}</span>
                                        @else
                                            <span>{{$tline->player->full_name}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            {{--                            <div class="m-timeline-1__item m-timeline-1__item--right">--}}
                            {{--                                <div class="m-timeline-1__item-circle">--}}
                            {{--                                    <div class="m--bg-danger">2</div>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="m-timeline-1__item-arrow"></div>--}}
                            {{--                                <div class="m-timeline-1__item-content">--}}
                            {{--                                    <i class="icon-football"></i>--}}
                            {{--                                    <span>محمد أحمد</span>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="players" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="players-list">
                                <div class="m-widget4">
                                    @foreach($match->TeamOne->LeaguePlayers as $player)
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--logo" style="padding-left:8px;">
                                                {{$player->pivot->player_no}}
                                            </div>
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
                                                                    class="m-widget4__number m--font-brand">{{$player->primer_position}}</span>
															</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="players-list">
                                <div class="m-widget4">
                                    @foreach($match->TeamTwo->LeaguePlayers as $player)
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--logo" style="padding-left:8px;">
                                                {{$player->pivot->player_no}}
                                            </div>
                                            <div class="m-widget4__img m-widget4__img--logo">
                                                <img
                                                    src="{{$player->image100 ?? url('assets/img/placeholder-user.png')}}"
                                                    alt="">
                                            </div>
                                            <div class="m-widget4__info">
																<span class="m-widget4__title">
<a href="{{url(admin_users_url().'/edit/'.$player->id)}}"
   target="_blank">{{$player->full_name}}</a>																</span>
                                            </div>
                                            <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand">{{$player->primer_position}}</span>
															</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
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

        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
    @endpush
@stop
