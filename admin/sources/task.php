<?php
if(!defined('SOURCES')) die("Error");

switch($act) {
    case "todo":
        #if(isset($_SESSION[$login_admin]['active']) && $_SESSION[$login_admin]['active'] == true) $func->transfer("Trang không tồn tại", "index.php", false);

        $data = [];


        get_items();

        $template = "task/todo";
        break;

    case "man":

        get_items();

        $template = "task/man/items";
        break;

    case "add":
        /* Kiểm tra active user visitor */
        #if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        if($func->check_permission())
        {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        $template = "task/man/item_add";
        break;
    case "edit":
        /* Kiểm tra active user visitor */
        #if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        if($func->check_permission())
        {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }
        get_item();
        $template = "task/man/item_add";
        break;
    case "save":
        /* Kiểm tra active user visitor */
        save_item();
        break;
    case "delete":
        /* Kiểm tra active user visitor */
        #if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
        /*if($func->check_permission())
        {
            $func->transfer("Bạn không có quyền vào trang này", "index.php", false);
            exit;
        }*/
        delete_item();
        break;


    case "check":
        echo 'hi#';
        break;


}

function get_items()
{
    global $d, $func, $curPage, $items, $paging, $config;

    $where = "";

    if(isset($_REQUEST['keyword']))
    {
        $keyword = htmlspecialchars($_REQUEST['keyword']);
        $where .= " and (todo_name LIKE '%$keyword%' or ten LIKE '%$keyword%')";
    }

    $per_page = 10;
    $startpoint = ($curPage * $per_page) - $per_page;
    $limit = " limit ".$startpoint.",".$per_page;
    $sql = "select * from #_todo $where order by stt,id desc $limit";
    $items = $d->rawQuery($sql);
    $sqlNum = "select count(*) as 'num' from #_todo $where order by id desc";
    $count = $d->rawQueryOne($sqlNum);
    $total = $count['num'];
    $url = "index.php?com=task&act=man";
    $paging = $func->pagination($total,$per_page,$curPage,$url);
}
function get_item()
{
    global $d, $func, $curPage, $item;

    $id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

    if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=task&act=man&p=".$curPage, false);

    $item = $d->rawQueryOne("select * from #_todo where id = ? limit 0,1",array($id));

    if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=task&act=man&p=".$curPage, false);
}

function save_item()
{
    global $d, $func, $curPage;

    if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=task&act=man&p=".$curPage, false);

    $id = htmlspecialchars($_POST['id']);

    /* Post dữ liệu */
    $data = (isset($_POST['data'])) ? $_POST['data'] : null;
    if($data)
    {
        foreach($data as $column => $value)
        {
            $data[$column] = htmlspecialchars($value);
        }

        //$data['date'] = strtotime(str_replace("/","-",$data['date']));
    }

    if($id)
    {
        if($func->check_permission())
        {
            $row = $d->rawQueryOne("select id from #_todo where id = ? limit 0,1",array($id));
            if(isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=task&act=man&p=".$curPage, false);
        }

        $d->where('id', $id);
        if($d->update('todo',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=task&act=man&p=".$curPage);
        else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=task&act=man&p=".$curPage, false);
    }
    else
    {
        $data['date_create'] = date("Y-m-d H:i:s");
        if($d->insert('todo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=task&act=man&p=".$curPage);
        else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=task&act=man&p=".$curPage, false);
    }
}

function delete_item()
{
    global $d, $func, $curPage;

    $id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

    if($id)
    {
        $d->rawQuery("delete from #_todo where id = ?",array($id));
        $func->transfer("Xóa dữ liệu thành công", "index.php?com=task&act=man&p=".$curPage);
    }
    elseif(isset($_GET['listid']))
    {
        $listid = explode(",",$_GET['listid']);

        for($i=0;$i<count($listid);$i++)
        {
            $id = htmlspecialchars($listid[$i]);
            $d->rawQuery("delete from #_todo where id = ?",array($id));
        }

        $func->transfer("Xóa dữ liệu thành công","index.php?com=task&act=man&p=".$curPage);
    }
    $func->transfer("Không nhận được dữ liệu","index.php?com=task&act=man&p=".$curPage, false);
}

