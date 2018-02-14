<?php

	class Front_partners_model extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function GetCountWhere($table, $array_where = array()){
			$count = 0;
			$this->db->select('count(id) as counts');
			$this->db->from("$table");
			if (isset($array_where) && \count($array_where) > 0) {
				$this->db->where($array_where);
			}
			$query = $this->db->get();
			$result = $query->result();
			if ($result[0]->counts > 0) {
				$count = $result[0]->counts;
			}
			return $count;
		}

	 
	 

	  public function GetWherePaging($table, $order, $order_type, $cond = array(), $pag_index, $per_page) {
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
	 
		public function GetWhere($table, $order, $order_type, $cond = array(), $limit = 0){
			if (count($cond) > 0) {
				foreach ($cond as $key => $value) {
					$this->db->where($key, $value);
				}
			}
			if ($limit > 0) {
				$this->db->limit($limit);
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

		public function addwithTable($table, $array_date = array()){
			$this->db->insert($table, $array_date);
			return $this->db->insert_id();
		}

	}
	