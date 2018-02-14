<?php

    class Users_model extends CI_Model{

        private $_table = 'users';

        public function __construct(){
            parent::__construct();
        }

        public function find($user_id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function GetUsers2($company_id = false, $where_array = array()){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->join('branches', 'branches.id = users.branches_id');
            $this->db->join('groups', 'groups.group_id = users.user_group_id');
            if ($company_id) {
                $this->db->where('branches.id', $company_id);
                $this->db->or_where('branches.parent_id', $company_id);
                $this->db->where('branches.active', 1);
                $this->db->where('branches.is_deleted', 0);
            }

            if (count($where_array) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {

                return $query->result();
            } else {
                return false;
            }
        }

        public function GetUser($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->order_by('user_id', 'ASC');
            $this->db->join('groups', 'groups.group_id = users.user_group_id');
            $this->db->where('user_id', $id);
            $query = $this->db->get();
            $array_return = array();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row;
            } else {
                return false;
            }
        }

        public function GetUsers($array_where = array(), $limit = 10000, $owner = false){
            $this->db->select('*');
            $this->db->from($this->_table);
            if (isset($array_where) && \count($array_where) > 0) {
                $array_where['user_is_delete'] = '0';
                $this->db->where($array_where);
            } else {
                $this->db->where('user_is_delete = 0');
            }
            $this->db->order_by('user_id', 'ASC');
            $this->db->join('groups', 'groups.group_id = users.user_group_id');
            if (!$owner) {
                $this->db->join('departments', 'departments.id = users.departments_id');
            }

            $this->db->join('branches', 'branches.id = users.branches_id');
            if (!$owner) {
                $this->db->where('departments.active', 1);
                $this->db->where('departments.is_deleted', 0);
            }

            $this->db->where('branches.active', 1);
            $this->db->where('branches.is_deleted', 0);


            $this->db->limit($limit);
            $query = $this->db->get();


            $array_return = array();
            foreach ($query->result() as $key => $val) {
                $val->group_options = \json_decode($val->group_options, true);
                //\pr($val->group_options,1);
                $array_return[] = $val;
            }
            return $array_return;
        }

        public function GetAllUsers($array_where = array(), $limit = 10000){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, $limit);
            return $query->result();
        }

        public function add($array_date = array()){
            $this->db->insert($this->_table, $array_date);
            return $this->db->insert_id();
        }

        public function update($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->update($this->_table, $array_date);
        }

        public function delete($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table, $array_date);
        }

        public function GetWhere($table, $order, $order_type, $cond = array()){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function GetAllMainMenuPages($parent_id = "", $pages_id = ""){
            $sql = "SELECT *  from pages WHERE parent_id = $parent_id AND id  in ($pages_id) "
                    . "ORDER BY this_order ASC";
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
        }

        public function getUsersTypes(){
            $this->db->select('*');
            $this->db->from('user_types');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCompanyBranches($company_id){
            $this->db->select('*');
            $this->db->from('departments');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('branches_id', $company_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCurrentCompany($company_id){
            $this->db->select('*');
            $this->db->from('branches');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('id', $company_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getCurrentbranch($branch_id){
            $this->db->select('*');
            $this->db->from('departments');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('id', $branch_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function GetWhero($table, $order, $order_type, $cond = array()){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

    }
