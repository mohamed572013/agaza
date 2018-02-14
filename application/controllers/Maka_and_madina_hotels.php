<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Maka_and_madina_hotels extends MY_Controller{
		public function __construct(){

			parent::__construct();
			$this->load->model('Front_maka_and_madina_hotels_model', 'maka_and_madina_hotels');
			$this->load->library('pagination');
		}

		public function index($maka_or_madina = 0, $page_index = 0){

			if ($maka_or_madina == 0) {
				$cond_seo['slug'] = "maka_hotels";
				$this->data['seo'] = $this->maka_and_madina_hotels->GetWhere("site_pages", "id", "ASC", $cond_seo);
			} else {
				$cond_seo['slug'] = "madina_hotels";
				$this->data['seo'] = $this->maka_and_madina_hotels->GetWhere("site_pages", "id", "ASC", $cond_seo);
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
			$config["total_rows"] = intval($this->maka_and_madina_hotels->GetCountWhere("maka_madina_hotels", $cond_act));

			$config['uri_segment'] = 4;
			$config["base_url"] = base_url("/maka_and_madina_hotels/index/$maka_or_madina");

			$config["per_page"] = 9;
			$config["num_links"] = 5;

			$this->pagination->initialize($config);
			$this->data['links'] = $this->pagination->create_links();


			$this->data['maka_and_madina_hotels'] = $this->maka_and_madina_hotels->GetWherePaging("maka_madina_hotels", "this_order", "ASC", $cond_act, $page_index, $config["per_page"]);
			//   pr($this->data['maka_and_madina_hotels'],1);
			$this->data['view'] = "maka_and_madina_hotels";
			$this->load->view("main_layout", $this->data);
		}

		function detail($maka_or_madina = 0, $param = ""){

			if ($maka_or_madina == 0) {
				$cond_seo['slug'] = "maka_hotels";
				$this->data['seo'] = $this->maka_and_madina_hotels->GetWhere("site_pages", "id", "ASC", $cond_seo);
			} else {
				$cond_seo['slug'] = "madina_hotels";
				$this->data['seo'] = $this->maka_and_madina_hotels->GetWhere("site_pages", "id", "ASC", $cond_seo);
			}
			$this->data['seo'] = $this->data['seo'][0];

			$pieces1 = explode("-", $param);
			$hotel_id = $pieces1[0];
			$cond_slider['active'] = 1;
			$cond_slider['maka_madina_hotels_id'] = $pieces1[0];

			$this->data['maka_madina_hotels_slider'] = $this->maka_and_madina_hotels->GetWhere("maka_madina_hotels_slider", "id", "DESC", $cond_slider);
			$cond['id'] = $hotel_id;
			$this->data['hotel_detail'] = $this->maka_and_madina_hotels->GetWhere("maka_madina_hotels", "id", "DESC", $cond);
			$this->data['hotel_detail'] = $this->data['hotel_detail'][0];

 			$this->data['hotels_advantage'] = $this->maka_and_madina_hotels->GetWhere("hotels_advantage", "id", "ASC",array());


			$this->data['view'] = "hotel_detail";
			$this->load->view("main_layout", $this->data);
		}

	}
	