<?php
if ( ! defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');
class Pages extends MY_Controller {


	public function view($page = 'debug')
	{

//		if( !file_exists(SHAREDVIEW .'pages/'.$page.'.php')){
//			show_404();
//		}


		$this->load->view('pages/' .$page, $this->data);
	}
}
