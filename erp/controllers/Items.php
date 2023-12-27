<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Items extends MY_Controller
{
	public $com;

	public function __construct()
	{
		parent::__construct();


		$this->data['template'] = 'module/items/index';
		$this->data['module'] = 'Sản phẩm';
	}

	function index()
	{
		$sql = "select * from #_product where masp <>'' order by stt,id desc";
		$items = $this->data['d']->rawQuery($sql);


		$this->data['items'] = $items;
		$this->load->view('all/template', $this->data);
	}
}
