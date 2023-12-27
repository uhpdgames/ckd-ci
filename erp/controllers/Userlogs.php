<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * fnCMS
 *
 * @package     fnCMS Project
 * @since       Monday, October 21, 2013, 6:00 PM
 * @final       
 * @category    Controllers
 * @see 		User logs
 * @author      PHUOCNGUYEN - HITI Dev Team
 * @copyright   Copyright (c) 2013, HITI Corp
 */

class Userlogs extends CI_Controller
{
    var $q = '';
    var $limit = '';
    var $time_from = '';
    var $time_to = '';
    var $uri_arr = array();
    var $uri_str = '';
    var $site_url = '';
    var $user = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fn_model', 'fn', true);
        $this->fn->load_config();
        if (check_rights() == false) {
            my_redirect();
        }
        if ($GLOBALS['user']['level'] != 1) {
            $this->user = $GLOBALS['var']['user_id'];
        }
        $this->q = $this->input->get('q', true);
        $this->time_from = $this->input->get('from', true);
        $this->time_to = $this->input->get('to', true);
        $this->uri_arr = array(
            'deleted' => '',
            'q' => $this->q,
            'rowstart' => $GLOBALS['var']['rowstart'],
            'limit' => $this->limit,
            'from' => $this->time_from,
            'to' => $this->time_to,
            'user' => $this->user,
        );
        $this->uri_str = url_uri($this->uri_arr);
        $this->site_url = site_url($GLOBALS['var']['act']);
    }

    public function index()
    {
        /*
        * Xu ly du lieu
        */
        $num_rows = $this->fn->show_userlogs($this->uri_arr, true);
        $data = array(
            'rows' => $this->fn->show_userlogs($this->uri_arr),
            'user' => $this->user
        );
        /*
        * Hien thi
        */
        $header = array(
            'title' => module_title(),
            'add_link' => '',
            'search' => true,
            'page_list' => page_list($num_rows, $this->uri_arr),
            'datetime_picker' => true,
            'submit_btn' => false,
            'cat_list' => array(),
            'uri' => $this->uri_arr,
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id'],
            'filter_cat' => $GLOBALS['var']['filter_cat']
        );
        $this->load->view('header', $header);
        $this->load->view($GLOBALS['var']['act'], $data);
        $this->load->view('footer');
    }
}