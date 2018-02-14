<?php

    class Hotel_data_model extends CI_Model{

        private $hotels_table = 'maka_madina_hotels';
        private $rooms_table = 'hotel_rooms';
        private $extra_services_table = 'hotel_extra_services';
        private $chalets_others = 'chalets_others';
        private $places_table = 'places';

        public function __construct(){
            parent::__construct();
        }

        public function allHotels($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->hotels_table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function rooms($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->rooms_table);
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function chalets_others($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->chalets_others);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function countries($branches_id){
            $this->db->select('*');
            $this->db->from($this->places_table);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', 0);
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function extra_services($whitelabel_id){
            $this->db->select('*');
            $this->db->from($this->extra_services_table);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function roomsAvailable($whitelabel_id, $hotel_id){
            $query = $this->db->query('select * from hotel_rooms where branches_id=' . $whitelabel_id . ' and is_deleted=0 and id not in  (select hotel_rooms_id from hotels_rooms where branches_id=' . $whitelabel_id . ' and hotel_id=' . $hotel_id . ' and is_deleted=0 )');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function extraServicesAvailable($whitelabel_id, $hotel_id){
            $query = $this->db->query('select * from hotel_extra_services where branches_id=' . $whitelabel_id . ' and is_deleted=0 and id not in  (select hotel_services_id from hotels_extra_services where branches_id=' . $whitelabel_id . ' and hotel_id=' . $hotel_id . ' and is_deleted=0 )');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function find($whitelabel_id, $hotel_extra_service_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('branches_id', $whitelabel_id);
            $this->db->where('id', $hotel_extra_service_id);
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
