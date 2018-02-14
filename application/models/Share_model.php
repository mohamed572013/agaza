<?php

	class Share_model extends CI_Model{
		public function __construct(){
			parent::__construct();
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

		public function add($table, $array_date = array()){
			$this->db->insert($table, $array_date);
		}

		public function update($table, $array_date = array(), $where_array = array()){
			$this->db->where($where_array);
			$this->db->update($table, $array_date);
		}

		public function delete($table, $array_date = array(), $where_array = array()){
			$this->db->where($where_array);
			$this->db->delete($table, $array_date);
		}

		public function GetTravelFromCity(){
			/*
			  SELECT * FROM places
			 * JOIN flight_reservation ON flight_reservation.going_from_place = places.id 
			 * JOIN programs ON programs.flight_reservation_id = flight_reservation.id 
			 * 
			 * WHERE programs.active = 1 AND flight_reservation.active = 1 AND places.active = 1 AND places.place_id > 0 GROUP BY places.id

			 * 			 */
			$to_day = \date("Y-m-d");
			$this->db->select('places.*');
			$this->db->from('places');
			$this->db->join('flight_reservation', 'flight_reservation.going_from_place = places.id ');
			$this->db->join('programs_flight', 'programs_flight.flight_reservation_id = flight_reservation.id');
			$this->db->join('programs', 'programs_flight.programs_id = programs.id');
			$this->db->where('programs.active', '1');
			$this->db->where('programs_flight.active', '1');
			$this->db->where('flight_reservation.active', '1');
			$this->db->where('flight_reservation.going_date > ', "$to_day");
			$this->db->where('places.active', '1');
			$this->db->where('places.place_id !=', '0');
			$this->db->group_by('places.id');

			$query = $this->db->get();

			return $query->result();
		}
		public function GetTravelToCity(){
			/*
			  SELECT * FROM places
			 * JOIN flight_reservation ON flight_reservation.going_from_place = places.id 
			 * JOIN programs ON programs.flight_reservation_id = flight_reservation.id 
			 * 
			 * WHERE programs.active = 1 AND flight_reservation.active = 1 AND places.active = 1 AND places.place_id > 0 GROUP BY places.id

			 * 			 */
			$to_day = \date("Y-m-d");
			$this->db->select('places.*');
			$this->db->from('places');
			$this->db->join('flight_reservation', 'flight_reservation.going_to_place = places.id ');
			$this->db->join('programs_flight', 'programs_flight.flight_reservation_id = flight_reservation.id');
			$this->db->join('programs', 'programs_flight.programs_id = programs.id');
			$this->db->where('programs.active', '1');
			$this->db->where('programs_flight.active', '1');
			$this->db->where('flight_reservation.active', '1');
			$this->db->where('flight_reservation.going_date > ', "$to_day");
			$this->db->where('places.active', '1');
			$this->db->where('places.place_id !=', '0');
			$this->db->group_by('places.id');

			$query = $this->db->get();

			return $query->result();
		}
		public function GetTravelReturnFromCity(){
			/*
			  SELECT * FROM places
			 * JOIN flight_reservation ON flight_reservation.going_from_place = places.id 
			 * JOIN programs ON programs.flight_reservation_id = flight_reservation.id 
			 * 
			 * WHERE programs.active = 1 AND flight_reservation.active = 1 AND places.active = 1 AND places.place_id > 0 GROUP BY places.id

			 * 			 */
			$to_day = \date("Y-m-d");
			$this->db->select('places.*');
			$this->db->from('places');
			$this->db->join('flight_reservation', 'flight_reservation.return_from_place = places.id ');
			$this->db->join('programs_flight', 'programs_flight.flight_reservation_id = flight_reservation.id');
			$this->db->join('programs', 'programs_flight.programs_id = programs.id');
			$this->db->where('programs.active', '1');
			$this->db->where('programs_flight.active', '1');
			$this->db->where('flight_reservation.active', '1');
			$this->db->where('flight_reservation.going_date > ', "$to_day");
			$this->db->where('places.active', '1');
			$this->db->where('places.place_id !=', '0');
			$this->db->group_by('places.id');

			$query = $this->db->get();

			return $query->result();
		}
		public function GetTravelReturnToCity(){
			/*
			  SELECT * FROM places
			 * JOIN flight_reservation ON flight_reservation.going_from_place = places.id 
			 * JOIN programs ON programs.flight_reservation_id = flight_reservation.id 
			 * 
			 * WHERE programs.active = 1 AND flight_reservation.active = 1 AND places.active = 1 AND places.place_id > 0 GROUP BY places.id

			 * 			 */
			$to_day = \date("Y-m-d");
			$this->db->select('places.*');
			$this->db->from('places');
			$this->db->join('flight_reservation', 'flight_reservation.return_to_place = places.id ');
			$this->db->join('programs_flight', 'programs_flight.flight_reservation_id = flight_reservation.id');
			$this->db->join('programs', 'programs_flight.programs_id = programs.id');
			$this->db->where('programs.active', '1');
			$this->db->where('programs_flight.active', '1');
			$this->db->where('flight_reservation.active', '1');
			$this->db->where('flight_reservation.going_date > ', "$to_day");
			$this->db->where('places.active', '1');
			$this->db->where('places.place_id !=', '0');
			$this->db->group_by('places.id');

			$query = $this->db->get();

			return $query->result();
		}

		public function GetFooterPrograms($limit = 5){
			$today = \date("Y-m-d");
			$this->db->select('programs.id,programs.title_ar');
			$this->db->from('programs');
			$this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
			$this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
			$this->db->where('programs.active', '1');
			$this->db->where('programs_flight.active', '1');
			$this->db->where('programs.active', "1");

			$this->db->where('flight_reservation.active', '1');
			$this->db->where('flight_reservation.going_date >=', "$today");

			$this->db->order_by('programs.id', 'DESC');
			$this->db->order_by('programs.this_order', 'ASC');
			$this->db->order_by('programs.special_offer', 'DESC');
			$this->db->order_by('flight_reservation.going_date', 'ASC');
			$this->db->group_by('programs.id');

			$this->db->limit($limit);

			$query = $this->db->get();

			return $query->result();
			//  return $this->db->last_query();
		}

	}
	