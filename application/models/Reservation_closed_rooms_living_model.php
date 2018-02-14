<?php

    class Reservation_closed_rooms_living_model extends CI_Model{

        private $_table = 'reservation_closed_rooms_living';

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

        public function GetNotLivingPersons($reservation_id){
            $sql = "SELECT *
						FROM  reservation_traveller
						WHERE reservation_traveller.reservation_id = $reservation_id
						AND  id NOT IN (
												SELECT reservation_traveller_id
												FROM reservation_closed_rooms_living
												WHERE reservation_id = $reservation_id  )
					 ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetRoomsNotLivingPersons($reservation_id){
            $sql = "SELECT reservation_closed_rooms.* , hotel_rooms.title_ar,hotel_rooms.no_of_bed
					FROM `reservation_closed_rooms`
					JOIN hotel_rooms ON hotel_rooms.id = reservation_closed_rooms.hotel_rooms_id
					WHERE reservation_closed_rooms.reservation_id = $reservation_id
							AND reservation_closed_rooms.no_of_rooms > reservation_closed_rooms.no_of_rooms_living
					 ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function TestTravellersliving($reservation_id, $allTravellersVals){
            $sql = "SELECT reservation_closed_rooms_living.*
					FROM `reservation_closed_rooms_living`
 					WHERE reservation_closed_rooms_living.reservation_id = $reservation_id AND reservation_traveller_id  IN ($allTravellersVals)

					 ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetTravellerInfo($reservation_id, $allTravellersVals){
            $sql = "SELECT reservation_traveller.*
					FROM `reservation_traveller`
 					WHERE reservation_traveller.reservation_id = $reservation_id AND reservation_traveller.id  IN ($allTravellersVals)
 					 ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetRoomOperationTravellerInfo($operation_number){
            $sql = "SELECT reservation_traveller.*
						FROM `reservation_traveller`
						JOIN reservation_closed_rooms_living ON reservation_closed_rooms_living.reservation_traveller_id = reservation_traveller.id
						WHERE reservation_closed_rooms_living.operation_number = $operation_number

 					 ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetRoomLiving($reservation_id){
            $sql = "SELECT reservation_closed_rooms_living.operation_number , reservation_closed_rooms_living.hotel_rooms_id , hotel_rooms.title_ar, hotel_rooms.no_of_bed
					FROM reservation_closed_rooms_living
					JOIN hotel_rooms ON hotel_rooms.id = reservation_closed_rooms_living.hotel_rooms_id
					WHERE reservation_closed_rooms_living.reservation_id = $reservation_id
					GROUP BY hotel_rooms.id";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetRoomLivingTravellers($reservation_id){
            $sql = "SELECT reservation_closed_rooms_living.* ,reservation_traveller.name , reservation_traveller.birthdate,reservation_traveller.gender
				    FROM reservation_closed_rooms_living
					JOIN reservation_traveller ON reservation_traveller.id = reservation_closed_rooms_living.reservation_traveller_id
					WHERE reservation_closed_rooms_living.reservation_id = $reservation_id
					GROUP BY reservation_traveller.id
";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetOperationNumber(){
            $sql = "SELECT MAX(operation_number) as operation_number
					FROM `reservation_closed_rooms_living`
  					 ";
            $query = $this->db->query($sql);
            $result = $query->result();
            if (\count($result) > 0 && $result[0]->operation_number > 0) {
                $operation_number = $result[0]->operation_number + 1;
            } else {
                $operation_number = 1;
            }
            return $operation_number;
        }

    }
    