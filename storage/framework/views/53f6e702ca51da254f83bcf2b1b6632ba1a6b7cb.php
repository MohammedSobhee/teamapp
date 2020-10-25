<?php $__env->startSection('content'); ?>

    <input type="hidden" name="league_id" id="league_id" value="<?php echo e($league->id); ?>">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <?php echo e($league->name); ?>

                    </h3>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            <div class="league-details">
                <div class="league-logo">
                    <img src="<?php echo e($league->logo); ?>" width="100"/>
                    <div class="league--details-text">
                        <h4><?php echo e($league->name); ?></h4>
                        <span><?php echo e($league->city_name); ?></span>
                        <span><?php echo e($league->date_from); ?> - <?php echo e($league->date_to); ?></span>
                    </div>
                </div>
                <div class="league-content">
                    <h4 class="teams-no"><?php echo e($league->teams_no); ?> فريق</h4>
                    <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal"
                       data-target="#m_modal_1">
											<span>
												<span>الشروط والأحكام</span>
											</span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#teams" role="tab">الفرق</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#groups" role="tab">المجموعات/الترتيب</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#matches" role="tab">المباريات</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#stats" role="tab">احصائيات</a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#scorers" role="tab">قائمة الهدافين</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="teams" role="tabpanel">
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="league_teams_table" width="100%">
                        
                    </table>

                    <!--end: Datatable -->
                </div>
                <div class="tab-pane" id="groups" role="tabpanel">
                    <!--begin: Datatable -->
                    <div class="table-responsive">
                        <table class="m-datatable" id="league_groups_table" width="100%">

                        </table>
                    </div>
                    <!--end: Datatable -->
                    <div class="league-groups">
                        <div class="row">
                            <?php $__currentLoopData = $league->Groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-6 col-md-3">
                                    <div class="group-item">

                                        <div class="head"> المجموعة <?php echo e($group->name); ?></div>

                                        <div class="teams-list">
                                            <table class="table m-table m-table--head-separator-primary">
                                                <tbody>
                                                <?php $__currentLoopData = $group->Teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?php echo e($team->logo); ?>" width="30">
                                                            <span
                                                                style="font-size: 15px; font-weight: 500;margin-right:20px;"><?php echo e($team->name); ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="matches" role="tabpanel">
                    <?php $__currentLoopData = $league->Matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="match-item">
                            <div class="match-leaque details">
                                <span>الجولة <?php echo e(trans('app.group.'.$match->level)); ?> - المجموعة <?php echo e($match->Group->name); ?></span>
                                <a href="<?php echo e(url(admin_matches_url().'/edit/'.$match->id)); ?>"
                                   class="edit-left m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                   title="تعديل"><i class="la la-edit"></i></a>
                            </div>
                            <div class="match-card">
                                <div class="team-item">
                                    <img src="<?php echo e($match->TeamOne->logo); ?>" width="100">
                                    <span><?php echo e($match->TeamOne->name); ?></span>
                                </div>
                                <span class="match-result"><?php echo e($match->team_one_result); ?></span>
                                <span class="match-result"><?php echo e($match->team_two_result); ?></span>
                                <div class="team-item">
                                    <img src="<?php echo e($match->TeamTwo->logo); ?>" width="100">
                                    <span><?php echo e($match->TeamTwo->name); ?></span>
                                </div>
                            </div>
                            <div class="match-details">
                                <div class="match-detailed-item"><?php echo e($match->city_name); ?> <?php echo e($match->match_date_time); ?></div>
                                <div class="match-detailed-item"><?php echo e($match->Pitch->name ?? '-'); ?> </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="tab-pane" id="stats" role="tabpanel">
                    <div class="row m-row--no-padding m-row--col-separator-xl centerize-items small-text">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        المركز الأول
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-brand">
															<img src="<?php echo e(url('/')); ?>/assets/img/team.jpg" width="40"
                                                                 style="margin:15px 0;"/>
															<div>برشلونة</div>
														</span>
                                    <div class="m--space-40"></div>
                                </div>
                            </div>

                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Feedbacks-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        المركز الثاني
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-info">
															<img src="<?php echo e(url('/')); ?>/assets/img/team.jpg" width="40"
                                                                 style="margin:15px 0;"/>
															<div>برشلونة</div>
														</span>
                                    <div class="m--space-40"></div>

                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Orders-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        المركز الثالث
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-danger">
															<img src="<?php echo e(url('/')); ?>/assets/img/team.jpg" width="40"
                                                                 style="margin:15px 0;"/>
															<div>برشلونة</div>
														</span>
                                    <div class="m--space-40"></div>

                                </div>
                            </div>

                            <!--end::New Orders-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Users-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        اللعب النظيف
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-success">
															<img src="<?php echo e(url('/')); ?>/assets/img/team.jpg" width="40"
                                                                 style="margin:15px 0;"/>
															<div>برشلونة</div>
														</span>
                                    <div class="m--space-40"></div>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                    <div class="row m-row--no-padding m-row--col-separator-xl centerize-items small-text">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        <i class="icon-football-1"></i>
                                        <div>أفضل حارس مرمى</div>
                                    </h4>
                                    <br>
                                    <span class="m-widget24__stats m--font-brand">
															محمد محمود
														</span>
                                    <div class="m--space-40"></div>
                                </div>
                            </div>

                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Feedbacks-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        <i class="icon-football"></i>
                                        <div>الأهداف المسجلة</div>
                                    </h4>
                                    <br>
                                    <span class="m-widget24__stats m--font-info">
															25
														</span>
                                    <div class="m--space-40"></div>

                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Orders-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        <i class="card yellow"></i>
                                        <div>البطاقات الصفراء</div>
                                    </h4>
                                    <br>
                                    <span class="m-widget24__stats m--font-warning">
															25
														</span>
                                    <div class="m--space-40"></div>

                                </div>
                            </div>

                            <!--end::New Orders-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Users-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        <i class="card red"></i>
                                        <div>البطاقات الحمراء</div>
                                    </h4>
                                    <br>
                                    <span class="m-widget24__stats m--font-danger">
															10
														</span>
                                    <div class="m--space-40"></div>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                    <table class="m-datatable" id="teams_stats" width="100%">
                        <thead>
                        <tr>
                            <th data-field="ID">#</th>
                            <th data-field="Name">إسم الفريق</th>
                            <th data-field="MatchesNo">عدد المباريات</th>
                            <th data-field="Goals">الأهداف المسجلة</th>
                            <th data-field="Goals2">الأهداف المستقبلة</th>
                            <th data-field="YellowCards">البطاقات الصفراء</th>
                            <th data-field="RedCards">البطاقات الحمراء</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>برشلونة</td>
                            <td>7</td>
                            <td>4</td>
                            <td>2</td>
                            <td>1</td>
                            <td>10</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="scorers" role="tabpanel">
                    <table class="m-datatable" id="players_stats" width="100%">
                        <thead>
                        <tr>
                            <th data-field="ID">#</th>
                            <th data-field="Player">إسم اللاعب</th>
                            <th data-field="Team">اسم الفريق</th>
                            <th data-field="Matches">المباريات الملعوبة</th>
                            <th data-field="Goals">الأهداف المسجلة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد محمود</td>
                            <td>فريق برشلونة</td>
                            <td>30</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد محمود</td>
                            <td>فريق برشلونة</td>
                            <td>30</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد محمود</td>
                            <td>فريق برشلونة</td>
                            <td>30</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد محمود</td>
                            <td>فريق برشلونة</td>
                            <td>30</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد محمود</td>
                            <td>فريق برشلونة</td>
                            <td>30</td>
                            <td>25</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الشروط والأحكام</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo e($league->condition_text); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/demo/default/custom/crud/metronic-datatable/base/html-table.js"
                type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/custom.js" type="text/javascript"></script>
        <script src="<?php echo e(url('/')); ?>/assets/js/leagues.js" type="text/javascript"></script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/leagues/view.blade.php ENDPATH**/ ?>