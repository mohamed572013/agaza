<?php

class Programs_levels_model extends CI_Model {

    private $table = 'programs_levels';

    public function __construct() {
        parent::__construct();
    }

    public function all($branches_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('branches_id', $branches_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function find($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function findTitle($where_array = array()) {
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

    public function add($array_date = array()) {
        $this->db->insert($this->table, $array_date);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update($data_array = array(), $where_array = array()) {
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

    public function delete($where_array = array()) {
        $reservation_report = $this->check_delete_validation($where_array, "programs");

        if ($reservation_report) {
            return "programs_levels";
        } else {
            $this->db->where($where_array);
            $this->db->delete($this->table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return "done";
            } else {
                return "data";
            }
        }
        return "data";
    }

    public function check_delete_validation($where, $table) {
        $programs_levels = $where['id'];
        $this->db->where("programs_levels", $programs_levels);
        $data = $this->db->get($table);
        if ($data->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
