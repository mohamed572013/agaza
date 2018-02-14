<?php

    class Visa_create_model extends CI_Model{

        private $_table = 'visas';
        private $visa_types_table = 'visa_types';
        private $visa_periods_table = 'visa_periods';
        private $visa_jobs_table = 'visa_jobs';
        private $visa_documents_table = 'visa_documents';
        private $places_table = 'places';

        public function __construct(){
            parent::__construct();
        }

        public function last_added_code($branches_id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('branches_id', $branches_id);
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->code;
            } else {
                return false;
            }
        }

        public function findById($id){
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

        public function findByCode($code){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('code', $code);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function findDocuments($visas_id){
            $this->db->select('visa_documents_id');
            $this->db->from('visas_documents');
            $this->db->where('visas_id', $visas_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function findWhere($where_array){
            $this->db->select('*');
            $this->db->from($this->_table);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function findForDelete($program_id, $table){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('programs_id', $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function add($array_date = array()){
            if ($this->db->insert($this->_table, $array_date)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
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

        public function update($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->update($this->_table, $array_date);
        }

        public function addByTable($table, $data_array){
            $this->db->insert($table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function updateByTableName($table, $data_array, $where_array){
            $this->db->where($where_array);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($table, $data_array);
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

        public function deleteByTable($table, $where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function visa_types($id){
            $this->db->select('*');
            $this->db->from($this->visa_types_table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function visa_periods($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->visa_periods_table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function places($id){
            $this->db->select('*');
            $this->db->from($this->places_table);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', 0);
            $this->db->where('branches_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function visa_jobs($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->visa_jobs_table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function visa_documents($branches_id){
            $this->db->select('*');
            $this->db->from($this->visa_documents_table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
