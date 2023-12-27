<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends MY_Controller
{
	private $html = '';
	function __construct($config = 'rest')
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

		parent::__construct($config);
		/*if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}*/

		$this->data['ajax'] = true;
	}

	public function html()
	{
		$text = array();
		$type = getRequest('type');

		if ($type) {
			$all_html = explode(',', $type);
			if (is_array($all_html) && count($all_html)) {
				foreach ($all_html as $file_html) {

					$file = $file_html;
					$int = (int)filter_var($file_html, FILTER_SANITIZE_NUMBER_INT);
					/*if ($int != '') {
						$file = 'banner/' . $int;
					}*/
					$template = 'common/' . $file;
					$html = htmlentities(str_replace("\r\n", "", $this->load->view($template, $this->data, true)), ENT_QUOTES, "UTF-8");
					$text[$file_html] = $html;
				}
			}
		}

		echo json_encode($text);


		return;
		$this->load->view($template . $type, $this->data);
		switch ($type) {
			case 'submenu':
				$this->load->view('common/menu', $this->data);
				break;
			case 'menu':
				$this->load->view('common/menu', $this->data);
				break;
		}

	}


}
