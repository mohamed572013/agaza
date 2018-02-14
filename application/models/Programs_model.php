<?php

class Programs_model extends CI_Model {

    private $_table = 'programs';
    public $images_dimensions = array(
        's' => array('width' => '480', 'height' => 240),
        'm' => array('width' => '600', 'height' => 338),
        'l' => array('width' => '1170', 'height' => 480)
    );
    public $slider_images_dimensions = array(
        'l' => array('width' => '1000', 'height' => 575),
    );

    public function __construct() {
        parent::__construct();
    }

    public function findById($id) {
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



    public function editCategory($id, $agaza_category) {
        $data_array['agaza_category'] = $agaza_category;
        //pri($agaza_category);
        $this->db->where('program_id');        
        $this->db->update("agaza_programs", $data_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editAgazaProgram($id, $edit_array) {
        $this->db->where('program_id', $id);        
        $this->db->update("agaza_programs", $edit_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    

    public function findByProgramId($id) {
        $this->db->select('*');
        $this->db->from("agaza_programs");
        $this->db->where('program_id', $id);
        //$this->db->where('is_active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function activateProgram($id, $array_data = array()) {
        //pri($array_data);

        $this->db->where("program_id", $id);            
        $this->db->update("agaza_programs", $array_data);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editImageURL($id, $url) {
        $this->db->where("program_id", $id);
        $data_array['image_url'] = $url;
        $this->db->update("agaza_programs", $data_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    

    public function GetPrograms($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get($this->_table, 1000);
        return $query->result();
    }

    public function findForDelete($program_id, $table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('programs_id', $program_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetAllPrograms($array_where = array()) {
        if (isset($array_where) && \count($array_where) > 0) {
            $this->db->where($array_where);
        }
        $query = $this->db->get($this->_table, 100);
        return $query->result();
    }

    public function addWithReturn($array_date = array()) {
        if ($this->db->insert($this->_table, $array_date)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addNewAgazaProgram($array_data = array()) {        
        if ($this->db->insert("agaza_programs", $array_data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }


    public function deleteExistingAgazaProgram($program_id = 0) {        
        $this->db->where("program_id", $program_id);
        $this->db->delete("agaza_programs");
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
           return true;
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

    public function add($array_date = array()) {
        $this->db->insert($this->_table, $array_date);
    }

    public function addwithTable($table, $array_date = array()) {
        $this->db->insert($table, $array_date);
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
        $reservation_report = $this->check_delete_validation($where_array, "reservation", "programs_id", "tourism_or_islamic", 0);
        $programs_advanrages_report = $this->check_delete_validation($where_array, "programs_advantage_all", "programs_id");
        $programs_cities_report = $this->check_delete_validation($where_array, "programs_cities", "programs_id");
        $programs_extra_service_report = $this->check_delete_validation($where_array, "programs_extra_service", "programs_id");
        $programs_flight_report = $this->check_delete_validation($where_array, "programs_flight", "programs_id");

        if ($reservation_report) {
            return "reservations";
        } else if ($programs_advanrages_report) {
            return "programs_advantages";
        } else if ($programs_cities_report) {
            return "programs_cities";
        } else if ($programs_extra_service_report) {
            return "programs_extra_service";
        } else if ($programs_flight_report) {
            return "programs_flight";
        } else {
            $this->db->where($where_array);
            $this->db->delete($this->_table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return "done";
            } else {
                return "data";
            }
        }
        return "data";
    }

    public function check_delete_validation($where, $table, $column, $column2 = "", $value2 = "") {
        $programs_id = $where['id'];
        if ($column2 != "") {
            $this->db->where($column2, $value2);
        }
        $this->db->where($column, $programs_id);
        $data = $this->db->get($table);
        if ($data->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function GetAllFlight() {
        $this->db->select('   flight_reservation.*  , c1.title_ar AS name_from_city, '
                . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                . 'c4.title_ar AS  return_name_to_city');

        $this->db->from('flight_reservation');
        $this->db->where("flight_reservation.passenger_num > ", "flight_reservation.passenger_reserved");
        $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
        $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
        $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
        $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');

        $query = $this->db->get();
        return $query->result();
    }

    public function do_upload($image, $config, $new_path, $type) {
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($image)) {
            return FALSE;
        } else {
            $data = $this->upload->data();
            if ($type == 'prog_slider_image') {
                $images_dimensions = $this->slider_images_dimensions;
                $file_resized_name = resize5($data, $new_path, $images_dimensions, false);
                return 'l_' . $file_resized_name;
            } else {
                $images_dimensions = $this->images_dimensions;
                $file_resized_name = resize5($data, $new_path, $images_dimensions, true);
                return $file_resized_name;
            }
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

    public function getSpecialOffersPrograms() {
        $this->db->select('   flight_reservation.*  , c1.title_ar AS name_from_city, '
                . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                . 'c4.title_ar AS  return_name_to_city');

        $this->db->from('flight_reservation');
        $this->db->where("flight_reservation.passenger_num > ", "flight_reservation.passenger_reserved");
        $this->db->join('places AS c1', 'flight_reservation.going_from_place = c1.id');
        $this->db->join('places AS c2', 'flight_reservation.going_to_place = c2.id');
        $this->db->join('places AS c3', 'flight_reservation.return_from_place = c3.id');
        $this->db->join('places AS c4', 'flight_reservation.return_to_place = c4.id');

        $query = $this->db->get();
        return $query->result();
    }

    public function addByTableName($table, $data_array) {
        $this->db->insert($table, $data_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function updateByTableName($table, $data_array, $where_array) {
        $this->db->where($where_array);
        if (count($where_array) > 0) {
            foreach ($where_array as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->update($table, $data_array);
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    

}
