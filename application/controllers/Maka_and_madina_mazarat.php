<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Maka_and_madina_mazarat extends MY_Controller{
		public function __construct(){

			parent::__construct();
			$this->load->model('Front_maka_and_madina_mazarat_model', 'maka_and_madina_mazarat');
			$this->load->library('pagination');
		}

		public function index($maka_or_madina = 0, $page_index = 0){

			if ($maka_or_madina == 0) {
				$cond_seo['slug'] = "maka_shrines";
				$this->data['seo'] = $this->maka_and_madina_mazarat->GetWhere("site_pages", "id", "ASC", $cond_seo);
			} else {
				$cond_seo['slug'] = "madina_shrines";
				$this->data['seo'] = $this->maka_and_madina_mazarat->GetWhere("site_pages", "id", "ASC", $cond_seo);
			}
			$this->data['seo'] = $this->data['seo'][0];

			$page_index = $this->uri->segment(4);
			if ($page_index == "") {
				$page_index = 0;
			}

			$config['next_link'] = $this->lang->line("next");
			$config['prev_link'] = $this->lang->line("prev");
			$config['first_link'] = $this->lang->line("first");
			$config['last_link'] = $this->lang->line("last");

			$cond_act['active'] = 1;
			$cond_act['maka_or_madina'] = $maka_or_madina;
			$config["total_rows"] = intval($this->maka_and_madina_mazarat->GetCountWhere("maka_madina_shrines", $cond_act));

			$config['uri_segment'] = 4;
			$config["base_url"] = base_url("/maka_and_madina_mazarat/index/$maka_or_madina");

			$config["per_page"] = 9;
			$config["num_links"] = 5;

			$this->pagination->initialize($config);
			$this->data['links'] = $this->pagination->create_links();


			$this->data['maka_and_madina_mazarat'] = $this->maka_and_madina_mazarat->GetWherePaging("maka_madina_shrines", "this_order", "ASC", $cond_act, $page_index, $config["per_page"]);
			//   pr($this->data['maka_and_madina_mazarat'],1);
			$this->data['view'] = "maka_and_madina_mazarat";
			$this->load->view("main_layout", $this->data);
		}

		function detail($maka_or_madina = 0, $param = ""){

			if ($maka_or_madina == 0) {
				$cond_seo['slug'] = "maka_shrines";
				$this->data['seo'] = $this->maka_and_madina_mazarat->GetWhere("site_pages", "id", "ASC", $cond_seo);
			} else {
				$cond_seo['slug'] = "madina_shrines";
				$this->data['seo'] = $this->maka_and_madina_mazarat->GetWhere("site_pages", "id", "ASC", $cond_seo);
			}
			$this->data['seo'] = $this->data['seo'][0];

			$pieces1 = explode("-", $param);
			$cond['id'] = $pieces1[0];
 			$this->data['mazarate_detail'] = $this->maka_and_madina_mazarat->GetWhere("maka_madina_shrines", "id", "DESC", $cond);
			$this->data['mazarate_detail'] = $this->data['mazarate_detail'][0];

 

			$this->data['view'] = "mazarate_detail";
			$this->load->view("main_layout", $this->data);
		}

	}
	