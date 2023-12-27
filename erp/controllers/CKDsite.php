<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class CKDsite extends MY_Controller
{
	public $com;

	public function __construct()
	{
		parent::__construct();

		$this->com = 'ckdsite';
		$this->data['com'] = $this->com;

		$this->data['template'] = 'module/ckdsite/index';
		$this->data['module'] = 'ckdsite';
	}

	function index()
	{

		$this->data['item'] = '';


			//;get_data('coupons_cate', "code='register'", '*');


		$this->load->view('all/template', $this->data);

	}



}
