<?php

    class Visitors_model extends CI_Model{

        private $table = 'visitors';
        public function __construct(){
            parent::__construct();
        }

        public function add($array_date = array()){
            $this->db->insert($this->table, $array_date);
            return $this->db->insert_id();
        }

        
    }
    