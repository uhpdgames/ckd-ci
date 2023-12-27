<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller
{
    var $q = '';
    var $updated = '';
    var $added = '';
    var $failed = '';
    var $name = '';
    var $uri_arr = array();
    var $uri_str = '';

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
        $this->updated = $this->input->get('updated', true);
        $this->added = $this->input->get('added', true);
        $this->failed = $this->input->get('failed', true);
        $this->name = $this->input->get('name', true);
        $this->uri_arr = array(
            'q' => $this->q,
            'rowstart' => '',
            'deleted' => $GLOBALS['var']['deleted']
        );
        $this->uri_str = url_uri($this->uri_arr);
    }

    public function index()
    {

        //qq( $GLOBALS['var']['act']);die;


        $data = array(
            'added' => $this->added,
            'updated' => $this->updated,
            'failed' => $this->failed,
            'name' => $this->name,
            'uri_str' => $this->uri_str,
            'url_update' => site_url($GLOBALS['var']['act'] . '/update'),
            'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
            'tabs' => array(),
            'category_list' => $this->fn->show(array('active' => 1, 'deleted' => 0), false, 'sort_order desc', $GLOBALS['var']['act'] . '_categories')
        );
        foreach ($data['category_list'] as $cat) {
            $data['tabs'][$cat['id']] = $this->fn->show_tab($this->uri_arr, $cat['id'], 'name_vn asc');
        }
        $header = array(
            'title' => module_title(),
            //'add_link' => ($GLOBALS['cfg']['develop_mode'] ? current_url() . '/update' : ''),
            'add_link' => site_url($GLOBALS['var']['act']).'/update',
            'search' => true,
            'page_list' => '',
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
        $this->load->view($GLOBALS['var']['act'] . '/index', $data);
        $this->load->view('footer');
    }


    public function update($id = '')
    {
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            my_redirect($GLOBALS['var']['act']);
        }
        $data = array(
            'info' => $this->fn->info($id),
            'updated' => $this->updated,
            'name' => $this->name,
            'action' => site_url($GLOBALS['var']['act'] . '/process') . $this->uri_str,
            'category_list' => $this->fn->show(array('active' => 1, 'deleted' => 0), false, 'sort_order desc', $GLOBALS['var']['act'] . '_categories')
        );
        $header = array(
            'title' => module_title(),
            'add_link' => '',
            'search' => false,
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
            my_redirect();
        }
        $name_vn = $this->input->post('name_vn', true);
        if (!token_validation() || $name_vn == '') {
            my_redirect($GLOBALS['var']['act']);
        }
        $this->uri_arr['name'] = str_replace('&', '', $name_vn);
        $id = $this->input->post('id', true);
        if ((!$id && !$GLOBALS['per']['add']) || ($id && !$GLOBALS['per']['edit'])) {
            my_redirect($GLOBALS['var']['act']);
        }
        $value = strip_input($this->input->post('value'));
        $data = array(
            'name_vn' => $name_vn,
            'keyword' => url_title(viet_decode($this->input->post('keyword', true)), '_', true),
            'value' => (is_array($value) && count($value) ? json_encode($value) : $value),
            'type' => $this->input->post('type', true),
            'cat' => $this->input->post('cat', true),
            'hidden' => $this->input->post('hidden', true),
            'date_added' => date(TIME_SQL),
            'date_modified' => date(TIME_SQL)
        );
        if ($this->fn->process($data, $id)) {
            if ($id > 0) {
                $this->uri_arr['updated'] = 1;
            } else {
                $this->uri_arr['added'] = 1;
            }
            if (false !== ($fp = fopen(realpath(DIR) . '/jsons/' . $GLOBALS['var']['act'] . '.json', 'w'))) {
                $this->db->select('keyword, value');
                $query = $this->db->get($GLOBALS['var']['act']);
                $jsons = array();
                foreach ($query->result() as $val) {
                    $jsons[$val->keyword] = $val->value;
                }
                fwrite($fp, json_encode($jsons));
                fclose($fp);
            }
        } else {
            $this->uri_arr['failed'] = 1;
        }
        $this->uri_arr['t'] = time();
        redirect_to($this->uri_arr, $id);
    }
}
