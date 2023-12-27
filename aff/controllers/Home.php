<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{


	function __construct()
	{
		parent::__construct();

	}

	public function process()
	{
		$page = $this->session->flashdata('page');
		$stt = $this->session->flashdata('stt');
		$text = $this->session->flashdata('showtext');
		if (!empty($text)) {
			$this->load->view('common/transfer', array(
				'showtext' => $this->session->flashdata('showtext'),
				'stt' => $stt,
				'page_transfer' => $page == '' ? MYSITE_AFFILIATE : $page,
			));
		} else {
			redirect(site_url());
		}
	}

	public function index()
	{

		$this->data['template'] = 'sites/cong-tac-vien';
		$this->load->view('template', $this->data);
		// redirect(site_url('cong-tac-vien'));
		/*$this->data['template'] = 'cong-tac-vien';
		$this->load->view('template', $this->data);*/
	}

	public function Page404()
	{
		$this->load->view('404');
	}

	public function account()
	{
		echo '1';
		//redirect(site_url());
	}

	public function PageOff()
	{
		redirect(site_url());
	}

}
