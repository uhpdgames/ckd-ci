<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Report extends MY_Controller
{
    public $com;

    public function __construct()
    {
        parent::__construct();

        $this->com = 'ckdsite';
        $this->data['com'] = $this->com;

        $this->data['template'] = 'module/report';
        $this->data['module'] = 'Report';
    }

    function index()
    {

        $this->data['item'] = '';




        $this->load->view('all/template', $this->data);

    }





}
