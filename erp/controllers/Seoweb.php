<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Seoweb extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->data['template'] = 'module/seoweb/index';
		$this->data['module'] = 'Seoweb';
	}

	function index()
	{

		$this->data['item'] = '';
		$this->load->view('all/template', $this->data);

	}



}
