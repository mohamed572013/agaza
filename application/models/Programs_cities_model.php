<?php

class Programs_cities_model extends CI_Model {

    private $_table = 'programs_cities';

    public function __construct() {
        parent::__construct();
    }

    public function GetPrograms_cities($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get($this->_table, 1000);
        return $query->result();
    }
    
    public function addWithReturn($array_date = array()) {
        if ($this->db->insert($this->_table, $array_date)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
       public function addwithTable($table, $array_date = array()) {
        $this->db->insert($table, $array_date);
    }



    public function GetAllPrograms_cities($array_where = array()) {
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
        $query = $this->db->get($table);
        return $query->result();
    }

    public function GetWhereCities($table, $order, $order_type, $cond = array()) {
        if (count($cond) > 0) {
            foreach ($cond as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->where('place_id !=', "0");
        $this->db->order_by("$order", "$order_type");
        $query = $this->db->get($table);
        return $query->result();
    }

    public function GetAllCitiesWhere($cond = array()) {
        $this->db->select("programs_cities.*,places.title_ar as city_name ,maka_madina_hotels.title_ar as hotel_name,programs.our_code");
        $this->db->from('programs_cities');
        $this->db->join('programs', 'programs.id = programs_id ');
        $this->db->join('places', 'places.id = programs_cities.places_id ');
        $this->db->join('maka_madina_hotels', 'maka_madina_hotels.id = programs_cities.hotel_id ');

        if (count($cond) > 0) {
            foreach ($cond as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $query = $this->db->get();

        return $query->result();

        //  return $this->db->last_query();
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

    public function GetEgyptHotels() {
        $this->db->select('maka_madina_hotels.*');
        $this->db->from('maka_madina_hotels');
        $this->db->join('places', 'places.id = maka_madina_hotels.places_id ');
        $this->db->where('maka_madina_hotels.active', '1');
        $this->db->where('places.place_id', '1');
        $query = $this->db->get();

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

    public function do_upload($image, $path) {
        $this->load->library('upload');

        $config['upload_path'] = './' . $path;
        $config['allowed_types'] = 'gif|jpeg|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($image)) {
            return FALSE;
        } else {
            $data = array('upload_data' => $this->upload->data());
				$this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name'], $path);
            return $data['upload_data']['file_name'];
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

