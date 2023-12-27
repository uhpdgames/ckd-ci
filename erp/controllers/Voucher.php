<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Voucher extends MY_Controller
{
	var $q = '';
	var $limit = '';
	var $orderby = '';
	var $ordermode = '';
	var $added = '';
	var $rowstart = '';
	var $updated = '';
	var $permissed = '';
	var $failed = '';
	var $name = '';
	var $uri_arr = array();
	var $uri_str = '';
	var $user_id = 0;


	public function __construct()
	{
		parent::__construct();

		$GLOBALS['var']['act'] = ucfirst($this->uri->segment(1));

		$this->load->model('fn_model', 'fn', true);
		$this->fn->load_config();

		$this->load->model($GLOBALS['var']['act'] . '_model', 'Mod');

		$this->q = $this->input->get('q', true);
		$this->orderby = $this->input->get('orderby', true);
		$this->ordermode = $this->input->get('ordermode', true);
		$this->added = $this->input->get('added', true);
		$this->updated = $this->input->get('updated', true);
		$this->rowstart = $this->input->get('rowstart', true);
		$this->permissed = $this->input->get('permissed', true);
		$this->failed = $this->input->get('failed', true);
		$this->name = $this->input->get('name', true);
		$this->uri_arr = array(
			'deleted' => !empty($GLOBALS['var']['deleted']) ? $GLOBALS['var']['deleted'] : 0,
			'q' => $this->q,
			'rowstart' => !empty($GLOBALS['var']['rowstart']) ? $GLOBALS['var']['rowstart'] : 0,
			'limit' => $this->limit,
			'orderby' => $this->orderby,
			'ordermode' => $this->ordermode
		);
		//  $this->uri_str = url_uri($this->uri_arr);


		$this->d = $this->data['d'];
		$this->voucher = new EGiftVoucherSystem();

		$this->data['template'] = 'module/voucher/index';
		$this->data['module'] = 'voucher';

	}

	public function index()
	{
		$this->uri_arr['orderby'] = 'u.part';
		$this->uri_arr['ordermode'] = 'asc';

		$num_rows = $this->Mod->show($this->uri_arr, true);
		$page_list = page_list($num_rows, $this->uri_arr);


		$a = array();
		$u = get_data2('member', '', 'id,ten', '', '', '');
		foreach ($u as $i) {
			$a[$i['id']] = $i['ten'];
		}
		$data = array(
			'rowstart' => !empty($GLOBALS['var']['rowstart']) ? $GLOBALS['var']['rowstart'] : '',
			'added' => $this->added,
			'updated' => $this->updated,
			'failed' => $this->failed,
			'name' => $this->name,
			'uri_str' => $this->uri_str,
			'url_str' => site_url('Voucher'),
			'page_list' => $page_list,
			'title' => 'Danh sách voucher',
			'act' => ucfirst($GLOBALS['var']['act']),
			'action' => site_url($GLOBALS['var']['act'] . '') . $this->uri_str,
			//	$table, $where = '', $field = '*', $start = '', $limit = '', $order = ''
			'items' => get_data('coupons', '', '**', '', '', ''),
			'users' => $a,
		);


		//    $test = get_data('#_coupons', '', '', '', '', '');
		//   $test = get_data2('coupons');

		$voucher1 = $this->voucher->generateVoucher("register", 10);
		$code = $voucher1->getVoucherId();

		$this->data['ajax']= array(
			'table'=>'table_coupons',
			'id'=>'',
			'code'=>$code,
		);
		$this->data = array_merge($data, $this->data);
		$this->load->view('all/template', $this->data);

		//  qq($test);


		/*	$rsVoucher = $this->d->rawQuery('select code from #_coupons');
			if (is_array($rsVoucher) && count($rsVoucher)) {
				//$allVoucher = $rsVoucher['code'];
				//$this->voucher->setAllVouchers($allVoucher);
			}

			qq($rsVoucher);

			return false;*/




		//qq($voucher122);


		//$vouchers = $this->voucher->getAllVouchers();

		//qq($vouchers);


		/*
// Usage demonstration of the EGiftVoucherSystem class

// Create a new e-gift voucher system
$voucherSystem = new EGiftVoucherSystem();

// Generate a new e-gift voucher
$voucher1 = $voucherSystem->generateVoucher("John Doe", 50.00);
echo "Generated e-gift voucher with ID: {$voucher1->getVoucherId()}, recipient: {$voucher1->getRecipientName()}, amount: {$voucher1->getAmount()}.\n";

// Generate another e-gift voucher
$voucher2 = $voucherSystem->generateVoucher("Jane Smith", 100.00);
echo "Generated e-gift voucher with ID: {$voucher2->getVoucherId()}, recipient: {$voucher2->getRecipientName()}, amount: {$voucher2->getAmount()}.\n";

// Get all the e-gift vouchers in the system
$vouchers = $voucherSystem->getAllVouchers();
echo "All e-gift vouchers in the system:\n";
foreach ($vouchers as $voucher) {
   echo "Voucher ID: {$voucher->getVoucherId()}, recipient: {$voucher->getRecipientName()}, amount: {$voucher->getAmount()}.\n";
}

   }

}

		*/
	}

	public function setting()
	{
		$this->data['item'] = get_data('coupons_cate', "code='register'", '*');
		$this->data['ajax'] = array(
			'table'=>'table_coupons_cate',
			'id'=> $this->data['item']['id'] ?? 0,
		);
		$this->data['template'] = 'module/voucher/setting';
		$this->load->view('all/template', $this->data);
	}

	public function update($id){


		$this->data['template'] = 'module/voucher/update';
		$this->load->view('all/template', $this->data);

		$data = 1;

		if($id){

		}else{

		}
	}
}
