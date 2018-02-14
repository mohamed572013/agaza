<?php

    class Flight_reservation_model extends CI_Model{

        private $_table = 'flight_reservation';

        public function __construct(){
            parent::__construct();
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id', $id);
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

        public function GetWhereEdit($id){
            $this->db->select(' flight_reservation.*  , c1.title_ar AS name_from_city, '
                    . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                    . 'c4.title_ar AS  return_name_to_city');

            $this->db->where("flight_reservation.id", $id);
            $this->db->from('flight_reservation');
            $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
            $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
            $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
            $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');

            $query = $this->db->get();
            return $query->result();
        }

        public function GetWherePaging($table, $order, $order_type, $cond = array(), $pag_index, $per_page){
            $this->db->select(' flight_reservation.*  , c1.title_ar AS name_from_city, '
                    . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                    . 'c4.title_ar AS  return_name_to_city , travel_way.title_ar as travel_way');
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where("flight_reservation.$key", $value);
                }
            }

            $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
            $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
            $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
            $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');
            $this->db->join('travel_way', 'flight_reservation.travel_way_id = travel_way.id');

            $this->db->order_by("$table.$order", "$order_type");
            $this->db->limit($per_page, $pag_index);
            $query = $this->db->get($table);
            return $query->result();
            //return $this->db->last_query();
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

        public function add($array_data = array()){
            if ($this->db->insert($this->_table, $array_data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function update($data_array = array(), $where_array = array()){
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
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

    }
