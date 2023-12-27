<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * fnCMS
 *
 * @package     fnCMS Project
 * @since       Monday, October 21, 2013, 6:00 PM
 * @final
 * @category    Models
 * @see 		Users
 * @author      PHUOCNGUYEN - HITI Dev Team
 * @copyright   Copyright (c) 2013, HITI Corp
 */

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_users($uri, $num_rows = false, $part = '')
    {
        if ($uri['limit'] == '') {
            $uri['limit'] = 50;
        }
        $this->db->from('users AS u');
        $filter = $this->input->get('filter', true);
        if (is_array($filter) && count($filter)) {
            foreach ($filter as $key => $item) {
                if (is_array($item) && count($item)) {
                    if ($item['from']) {
                        $this->db->where('u.' . $key . ' >= "' . trim($item['from']) . ' 00:00:00"');
                    }
                    if ($item['to']) {
                        $this->db->where('u.' . $key . ' <= "' . trim($item['to']) . ' 23:59:59"');
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
                            $this->db->where('(u.' . $key . ' LIKE "%' . $item . '%" OR u.' . $key . ' = "' . $item . '")');
                        } else {
                            $this->db->like('u.' . $key, $item);
                        }
                    }
                }
            }
        }
        $this->db->where_not_in('u.part', 0);
        $this->db->where('u.deleted', $uri['deleted']);
        if ($GLOBALS['var']['act'] == 'data_attts') {
            $this->db->where('u.anluong', 1);
        }
        if ($num_rows) {
            $this->db->select('id');
            return $this->db->get()->num_rows();
        } else {
            $this->db->select('u.*');
            if ($uri['orderby'] == '') {
                $uri['orderby'] = 'id';
            }
            if ($uri['ordermode'] == '') {
                $uri['ordermode'] = 'desc';
            }
            $this->db->select('n.name_vn AS level, v.name_vn AS position, p.name_vn AS department, g.name_vn AS cachchamcong');
            $this->db->join('usergroups AS n', 'u.level = n.id', 'left');
            $this->db->join('positions AS v', 'u.position = v.id', 'left');
            $this->db->join('departments AS p', 'u.part = p.id', 'left');
            $this->db->join('GioChamCong AS g', 'u.cachchamcong = g.id', 'left');
            if ($GLOBALS['var']['act'] != 'data_attts') {
                $this->db->order_by($uri['orderby'] . ' ' . $uri['ordermode']);
            }
            if ($uri['limit'] != -1) {
                $this->db->limit($uri['limit'], $uri['rowstart']);
            }
            $this->db->order_by('fullname');
            if($part !='') $this->db->where('p.id',$part);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }
    public function get_htmlpostion($id)
    {
        if ($id != '') {
            $this->db->where('parent', $id);
        }

        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->select('id, name_vn');
        $this->db->order_by('name_vn', 'ASC');
        $q = $this->db->get('positions');
        $o = '<option value="">Select...</option>';
        $o .= '<option value="13">Director</option>';
        foreach ($q->result() as $r) {
            if( $r->id !=13 ) $o .= '<option value="' . $r->id . '">' . $r->name_vn . '</option>';
        }
        return $o;
    }

    public function get_department()
    {
        $o = array();
        $this->db->select('id, name_vn');
        $this->db->order_by('name_vn', 'ASC');
        $q = $this->db->get('departments');
        foreach ($q->result() as $r) $o[$r->id] = $r->name_vn;
        return $o;
    }

    public function show_groups($uri)
    {
        if ($uri['q'] != '') {
            $this->db->like('name_vn', $uri['q']);
        }
        $this->db->where('deleted', $uri['deleted']);
        $this->db->order_by('sort_order ASC');
        $query = $this->db->get('usergroups');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function show_signing_approval($uri)
    {
        if ($uri['q'] != '') {
            $this->db->like('name_vn', $uri['q']);
        }
        $this->db->where('deleted', $uri['deleted']);
        $this->db->order_by('sort_order ASC');
        $query = $this->db->get('signing_approval');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function group($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usergroups');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            $fields = $this->db->field_data('usergroups');
            $default_data = array();
            foreach ($fields as $field) {
                $default_data[$field->name] = $field->default;
            }
            return $default_data;
        }
    }

    public function usergroups()
    {
        $this->db->select('id, name_vn');
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('id ASC');
        $query = $this->db->get('usergroups');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $groups[$row['id']] = $row['name_vn'];
            }
        }
        return $groups;
    }

    public function permissions()
    {
        $this->db->select('id, name_vn');
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('id ASC');
        $query = $this->db->get('permissions');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $groups[$row['id']] = $row['name_vn'];
            }
        }
        return $groups;
    }
  public function signing_approval()
    {
        $this->db->select('id, name_vn');
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('id ASC');
        $query = $this->db->get('signing_approval');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $groups[$row['id']] = $row['name_vn'];
            }
        }
        return $groups;
    }
    public function branchs()
    {
        $this->db->select('id, name_vn');
        $this->db->where('deleted', 0);
        $this->db->where('active', 1);
        $this->db->order_by('name_vn ASC');
        $query = $this->db->get('branchs');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $groups[$row['id']] = $row['name_vn'];
            }
        }
        return $groups;
    }

    public function get_rights($cat = 0)
    {
        $this->db->where('cat', $cat);
        $this->db->where('active', 1);
        $this->db->where('deleted', 0);
        $this->db->select('image, name_vn, rights, file');
        $this->db->order_by('sort_order DESC');
        $query = $this->db->get('modules');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function save_rights($data, $id)
    {
        if (!is_array($data)) {
            return false;
        }
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        write_log('permiss_users', $data['username']);
        return true;
    }

    public function save_rights_group($data, $id)
    {
        if (!is_array($data)) {
            return false;
        }
        $this->db->where('id', $id);
        $this->db->update('usergroups', $data);
        write_log('permiss_usergroups', $data['name_vn']);
        return true;
    }

    public function users_list() {
        $this->db->from('users AS t1');
        $this->db->select('t1.id, t1.fullname, t2.name_vn AS position_name, t3.name_vn AS department');
        $this->db->where('t1.active', 1);
        $this->db->where('t1.deleted', 0);
        $this->db->join('positions AS t2', 't2.id = t1.position', 'left');
        $this->db->join('departments AS t3', 't3.id = t1.part', 'left');
        $this->db->order_by('t1.id ASC');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
