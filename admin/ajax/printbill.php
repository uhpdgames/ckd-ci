<?php 
	include "ajax_config.php";
	$id_order = $_POST['id_order'];
	$response = $api->LinkPrintBill($id_order,$config['data_key']);
	echo json_encode(json_decode($response,true));
?>