<?php

    class Programs_flight_model extends CI_Model{

        private $_table = 'programs_flight';

        public function __construct(){
            parent::__construct();
        }

        public function findById($program_flight){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id', $program_flight);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function GetPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetAllPages($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
            return $query->result();
        }

        public function GetPrograms_flight($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetAllPrograms_flight($array_where = array()){
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

        public function GetAllFlight($flights_where = array()){
            $this->db->select('   flight_reservation.*  , c1.title_ar AS name_from_city, '
                    . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                    . 'c4.title_ar AS  return_name_to_city , travel_way.title_ar as travel_way');

            $this->db->from('flight_reservation');
            $this->db->where("flight_reservation.passenger_num > ", "flight_reservation.passenger_reserved");
            $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
            $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
            $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
            $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');
            $this->db->join('travel_way', 'flight_reservation.travel_way_id = travel_way.id');
            if (count($flights_where) > 0) {
                foreach ($flights_where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function GetAllFlightPrograms($Programs){
            $this->db->select(' programs_flight.id as page_id , flight_reservation.*  , c1.title_ar AS name_from_city, '
                    . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                    . 'c4.title_ar AS  return_name_to_city , travel_way.title_ar as travel_way');

            $this->db->from('flight_reservation');
            $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
            $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
            $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
            $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');
            $this->db->join('travel_way', 'flight_reservation.travel_way_id = travel_way.id');

            $this->db->join('programs_flight', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->where("programs_flight.programs_id", $Programs);
            $this->db->where("programs_flight.active", 1);
            $query = $this->db->get();
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
