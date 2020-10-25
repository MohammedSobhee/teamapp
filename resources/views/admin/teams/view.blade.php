@extends(admin_layout_vw().'.index')

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        فريق {{$team->name}}
                    </h3>
                </div>
            </div>
            {{--            <div class="m-portlet__head-tools">--}}
            {{--                <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">--}}
            {{--										<span>--}}
            {{--											<i class="fas fa-edit"></i>--}}
            {{--											<span>تعديل</span>--}}
            {{--										</span>--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-12 col-xl-7">
                    <div class="team-details-wrap ">
                        <img src="{{$team->logo ?? url('assets/img/unknown.jpg')}}" class="rounded-circle"/>
                        <div class="team-details">
                            <span class="city">جدة</span>
                            <span class="players-no">عدد اللاعبين: {{$team->player_num}}</span>
                        </div>
                        <div class="team-managers">
                            @if(isset($team->coach))
                                <div class="team-person">
                                    <a href="{{url(admin_users_url().'/edit/'.$team->coach->id)}}" target="_blank">

                                        <img src="{{$team->coach->image}}"/>
                                        <span>{{$team->coach->full_name}}</span>
                                    </a>
                                </div>
                            @endif
                            @if(isset($team->captain))
                                <div class="team-person">
                                    <a href="{{url(admin_users_url().'/edit/'.$team->captain->id)}}" target="_blank">

                                        <img src="{{$team->captain->image}}"/>
                                        <span>{{$team->captain->full_name}}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="team-details-wrap">
                        <div class="details-item">
                            <span>البطولات المشارك بها</span>
                            <span>{{$team->leagues_num}}</span>
                        </div>
                        <div class="details-item">
                            <span>البطولات الفائز بها</span>
                            <span>{{$team->league_wins}}</span>
                        </div>
                        <div class="details-item">
                            <span>المباريات الملعوبة</span>
                            <span>{{$team->match_wins}}</span>
                        </div>
                        <div class="details-item">
                            <span>الأهداف المسجلة</span>
                            <span>0</span>
                        </div>
                        <div class="details-item">
                            <span>الأهداف المستقبلة</span>
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                قائمة اللاعبين ({{count($team->players)}})
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget4 m-scrollable m-scroller" data-scrollable="true" style="height: 430px">
                        @foreach($team->players as $player)
                            <a href="{{url(admin_users_url().'/edit/'.$player->id)}}" target="_blank">
                                <div class="m-widget4__item">
                                    <div class="">
                                        {{--                                    m-widget4__img m-widget4__img--logo--}}
                                        <img src="{{$player->image}}" alt="" class="rounded-circle">
                                    </div>
                                    <div class="m-widget4__info">
													<span class="m-widget4__title">
														{{$player->full_name}}
													</span>
                                    </div>
                                    <span class="m-widget4__ext">
													<span
                                                        class="m-widget4__number m--font-brand">{{$player->primer_position}}</span>
												</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                المباريات
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#upcoming" role="tab">القادمة</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#completed" role="tab">السابقة</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="upcoming" role="tabpanel">
                            <div class="matches-wrap m-scrollable m-scroller" data-scrollable="true"
                                 style="height: 364px">
                                @foreach($matches_coming as $match)
                                    <div class="match-item">
                                        <div class="match-leaque">{{$match->league_name}}</div>
                                        <div class="match-card">
                                            <a href="#">
                                                <div class="team-item">
                                                    <img src="{{$match->TeamOne->logo}}" width="100"/>
                                                    <span>{{$match->TeamOne->name}}</span>
                                                </div>
                                                <span class="match-result"></span>
                                                <span class="match-result"></span>
                                                <div class="team-item">
                                                    <img src="{{$match->TeamTwo->logo}}" width="100"/>
                                                    <span>{{$match->TeamTwo->name}}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="match-details">
                                            <div class="match-detailed-item">{{$match->match_date}}</div>
                                            <div class="match-detailed-item">ملعب {{$match->Pitch->name ?? '-'}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="completed" role="tabpanel">
                            <div class="matches-wrap m-scrollable m-scroller" data-scrollable="true"
                                 style="height: 364px">
                                @foreach($matches_end as $match)
                                    <div class="match-item">
                                        <div class="match-leaque">{{$match->league_name}}</div>
                                        <div class="match-card">
                                            <a href="#">
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
                                            </a>
                                        </div>
                                        <div class="match-details">
                                            <div class="match-detailed-item">{{$match->match_date}}</div>
                                            <div class="match-detailed-item">ملعب {{$match->Pitch->name ?? '-'}}</div>
                                        </div>
                                    </div>
                                @endforeach
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
        <script src="{{url('/')}}/assets/custom.js" type="text/javascript"></script>
    @endpush
@stop
