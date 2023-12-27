<?php 
	include "ajax_config.php";
	$data = $_POST['data'];
	$json_order = $_POST['json_order'];
	$id = $_POST['id'];


	echo '<pre>';
	var_dump($_POST);die;

	$sqlCache = "select * from #_setting";
    $setting = $d->rawQueryOne($sqlCache);
    $optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;

	$order = $d->rawQueryOne("select * from #_order where id=?",array($id));
	$order_detail = $d->rawQuery("select * from #_order_detail where id_order=?",array($id));

	$data_tracking['ORDER_NUMBER'] = $order['madonhang'];
	$data_tracking['GROUPADDRESS_ID'] = $config['shop']['groupaddressId'];
	$data_tracking['CUS_ID'] = $config['shop']['cusId'];
	$data_tracking['DELIVERY_DATE'] = date('d/m/Y H:i:s',time());
	$data_tracking['SENDER_FULLNAME'] = $setting['tenvi'];
	$data_tracking['SENDER_ADDRESS'] = $config['shop']['address'];
	$data_tracking['SENDER_PHONE'] = $config['shop']['phone'];
	$data_tracking['SENDER_EMAIL'] = $optsetting['email'];
	$data_tracking['SENDER_WARD'] = $config['shop']['wards_shop'];
	$data_tracking['SENDER_DISTRICT'] = $config['shop']['district_shop'];
	$data_tracking['SENDER_PROVINCE'] = $config['shop']['province_shop'];

	$data_tracking['RECEIVER_FULLNAME'] = $order['hoten'];
	$data_tracking['RECEIVER_ADDRESS'] = $order['diachi'];
	$data_tracking['RECEIVER_PHONE'] = $order['dienthoai'];
	$data_tracking['RECEIVER_EMAIL'] = $order['email'];
	$data_tracking['RECEIVER_DISTRICT'] = (int)$func->get_places_id('district',$order['district'],'district_id');
	$data_tracking['RECEIVER_PROVINCE'] = (int)$func->get_places_id('city',$order['city'],'province_id');

	$data_tracking['PRODUCT_NAME'] = $order_detail[0]['ten'];
	$data_tracking['PRODUCT_QUANTITY'] = (int)$order_detail[0]['soluong'];
	$data_tracking['PRODUCT_PRICE'] = (float)$order['tamtinh'];
	$data_tracking['PRODUCT_WEIGHT'] = (float)$order['khoiluong'];

	$data_tracking['PRODUCT_TYPE'] = 'HH';
	$data_tracking['ORDER_SERVICE'] = $order['ship_code'];
	$data_tracking['ORDER_SERVICE_ADD'] = "";
	$data_tracking['ORDER_VOUCHER'] = "";
	$data_tracking['MONEY_COLLECTION'] = (!empty($json_order['thuho'])) ? ((float)str_replace(",","",$json_order['thuho'])) : 0;

	$data_tracking['MONEY_TOTALFEE'] = 0;
	$data_tracking['MONEY_FEECOD'] = 0;
	$data_tracking['MONEY_FEEVAS'] = 0;
	$data_tracking['MONEY_FEEINSURRANCE'] = 0;
	$data_tracking['MONEY_FEE'] = 0;
	$data_tracking['MONEY_FEEOTHER'] = 0;
	$data_tracking['MONEY_TOTALVAT'] = 0;
	$data_tracking['MONEY_TOTAL'] = 0;

	if($json_order['nguoitracuoi'] == 1 ){
		$data_tracking['ORDER_PAYMENT'] = 2;
	}else{
		$data_tracking['ORDER_PAYMENT'] = 3;
	}

	$data_tracking['LIST_ITEM'] = array();
	foreach ($order_detail as $k => $v) {
		$data_detail = array();
		$data_detail['PRODUCT_NAME'] = $v['ten'];
		$data_detail['PRODUCT_PRICE'] = (!empty($v['giamoi']))?((float)$v['giamoi']):((float)$v['gia']);
		$data_detail['PRODUCT_WEIGHT'] = (float)$v['khoiluong'];
		$data_detail['PRODUCT_QUANTITY'] = (int)$v['soluong'];
		$data_tracking['LIST_ITEM'][] = $data_detail;
	}
	$orderData = json_encode($data_tracking,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	$tracking = $api->MainCreateOrder(12,$orderData,$config['data_key']);
	$dataTracking = json_decode($tracking,true);
	if($dataTracking['status']==200 && $dataTracking['error']==false){
		$update_order['id_tracking'] = $dataTracking['data']['ORDER_NUMBER'];
		$update_order['json_tracking'] = json_encode($dataTracking['data']);
		$update_order['json_order'] = json_encode($json_order);
		$update_order['tinhtrang'] = 3;
		$d->where('id', $id);
		$d->update('order',$update_order);
		echo json_encode(array('error'=>0,'mess'=>'Tạo vận đơn thành công!'));
	}else{
		echo json_encode(array('error'=>1,'mess'=>'Tạo vận đơn thất bại !'));
	}
	
?>
