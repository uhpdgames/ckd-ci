<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * fnCMS
 *
 * @package     fnCMS Project
 * @since       Wednesday, May 20, 2015, 8:00 AM
 * @final       
 * @category    Models
 * @see 		Ajax
 * @author      10ngon - fnDev Team
 * @copyright   Copyright (c) 2015, fnDev
 */

class Ajax_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function move_item($table, $id, $cat, $name) {
        $this->db->where('id', $id);
        $this->db->update($table, array('cat' => $cat, 'date_modified' => date(TIME_SQL)));
        if ($name) {
            write_log('move_' . $table, $name);
        }
        return true;
    }

    // public function del_restore_item($table, $id, $mode, $name = '')
    // {
    //     if ($mode == 'del') {
    //         $this->db->where('id', $id);
    //         $this->db->update($table, array('deleted' => 1));
    //     }
    //     if ($mode == 'restore') {
    //         $this->db->where('id', $id);
    //         $this->db->update($table, array('deleted' => 0));
    //     }
    //     if ($mode == 'remove') {
    //         if ($table == 'properties_categories') {
    //             $field = get_data($table, 'id = "' . $id . '"', 'keyword');
    //             $type = get_data($table, 'id = "' . $id . '"', 'type');
    //             if ($this->db->table_exists($type)) {
    //                 if ($this->db->field_exists($field, $type)) {
    //                     $this->db->query('ALTER TABLE ' . $type . ' DROP ' . $field);
    //                 }
    //             }
    //         }
    //         if ($table == 'branchs') {
    //             if ($this->db->field_exists('tonkho' . $id, 'products')) {
    //                 $this->db->query('ALTER TABLE products DROP tonkho' . $id);
    //             }
    //         }
    //         if ($table == 'sales_order') {
    //             $this->db->where('SalesOrderID', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         if ($table == 'purchase_order') {
    //             $this->db->where('POID', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         if ($table == 'rfq') {
    //             $this->db->where('RFQID', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         if ($table == 'customer_sales_contract') {
    //             $this->db->where('CustomerSCID', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         if ($table == 'sales_contract') {
    //             $this->db->where('SCID', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         if ($table == 'stock_inout') {
    //             $this->db->where('parent', $id);
    //             $this->db->delete($table . '_details');
    //         }
    //         $this->db->where('id', $id);
    //         $this->db->delete($table);
    //     }
    //     if ($table != 'userlogs' && $name) {
    //         write_log($mode . '_' . $table, $name);
    //     }
    //     return true;
    // }

    public function del_restore_item($table, $id, $mode, $name = '')
    {
        if ($mode == 'del') {
            // nam.th dev ...
            if($table == 'purchase_order'){                
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 1));
                $this->db->flush_cache();
                $this->db->where('POID', $id);
                $this->db->update('customer_received_date_details', array('deleted' => 1));           
            //  ... #nam.th dev
            } else if ($table == 'customer_purchase_order') {
                // nam.th dev 20181222 ...
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 1));
                
                $this->db->flush_cache();
                $this->db->where('CPOID', $id);
                $this->db->update('customer_received_date', array('deleted' => 1));
                //  ... #nam.th dev
            } else if ($table == 'project_finished_date') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 1));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('project_finished_date_details', array('deleted' => 1));
            } else if ($table == 'kpis_platform') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 1));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('kpis_platform_details', array('deleted' => 1));

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->update('kpis_platform_subdetails', array('deleted' => 1));
            } else if ($table == 'my_kpis') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 1));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('my_kpis_details', array('deleted' => 1));

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->update('my_kpis_subdetails', array('deleted' => 1));
            } else {
                $this->db->where('id', $id);
                $this->db->update($table, array('deleted' => 1));
            }
        }
        if ($mode == 'restore') {
             // nam.th dev ...
             if($table == 'purchase_order'){                
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 0));
                $this->db->flush_cache();
                $this->db->where('POID', $id);
                $this->db->update('customer_received_date_details', array('deleted' => 0));           
            //  ... #nam.th dev
            } else if ($table == 'customer_purchase_order') {
                // nam.th dev 20181222 ...
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 0));
                
                $this->db->flush_cache();
                $this->db->where('CPOID', $id);
                $this->db->update('customer_received_date', array('deleted' => 0));
                //  ... #nam.th dev
            } else if ($table == 'project_finished_date') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 0));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('project_finished_date_details', array('deleted' => 0));
            } else if ($table == 'kpis_platform') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 0));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('kpis_platform_details', array('deleted' => 0));

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->update('kpis_platform_subdetails', array('deleted' => 0));
            } else if ($table == 'my_kpis') {
                $this->db->start_cache();
                $this->db->where('id', $id);
                $this->db->stop_cache();
                $this->db->update($table, array('deleted' => 0));
                
                $this->db->flush_cache();
                $this->db->where('Parent', $id);
                $this->db->update('my_kpis_details', array('deleted' => 0));

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->update('my_kpis_subdetails', array('deleted' => 0));
            } else {
                $this->db->where('id', $id);
                $this->db->update($table, array('deleted' => 0));
            }            
        }
        if ($mode == 'remove') {
            if ($table == 'properties_categories') {
                $field = get_data($table, 'id = "' . $id . '"', 'keyword');
                $type = get_data($table, 'id = "' . $id . '"', 'type');
                if ($this->db->table_exists($type)) {
                    if ($this->db->field_exists($field, $type)) {
                        $this->db->query('ALTER TABLE ' . $type . ' DROP ' . $field);
                    }
                }
            }
            if ($table == 'branchs') {
                if ($this->db->field_exists('tonkho' . $id, 'products')) {
                    $this->db->query('ALTER TABLE products DROP tonkho' . $id);
                }
            }
            if ($table == 'sales_order') {
                $this->db->where('SalesOrderID', $id);
                $this->db->delete($table . '_details');
            }
            if ($table == 'purchase_order') {
                $this->db->where('POID', $id);
                // $this->db->delete($table . '_details');              // convert into comment by nam.th

                // nam.th dev ...
                $tables = array('customer_received_date_details',$table . '_details');
                $this->db->delete($tables); 
                //  ... |nam.th dev
            }
            // nam.th dev 20181222 ...
            if ($table == 'customer_purchase_order') {
                // delete CPO -> delete data on CRD
                $this->db->where('CPOID', $id);
                $this->db->delete('customer_received_date'); 
            }
            //  ... #nam.th dev
            if ($table == 'rfq') {
                $this->db->where('RFQID', $id);
                $this->db->delete($table . '_details');
            }
            if ($table == 'customer_sales_contract') {
                $this->db->where('CustomerSCID', $id);
                $this->db->delete($table . '_details');
            }
            if ($table == 'sales_contract') {
                $this->db->where('SCID', $id);
                $this->db->delete($table . '_details');
            }
            if ($table == 'project_finished_date') {
                $this->db->where('Parent', $id);
                $this->db->delete($table . '_details');
            }

            if ($table == 'kpis_platform') {
                $this->db->where('Parent', $id);
                $this->db->delete('kpis_platform_details');

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->delete('kpis_platform_subdetails');
            }
            if ($table == 'my_kpis') {
                $this->db->where('Parent', $id);
                $this->db->delete('my_kpis_details');

                $this->db->flush_cache();
                $this->db->where('Grandparent', $id);
                $this->db->delete('my_kpis_subdetails');
            }
            if ($table == 'stock_inout') {
                $parts = $this->get_parts_del($id);
                $this->db->where('parent', $id);
                $this->db->delete($table . '_details');
                if (is_array($parts) && count($parts)) {
                    $this->update_stock_when_del($parts);
                }
            }
            if ($table == 'stock_transfer') {
                $kkc = get_data('stock_transfer', 'id = "' . $id . '"', '*');
                if (is_array($kkc) && count($kkc)) {
                    record_del('stock_inout', 'id = "' . $kkc['goods_receipt'] . '" OR id = "' . $kkc['goods_issue'] . '"');
                    record_del('stock_inout_details', 'parent = "' . $kkc['goods_receipt'] . '" OR parent = "' . $kkc['goods_issue'] . '"');
                }
            }
            $this->db->where('id', $id);
            $this->db->delete($table);
        }
        if ($table != 'userlogs' && $name) {
            write_log($mode . '_' . $table, $name);
            write_log_active($mode, $table, $name);
        }
        return true;
    }

    private function get_parts_del($parent) {
        if ($parent) {
            $this->db->select('lot_code, category, supplier_part');
            $this->db->where('parent', $parent);
            $this->db->where('warehouse', 1);
            $query = $this->db->get('stock_inout_details');
            if ($query->num_rows()) {
                return $query->result_array();
            }
        }
    }

    private function update_stock_when_del($parts) {
        if (is_array($parts) && count($parts)) {
            foreach ($parts as $data) {
                if ($this->db->table_exists('digicat_' . $data['category'])) {
                    $this->db->query('UPDATE digicat_' . $data['category'] . ' p SET stock = (SELECT IFNULL(SUM(qty), 0) FROM stock_inout_details WHERE supplier_part = "' . $data['supplier_part'] . '" AND category = "' . $data['category'] . '" AND warehouse = 1) WHERE supplier_part = "' . $data['supplier_part'] . '"', false);
                }
                $this->db->query('UPDATE products p SET stock = (SELECT IFNULL(SUM(qty), 0) FROM stock_inout_details WHERE supplier_part = "' . $data['supplier_part'] . '" AND category = "' . $data['category'] . '" AND warehouse = 1) WHERE atcom_part_number = "' . $data['supplier_part'] . '"', false);
                // $this->updateWarehouse($data['lot_code'], $data['supplier_part']);
                $this->inventoryStatistics($data['lot_code'], $data['supplier_part']);
            }
        }
    }

    private function inventoryStatistics($lot_code = '', $supplier_part = '') {
        $parts = get_data('stock_inout_details', 'lot_code = "' . $lot_code . '" AND supplier_part = "' . $supplier_part . '" ORDER BY id ASC', '**');
        if (is_array($parts) && count($parts)) {
            $inventory = 0;
            foreach ($parts AS $part) {
                $inventory += $part['qty'];
                $this->db->query('UPDATE stock_inout_details SET inventory = ' . $inventory . ' WHERE id = "' . $part['id'] . '"', false);
            }
        }
    }

    private function updateWarehouse($id, $lot_code = '', $supplier_part = '') {
        if ($id && $lot_code == '' && $supplier_part == '') {
            echo 0;
            return false;
        }
        $inventory = $this->totalInout($lot_code, $supplier_part);
        $id = $this->getLastID($lot_code, $supplier_part)['id'];
        $data = array(
            'inventory' => $inventory
        );
        $this->db->where('lot_code', $lot_code);
        $this->db->where('supplier_part', $supplier_part);
        $this->db->where('id', $id);
        $this->db->update('stock_inout_details', $data);
        return false;
    }

    private function totalInout($lot_code = '', $supplier_part = '') {
        if ($lot_code == '' && $supplier_part == '') {
            echo 0;
            return false;
        }
        $this->db->select('SUM(qty) AS totalExport');
        $this->db->where('lot_code', $lot_code);
        $this->db->where('supplier_part', $supplier_part);
        $query = $this->db->get('stock_inout_details');
        if ($query->num_rows()) {
            return $query->row_array()['totalExport'];
        } else {
            echo 0;
        }
    }

    private function getLastID($lot_code = '', $supplier_part = '', $not_id) {
        if ($lot_code == '' && $supplier_part == '') {
            echo 0;
            return false;
        }
        $this->db->select('id, lot_code, inventory');
        $this->db->where('lot_code', $lot_code);
        $this->db->where('supplier_part', $supplier_part);
        if ($not_id) $this->db->where_not('id', $not_id);
        $this->db->order_by('id DESC');
        $query = $this->db->get('stock_inout_details');
        if ($query->num_rows()) {
            return $query->row_array();
        } else {
            echo 0;
        }
    }

    public function change_config($keyword, $value)
    {
        $this->db->where('keyword', $keyword);
        $this->db->update('config', array('value' => $value));
        write_log('update_config', $keyword);
        return true;
    }

    public function change_status($table, $id, $field, $status, $one_select = 0)
    {
        if ($one_select == 1) {
            $this->db->update($table, array($field => 0));
        }
        $this->db->where('id', $id);
        $this->db->update($table, array($field => $status));
    }
	public function change_fields($table, $id, $fields)
	{
		if($id){
			$this->db->where('id', $id);
			$this->db->update($table, $fields);
		}else{
			$this->db->insert($table, $fields);
		}
	}
    public function delete_image($table, $id, $field)
    {
        $this->db->select($field);
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $this->db->where('id', $id);
            $this->db->update($table, array($field => ''));
            return $data[$field];
        }
        return false;
    }

    public function sort_order($table, $IDs, $field = '', $cat = '', $orderby = '', $ordermode = '', $rowstart = '')
    {
        if ($orderby == '') {
            $orderby = 'sort_order';
        }
        if ($ordermode == '') {
            $ordermode = 'asc';
        }
        $this->db->select('id');
        if ($field != '') {
            $this->db->where($field, 1);
        }
        if ($cat != '') {
            $this->db->where('cat', $cat);
        }
        $query = $this->db->get($table);
        $rows = $query->num_rows();
        $IDs = explode(',', $IDs);
        for ($i = 0; $i < count($IDs); $i++) {
            $this->db->where('id', $IDs[$i]);
            $this->db->update($table, array($orderby => ($ordermode == 'desc' ? $rows - $i - $rowstart : $i + 1 + $rowstart)));
        }
        return true;
    }

    public function sort_nestable($table, $data, $id)
    {
        if (!is_array($data) || !$table || !$id) {
            return false;
        }
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return true;
    }

    public function update_price($id, $field, $table, $price)
    {
        $this->db->where('id', $id);
        $this->db->update($table, array($field => $price));
        return number_format($price);
    }

    public function check_code($code, $table, $id = '')
    {
        $this->db->where('code', $code);
        $this->db->where('deleted', 0);
        if ($id > 0) $this->db->where('id <>', $id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function load_product($cat, $id = '')
    {
        $this->db->query('SET NAMES "LATIN1"');
        $this->db->where('active', 1);
        $this->db->where('deleted', 0);
        if ($id > 0) {
            $this->db->where('id <>', $id);
        }
        $this->db->like('cat', '"' . $cat . '"');
        $this->db->where_not_in('id', $this->input->post('list', true));
        $this->db->select('id, name_vn, img1');
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function check_cat_child($table, $parent)
    {
        if (!$parent || !$this->db->field_exists('parent', $table) || !$this->db->field_exists('deleted', $table)) {
            return 0;
        }
        $this->db->where('parent', $parent);
        $this->db->where('deleted', 0);
        $this->db->select('id');
        return $this->db->get($table)->num_rows();
    }

    public function load_city($parent)
    {
        $this->db->query('SET NAMES "LATIN1"');
        $this->db->select('id, name_vn, price, type');
        $this->db->where('parent', $parent);
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('sort_order desc');
        $query = $this->db->get('regions');
        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function list_item($vars, $num_rows = false)
    {
        $vars['ids'] = str_replace('null', '', $vars['ids']);
        if ($vars['q'] != '') {
            $this->db->where(sprintf('(id IN (\'0' . str_replace(',', "','", $vars['ids']) . '\') OR name_vn LIKE "%%%s%%" OR code LIKE "%s%%" OR keyword LIKE "%%%s%%")', $vars['q'], $vars['q'], str_replace(' ', '-', $vars['q'])));
            if ($vars['cat']) {
                $this->db->where('cat', $vars['cat']);
            }
        } else {
            $this->db->where('(cat = "' . $vars['cat'] . '" OR id IN (\'0' . str_replace(',', "','", $vars['ids']) . '\'))');
        }
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('id desc');
        $this->db->select('id, img, name_vn');
        if ($vars['table'] == 'products') {
            $this->db->select('gia_ban, code');
        }
        if (!$num_rows && $vars['limit'] && $vars['rowstart'] != -1) {
            $this->db->limit($vars['limit'], $vars['rowstart']);
        }
        $query = $this->db->get($vars['table']);
        if ($num_rows) {
            return $query->num_rows();
        } else {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }

    public function check_filed($field, $valfield, $table, $id = '')
    {
        $this->db->where($field, $valfield);
        $this->db->where('deleted', 0);
        if ($id > 0) $this->db->where('id <>', $id);
        if ($this->db->get($table)->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

	public function get_supplier_with_staff($id) {
        $isAdmin = $GLOBALS['user']['level'] != 1 && $GLOBALS['user']['id'] != 14;
        $this->db->select('id, CompanyNameLo');
        $this->db->where(sprintf('(`id` LIKE "%s%%" OR `CompanyNameLo` LIKE "%s%%")', $id, $id));
        if ($isAdmin && !($isAdmin && $GLOBALS['per']['full'])) {
            $this->db->where('(AccountOwner LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR ChannelManager LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR Fae LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR Marketing LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR Purchaser LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR Accountant LIKE "%\"' . $GLOBALS['user']['id'] . '\"%" OR Logistic LIKE "%\"' . $GLOBALS['user']['id'] . '\"%")');
        }
        $this->db->where('active', 1);
        $this->db->where('deleted', 0);
        $query = $this->db->get('suppliers');
        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
