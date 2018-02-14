<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Redirect extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Front_programs_model', 'programs');
            $this->load->model('Front_hotels_model', 'hotels');
        }

        public function index(){
            $uri_segment = $this->uri->segment(3);
            $uri_array = explode("-", $uri_segment);
            $id = end($uri_array);

            $this->db->select("agaza_programs.url, programs.agaza_title_ar, programs.agaza_image");
            $this->db->from("agaza_programs");
            $this->db->join("programs", "agaza_programs.program_id=programs.id");
            $this->db->where("agaza_programs.program_id", $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->row();
            } else {
                return false;
            }


            $this->data['details'] = $result;


            //pri($company_url);
            $this->load->view('main_content/redirect_page', $this->data);
        }

    }
