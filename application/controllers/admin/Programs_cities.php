<?php

    class Programs_cities extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Programs_cities_model', 'programs_cities');
            $this->load->model('Programs_model', 'programs');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function show($programs = ""){
            $cond = array();
            if ($programs > 0) {
                $cond['programs_cities.branches_id'] = $this->_current_user->branches_id;
                $cond['programs_id'] = \xss_clean($programs);
            }


            $this->data['page_list'] = $this->programs_cities->GetAllCitiesWhere($cond);
            $this->view('admin/programs_cities/view');
        }

        public function add($programs = ""){

            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['programs'] = $this->programs_cities->GetWhere("programs", "id", "ASC", $cond);
            $cond__1['branches_id'] = $this->_current_user->branches_id;
            $cond__1['place_id'] = 0;
            $this->data['countries'] = $this->programs_cities->GetWhere("places", "id", "ASC", $cond__1);

            if (\count($_POST) > 0) {

                $this->form_validation->set_rules('programs_id', $this->_lang['programs'], 'required');
                $this->form_validation->set_rules('places_id', $this->_lang['city'], 'required');
                $this->form_validation->set_rules('hotel_id', $this->_lang['hotel'], 'required');
                $this->form_validation->set_rules('nights', $this->_lang['nights'], 'required');

                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {


                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['programs_id'] = \xss_clean($_POST['programs_id']);
                    $array_data['places_id'] = \xss_clean($_POST['places_id']);
                    $array_data['hotel_id'] = \xss_clean($_POST['hotel_id']);
                    $array_data['nights'] = \xss_clean($_POST['nights']);
                    $array_data['this_order'] = \xss_clean($_POST['this_order']);
                    $array_data['created_by'] = $this->_login_data['user_id'];
                    $array_data['branches_id'] = $this->_current_user->branches_id;

                    $this->programs_cities->add($array_data);

                    
                    // end

                    $programs = $_POST['programs_id'];
                    \redirect(\base_url("admin/programs_cities/show/$programs"));
                }
            }

            $this->view('admin/programs_cities/form');
        }

        public function edit($id = ""){
            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['programs'] = $this->programs_cities->GetWhere("programs", "id", "ASC", $cond);
            $this->data['hotels'] = $this->programs_cities->GetWhere("maka_madina_hotels", "id", "ASC", $cond);
            $cond__1['branches_id'] = $this->_current_user->branches_id;
            $cond__1['place_id'] = 0;
            $cond__1['active'] = 1;
            $this->data['countries'] = $this->programs_cities->GetWhere("places", "id", "ASC", $cond__1);
            $cond__2['branches_id'] = $this->_current_user->branches_id;
            $cond__2['place_id !='] = 0;
            $cond__1['active'] = 1;
            $this->data['cities'] = $this->programs_cities->GetWhereCities("places", "id", "ASC", $cond__2);
            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_cities/show'));
            }

            if (!empty($_POST)) {
                $this->form_validation->set_rules('programs_id', $this->_lang['programs'], 'required');
                $this->form_validation->set_rules('places_id', $this->_lang['city'], 'required');
                $this->form_validation->set_rules('hotel_id', $this->_lang['hotel'], 'required');
                $this->form_validation->set_rules('nights', $this->_lang['nights'], 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {



                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['programs_id'] = \xss_clean($_POST['programs_id']);
                    $array_data['places_id'] = \xss_clean($_POST['places_id']);
                    $array_data['hotel_id'] = \xss_clean($_POST['hotel_id']);
                    $array_data['nights'] = \xss_clean($_POST['nights']);
                    $array_data['this_order'] = \xss_clean($_POST['this_order']);

                    $this->programs_cities->update($array_data, array(
                        'id' => $id
                    ));

                     

                    $programs = $_POST['programs_id'];
                    \redirect(\base_url("admin/programs_cities/show/$programs"));
                }
            }

            $edit = $this->programs_cities->Getprograms_cities(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_cities/form");
        }

        public function delete($id = ""){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url("admin/programs_cities/show"));
                return false;
            }

            $this->db->where("id", $id);
            $this->db->delete("programs_cities");
            echo 'yes';
        }

        public function status($id = NULL){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_cities->GetWhere("programs_cities", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_cities->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function GetCItyHotel(){
            $cond['places_id'] = $_POST['places_id'];
            $cond['active'] = 1;
            $hotels = $this->programs_cities->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
            $str = "";
            if (count($hotels) > 0) {

                foreach ($hotels as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $cities = $this->programs_cities->GetWhere('places', 'id', "ASC", $cond);
            $str = "";
            if (count($cities) > 0) {

                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

    }
