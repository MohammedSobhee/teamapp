<?php $__env->startSection('content'); ?>

    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Activity-->
            <div class="m-portlet ">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        عدد الفرق
                                    </h4><br>
                                    <span class="m-widget24__desc">
													عدد الفرق المسجلة
												</span>
                                    <span class="m-widget24__stats m--font-brand">
													<?php echo e($teams_num); ?>

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
                                        عدد اللاعبين
                                    </h4><br>
                                    <span class="m-widget24__desc">
													عدد اللاعبين في النظام
												</span>
                                    <span class="m-widget24__stats m--font-info">
													<?php echo e($players_num); ?>

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
                                        عدد البطولات
                                    </h4><br>
                                    <span class="m-widget24__desc">
													عدد البطولات في النظام
												</span>
                                    <span class="m-widget24__stats m--font-danger">
													<?php echo e($leagues_num); ?>

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
                                        عدد الملاعب
                                    </h4><br>
                                    <span class="m-widget24__desc">
													عدد الملاعب في النظام
												</span>
                                    <span class="m-widget24__stats m--font-success">
													<?php echo e($pitches_num); ?>

												</span>
                                    <div class="m--space-40"></div>

                                </div>
                            </div>

                            <!--end::New Users-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Activity-->
        </div>
    </div>
    <!--End::Section-->
    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-7">

            <!--begin:: Widgets/Best Sellers-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                البطولات القادمة
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget5 custom-widget">
                        <div class="m-widget5__item widget-header">
                            <div class="m-widget5__content width40">
                                <div class="m-widget5__pic">
                                    <img class="m-widget7__img" alt="">
                                </div>
                                <div class="m-widget5__section">
                                    اسم البطولة
                                </div>
                            </div>
                            <div class="m-widget5__content width17">
                                النوع
                            </div>
                            <div class="m-widget5__content width26">
                                تاريخ البداية
                            </div>
                            <div class="m-widget5__content">
                                عدد الفرق
                            </div>
                        </div>
                        <?php $__currentLoopData = $leagues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $league): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="m-widget5__item">
                                <div class="m-widget5__content width40">
                                    <a href="#">
                                        <div class="m-widget5__pic">
                                            <img class="m-widget7__img"
                                                 src="<?php echo e($league->logo); ?>"
                                                 alt="">
                                        </div>
                                        <div class="m-widget5__section">
                                            <h4 class="m-widget5__title">
                                                <?php echo e($league->name); ?>

                                            </h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="m-widget5__content width17">
                                    <?php echo e($league->type_name); ?>

                                </div>
                                <div class="m-widget5__content width26">
                                    <?php echo e($league->date_from); ?>

                                </div>
                                <div class="m-widget5__content">
                                    <?php echo e($league->teams_no); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Best Sellers-->
        </div>
        <div class="col-xl-5">

            <!--begin:: Widgets/Authors Profit-->
            <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                اخر الفرق المسجلة
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget4">
                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <a href="#"><img
                                            src="<?php echo e($team->logo ?? url('assets/img/un.png')); ?>"
                                            alt=""></a>
                                </div>
                                <div class="m-widget4__info">
                                    <a href="#">
														<span class="m-widget4__title">
															<?php echo e($team->name); ?>

														</span><br>
                                        <span class="m-widget4__sub">
															<?php echo e($team->description); ?>

														</span>
                                    </a>
                                </div>
                                <span class="m-widget4__ext">
													<span
                                                        class="m-widget4__number m--font-brand"><?php echo e($team->player_num); ?></span>
												</span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Authors Profit-->
        </div>
    </div>
    <!--End::Section-->
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        الحجوزات
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-widget14__chart" style="height:320px;">
                <canvas id="m_chart_daily_sales"></canvas>
            </div>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <!--begin::Page Scripts -->
        <script src="<?php echo e(url('/')); ?>/assets/app/js/dashboard.js" type="text/javascript"></script>

        <!--end::Page Scripts -->
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/home.blade.php ENDPATH**/ ?>