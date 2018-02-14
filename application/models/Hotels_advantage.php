<?php

	class Hotels_advantage extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->CheckLogin(true);
			$this->CheckAccess('hotels_advantage', 'open', true);
			$this->load->model('Hotels_advantage_model', 'hotels_advantage');
		}

		public function show($pag_index = 0){

			$cond['is_deleted'] = 0;
			$this->load->library('pagination');

			$config['base_url'] = base_url("admin/hotels_advantage/show");
			$config['total_rows'] = $this->hotels_advantage->GetCountWhere("hotels_advantage", "id", "ASC", $cond);
			$config['per_page'] = 200;
			$config['next_link'] = $this->_lang['next'];
			$config['prev_link'] = $this->_lang['prev'];
			$config['first_link'] = $this->_lang['First'];
			$config['last_link'] = $this->_lang['Last'];
			$config['uri_segment'] = 4;



			$this->pagination->initialize($config);
			$this->data['links'] = $this->pagination->create_links();

			$this->data['page_list'] = $this->hotels_advantage->GetWherePaging("hotels_advantage", "id", "ASC", $cond, $pag_index, $config['per_page']);
			$this->view('admin/hotels_advantage/view');
		}

		public function add(){

			$this->data['features_image'] = $this->hotels_advantage->GetWhere("features_image", "id", "ASC", array());

			$this->CheckAccess('hotels_advantage', 'add', true);
			if (\count($_POST) > 0) {


 				$title_ar = $this->_lang['title_ar'];
				$image = $this->_lang['image'];
 				$this->form_validation->set_rules('title_ar', "$title_ar", 'required|is_unique[hotels_advantage.title_ar]');
				$this->form_validation->set_rules('image', "$image", 'required ');

				if ($this->form_validation->run() == FALSE) {
					$this->data['error'] = validation_errors();
				} else {
					$array_data['image'] = \xss_clean($_POST['image']);
					$array_data['active'] = \xss_clean($_POST['active']);
 					$array_data['title_ar'] = \xss_clean($_POST['title_ar']);
					$array_data['created_by'] = $this->_login_data['user_id'];

					$this->hotels_advantage->add($array_data);
					\redirect(\base_url("admin/hotels_advantage/show"));
				}
			}

			$this->view('admin/hotels_advantage/form');
		}

		public function edit($id = ""){


			$this->CheckAccess('hotels_advantage', 'edit', true);
			 
			$this->data['features_image'] = $this->hotels_advantage->GetWhere("features_image", "id", "ASC", array());

			$id = \intval($id);
			if ($id < 0) {
				\redirect(\base_url('admin/hotels_advantage/show'));
			}

			if (!empty($_POST)) {
 				$title_ar = $this->_lang['title_ar'];
				$image = $this->_lang['image'];
 				$this->form_validation->set_rules('title_ar', "$title_ar", 'required|is_unique[hotels_advantage.title_ar.id.' . $id . ']');
				$this->form_validation->set_rules('image', "$image", 'required');

				if ($this->form_validation->run() == false) {
					$this->data['error'] = validation_errors();
				} else {

					$array_data['active'] = \xss_clean($_POST['active']);
 					$array_data['title_ar'] = \xss_clean($_POST['title_ar']);
					$array_data['image'] = \xss_clean($_POST['image']);
					$this->hotels_advantage->update($array_data, array(
						'id' => $id
					));

					\redirect(\base_url("admin/hotels_advantage/show"));
				}
			}

			$edit = $this->hotels_advantage->Getpages(array(
				'id' => $id
			));

			$this->data['edit'] = $edit[0];

			$this->view("admin/hotels_advantage/form");
		}

		public function delete($id = ""){
			$permission = $this->CheckAccessStatusDelete('hotels_advantage', 'delete', true);
			if ($permission != 0) {
				echo 'pemision_denied';
			} else {


				$id = \intval($id);
				if ($id < 0) {
					\redirect(\base_url("admin/hotels_advantage/show"));
					return false;
				}


				$this->db->where("id", $id);
				$this->db->delete("hotels_advantage");


				echo "yes";
			}
		}

		public function status($id = NULL){
			$permission = $this->CheckAccessStatusDelete('hotels_advantage', 'edit', true);
			if ($permission != 0) {
				echo 'pemision_denied';
			} else {


				if ($id):
					$cond['id'] = $id;
					$all_data = $this->hotels_advantage->GetWhere("hotels_advantage", "id", "ASC", $cond);

					$this->data['all_data'] = $all_data[0];
				else:
				endif;

				if ($this->data['all_data']->active == 1) {
					$array_data['active'] = 0;
				} else {
					$array_data['active'] = 1;
				}
				if (isset($id)) {
					$this->hotels_advantage->update($array_data, array(
						'id' => $id
					));
					echo 'yes';
				}
//			\redirect(\base_url("admin/hotels_advantage/show"));
			}
		}

	}
	