<?php

    class Haj_umrah_programs_model extends CI_Model{

        private $_table = 'haj_umrah_programs';

        public function __construct(){
            parent::__construct();
        }

        public function GetPrograms($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
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

        public function findForDelete($program_id, $table){
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

        public function GetAllPrograms($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get($this->_table, 100);
            return $query->result();
        }

        public function addWithReturn($array_date = array()){
            if ($this->db->insert($this->_table, $array_date)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
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

        public function GetWhereNotEqualId($table, $order, $order_type, $cond = array(), $id){
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

        public function add($array_date = array()){
            $this->db->insert($this->_table, $array_date);
        }

        public function addwithTable($table, $array_date = array()){
            $this->db->insert($table, $array_date);
        }

        public function update($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->update($this->_table, $array_date);
        }

        public function delete($array_date = array(), $where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table, $array_date);
        }

        public function GetAllFlight(){
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

        public function do_upload($image, $path){
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

        public function getSpecialOffersPrograms(){
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

        public function addByTableName($table, $data_array){
            $this->db->insert($table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function updateByTableName($table, $data_array, $where_array){
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

        public function delete2($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

    }
