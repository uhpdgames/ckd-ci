<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Affiliate extends MY_Controller
{
	public $com;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('congtacvien');

		$this->com = 'affiliate';
		//$this->data['com'] = $this->com;

		$this->data['template'] = 'module/affiliate/index';
		$this->data['module'] = 'Affiliate';
	}

	function index()
	{

		$this->data['items'] =  get_data('member', 'ref_nick = 1', '**', '', '', '');
		//$this->data['title'] = 'Quản lý ';


		//;get_data('coupons_cate', "code='register'", '*');


		$this->load->view('all/template', $this->data);

	}

	function wallet()
	{
		$d = $this->data['d'];


		$sql = "select r.*,
       m.ten,
       m.dienthoai,
       m.email 
    
from #_ref_withdrawal r 
join #_member m on m.id=r.user_id
 
where m.ref_nick = 1 and m.hienthi = 1
order by id desc, status
";
		$items = $d->rawQuery($sql);

		$this->data['items'] =  $items;

		$this->data['template'] = 'module/affiliate/wallet';

		$this->load->view('all/template', $this->data);
	}

	function details($uid = 0)
	{

		$sql = "select r.*, o.tinhtrang, o.madonhang, o.id as orderid from #_ref_order r join #_order o on o.id = r.order_id where uid = '".$uid."' order by id desc";
		$items = $this->data['d']->rawQuery($sql, array($uid));

		$d = $this->data['d'];
		$this->data['items'] = $items;
		$this->data['info'] = $items;

		$this->data['_Affiliate'] = new Congtacvien( true);
		$this->data['_Affiliate']->setUserUid($uid);

		$this->data['template'] = 'module/affiliate/items';
		$this->load->view('all/template', $this->data);
	}

	function setting()
	{
		$this->data['item'] = $this->data['d']->rawQueryOne("select * from #_ref_config limit 0,1");
		$this->data['template'] = 'module/affiliate/setting';
		$this->load->view('all/template', $this->data);
	}

	function save()
	{
		redirect();
	}

}
