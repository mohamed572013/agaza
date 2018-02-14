<?php

    class Haj_umrah_program_flights_model extends CI_Model{

        private $table = 'haj_umrah_program_flights';

        public function __construct(){
            parent::__construct();
        }

        public function find($haj_umrah_program_flights_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id', $haj_umrah_program_flights_id);
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

        public function findWhereForEdit($haj_umrah_program_id, $old_flight_reservation_id, $new_flight_reservation_id){
            $this->db->select('*');
            $this->db->from($this->table)
                    ->group_start()
                    ->where('haj_umrah_programs_id', $haj_umrah_program_id)
                    ->where('flight_reservation_id !=', $old_flight_reservation_id)
                    ->group_end()
                    ->where('flight_reservation_id', $new_flight_reservation_id);
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

        public function GetAllFlights($where_array = array()){
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
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function GetAllProgramFlights($haj_umrah_Programs_id){
            $this->db->select(' haj_umrah_program_flights.id as haj_umrah_Programs_id , flight_reservation.*  , c1.title_ar AS name_from_city, '
                    . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                    . 'c4.title_ar AS  return_name_to_city , travel_way.title_ar as travel_way');

            $this->db->from('flight_reservation');
            $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
            $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
            $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
            $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');
            $this->db->join('travel_way', 'flight_reservation.travel_way_id = travel_way.id');

            $this->db->join('haj_umrah_program_flights', 'flight_reservation.id = haj_umrah_program_flights.flight_reservation_id');
            $this->db->where("haj_umrah_program_flights.haj_umrah_programs_id", $haj_umrah_Programs_id);
            $this->db->where("haj_umrah_program_flights.active", 1);
            $query = $this->db->get();
            return $query->result();
        }

    }
