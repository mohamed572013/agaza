<?php

    class About_us_model extends CI_Model{

        private $table = 'about_us';
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

        public function addAgaza($data) {
            $this->db->insert("agaza_reserve", $data);
            return $this->db->insert_id();
        }

        public function getAgaza() {
            $this->db->select('agaza_reserve.*, programs.agaza_title_ar');
            $this->db->from("agaza_reserve");
            $this->db->join("programs", "agaza_reserve.program_id=programs.id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
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
                $file_resized_name = resize5($data, 'uploads/about_us/', $this->images_dimensions, true);
                return $file_resized_name;
            }
        }

        public function getAboutUs($branches_id){
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
    