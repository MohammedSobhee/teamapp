<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['method'=>'put','url'=>url(admin_matches_url().'/edit/'.$match->id),'id'=>'save-match']); ?>

    <input type="hidden" name="type" value="<?php echo e($match->type); ?>">
    <input type="hidden" name="team_one_id" value="<?php echo e($match->team_one_id); ?>">
    <input type="hidden" name="team_two_id" value="<?php echo e($match->team_two_id); ?>">
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

                <?php if($match->status == 'new'): ?>
                    <a href="<?php echo e(url(admin_matches_url() . '/change-status/' . $match->id)); ?>"
                       class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air status_out">
										<span>
											<i class="fas fa-check"></i>
											<span>أبدأ المباراة</span>
										</span>

                    </a>
                <?php elseif($match->status == 'current'): ?>
                    <a href="<?php echo e(url(admin_matches_url() . '/change-status/' . $match->id)); ?>"
                       class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air status_out">
										<span>
											<i class="fas fa-times"></i>
											<span>انهاء المباراة</span>
										</span>

                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="match-item">
                <div class="match-leaque">

                    
                    
                    <span>الجولة <?php echo e(trans('app.group.'.$match->level)); ?> - المجموعة <?php echo e($match->Group->name); ?></span>

                </div>
                <div class="match-card">
                    <div class="team-item">
                        <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_one_id)); ?>"
                           target="_blank">
                            <img src="<?php echo e($match->TeamOne->logo); ?>" width="100"/>
                            <span><?php echo e($match->TeamOne->name); ?></span>
                        </a>
                    </div>
                    <span class="match-result"><input class="form-control" type="text" name="team_one_result"
                                                      value="<?php echo e($match->team_one_result); ?>"/></span>
                    <span class="match-result"><input class="form-control" type="text" name="team_two_result"
                                                      value="<?php echo e($match->team_two_result); ?>"/></span>
                    <div class="team-item">
                        <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_two_id)); ?>"
                           target="_blank">
                            <img src="<?php echo e($match->TeamTwo->logo); ?>" width="100"/>
                            <span><?php echo e($match->TeamTwo->name); ?></span>
                        </a>
                    </div>
                </div>
                
                
                
                
                
                
                <div class="match-details">
                    <div class="match-detailed-item">

                        <div class="row">
                            <div class="col-6">
                                <select title="المدينة"
                                        class="form-control m-bootstrap-select m_selectpicker"
                                        name="city_id">
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>"
                                                <?php if($city->id == $match->city_id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-6">

                                <input class="form-control" name="match_date_time" id="m_datetimepicker_1" type="text"
                                       value="<?php echo e($match->match_date_time); ?>"/>

                            </div>
                        </div>
                    </div>
                    
                    <div class="match-detailed-item">
                        <select title="اسم الملعب"
                                class="form-control m-bootstrap-select m_selectpicker" name="pitch_id">
                            <?php $__currentLoopData = $pitches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pitch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pitch->id); ?>"
                                        <?php if($pitch->id == $match->pitch_id): ?> selected <?php endif; ?>><?php echo e($pitch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php if($match->status == 'current'): ?>
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
                                            <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_one_id)); ?>">
                                                <img src="<?php echo e($match->TeamOne->logo); ?>" width="30"/>
                                                <span><?php echo e($match->TeamOne->name); ?></span>
                                            </a>
                                        </div>
                                        <div class="actions-players-list">
                                            <?php $__currentLoopData = $match->TeamOne->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="player-action-wrap">
                                                    <div class="player-card">

                                                        <input type="hidden" name="team" class="team"
                                                               value="<?php echo e($match->team_one_id); ?>">
                                                        <input type="hidden"
                                                               name="match"
                                                               class="match"
                                                               value="<?php echo e($match->id); ?>">
                                                        <img
                                                            src="<?php echo e($player->image100 ?? url('assets/img/placeholder-user.png')); ?>"/>
                                                        <span><a href="<?php echo e(url(admin_users_url().'/edit/'.$player->id)); ?>"
                                                                 target="_blank"><?php echo e($player->full_name); ?></a></span>
                                                        <input type="hidden" name="player" class="player"
                                                               value="<?php echo e($player->id); ?>">
                                                        <a href="#" class="action" data-item="1"><i
                                                                class="la la-plus"></i></a>
                                                    </div>
                                                    <?php $__currentLoopData = $player->TimeLine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($record->match_id == $match->id && $match->team_one_id == $record->team_id): ?>
                                                            <div class="action-item-wrapper">
                                                                <a href="#" class="saveAction"><i
                                                                        class="la la-check"></i></a>
                                                                <a href="#" class="removeAction"
                                                                   data-id="<?php echo e($record->id); ?>"><i
                                                                        class="la la-remove"></i></a>
                                                                <select title="اختر الحدث"
                                                                        class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-one"
                                                                        name="actionOne[]">
                                                                    <option value="goal"
                                                                            <?php if($record->track_type == 'goal'): ?> selected <?php endif; ?>>
                                                                        هدف جديد
                                                                    </option>
                                                                    <option value="penalty_kick"
                                                                            <?php if($record->track_type == 'penalty_kick'): ?> selected <?php endif; ?>>
                                                                        ضربة جزاء
                                                                    </option>
                                                                    <option value="penalty_lose"
                                                                            <?php if($record->track_type == 'penalty_lose'): ?> selected <?php endif; ?>>
                                                                        ضربة جزاء ضائعة
                                                                    </option>
                                                                    <option value="red_card"
                                                                            <?php if($record->track_type == 'red_card'): ?> selected <?php endif; ?>>
                                                                        انذار احمر
                                                                    </option>
                                                                    <option value="yellow_card"
                                                                            <?php if($record->track_type == 'yellow_card'): ?> selected <?php endif; ?>>
                                                                        انذار اصفر
                                                                    </option>
                                                                    <option value="substitution"
                                                                            <?php if($record->track_type == 'substitution'): ?> selected <?php endif; ?>>
                                                                        تبديل
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control time"
                                                                       placeholder="الوقت"
                                                                       name="timeOne[]"
                                                                       value="<?php echo e($record->track_time); ?>"/>

                                                                <?php if($record->track_type == 'substitution' && isset($record->substituted_player_id)): ?>
                                                                    <div class="players-list-select-team-one">
                                                                        <select title="اختر اللاعب"
                                                                                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                                                                                name="playerOne[]">
                                                                            <?php $__currentLoopData = $match->TeamOne->Players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    value="<?php echo e($player->id); ?>"
                                                                                    <?php if($record->substituted_player_id == $player->id): ?> selected <?php endif; ?>> <?php echo e($player->full_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="team-actions">
                                        <div class="team-actions-name">
                                            <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_two_id)); ?>"
                                               target="_blank">

                                                <img src="<?php echo e($match->TeamTwo->logo); ?>" width="30"/>
                                                <span><?php echo e($match->TeamTwo->name); ?></span>
                                            </a>
                                        </div>
                                        <div class="actions-players-list">
                                            <?php $__currentLoopData = $match->TeamTwo->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="player-action-wrap">
                                                    <div class="player-card">
                                                        <input type="hidden" name="team" class="team"
                                                               value="<?php echo e($match->team_two_id); ?>">
                                                        <input type="hidden"
                                                               name="match"
                                                               class="match"
                                                               value="<?php echo e($match->id); ?>">
                                                        <img
                                                            src="<?php echo e($player->image100 ?? url('assets/img/placeholder-user.png')); ?>"/>
                                                        <span><a href="<?php echo e(url(admin_users_url().'/edit/'.$player->id)); ?>"
                                                                 target="_blank"><?php echo e($player->full_name); ?></a></span>
                                                        <input type="hidden" name="player" class="player"
                                                               value="<?php echo e($player->id); ?>">
                                                        <a href="#" class="action" data-item="2"><i
                                                                class="la la-plus"></i></a>
                                                    </div>
                                                    <?php $__currentLoopData = $player->TimeLine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($record->match_id == $match->id && $match->team_two_id == $record->team_id): ?>
                                                            <div class="action-item-wrapper">
                                                                <a href="#" class="saveAction"><i
                                                                        class="la la-check"></i></a>
                                                                <a href="#" class="removeAction"
                                                                   data-id="<?php echo e($record->id); ?>"><i
                                                                        class="la la-remove"></i></a>
                                                                <select title="اختر الحدث"
                                                                        class="form-control action_record m-bootstrap-select m_selectpicker actions-list-select-picker-team-one"
                                                                        name="actionOne[]">
                                                                    <option value="goal"
                                                                            <?php if($record->track_type == 'goal'): ?> selected <?php endif; ?>>
                                                                        هدف جديد
                                                                    </option>
                                                                    <option value="penalty_kick"
                                                                            <?php if($record->track_type == 'penalty_kick'): ?> selected <?php endif; ?>>
                                                                        ضربة جزاء
                                                                    </option>
                                                                    <option value="penalty_lose"
                                                                            <?php if($record->track_type == 'penalty_lose'): ?> selected <?php endif; ?>>
                                                                        ضربة جزاء ضائعة
                                                                    </option>
                                                                    <option value="red_card"
                                                                            <?php if($record->track_type == 'red_card'): ?> selected <?php endif; ?>>
                                                                        انذار احمر
                                                                    </option>
                                                                    <option value="yellow_card"
                                                                            <?php if($record->track_type == 'yellow_card'): ?> selected <?php endif; ?>>
                                                                        انذار اصفر
                                                                    </option>
                                                                    <option value="substitution"
                                                                            <?php if($record->track_type == 'substitution'): ?> selected <?php endif; ?>>
                                                                        تبديل
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control time"
                                                                       placeholder="الوقت"
                                                                       name="timeOne[]"
                                                                       value="<?php echo e($record->track_time); ?>"/>

                                                                <?php if($record->track_type == 'substitution' && isset($record->substituted_player_id)): ?>
                                                                    <div class="players-list-select-team-one">
                                                                        <select title="اختر اللاعب"
                                                                                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                                                                                name="playerOne[]">
                                                                            <?php $__currentLoopData = $match->TeamTwo->Players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    value="<?php echo e($player->id); ?>"
                                                                                    <?php if($record->substituted_player_id == $player->id): ?> selected <?php endif; ?>> <?php echo e($player->full_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_one_id)); ?>"
                                           target="_blank">
                                            <img src="<?php echo e($match->TeamOne->logo); ?>" width="30"/>
                                            <span><?php echo e($match->TeamOne->name); ?></span>
                                        </a>
                                    </div>
                                    <div class="main-secondary">اللاعبين الأساسيين</div>
                                    <div class="m-widget4">
                                        <?php $__currentLoopData = $match->TeamOne->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--logo">
                                                    <img
                                                        src="<?php echo e($player->image100 ?? url('assets/img/placeholder-user.png')); ?>"
                                                        alt="">
                                                </div>
                                                <div class="m-widget4__info">
																<span class="m-widget4__title">
<a href="<?php echo e(url(admin_users_url().'/edit/'.$player->id)); ?>"
   target="_blank"><?php echo e($player->full_name); ?></a>
																</span>
                                                </div>
                                                <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand"><?php echo e($player->pivot->player_no); ?></span>
															</span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="players-list">
                                    <div class="team-actions-name">
                                        <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_two_id)); ?>"
                                           target="_blank">

                                            <img src="<?php echo e($match->TeamTwo->logo); ?>" width="30"/>
                                            <span><?php echo e($match->TeamTwo->name); ?></span>
                                        </a>
                                    </div>
                                    <div class="main-secondary">اللاعبين الأساسيين</div>
                                    <div class="m-widget4">
                                        <?php $__currentLoopData = $match->TeamTwo->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--logo">
                                                    <img
                                                        src="<?php echo e($player->image100 ?? url('assets/img/placeholder-user.png')); ?>"
                                                        alt="">
                                                </div>
                                                <div class="m-widget4__info">
																<span class="m-widget4__title">
                                                                    <a href="<?php echo e(url(admin_users_url().'/edit/'.$player->id)); ?>"
                                                                       target="_blank">
                                                                        <?php echo e($player->full_name); ?></a>
																</span>
                                                </div>
                                                <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand"><?php echo e($player->pivot->player_no); ?></span>
															</span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="players-list-select-team-one" style="display: none;">
        <select title="اختر اللاعب"
                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                name="playerOne[]">
            <?php $__currentLoopData = $match->TeamOne->Players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($player->id); ?>"> <?php echo e($player->full_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="players-list-select-team-two" style="display: none;">
        <select title="اختر اللاعب"
                class="form-control m-bootstrap-select m_selectpicker select-player-picker substituted_player"
                name="playerOne[]">
            <?php $__currentLoopData = $match->TeamTwo->Players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($player->id); ?>"> <?php echo e($player->full_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <?php echo Form::close(); ?>

    <?php $__env->startPush('js'); ?>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js"
                type="text/javascript"></script>

        <script src="<?php echo e(url('/')); ?>/assets/custom.js" type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/js/matches.js" type="text/javascript"></script>


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

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/matches/edit.blade.php ENDPATH**/ ?>