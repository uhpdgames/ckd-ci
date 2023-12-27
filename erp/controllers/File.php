<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class File extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();


	}

	public function index(){


		$this->load->view('all/file', $this->data);
	}

	function elfinder_init()
	{
		$this->load->helper('general_helper');
		$opts = initialize_elfinder();
		$this->load->library('elfinder_lib', $opts);
	}

}
