<?php

    class Pay_ways_model extends CI_Model{

        private $_table = 'pay_ways';

        public function __construct(){
            parent::__construct();
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

        public function getAll(){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where("active", 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
