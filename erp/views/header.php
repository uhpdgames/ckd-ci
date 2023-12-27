<?php
if (!$this->input->is_ajax_request()) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <base href="<?= base_url() ?>"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="assets/images/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="assets/images/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="assets/images/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/icons/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/icons/icon.png">
    <!--script type="text/javascript" src="assets/js/queryloader2.min.js"></script-->
    <script type="text/javascript">
        var site_url = '<?= base_url() ?>';
        var cookie_time = '<?= COOKIE_TIME ?>';
        var user_level = '<?= $GLOBALS['user']['level'] ?>';
        var user_id = '<?= $GLOBALS['user']['id'] ?>';
        /*window.addEventListener('DOMContentLoaded', function () {
            "use strict";
            var ql = new QueryLoader2(document.querySelector('body'), {
                barColor: '#00bca4',
                backgroundColor: '#ffffff',
                percentage: true,
                barHeight: 2,
                minimumTime: 200,
                fadeOutTime: 1000
            });
        });*/
     <?php
                    $data['filter'] = $this->input->get('filter', true);
                   ?>
                    var uri_url = '<?= http_build_query($data); ?>';
        //            var mfr = '<?//= $GLOBALS['manufacturers'] ? $GLOBALS['manufacturers'] : '[]' ?>//';
        //            var getDataMFR = JSON.parse(mfr);
        //            var optionMFR = '<option value="">Select...</option>';
        //            for (var k in getDataMFR){
        //                if (typeof getDataMFR[k] !== 'function') {
        //                    optionMFR += '<option value="' + k + '">' + getDataMFR[k] + '</option>';
        //                }
        //            }
        //
        //            var supplier = '<?//= $GLOBALS['suppliers'] ? $GLOBALS['suppliers'] : '[]' ?>//';
        //            var getDataSupplier = JSON.parse(supplier);
        //            var optionSupplier = '<option value="">Select...</option>';
        //            for (var k in getDataSupplier) {
        //                if (typeof getDataSupplier[k] !== 'function') {
        //                    optionSupplier += '<option value="' + k + '">' + getDataSupplier[k] + '</option>';
        //                }
        //            }
    </script>
    <style media="screen">
        .yesPrint {
            display: none !important;
        }

        #header-logo .logo-content-big,
        .logo-content-small {
            background: url(assets/images/logo-fcms.png) left 50% no-repeat;
        }
    </style>
    <style media="print">
        .noPrint {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/atckey.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="assets/js/dhtmlxgantt/dhtmlxgantt.css" media="screen">
    <script type="text/javascript" src="assets/js/core.js"></script>
    <script type="text/javascript" src="assets/js/dhtmlxgantt/dhtmlxgantt.js"></script>
    <script type="text/javascript" src="assets/js/dhtmlxgantt/ext/dhtmlxgantt_tooltip.js"></script>
    <script type="text/javascript" src="assets/js/autoNumeric.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/crmzx.css">

    <link rel="stylesheet" type="text/css" href="assets/css/extra.css">
</head>

<body class="fixed-header fixed-sidebar<?= ($GLOBALS['var']['sidebar_collapsed'] ? ' closed-sidebar' : '') ?>"
      style="background: #fafcfe" <?= $GLOBALS['user']['level'] != 1 ? 'oncontextmenu="return false"' : '' ?>>
<input type="hidden" id="jsonSort"/>
<div class="opaDiv"></div>
<div class="notiLoading noPrint">Đang tải...</div>
<div id="updateMes" class="noPrint"></div>
<div class="commandDiv noPrint">
    <button id="cmdBtnMove" style="display: none" class="btn btn-border btn-alt btn-danger waves-effect">
        <i class="glyph-icon icon-share-alt"></i>
        <span>Move</span>
    </button>
    <button id="cmdBtnDelRestore"
            class="btn btn-border btn-alt btn-<?= (isset($uri['deleted']) && $uri['deleted'] ? 'success' : 'danger') ?> waves-effect">
        <i class="glyph-icon icon-<?= (isset($uri['deleted']) && $uri['deleted'] ? 'check' : 'trash-o') ?>"></i>
        <span class="hide640"><?= (isset($uri['deleted']) && $uri['deleted'] ? 'Restore' : 'Delete') ?></span>
    </button>
    <button id="cmdBtnRemove" class="btn btn-border btn-alt border-danger btn-danger font-danger waves-effect">
        <i class="glyph-icon icon-remove"></i>
        <span class="hide640">Remove</span>
    </button>
    <button id="cmdBtnUpdate" style="display: none" class="btn btn-border btn-alt btn-success waves-effect">
        <i class="glyph-icon icon-share-square-o"></i>
        <span>Update</span>
    </button>
    <span style="padding-top: 13px;"><span class="selectedItem">0</span> item(s)</span>
</div>
<div id="prints" class="yesPrint"></div>
<div id="page-wrapper" class="noPrint">
    <div id="page-header" class="bg-gradient-9">
        <div class="row">
            <div class="col-xs-4">
                <div id="mobile-navigation">
                    <button id="nav-toggle" class="collapsed"><span></span></button>
                    <a href="./" class="ajax logo-content-small" title="<?= PRODUCT ?>"></a>
                </div>
                <div id="header-logo" class="logo-bg">
                    <a href="./" class="ajax logo-content-big" title="<?= PRODUCT ?>"><?= PRODUCT ?></a>
                    <a href="./" class="ajax logo-content-small" title="<?= PRODUCT ?>"><?= PRODUCT ?></a>
                    <a id="close-sidebar" href="#" title="Close sidebar"><i class="glyph-icon icon-angle-left"></i></a>
                </div>
                <div style="line-height: 50px; color: #fff; margin-left: 20px;" class="display-usd-rates">
                    <span style="text-decoration: underline; font-style: italic; cursor: pointer; margin-left: 20px; font-size: 11px;"
                          id="load_usd_rates">USD Rates</span>: <span id="usd_rates"
                                                                      style="font-weight: bold; font-size: 15px;"><?= number_format(11111) ;//$GLOBALS['cfg']['usd_exchange_rate']?></span>₫
                </div>
            </div>
            <div class="col-xs-8">
                <div id="header-nav-left">
                    <div class="user-account-btn dropdown" style="padding-left: 0; padding-right: 0;">
                        <a href="#" class="user-profile clearfix" data-toggle="dropdown">
                            <?php
                            $tmp = explode(' ', trim($GLOBALS['user']['fullname']));
                            $firstname = end($tmp);
                            if(isset($GLOBALS['user']['icon']))
                            $avatar = ($GLOBALS['user']['icon'] && goodfile(NHANVIEN . $GLOBALS['user']['icon']) ? NHANVIEN . $GLOBALS['user']['icon'] : 'assets/images/letter-avatars/' . strtolower(substr(viet_decode($firstname), 0, 1)) . '.png');
                            ?>
                            <img id="profile_img" width="28" height="28" src="<?= $avatar ?>" alt="Profile image">
                            <span><?php
                            $tmp = explode(' ', $GLOBALS['user']['fullname']);
                            echo ($GLOBALS['user']['fullname'] ? end($tmp) : $GLOBALS['user']['username']) ?></span>
                            <i class="glyph-icon icon-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu float-right"
                            style="top: 28px; padding-left: 0; padding-right: 0; width: 92px; min-width: 0;">
                            <li><a href="./">Dashboard</a></li>
                            <li><a class="ajax" href="./profile">Account</a></li>
                            <li><a href="../" target="_blank">Home</a></li>
                            <li class="divider"></li>
                            <li><a href="#" data-toggle="modal" data-target=".logout-modal-sm">Logout</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="control-sidebar clearfix sb-toggle-right" title="Show Tasks"><i class="glyph-icon icon-tasks"></i></a> -->
                    <a class="control-sidebar clearfix" id="btn-gantt-tasks" data-toggle="modal" title="Show Tasks"><i
                                class="glyph-icon icon-tasks"></i></a>
                    <div class="dropdown">
                        <a title="Show notifications" class="sb-toggle-right notify test-css control-sidebar clearfix"
                           id="btn-show-notify">
                            <i class="glyph-icon icon-bell"><span class="badge badge-info"
                                                                  style="font-style: normal !important; background:#cf4436 !important;"><?php echo count_notifi(); ?></span></i>
                            <a class="nav-link clearfix"></a>
                            <?php $ci =& get_instance();
                            $ci->load->library('user_agent');
                            if ($ci->agent->is_mobile()): ?>
                                <div class="modal-notify"></div>
                            <?php else: ?>
                                <ul class="dropdown-menu notify dropdown-menu-right" role="menu">
                                    <li class="header">NOTIFICATIONS<span style="float: right"><a href="<?php echo site_url('notification') ?>" class=" waves-effect waves-block">View All</a></span></li>
                                    <li class="body" style="width:430px;max-width:430px;display: inline-block;">
                                        <ul class="menu mnotify" id="slimer-action">
                                            <?php
                                            $hasNotify_old = $hasNotify_new = false;
                                            $notifi = info_notifi();
                                            echo '<ul>';
                                            if (isset($notifi['new']) && is_array($notifi['new']) && count($notifi['new'])) {
                                                $hasNotify_new = true;
                                                echo ' <li><a class="noHover font-bold">Today</a></li>';
                                                foreach ($notifi['new'] as $item) {
                                                    $isNew = isset($item['read']) && $item['read'] == 0;
                                                    echo '<li>
                                                    <div href="' . $item['link'] . '" class="press-notify" data-id="' . $item['id'] . '" name="' . $item['title'] . '" >
                                                        <div class="icon-circle" style="background:' . ($isNew ? '#0093d9' : '#00a85a') . '">
                                                           <i class="fa ' . ($isNew ? ' fa-bell' : ' fa-bell-slash-o') . '"></i>
                                                        </div>
                                                        <div class="menu-info">
                                                            <a href="' . $item['link'] . '" class="text-notify ' . ($isNew ? ' font-bold' : '') . '">' . $item['content'] . '</a>
                                                            <p><i class="fa fa-clock-o"></i> ' . $item['date_added'] . '</p>
                                                        </div>
                                                        <div class="inline" style="float: right"><a href="javascript:;" data-placement="bottom" title="Xóa" class="delRestoreLink none-type" data-id="' . $item['id'] . '" data-table="notification"><div class="icon glyphicons bin waves-effect waves-circle"></div></a></div>
                                                    </div>
                                               </li>';
                                                }
                                            }
                                            if (isset($notifi['old']) && is_array($notifi['old']) && count($notifi['old'])) {
                                                $hasNotify_old = true;
                                                echo ' <li><a class="noHover font-bold">Old</a></li>';
                                                foreach ($notifi['old'] as $item) {
                                                    $isNew = isset($item['read']) && $item['read'] == 0;
                                                    echo '<li>
                                                    <div href="' . $item['link'] . '" class="press-notify" data-id="' . $item['id'] . '" name="' . $item['title'] . '" >
                                                        <div class="icon-circle" style="background:' . ($isNew ? '#0093d9' : '#00a85a') . '">
                                                           <i class="fa ' . ($isNew ? ' fa-bell' : ' fa-bell-slash-o') . '"></i>
                                                        </div>
                                                        <div class="menu-info">
                                                        <a href="' . $item['link'] . '" class="text-notify ' . ($isNew ? ' font-bold' : '') . '">' . $item['content'] . '</a>    
                                                            <p><i class="fa fa-clock-o"></i> ' . $item['date_added'] . '</p>
                                                        </div>
                                                        <div class="inline" style="float: right"><a href="javascript:;" data-placement="bottom" title="Xóa" class="delRestoreLink none-type" data-id="' . $item['id'] . '" data-table="notification"><div class="icon glyphicons bin waves-effect waves-circle"></div></a></div>
                                                    </div>
                                               </li>';
                                                }
                                            }
                                            echo '</ul>';
                                            ?>
                                        </ul>
                                    </li>
                                    <li class="footer"></li>
                                </ul>
                            <?php endif; ?>
                        </a>
                    </div>
                </div><!-- #header-nav-left -->
                <?php
                if (isset($search) && $search) {
                    echo '<label for="show-wrap-search" id="btn-search-mb" class="btn btn-yellow btn-alt btn-hover waves-effect"><span>Search</span><i class="glyph-icon icon-search"></i></label><input type="checkbox" id="show-wrap-search">';
                    echo '<div class="wrap-search">';
                    echo form_open(($act == 'online' ? $act . '/' . $do : $act), array('method' => 'get', 'id' => 'frmSearch', 'class' => 'frm-search'));
                    echo '<div class="input-group input-group-search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"><i class="glyph-icon icon-search"></i></button>
                                    </div>
                                    <input name="q" type="text" class="form-control" value="' . (isset($uri['q']) && $uri['q'] ? $uri['q'] : '') . '" placeholder="' . ($act == 'products' ? 'Part Number / Description' : 'Search') . '">
                                </div>';
                    if ($uri['deleted']) {
                        echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
                    }
                    if (isset($uri['active']) && $uri['active'] != 1) {
                        echo form_input(array('type' => 'hidden', 'name' => 'active', 'value' => $uri['active']));
                    }
                    if ($uri['q'] != '') {
                        echo '<a class="ajax" href="' . site_url(($act == 'online' ? $act . '/' . $do : $act)) . url_uri($uri, array('q', 'user')) . '" style="float: right; margin-top: -22px; margin-right: 5px;"><i class="icon glyphicons remove"></i></a>';
                    }
                    echo '</div>';
                    echo form_close();
                }
                if ($do == 'update' || $do == 'permiss' || (isset($submit_btn) && $submit_btn) || (!empty($back_btn) && is_array($back_btn))) {
                    $url_back = $this->input->get('data_back', true);
                    if ($this->input->get('data_back', true)) {
                        $data_back = $url_back;
                    } else {
                        $data_back = site_url($act) . url_uri($uri);
                    }
                    if (strlen($submit_btn) == 1 && $submit_btn == true) {
                        $submit_btn = ($id ? 'Update' : 'Add new');
                    }
                    echo '<div class="btnFrm" style="float: right; line-height: 46px;">';
                    if ($do != 'view' && $submit_btn) {
//                        if($act == 'order_confirm'){
//                            echo '<button id="Exportexcel" class="btn btn-success btn-alt btn-hover waves-effect"><span>Export</span><i class="glyph-icon icon-check"></i></button>';
//                        }else{
                            echo '<button id="submitBtn" class="btn btn-success btn-alt btn-hover waves-effect"><span>' . $submit_btn . '</span><i class="glyph-icon icon-check"></i></button>';
//                        }
                    }
                    if ($act != 'profile' && empty($back_btn)) {
                        echo '<button id="backBtn" class="btn btn-danger btn-alt btn-hover waves-effect mrg5L" data-back="' . $data_back . '"><span>' . ($id ? 'Back' : 'Cancel') . '</span><i class="glyph-icon icon-chevron-left"></i></button>';
                    }
                    if ((!empty($back_btn) && is_array($back_btn))) {
                        echo '<button id="backBtn" class="btn btn-danger btn-alt btn-hover waves-effect mrg5L" data-back="' . $back_btn[0] . '"><span>' . $back_btn[1] . '</span><i class="glyph-icon icon-chevron-left"></i></button>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div id="sidebar" class="navbar-collapse">
        <ul class="sidebar-menu">
            <?php
            $user_rights = json_decode($GLOBALS['user']['user_rights']);
            $rights = array();
           if(is_array($user_rights) && count($user_rights)){
               foreach ($user_rights as $key => $value) {
                   if (@array_key_exists('view', $value) && check_rights($key)) {
                       $rights[] = $key;
                   }
               }
           }

            $modules_groups = get_data('modules_categories', '', '**', '', '', 'sort_order desc');
           if(is_array($modules_groups) && count($modules_groups)){
               foreach ($modules_groups as $modules_group) {
                   $modules = get_data('modules', 'cat = "' . $modules_group['id'] . '" AND active = "1" AND deleted = "0" AND menu = "1" AND file IN ("' . implode('","', $rights) . '")', '**', '', '', 'sort_order DESC');
                   if (is_array($modules)) {
                       echo '<li class="header"><i class="' . $modules_group['img'] . '"></i><span>' . $modules_group['name_vn'] . '</span>';
                       echo '<ul>';
                       foreach ($modules as $module) {
                           if (check_rights($module['file'])) {
                               echo '<li' . ($GLOBALS['var']['act'] == $module['file'] ? ' class="sfHover"' : '') . '><a href="' . site_url($module['file']) . '" title="' . $module['name_vn'] . '" class="sf-with-ul"><i class="' . $module['image'] . '"></i><span>' . $module['name_vn'] . '</span></a></li>';
                           }
                       }
                       echo '</ul>';
                       echo '</li>';
                   }
               }
           }

            ?>
        </ul><!-- #sidebar-menu -->
    </div>
    <div id="page-content-wrapper">
        <div class="overbg"></div>
        <div id="page-content">
            <?php
            }
            ?>
            <title><?= ($title ? $title : 'Overview') ?></title>
            <?php
            if ($title) {
                ?>
                <div id="page-title">
                    <?php
                    if ($GLOBALS['var']['act'] == 'customer_received_date' && $search == True) echo $this->load->view($GLOBALS['var']['act'].'/filter');
                    ?>
                    <h2 style="float: left">
                            <span style="float:left; margin-right: 10px">
                            <?php
                            echo $title;
                            echo(!$do && isset($filter_cat) && $filter_cat ? '<div class="tl-label bs-label label-primary" style="text-transform: none; margin: 0 5px;">' . get_data($GLOBALS['var']['act'] . '_categories', 'id = "' . $filter_cat . '"', 'name_vn') . '</div>' : '');
                            ?>
                            </span>


                    </h2>
                    <div style="float: right; height: 32px;" class="btn-edit">
                        <?php
                        if (isset($add_link) && $add_link && $GLOBALS['per']['add']) {
                            echo '<a href="' . $add_link . '" class="addLink"><div class="btn btn-border btn-alt border-green font-green tooltip-link" data-placement="bottom" title="Add new"><i class="glyph-icon icon-plus-circle"></i></div></a>';
                        }
                        if (isset($filter_stock)) {
                            echo '<div class="dropdown" id="filter-btn">';
                            echo '<a href="#" data-toggle="dropdown" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="' . ($filter_stock ? $GLOBALS['stock_list'][$filter_stock]['name_vn'] : 'Inventory filtering') . '"><i class="glyph-icon icon-inbox"></i></div></a>';
                            echo '<div class="dropdown-menu float-right" style="padding: 5px;">';
                            echo '<ul class="cat_treeview filetree treeview filter_stock" style="margin: 0; min-width: 145px; height: 140px;">' . cat_tree($GLOBALS['stock_list'], 0, $filter_stock, 'radio', true, 'stock') . '</ul>';
                            echo '</div>';
                            echo '</div>';
                        }
                        if (isset($cat_list) && is_array($cat_list) && count($cat_list)) {
                            echo '<div class="dropdown" id="filter-btn">';
                            echo '<a href="#" data-toggle="dropdown" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-blue font-blue tooltip-button" data-placement="bottom" title="Group of goods"><i class="glyph-icon icon-list-alt"></i></div></a>';
                            echo '<div class="dropdown-menu float-right" style="padding: 5px;">';
                            echo '<ul class="cat_treeview filetree treeview filter_cat" style="margin: 0">' . cat_tree($cat_list, 0, $filter_cat, 'radio', true) . '</ul>';
                            echo '</div>';
                            echo '</div>';
                        }
                        if (!empty($date_picker)) {
                            echo '<div class="dropdown" id="datetime-btn">';
                            echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="View by date/month"><i class="glyph-icon icon-calendar"></i></div></a>';
                            echo '<div class="dropdown-menu float-right" style="padding: 15px; width: 240px;">';
                            echo form_open($act . ($do ? '/' . $do : ''), array('method' => 'get', 'id' => 'frmDate'));
                            echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
                            if ($uri['deleted']) {
                                echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
                            }
                            echo '<div class="form-group">';
                            echo '<div class="row">';
                            echo '<div class="col-sm-6"><input type="text" value="' . $uri['date_added'] . '" class="form-control date" name="date_added" autocomplete="off" /></div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<div class="row" style="margin-bottom: 0">';
                            echo '<div class="col-sm-12" style="text-align: center">';
                            echo '<button type="submit" class="btn btn-alt btn-primary btn-hover" style="float: none; margin: auto"><span>Apply</span><i class="glyph-icon icon-check"></i></button>';
                            if (($uri['from'] && $uri['from'] != date('Y-m-d', time() - 86400 * 30)) || ($uri['to'] && $uri['to'] != date('Y-m-d'))) {
                                echo '<a class="ajax btn btn-alt btn-danger btn-hover" href="' . site_url($act) . ($do ? '/' . $do : '') . url_uri($uri, array('to', 'from', 'user')) . '" style="float: none"><span>Cancel</span><i class="glyph-icon icon-remove"></i></a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo form_close();
                            echo '</div>';
                            echo '</div>';
                        }
                        if (isset($datetime_picker) && $datetime_picker) {
                            echo '<div class="dropdown" id="datetime-btn">';
                            echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="View by date/month"><i class="glyph-icon icon-calendar"></i></div></a>';
                            echo '<div class="dropdown-menu float-right" style="padding: 15px; width: 240px;">';
                            echo form_open($act . ($do ? '/' . $do : ''), array('method' => 'get', 'id' => 'frmDate'));
                            echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
                            if ($uri['deleted']) {
                                echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
                            }
                            echo '<div id="datepicker" class="form-group">';
                            echo '<div class="row input-daterange">';
                            echo '<div class="col-sm-6"><input type="text" value="' . $uri['from'] . '" class="form-control" name="from" placeholder="From" autocomplete="off" /></div>';
                            echo '<div class="col-sm-6"><input type="text" value="' . $uri['to'] . '" class="form-control" name="to" placeholder="To" autocomplete="off" /></div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<div class="row" style="margin-bottom: 0">';
                            echo '<div class="col-sm-12" style="text-align: center">';
                            echo '<button type="submit" class="btn btn-alt btn-primary btn-hover" style="float: none; margin: auto"><span>Apply</span><i class="glyph-icon icon-check"></i></button>';
                            if (($uri['from'] && $uri['from'] != date('Y-m-d', time() - 86400 * 30)) || ($uri['to'] && $uri['to'] != date('Y-m-d'))) {
                                echo '<a class="ajax btn btn-alt btn-danger btn-hover" href="' . site_url($act) . ($do ? '/' . $do : '') . url_uri($uri, array('to', 'from', 'user')) . '" style="float: none"><span>Cancel</span><i class="glyph-icon icon-remove"></i></a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo form_close();
                            echo '</div>';
                            echo '</div>';
                        }
                        if (isset($month_picker) && $month_picker) {
                            echo '<div class="dropdown" id="datetime-btn">';
                            echo '<a href="#" data-placement="bottom" class="filter-btn"><div class="btn btn-border btn-alt border-purple font-purple tooltip-button" data-placement="bottom" title="Month"><i class="glyph-icon icon-calendar"></i></div></a>';
                            echo '<div class="dropdown-menu float-right" style="padding: 15px 15px 5px; width: ' . ($uri['month'] ? 185 : 140) . 'px; min-width: auto;">';
                            echo form_open($act . ($do ? '/' . $do . ($id ? '/' . $id : '') : ''), array('method' => 'get', 'id' => 'frmDate'));
                            if (isset($uri['q']) && $uri['q']) {
                                echo form_input(array('type' => 'hidden', 'name' => 'q', 'value' => $uri['q']));
                            }
                            if (isset($uri['deleted']) && $uri['deleted']) {
                                echo form_input(array('type' => 'hidden', 'name' => 'deleted', 'value' => $uri['deleted']));
                            }
                            echo '<div class="form-group">';
                            echo '<div class="row">';
                            echo '<div class="col-sm-12">';
                            echo '<input type="text" value="' . $uri['month'] . '" class="form-control month" readonly name="month" autocomplete="off" style="width: calc(100% - ' . ($uri['month'] ? 94 : 47) . 'px); float: left;" />';
                            if ($uri['month']) {
                                echo '<a class="ajax btn btn-border btn-alt border-red font-red" href="' . site_url($act) . ($do ? '/' . $do . ($id ? '/' . $id : '') : '') . url_uri($uri, array('month')) . '" style="width: 42px; float: right; margin-top: 0; line-height: 28px;"><i class="glyph-icon icon-remove"></i></a>';
                            }
                            echo '<button type="submit" class="btn btn-border btn-alt border-success font-green" style="width: 42px; float: right; margin-top: 0;"><i class="glyph-icon icon-check"></i></button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo form_close();
                            echo '</div>';
                            echo '</div>';
                        }
                        if ($do == '') {
                            if (!in_array($act, array('chi_nhanh', 'interfaces', 'hscode', 'parts', 'price_accessing', 'languages', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'requests', 'purchasing_cost', 'customer_received_date', 'department_profile', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast'))) {
                                echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file" href="javascript:;" data-placement="bottom" title="Prints"><i class="glyph-icon icon-print"></i></a>';
                            }
                            if (!in_array($act, array('user_att', 'chi_nhanh', 'interfaces', 'hscode', 'parts', 'price_accessing', 'languages', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'requests', 'purchasing_cost', 'customer_received_date', 'report', 'department_profile', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast'))) {
                                echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file" href="javascript:;" data-href="' . site_url($act . '/exports') . url_uri($uri, array('rowstart')) . '" data-placement="bottom" title="Exports"><i class="glyph-icon icon-download"></i></a>';
                            }
                            if (in_array($act, array('forecast', 'suppliers_forecast'))) {
                                echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file-custom" href="javascript:;" data-placement="bottom" data-table="table-' . $GLOBALS['var']['act'] . '" title="Prints"><i class="glyph-icon icon-print"></i></a>';
                            }
                            if (in_array($act, array('purchasing_cost', 'forecast', 'suppliers_forecast'))) {
                                echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file-custom" href="javascript:;" data-placement="bottom" data-table="table-' . $GLOBALS['var']['act'] . '" title="Exports"><i class="glyph-icon icon-download"></i></a>';
                            }
                            if (in_array($act, array('warehouse_inout')) && $GLOBALS['per']['edit']) {
                                echo '<a class="btn btn-border btn-alt border-orange font-orange tooltip-link prints-file-compare" href="javascript:;" data-placement="bottom" title="Print Compare"><i class="glyph-icon icon-print"></i></a>';
                                echo '<a class="btn btn-border btn-alt border-black font-black tooltip-link prints-file" href="javascript:;" data-placement="bottom" title="Prints"><i class="glyph-icon icon-print"></i></a>';
                                echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-file" href="javascript:;" data-href="' . site_url($act . '/exports') . url_uri($uri, array('rowstart')) . '" data-placement="bottom" title="Exports"><i class="glyph-icon icon-download"></i></a>';
                            }
                            if (!in_array($act, array('user_att', 'chi_nhanh', 'positions', 'stock_inout', 'stock_begin', 'stock_import', 'stock_export', 'purchase_order', 'sales_order', 'sales_order_online', 'rfq', 'products', 'manufacturers', 'interfaces', 'customers', 'customers_online', 'suppliers', 'hscode', 'digicats', 'parts', 'price_accessing', 'languages', 'purchasing_report', 'purchasing_part_report', 'gross_revenue_per_staff', 'sales_report', 'sales_part_report', 'sales_revenue_per_staff', 'business_trip_customer', 'projects_customer', 'shipment_tracker_domestic', 'payment_management', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'departmental_documentation', 'requests', 'purchasing_cost', 'customer_received_date', 'report', 'department_profile', 'shipment_tracker', 'company_info', 'warehouse_inout', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'kpis_platform', 'company_profile', 'employee_profile', 'stock_online', 'recruitment_data', 'recruitment', 'recruitment_online', 'forecast', 'suppliers_forecast'))) {
                                echo '<a class="btn btn-border btn-alt border-blue font-blue tooltip-link imports-file" href="javascript:;" data-placement="bottom" title="Import"><i class="glyph-icon icon-upload"></i></a>';
                            }
                            if (!in_array($act, array('user_att', 'chi_nhanh', 'data_attts', 'stock_inout', 'products', 'hscode', 'digicats', 'parts', 'price_accessing', 'sales_force', 'customer_activities', 'customer_project_activities', 'atc_profile', 'requests', 'purchasing_cost', 'customer_received_date', 'hardware_design_report', 'project_finished_date', 'production_line_date', 'company_profile', 'employee_profile', 'warehouse_inout')) || $GLOBALS['user']['level'] == 1 || $GLOBALS['per']['full']) {
                                echo '<a class="btn btn-border btn-alt border-purple font-purple tooltip-link col-show-hide" href="javascript:;" data-placement="bottom" title="Display"><i class="glyph-icon icon-th-list"></i></a>';
                            }
                        }
                        if ($do == '' && in_array($act, array('digicats'))) {
                            ?>
                            <a class="nestable-menu btn btn-border btn-alt border-info font-blue tooltip-link disabled"
                               id="nestable-expand" href="#" style="display: none" data-placement="bottom"
                               title="Expand"><i class="glyph-icon icon-expand"></i></a>
                            <a class="nestable-menu btn btn-border btn-alt border-info font-blue tooltip-link"
                               id="nestable-collapse" href="#" style="display: none" data-placement="bottom"
                               title="Collapse"><i class="glyph-icon icon-compress"></i></a>
                            <?php
                        } else if ($act && !$do && check_module_do($act, 'del') && !in_array($act, array('user_att', 'data_logs', 'purchasing_report', 'purchasing_part_report', 'gross_revenue_per_staff', 'sales_report', 'sales_part_report', 'sales_revenue_per_staff', 'sales_force', 'customer_activities', 'customer_project_activities', 'requests', 'parts'))) {
                            if (isset($uri['deleted']) && $uri['deleted']) {
                                echo '<a class="loading btn btn-border btn-alt border-black font-black tooltip-link deletedView" href="' . site_url($act) . '" data-placement="bottom" title="Viewall"><i class="glyph-icon icon-undo"></i></a>';
                            } else {
                                echo '<a class="loading btn btn-border btn-alt border-red font-red tooltip-link deletedView" href="' . site_url($act) . '?deleted=1" data-placement="bottom" title="Deleted"><i class="glyph-icon icon-trash-o"></i></a>';
                            }
                        }
                        ?>
                    </div>
                    <div style="float: right; margin-top: -5px;">
                        <?php
                        if (($do == '' && !in_array($act, array('chi_nhanh', 'positions', 'bang_luong', 'stock_inout', 'stock_begin', 'products', 'interfaces', 'hscode', 'digicats', 'parts', 'price_accessing', 'business_trip_customer', 'sales_force', 'atc_profile', 'requests', 'invoice_management', 'invoice_management_sc', 'payment_management', 'supplier_payment_management', 'purchasing_cost'))) || ($do != '' && in_array($act, array('department_profile', 'pm_revenue_supplier', 'pr_per_staff')))) {
                            echo '<div style="width: 140px; float: right; margin: 0 10px;">';
                            echo 'Show ';
                            echo '<div style="display: inline-block; width: 55px;">' . form_dropdown('limit_perpage', $GLOBALS['limit_perpage'], $GLOBALS['var']['limit_perpage'], 'class="select-status" id="limit_perpage" style="height: 29px; border-color: #dfe8f1;"') . '</div>';
                            echo ' entries';
                            echo '</div>';
                        }
                        // entries month
                        if ($do == '' && in_array($act, array('invoice_management', 'invoice_management_sc', 'payment_management', 'supplier_payment_management', 'business_trip_customer', 'purchasing_cost', ''))) {
                            echo '<div style="width: 140px; float: right; margin: 0 10px;">';
                            echo 'Show ';
                            echo '<div style="display: inline-block; width: 45px;">' . form_dropdown('limit_time', $GLOBALS['limit_time'], $GLOBALS['var']['limit_time'], 'class="select-status" id="limit_time" style="height: 29px; border-color: #dfe8f1;"') . '</div>';
                            echo ' months';
                            echo '</div>';
                        }

                        if ($do == '' && in_array($act, array('sales_order','customer_purchase_order','warehouse_inout','purchase_order','pending_approval_po','po_late_remain_time', 'approved_po', 'late_approval_po',  'stock_begin', 'stock_import', 'stock_export', 'purchasing_report', 'purchasing_part_report', 'gross_revenue_per_staff', 'sales_report', 'sales_part_report', 'sales_revenue_per_staff', 'supplier_revenua_per_staff','supplier_purchase_order')) || ($do != '' && in_array($act, array('pm_revenue_supplier', 'pr_per_staff')))) {
                            echo '<select id="limit_year" class="select-status" style="width: 70px; height: 29px; float: left; margin-right: 5px; border-color: #dfe8f1;">';
                            for ($i = 2017; $i <= date('Y'); $i++) {
                                echo '<option value="' . $i . '"' . ($GLOBALS['var']['page_year'] == $i || !$GLOBALS['var']['page_year'] ? ' selected' : '') . '>' . $i . '</option>';
                            }
                            echo '</select>';
                        }
                        // /module invoice_management , invoice_management_sc
                        echo '<div class="pagination-wrap" style="display: inline-block">';
                        if (isset($page_list) && $page_list) {
                            echo $page_list;
                        }
                        echo '</div>';
                        ?>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <?php
            }
            $url_back = $this->input->get('data_back', true);
            if ($this->input->get('data_back', true)) {
                $data_back = $url_back;
            } else {
                if (isset($uri['active']) && $uri['active'] == 1) {
                    unset($uri['active']);
                }
                $data_back = site_url($act) . url_uri($uri);
            }
            if ((!empty($back_btn) && is_array($back_btn))) {
                $data_back = $back_btn[0];
            }
            ?>
            <input type="hidden" id="act" value="<?= $act ?>">
            <input type="hidden" id="do" value="<?= $do ?>">
            <input type="hidden" id="id" value="<?= $id ?>">
            <input type="hidden" id="back_url" value="<?= $data_back ?>">
            <input type="hidden" id="rowstart" value="<?= $GLOBALS['var']['rowstart'] ?>">
            <input type="hidden" id="deleted"
                   value="<?= (isset($uri['deleted']) && $uri['deleted'] ? $uri['deleted'] : 0) ?>">
