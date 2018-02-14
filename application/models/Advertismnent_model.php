<?php

    class Advertismnent_model extends CI_Model{

        private $table = 'advertismnent';
        public $images_dimensions = array(
            's' => array('width' => 476, 'height' => 442),
        );

        public function __construct(){
            parent::__construct();
        }

        public function add($array_date = array()){
            $this->db->insert($this->table, $array_date);
            return $this->db->insert_id();
        }

        public function update($data_array = array(), $where_array = array()){
            $this->db->where($where_array);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($this->table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->table, $array_date);
        }

        public function do_upload($image, $config){
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($image)) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $file_resized_name = resize5($data, 'uploads/advertismnent/', $this->images_dimensions, true);
                return $file_resized_name;
            }
        }

        public function getAdvertismnent($branches_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

    }
    