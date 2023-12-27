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

        $template = "affiliate/man/items";
        break;
    case "edit":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        get_item();
        $template = "user/man/item_add";
        break;
    case "save":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        save_item();
        break;
    case "delete":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        delete_item();
        break;
    case "config":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        get_setting();
        $template = "affiliate/setting/item_add";
        break;
    case "save_config":
        save_config();
        break;
    case "ref_withdrawal":
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        get_wallet();
        $template = "affiliate/wallet/items";
        break;
    case "":
    case "ref":
        $uid = (isset($_REQUEST['uid'])) ? htmlspecialchars($_REQUEST['uid']) : '';
        if (empty($uid)) {
            $func->transfer("Trang không tồn tại", "index.php", false);
        }

        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }

        get_ref();

        $template = "affiliate/ref/items";
        break;

    default:
        if (!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

        if ($func->check_permission()) {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        get_items();

        $template = "affiliate/man/items";
}

function get_wallet()
{
    global $d, $func, $curPage, $items, $paging, $config;

    $where = "";
    if (isset($_REQUEST['keyword'])) {
        $keyword = htmlspecialchars($_REQUEST['keyword']);
    }

    $uid = !empty($_REQUEST['uid']) ? $_REQUEST['uid'] : '';

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit " . $startpoint . "," . $per_page;
    $sql = "select r.*,
       m.ten,
       m.dienthoai,
       m.email 
    
from #_ref_withdrawal r 
join #_member m on m.id=r.user_id
 
where m.ref_nick = 1 and m.hienthi = 1
order by id desc, status $limit
";
    $items = $d->rawQuery($sql);

    $sqlNum = "select count(*) as 'num' from #_ref_withdrawal r 
    from #_ref_withdrawal r 
join #_member m on m.id=r.user_id join #_bank b on b.uid=r.user_id
where m.ref_nick = 1 and m.hienthi = 1
order by id desc";
    $count = $d->rawQueryOne($sqlNum);
    $total = $count['num'];
    $url = "index.php?com=affiliate&act=ref_withdrawal";
    $paging = $func->pagination($total, $per_page, $curPage, $url);
}

function get_ref()
{

    global $d, $func, $curPage, $items, $paging, $config;

    $where = " uid = ?";
    if (isset($_REQUEST['keyword'])) {
        $keyword = htmlspecialchars($_REQUEST['keyword']);
    }

    $uid = !empty($_REQUEST['uid']) ? $_REQUEST['uid'] : 0;

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit " . $startpoint . "," . $per_page;
    $sql = "select r.*, o.tinhtrang, o.madonhang, o.id as orderid from #_ref_order r join #_order o on o.id = r.order_id where $where order by id desc $limit";
    $items = $d->rawQuery($sql, array($uid));
    $sqlNum = "select count(*) as 'num' from #_ref_order r join #_order o on o.id = r.order_id where $where order by id desc";
    $count = $d->rawQueryOne($sqlNum, array($uid));
    $total = $count['num'];
    $url = "index.php?com=affiliate&act=ref&uid=" . $uid;
    $paging = $func->pagination($total, $per_page, $curPage, $url);

    return false;

    global $d, $func, $curPage, $items, $paging, $config;
    $where = "";

    $id = !empty($_GET['id']) ? $_GET['id'] : 0;

    if (isset($_REQUEST['keyword'])) {
        //$keyword = htmlspecialchars($_REQUEST['keyword']);
    }

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit " . $startpoint . "," . $per_page;
    // $sql = "select * from #_ref where $where order by date_create desc $limit";

    $sql = 'select o.*, r.* from #_ref_order o join #_ref r on r.id = o.ref_id where o.uid = ' . $id;
    $items = $d->rawQuery($sql);
    $sqlNum = 'select o.*, r.* from #_ref_order o join #_ref r on r.id = o.ref_id where o.uid = ' . $id;
    $count = $d->rawQueryOne($sqlNum);
    $total = $count['num'];
    $url = "index.php?com=affiliate&act=ref";
    $paging = $func->pagination($total, $per_page, $curPage, $url);


}

function get_setting()
{
    global $d, $item;

    $item = $d->rawQueryOne("select * from #_ref_config limit 0,1");
}

function save_config()
{
    if (empty($_POST)) {
        return false;
    }

    global $d, $func, $curPage;
    /* Post dữ liệu */
    $data = (isset($_POST['data'])) ? $_POST['data'] : null;
    if ($data) {
        foreach ($data as $column => $value) {
            $data[$column] = htmlspecialchars($value);
        }
    }

    $data['lv1'] = str_replace(',', '', $data['lv1']);
    $data['lv2'] = str_replace(',', '', $data['lv2']);
    $data['lv3'] = str_replace(',', '', $data['lv3']);

    $data['min_withdraw'] = str_replace(',', '', $data['min_withdraw']);
    $data['max_withdraw'] = str_replace(',', '', $data['max_withdraw']);
    $data['cit'] = str_replace(',', '', $data['cit']);
    $data['vat'] = str_replace(',', '', $data['vat']);

    $id = htmlspecialchars($_POST['id']);
    if ($id) {
        $d->where('id', $id);
        if ($d->update('ref_config', $data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=affiliate&act=config");
        else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=affiliate&act=config&p=" . $curPage, false);
    } else {
        if ($d->insert('ref_config', $data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=affiliate&act=config");
        else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=affiliate&act=config");
    }

    return false;
}

function get_items()
{
    global $d, $func, $curPage, $items, $paging, $config;

    $where = "";

    if (isset($_REQUEST['keyword'])) {
        $keyword = htmlspecialchars($_REQUEST['keyword']);
        $where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
    }

    $where .= " and ref_nick = 1";

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit " . $startpoint . "," . $per_page;
    $sql = "select * from #_member where id <> 0 $where order by stt,id desc $limit";
    $items = $d->rawQuery($sql);
    $sqlNum = "select count(*) as 'num' from #_member where id <> 0 $where order by stt,id desc";
    $count = $d->rawQueryOne($sqlNum);
    $total = $count['num'];
    $url = "index.php?com=affiliate&act=man";
    $paging = $func->pagination($total, $per_page, $curPage, $url);
}

/* Edit visitor */
function get_item()
{
    global $d, $func, $curPage, $item;

    $id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

    if (!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=affiliate&act=man&p=" . $curPage, false);

    $item = $d->rawQueryOne("select * from #_member where id = ? limit 0,1", array($id));

    if (!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=affiliate&act=man&p=" . $curPage, false);
}

function delete_item()
{
    global $d, $func, $curPage;

    $id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

    if ($id) {
        $d->rawQuery("delete from #_member where id = ?", array($id));
        $func->transfer("Xóa dữ liệu thành công", "index.php?com=affiliate&act=man&p=" . $curPage);
    } elseif (isset($_GET['listid'])) {
        $listid = explode(",", $_GET['listid']);

        for ($i = 0; $i < count($listid); $i++) {
            $id = htmlspecialchars($listid[$i]);
            $d->rawQuery("delete from #_member where id = ?", array($id));
        }

        $func->transfer("Xóa dữ liệu thành công", "index.php?com=affiliate&act=man&p=" . $curPage);
    }
    $func->transfer("Không nhận được dữ liệu", "index.php?com=affiliate&act=man&p=" . $curPage, false);
}

/* Save visitor */
function save_item()
{
    global $d, $func, $curPage;

    if (empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=affiliate&act=man&p=" . $curPage, false);

    $id = htmlspecialchars($_POST['id']);

    /* Post dữ liệu */
    $data = (isset($_POST['data'])) ? $_POST['data'] : null;
    if ($data) {
        foreach ($data as $column => $value) {
            $data[$column] = htmlspecialchars($value);
        }

        $data['ngaysinh'] = strtotime(str_replace("/", "-", $data['ngaysinh']));
        $data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
    }

    if ($id) {
        if ($func->check_permission()) {
            $row = $d->rawQueryOne("select id from #_member where id = ? limit 0,1", array($id));
            if (isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=affiliate&act=man&p=" . $curPage, false);
        }

        if (isset($data['password']) && ($data['password'] != '')) {
            $password = $data['password'];
            $confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : '';

            if ($confirm_password == '') {
                $func->transfer("Chưa xác nhận mật khẩu mới", "index.php?com=affiliate&act=edit&id=" . $id . "&p=" . $curPage, false);
            }

            if ($password != $confirm_password) {
                $func->transfer("Xác nhận mật khẩu mới không chính xác", "index.php?com=affiliate&act=edit&id=" . $id . "&p=" . $curPage, false);
            }

            $data['password'] = md5($password);
        } else unset($data['password']);

        $d->where('id', $id);
        if ($d->update('member', $data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=affiliate&act=man&p=" . $curPage);
        else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=affiliate&act=man&p=" . $curPage, false);
    } else {
        $username = isset($data['username']) ? $data['username'] : '';
        //$row = $d->rawQueryOne("select id from #_user where username = ? limit 0,1",array($username));
        $row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1", array($username));
        if (isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập nay đã tồn tại. Xin chọn tên khác", "index.php?com=affiliate&act=edit&id=" . $id . "&p=" . $curPage, false);

        if (isset($data['password']) && ($data['password'] == '')) $func->transfer("Chưa nhập mật khẩu", "index.php?com=affiliate&act=add&p=" . $curPage, false);
        $data['password'] = md5($data['password']);

        if ($d->insert('member', $data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=affiliate&act=man&p=" . $curPage);
        else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=affiliate&act=man&p=" . $curPage, false);
    }
}

/* Edit admin */
function edit()
{
    global $d, $func, $curPage, $item, $config, $login_admin;

    if (isset($_GET['changepass']) && ($_GET['changepass'] == 1)) $changepass = 1;
    else $changepass = 0;

    if (!empty($_POST)) {
        /* Post dữ liệu */
        $data = (isset($_POST['data'])) ? $_POST['data'] : null;
        if ($data) {
            foreach ($data as $column => $value) {
                $data[$column] = htmlspecialchars($value);
            }
        }

        if (isset($changepass) && $changepass == 1) {
            $old_pass = (isset($_POST['old-password'])) ? ($_POST['old-password']) : '';
            $new_pass = (isset($_POST['new-password'])) ? ($_POST['new-password']) : '';
            $renew_pass = (isset($_POST['renew-password'])) ? ($_POST['renew-password']) : '';

            if ($old_pass != '' || $new_pass != '' || $renew_pass != '') {
                if ($old_pass == '') $func->transfer("Mật khẩu cũ chưa nhập", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
                if ($new_pass == '') $func->transfer("Mật khẩu mới chưa nhập", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
                if ($renew_pass == '') $func->transfer("Chưa xác nhận mật khẩu mới", "index.php?com=affiliate&act=admin_edit&changepass=1", false);

                /* Lấy dữ liệu */
                $row = $d->rawQueryOne("select id, password from #_user where username = ? limit 0,1", array($_SESSION[$login_admin]['username']));

                if (isset($row['id']) && $row['id'] > 0) {
                    if ($row['password'] != md5($config['website']['secret'] . $old_pass . $config['website']['salt'])) $func->transfer("Mật khẩu không chính xác", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
                } else {
                    $func->transfer("Không nhận được dữ liệu", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
                }

                if ($new_pass != "") {
                    if ($new_pass == '123qwe' || $new_pass == '123456' || $new_pass == 'ninaco') $func->transfer("Mật khẩu bạn đặt quá đơn giãn, xin vui lòng chọn mật khẩu khác", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
                    $data['password'] = md5($config['website']['secret'] . $new_pass . $config['website']['salt']);
                    $flagchangepass = true;
                }
            } else {
                $func->transfer("Không nhận được dữ liệu", "index.php?com=affiliate&act=admin_edit&changepass=1", false);
            }
        } else {
            $username = $data['username'];
            $row = $d->rawQueryOne("select id from #_user where username <> ? and username = ? limit 0,1", array($_SESSION[$login_admin]['username'], $username));
            if (isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập này đã tồn tại", "index.php?com=affiliate&act=admin_edit", false);

            $data['ngaysinh'] = strtotime(str_replace("/", "-", $data['ngaysinh']));
        }

        $d->where('username', $_SESSION[$login_admin]['username']);
        if ($d->update('user', $data)) {
            if (isset($flagchangepass) && $flagchangepass == true) {
                session_unset();
                $func->transfer("Cập nhật dữ liệu thành công", "index.php");
            }
            $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=affiliate&act=admin_edit");
        } else {
            $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=affiliate&act=admin_edit");
        }
    }

    $item = $d->rawQueryOne("select * from #_user where username = ? limit 0,1", array($_SESSION[$login_admin]['username']));
}
