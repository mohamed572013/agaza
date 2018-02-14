<?php

class News_model extends CI_Model {

    private $_table = 'news';
    public $images_dimensions = array(
            'm' => array('width' => '267', 'height' => 200),
            'l' => array('width' => '848', 'height' => 464),
            's' => array('width' => '170', 'height' => 93),
        );

    public function __construct() {
        parent::__construct();
    }

    public function GetNews($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get($this->_table, 1000);
        return $query->result();
    }

    public function getAllActiveNews($limit = false, $offset = false) {
        $this->db->select("*");
        $this->db->from("news");
        $this->db->where("active", 1);
        $this->db->order_by("created", "DESC");
        if($limit && !$offset) {
            $this->db->limit($limit);
        } 
        if($limit && $offset) {
            $this->db->limit($limit, $offset);  
        }
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function GetAllNews($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $query = $this->db->get($this->_table, 100);
        return $query->result();
    }

    public function findById($id){
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

        public function findLastThree(){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->order_by("created", "desc");
            $this->db->limit(3);
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


    public function add($data_array){
        
            $this->db->insert($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function update($data_array = array(), $where_array = array()){
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

        public function delete($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
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
    public function do_upload($image, $config, $new_path){
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

        public function resize_image($path, $file, $p){
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
}

