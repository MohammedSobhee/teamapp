<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
        class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  <?php if(preg_match('/home/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                aria-haspopup="true"><a href="<?php echo e(url(admin_vw().'/home')); ?>"
                                        class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-line-graph"></i><span
                        class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span
                                class="m-menu__link-text">الرئيسية</span>
											</span></span></a></li>
            <?php if(in_array(1,$admin_roles)): ?>
                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/users/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-users"></i><span
                            class="m-menu__link-text">المستخدمين</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent"
                                aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">Base</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/users/i',url()->current()) && preg_match('/admins/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_users_url().'/admins')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">إدارة مديرو النظام</span></a></li>
                            <li class="m-menu__item <?php if(preg_match('/users/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_users_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">إدارة المستخدمين</span></a></li>
                            
                            
                            
                            
                            <li class="m-menu__item <?php if(preg_match('/users/i',url()->current()) && preg_match('/profile/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_users_url().'/profile')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">ملفي الشخصي</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(2,$admin_roles)): ?>
                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/teams/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-share"></i><span
                            class="m-menu__link-text">الفرق</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item <?php if(preg_match('/teams/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_teams_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">جميع الفرق</span></a></li>
                            
                            
                            
                            
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <?php if(in_array(3,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/leagues/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-web"></i><span
                            class="m-menu__link-text">البطولات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">البطولات</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/leagues/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_leagues_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">قائمة البطولات</span></a></li>
                            <li class="m-menu__item <?php if(preg_match('/leagues/i',url()->current()) && preg_match('/add/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_leagues_url().'/add')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">أضف بطولة جديدة</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <?php if(in_array(4,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/matches/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-interface-1"></i><span
                            class="m-menu__link-text">المباريات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">المباريات</span></span>
                            </li>
                            <li class="m-menu__item <?php if(preg_match('/matches/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_matches_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">المباريات</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(5,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/pitches/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-interface-6"></i><span
                            class="m-menu__link-text">الملاعب</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">الملاعب</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/pitches/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_pitches_url().'/list')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">قائمة الملاعب</span></a></li>
                            <li class="m-menu__item <?php if(preg_match('/pitches/i',url()->current()) && preg_match('/add/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_pitches_url().'/add')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">أضف ملعب جديد</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(6,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/bookings/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-network"></i><span
                            class="m-menu__link-text">الحجوزات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">الحجوزات</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/bookings/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_bookings_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">الحجوزات</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(7,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/transactions/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-statistics"></i><span
                            class="m-menu__link-text">العمليات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">العمليات</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/transactions/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a href="<?php echo e(url(admin_transactions_url().'/list')); ?>"
                                                        class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">قائمة العمليات</span></a></li>
                            
                            
                            
                            
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(8,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu <?php if(preg_match('/settings/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-settings-1"></i><span
                            class="m-menu__link-text">الإعدادات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">الإعدادات</span></span>
                            </li>
                            <li class="m-menu__item <?php if(preg_match('/settings/i',url()->current()) && preg_match('/stats/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_settings_url().'/stats')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">احصائيات</span></a></li>
                            <li class="m-menu__item <?php if(preg_match('/settings/i',url()->current()) && preg_match('/results/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_settings_url().'/results')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">نتائج</span></a></li>
                            <li class="m-menu__item <?php if(preg_match('/settings/i',url()->current()) && preg_match('/positions/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_settings_url().'/positions')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">مواقع</span></a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(in_array(9,$admin_roles)): ?>

                <li class="m-menu__item  m-menu__item--submenu  <?php if(preg_match('/articles/i',url()->current())): ?> m-menu__item--active m-menu__item--open <?php endif; ?>"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-edit-1"></i><span
                            class="m-menu__link-text">المقالات</span><i
                            class="m-menu__ver-arrow la la-angle-left"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__link-text">المقالات</span></span></li>
                            <li class="m-menu__item <?php if(preg_match('/articles/i',url()->current()) && preg_match('/list/i',url()->current())): ?> m-menu__item--active <?php endif; ?>"
                                aria-haspopup="true"><a
                                    href="<?php echo e(url(admin_articles_url().'/list')); ?>" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">قائمة المقالات</span></a></li>





                        </ul>
                    </div>
                </li>
            <?php endif; ?>

        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>
<?php /**PATH /home/macrbynj/public_html/teamapp/resources/views/admin/layout/sidebar.blade.php ENDPATH**/ ?>