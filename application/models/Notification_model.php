<?php

class Notification_model extends CI_Model {

    private $_table = 'notifications';

    public function __construct() {
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

		

    public function GetAds($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get($this->_table, 1000);
        return $query->result();
    }

    public function GetAllAds($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $query = $this->db->get($this->_table, 100);
        return $query->result();
    }

    public function GetWhere($table, $order, $order_type, $cond = array()) {
        if (count($cond) > 0) {
            foreach ($cond as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->order_by("$order", "$order_type");
        $this->db->limit(6);
        $query = $this->db->get($table);
        return $query->result();
    }
    
    
    public function GetWhereNotEqualId($table, $order, $order_type, $cond = array(), $id) {
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


    public function add($array_date = array()) {
        $this->db->insert($this->_table, $array_date);
    }

    public function update($array_date = array(), $where_array = array()) {
        $this->db->where($where_array);
        $this->db->update($this->_table, $array_date);
    }

    public function delete($array_date = array(), $where_array = array()) {
        $this->db->where($where_array);
        $this->db->delete($this->_table, $array_date);
    }

}

