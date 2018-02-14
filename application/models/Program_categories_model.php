<?php

class Program_categories_model extends CI_Model {

    private $table = 'program_categories';

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

    public function findAllCats($branches_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("parent_id", 0);
        $this->db->where('branches_id', $branches_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function findAllCatChildrenDetails($parent_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("parent_id", $parent_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function findAllCatChildren($branches_id, $parent_id) {
        $query = $this->db->query("SELECT * FROM `program_categories` WHERE `parent_id` = '$parent_id' AND `branches_id` = '$branches_id'");
        return $query->num_rows();
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
//        pri($array_date);
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
        $program_categories_report = $this->check_delete_validation($where_array, "program_categories", "parent_id");
        if ($where_array['parent'] == 0) {
            $programs_report = $this->check_delete_validation($where_array, "programs", "parent_category_id");
        } else {
            $programs_report = $this->check_delete_validation($where_array, "programs", "category_id");
        }
        if ($program_categories_report) {
            return "program_categories";
        } else if ($programs_report) {
            return "programs";
        } else {
            $id = $where_array['id'];
            $this->db->where("id", $id);
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
