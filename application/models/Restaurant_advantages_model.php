<?php

    class Restaurant_advantages_model extends CI_Model{

        private $_table = 'restaurants_features_all';

        public function __construct(){
            parent::__construct();
        }

        public function getAll($hotel_id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('restaurant_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function add($data_array){
            $this->db->insert($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
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

    }
