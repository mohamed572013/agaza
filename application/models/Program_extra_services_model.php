<?php

    class Program_extra_services_model extends CI_Model{

        private $table = 'programs_extra_service';

        public function __construct(){
            parent::__construct();
        }

        public function find($programs_extra_service_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id', $programs_extra_service_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function findWhere($where_array){
            $this->db->select('*');
            $this->db->from($this->table);
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

        public function add($array_date = array()){
            $this->db->insert($this->table, $array_date);
            return $this->db->insert_id();
        }

        public function update($data_array = array(), $where_array = array()){
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

        public function delete($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function resize_image($path, $file, $p){
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $path;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['new_image'] = './' . $p . $file;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        public function availableRooms($branches_id, $haj_umrah_program_flights_id){
            $query = $this->db->query('select * from hotel_rooms where branches_id=' . $whitelabel_id . ' and is_deleted=0 and id not in  (select hotel_rooms_id from haj_umrah_program_rooms_prices where haj_umrah_program_flights_id=' . $haj_umrah_program_flights_id . ' )');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
