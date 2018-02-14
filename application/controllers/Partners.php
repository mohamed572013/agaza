<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Partners extends MY_Controller{
		public function __construct(){

			parent::__construct();
			$this->load->model('Front_partners_model', 'partners');
			$this->load->library('pagination');
		}

		public function index($page_index = 0){

 				$cond_seo['slug'] = "partners";
				$this->data['seo'] = $this->partners->GetWhere("site_pages", "id", "ASC", $cond_seo);
 			$this->data['seo'] = $this->data['seo'][0];

			$page_index = $this->uri->segment(3);
			if ($page_index == "") {
				$page_index = 0;
			}

			$config['next_link'] = $this->lang->line("next");
			$config['prev_link'] = $this->lang->line("prev");
			$config['first_link'] = $this->lang->line("first");
			$config['last_link'] = $this->lang->line("last");

			$cond_act['active'] = 1;
 			$config["total_rows"] = intval($this->partners->GetCountWhere("branches", $cond_act));

			$config['uri_segment'] = 3;
			$config["base_url"] = base_url("/partners/index");

			$config["per_page"] = 15;
			$config["num_links"] = 5;

			$this->pagination->initialize($config);
			$this->data['links'] = $this->pagination->create_links();


			$this->data['partners'] = $this->partners->GetWherePaging("branches", "id", "ASC", $cond_act, $page_index, $config["per_page"]);
			//   pr($this->data['partners'],1);
			$this->data['view'] = "partners";
			$this->load->view("main_layout", $this->data);
		}

	 
	}
	