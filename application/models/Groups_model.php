<?php

    class Groups_model extends CI_Model{

        private $_table = 'groups';

        public function __construct(){
            parent::__construct();
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('group_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function findByName($name){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('group_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function GetGroups($array_where = array()){
            if (count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('group_id', 'ASC');
            $query = $this->db->get($this->_table);
            return $query->result();
        }

        public function GetAllPages(){
            $this->db->where("parent_id !=", 0);
            $this->db->order_by("parent_id", "ASC");
            $this->db->order_by("active", 1);
            $query = $this->db->get("pages");
            return $query->result();
        }

        public function getPages($type = false, $user_main_pages_ids = false, $where_array = array()){
            $this->db->select('*');
            $this->db->from('pages');
            if ($type && $type == 'main') {
                $this->db->where("parent_id", 0);
            }
            if ($type && $type == 'sub') {
                $this->db->where("parent_id !=", 0);
            }
            if ($user_main_pages_ids) {
                $this->db->where_in('id', $user_main_pages_ids);
            }
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllMainMenu($pages_ids){
            $menu_ids = "";
            $sql = "SELECT DISTINCT(parent_id) as parent_id from pages WHERE id in ($pages_ids) "
                    . "ORDER BY parent_id ASC";
            $query = $this->db->query($sql);
            $result = $query->result();
            if (\count($result) > 0) {
                foreach ($result as $value) {
                    $menu_ids[] = $value->parent_id;
                }
            }
            $menu_ids = implode(",", $menu_ids);
            return $menu_ids;
        }

        public function GetAllGroups($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
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

    }
