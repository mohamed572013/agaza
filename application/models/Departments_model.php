<?php

    class Departments_model extends CI_Model{

        private $_table = 'departments';

        public function __construct(){
            parent::__construct();
        }

        public function GetPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetAllPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
            return $query->result();
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

        public function GetWhere2($table, $order, $order_type, $cond = array()){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function GetWhereNotEqualId($table, $order, $order_type, $cond = array(), $id){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->where("id !=", $id);
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function find($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function add($array_date = array()){
            $this->db->insert($this->_table, $array_date);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function update($data_array = array(), $where_array = array()){
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getAllBranchesForOneCompany($company_id, $owner = false){

            if ($owner) {
                $sql = 'select * from departments where ';
                $sql.='is_deleted=0';
            } else {
                $sql = 'select * from departments where branches_id in (';
                $sql.='select id from branches where ';
                $sql.='parent_id="' . $company_id . '" or id="' . $company_id;
                $sql.= '")';
            }


            $query = $this->db->query($sql);

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

        public function isControll($branch_id){
            $this->db->select('*');
            $this->db->from('departments');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('id', $branch_id);
            $this->db->where('title_ar', 'controll');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

    }
