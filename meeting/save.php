<?php
/*
back up
$today = date('Y-m-d');
$meeting = [];

define('LIBRARIES', '../libraries/');
/* Config */
require_once LIBRARIES . "config.php";
require_once LIBRARIES . 'autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);

function goto_url()
{
    $page = '/meeting';
    $sec = "0";
    header("Refresh: $sec; url=$page");
}

if (!empty($_POST)) {


    $isadmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : '';

    $uid = isset($_POST['uid']) ? $_POST['uid'] : '';
    $data['id'] = isset($_POST['updated']) ? $_POST['updated'] : '';
    $data['meeting_content'] = isset($_POST['meeting_content']) ? $_POST['meeting_content'] : '';
    $data['attention'] = isset($_POST['attention']) ? (($_POST['attention'])) : '';
    $data['worked'] = isset($_POST['worked']) ? (($_POST['worked'])) : '';
    $data['work'] = isset($_POST['work']) ? (($_POST['work'])) : '';
    $data['date_created'] = $today;

    if (!empty($data['id'])) {
        $item = $d->rawQueryOne("select * from #_task where id = ? limit 1", array($data['id']));
        if (!empty($item)) {

            if($isadmin){
                $myupdate= array(
                    'meeting_content' => $data['meeting_content'],
                );
            }else{
                $meeting = array(
                    'attention' => (array)json_decode($item['attention']),
                    'worked' => (array)json_decode($item['worked']),
                    'work' => (array)json_decode($item['work']),
                );

                $meeting['attention'][$uid] = $data['attention'][$uid];
                $meeting['worked'][$uid] = $data['worked'][$uid];
                $meeting['work'][$uid] = $data['work'][$uid];
                $myupdate = array(
                    'meeting_content' => $item['meeting_content'],
                    'attention' => json_encode($meeting['attention']),
                    'worked' => json_encode($meeting['worked']),
                    'work' => json_encode($meeting['work']),
                );

            }

            if ($check = $d->update('task', $myupdate)) {
                echo 'Update';
            } else {
                echo "Not Save";
            }
        }

    } else {

        if ($check = $d->insert('task', $data)) {
            echo 'Save';
        } else {
            echo "Not Save";
        }
    }
    goto_url();

} else {
    echo 'hi you!';
}


?>