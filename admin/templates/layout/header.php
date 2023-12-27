<?php
//$countNotify = 0;
//$contactNotify = $d->rawQuery("select id from #_contact where hienthi = 0 and type='lien-he'");

//$countNotify += count($contactNotify);
if (isset($config['newsletter'])) {
    foreach ($config['newsletter'] as $k => $v) {
        $emailNotify = $d->rawQuery("select id from #_newsletter where type = ? and hienthi = 0", array($k));
        $countNotify += count($emailNotify);
    }
}

if (isset($config['order']['active']) && $config['order']['active'] == true) {
    $orderNotify = $d->rawQuery("select id from #_order where tinhtrang=1");
    $countNotify += count($orderNotify);
}
?>
<!-- Header -->
<header id="header"
        class="header fixed-top d-flex align-items-center">
    <!--class="header fixed-top d-flex align-items-center main-header navbar navbar-expand navbar-white navbar-light text-sm">-->
    <div class="d-flex align-items-center justify-content-between">
        <!--<a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" >
            <span class="d-none d-lg-block">CKD</span>
        </a>-->
        <i class="bi bi-list toggle-sidebar-btn mt-1" ></i>
        <a href="index.php?ngonnguadmin=vi" class="mx-2"><img src="../assets/images/lang/vi.webp" alt="Tiếng Việt"
                                                 style="height:21px; border: 1px solid #dfdfdf;"></a>
        <a href="index.php?ngonnguadmin=ko" ><img src="../assets/images/lang/ko.webp" alt="Korea"
                                                 style="height:21px; border: 1px solid #dfdfdf;"></a>
    </div><!-- End Logo -->

    <div class="search-bar">
     <!--   <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>-->

    </div><!-- End Search Bar -->

    <a href="#" title="Listen to the song" class="player-controls">
        <span class="play"></span>
    </a>
    <audio id="player">
        <source src="./assets/images/thongbao5.mp3" type="audio/mp3">
    </audio>
    <!-- Right navbar links -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li class="nav-item">
                <a class="nav-link" href="https://ckdvietnam.com/" target="_blank">
                    <i class="nav-icon text-sm bx bx-bookmark nav_icon"></i>
                </a>
            </li>
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number"><?= $countNotify ?></span>
                </a><!-- End Notification Icon -->

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications dropdown-menu dropdown-menu-right shadow">
                    <span class="dropdown-item dropdown-header p-0">Thông báo</span>

                    <?php if (isset($config['order']['active']) && $config['order']['active'] == true) { ?>
                        <div class="dropdown-divider"></div>
                        <a href="index.php?com=order&act=man" class="dropdown-item"><i
                                    class="fas fa-shopping-bag mr-2"></i><span
                                    class="badge badge-danger mr-1"><?= count($orderNotify) ?></span> <?= donhang ?>

                        </a>
                    <?php } ?>

                    <?php if (isset($config['newsletter'])) { ?>
                        <div class="dropdown-divider"></div>
                        <?php foreach ($config['newsletter'] as $k => $v) {
                            $emailNotify = $d->rawQuery("select id from #_newsletter where type = ? and hienthi = 0", array($k)); ?>
                            <a href="index.php?com=newsletter&act=man&type=<?= $k ?>" class="dropdown-item"><i
                                        class="fas fa-mail-bulk mr-2"></i></i><span
                                        class="badge badge-danger mr-1"><?= count($emailNotify) ?></span> <?= $v['title_main'] ?>
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php } ?>
                    <?php } ?>

                </div>


            </li><!-- End Notification Nav -->
        <!--
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">99</span>
                </a>

            </li>

            -->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img   src="assets/images/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?= $_SESSION[$login_admin]['username'] ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul aria-labelledby="dropdownSubMenu-info"
                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages dropdown-menu dropdown-menu-right border-0 shadow">
                    <?php if ($config['website']['debug-developer'] && count($config['website']['lang']) >= 2) { ?>
                        <li>
                            <a href="index.php?com=lang&act=man" class="dropdown-item">
                                <i class="fas fa-language"></i>
                                <span>Quản lý ngôn ngữ</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>
                    <?php } ?>

                    <li>
                        <a href="index.php?com=user&act=admin_edit" class="dropdown-item">
                            <i class="fas fa-user-cog"></i>
                            <span><?= thongtinadmin ?></span>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <a href="index.php?com=user&act=admin_edit&changepass=1" class="dropdown-item">
                            <i class="fas fa-key"></i>
                            <span><?= doimatkhau ?></span>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <a href="index.php?com=cache&act=delete" class="dropdown-item">
                            <i class="far fa-trash-alt"></i>
                            <span><?= xoabonhotam ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?com=user&act=logout" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i><?= dangxuat ?></a>
                    </li>

                </ul>


                <!--<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php /*= $_SESSION[$login_admin]["ten"];*/ ?></h6>
                        <span>Admin</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>-->

                <!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>


<script type="text/javascript">
    setInterval(function () {
        $.ajax({
            type: 'post',
            url: 'ajax/thongbao.php',
            success: function (kq) {
                if (kq > 0) $('.player-controls').click();
            }
        })
    }, 60000);

    $(document).ready(function () {
        var getaudio = $('#player')[0],
            mouseovertimer,
            audiostatus = 'off',
            playerControls = ".player-controls";
        $(document).on('mouseenter', playerControls, function () {
            if (!mouseovertimer) {
                mouseovertimer = window.setTimeout(function () {
                    mouseovertimer = null;
                    if (!$(playerControls).hasClass("playing")) {
                        getaudio.load();
                        getaudio.play();
                        $(playerControls).addClass('playing');
                        return false;
                    }
                }, 2500);
            }
        });
        $(document).on('mouseleave', playerControls, function () {
            if (mouseovertimer) {
                window.clearTimeout(mouseovertimer);
                mouseovertimer = null;
            }
        });
        $(document).on('click touch', playerControls, function (e) {
            e.preventDefault();
            if (!$(playerControls).hasClass("playing")) {
                if (audiostatus == 'off') {
                    $(playerControls).addClass('playing');
                    getaudio.load();
                    getaudio.play();
                    window.clearTimeout(mouseovertimer);
                    audiostatus = 'on';
                    return false;
                } else if (audiostatus == 'on') {
                    $(playerControls).addClass('playing');
                    getaudio.play();
                }
            } else if ($(playerControls).hasClass("playing")) {
                getaudio.pause();
                $(playerControls).removeClass('playing');
                window.clearTimeout(mouseovertimer);
                audiostatus = 'on';

            }
            return false;
        });
        $('#player').on('ended', function () {
            $(playerControls).removeClass('playing');
            audiostatus = 'off';
        });
    });
</script>



