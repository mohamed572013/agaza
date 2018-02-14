<?php

    class Haj_umrah_hotels extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_model', 'programs');
            $this->load->model('Haj_umrah_hotels_model', 'haj_umrah_hotels');
            $this->load->model('Haj_umrah_hotels_slider_model', 'haj_umrah_hotels_slider');
            $this->load->model('Haj_umrah_hotels_advantages_model', 'haj_umrah_hotels_advantages');
            $this->load->model('Hotels_advantage_model', 'hotels_advantage');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function index(){
            //$hotels_advantages = $this->hotels_advantage->getAll($this->current_user_company->id);
            $hotels_advantages = $this->hotels_advantage->getAll(14);
            $cities = $this->haj_umrah_hotels->cities(29); //usa id
            //pri($hotels_advantages);
            $this->data['hotels_advantages'] = $hotels_advantages;
            $this->data['cities'] = $cities;
            $main_content = 'haj_umrah_hotels/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            //$hotels_advantages = $this->hotels_advantage->getAll($this->current_user_company->id);
            $hotels_advantages = $this->hotels_advantage->getAll(14);
            $cities = $this->haj_umrah_hotels->cities(29); //usa id
            //pri($hotels_advantages);
            $this->data['hotels_advantages'] = $hotels_advantages;
            $this->data['cities'] = $cities;
            $main_content = 'haj_umrah_hotels/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $haj_umrah_hotel_id = $_POST['haj_umrah_hotel_id'];
            $find = $this->haj_umrah_hotels->findById($haj_umrah_hotel_id);
            $haj_umrah_hotel_advantages = $this->haj_umrah_hotels_advantages->GetAll($haj_umrah_hotel_id);
            $find->advantages = $haj_umrah_hotel_advantages;
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "الاسم ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['hotel_image']) && $_FILES['hotel_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('hotel_image');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('hotel_image')) {
                        $errors = array('program_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            } else {
                $message['hotel_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['city_id'] = \xss_clean($_POST['city_id']);
            $data_array['region_id'] = \xss_clean($_POST['region_id']);
            //$data_array['maka_or_madina'] = \xss_clean($_POST['maka_or_madina']);
            $data_array['far_from_campus'] = \xss_clean($_POST['far_from_campus']);

            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['stars'] = \xss_clean($_POST['stars']);
            $data_array['body_ar'] = \xss_clean($_POST['body_arr']);
            $data_array['body_en'] = \xss_clean($_POST['body_en']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['desc_en'] = \xss_clean($_POST['desc_en']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['keywords_en'] = \xss_clean($_POST['keywords_en']);
            $data_array['branches_id'] = $this->current_user_company->id;
            //$data_array['departments_id'] = $this->current_user_branch->id;
            $add = $this->haj_umrah_hotels->add($data_array);
            if ($add) {
                if (!empty($_POST['haj_umrah_hotels_advantages_ids'])) {
                    $haj_umrah_hotels_advantages_ids = $_POST['haj_umrah_hotels_advantages_ids'];
                    foreach ($haj_umrah_hotels_advantages_ids as $advantage) {
                        $advantages_data['haj_umrah_hotels_id'] = $add;
                        $advantages_data['hotels_advantage_id'] = $advantage;
                        $this->haj_umrah_hotels_advantages->add($advantages_data);
                    }
                }

                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            //pri($_POST);
            $haj_umrah_hotel_id = $_POST['haj_umrah_hotel_id'];
            $find = $this->haj_umrah_hotels->findById($haj_umrah_hotel_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "الاسم ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['hotel_image']) && $_FILES['hotel_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('hotel_image');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('hotel_image')) {
                        $errors = array('program_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->image)) {
                $message['hotel_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['city_id'] = \xss_clean($_POST['city_id']);
            $data_array['region_id'] = \xss_clean($_POST['region_id']);
            $data_array['far_from_campus'] = \xss_clean($_POST['far_from_campus']);

            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['stars'] = \xss_clean($_POST['stars']);
            $data_array['body_ar'] = \xss_clean($_POST['body_arr']);
            $data_array['body_en'] = \xss_clean($_POST['body_en']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['desc_en'] = \xss_clean($_POST['desc_en']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['keywords_en'] = \xss_clean($_POST['keywords_en']);
            $data_array['branches_id'] = $this->current_user_company->id;
            //$data_array['departments_id'] = $this->current_user_branch->id;
            $haj_umrah_hotels_where['id'] = $haj_umrah_hotel_id;
            $update_1 = false;
            $update_2 = false;
            $update = $this->haj_umrah_hotels->update($data_array, $haj_umrah_hotels_where);
            if ($update) {
                $update_1 = true;
            } else {
                $update_1 = false;
            }

            if (!empty($_POST['haj_umrah_hotels_advantages_ids'])) {
                $haj_umrah_hotels_advantages_where['haj_umrah_hotels_id'] = $haj_umrah_hotel_id;
                $this->haj_umrah_hotels_advantages->delete($haj_umrah_hotels_advantages_where);
                $haj_umrah_hotels_advantages_ids = $_POST['haj_umrah_hotels_advantages_ids'];
                foreach ($haj_umrah_hotels_advantages_ids as $advantage) {
                    $advantages_data['haj_umrah_hotels_id'] = $haj_umrah_hotel_id;
                    $advantages_data['hotels_advantage_id'] = $advantage;
                    $add_advantages = $this->haj_umrah_hotels_advantages->add($advantages_data);
                    if ($add_advantages) {
                        $update_2 = true;
                    } else {
                        $update_2 = false;
                    }
                }
            }

            if ($update_1 || $update_2) {
                print_json('success', _lang('updated_successfully'));
            }
            if (!$update_1 && !$update_2) {
                print_json('error', 'no_affected_rows');
            }
        }

        public function edit2(){
            //pri($_POST);
            $haj_umrah_hotel_id = $_POST['haj_umrah_hotel_id'];
            $find = $this->haj_umrah_hotels->findById($haj_umrah_hotel_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "الاسم ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['hotel_image']) && $_FILES['hotel_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('hotel_image');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('hotel_image')) {
                        $errors = array('program_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->image)) {
                $message['hotel_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['city_id'] = \xss_clean($_POST['city_id']);
            $data_array['region_id'] = \xss_clean($_POST['region_id']);
            $data_array['far_from_campus'] = \xss_clean($_POST['far_from_campus']);

            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['stars'] = \xss_clean($_POST['stars']);
            $data_array['body_ar'] = \xss_clean($_POST['body_arr']);
            $data_array['body_en'] = \xss_clean($_POST['body_en']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['desc_en'] = \xss_clean($_POST['desc_en']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['keywords_en'] = \xss_clean($_POST['keywords_en']);
            $data_array['branches_id'] = $this->current_user_company->id;
            //$data_array['departments_id'] = $this->current_user_branch->id;
            $haj_umrah_hotels_where['id'] = $haj_umrah_hotel_id;
            $update = $this->haj_umrah_hotels->update($data_array, $haj_umrah_hotels_where);
            if ($update) {
                if (!empty($_POST['haj_umrah_hotels_advantages_ids'])) {
                    $haj_umrah_hotels_advantages_where['haj_umrah_hotels_id'] = $haj_umrah_hotel_id;
                    $this->haj_umrah_hotels_advantages->delete($haj_umrah_hotels_advantages_where);
                    $haj_umrah_hotels_advantages_ids = $_POST['haj_umrah_hotels_advantages_ids'];
                    foreach ($haj_umrah_hotels_advantages_ids as $advantage) {
                        $advantages_data['haj_umrah_hotels_id'] = $haj_umrah_hotel_id;
                        $advantages_data['hotels_advantage_id'] = $advantage;
                        $this->haj_umrah_hotels_advantages->add($advantages_data);
                    }
                }

                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $haj_umrah_hotel_id = $_POST['haj_umrah_hotel_id'];
            $where_array['id'] = $haj_umrah_hotel_id;
            $delete = $this->haj_umrah_hotels->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function add_images(){
            //pri($_FILES);
            $hotel_id = $_POST['hotel_id'];
            //$errors = array();
            $errors = 0;
            $images_names = array();
            if (!empty($_FILES['file'])) {
                $this->config->load('files');
                $config = $this->config->item('hotel_image');
                $this->load->library('upload');
                $this->upload->initialize($config);
                $files = $_FILES;
                $number_of_files = count($_FILES['file']['name']);
                //pri($number_of_files);
                for ($i = 0; $i < $number_of_files; $i++) {
                    $_FILES['file']['name'] = $files['file']['name'][$i];
                    $_FILES['file']['type'] = $files['file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $files['file']['error'][$i];
                    $_FILES['file']['size'] = $files['file']['size'][$i];
                    if (!$this->upload->do_upload('file')) {
                        //$errors[$files['file']['name'][$i]] = $this->upload->display_errors();
                        //$this->upload->error_msg = array();
                        $errors++;
                    } else {

                        $upload_data = $this->upload->data();
                        $images_names[] = $upload_data['file_name'];
                    }
                }

                if ($errors > 0) {
                    //pri($errors);
                    $message = _lang('there_is_number');
                    $message.=' ';
                    $message.=$errors;
                    $message.=' ';
                    $message.=_lang('file');
                    $message.=' ';
                    $message.=_lang('not_uploaded');
                    print_json('error', $message);
                } else {
                    //pri($images_names);
                    foreach ($images_names as $image) {
                        $data_array['haj_umrah_hotels_id'] = $hotel_id;
                        $data_array['image'] = $image;
                        $add = $this->haj_umrah_hotels_slider->add($data_array);
                    }
                    print_json('success', 'success');
                }
            } else {
                print_json('error', _lang('no_file_to_upload'));
            }
        }

        public function listFiles(){
            //pri($_POST);
            $hotel_id = $_POST['hotel_id'];
            $find = $this->haj_umrah_hotels_slider->GetAll($hotel_id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'no images');
            }
        }

        public function remove_image(){
            //pri($_POST);
            $image_id = $_POST['image_id'];
            $image_name = $_POST['image'];
            $where_array['id'] = $image_id;
            $delete = $this->haj_umrah_hotels_slider->delete($where_array);
            if ($delete) {
                unlink("./uploads/haj_umrah_hotels/" . $image_name);
                print_json('success', 'deleted');
            } else {
                print_json('error', 'no deleted');
            }
        }

        public function listFiles2(){
            pri($_POST);

            $this->load->helper('file');
            $files = get_filenames("./uploads/haj_umrah_hotels/");
            echo json_encode($files);
        }

        public function add_advantages(){
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $where_array['id'] = $haj_umrah_program_id;
            $delete = $this->haj_umrah_programs->delete2($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete2($id = ""){

            $permission = $this->CheckAccessStatusDelete('programs', 'delete', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {

                $cond['programs_id'] = $id;
                $test = $this->programs->GetWhere("programs_advantage_all", "id", "ASC", $cond);
                $test_1 = $this->programs->GetWhere("programs_extra_service", "id", "ASC", $cond);
                $test_2 = $this->programs->GetWhere("programs_flight", "id", "ASC", $cond);
                //$test_3 = $this->programs->GetWhere("programs_rooms_prices", "id", "ASC", $cond);
                $test_4 = $this->programs->GetWhere("programs_slider", "id", "ASC", $cond);
                pri('ssss');
                if ((count($test) > 0 && $test[0]->id > 0 ) || (count($test_1) > 0 && $test_1[0]->id > 0 ) || (count($test_2) > 0 && $test_2[0]->id > 0 ) || (count($test_3) > 0 && $test_3[0]->id > 0 ) || (count($test_4) > 0 && $test_4[0]->id > 0 )) {
                    echo 'no';
                } else {
                    $this->db->where("id", $id);
                    $this->db->delete("programs");
                    echo 'yes';
                }
            }
        }

        public function deleteDate($id = ""){

            $id = $_POST['id'];
            $this->db->where("id", $id);
            $this->db->delete("programs_dates");
            echo 'yes';
        }

        public function status($id = NULL){
            $permission = $this->CheckAccessStatusDelete('programs', 'edit', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {
                if ($id):
                    $cond['id'] = $id;
                    $all_data = $this->programs->GetWhere("programs", "id", "ASC", $cond);

                    $this->data['all_data'] = $all_data[0];
                else:
                endif;

                if ($this->data['all_data']->active == 1) {
                    $array_data['active'] = 0;
                } else {
                    $array_data['active'] = 1;
                }
                if (isset($id)) {
                    $this->programs->update($array_data, array(
                        'id' => $id
                    ));
                    echo 'yes';
                }
//			\redirect(\base_url("admin/programs/show"));
            }
        }

        function getCityRegions(){
            $cond['place_id'] = $_POST['city_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $regions = $this->haj_umrah_hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($regions) > 0) {
                foreach ($regions as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function getPlaces(){
            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['place_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $regions = $this->haj_umrah_hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($regions) > 0) {
                foreach ($regions as $p) {
                    if ($p->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("haj_umrah_hotels.title_ar as hotel_title_ar,haj_umrah_hotels.id as haj_umrah_hotels_id,haj_umrah_hotels.image as image,"
                            . "p1.title_ar as city_title_ar,p2.title_ar as region_title_ar")
                    ->from("haj_umrah_hotels")
                    ->join("places p1", "haj_umrah_hotels.city_id=p1.id")
                    ->join("places p2", "haj_umrah_hotels.region_id=p2.id")
                    ->where("haj_umrah_hotels.active", 1)
                    ->where("haj_umrah_hotels.branches_id", $this->current_user_company->id);



            $this->datatables->add_column('main_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/haj_umrah_hotels/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'haj_umrah_hotels_id');
            $this->datatables->add_column('images', function($data) {

                $back = '<a href="#" title="' . _lang("") . '" class="tooltips" onclick="Haj_umrah_hotels.add_images(this);return false;" data-id="' . $data["haj_umrah_hotels_id"] . '">' . _lang('gallery') . '</a>';
                return $back;
            }, 'haj_umrah_hotels_id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("") . '" class="tooltips" onclick="Haj_umrah_hotels.edit_hotels(this);return false;" data-id="' . $data["haj_umrah_hotels_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("") . '"
                class="tooltips"
                data-id="' . $data["haj_umrah_hotels_id"] . '"
                onclick="Haj_umrah_hotels.delete_hotels(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'haj_umrah_hotels_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
