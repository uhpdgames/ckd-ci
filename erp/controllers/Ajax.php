<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ajax extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
      /*  if (!$this->input->is_ajax_request() && $this->uri->segment(2) != 'upload_image') {
            exit('No direct script access allowed');
        }*/
      //  if ($this->session->userdata('logged_in') != true) {
           // my_redirect();
       // }
        $this->load->model('fn_model', 'fn', true);
        $this->fn->load_config();
        $this->load->model('ajax_model', 'ajax', true);
    }

    public function index()
    {
        my_redirect();
    }

	public function ajax_status(){

		$id = $this->input->post('id', true);
		$table = $this->input->post('table', true);
		$loai = $this->input->post('loai', true);
		if(isset($id))
		{
			$d = $this->data['d'];
			$tmp = $d->rawQueryOne("select $loai from #_$table where id = ? limit 0,1",array($id));

			if($tmp[$loai]>0) $data[$loai] = 0;
			else $data[$loai] = 1;

			$d->where('id',$id);
			$d->update($table,$data);
			//$cache->DeleteCache();
		}
		echo 1;
		die;
	}

    public function taovanchuyen(){

        //include "ajax_config.php";

        $api = new API();
        $id = getRequest('id');

        $setting = $this->data['setting'];
        $optsetting = $this->data['optsetting'];
        $config = $this->data['config'];
        $d = $this->data['d'];
        $func = $this->data['func'];


        $order = $d->rawQueryOne("select * from #_order where id=?",array($id));
        $order_detail = $d->rawQuery("select * from #_order_detail where id_order=?",array($id));

        $data_tracking = array();
        $data_tracking['ORDER_NUMBER'] = $order['madonhang'];
        $data_tracking['GROUPADDRESS_ID'] = $config['shop']['groupaddressId'];
        $data_tracking['CUS_ID'] = $config['shop']['cusId'];
        $data_tracking['DELIVERY_DATE'] = date('d/m/Y H:i:s',time());
        $data_tracking['SENDER_FULLNAME'] = $setting['tenvi'];
        $data_tracking['SENDER_ADDRESS'] = $config['shop']['address'];
        $data_tracking['SENDER_PHONE'] = $config['shop']['phone'];
        $data_tracking['SENDER_EMAIL'] = $optsetting['email'];
        $data_tracking['SENDER_WARD'] = $config['shop']['wards_shop'];
        $data_tracking['SENDER_DISTRICT'] = $config['shop']['district_shop'];
        $data_tracking['SENDER_PROVINCE'] = $config['shop']['province_shop'];

        $data_tracking['RECEIVER_FULLNAME'] = $order['hoten'];
        $data_tracking['RECEIVER_ADDRESS'] = $order['diachi'];
        $data_tracking['RECEIVER_PHONE'] = $order['dienthoai'];
        $data_tracking['RECEIVER_EMAIL'] = $order['email'];
        $data_tracking['RECEIVER_DISTRICT'] = (int)$func->get_places_id('district',$order['district'],'district_id');
        $data_tracking['RECEIVER_PROVINCE'] = (int)$func->get_places_id('city',$order['city'],'province_id');

        $data_tracking['PRODUCT_NAME'] = $order_detail[0]['ten'];
        $data_tracking['PRODUCT_QUANTITY'] = (int)$order_detail[0]['soluong'];
        $data_tracking['PRODUCT_PRICE'] = (float)$order['tamtinh'];
        $data_tracking['PRODUCT_WEIGHT'] = (float)$order['khoiluong'];

        $data_tracking['PRODUCT_TYPE'] = 'HH';
        $data_tracking['ORDER_SERVICE'] = $order['ship_code'];
        $data_tracking['ORDER_SERVICE_ADD'] = "";
        $data_tracking['ORDER_VOUCHER'] = "";
       $data_tracking['MONEY_COLLECTION'] = @$order['tonggia'] ?? 0;


        $data_tracking['MONEY_TOTALFEE'] = 0;
        $data_tracking['MONEY_FEECOD'] = 0;
        $data_tracking['MONEY_FEEVAS'] = 0;
        $data_tracking['MONEY_FEEINSURRANCE'] = 0;
        $data_tracking['MONEY_FEE'] = 0;
        $data_tracking['MONEY_FEEOTHER'] = 0;
        $data_tracking['MONEY_TOTALVAT'] = 0;
        $data_tracking['MONEY_TOTAL'] = 0;

        $data_tracking['ORDER_PAYMENT'] = 2;

        $data_tracking['LIST_ITEM'] = array();
        foreach ($order_detail as $k => $v) {
            $data_detail = array();
            $data_detail['PRODUCT_NAME'] = $v['ten'];
            $data_detail['PRODUCT_PRICE'] = (!empty($v['giamoi']))?((float)$v['giamoi']):((float)$v['gia']);
            $data_detail['PRODUCT_WEIGHT'] = (float)$v['khoiluong'];
            $data_detail['PRODUCT_QUANTITY'] = (int)$v['soluong'];
            $data_tracking['LIST_ITEM'][] = $data_detail;
        }


        $orderData = json_encode($data_tracking,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        $tracking = $api->MainCreateOrder(12,$orderData,$config['data_key']);

        $dataTracking = json_decode($tracking,true);
        if($dataTracking['status']==200 && $dataTracking['error']==false){
            $json_order = array(
                'thuho'=>$order['tonggia'],
                'nguoitracuoi'=>$order['tonggia'],
                'khoiluong'=>$order['khoiluong'],
            );
            $update_order['id_tracking'] = $dataTracking['data']['ORDER_NUMBER'];
            $update_order['json_tracking'] = json_encode($dataTracking['data']);
            $update_order['json_order'] = json_encode($json_order);
            $update_order['tinhtrang'] = 3;
            $d->where('id', $id);
            $d->update('order',$update_order);
            echo json_encode(array('error'=>0,'mess'=>'Tạo vận đơn thành công!'));
        }else{
            echo json_encode(array('error'=>1,'mess'=>'Tạo vận đơn thất bại !'));
        }


    }

    function printbill()
    {
        $api = new API();
        $id_order = getRequest('id_order');
        $config = $this->data['config'];

        $response = $api->LinkPrintBill($id_order,$config['data_key']);
        echo json_encode(json_decode($response,true));
    }

    public function move_item()
    {
        $table = $this->input->post('table', true);
        $cat = $this->input->post('cat', true);
        $ids = $this->input->post('ids', true);
        $names = $this->input->post('names', true);
        if (!$table || !$ids || !$cat) {
            echo 0;
            return false;
        }
        $i = 0;
        foreach ($ids as $id) {
            $old_cat = get_data($table, 'id = "' . $id . '"', 'cat');
            $this->ajax->move_item($table, $id, $cat, isset($names[$i]) ? $names[$i] : '');
            $this->fn->update_numitem($old_cat, $table);
            $this->fn->update_numitem($cat, $table);
            $i++;
        }
        echo 1;
        return false;
    }

    public function del_restore_item()
    {
        $table = $this->input->post('table', true);
        $id = $this->input->post('id', true);
        $mode = $this->input->post('mode', true);
        if (!$table || !$id || !$mode || ($table == 'users' && $id == 1)) {
            echo 0;
            return false;
        }
        if (in_array($table, array('stock_begin', 'stock_import', 'stock_export'))) {
            $table = 'stock_inout';
        }
        if ($table == 'sales_order_online') {
            $table = 'sales_order';
        }
        if ($table == 'pending_approval_po' || $table == 'approved_po' || $table == 'late_approval_po' ||  $table == 'po_late_remain_time') {
            $table = 'purchase_order';
        }
        if ($mode == 'del' || $mode == 'remove') {
            if ($this->ajax->check_cat_child($table, $id) > 0) {
                echo 2;
                return false;
            }
        }
        if ($mode == 'remove') {
            if ($table == 'products') {
                $file = get_data($table, 'id = "' . $id . '"', 'img');
                @unlink(PRO . $file);
                @unlink(PRO . 'thumbs/' . $file);
                @unlink(PRO . 'gallery/' . $file);
                $file = get_data($table, 'id = "' . $id . '"', 'img_slider');
                @unlink(PRO . $file);
                @unlink(PRO . 'thumbs/' . $file);
                @unlink(PRO . 'gallery/' . $file);
                $images = json_decode(get_data($table, 'id = "' . $id . '"', 'images'));
                if (is_array($images) && count($images)) {
                    for ($i = 0; $i < count($images); $i++) {
                        @unlink(PRO . $images[$i]);
                        @unlink(PRO . 'thumbs/' . $images[$i]);
                        @unlink(PRO . 'gallery/' . $images[$i]);
                    }
                }
            }
        }
        $name = $this->input->post('name', true);
        $this->ajax->del_restore_item($table, $id, $mode, $name);
        if ($table == 'interfaces') {
            $cat = get_data($table, 'id = "' . $id . '"', 'cat');
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '-' . $cat . '.json', 'w'))) {
                $this->db->select('file, name_vn, name_en, url, des_vn, des_en, col, row, stock, leadtime, date_modified');
                $this->db->where('status', 1);
                $this->db->where('deleted', 0);
                $this->db->where('cat', $cat);
                $this->db->order_by('sort_order desc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if($table =='samples_campaign'){
            $this->db->where('idCampaign', $id);
            $this->db->delete('samples_campaign_details');
        }
        if ($table == 'cache_search') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->from('cache_search AS s');
                $this->db->select('s.keyword');
                $this->db->select('(SELECT COUNT(id) FROM cache_search WHERE keyword = CONCAT("", s.keyword, "") GROUP BY keyword) AS num', false);
                $this->db->where('s.active', 1);
                $this->db->where('s.deleted', 0);
                $this->db->order_by('num desc');
                $query = $this->db->get();
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'manufacturers') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('name_vn, name_en, keyword, url, image, char1, distributor, new');
                $this->db->where('active', 1);
                $this->db->where('deleted', 0);
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '-slider.json', 'w'))) {
                $this->db->select('keyword, image');
                $this->db->where('active', 1);
                $this->db->where('deleted', 0);
                $this->db->where('slider', 1);
                $this->db->order_by('order_slider desc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'digicats') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, parent, icon, item, active');
                $this->db->where('deleted', 0);
                $this->db->order_by('sort_order desc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'news_categories') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, parent, icon');
                $this->db->where('deleted', 0);
                $this->db->where('active', 1);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'news') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/applications_news.json', 'w'))) {
                $query = $this->db->query('SELECT id, name_vn, name_en, des_vn, des_en, keyword, img, (SELECT keyword FROM news_categories WHERE id = CONCAT("", cat, "")) AS catkey FROM `' . $table . '` WHERE `active` = 1 AND `deleted` = 0 AND `cat` IN (SELECT id FROM news_categories WHERE parent = ' . $GLOBALS['cfg']['applications_catid'] . ' AND active = 1 AND deleted = 0) ORDER BY id DESC LIMIT 5', false);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/research_development_news.json', 'w'))) {
                $query = $this->db->query('SELECT id, name_vn, name_en, des_vn, des_en, keyword, img, (SELECT keyword FROM news_categories WHERE id = CONCAT("", cat, "")) AS catkey FROM `' . $table . '` WHERE `active` = 1 AND `deleted` = 0 AND `cat` IN (SELECT id FROM news_categories WHERE parent = ' . $GLOBALS['cfg']['researchdevelopment_catid'] . ' AND active = 1 AND deleted = 0) ORDER BY id DESC LIMIT 5', false);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/faq-news.json', 'w'))) {
                $query = $this->db->query('SELECT id, name_vn, name_en, keyword FROM `news` WHERE `active` = 1 AND `deleted` = 0 AND `cat` = ' . $GLOBALS['cfg']['faq_catid'] . ' ORDER BY id DESC LIMIT 5', false);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'products_categories') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword');
                $this->db->where('deleted', 0);
                $this->db->where('active', 1);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'products') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $query = $this->db->query('SELECT id, name_vn, name_en, description, manufacturer_part_number, unit_price_usd, image, (SELECT keyword FROM products_categories WHERE id = CONCAT("", category, "")) AS catkey FROM `' . $table . '` WHERE `active` = 1 AND `deleted` = 0 ORDER BY id DESC LIMIT 10', false);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'menucats') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, chirld, icon');
                $this->db->where('active', 1);
                $this->db->where('deleted', 0);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        echo 1;
        return false;
    }

    public function change_config()
    {
        $keyword = $this->input->post('keyword', true);
        $value = $this->input->post('value', true);
        if (!$keyword) {
            echo 0;
            return false;
        }
        $this->ajax->change_config($keyword, $value);
        echo 1;
        return false;
    }

    public function change_status()
    {
        $table = $this->input->post('table', true);
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);
        $field = $this->input->post('field', true);
        if (!$table || !$id || !$field) {
            echo 0;
            return false;
        }
        $this->ajax->change_status($table, $id, $field, $status, 0);
        echo 1;
        return false;
    }


	public function update_data(){
		$table = $this->input->post('table', true);
		$id = $this->input->post('id', true);
		$file = $this->input->post('file', true);
		//$field = $this->input->post('fields', true);

		$data = $this->input->post();

		foreach ($data as $key=> &$item){
			if(empty($item) && $item !=0){
				unset($data[$key]);
			}
		}

		unset($data['table']);
		unset($data['id']);

		if(isset($data['start'])){
			$data['start'] = datetotime($data['start']);
		}
		if(isset($data['end'])){
			$data['end'] = datetotime($data['end']);
		}


		/*if (!$table || !$id || !$field) {
			echo 0;
			return false;
		}*/

		$this->ajax->change_fields($table, $id, $data);
		echo 1;

		return false;
	}

    public function delete_image()
    {
        $table = $this->input->post('table', true);
        $id = $this->input->post('id', true);
        $field = $this->input->post('field', true);
        if (!$table || !$id || !$field) {
            echo 0;
            return false;
        }
        if ($table == 'profile') {
            $table = 'users';
        }
        $file = get_data($table, 'id = "' . $id . '"', $field);
        @unlink(UPLDIR . $table . '/' . $file);
        @unlink(UPLDIR . $table . '/thumbs/' . $file);
        @unlink(UPLDIR . $table . '/gallery/' . $file);
        $this->ajax->delete_image($table, $id, $field);
        echo 1;
        return false;
    }

    public function sort_order()
    {
        $IDs = $this->input->post('IDs', true);
        $table = $this->input->post('table', true);
        $field = $this->input->post('field', true);
        $cat = $this->input->post('cat', true);
        $orderby = $this->input->post('orderby', true);
        $ordermode = strtolower($this->input->post('ordermode', true));
        $rowstart = $this->input->post('rowstart', true);
        if (!$table || !$IDs) {
            echo 0;
            return false;
        }
        $this->ajax->sort_order($table, $IDs, $field, $cat, $orderby, $ordermode, $rowstart);
        if ($table == 'interfaces') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '-' . $cat . '.json', 'w'))) {
                $this->db->select('file, name_vn, name_en, url, des_vn, des_en, col, row, stock, leadtime, date_modified');
                $this->db->where('status', 1);
                $this->db->where('deleted', 0);
                $this->db->where('cat', $cat);
                $this->db->order_by('sort_order desc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'manufacturers') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '-slider.json', 'w'))) {
                $this->db->select('keyword, image');
                $this->db->where('active', 1);
                $this->db->where('deleted', 0);
                $this->db->where('slider', 1);
                $this->db->order_by('order_slider desc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        echo 1;
        return false;
    }

    public function sort_nestable()
    {
        $data = json_decode($this->input->post('dataSort', true));
        $table = $this->input->post('tableSort', true);
        if ($table == 'products' || $table == 'news') {
            $table = $table . '_categories';
        }
        $this->sort_allnestable($table, $data);
        if ($table == 'digicats') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, parent, icon, item, active');
                $this->db->where('deleted', 0);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'news_categories') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, parent, icon');
                $this->db->where('deleted', 0);
                $this->db->where('active', 1);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'products_categories') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword');
                $this->db->where('deleted', 0);
                $this->db->where('active', 1);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        if ($table == 'menucats') {
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $table . '.json', 'w'))) {
                $this->db->select('id, name_vn, name_en, keyword, chirld, icon');
                $this->db->where('active', 1);
                $this->db->where('deleted', 0);
                $this->db->order_by('sort_order asc');
                $query = $this->db->get($table);
                fwrite($fp, json_encode($query->result()));
                fclose($fp);
            }
        }
        echo 1;
        return false;
    }

    public function sort_allnestable($table, $data, $parent = 0)
    {
        foreach ($data as $key => $val) {
            $this->ajax->sort_nestable($table, array('parent' => $parent, 'sort_order' => $key), $val->id);
            if (!empty($val->children)) {
                $this->sort_allnestable($table, $val->children, $val->id);
            }
        }
    }

    public function update_price()
    {
        $id = $this->input->post('id', true);
        $table = $this->input->post('table', true);
        $field = $this->input->post('field', true);
        if ($table == '') $table = 'products';
        if ($id > 0 && $field != '') {
            $price = $this->input->post('price', true);
            echo $this->ajax->update_price($id, $field, $table, $price);
            return false;
        } else {
            echo '';
            return false;
        }
    }

    public function check_code()
    {
        $id = $this->input->post('id', true);
        $code = $this->input->post('code', true);
        $table = $this->input->post('table', true);
        if ($table == 'sales_order_online') {
            $table = 'sales_order';
        }
        if ($table == 'stock_export' || $table == 'stock_import' || $table == 'stock_begin') {
            $table = 'stock_inout';
        }
        if (!$code || !$table) {
            echo 1;
            return false;
        }
        echo $this->ajax->check_code($code, $table, $id);
        return false;
    }

    public function ajax_upload_image()
    {
        $fileName = $this->input->post('fileName', true);
        $fileName = url_title(viet_decode($fileName), '-', true);
        $output_dir = $this->input->post('dir', true);
        $thumb_w = $this->input->post('thumb_w', true);
        $thumb_h = $this->input->post('thumb_h', true);
        $gallery_w = $this->input->post('gallery_w', true);
        $gallery_h = $this->input->post('gallery_h', true);
        if (isset($_FILES['myfile'])) {
            if ($fileName) {
                $ext = end(explode('.', $_FILES['myfile']['name']));
                $fileName = url_title(viet_decode(str_replace('.' . $ext, '', $fileName))) . '-' . microtime(true) . '.' . $ext;
            } else {
                $fileName = $_FILES['myfile']['name'];
            }
            @move_uploaded_file($_FILES['myfile']['tmp_name'], $output_dir . $fileName);
            $full_path = $output_dir . $fileName;
            if ($thumb_w) {
                make_thumb($full_path, $output_dir . 'thumbs/' . $fileName, $thumb_w, $thumb_h);
            }
            if ($gallery_w) {
                make_thumb($full_path, $output_dir . 'gallery/' . $fileName, $gallery_w, $gallery_h);
            }
            echo $output_dir . $fileName;
        }
    }

    public function upload_image()
    {
        header('Content-type: text/json');
        $output_dir = UPLDIR . 'images/';
        if (isset($_FILES['file'])) {
            $ext = end(explode('.', $_FILES['file']['name']));
            $fileName = 'image-' . microtime(true) . '.' . $ext;
            @move_uploaded_file($_FILES['file']['tmp_name'], $output_dir . $fileName);
            echo json_encode(array('link' => base_url() . $output_dir . $fileName));
        }
    }

    public function load_city()
    {
        $parent = $this->input->post('parent', true);
        $i = 0;
        $cities = $this->ajax->load_city($parent);
        if (is_array($cities) && count($cities)) {
            foreach ($cities as $data) {
                $obj[$i++] = $data;
            }
        }
        echo json_encode($obj);
    }    

    public function add_row()
    {
        $act = $this->input->post('act');
        $act = str_replace('_online', '', $act);
        $data = $this->input->post('data');
        echo $this->load->view($act . '/import_item', $data, true);
    }
    public function add_sub_row()
    {
        $act = $this->input->post('act');
        $act = str_replace('_online', '', $act);
        $data = $this->input->post('data');
        echo $this->load->view($act . '/inport_sub_item', $data, true);
    }
    public function access_file()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $file = $this->input->post('file', true);
        $activeSheet = $this->input->post('sheet', true);
        $this->load->library('php_excel');
        $objReader = PHPExcel_IOFactory::load($file);
        $objReader->setActiveSheetIndex($activeSheet ? $activeSheet : 0);
        $sheetData = $objReader->getActiveSheet()->toArray(null, true, true, true);
        if (is_array($sheetData) && count($sheetData)) {
            $i = 0;
            foreach ($sheetData as $row) {
                $j = 0;
                if ($i == 0) {
                    echo '<tr>';
                    foreach ($row as $col => $val) {
                        $columnLetter = PHPExcel_Cell::stringFromColumnIndex($j);
                        if ($j == 0) {
                            echo '<td class="excel-top"><div class="excel-angel"></div></td>';
                        }
                        echo '<td class="excel-top">' . $columnLetter . '</td>';
                        $j++;
                    }
                    echo '</tr>';
                }
                if ($i == 0) {
                    echo '<tr class="excel-selected excel-header">';
                } else {
                    echo '<tr>';
                }
                $j = 0;
                foreach ($row as $col => $val) {
                    $columnLetter = PHPExcel_Cell::stringFromColumnIndex($j);
                    if ($j == 0) {
                        echo '<td class="excel-left"><span>' . ($i + 1) . '</span></td>';
                    }
                    echo '<td data-label="' . $columnLetter . '" class="excel-cell" nowrap="nowrap">' . str_replace('&', '&amp;', $val) . '</td>';
                    $j++;
                }
                echo '</tr>';
                $i++;
            }
        }
    }

    public function process_file()
    {
        $file = $this->input->post('file', TRUE);
        $activeSheet = $this->input->post('sheet', TRUE);
        $startRow = $this->input->post('startRow', TRUE);
        $endRow = $this->input->post('endRow', TRUE);

        $proLE = $this->input->post('proLE', true);
        $usd_currency = $this->input->post('usd_currency', true);
        $proLE_arr = explode(',', $proLE);

        $folder_name = $this->input->post('act', true);
        $folder_name = str_replace('_online', '', $folder_name);

        $key = $this->input->post('key', TRUE) + 1;
        $selectSupplierPart = $this->input->post('selectSupplierPart', TRUE);
        $selectMfrPart = $this->input->post('selectMfrPart', TRUE);
        $selectDescription = $this->input->post('selectDescription', TRUE);
        $selectManufacturer = $this->input->post('selectManufacturer', TRUE);
        $selectPackageCase = $this->input->post('selectPackageCase', TRUE);
        $selectPackaging = $this->input->post('selectPackaging', TRUE);
        $selectStandardPackageQty = $this->input->post('selectStandardPackageQty', TRUE);
        $selectSPQPrice = $this->input->post('selectSPQPrice', TRUE);
        $selectOrderQuantity = $this->input->post('selectOrderQuantity', TRUE);
        $selectUnitPriceUSD = $this->input->post('selectUnitPriceUSD', TRUE);
		$selectBuyingPrice = $this->input->post('selectBuyingPrice', TRUE);
		$selectAvailabilityStock = $this->input->post('selectAvailabilityStock', TRUE);
        $selectDateCode = $this->input->post('selectDateCode', TRUE);
        $selectCountryOfOrigin = $this->input->post('selectCountryOfOrigin', TRUE);
        $selectCondition = $this->input->post('selectCondition', TRUE);
        $selectMultipleQuantity = $this->input->post('selectMultipleQuantity', TRUE);
        $selectMinimumQuantity = $this->input->post('selectMinimumQuantity', TRUE);
        $selectLeadtime = $this->input->post('selectLeadtime', TRUE);

        $this->load->library('php_excel');
        $objReader = PHPExcel_IOFactory::load($file);
        $objReader->setActiveSheetIndex($activeSheet ? $activeSheet : 0);
        $jsons = array(
            'update' => array(),
            'add' => array()
        );
        for ($i = $startRow; $i <= $endRow ; ++$i) {
            $data = array(
                'SupplierPart' => ($selectSupplierPart && $selectSupplierPart != -1 ? trim($objReader->getActiveSheet()->getCell($selectSupplierPart.$i)->getValue()) : ''),
                'MfrPart' => trim($objReader->getActiveSheet()->getCell($selectMfrPart.$i)->getValue()),
                'Description' => ($selectDescription && $selectDescription != -1 ? trim($objReader->getActiveSheet()->getCell($selectDescription.$i)->getValue()) : ''),
                'Manufacturer' => ($selectManufacturer && $selectManufacturer != -1 ? $objReader->getActiveSheet()->getCell($selectManufacturer.$i)->getValue() : ''),
                'PackageCase' => ($selectPackageCase && $selectPackageCase != -1 ? $objReader->getActiveSheet()->getCell($selectPackageCase.$i)->getValue() : ''),
                'Packaging' => ($selectPackaging && $selectPackaging != -1 ? $objReader->getActiveSheet()->getCell($selectPackaging.$i)->getValue() : ''),
                'StandardPackageQty' => ($selectStandardPackageQty && $selectStandardPackageQty != -1 ? $objReader->getActiveSheet()->getCell($selectStandardPackageQty.$i)->getCalculatedValue() : ''),
                'SPQPrice' => ($selectSPQPrice && $selectSPQPrice != -1 ? $objReader->getActiveSheet()->getCell($selectSPQPrice.$i)->getCalculatedValue() : ''),
                'OrderQuantity' => ($selectOrderQuantity && $selectOrderQuantity != -1 ? $objReader->getActiveSheet()->getCell($selectOrderQuantity.$i)->getCalculatedValue() : ''),
                'UnitPriceUSD' => ($selectUnitPriceUSD && $selectUnitPriceUSD != -1 ? $objReader->getActiveSheet()->getCell($selectUnitPriceUSD.$i)->getCalculatedValue() : ''),
				'BuyingPrice' => ($selectBuyingPrice && $selectBuyingPrice != -1 ? $objReader->getActiveSheet()->getCell($selectBuyingPrice.$i)->getCalculatedValue() : '0'),
				'AvailabilityStock' => ($selectAvailabilityStock && $selectAvailabilityStock != -1 ? $objReader->getActiveSheet()->getCell($selectAvailabilityStock.$i)->getCalculatedValue() : '0'),
                'DateCode' => ($selectDateCode && $selectDateCode != -1 ? $objReader->getActiveSheet()->getCell($selectDateCode.$i)->getValue() : ''),
                'OriginOfCountry' => ($selectCountryOfOrigin && $selectCountryOfOrigin != -1 ? $objReader->getActiveSheet()->getCell($selectCountryOfOrigin.$i)->getValue() : ''),
                'PROCondition' => ($selectCondition && $selectCondition != -1 ? $objReader->getActiveSheet()->getCell($selectCondition.$i)->getValue() : ''),
                'MultipleQuantity' => ($selectMultipleQuantity && $selectMultipleQuantity != -1 ? $objReader->getActiveSheet()->getCell($selectMultipleQuantity.$i)->getCalculatedValue() : ''),
                'MinimumQuantity' => ($selectMinimumQuantity && $selectMinimumQuantity != -1 ? $objReader->getActiveSheet()->getCell($selectMinimumQuantity.$i)->getCalculatedValue() : ''),
                'LeadtimeComments' => ($selectLeadtime && $selectLeadtime != -1 ? $objReader->getActiveSheet()->getCell($selectLeadtime.$i)->getCalculatedValue() : ''),
            );
            if ($data['SupplierPart'] == '') {
                $data['SupplierPart'] = $data['MfrPart'];
            }
            $data['vendor'] = $this->fn->show_options('suppliers', array('order_by' => 'id asc', 'field' => 'id, CompanyNameLo', 'val' => array('id', 'CompanyNameLo'), 'empty_val' => true));
            if (in_array($data['SupplierPart'], $proLE_arr)) {
                $data['usd_currency'] = $usd_currency;
                $jsons['update'][] = $data;
            } else {
                $cat = get_data('cache_parts', 'supplier_part = "' . $data['SupplierPart'] . '"', 'category');
                $row = get_data('digicat_' . $cat, 'supplier_part = "' . $data['SupplierPart'] . '"', '*');
                $data['key'] = $key;
                $data['usd_currency'] = $usd_currency;
                // $data['MfrPart'] = $data['SupplierPart'];
                $data['Image'] = '';
                $data['Stock'] = 0;
                if ($row) {
                    if ($data['SupplierPart'] == $row['supplier_part']) {
                        $data['Image'] = $row['image'];
                        $data['SupplierPart'] = utf8_encode($row['supplier_part']);
                        $data['MfrPart'] = utf8_encode($row['manufacturer_part_number']);
                        $data['Description'] = $data['Description'] == '' && isset($row['description']) ? utf8_encode($row['description']) : $data['Description'];
                        $data['Manufacturer'] = $data['Manufacturer'] == '' && isset($row['manufacturer']) ? utf8_encode($row['manufacturer']) : $data['Manufacturer'];
                        $data['UnitPriceUSD'] = $data['UnitPriceUSD'] == '' && !is_numeric($data['UnitPriceUSD']) ? utf8_encode($row['unit_price_usd']) : $data['UnitPriceUSD'];
                        // $data['LeadtimeComments'] = $data['LeadtimeComments'] == '' ? $row['leadtime'] : $data['LeadtimeComments'];
                        $data['PackageCase'] = $data['PackageCase'] == '' && isset($row['package_case']) ? utf8_encode($row['package_case']) : $data['PackageCase'];
                        $data['Packaging'] = $data['Packaging'] == '' && isset($row['packaging']) ? utf8_encode($row['packaging']) : $data['Packaging'];
                        $data['StandardPackageQty'] = $data['StandardPackageQty'] == '' && !is_numeric($data['StandardPackageQty']) ? $row['spq_quantity'] : $data['StandardPackageQty'];
                        $data['DateCode'] = $data['DateCode'] == '' && isset($row['date_code']) ? $row['date_code'] : $data['DateCode'];
                        $data['OriginOfCountry'] = $data['OriginOfCountry'] == '' && isset($row['coo']) ? $row['coo'] : $data['OriginOfCountry'];
                        $data['PROCondition'] = $data['PROCondition'] == '' && isset($row['condition']) ? $row['condition'] : $data['PROCondition'];
                        $data['MinimumQuantity'] = $data['MinimumQuantity'] == '' && isset($row['minimum_quantity']) ? $row['minimum_quantity'] : $data['MinimumQuantity'];
                        $data['Stock'] = $row['stock'];
                    }
                }
                $jsons['add'][] = $this->load->view($folder_name . '/import_item', $data, true);
                $key++;
            }
        }
        echo json_encode($jsons);
        unlink($file);
    }

    public function delete_fileupload()
    {
        $dir = UPLDIR;
        $newdir = $this->input->post('dir', true);
        $file = $this->input->post('file', true);
        if (!$file) {
            echo 0;
            return false;       
        }
        if ($newdir) {
            $dir = $newdir; 
        }
        if (file_exists($dir . $file)) {
            if (unlink($dir . $file)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        return false;
    }

    public function delete_file()
    {
        $file = $this->input->post('file', true);
        if (unlink($file)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function read_sheet()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $file = $this->input->post('file', true);
        if ($file && file_exists(UPLDIR . $file)) {
            $data = array();
            $this->load->library('php_excel');
            $objReader = PHPExcel_IOFactory::load(UPLDIR . $file);
            $data['sheets'] = $objReader->getSheetNames();
            $activeSheet = $this->input->post('sheet', true);
            $objReader->setActiveSheetIndex($activeSheet ? $activeSheet : 0);
            $data['sheetData'] = $objReader->getActiveSheet()->toArray(null, true, true, true);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
        exit;
    }

    public function upload()
    {
        $output_dir = $this->input->post('dir', true);
        if (isset($_FILES['myfile'])) {
            @move_uploaded_file($_FILES['myfile']['tmp_name'], $output_dir . $_FILES['myfile']['name']);
            echo $output_dir . $_FILES['myfile']['name'];
        }
    }

    public function imports()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$file = $this->input->post('file', true);

		if (!$file || !file_exists($file)) {
			echo 'Could not open import file for reading';
			exit;
		}
		$this->load->library('php_excel');
		$this->objPHPExcel = PHPExcel_IOFactory::load($file);
		$allSheetNames  = $this->objPHPExcel->getSheetNames();
		$respArr = array(
			'fileName' => $file,
			'allSheetNames' => $allSheetNames,
			);
		if (count($respArr) > 0) {
			echo json_encode($respArr);
		}
	}
    private function get_rate_ABC_bank(){
        $date = date('d/m/Y');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/getlan.jsp?cmd=EXCHANGE&txtngaynt='.$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);
        if ($content === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
            return 0;
        }

        $server_output = strip_tags(trim(curl_exec($ch)));
        $lan = max(explode("\t", $server_output));
        curl_setopt($ch, CURLOPT_URL, 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/exporttygiangoaite.jsp');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'txtngaynt=' . $date . '&lannt=' . $lan);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        $out = explode('<td class="bodertop txbody" align="right">', $server_output);
        if(!isset($out[3])) return 0;

        $rate = explode('</td>', $out[3]);
        $rate = str_replace(',', '', $rate[0]);
        return $rate;

    }
    private function get_rate_tygia(){
        $rate = 0 ;
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile('https://tygia.com.vn/ngan-hang/acb/');

        try {
            $table = $dom->getElementsByTagName('table');
            // get first table
            $tr = $table[0]->getElementsByTagName('tr');
            // get second row
            $td = $tr[1]->getElementsByTagName('td');
            // get fourth col
            $rate = $td[3]->textContent;
            $rate = str_replace(".","",$rate);
        } catch (\Throwable $th) {
            // $rate = 0;
        }
    
        return $rate;
    }
    private function get_rate_webgia(){
        $rate = 0;
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile('https://webgia.com/ty-gia/acb/');
        
        try {
            $table = $dom->getElementsByTagName('table');
            // get first table
            $tr = $table[0]->getElementsByTagName('tr');
            // get second row
            $td = $tr[1]->getElementsByTagName('td');
            // get fourth col
            $rate = $td[4]->textContent;
            $rate = str_replace(".","",$rate);
        } catch (\Throwable $th) {
            // $rate = 0;
        }
      
        return $rate;
    }
    public function usd_rates()
    {
        // // get rate on https://acb.com.vn
        // $rate = $this->get_rate_ABC_bank();
        // // get rate on https://tygia.com.vn/ngan-hang/acb/
        // if($rate==0) $rate =$this->get_rate_tygia();
        // // get rate on https://webgia.com/ty-gia/acb/
        // if($rate==0) $rate = $this->get_rate_webgia();
        $rate = $this->input->post('rate',true);
        
        if (is_numeric($rate)&&$rate!=0) {
            $this->db->update('config', array('value' => $rate), array('keyword' => 'usd_exchange_rate'));
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/config.json', 'w'))) {
                $this->db->select('keyword, value');
                $query = $this->db->get('config');
                $jsons = array();
                foreach ($query->result() as $val) {
                    $jsons[$val->keyword] = $val->value;
                }
                fwrite($fp, json_encode($jsons));
                fclose($fp);
            }
            echo number_format($rate);
        } else {
            echo 0;
        }
        
    }

    public function update_cols()
    {
        $file = $this->input->post('file', true);
        $column_options = $this->input->post('column_options', true);
        $this->db->update('modules', array('column_options' => json_encode($column_options)), array('file' => $file));
        echo json_encode($column_options);
    }

    public function get_info_with_id() {
        $id = $this->input->post('id', TRUE);
        $table = $this->input->post('table', TRUE);
        $act = '';
		$json_suppliers = $this->suppliers_with_staffID();
        $ci =& get_instance();
        if ($this->input->post('act', TRUE)) {
            $act = $this->input->post('act', TRUE);
        }
        $data = array();
        if ($id && $table) {
            $data = get_data($table, 'id = ' . $id . ' AND active = 1 AND deleted = 0', '*');
        }
        if ($act == 'rfq' || $act == 'customer_sales_contract' || $act == 'sales_order' || $act == 'business_trip_report' || $act == 'business_trip_customer' || $act == 'request_samples' || $act == 'request_potential_line_card' || $act == 'request_special_price' || $act == 'request_technical') {
            $ci->db->from('projects_customer AS pc');
            $ci->db->where('pc.CustomerAccount', $id);
            $ci->db->where('pc.RegistrationStatus != "Non-Approve" AND pc.active = 1 AND pc.deleted = 0');
            if ($GLOBALS['user']['level'] != 1) {
                $ci->db->select('pc.*, c.id AS cid, c.Fae');
                $ci->db->join('customers AS c', 'c.id = pc.CustomerAccount', 'left');
                $t = '';
                if (is_array($json_suppliers) && count($json_suppliers)) {
                    $end = end($json_suppliers);
                    foreach ($json_suppliers as $id) {
                        if ($end == $id) {
                            $t .= 'pc.Suppliers LIKE "%\"' . $id . '\"%"';
                        } else {
                            $t .= 'pc.Suppliers LIKE "%\"' . $id . '\"%" OR ';
                        }
                    }
                }
                $ci->db->where('(pc.`FaeStaff` like "%\"' . $GLOBALS['user']['id'] . '\"%" OR pc.`AccountOwner` = "' . $GLOBALS['user']['id'] . '" OR pc.`ChannelManager` like "%\"' . $GLOBALS['user']['id'] . '\"%" OR c.`Fae` like "%\"' . $GLOBALS['user']['id'] . '\"%" ' . ($t != '' ? ' OR ' . $t : '') . ')');
            }
            $query = $ci->db->get()->result_array();
            $data['project'] = json_encode($query);
        }
        if ($act == 'stock_import' || $act == 'stock_begin') {
            $ci->db->from('sales_contract_details AS o');
            $ci->db->select('o.*, po.CustomerID AS CUS, po.code AS PONo, cus.ContactName AS CUSName, cpo.code AS CPONo');
            $ci->db->where('o.SCID', $id);
            $ci->db->join('purchase_order AS po', 'po.id = o.po', 'left');
            $ci->db->join('customers AS cus', 'cus.id = po.CustomerID', 'left');
            $ci->db->join('customer_purchase_order AS cpo', 'cpo.id = o.cpo', 'left');
            $ci->db->order_by('o.SortOrder asc');
            $query = $ci->db->get();
            if ($query->num_rows() > 0) {
                $data['querypart'] = json_encode($query->result_array());
                // $data['querypart'] = str_replace('&', '&amp;', str_replace('\'', '&apos;', json_encode($query->result_array())));
            } else {
                $data['querypart'] = array();
            }
        }
        if ($act == 'stock_export') {
            $ci->db->from('customer_purchase_order AS o');
            $ci->db->select('p.*, o.id AS CPO, o.code AS CPONo');
            $ci->db->where('o.id', $id);
            $ci->db->join('customer_purchase_order_details AS p', 'p.CPOID = o.id', 'left');
            $query = $ci->db->get();

            if ($query->num_rows() > 0) {
              $data['querypart'] = json_encode($query->result_array());
//                 $data['querypart'] = str_replace('&', '&amp;', str_replace('\'', '&apos;', json_encode($query->result_array())));
            } else {
                $data['querypart'] = array();
            }
        }
        echo json_encode($data);
        return false;
    }

    public function suppliers_with_staffID() {
		$this->db->from('suppliers');
		$this->db->select('id');
		$this->db->where('active', 1);
		$this->db->where('deleted', 0);
		if ($GLOBALS['user']['level'] != 1) {
			$this->db->like('ChannelManager', $GLOBALS['user']['id']);
			$this->db->or_like('AccountOwner', $GLOBALS['user']['id']);
			$this->db->or_like('Marketing', $GLOBALS['user']['id']);
			$this->db->or_like('Purchaser', $GLOBALS['user']['id']);
			$this->db->or_like('Accountant', $GLOBALS['user']['id']);
			$this->db->or_like('Logistic', $GLOBALS['user']['id']);
		}
		$query = $this->db->get();
		if ($query->num_rows()) {
			$arrIDs = array();
			foreach ($query->result_array() as $row) {
				array_push($arrIDs, $row['id']);
			}
			if (is_array($arrIDs) && count($arrIDs)) {
				return $arrIDs;
			}
		}
	}
    
    public function get_shipping_customer() {
        $id = $this->input->post('id', TRUE);
        $shipping = $this->input->post('shipping', TRUE);
        if ($id && $shipping) {
            $data = get_data('customers', 'id = ' . $id . ' AND deleted = 0', '*');
            if ($shipping == $data['ShippingCarrier1']) {
                echo $data['ShippingAccountNumber1'];
            } else if ($shipping == $data['ShippingCarrier2']) {
                echo $data['ShippingAccountNumber2'];
            } else if ($shipping == $data['ShippingCarrier3']) {
                echo $data['ShippingAccountNumber3'];
            } else {
                echo 0;
            }
        }
        return false;
    }

    public function search_part()
    {
        $q = trim($this->input->post('q', true));
        if (!$q) {
            echo '';
            exit;
        }
        $data = array(
            'rows' => $this->fn->search_part($q)
            );
        $this->load->view('tmp/search_part', $data);
    }

    public function search_recommended()
    {
        $qp = trim($this->input->post('qp', true));
        if (!$qp) {
            echo '';
            exit;
        }
        $data = array(
            'rows' => $this->fn->part_rec_search($qp)
            );
        $this->load->view('tmp/search_recommended', $data);
    }

    public function check_field()
    {
        $field = $this->input->post('field', TRUE);
        $valfield = $this->input->post('valfield', TRUE);
        $table = $this->input->post('table', TRUE);
        $id = $this->input->post('id', TRUE);
        if ($table == 'sales_order_online') {
            $table = 'sales_order';
        }
        if (!$field || !$valfield || !$table) {
            echo 1;
            return false;
        }
        echo $this->ajax->check_filed($field, $valfield, $table, $id);
        return false;
    }

    public function get_price()
    {
        $part = $this->input->post('part', TRUE);
        $qty = $this->input->post('qty', TRUE);
        $data = $this->fn->search_part($part, true);
        if (is_array($data) && count($data)) {
            $priceUSD = $priceUSD = $data['price_1'];
            if ($data['quantity_2'] > 0 && $qty >= $data['quantity_2']) {
                $priceUSD = $data['price_2'];
            }
            if ($data['quantity_3'] > 0 && $qty >= $data['quantity_3']) {
                $priceUSD = $data['price_3'];
            }
            if ($data['quantity_4'] > 0 && $qty >= $data['quantity_4']) {
                $priceUSD = $data['price_4'];
            }
            if ($qty > $data['quantity_1'] && $qty > $data['quantity_2'] && $qty > $data['quantity_3'] && $qty > $data['quantity_4'] && $qty >= $data['quantity_5'] && $data['quantity_1'] < $data['quantity_2'] && $data['quantity_2'] < $data['quantity_3'] && $data['quantity_3'] < $data['quantity_4'] && $data['quantity_4'] < $data['quantity_5']) {
                $priceUSD = $data['price_5'];
            }
            echo $priceUSD;
        } else {
            echo 0;
        }
    }

    public function ajax_attachment()
    {
        $fileName = $this->input->post('fileName', true);
        $fileName = url_title(viet_decode($fileName), '-', true);
        $output_dir = $this->input->post('dir', true);
        if (isset($_FILES['myfile'])) {
            if (!$fileName) {
                $fileName = $_FILES['myfile']['name'];
            }
            $ext = end(explode('.', $fileName));
            $fileName = strtolower(url_title(viet_decode(str_replace('.' . $ext, '', $fileName))) . '-' . time(true)) . '.' . $ext;
            if (!is_dir($output_dir) && !mkdir($output_dir)) {
                mkdir($output_dir, 0777, true);
            }
            $full_path = $output_dir . '/' . $fileName;
            @move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path);
            echo $full_path;
        }
    }

    public function ajax_delete_attachment()
    {
        $id = $this->input->post('id', true);
        $dir = $this->input->post('dir', true);
        $file = $this->input->post('file', true);
        $att = $this->input->post('att', true);
        $table = $this->input->post('table', true);
        $attName = $this->input->post('attName', true);
        $arr = array();
        foreach ($att as $value) {
            array_push($arr, $value['value']);
        }
        if (($key = array_search($file, $arr)) !== false) {
            unset($arr[$key]);
        }

        if (file_exists($dir . '/' . $file)) 
        {
            unlink($dir . '/' . $file);
            $ci =& get_instance();
            if (in_array($table, array('request_technical_details'))) {
                $ci->db->where('did', $id);
            } else {
                $ci->db->where('id', $id);
            }
            if ($attName) {
                $ci->db->update($table, array($attName => json_encode($arr)));
            } else {
                $ci->db->update($table, array('Attachments' => json_encode($arr)));
            }
        }
    }

    public function delete_dir() {
        $name = $this->input->post('code', TRUE);
        $dirPath = TASKS . $name;
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function get_end_user_price() {
        $mfr_part = $this->input->post('mfr_part', true);
        $table = $this->input->post('table', true);
        $order_id = $this->input->post('order_id', true);
        if ($mfr_part == '' || $table == '' || $order_id == '') {
            return false;
        } else {
            // $order_id = get_data($table, 'code = "' . $order_id . '"', 'id');
            if ($order_id) {
                $arr = get_data($table . '_details', 'MfrPart = "' . $mfr_part . '" AND CPOID = ' . $order_id, '*');
                echo json_encode($arr);
            } else {
                echo 1;
            }
        }
    }

    public function submitEndUserPrice(){
        $arrPart = $this->input->post('arrPart');
        $arrKey = $this->input->post('arrKey');
        $table = $this->input->post('table', true);
        $field = $this->input->post('field', true);
        $order_id = $this->input->post('order_id', true);
        // $order_id = get_data($table, 'code = "' . $order_id . '"', 'id');
        $ci =& get_instance();
        $arrNew = array();
        if (is_array($arrPart) && count($arrPart)) {
            for($i = 0; $i < count($arrPart); $i++) {
                $ci->db->where($field, $order_id);
                $ci->db->where('MfrPart', $arrPart[$i]);
                $query = $ci->db->get($table . '_details');
                if ($query->num_rows() > 0) {
                    $data = $query->row_array();
                    $arrNew[$i]['itemKey'] = $arrKey[$i];
                    $arrNew[$i]['MfrPart'] = $data['MfrPart'];
                    $arrNew[$i]['EndUserPrice'] = $data['UnitPriceUSD'];
                    $arrNew[$i]['SellingAmount'] = $data['AmountUSD'];
                } else {
                    $arrNew[$i]['itemKey'] = 0;
                    $arrNew[$i]['MfrPart'] = '';
                    $arrNew[$i]['EndUserPrice'] = 0;
                    $arrNew[$i]['SellingAmount'] = 0;
                }
            }
        }
        echo json_encode($arrNew);
    }

    /*
    function: Part list with multi PO
    */
    public function pl_pos() {
        $arr = $this->input->post('arrID');
        $ci =& get_instance();
        $ci->db->from('purchase_order AS po');
        $ci->db->select('cpo.id AS cpoid, cpo.code AS cpo, po.code AS po, po.id AS poid, po.ImportMethod AS ImportMethod,pod.Image AS Image, pod.SupplierPart AS SupplierPart, pod.MfrPart AS MfrPart, pod.Description AS Description, pod.Manufacturer AS Manufacturer, pod.StandardPackageQty AS SPQ, pod.OrderQuantity AS Qty, pod.UnitPriceUSD AS Price, pod.LeadtimeComments AS DeliveryDate, pod.Stock AS Stock, pod.PackageCase AS PackageCase, pod.Packaging AS Packaging, pod.DateCode AS DateCode, pod.OriginOfCountry AS COO, pod.PROCondition AS PROCondition');
        $ci->db->where_in('po.id', $arr);
        $ci->db->join('purchase_order_details AS pod', 'pod.POID = po.id', 'left');
        $ci->db->join('customer_purchase_order AS cpo', 'cpo.id = po.CustomerPONo', 'left');
        $query = $ci->db->get();
        if($query->num_rows()) {
            echo json_encode($query->result_array());
        }
        return false;
    }

    /*
    function: Part list with multi SO
    */
    public function pl_so() {
        $arr = $this->input->post('arrID');
        $parts = get_data('sales_order_details', 'SalesOrderID = "' . $arr . '"', '**');
        if (is_array($parts) && count($parts)) {
            echo json_encode($parts);
        }
        return false;
    }

	public function get_supplier_with_staff() {
		$id = trim($this->input->post('id'));
		if (!$id) {
			echo 0;
			return false;
		}
		$suppliers = $this->ajax->get_supplier_with_staff($id);
		if (is_array($suppliers) && count($suppliers)) {
			echo json_encode($suppliers);
		} else {
			echo 0;
		}
		return false;
    }
    
    public function update_notify() {
        $id = $this->input->post('id', true);
        $this->fn->process(array('read'=>1), $id, 'notification');
        echo 1;
    }

    public function crm_update_sort() {
        $arrSort = $this->input->post('new_stt', true);
        if(is_array($arrSort) && count($arrSort)){
            foreach ($arrSort as $stt => $id){
                $this->fn->process(array('sort_order'=>$stt), $id, 'orders_status');
            }
        }
    }

    public function fetch_record()
    {
        $keyword = trim($this->input->post('keyword', true));
        $this->uri_arr['name'] = str_replace('&', '', $keyword);
        $keyword = url_title(viet_decode($keyword), '_', true);
        $detail = $this->db->select('*')->from('stock_inout_languages')->where('keyword', $keyword)->get()->row();
        $this->lng = $this->input->cookie('lng');
        if ($this->lng = 'en') {
            $arr['lng'] = $detail->en;
        }else{
            $arr['lng'] = $detail->vn;
        }
        $arr['keyword'] = $detail->keyword;
        $arr['vn'] = $detail->vn;
        $arr['en'] = $detail->en;
        echo json_encode($arr);
    }
    
    public function updatelng()
    {
        $keyword = $this->input->post('keyword');
        $enlng = $this->input->post('enlng');
        $vnlng = $this->input->post('vnlng');
        $this->db->where('keyword',$keyword)->update('stock_inout_languages',array('vn'=>$vnlng,'en'=>$enlng));
    }
}
