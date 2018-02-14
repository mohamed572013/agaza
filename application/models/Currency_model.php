<?php

class Currency_model extends CI_Model {

    private $table = 'currency';

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
        $programs_report = $this->check_delete_validation($where_array, "programs", "currency_id");
        $visas_report = $this->check_delete_validation($where_array, "visas", "currency_id");
        $islamic_programs_report = $this->check_delete_validation($where_array, "islamic_programs", "currency_id");
        $hotels_report = $this->check_delete_validation($where_array, "maka_madina_hotels", "currency_id");
        $islamic_hotels_report = $this->check_delete_validation($where_array, "islamic_hotels", "currency_id");

        if ($programs_report) {
            return "programs";
        } else if ($visas_report) {
            return "visas";
        } else if ($islamic_programs_report) {
            return "islamic_programs";
        } else if ($hotels_report) {
            return "maka_madina_hotels";
        } else if ($islamic_hotels_report) {
            return "islamic_hotels";
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

    public function check_delete_validation($where, $table, $column) {
        $places_id = $where['id'];
        $this->db->where($column, $places_id);
        $data = $this->db->get($table);
        if ($data->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function resize_image($path, $file, $p) {
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

    public function getAboutUs($branches_id) {
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

}
