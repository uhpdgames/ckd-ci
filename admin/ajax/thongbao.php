<?php
	include "ajax_config.php";

	$dem = $d->rawQueryOne("select count(id) as sl from #_order where tinhtrang=1");
	echo $dem['sl'];

	//$data['thongbao'] = 0;
	//$d->update('order',$data);
?>