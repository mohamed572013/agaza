
<?php

class Programs_advantage_model extends CI_Model {

    private $table = 'programs_advantage';

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

    public function GetWhere($table, $order, $order_type, $cond = array()) {
        if (count($cond) > 0) {
            foreach ($cond as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->order_by("$order", "$order_type");
        $query = $this->db->get($table);
        return $query->result();
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
        $programs_advantage_report = $this->check_delete_validation($where_array, "programs_advantage_all");

        if ($programs_advantage_report) {
            return "programs_advantage_all";
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
        $programs_id = $where['id'];
        $this->db->where("programs_advantage_id", $programs_id);
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
