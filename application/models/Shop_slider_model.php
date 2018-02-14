<?php

    class Shop_slider_model extends CI_Model{

        private $_table = 'shops_sliders';
        public $images_dimensions = array(
            's' => array('width' => '150', 'height' => 82),
            'l' => array('width' => '750', 'height' => 411),
        );

        public function __construct(){
            parent::__construct();
        }

        public function getAll($restaurant_id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('shop_id', $restaurant_id);
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

        public function do_upload($image, $config, $new_path){
            //pri("upload");
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($image)) {
                  
                return FALSE;
            } else {
                //pri("else");
                $data = $this->upload->data();
                $file_resized_name = resize5($data, $new_path, $this->images_dimensions, true);
                return $file_resized_name;
            }
        }

    }
