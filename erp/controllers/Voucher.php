<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Voucher extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();

		$GLOBALS['var']['act'] = ucfirst($this->uri->segment(1));

		$this->d = $this->data['d'];
		$this->voucher = new EGiftVoucherSystem();

		$this->data['template'] = 'module/voucher/index';
		$this->data['module'] = 'voucher';
	}

	public function index()
	{

		$a = array();
		$u = get_data2('member', '', 'id,ten', '', '', '');
		foreach ($u as $i) {
			$a[$i['id']] = $i['ten'];
		}
		$data = array(
			'url_str' => site_url('Voucher'),
			'title' => 'Danh sách voucher',
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
	}

	public function setting()
	{
		$id_cate = getRequest('id');
		$this->data['items'] = get_data('coupons_cate', '','**');

		//qq($this->data['items']);

		$voucher1 = $this->voucher->generateVoucher("register", 10);
		$code = $voucher1->getVoucherId();

		$this->data['ajax'] = array(
			'code'=> $code,
			'table'=>'table_coupons_cate',
			'id'=> $this->data['item']['id'] ?? 0,
		);

		$this->data['template'] = 'module/voucher/setting';
		$this->load->view('all/template', $this->data);
	}

	public function update($id){

		$this->data['template'] = 'module/voucher/update';
		$this->load->view('all/template', $this->data);
	}

}
