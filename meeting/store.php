<?php
require_once "./setup.php";

$meeting = [];
if (!empty($_POST)) {

    global $d;
    //echo"<pre>";
    //var_dump($_POST);die;

    $isadmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : '';

    $uid = isset($_POST['uid']) ? $_POST['uid'] : '';
    $id = isset($_POST['updated']) ? $_POST['updated'] : '';
    $data['meeting_content'] = isset($_POST['meeting_content']) ? htmlspecialchars($_POST['meeting_content']) : '';
    $data['attention'] = isset($_POST['attention']) ? (($_POST['attention'])) : '';
    $data['worked'] = isset($_POST['worked']) ? (($_POST['worked'])) : '';
    $data['work'] = isset($_POST['work']) ? (($_POST['work'])) : '';
    $data['date_created'] = isset($_POST['date']) ? date('y-m-d', strtotime(($_POST['date']))) : '';


    $data['top'] = isset($_POST['top']) ? (($_POST['top'])) : '';
    $data['keyword'] = isset($_POST['keyword']) ? (($_POST['keyword'])) : '';
    $data['note'] = isset($_POST['note']) ? (($_POST['note'])) : '';
    $note = $keyword = $top = '';
    if ($id != '') {
        $item = $d->rawQueryOne("select * from #_task where id = ? limit 1", array($id));
        if (!empty($item)) {

            if ($isadmin) {
                $myupdate = array(
                    'meeting_content' => $data['meeting_content'],
                );
            } else {
                $meeting = array(
                    'attention' => (array)json_decode($item['attention']),
                    'worked' => (array)json_decode($item['worked']),
                    'work' => (array)json_decode($item['work']),

                    'top' => (array)json_decode($item['top']),
                    'keyword' => (array)json_decode($item['keyword']),
                    'note' => (array)json_decode($item['note']),
                );

                $meeting['attention'][$uid] = $data['attention'][$uid];
                $meeting['worked'][$uid] = $data['worked'][$uid];
                $meeting['work'][$uid] = $data['work'][$uid];

                //$note = htmlspecialchars($data['note'][$uid]);
                //$keyword = htmlspecialchars($data['keyword'][$uid]);
                //$top = htmlspecialchars($data['top'][$uid]);
                $myupdate = array(
                    'meeting_content' => $item['meeting_content'],
                    'attention' => json_encode($meeting['attention']),
                    'worked' => json_encode($meeting['worked']),
                    'work' => json_encode($meeting['work']),

                    //'note' => json_encode($meeting['note']),
                    //'keyword' => json_encode($meeting['keyword']),
                    //'top' => json_encode($meeting['top']),
                );

            }

            $d->where('id', $id);
            if ($check = $d->update('task', $myupdate)) {
                echo 'Update';
            } else {
                echo "Not Save";
            }
        }
    } else {

        $save['attention'] = json_encode($data['attention']);
        $save['worked'] = json_encode($data['worked']);
        $save['work'] = json_encode($data['work']);
        $save['meeting_content'] = $data['meeting_content'];
        $save['date_created'] = isset($_POST['date']) ? date('y-m-d', strtotime(($_POST['date']))) : '';

        if ($check = $d->insert('task', $save)) {
            echo 'Save';
        } else {
            echo "Not Save";
        }
    }


    $savekey['top'] = isset($_POST['top']) ? (json_encode($_POST['top'])) : '';
    $savekey['date'] = isset($_POST['keyword']) ? (json_encode($_POST['keyword'])) : '';
    $savekey['note'] = isset($_POST['note']) ? (json_encode($_POST['note'])) : '';

    $d->where('id', 1);
    $d->update('task_keyword', $savekey);

} else {
    echo '0';
}
header('Location: ' . $config_base . "/meeting");