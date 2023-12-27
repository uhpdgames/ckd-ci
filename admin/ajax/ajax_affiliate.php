<?php

include "ajax_config.php";
global $_Affiliate;
global $d, $func, $config_base, $login_member;


$fags = 0;

if (!empty($_POST["id"]) && $id = $_POST["id"]) {
    $amount = $func->getRequest('amount');
    $received = $func->getRequest('received');
    $uid = $func->getRequest('uid');

    $log = array('$amount' => $amount, '$received' => $received, '$uid' => $uid);

    $data = array();

    if ($amount) {
        if (empty($uid)) {
            die("BẠN KHÔNG CÓ QUYỀN TRUY CẬP");
            return false;
        }


        /*$data['amount'] = $amount;
        $data['amount_received'] = $received;
        $data['user_id'] = $received; */

        $info = array(
            'status' => 1,
            'date_update' => date("Y-m-d H:i:s"),
        );

        $d->where('withdrawal_id', $id);
        if ($d->update('ref_withdrawal', $info)) {
            $my_money = $d->rawQueryOne('select balance from #_ref_wallet where user_id = ? ', array($uid));

            if ($my_money) {
                $current = $my_money['balance'];
            } else {
                $current = 0;
            }
            if ($current > 0) {
                $newBalance = $current - $amount;

                $d->where('user_id', $uid);
                if ($d->update('ref_wallet', array(
                    'balance' => $newBalance,
                ))) {
                    $fags = 1;
                } else {
                    $fags = 0;
                }
            }
        } else {
            $fags = 0;
        }

    }
}

echo $fags;