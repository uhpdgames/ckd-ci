<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cache extends MY_Controller
{
	private $html = '';

	function __construct()
	{
		parent::__construct();
	}


	function create()
	{
		$this->data['template'] = 'common/cache';
		$this->load->view('template', $this->data);
	}
}
