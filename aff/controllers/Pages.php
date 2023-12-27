<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Pages extends MY_Controller
{


	function __construct()
	{
		parent::__construct();

	}

	public function view($page = 'static')
	{

		$com = $this->uri->segment(1);
		$this->data['url'] = $com;
		if (!file_exists(SHAREDVIEW . 'sites/' . $com . '.php')) {
			show_404();
		}


		$this->data['template'] = 'sites/' . $com;
		$this->load->view('template', $this->data);
	}
}
