<?php

class Visitors extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Visitors_model', 'visitors');
    }

    public function index() {
        $this->db->select("*");
        $this->db->from("visitors");
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $result = null;
        if($query->num_rows() > 0) {
            $result = $query->result();
        } 
        $this->data['visitors'] = $result;
        $main_content = 'visitors/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $this->db->select("*");
        $this->db->from("visitors");
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $result = null;
        if($query->num_rows() > 0) {
            $result = $query->result();
        } 
        $this->data['visitors'] = $result;
        $main_content = 'visitors/index';
        $this->_view($main_content, 'admin');$this->db->select("*");
        $this->db->from("visitors");
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $result = null;
        if($query->num_rows() > 0) {
            $result = $query->result();
        } 
        $this->data['visitors'] = $result;
        $main_content = 'visitors/index';
        $this->_view($main_content, 'admin');
    }

    
    public function add() {
       // pri($_POST);
        $data_array['phone'] = xss_clean($_POST['visitor_form_phone']);
        $data_array['email'] = xss_clean($_POST['visitor_form_email']);
        $data_array['created'] = date("Y-m-d H:i:s");
            //pri($data_array);
        $add = $this->visitors->add($data_array);
        if ($add) {
            print_json('success', _lang('added_successfully'));
        } else {
            print_json('error', 'error');
        }
    }




   

}
