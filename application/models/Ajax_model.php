<?php

	class Ajax_model extends CI_Model{

		private $_table = 'places';

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
	