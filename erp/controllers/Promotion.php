<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class promotion extends MY_Controller
{
    var $q = '';
    var $limit = '';
    var $time_from = '';
    var $time_to = '';
    var $orderby = '';
    var $ordermode = '';
    var $updated = '';
    var $failed = '';
    var $name = '';
    var $uri_arr = array();
    var $uri_str = '';
    var $site_url = '';
    var $status = '';

    public function __construct()
	{
		parent::__construct();

        //qq($GLOBALS['user']);
		$this->load->model('fn_model', 'fn', true);
		$this->fn->load_config();
	/*	if (check_rights() == false) {
			my_redirect();
		}*/
        $this->load->model('promotion_model', 'Mod', true);
		$this->q = trim($this->input->get('q', true));
		$this->rowstart = $this->input->get('rowstart', true);
		$this->time_from = $this->input->get('from', true);
		$this->time_to = $this->input->get('to', true);
		$this->orderby = $this->input->get('orderby', true);
		$this->ordermode = $this->input->get('ordermode', true);
		$this->updated = $this->input->get('updated', true);
		$this->failed = $this->input->get('failed', true);
		$this->name = $this->input->get('name', true);
		$this->uri_arr = array(
			'deleted' => $GLOBALS['var']['deleted'],
			'status' => $this->status,
			'q' => $this->q,
			'limit' => $this->limit,
			'from' => $this->time_from,
			'to' => $this->time_to,
			'rowstart' => $GLOBALS['var']['rowstart'],
			'orderby' => $this->orderby,
			'ordermode' => $this->ordermode
			);
		$this->uri_str = url_uri($this->uri_arr);
		$this->site_url = site_url($GLOBALS['var']['act']);
	}

	public function index()
	{
		$page_list = '';
		$data = array(
			'q' => $this->q,
			'rowstart' => $GLOBALS['var']['rowstart'],
			'orderby' => $this->orderby,
			'ordermode' => $this->ordermode,
			'site_url' => $this->site_url,
			'uri_str' => $this->uri_str,
			'rows' => $this->Mod->show($this->uri_arr),
			'page_list' => '',
			);
		$data['status'] = $this->fn->show_options('orders_status', array('key' => 'StatusKey', 'field' => 'StatusKey, name_vn', 'where' => 'active = 1 AND deleted = 0 AND type = "PO"'));
		$data['fields'] = $this->fn->module_fields('purchase_order');
		$data['cols'] = json_decode(get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'column_options'));
		if (!$data['cols']) {
			$data['cols'] = $data['fields'];
		}
		$header = array(
			'title' => module_title(),
			'add_link' => current_url() . '/update' . $this->uri_str,
			'search' => false,
			'page_list' => $page_list,
			'datetime_picker' => false,
			'submit_btn' => false,
			'cat_list' => false,
			'uri' => $this->uri_arr,
			'act' => $GLOBALS['var']['act'],
			'do' => $GLOBALS['var']['do'],
			'id' => $GLOBALS['var']['id'],
			'filter_cat' => $GLOBALS['var']['filter_cat']
			);
		$this->load->view('header', $header);
		$this->load->view($GLOBALS['var']['act'] . '/index', $data);
		$this->load->view('footer');
	}

	public function update($id = '') {
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            redirect($GLOBALS['var']['act']);
		}
        $methods =& get_instance();
        $info = $this->fn->info($id);
        $last_id = $this->db->query('SHOW TABLE STATUS LIKE "promotion"')->row(0)->Auto_increment;
        $info['code'] = $info['code'] ? $info['code'] : 'ATC-PROMO-' . str_pad($last_id, 4, 0, STR_PAD_LEFT).date('Y');
		$num_rows = $this->Mod->show_details($id, $this->uri_arr, true);
		$data = array(
            'updated' => $this->updated,
            'failed' => $this->failed,
            'name' => $this->name,
			'rowstart' => $GLOBALS['var']['rowstart'],
			'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
			'page_list' => page_list($num_rows, $this->uri_arr, 1),
            'info' => $info,
			'rows' => $this->Mod->show_details($id, $this->uri_arr),
            'orders_status' => get_data('orders_status', 'type = "promotion"', '**', '', '', 'sort_order DESC'),
			'methods' => $methods,);
        $header = array(
            'title' => get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'name_en'),
            'add_link' => '',
            'search' => true,
            'page_list' => '',
            'datetime_picker' => false,
            'submit_btn' => true,
            'cat_list' => array(),
            'uri' => $this->uri_arr,
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id'],
            'filter_cat' => $GLOBALS['var']['filter_cat']
        );
		$this->load->view('header', $header);
		$this->load->view($GLOBALS['var']['act'] . '/update', $data);
		$this->load->view('footer');
	}

	public function process()
	{
		if (!$_POST) {
			redirect();
		}
		$id = $this->input->post('id', true);
		if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
			redirect($GLOBALS['var']['act']);
		}
		$code = $this->input->post('code', TRUE);
		if (!token_validation() || !$code) {
			redirect($GLOBALS['var']['act']);
		}
		if ($code == '') {
			$last_id = $this->db->query('SHOW TABLE STATUS LIKE "promotion"')->row(0)->Auto_increment;
			$code = 'ATC-PROMO-' . str_pad($last_id, 4, 0, STR_PAD_LEFT).date('Y');
		}
		$data =  array(
			'user_modified' => $GLOBALS['user']['id'],
			'date_added' => date(TIME_SQL),
			'date_modified' => date(TIME_SQL)
			);
		$arrNumb = array('maximum_value_usd', 'maximum_value_vnd');
		foreach ($_POST as $key => $val) {
			if (!in_array($key, array('token', 'id'))) {
				if (is_array($_POST[$key])) {
					$data[$key] = json_encode($this->input->post($key, true));
				} else {
					$data[$key] = trim($this->input->post($key, true));
					if (in_array($key, $arrNumb)) {
                        $data[$key] = str_replace(',', '', trim($this->input->post($key, true)));
                    }
				}
			}
		}
		if (isset($data['products'])) {
			unset($data['products']);
		}
		if (!$data['expiry_date_from']) {
			$data['expiry_date_from'] = NULL;
		}
		if (!$data['expiry_date_to']) {
			$data['expiry_date_to'] = NULL;
		}
		if (!$data['quantity']) {
			$data['quantity'] = NULL;
		}
		$data['quantity_available'] = $data['quantity'];
		if (!$id) {
			$data['user_added'] = $GLOBALS['user']['id'];
		} else {
			$info = get_data('promotion', 'id = "' . $id . '"', '*');
			if (is_array($info) && count($info)) {
				$loss = $info['quantity'] - $info['quantity_available'];
				$data['quantity_available'] = $data['quantity'] - $loss;
				if ($data['quantity_available'] < 0) $data['quantity_available'] = 0;
				if ($data['quantity'] == NULL) $data['quantity_available'] = NULL;
			}
		}
		if ($update_id = $this->fn->process($data, $id, '', 'code')) {
			$this->uri_arr['updated'] = 1;
			if ($id && ($data['type'] == 2 || $data['type'] == 4)) {
				$this->db->query('DELETE FROM promotion_details WHERE parent = "' .  $id . '"');
			}
		} else {
			$this->uri_arr['failed'] = 1;
		}
		$this->uri_arr['t'] = time();
		if ($id > 0) {
			my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
		} else {
			my_redirect($GLOBALS['var']['act'] . url_uri($this->uri_arr));
		}
	}

	public function get_category()
    {
        $part = trim($this->input->post('supplier_part', true));
        if (!$part) {
            echo '';
            exit;
        }
        $data = array();
        $data = transutf8($this->fn->search_part($part, true));
        if (is_array($data) && count($data)) {
            echo json_encode($data);
        } else {
            echo 0;
        }
	}

	public function import_row() {
		$parent = $this->input->post('parent');
		$supplier_part = $this->input->post('supplier_part');
		$manufacturer_part_number = $this->input->post('manufacturer_part_number');
        if (!$supplier_part || !$manufacturer_part_number) {
            echo 0;
            exit;
		}
		$data_import = array(
			'user_modified' => $GLOBALS['user']['id'],
			'date_modified' => date(TIME_SQL),
		);
		foreach ($_POST AS $key => $value) {
			$data_import[$key] = $value;
		}
		if (!$data_import['id']) {
			$data_import['user_added'] = $GLOBALS['user']['id'];
			$data_import['date_added'] = date(TIME_SQL);
		}
		$sort_order = get_data('promotion_details', 'parent = "' . $parent . '" ORDER BY `sort_order` DESC', 'sort_order');
		$data_import['sort_order'] = $sort_order + 1;
		$data_import['available'] = $data_import['quantity'] > 0 ? 1 : 0;
        $data = transutf8($this->fn->search_part($supplier_part, true));
        if (is_array($data) && count($data)) {
			$data_import['category'] = $data['category'];
			$data_import['image'] = $data['image'];
			if ($return_id = $this->fn->process($data_import, '', 'promotion_details')) {
				$data_import['id'] = $return_id;
				echo json_encode($data_import);
			}
        } else {
            echo 0;
        }
	}
	
	public function check_part_update() {
        $id = $this->input->post('id');
        $supplier_part = $this->input->post('supplier_part');
        if (!$id || $supplier_part == '') {
            echo 0;
            return false;
        }
        $part_exist_promotion = get_data('promotion_details', 'parent = "' . $id . '" AND supplier_part = "' . $supplier_part . '"', '*');
        if ($part_exist_promotion > 0) {
            echo json_encode($part_exist_promotion);
        } else {
            $data = transutf8($this->fn->search_part($supplier_part, true));
            if (is_array($data) && count($data)) {
                echo json_encode($data);
            } else {
                echo 0;
            }
        }
        return false;
    }

    public function create_coupon_code() {
        $code = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8));
        echo $code;
        return false;
    }
    
    public function update_row() {
        if (!$_POST) {
            echo 0;
        } else {
			$data = array(
				'user_modified' => $GLOBALS['user']['id'],
				'date_modified' => date(TIME_SQL),
			);
			foreach($_POST AS $key => $value) {
				$data[$key] = $value;
			}
			if (!$data['id']) {
				// $data['quantity_available'] = $data['quantity'];
				$data['user_added'] = $GLOBALS['user']['id'];
				$data['date_added'] = date(TIME_SQL);
			}
			$id = $data['id'];
			$data['sort_order'] = $data['sort_order'] + $data['rowstart'];
			unset($data['id']);
			unset($data['rowstart']);
			// if (is_numeric($data['quantity']) && $data['quantity'] > 0 && $data['quantity_available'] > 0) {
			// 	$data['available'] = 1;
			// } else {
			// 	$data['quantity'] = 0;
			// 	$data['available'] = 0;
			// }
            if ($return_id = $this->fn->process($data, $id, 'promotion_details')) {
				echo json_encode(get_data('promotion_details', 'id = "' . $return_id . '"', '*'));
            }
        }
        return false;
    }

}

/* End of file promotion.php */
/* Location: ./application/controllers/promotion.php */
