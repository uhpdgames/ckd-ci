<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promotion_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function show($uri, $num_rows = false)
	{
		$this->db->from('promotion as t1');
		$filter = $this->input->get('filter', true);
		if (is_array($filter) && count($filter)) {
			foreach ($filter as $key => $item) {
				if (is_array($item) && count($item)) {
					if ($item['from']) {
						$this->db->where('t1.' . $key . ' >= "' . trim($item['from']) . ' 00:00:00"');
					}
					if ($item['to']) {
						$this->db->where('t1.' . $key . ' <= "' . trim($item['to']) . ' 23:59:59"');
					}
				} else {
					$item = trim($item);
					if ($item != '') {
						if ($item == 'Yes' || $item == 'No') {
							if ($item == 'Yes') {
								$item = 1;
							}
							if ($item == 'No') {
								$item = 0;
							}
							$this->db->where('(t1.' . $key . ' LIKE "%' . $item . '%" OR t1.' . $key . ' = "' . $item . '")');
						} else {
							$this->db->like('t1.' . $key, $item);
                            if ($key == 'Status') {
                                $this->db->where('t1.' . $key, $item);
                            }
						}
					}
				}
			}
		}
		if ($uri['limit'] == '') {
			$uri['limit'] = $GLOBALS['var']['limit_perpage'];
		}
		if ($uri['q'] != '') {
			$this->db->join('promotion_details as t2', 't1.id = t2.parent', 'left');
			$this->db->where(sprintf('(t1.`code` LIKE "%%%s%%" OR t1.`subject` LIKE "%%%s%%" OR t1.`type` LIKE "%%%s%%" OR t2.`supplier_part` LIKE "%%%s%%" OR t2.`manufacturer_part_number` LIKE "%%%s%%" OR t2.`description` LIKE "%%%s%%" OR t2.`manufacturer` LIKE "%%%s%%")', $uri['q'], $uri['q'], $uri['q'], $uri['q'], $uri['q'], $uri['q'], $uri['q']));
		}
		if ($uri['status'] != '') {
			$this->db->where('t1.status', $uri['status']);
		}
		if ($GLOBALS['user']['level'] != 1 && $GLOBALS['user']['level'] != 2) {
            // $this->db->where('(t1.StaffNumber = "' . $GLOBALS['user']['id'] . '")');
        }
		$this->db->where('t1.deleted', $uri['deleted']);
		if ($num_rows) {
			$this->db->select('t1.id');
			return $this->db->get()->num_rows();
		} else {
			$this->db->limit($uri['limit'], $uri['rowstart']);
			if ($uri['q'] != '') {
		        $this->db->select('t1.*, t2.* AS childen');
		      }
			$this->db->select('t1.*, t1s.name_vn as name, t1s.StatusKey, t1s.color, t1s.sort_order, IF (' . sprintf('t1.date_added >= %1$s', $this->db->escape($GLOBALS['user']['last_login'])) . ', 1, 0) as isnew', false);
			$this->db->join('orders_status as t1s', 't1.Status = t1s.StatusKey AND t1s.type = "Promotion" AND t1s.deleted = 0', 'left');
			$this->db->order_by('t1s.sort_order asc, t1.Status asc, t1.type asc, t1.id asc');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}
	}

	public function list_old($mfr_part)
	{
		if (!$mfr_part) {
			return false;
		}
		$this->db->from('purchase_order_details AS pod');
		$this->db->where('MfrPart', $mfr_part);
		$this->db->select('pod.*, t1.code, t1.PODate, t1.VendorName');
		$this->db->join('purchase_order AS po', 'pod.POID = t1.id', 'left');
		$this->db->order_by('t1.PODate', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function show_details($parent, $uri, $num_rows = false) {
		if (!$parent) {
			return false;
		}
		$this->db->from('promotion_details AS t1');
		$this->db->where('t1.parent', $parent);
		if ($num_rows) {
			$this->db->select('t1.id');
            return $this->db->get()->num_rows();
		} else {
			if ($uri['limit'] == '') {
				$uri['limit'] = $GLOBALS['var']['limit_perpage'];
			}
			$this->db->limit($uri['limit'], $uri['rowstart']);
            $this->db->select('t1.*');
            $this->db->order_by('t1.sort_order asc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
		}
	}

	public function remove_details($id = '', $oids = false)
	{
		if (!$id || !is_array($oids)) {
			return false;
		}
		$this->db->where('POID', $id);
		$this->db->where_not_in('did', $oids);
		$this->db->delete('purchase_order_details');
		return $id;
	}
}

/* End of file promotion_model.php */
/* Location: ./application/models/promotion_model.php */
