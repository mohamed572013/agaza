<?php

	class Search extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('pagination');
			$this->load->library('session');
		}

		function index(){

			$title2 = "title_" . config_item("default_lang_code");
			$con_ne["id"] = 26;
			$all_data = $this->khmodel->get("pages", $con_ne, 1, 100, 'id');
			$this->data['seo'] = $all_data[0];
			$this->data['seo']->$title2 = $this->lang->line("serach");

			if (isset($_POST["submit"])) {
				$data = array(
					'what' => $this->input->post('what'),
					'where' => $this->input->post('where'),
				);
				$this->session->set_userdata($data);
			}
			if ((bool) $this->session->userdata('what')) {
				//if (isset($_POST["submit"]))
				//{
				$result = array();
				$what = $this->session->userdata('what');
				$where = $this->session->userdata('where');
				$this->data['seo']->$title2 .= " " . $what;

				$ctitle = "title_" . config_item('default_lang_code');
//************************************** Get search result **************************************************

				$cond_11["$ctitle"] = $what;
				$cond_11["active"] = 1;
				$cats = $this->khmodel->src("categories", $cond_11, 1, 1000, "id");
				if (count($cats) > 0) {
					$piece_ads2 = array();
					foreach ($cats as $key => $value) {
						$cond3 = array();
						$cond3["cat_id1"] = $value->id;
						$cond3["active"] = 1;
						$cond3["active"] = "1%' AND (title_en LIKE '%$what%' OR title_ar LIKE '%$what%'  OR keywords_en LIKE '%$what%' OR keywords_ar LIKE '%$what%') AND active LIKE '%1";
						$piece_ads2[] = $this->khmodel->src("ads", $cond3, 1, 50000, '`orders` ASC');
					}
					$result = array_merge($piece_ads2[0], $result);
				} else {
					//$cond1["$ctitle"] = $what;
					$cond1["active"] = "1%' AND (title_en LIKE '%$what%' OR title_ar LIKE '%$what%'  OR keywords_en LIKE '%$what%' OR keywords_ar LIKE '%$what%') AND active LIKE '%1";

//					$cond1["active"] = 1;
					$src_ads = $this->khmodel->src("ads", $cond1, 1, 50000, '`orders` ASC');
					echo $this->db->last_query();
					if (count($src_ads) > 0) {
						$result = array_merge($src_ads, $result);
					}
				}
//*********************************************************************************************************				
				if ($where == "") {
					$ids_arr = array();
					$result2 = array();
					foreach ($result as $key => $value) {
						if (!in_array($value->id, $ids_arr)) {
							$ids_arr[] = $value->id;
							$result2[] = $value;
						}
					}
					$all_ads = $result2;
				} else {
					$cond1 = array();
					$cond1["active"] = "1%' AND (title_en LIKE '%$where%' OR title_ar LIKE '%$where%') AND active LIKE '%1";
					$places = $this->khmodel->src("places", $cond1, 1, 1000, "id");

					$all_areas = array();
					foreach ($places as $key => $value) {
						if ($value->type == 2) {
							$all_areas[] = $value->id;
						}
					}

					$ids_arr = array();
					$result2 = array();
					//print_r($all_areas)
					foreach ($result as $key => $value) {

						if (!in_array($value->id, $ids_arr)) {
							$areaId = explode(',', $value->area_id);
							foreach ($areaId as $value2) {
								// echo $value2."<br />";
								if (in_array($value2, $all_areas)) {
									$ids_arr[] = $value->id;
									$result2[] = $value;

									break;
								}
							}
						}
					}
					$all_ads = $result2;
				}
				if (!empty($all_ads)) {
					$config["base_url"] = site_url(config_item("default_lang_code") . "/search");
					$config['uri_segment'] = 3;
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$config['cur_tag_open'] = '<li class="active"><a href="">';
					$config['cur_tag_close'] = '</a></li>';
					if (config_item('default_lang_code') == "ar") {
						$config['next_link'] = 'التالي';
						$config['prev_link'] = 'السابق';
					} else {
						$config['next_link'] = 'Next';
						$config['prev_link'] = 'Prev';
					}

					$config["total_rows"] = count($all_ads);
					$config["per_page"] = 20;

					$choice = $config["total_rows"] / $config["per_page"];
					$config["num_links"] = 6;

					$this->pagination->initialize($config);
					$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
					$loop = $page + $config["per_page"];
					if ($page + $config["per_page"] > $config["total_rows"])
						$loop = $config["total_rows"];
					//$this->data['ads'] =  $page ,$config["per_page"] ;
					$final_result = array();
					for ($i = $page; $i < $loop; $i++) {
						if (in_array($all_ads[$i], $all_ads) && isset($all_ads[$i])) {
							$final_result[] = $all_ads[$i];
						} else {
							$this->session->sess_destroy();
						}
					}
					$this->data['ads'] = $final_result;
					if ($config["total_rows"] != 0) {
						$this->data['links'] = $this->pagination->create_links();
					}
				}
				// print_r($this->data['ads']);	
			}
			$this->data['view'] = 'search';
			$this->load->view('_main_layout', $this->data);
		}

	}
	