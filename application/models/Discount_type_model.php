<?php

    class Discount_type_model extends CI_Model{

        private $_table = 'discount_types';

        public function __construct(){
            parent::__construct();
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
