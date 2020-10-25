<?php $__env->startSection('content'); ?>

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
                <a href="<?php echo e(url(admin_matches_url().'/edit/'.$match->id)); ?>"
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
                    <span class="match-result"><?php echo e($match->team_one_result); ?></span>
                    <span class="match-result"><?php echo e($match->team_two_result); ?></span>
                    <div class="team-item">
                        <a href="<?php echo e(url(admin_teams_url().'/view/'.$match->team_two_id)); ?>"
                           target="_blank">
                        <img src="<?php echo e($match->TeamTwo->logo); ?>" width="100"/>
                        <span><?php echo e($match->TeamTwo->name); ?></span>
                        </a>
                    </div>
                </div>
                <div class="match-details">
                    <div class="match-detailed-item"><?php echo e($match->city_name); ?> - <?php echo e($match->match_date_time); ?></div>
                    <div class="match-detailed-item"> ملعب <?php echo e($match->Pitch->name ?? '-'); ?>  </div>
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
                            <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="m-timeline-1__item <?php if($tline->team_id == $match->team_one_id): ?> m-timeline-1__item--left <?php else: ?> m-timeline-1__item--right <?php endif; ?>">
                                    <div class="m-timeline-1__item-circle">
                                        <div class="m--bg-danger"><?php echo e($tline->track_time); ?></div>
                                    </div>
                                    <div class="m-timeline-1__item-content">
                                        <?php echo $tline->icon; ?>

                                        <?php if($tline->track_type == 'substitution'): ?>
                                            <span><?php echo e($tline->player->full_name); ?> - <?php echo e($tline->substituted_player->full_name); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e($tline->player->full_name); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="players" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="players-list">
                                <div class="m-widget4">
                                    <?php $__currentLoopData = $match->TeamOne->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--logo" style="padding-left:8px;">
                                                <?php echo e($player->pivot->player_no); ?>

                                            </div>
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
                                                                    class="m-widget4__number m--font-brand"><?php echo e($player->primer_position); ?></span>
															</span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="players-list">
                                <div class="m-widget4">
                                    <?php $__currentLoopData = $match->TeamTwo->LeaguePlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--logo" style="padding-left:8px;">
                                                <?php echo e($player->pivot->player_no); ?>

                                            </div>
                                            <div class="m-widget4__img m-widget4__img--logo">
                                                <img
                                                    src="<?php echo e($player->image100 ?? url('assets/img/placeholder-user.png')); ?>"
                                                    alt="">
                                            </div>
                                            <div class="m-widget4__info">
																<span class="m-widget4__title">
<a href="<?php echo e(url(admin_users_url().'/edit/'.$player->id)); ?>"
   target="_blank"><?php echo e($player->full_name); ?></a>																</span>
                                            </div>
                                            <span class="m-widget4__ext">
																<span
                                                                    class="m-widget4__number m--font-brand"><?php echo e($player->primer_position); ?></span>
															</span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('js'); ?>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"
                type="text/javascript"></script>

        <script src="<?php echo e(url('/')); ?>/assets/custom.js" type="text/javascript"></script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/matches/view.blade.php ENDPATH**/ ?>