<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// invoice_management , invoice_management_sc
$GLOBALS['limit_time'] = array(
    100 => 'All',
    1 => 1,
    3 => 3,
    6 => 6,
    12 => 12,
    24 => 24,
    36 => 36,
);
// /invoice_management, , invoice_management_sc

/**
 * Function Name
 *
 * Function description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */

if (!function_exists('splitName')) {
    function splitName($name, $position = '')
    {
        $names = explode(' ', $name);
        $lastname = $names[count($names) - 1];
        unset($names[count($names) - 1]);
        $firstname = join(' ', $names);
        if ($position == 'firstname') {
            return $firstname;
        } elseif ($position == 'lastname') {
            return $lastname;
        } else {
            return $firstname . ' = ' . $lastname;
        }
    }
}

if (!function_exists('get_name_staff')) {
    function get_name_staff($id = '')
    {
        $ci = &get_instance();
        $ci->db->where('id', $id);
        $ci->db->where('deleted', 0);
        $ci->db->select('fullname');
        $query = $ci->db->get('users');
        if ($query->num_rows > 0) {
            return $query->row()->fullname;
        } else {
            return '';
        }
    }
}

if (!function_exists('get_field_by_id')) {
    function get_field_by_id($id = '', $field = '', $table = '')
    {

        if (!$id || !$field) {
            return '';
        }

        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if (is_array($id)) {
            $data = '';
            foreach ($id as $key => $value) {
                $ci = &get_instance();
                $ci->db->where('id', $value);
                $ci->db->where('deleted', 0);
                $ci->db->select($field);
                $query = $ci->db->get($table);
                if ($query->num_rows > 0) {
                    if($table == 'purchase_order'){
                        $data .= ($key == 0 ? '' : ', ') . '<a href="purchase_order/update/'.$value.'" target="_blank">'. $query->row()->$field.'</a>';
                    }else{
                        $data .= ($key == 0 ? '' : ', ') . $query->row()->$field;
                    }
                } else {
                    $data .= ($key == 0 ? '' : ', ') . '';
                }
            }
            return $data;
        } else {
            $ci = &get_instance();
            $ci->db->where('id', $id);
            $ci->db->where('deleted', 0);
            $ci->db->select($field);
            $query = $ci->db->get($table);
            if ($query->num_rows > 0) {
                return $query->row()->$field;
            } else {
                return '';
            }
        }
    }
}

// ----------------------------------------------------------------------
/**
 * @return bool     false if all filter's fields are empty
 * auth: namth
 */
if (!function_exists('check_filter')) {
    function check_filter($filter = array())
    {
        $f = false;
        if (is_array($filter) && count($filter)) {
            foreach ($filter as $item) {
                if (is_array($item)) {
                    foreach ($item as $val) {
                        if ($val != '') {
                            $f = true;
                        }
                    }
                } elseif ($item != '') {
                    $f = true;
                }
            }
        }
        return $f;
    }
}

// ------------------------------------------------------------------------

/**
 * Hàm create_sort2
 *
 * Tạo liên kết sắp xếp cho một trường dữ liệu 
 *
 * @access  assets
 * @param   string field : Trường cần sắp xếp
 * @return  html text
 */
if (!function_exists('create_sort2')) {
    function create_sort2($field)
    {
        $ci = &get_instance();
        $act = $ci->uri->segment(1);
        $orderby = $ci->input->get('orderby', true);
        $ordermode = $ci->input->get('ordermode', true);
        if ($ordermode == '') $ordermode = 'desc';
        if ($field == $orderby) {
            if ($ordermode == 'desc') $ordermode = 'asc';
            else $ordermode = 'desc';
        }

        parse_str($_SERVER['QUERY_STRING'], $query);
        $query['ordermode'] = $ordermode;
        if ($field) {
            $query['orderby'] = $field;
        }

        $uri = '?' . http_build_query($query);

        return '<a class="ajax" href="' . site_url($act) . $uri . '" title="Sắp xếp">
        <div class="icon12 glyphicons ' . ($orderby == $field ? (strtolower($ordermode) == 'desc' ? 'sort-by-attributes' : 'sort-by-attributes-alt') : 'sorting') . '" style="margin-top:3px; float:right; margin-left:3px;"></div></a>';
    }
}

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
/**
 * @var [date_] Y-m-d
 * @var [num_of_day]    : number of day need to plus or minus
 * @var [sign_]         : TRUE is plus; FALSE is minus
 * @return [date]       : new date (Y-m-d)
 * @author              : nam.th
 */
if (!function_exists('plusday')) {
    function plusday($date_, $num_of_day, $sign_ = TRUE)
    {
        if ($sign_) {
            return date('Y-m-d', strtotime('+' . $num_of_day . ' day', strtotime($date_)));
        } else {
            return date('Y-m-d', strtotime('-' . $num_of_day . ' day', strtotime($date_)));
        }
    }
}
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
/**
 * Hàm mon_page_list
 *
 * Tạo phân trang tháng cho web 
 *  *
 * @return  html text
 */
if (!function_exists('mon_page_list')) {
    function mon_page_list($uri = '')
    {
        //  select year      
        $y_end = date('Y');
        $diff = $y_end - 2017;

        $url = site_url($GLOBALS['var']['act'] . ($GLOBALS['var']['do'] ? '/' . $GLOBALS['var']['do'] : '') . ($GLOBALS['var']['id'] ? '/' . $GLOBALS['var']['id'] : ''));
        $start = '';
        $count = '';
        $href = 'javascript:;';
        if (is_array($uri)) {
            $start = $uri['rowstart'];
            $count = $uri['limit'];
            if ($start == '') {
                $start = 0;
            }
            unset($uri['rowstart'], $uri['limit']);
            $uri_str = url_uri($uri, array('cat'));
            $link = $url . $uri_str . ($uri_str ? '&' : '?');
        } else {
            if ($uri == '') $link = $url . '?';
            else $link = $url . $uri . '&';
        }
        unset($_GET['t'], $_GET['q'], $_GET['rowstart'], $_GET['page_year'], $_GET['staff_id']);
        if (isset($_GET) && is_array($_GET) && count($_GET)) {
            $link .= http_build_query($_GET) . '&';
        }

        $html = '<div class="dataTables_paginate">';

        $html .= '<ul class="pagination pagination-month' . ($GLOBALS['var']['limit_time'] > 36 ? ' disabled' : '') . '">';
        // year
        $html .= '<li class="pull-left align-middle li-year">';
        $html .= '<select name="" id="page_year" class="year">';
        for ($i = 0; $i <= $diff; $i++) {
            $y = $y_end - $i;
            $selected = ($GLOBALS['var']['page_year'] == $y) ? ' selected ' : '';
            $html .= '<option value="' . $y . '" ' . $selected . ' >' . $y . '</option>';
        }
        $html .= '</select>';
        $html .= '       </li>';

        // month
        $html .= '       <li class="disabled">';
        $html .= '           <a href="#" style="cursor: default">Tháng </a>';
        $html .= '       </li>';

        for ($i = 1; $i <= 12; $i++) {
            $active = ($GLOBALS['var']['rowstart'] == $i) ? 'class="active"' : '';
            $html .= '<li ' . $active . '>';
            $html .= '    <a class="mon_page" href="' . $link . 'page_year=' . $GLOBALS['var']['page_year'] . '&rowstart=' . $i . '" style="cursor: default"  data-inv_mon="' . $i . '">' . $i . '</a>';
            $html .= '</li>';
        }

        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}
// ------------------------------------------------------------------------


// ------------------------------------------------------------------------
/**
 *  
 */
if (!function_exists('col_name2')) {
    function col_name2($col, $field = '', $key = '')
    {
        if (!is_object($col)) {
            return '';
        }

        if ($field) {
            $sort = create_sort2($field);
        }

        $html = '';

        $show = isset($col->show) && $col->show;
        if ($GLOBALS['var']['q']) {
            $show = isset($col->search_show) && $col->search_show;
        }

        if ($show) {
            $html .= '<th' . (isset($col->nowrap) ? ' nowrap="nowrap"' : '') .  ' class="head ' . (isset($key) ? $key . ' ' : '') . (isset($col->align) ? '' . $col->align : '') . (isset($col->header_class) ? '' . $col->header_class : '') . '"' . ' style="width: ' . (isset($col->width) ? $col->width : 100 . 'px') . '; min-width: ' . (isset($col->width) ? $col->width : 100 . 'px') . ';">' . ($key && isset($col->sort) && $GLOBALS['var']['do'] != 'prints' ? create_sort($key) : '') . (isset($col->name) ? $col->name : '') . ' ' . $sort . '</th>';
        }

        return $html;
    }
}
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Hàm get_data2
 *
 * Lấy giá trị của một field hoặc tất cả field từ bảng dữ liệu
 *
 * @access  public
 * @param   table name
 * @param   [, where condition = '']
 * @param   [, field = '']  :   
 * @param   [, r_type = ''] :   data type is returned     :  '' - array; 1 - 1 element; 0 - json
 * @param   [, start = '']  :   0
 * @param   [, limit = '']  :   10
 * @param   [, order = '']  :   'title desc, name asc'
 * @return  field value if (field='field name')
 * @return  data array if (field='*')
 */
if (!function_exists('get_data2')) {
    function get_data2($table, $where = array(), $field = '', $r_type = '', $start = '', $limit = '', $order = '')
    {
        $ci = &get_instance();
        if ($ci->db->table_exists($table)) {
            $ci->db->query('SET NAMES "LATIN1"');
            if ($field) $ci->db->select($field);
            if ($where != "") $ci->db->where($where);
            if ($order != "") $ci->db->order_by($order);
            if (is_numeric($limit) && is_numeric($start)) $ci->db->limit($limit, $start);
            $q = $ci->db->get($table);
            if ($q->num_rows() > 0) {
                if ($r_type == '1') {
                    $data = $q->row_array();                        // one row
                    $field_arr = explode(',', $field);
                    if (count($field_arr) > 1) {
                        return $data;
                    } else {
                        return $data[$field];                       // one value if only one field; otherwise, false;                    
                    }
                } else if ($r_type == '0') {
                    return json_encode($q->result_array());         // json
                } else {
                    return $q->result_array();                      // array
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
// ------------------------------------------------------------------------


// ----
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Hàm Comparison KPI Status
 *
 * 
 *
 * @access  public
 * @param   table name
 */
function co_st($co = '', $ex = '', $tar = '', $min = '', $ac = '') {
    $string = '';
    $ex = (double)$ex;
    $tar = (double)$tar;
    $min = (double)$min;
    $ac = (double)$ac;
    if ($co == '>=' || $co == '>' || $co == '=') {
        if ($ex != '' && $ac >= $ex) {
            $string = ' font-blue trending-up';
        }
        if (($ex > $ac && $ac >= $tar) || ($ex == '' && $ac >= $tar)) {
            $string = ' font-green trending-up';
        }
        if ($tar > $ac && $ac >= $min) {
            $string = ' font-yellow trending-stagnant';
        }
        if ($min != '' && $min > $ac) {
            $string = ' font-red trending-down';
        }
    }
    if ($co == '<=' || $co == '<') {
        $ex = $ex * -1;
        $tar = $tar * -1;
        $min = $min * -1;
        $ac = $ac * -1;
        if ($ex != '' && $ac >= $ex) {
            $string = ' font-blue trending-up';
        }
        if ($ex > $ac || $ac >= $tar) {
            $string = ' font-green trending-up';
        }
        if ($tar > $ac && $ac >= $min) {
            $string = ' font-yellow trending-stagnant';
        }
        if ($min != '' && $min > $ac) {
            $string = ' font-red trending-down';
        }
    }
    return $string;
}
// ------------------------------------------------------------------------


/**
 * Hàm Comparison KPI Trend
 *
 * 
 *
 * @access  public
 * @param   table name
 */
function co_t($co = '', $tar = '', $ac = '') {
    $string = '';
    if ($co == '>=' || $co == '>' || $co == '=') {
        $tar_plus = $tar * 1.05;
        $tar_minus = $tar * 0.95;
        if ($ac > $tar_plus) {
            $string = ' font-green trending-up';
        }
        if (($tar_plus >= $ac && $ac >= $tar_minus) || $ac == $tar) {
            $string = ' font-yellow trending-stagnant';
        }
        if ($ac < $tar_minus) {
            $string = ' font-red trending-down';
        }
    }
    if ($co == '<=' || $co == '<') {

        $tar_plus = $tar * 1.05;
        $tar_minus = $tar * 0.95;
        if ($ac < $tar_minus) {
            $string = ' font-green trending-up';
        }
        if (($tar_plus >= $ac && $ac >= $tar_minus) || $ac == $tar) {
            $string = ' font-yellow trending-stagnant';
        }
        if ($ac > $tar_plus) {
            $string = ' font-red trending-down';
        }
    }
    return $string;
}


if (!function_exists('get_total_by_id')) {
    function get_pod_by_po($id = '', $field = '', $table = '')
    {
        if (!$id || !$field) {
            return '';
        }
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if (is_array($id)) {
            $data = '';
            foreach ($id as $key => $value) {
                $ci = &get_instance();
                $ci->db->where('po.id', $value);
                $ci->db->where('deleted', 0);
                $ci->db->join('purchase_order_details AS pod', 'pod.POID = po.id', 'left');
                $ci->db->select($field);
                $query = $ci->db->get('purchase_order as po');
                if ($query->num_rows > 0) {
                    $period_array[] = intval($query->row()->$field);
//                    $data .= ($key == 0 ? '' : ', ') . $query->row()->$field;
                } else {
                    $data .= ($key == 0 ? '' : ', ') . '';
                }
            }
            $data = array_sum($period_array);
            return $data;
        } else
        {
            $ci = &get_instance();
            $ci->db->where('id', $id);
            $ci->db->where('deleted', 0);
            $ci->db->select($field);
            $query = $ci->db->get($table);
            if ($query->num_rows > 0) {
                return $query->row()->$field;
            } else {
                return '';
            }
        }
    }
}
if (!function_exists('get_cpo_by_poid')) {
    function get_cpo_by_poid($id = '', $field = '', $table = '', $val= '')
    {
        if (!$id || !$field) {
            return '';
        }
        if ($table == '') {
            $table = $GLOBALS['var']['act'];
        }
        if (is_array($id)) {
            $data = '';
            foreach ($id as $key => $value) {
                $ci = &get_instance();
                $ci->db->where('scd.po', $value);
                $ci->db->select($field);
                $ci->db->join('customer_purchase_order AS pod', 'pod.id = scd.cpo', 'left');
                $query = $ci->db->get('sales_contract_details as scd');
                if ($query->num_rows > 0) {
                    $data .= ($key == 0 ? '' : ', ') . $query->row()->$field;
                } else {
                    $data .= ($key == 0 ? '' : ', ') . '';
                }
            }
            return $data;
        } else
        {
            $ci = &get_instance();
            $ci->db->where('id', $id);
            $ci->db->where('deleted', 0);
            $ci->db->select($field);
            $query = $ci->db->get($table);
            if ($query->num_rows > 0) {
                return $query->row()->$field;
            } else {
                return '';
            }
        }
    }
}
