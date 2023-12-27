<?php
if (!defined('SOURCES')) die("Error");

switch ($act) {
    case "man":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        get_items();
        $template = "coupons/man/items";
        break;
}

function get_items()
{
    global $d, $func, $curPage, $items, $paging, $config;

    $where = "";

    if (isset($_REQUEST['keyword'])) {

    }

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit " . $startpoint . "," . $per_page;
    $sql = "select * from #_coupons order by id desc $limit";
    $items = $d->rawQuery($sql);
    $sqlNum = "select count(*) as 'num' from #_coupons";
    $count = $d->rawQueryOne($sqlNum);
    $total = $count['num'];
    $url = "#";
    $paging = $func->pagination($total, $per_page, $curPage, $url);
}
