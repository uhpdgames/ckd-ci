<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Product extends MY_Controller
{
    public $com;

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

        #$this->load->model($GLOBALS['var']['act'] . '_model', 'Mod');

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


        $this->com = 'ckdsite';
       // $this->data['com'] = $this->com;

        $this->data['template'] = 'module/product/index';
        $this->data['module'] = 'Product';
    }

    function index()
    {

        $this->uri_arr['orderby'] = 'u.part';
        $this->uri_arr['ordermode'] = 'asc';

       # $num_rows = $this->Mod->show($this->uri_arr, true);
       # $page_list = page_list($num_rows, $this->uri_arr);


        $where = "";
        $limit = "";

        $data = array(
            'rowstart' => !empty($GLOBALS['var']['rowstart']) ? $GLOBALS['var']['rowstart'] : '',
            'added' => $this->added,
            'updated' => $this->updated,
            'failed' => $this->failed,
            'name' => $this->name,
            'uri_str' => $this->uri_str,
            'url_str' => site_url('Product'),
           # 'page_list' => $page_list,
            'title' => 'Danh sách đơn hàng',
            'act' => ucfirst($GLOBALS['var']['act']),
            'action' => site_url($GLOBALS['var']['act'] . '') . $this->uri_str,
            'items' => get_data('order', '', '**', '', '', ''),

        );



        //;get_data('coupons_cate', "code='register'", '*');

        $this->data = array_merge($data, $this->data);
        $this->load->view('all/template', $this->data);

    }

    function tracking()
    {

		//$vtp = @$this->data['config']['data_key'];
		//$d = @$this->data['d'];

		//$api = new API($d);
		//$info = $api->orderFunctionInfo(121212, $vtp);
		//qq($api);

        $this->data['template'] = 'module/product/tracking';
        $this->load->view('all/template', $this->data);
    }



}
