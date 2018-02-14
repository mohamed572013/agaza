<?php

    class Programs_rooms_prices_model extends CI_Model{

        private $_table = 'programs_rooms_prices';

        public function __construct(){
            parent::__construct();
        }

        public function GetPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetWherenotId($table, $order, $order_type, $cond = array(), $id){
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

        public function GetProgFlightsWhere($programs_flight_id){
            $this->db->select('programs_flight.id , programs.our_code ,programs.title_ar,flight_reservation.going_date');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->where("programs_flight.id", $programs_flight_id);
            $query = $this->db->get();
            return $query->result();
        }

        public function GetallProgramRooms_prices($Programs, $branches_id){
            $this->db->select('hotel_rooms.title_ar , programs_rooms_prices.*');

            $this->db->from('programs_rooms_prices');
            $this->db->join('hotel_rooms', 'programs_rooms_prices.hotel_rooms_id = hotel_rooms.id');
            $this->db->where("programs_rooms_prices.active", 1);
            $this->db->where("programs_rooms_prices.programs_flight_id", $Programs);
            $this->db->where("programs_rooms_prices.branches_id", $branches_id);
            $query = $this->db->get();
            return $query->result();
//			return $this->db->last_query();
        }

        public function GetAllPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
            return $query->result();
        }

        public function GetPrograms_rooms_prices($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetAllPrograms_rooms_prices($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
            return $query->result();
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

        public function add($array_date = array()){
            $this->db->insert($this->_table, $array_date);
        }

        public function update($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->update($this->_table, $array_date);
        }

        public function delete($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table, $array_date);
        }

        public function do_upload($image, $path){
            $this->load->library('upload');

            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = 'gif|jpeg|jpg|png';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($image)) {
                return FALSE;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name'], $path);

                return $data['upload_data']['file_name'];
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

    }
