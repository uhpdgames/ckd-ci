<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Fn Dev
 *
 * @package     Fn Dev Project
 * @since       Monday, October 21, 2013, 6:00 PM
 * @final       
 * @category    Controllers
 * @see 		Config categories
 * @author      PHUOCNGUYEN - Fn Dev Team
 * @copyright   Copyright (c) 2013, Fn Corp
 */

class Config_categories extends CI_Controller
{
    var $q = '';
    var $limit = '';
    var $orderby = '';
    var $ordermode = '';
    var $updated = '';
    var $added = '';
    var $failed = '';
    var $name = '';
    var $uri_arr = array();
    var $uri_str = '';
    var $site_url = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fn_model', 'fn', true);
        $this->fn->load_config();
        if (check_rights() == false) {
            my_redirect();
        }
        $this->deleted = $this->input->get('deleted', true);
        $this->q = $this->input->get('q', true);
        $this->rowstart = $this->input->get('rowstart', true);
        $this->orderby = $this->input->get('orderby', true);
        $this->ordermode = $this->input->get('ordermode', true);
        $this->updated = $this->input->get('updated', true);
        $this->added = $this->input->get('added', true);
        $this->failed = $this->input->get('failed', true);
        $this->name = $this->input->get('name', true);
        $this->uri_arr = array(
            'deleted' => $GLOBALS['var']['deleted'],
            'q' => $this->q,
            'rowstart' => $GLOBALS['var']['rowstart'],
            'limit' => $this->limit,
            'orderby' => $this->orderby,
            'ordermode' => $this->ordermode
        );
        $this->uri_str = url_uri($this->uri_arr);
        $this->site_url = site_url($GLOBALS['var']['act']);
    }

    public function index()
    {
        /*
        * Xu ly du lieu
        */
        $num_rows = $this->fn->show($this->uri_arr, true);
        $data = array(
            'updated' => $this->updated,
            'added' => $this->added,
            'failed' => $this->failed,
            'name' => $this->name,
            'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
            'uri_str' => $this->uri_str,
            'rows' => $this->fn->show($this->uri_arr, false, 'sort_order desc')
        );
        /*
        * Hien thi
        */
        $header = array(
            'title' => module_title(),
            'add_link' => 'javascript:;" class="updateLink',
            'search' => true,
            'page_list' => page_list($num_rows, $this->uri_arr),
            'datetime_picker' => false,
            'submit_btn' => false,
            'cat_list' => array(),
            'uri' => $this->uri_arr,
            'act' => $GLOBALS['var']['act'],
            'do' => $GLOBALS['var']['do'],
            'id' => $GLOBALS['var']['id'],
            'filter_cat' => $GLOBALS['var']['filter_cat']
        );
        $this->load->view('header', $header);
        $this->load->view(str_replace('_', '/', $GLOBALS['var']['act']), $data);
        $this->load->view('footer');
    }

    public function process()
    {
        /*
        * Kiem tra POST method
        */
        if (!$_POST) {
            my_redirect();
        }
        /*
        * Kiem tra token va tham so yeu cau
        */
        $name_vn = $this->input->post('name_vn', true);
        if (!token_validation() || $name_vn == '') {
            my_redirect($GLOBALS['var']['act']);
        }
        /*
        * Them tham so url
        */
        $this->uri_arr['name'] = str_replace('&', '', $name_vn);
        /*
        * Xu ly du lieu
        */
        $id = $this->input->post('id', true);
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            my_redirect($GLOBALS['var']['act']);
        }
        $data = array(
            'name_vn' => $name_vn,
            'keyword' => url_title(viet_decode($this->input->post('keyword', true)), '-', true),
            'date_added' => date(TIME_SQL),
            'date_modified' => date(TIME_SQL)
        );
        /*
        * Ghi du lieu
        */
        if ($this->fn->process($data, $id)) {
            if ($id > 0) {
                $this->uri_arr['updated'] = 1;
            } else {
                $this->uri_arr['added'] = 1;
            }
        } else {
            $this->uri_arr['failed'] = 1;
        }
        /*
        * Chuyen huong
        */
        $this->uri_arr['t'] = time();
        my_redirect($GLOBALS['var']['act'] . url_uri($this->uri_arr));
    }
}