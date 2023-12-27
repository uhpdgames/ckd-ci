<?php

use html\taskss\system\core\CI_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Requests_for_advance extends CI_Controller
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
        $this->load->model('fn_model', 'fn', true);
        $this->load->model('requests_for_advance_model', 'Mod', true);
        $this->fn->load_config();
        if (check_rights() == false) {
            my_redirect();
        }
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
        $num_rows = $this->Mod->show($this->uri_arr, true);
        $page_list = page_list($num_rows, $this->uri_arr);

        $data = array(
            'q' => $this->q,
            'rowstart' => $GLOBALS['var']['rowstart'],
            'orderby' => $this->orderby,
            'name' => $this->name,
            'updated' => $this->updated,
            'failed' => $this->failed,
            'ordermode' => $this->ordermode,
            'site_url' => $this->site_url,
            'uri_str' => $this->uri_str,
            'rows' => $this->Mod->show($this->uri_arr),
            'page_list' => $page_list,

            'title_table' => get_data('modules', "file = 'requests_for_advance'", 'name_en')
        );
        $data['ModeOf'] = get_data('option_items_keynum', 'Field = "ModeOfRequest" AND active = 1 AND deleted = 0', 'Options');
        $data['StaffNumber'] = $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'val' => array('id', 'fullname')));
        $data['Department'] = $this->fn->show_options('departments', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn')));
        $data['position'] = $this->fn->show_options('positions', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn')));
        $data['status'] = $this->fn->show_options('orders_status', array('key' => 'StatusKey', 'field' => 'StatusKey, name_vn', 'where' => 'active = 1 AND deleted = 0 AND type = "PurchaseRequest"'));
        $data['fields'] = $this->fn->module_fields($GLOBALS['var']['act']);
        $data['cols'] = json_decode(get_data('modules', 'file = "' . $GLOBALS['var']['act'] . '"', 'column_options'));
        $temp = json_decode(get_data('option_items_keynum', 'Field = "ModeOfRequest"', 'Options'));
        $ModeOfsel = array('' => 'Select...');
        if (is_array($temp) && count($temp)) {
            $ModeOfsel = array('' => "Select..");
            foreach ($temp as $val) {
                $ModeOfsel[(int)$val->key] = (string)$val->name;
            }
        }
        $data['ModeOfRequest'] = $ModeOfsel;
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

    public function update($id = '')
    {
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) my_redirect($GLOBALS['var']['act']);
        $info = $this->fn->info($id);
        $arrreq = $this->Mod->checkd_requests($info['purchaseRequest']);
        $comma_req = implode(",", $arrreq);
        $comma_req ? $comma_req = 'AND id  not in (' . $comma_req . ')' : $comma_req = '';
        $last_id = $this->db->query('SHOW TABLE STATUS LIKE "requests_for_advance"')->row(0)->Auto_increment;
        $info['code'] = $info['code'] ? $info['code'] : 'YCTU ' . date('dmY') . '_' . $last_id;

        $data = array(
            'updated' => $this->updated,
            'failed' => $this->failed,
            'name' => $this->name,
            'info' => $info,
            'info1' => $this->fn->info($info['purchaseRequest'], 'purchase_request'),
            'rows' => get_data('purchase_request_details', 'CPOID = "' . $info['purchaseRequest'] . '" AND CPOID != 0', '**', '', '', 'SortOrder asc'),
            'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
            'Company' => $this->fn->show_options('company_info', array('order_by' => 'CompanyName asc', 'field' => 'id, CompanyName', 'val' => array('id', 'CompanyName'), 'empty_val' => true)),
            'orders_status' => get_data('orders_status', 'type = "PurchaseRequest"', '**', '', '', 'sort_order DESC'),
            'signing_approval1' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'where' => 'signing_approval = 2', 'val' => array('id', 'fullname'))),
            //'signing_approval3' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname','where' => 'signing_approval = 3', 'val' => array('id', 'fullname'))),
            // 'signing_approval4' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname','where' => 'signing_approval = 4', 'val' => array('id', 'fullname'))),
            'suppliers' => $this->fn->show_options('suppliers', array('order_by' => 'CompanyNameLo asc', 'where' => 'TypeOfSupplier = "Local" AND active = 1 AND deleted = 0 AND BusinessType LIKE \'%1%\'','field' => 'id, CompanyNameLo', 'val' => array('id', 'CompanyNameLo'), 'empty_val' => true)),
            'Leader' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'where' => 'level = 2 AND type != 2 and active=1 and deleted=0 and part=' . $GLOBALS['user']['part'], 'val' => array('id', 'fullname'), 'empty_val' => true)),
            'Manager' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'where' => 'level = 6 AND type != 2 AND  active=1 and deleted=0 and part=' . $GLOBALS['user']['part'], 'val' => array('id', 'fullname'), 'empty_val' => true)),
            'purchase_request' => $this->fn->show_options('purchase_request', array('order_by' => 'Code asc', 'field' => 'id, Code', 'where' => 'Status = 1 AND deleted=0 and active=1', 'val' => array('id', 'Code'), 'empty_val' => true)),
            'users' => $this->fn->show_options('users', array('order_by' => 'fullname asc', 'field' => 'id, fullname', 'val' => array('id', 'fullname'), 'empty_val' => true)),
            'position' => $this->fn->show_options('positions', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn'), 'empty_val' => true)),
            'departments' => $this->fn->show_options('departments', array('order_by' => 'name_vn asc', 'field' => 'id, name_vn', 'val' => array('id', 'name_vn'), 'empty_val' => true)),
            'limit_month' => $this->Mod->payment_request_month_total(!$id ? 0 : $info['Director_sign']),
            'advance_limit_month' => $this->Mod->advance_request_month_total(!$id ? 0 : $info['Director_sign']),
        );
        $header = array(
            'title' => module_title(),
            'submit_btn' => true,
            'search' => false,
            'uri' => $this->uri_arr,
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id']
        );
        $this->load->view('header', $header);
        /*todo Set Info [last id] */
        $localhost = $_SERVER['SERVER_NAME']==='localhost' ? 1 : 62;
        if (empty($info['id']) || $info['id'] > $localhost) {
            $this->load->view($GLOBALS['var']['act'] . '/update', $data);
        } else {
            $this->load->view($GLOBALS['var']['act'] . '/update_old', $data);
        }
        $this->load->view('footer');
    }

    public function process()
    {
        if (!$_POST) {
            my_redirect();
        }
        $id = $this->input->post('id', true);

        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            redirect($GLOBALS['var']['act']);
        }
        //	$advances = ;
        //get_data('users', 'id = "' . $GLOBALS['user']['id'] . '"', 'user_advances_vnd','','','');
        //print_r($advances);
        //die();
        $last_id = $this->db->query('SHOW TABLE STATUS LIKE "requests_for_advance"')->row(0)->Auto_increment;
        $Code1 = 'TU' . date('dmY') . '_' . $last_id;
        $data = array();
        if (!$id) {
            $data['code'] = $Code1;
            // $data['StaffNumber'] = $GLOBALS['user']['id'];
            //$data['Department'] = $GLOBALS['user']['part'];
            //	$data['position'] = $GLOBALS['user']['position'];
            $data['Status'] = 2;
            $data['date_added'] = date(TIME_SQL);
            $data['user_added'] = $GLOBALS['user']['id'];
        } else {
            $data['code'] = get_data('requests_for_advance', 'id =' . $id, 'code');
            $data['user_modified'] = $GLOBALS['user']['id'];
            $data['date_modified'] = date(TIME_SQL);
        }
        $pp = array();
        if (!empty($_POST['pp'])) {
            $pp = $_POST['pp'];
            unset($_POST['pp']);
        }
        if (!empty($_POST['ppvn'])) {
            
            $ppvn = $_POST['ppvn'];
            unset($_POST['ppvn']);
        }

        foreach ($_POST as $key => &$val) {
            if (!in_array($key, array('token', 'id'))) {
                $data[$key] = trim($this->input->post($key, true));
                $data['AmountVND'] == '' ? '' : $data['AmountVND'] = str_replace(',', '', trim($this->input->post('AmountVND', true)));
               // $data['BuyingPricevn'] == '' ? '' : $data['BuyingPricevn'] = str_replace(',', '', trim($this->input->post('BuyingPricevn', true)));
            }
        }
        if ($update_id = $this->fn->process($data, $id, '', 'code')) {
            $data1['user_advances_vnd'] = $this->Mod->advance_request_month($GLOBALS['user']['id']);
            $this->db->where('id', $GLOBALS['user']['id']);
            $this->db->update('users', $data1);
            foreach ($pp as $p) {
                $this->db->where('id', $p['id']);
            }
            foreach ($ppvn as $p1) {
                $this->db->where('id', $p1['id']);
                $this->db->update('purchase_request_details', array('BuyingPricevn' =>  str_replace(',', '',trim($p1['buyvn']))));
            }
            $this->uri_arr['updated'] = 1;
        } else {
            $this->uri_arr['failed'] = 1;
        }

        //$this->db->where('type',$type);

        $this->uri_arr['t'] = time();
        if ($id > 0) {
            my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
        } else {
            my_redirect($GLOBALS['var']['act'] . url_uri($this->uri_arr));
        }
    }

    public function PrepareBy()
    {
        $id = $this->input->post('id', true);
        $PrepareBy = $this->input->post('PrepareBy', TRUE);
        $data['PrepareBy'] = date(TIME_SQL);
        $this->db->where('id', $id);
        $this->db->update('requests_for_advance', $data);        //}
        my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
    }

    public function director()
    {
        $id = $this->input->post('id', true);
        $Status = $this->input->post('type', true);
        //$Director = $this->input->post('Director', TRUE);
        $data['Director'] = date(TIME_SQL);
        $data['Status'] = $Status;
        $this->db->where('id', $id);
        $this->db->update('requests_for_advance', $data);        //}
        my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
    }

    public function Leader()
    {
        $id = $this->input->post('id', true);
        $Leader = $this->input->post('Leader', TRUE);
        $data['Leader'] = date(TIME_SQL);
        $data['Leader_sign'] = $GLOBALS['user']['id'];
        $this->db->where('id', $id);
        $this->db->update('requests_for_advance', $data);        //}
        my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
    }

    public function Manager()
    {
        $id = $this->input->post('id', true);
        $Manager = $this->input->post('Manager', TRUE);
        $data['Manager'] = date(TIME_SQL);
        $this->db->where('id', $id);
        $this->db->update('requests_for_advance', $data);        //}
        my_redirect($GLOBALS['var']['act'] . '/update/' . $id . url_uri($this->uri_arr));
    }

    public function export_file($purchaseRequest, $id)
    {
        //if($purchaseRequest>0){$info = get_data('purchase_request', 'id = "' . $purchaseRequest . '"', '*');};
        $info1 = get_data('requests_for_advance', 'id = "' . $id . '"', '*');
        //$proList = get_data('purchase_request_details', 'CPOID = "' . $purchaseRequest . '" AND CPOID != 0', '**','','','SortOrder asc');
        /*   print_r($proList);
       die();*/
        $CompanyInfo = get_data('company_info', 'id =' . $info1['CompanyID']);
        $status_color = get_data('orders_status', 'type = "PurchaseRequest" AND StatusKey = ' . $info1['Status'] . '  ', 'color');
        $status_name = get_data('orders_status', 'type = "PurchaseRequest" AND StatusKey = ' . $info1['Status'] . '  ', 'name_vn');
        $this->load->library('php_excel');
        $objPHPExcel = new PHP_Excel();
        $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet = $objPHPExcel->getActiveSheet();
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);
        $activeSheet->setShowGridlines(false);
        $filename = $info1['code'];
        phpexcel_width($activeSheet, array('C,17', 'B,8.1', 'A,4.1', 'D,5', 'E,6', 'F,17', 'G,6', 'H,14', 'I,9', 'J,6', 'K,6', 'L,24'));
        phpexcel_height($activeSheet, array(2, 32), 20.75);
        //phpexcel_height($activeSheet, array(57), 23.75);
        phpexcel_height($activeSheet, array(28, 58), 14.75);
        phpexcel_height($activeSheet, array(27, 57), 24.75);
        phpexcel_height($activeSheet, array(29, 59), 28.75);
        phpexcel_merge($activeSheet, array('C1:H1', 'C31:H31', 'C32:H32', 'C2:H2', 'I1:L1', 'I31:L31', 'I2:L2', 'I32:L32', 'E5:I5', 'A7:L7', 'D8:L8', 'D9:L9', 'D10:L10', 'D11:L11', 'D12:L12', 'D13:L13', 'D14:L14', 'D16:L16', 'D17:L17', 'I18:J18', 'D18:H18', 'K18:L18', 'D19:L19', 'D20:L20', 'D21:L21', 'E33:I33', 'E35:I35', 'D38:L38', 'D39:L39', 'D40:L40', 'D41:L41', 'D42:L42', 'D44:L44', 'D45:L45', 'D46:L46', 'D47:L47', 'I49:J49', 'D48:H48', 'K48:L48', 'D49:F49', 'D50:L50', 'K29:L29', 'K59:L59', 'H29:J29', 'H59:J59', 'E29:G29', 'E59:G59', 'B29:D29', 'B59:D59', 'K25:L25', 'K55:L55'));
        phpexcel_format($activeSheet, 'F1', array('font' => 'size:13,bold:true,color:000000:padding_bottom:0px;'));
        phpexcel_format($activeSheet, 'F31', array('font' => 'size:13,bold:true,color:000000:padding_bottom:0px;'));
        phpexcel_format($activeSheet, 'E5', array('font' => 'size:15,bold:true,color:000000:padding_bottom:0px;'));
        phpexcel_format($activeSheet, 'E35', array('font' => 'size:15,bold:true,color:000000:padding_bottom:0px;'));
        //phpexcel_format($activeSheet, 'A3', array('font' => 'size:15,bold:true'));
        $activeSheet->setCellValue('C1', $CompanyInfo['CompanyName'])
            ->setCellValue('C31', $CompanyInfo['CompanyName'])
            ->setCellValue('C2', $CompanyInfo['Address'])
            ->setCellValue('C32', $CompanyInfo['Address'])
            ->setCellValue('I1', 'TP.Hồ Chí Minh, ngày ' . date('d', strtotime(date(TIME_SQL))) . ' tháng ' . date('m', strtotime(date(TIME_SQL))) . ' năm ' . date('Y', strtotime(date(TIME_SQL))))
            ->setCellValue('I31', 'TP.Hồ Chí Minh, ngày ' . date('d', strtotime(date(TIME_SQL))) . ' tháng ' . date('m', strtotime(date(TIME_SQL))) . ' năm ' . date('Y', strtotime(date(TIME_SQL))))
            ->setCellValue('I2', 'Số: ' . $info1['code'])
            ->setCellValue('I32', 'Số: ' . $info1['code'])
            ->setCellValue('E5', 'ĐỀ NGHỊ TẠM ỨNG')
            ->setCellValue('E35', 'ĐỀ NGHỊ TẠM ỨNG')
            ->setCellValue('J5', 'Liên 1')
            ->setCellValue('J35', 'Liên 2')
            //->setCellValue('A7','Chúng tôi là: ')
            ->setCellValue('A7', 'Người tạm ứng: ' . $CompanyInfo['CompanyName'] . '')
            ->setCellValue('A37', 'Người tạm ứng: ' . $CompanyInfo['CompanyName'] . '')
            ->setCellValue('C8', 'Đại diện:')
            ->setCellValue('C38', 'Đại diện:')
            ->setCellValue('D8', get_name_staff($info1['StaffNumber']))
            ->setCellValue('D38', get_name_staff($info1['StaffNumber']))
            ->setCellValue('C9', 'Bộ phận:')
            ->setCellValue('C39', 'Bộ phận:')
            ->setCellValue('D9', get_field_by_id($info1['Department'], 'name_vn', 'departments'))
            ->setCellValue('D39', get_field_by_id($info1['Department'], 'name_vn', 'departments'))
            ->setCellValue('C10', 'Vị trí:')
            ->setCellValue('C40', 'Vị trí:')
            ->setCellValue('D10', get_field_by_id($info1['position'], 'name_vn', 'positions'))
            ->setCellValue('D40', get_field_by_id($info1['position'], 'name_vn', 'positions'))
            ->setCellValue('C11', 'Địa chỉ:')
            ->setCellValue('C41', 'Địa chỉ:')
            ->setCellValue('D11', $CompanyInfo['Address'])
            ->setCellValue('D41', $CompanyInfo['Address'])
            ->setCellValue('C12', 'Điện thoai:')
            ->setCellValue('C42', 'Điện thoai:')
            ->setCellValueExplicit('D12', $info1['Phone'], PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValueExplicit('D42', $info1['Phone'], PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('C13', 'Email:')
            ->setCellValue('C43', 'Email:')
            ->setCellValue('D13', $info1['Email'])
            ->setCellValue('D43', $info1['Email'])
            ->setCellValue('A14', 'Thanh toán :')
            ->setCellValue('A44', 'Thanh toán :')
            ->setCellValue('C15', 'Tên ngân hàng :')
            ->setCellValue('C45', 'Tên ngân hàng :')
            ->setCellValue('D15', $info1['BankName'])
            ->setCellValue('D45', $info1['BankName'])
            ->setCellValue('C16', 'Đia chỉ ngân hàng :')
            ->setCellValue('C46', 'Đia chỉ ngân hàng :')
            ->setCellValue('D16', $info1['BankAddress'])
            ->setCellValue('D46', $info1['BankAddress'])
            ->setCellValue('C17', 'Tên thụ hưởng :')
            ->setCellValue('C47', 'Tên thụ hưởng :')
            ->setCellValue('D17', $info1['BeneficiaryName'])
            ->setCellValue('D47', $info1['BeneficiaryName'])
            ->setCellValue('C18', 'Tài khoản thụ hưởng :')
            ->setCellValue('C48', 'Tài khoản thụ hưởng :')
            ->setCellValue('D18', $info1['BeneficiaryAccount'])
            ->setCellValue('D48', $info1['BeneficiaryAccount'])
            ->setCellValue('I18', 'Mã ngân hàng :')
            ->setCellValue('I48', 'Mã ngân hàng :')
            ->setCellValue('K18', $info1['SwifCode'])
            ->setCellValue('K48', $info1['SwifCode'])
            ->setCellValue('C19', 'Số tiền :')
            ->setCellValue('C49', 'Số tiền :')
            ->setCellValue('D19', $info1['AmountVND'])
            ->setCellValue('D49', $info1['AmountVND'])
            ->setCellValue('C20', 'Số tiền bằng chữ :')
            ->setCellValue('C50', 'Số tiền bằng chữ :')
            ->setCellValue('D20', $info1['InWord'])
            ->setCellValue('D50', $info1['InWord'])
            ->setCellValue('C21', 'Lý do tạm ứng :')
            ->setCellValue('C51', 'Lý do tạm ứng :')
            ->setCellValue('D21', $info1['Content'])
            ->setCellValue('D51', $info1['Content'])
            ->setCellValue('C22', 'Ngày hoàn ứng :')
            ->setCellValue('D22', $info1['RequestDate'] == null ? '' : date('d-m-Y', strtotime($info1['RequestDate'])))
            ->setCellValue('C52', 'Ngày hoàn ứng :')
            ->setCellValue('D52', $info1['RequestDate'] == null ? '' : date('d-m-Y', strtotime($info1['RequestDate'])))
            ->setCellValue('C25', 'Advance approver')
            ->setCellValue('B29', get_name_staff($info1['Director_sign']))
            ->setCellValue('C55', 'Advance approver')
            ->setCellValue('B59', get_name_staff($info1['Director_sign']))
            ->setCellValue('F25', 'Manager')
            ->setCellValue('E29', get_name_staff($info1['Manager_sign']))
            ->setCellValue('F55', 'Manager')
            ->setCellValue('E59', get_name_staff($info1['Manager_sign']))
            ->setCellValue('I25', 'Leader')
            ->setCellValue('H29', get_name_staff($info1['Leader_sign']))
            ->setCellValue('I55', 'Leader')
            ->setCellValue('H59', get_name_staff($info1['Leader_sign']))
            ->setCellValue('K25', 'Prepare By')
            ->setCellValue('K29', get_name_staff($info1['StaffNumber']))
            ->setCellValue('K55', 'Prepare By')
            ->setCellValue('K59', get_name_staff($info1['StaffNumber']));
        phpexcel_align($activeSheet, 'C1', 'Left');
        phpexcel_align($activeSheet, 'C31', 'Left');
        phpexcel_align($activeSheet, 'C2', 'Left');
        phpexcel_align($activeSheet, 'C32', 'Left');
        phpexcel_align($activeSheet, 'I1', 'right');
        phpexcel_align($activeSheet, 'I31', 'right');
        phpexcel_align($activeSheet, 'I2', 'right');
        phpexcel_align($activeSheet, 'I32', 'right');
        phpexcel_align($activeSheet, 'C25');
        phpexcel_align($activeSheet, 'C30');
        phpexcel_align($activeSheet, 'C55');
        phpexcel_align($activeSheet, 'C59');
        phpexcel_align($activeSheet, 'F25');
        phpexcel_align($activeSheet, 'F29');
        phpexcel_align($activeSheet, 'F55');
        phpexcel_align($activeSheet, 'F59');
        phpexcel_align($activeSheet, 'I25');
        phpexcel_align($activeSheet, 'I59');
        phpexcel_align($activeSheet, 'I55');
        phpexcel_align($activeSheet, 'I59');
        phpexcel_align($activeSheet, 'L25');
        phpexcel_align($activeSheet, 'L29');
        phpexcel_align($activeSheet, 'L55');
        phpexcel_align($activeSheet, 'L59');
        phpexcel_align($activeSheet, 'E5:I5');
        phpexcel_align($activeSheet, 'E35:I35');
        phpexcel_align($activeSheet, 'B29:D30');
        phpexcel_align($activeSheet, 'B59:D60');
        phpexcel_align($activeSheet, 'E29:G29');
        phpexcel_align($activeSheet, 'E59:G59');
        phpexcel_align($activeSheet, 'H29:J29');
        phpexcel_align($activeSheet, 'H59:J59');
        phpexcel_align($activeSheet, 'K29:L29');
        phpexcel_align($activeSheet, 'K59:L59');
        phpexcel_align($activeSheet, 'K25:L25');
        phpexcel_align($activeSheet, 'K55:L55');
        //phpexcel_align($activeSheet, 'A8:L8','left');
        phpexcel_align($activeSheet, 'D12:L12', 'left');
        phpexcel_align($activeSheet, 'D42:L42', 'left');
        phpexcel_align($activeSheet, 'D19:L19', 'left');
        phpexcel_align($activeSheet, 'D49:L49', 'left');
        phpexcel_align($activeSheet, 'D37:L37', 'left');
        phpexcel_align($activeSheet, 'D21:L21', 'left');
        phpexcel_align($activeSheet, 'D51:L51', 'left');
        phpexcel_align($activeSheet, 'D50:G50', 'left');
        phpexcel_align($activeSheet, 'D20:G20', 'left');
        $activeSheet->getStyle('B24:L29')->getAlignment()->setWrapText(true);
        $activeSheet->getStyle('B54:L59')->getAlignment()->setWrapText(true);
        phpexcel_align($activeSheet, 'B29:L29');
        phpexcel_format($activeSheet, 'A2:L2', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'A32:L32', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'A7:L7', array('font' => 'bold:true', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'A37:L37', array('font' => 'bold:true', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'A14:L14', array('font' => 'bold:true', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'A44:L44', array('font' => 'bold:true', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C8:L8', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C38:L38', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C9:L9', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C39:L39', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C10:L10', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C40:L40', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C11:L11', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C41:L41', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'F3:L3', array('font' => 'italic:true', 'border' => ''));
        phpexcel_format($activeSheet, 'F33:L33', array('font' => 'italic:true', 'border' => ''));
        phpexcel_format($activeSheet, 'C13:L13', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C12:L12', array('font' => '', 'border' => 'bottom:solid:000000'));
        //phpexcel_format($activeSheet, 'C14:L14', array('font' =>  '','border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C15:L15', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C16:L16', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C17:L17', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C18:L18', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C19:L19', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C20:L20', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C21:L21', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C42:L42', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C45:L45', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C43:L43', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C44:L44', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C46:L46', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C47:L47', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C48:L48', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C49:L49', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C50:L50', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C51:L51', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C22:L22', array('font' => '', 'border' => 'bottom:solid:000000'));
        phpexcel_format($activeSheet, 'C52:L52', array('font' => '', 'border' => 'bottom:solid:000000'));
        $activeSheet->getStyle('D19')->getNumberFormat()->setFormatCode('#,##0"₫"');
        $activeSheet->getStyle('D49')->getNumberFormat()->setFormatCode('#,##0"₫"');
        if ($info1['Director'] != '') {
            if ($info['Status'] == 1) {
                phpexcel_img($objPHPExcel->getActiveSheet(), 'C27', 'assets/images/sign_border.png', 140, 50, 0, -10);
                phpexcel_img($objPHPExcel->getActiveSheet(), 'C57', 'assets/images/sign_border.png', 140, 50, 0, -10);
                //$activeSheet->setCellValue('C24', 'Signature valid' . "\n" . 'Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                $activeSheet->setCellValue('C27', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Director'])));
                $activeSheet->setCellValue('C57', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Director'])));
                //$activeSheet->setCellValue('C28','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                //$activeSheet->setCellValue('C58','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                phpexcel_format($activeSheet, 'C27', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
                phpexcel_format($activeSheet, 'C57', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
                phpexcel_format($activeSheet, 'C28', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
                phpexcel_format($activeSheet, 'C58', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
            } else {

                phpexcel_img($objPHPExcel->getActiveSheet(), 'C27', 'assets/images/x_border.png', 140, 50, 0, -10);
                phpexcel_img($objPHPExcel->getActiveSheet(), 'C57', 'assets/images/x_border.png', 140, 50, 0, -10);
                //$activeSheet->setCellValue('C24', 'Signature valid' . "\n" . 'Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                $activeSheet->setCellValue('C27', 'Non approve' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Director'])));
                $activeSheet->setCellValue('C57', 'Non approve' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Director'])));
                //$activeSheet->setCellValue('C28','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                //$activeSheet->setCellValue('C58','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
                phpexcel_format($activeSheet, 'C27', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
                phpexcel_format($activeSheet, 'C57', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
                phpexcel_format($activeSheet, 'C28', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
                phpexcel_format($activeSheet, 'C58', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
            }
        }
        if ($info1['Manager'] != '') {
            phpexcel_img($objPHPExcel->getActiveSheet(), 'F27', 'assets/images/sign_border.png', 140, 50, 0, -10);
            phpexcel_img($objPHPExcel->getActiveSheet(), 'F57', 'assets/images/sign_border.png', 140, 50, 0, -10);
            //$activeSheet->setCellValue('C24', 'Signature valid' . "\n" . 'Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
            $activeSheet->setCellValue('F27', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Manager'])));
            $activeSheet->setCellValue('F57', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Manager'])));
            //$activeSheet->setCellValue('F28','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Manager']) ));
            //$activeSheet->setCellValue('F58','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Manager']) ));
            phpexcel_format($activeSheet, 'F27', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'F57', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'F28', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
            phpexcel_format($activeSheet, 'F58', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
        }
        if ($info1['Leader'] != '') {
            phpexcel_img($objPHPExcel->getActiveSheet(), 'I27', 'assets/images/sign_border.png', 140, 50, 0, -10);
            phpexcel_img($objPHPExcel->getActiveSheet(), 'I57', 'assets/images/sign_border.png', 140, 50, 0, -10);
            //$activeSheet->setCellValue('C24', 'Signature valid' . "\n" . 'Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
            $activeSheet->setCellValue('I27', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Leader'])));
            $activeSheet->setCellValue('I57', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['Leader'])));
            //$activeSheet->setCellValue('I28','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Leader']) ));
            //$activeSheet->setCellValue('I58','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Leader']) ));
            phpexcel_format($activeSheet, 'I27', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'I57', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'I28', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
            phpexcel_format($activeSheet, 'I58', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
        }
        if ($info1['PrepareBy'] != '') {
            phpexcel_img($objPHPExcel->getActiveSheet(), 'L27', 'assets/images/sign_border.png', 140, 50, 0, -10);
            phpexcel_img($objPHPExcel->getActiveSheet(), 'L57', 'assets/images/sign_border.png', 140, 50, 0, -10);
            //$activeSheet->setCellValue('C24', 'Signature valid' . "\n" . 'Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['Director']) ));
            $activeSheet->setCellValue('L27', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['PrepareBy'])));
            $activeSheet->setCellValue('L57', 'Signature valid' . "\n" . 'Date: ' . gmdate('d-m-y H:i:s', strtotime($info1['PrepareBy'])));
            //$activeSheet->setCellValue('L28','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['PrepareBy']) ));
            //$activeSheet->setCellValue('L58','Date: ' .gmdate('d-m-y H:i:s', strtotime($info1['PrepareBy']) ));
            phpexcel_format($activeSheet, 'L27', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'L57', array('font' => 'size:9,color:ff0000:padding_bottom:10px;'));
            phpexcel_format($activeSheet, 'L28', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
            phpexcel_format($activeSheet, 'L58', array('font' => 'size:9,color:ff0000:padding_bottom:0px;'));
        }

        $logo_file = $CompanyInfo['Logo'] ? $CompanyInfo['Logo'] : '';
        if (goodfile(INTERF . $logo_file)) {
            $logo_file = INTERF . $logo_file;
        } else {
            $logo_file = 'assets/images/logo-atcom.png';
        }
        phpexcel_img($objPHPExcel->getActiveSheet(), 'A1', $logo_file, 100, 50, 0, 0);
        phpexcel_img($objPHPExcel->getActiveSheet(), 'A31', $logo_file, 100, 50, 0, 0);
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    public function print_file($option, $id)
    {
        if (!$id) {
            redirect($GLOBALS['var']['act']);
        }
        $CurrencyOfRequest = $this->input->GET('CurrencyOfRequest', true);
        print_r($CurrencyOfRequest);

        $info = get_data('requests_for_advance', 'id = "' . $id . '"', '*');
        $Staff = get_data('users', 'id = "' . $info['StaffNumber'] . '"', '*');
        $customer = get_data('customers', 'id = "' . $info['StaffNumber'] . '"', '*');
        $data = array(
            'info' => $info,
            'Staff' => $Staff,
            'customer' => $customer
        );
        if ($option == 'po_pdf') {
            $this->load->view($GLOBALS['var']['act'] . '/po_pdf', $data);
        } else {
            return false;
        }
    }

    public function get_purchase_request()
    {
        $id = $this->input->post('id', true);
        echo json_encode(get_data('purchase_request_details', 'CPOID = "' . $id . '" AND CPOID != 0', '**', '', '', 'SortOrder asc'));
    }

    public function get_pusrchase_info(){
        $id = $this->input->post('id', true);
        
        echo json_encode($this->fn->info($id, 'requests_for_advance'));
    }
    /*public function payment_request_month_total() {
        $id = $this->input->post('id');
    echo ($this->Mod->payment_request_month_total($id));
    }*/
}

