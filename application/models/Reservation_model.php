<?php

    class Reservation_model extends CI_Model{

        private $_table = 'reservation';

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

        public function GetAllPages($array_where = array()){
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

        public function GetWherePaging($table, $order, $order_type, $cond = array(), $pag_index, $per_page){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $this->db->limit($per_page, $pag_index);
            $query = $this->db->get($table);
            return $query->result();
            //return $this->db->last_query();
        }

        public function getCountAllReservation(){
            $res_count = 0;
            $sql = "SELECT count(reservation.id) as res_count
            FROM  `reservation`
            JOIN programs ON programs.id = reservation.programs_id
            JOIN flight_reservation ON flight_reservation.id = reservation.flight_reservation_id
            where reservation.is_deleted = 0
                ";
            $query = $this->db->query($sql);
            $result = $query->result();
            if (\count($result) > 0 && $result[0]->res_count) {
                $res_count = $result[0]->res_count;
            }
            return $res_count;
        }

        public function getAllReservation($page_index, $per_page){
            $sql = "SELECT reservation.id, reservation.reservation_code, programs.our_code,
            programs.title_ar, flight_reservation.going_date
            FROM  `reservation`
            JOIN programs ON programs.id = reservation.programs_id
            JOIN flight_reservation ON flight_reservation.id = reservation.flight_reservation_id
			where reservation.is_deleted = 0
            order by id DESC   limit $page_index,$per_page
                ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function getAllReservation2($per_page, $page_index, $where_array){
            $this->db->select('reservation.id, reservation.reservation_code, programs.our_code,
            programs.title_ar, flight_reservation.going_date'
            );
            $this->db->from('reservation');
            $this->db->join('programs_flight', 'reservation.programs_flight_id = programs_flight.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs', 'programs.id = programs_flight.programs_id');
            $this->db->where("reservation.is_deleted", "0");
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->limit($per_page, $page_index);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function GetCountWhere($table, $order, $order_type, $cond = array()){
            $count_id = 0;
            $this->db->select('count(id) as count_id');
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            $result = $query->result();
            if ($result[0]->count_id) {
                $count_id = $result[0]->count_id;
            }
            return $count_id;
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

    }
    