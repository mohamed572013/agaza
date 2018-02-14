<?php

class Header_image_model extends CI_Model {

    private $_table = 'header_images';
    public $images_dimensions = array(
        's' => array('width' => '150', 'height' => 82),
        'l' => array('width' => '1400', 'height' => 320),
    );

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pages() {
        $this->db->select('page');
        $this->db->from($this->_table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_actual($page) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("page", $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add($data_array) {
        $this->db->insert($this->_table, $data_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function find($id) {
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

    public function update($data_array = array(), $where_array = array()) {
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

    public function delete($where_array = array()) {
        $this->db->where($where_array);
        $this->db->delete($this->_table);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function do_upload($image, $config, $new_path) {
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($image)) {
            return FALSE;
        } else {
            $data = $this->upload->data();
            $file_resized_name = resize5($data, $new_path, $this->images_dimensions, true);
            return $file_resized_name;
        }
    }

}
