<?php

    class Maka_madina_hotels extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('maka_madina_hotels_controll', 'open', true);
            $this->load->model('Maka_madina_hotels_model', 'maka_madina_hotels');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function show(){

            $cond['branches_id'] = $this->_current_user->branches_id;
            $this->data['page_list'] = $this->maka_madina_hotels->GetWhere("maka_madina_hotels", "id", "ASC", $cond);
            $this->view('admin/maka_madina_hotels/view');
        }

        public function add(){

            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['hotels_advantage'] = $this->maka_madina_hotels->GetWhere("hotels_advantage", "id", "ASC", $cond);
            $cond__1['branches_id'] = $this->_current_user->branches_id;
            $cond__1['place_id'] = 0;
            $this->data['countries'] = $this->maka_madina_hotels->GetWhere("places", "id", "ASC", $cond__1);
            $cond__2['branches_id'] = $this->_current_user->branches_id;
            $cond__2['place_id !='] = 0;
            $this->data['cities'] = array();

            //$this->CheckAccess('maka_madina_hotels_controll', 'add', true);

            if (\count($_POST) > 0) {

                $this->form_validation->set_rules('title_ar', $this->_lang['title_ar'], 'required');
                $this->form_validation->set_rules('places_id', $this->_lang['city'], 'required');

                $this->form_validation->set_rules('desc_ar', $this->_lang['desc_ar'], 'required');
                $this->form_validation->set_rules('body_ar', $this->_lang['body_ar'], 'required');
                $this->form_validation->set_rules('keywords_ar', $this->_lang['keywords_ar'], 'required');


                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {

                    $cond_test['title_ar'] = \xss_clean($_POST['title_ar']);
                    $cond_test['places_id'] = $_POST['places_id'];
                    $test_ar = $this->maka_madina_hotels->GetWhere("maka_madina_hotels", "id", "ASC", $cond_test);

                    if (\count($test_ar) > 0) {
                        $this->data['error'] = "هذا الفندق موجود من قبل لهذه المدينة";
                    } else {
                        $array_data['active'] = \xss_clean($_POST['active']);
                        $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                        $array_data['desc_ar'] = \xss_clean($_POST['desc_ar']);
                        $array_data['body_ar'] = \xss_clean($_POST['body_ar']);
                        $array_data['keywords_ar'] = \xss_clean($_POST['keywords_ar']);

                        $array_data['stars'] = \xss_clean($_POST['stars']);
                        $array_data['this_order'] = \xss_clean($_POST['this_order']);
                        $array_data['hotels_advantage_ids'] = $pages_ids = implode(",", $_POST['hotels_advantage_ids']);
                        $array_data['places_id'] = \xss_clean($_POST['places_id']);
                        $this->config->load('files');
                        $config = $this->config->item('hotel_main_image');
                        $image = $this->maka_madina_hotels->do_upload('image', $config, 'uploads/maka_madina_hotels/');
                        if ($image != FALSE) {
                            $array_data['image'] = $image;
                        }
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['created_by'] = $this->_login_data['user_id'];

                        $this->maka_madina_hotels->add($array_data);
                        \redirect(\base_url("admin/maka_madina_hotels/show"));
                    }
                }
            }

            $this->view('admin/maka_madina_hotels/form');
        }

        public function edit($id = ""){

            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['hotels_advantage'] = $this->maka_madina_hotels->GetWhere("hotels_advantage", "id", "ASC", $cond);
            $cond__1['branches_id'] = $this->_current_user->branches_id;
            $cond__1['place_id'] = 0;
            $this->data['countries'] = $this->maka_madina_hotels->GetWhere("places", "id", "ASC", $cond__1);
            $cond__2['branches_id'] = $this->_current_user->branches_id;
            $cond__2['place_id !='] = 0;
            $this->data['cities'] = $this->maka_madina_hotels->GetWhere("places", "id", "ASC", $cond__2);
            //pri($this->data['cities']);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/maka_madina_hotels/show'));
            }

            if (!empty($_POST)) {
                $this->form_validation->set_rules('title_ar', $this->_lang['title_ar'], 'required');
                $this->form_validation->set_rules('places_id', $this->_lang['city'], 'required');

                $this->form_validation->set_rules('desc_ar', $this->_lang['desc_ar'], 'required');
                $this->form_validation->set_rules('body_ar', $this->_lang['body_ar'], 'required');
                $this->form_validation->set_rules('keywords_ar', $this->_lang['keywords_ar'], 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $cond_test['title_ar'] = \xss_clean($_POST['title_ar']);
                    $cond_test['places_id'] = $_POST['places_id'];
                    $test_ar = $this->maka_madina_hotels->GetWhereNotEqualId("maka_madina_hotels", "id", "ASC", $cond_test, $id);

                    if (\count($test_ar) > 0) {
                        $this->data['error'] = "هذا الفندق موجود من قبل لهذه المدينة";
                    } else {

                        $array_data['active'] = \xss_clean($_POST['active']);
                        $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                        $array_data['desc_ar'] = \xss_clean($_POST['desc_ar']);
                        $array_data['body_ar'] = \xss_clean($_POST['body_ar']);
                        $array_data['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
                        $array_data['stars'] = \xss_clean($_POST['stars']);
                        $array_data['this_order'] = \xss_clean($_POST['this_order']);
                        $array_data['hotels_advantage_ids'] = $pages_ids = implode(",", $_POST['hotels_advantage_ids']);
                        $array_data['places_id'] = \xss_clean($_POST['places_id']);
                        $this->config->load('files');
                        $config = $this->config->item('hotel_main_image');
                        $image = $this->maka_madina_hotels->do_upload('image', $config, 'uploads/maka_madina_hotels/');
                        if ($image != FALSE) {
                            $array_data['image'] = $image;
                        }
                        $this->maka_madina_hotels->update($array_data, array(
                            'id' => $id
                        ));

                        \redirect(\base_url("admin/maka_madina_hotels/show"));
                    }
                }
            }

            $edit = $this->maka_madina_hotels->Getmaka_madina_hotels(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/maka_madina_hotels/form");
        }

        public function delete($id = ""){

            $cond['maka_hotel_id'] = $id;
            $test = $this->maka_madina_hotels->GetWhere("programs", "id", "ASC", $cond);
//                $cond_1['madina_hotel_id'] = $id;
//                $test_1 = $this->maka_madina_hotels->GetWhere("programs", "id", "ASC", $cond_1);
            $tables_related = array('hotels_extra_services', 'hotels_rooms_prices', 'hotels_rooms', 'hotels_chalets_others_prices');
            $ok_delete = true;
            foreach ($tables_related as $table) {
                $test = $this->maka_madina_hotels->findForDelete($id, $table);
                if ($test) {
                    $ok_delete = false;
                }
            }
            if ((count($test) > 0 && $test[0]->id > 0) || !$ok_delete) {
                echo "no";
            } else {
                $this->db->where("id", $id);
                $this->db->delete("maka_madina_hotels");
                echo 'yes';
            }
        }

        public function status($id = NULL){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->maka_madina_hotels->GetWhere("maka_madina_hotels", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->maka_madina_hotels->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $cities = $this->maka_madina_hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                $str = "";
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

    }
