<?php

    class Shops extends C_Controller{
        public function __construct(){
            parent::__construct();            
            $this->load->model('Shops_model', 'shops');
            $this->load->model('Shops_advantage_model', 'shops_advantage');
            $this->load->model('Shop_advantages_model', 'shop_advantages');
            $this->load->model('Shops_tag_model', 'shops_tag');
            $this->load->model('Shop_tags_model', 'shop_tags');
            $this->load->model('Shop_slider_model', 'shop_slider');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function index(){
            //merge();
            $shops_advantages = $this->shops_advantage->getAll($this->current_user_company->id);
            $countries = $this->shops->places($this->current_user_company->id);
            $shops_tags = $this->shops_tag->getAll($this->current_user_company->id);
            $this->data['shops_advantages'] = $shops_advantages;
            $this->data['shops_tags'] = $shops_tags;
            $this->data['countries'] = $countries;
            $main_content = 'shops/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $shops_advantages = $this->shops_advantage->getAll($this->current_user_company->id);
            $countries = $this->shops->places($this->current_user_company->id);
            $shops_tags = $this->shops_tag->getAll($this->current_user_company->id);
            $this->data['shops_advantages'] = $shops_advantages;
            $this->data['shops_tags'] = $shops_tags;
            $this->data['countries'] = $countries;
            $main_content = 'shops/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $shop_id = $_POST['shop_id'];
            $find = $this->shops->findById($shop_id);
            $shop_advantages = $this->shop_advantages->GetAll($shop_id);
            $shop_tags = $this->shop_tags->GetAll($shop_id);
            $find->advantages = $shop_advantages;
            $find->tags = $shop_tags;
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri("add");
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('the_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('phone', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('address_ar', "المدينة ", 'required');
            $this->form_validation->set_rules('content_ar', "الوصف بالعربية  ", 'required');
            
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('shop_image');
                    $new_path = 'uploads/shops/';
                    $uploading = $this->shops->do_upload('logo', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('logo' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['logo'] = $image_name;
                }
            } else {
                $message['logo'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri($data_array);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['phone'] = \xss_clean($_POST['phone']);
            $data_array['email'] = \xss_clean($_POST['email']);
            $data_array['address_ar'] = \xss_clean($_POST['address_ar']);            
            $data_array['content_ar'] = \xss_clean($_POST['content_ar']);
            $data_array['map_url'] = \xss_clean($_POST['map_url']);
            $data_array['country_id'] = \xss_clean($_POST['country_id']);
            $data_array['places_id'] = \xss_clean($_POST['places_id']);
            $data_array['area_id'] = 0;
            $data_array['video'] = \xss_clean($_POST['video']);
        //    $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);
            $data_array['created_by'] = 97;
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);

            //pri($_POST);
            $add = $this->shops->add($data_array);
            if ($add) {
                if (!empty($_POST['shop_advantages_ids'])) {
                    $shop_advantages_ids = $_POST['shop_advantages_ids'];
                    foreach ($shop_advantages_ids as $advantage) {
                        $advantages_data['shop_id'] = $add;
                        $advantages_data['feature_id'] = $advantage;
                        $this->shop_advantages->add($advantages_data);
                    }
                }

                if (!empty($_POST['shop_tags_ids'])) {
                    $shop_tags_ids = $_POST['shop_tags_ids'];
                    foreach ($shop_tags_ids as $tag) {
                        $tags_data['shop_id'] = $add;
                        $tags_data['tag_id'] = $tag;
                        $this->shop_tags->add($tags_data);
                    }
                }

                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            //pri($_POST);
            $shop_id = $_POST['shop_id'];
            $find = $this->shops->findById($shop_id);
            //pri($find);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('the_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('phone', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('address_ar', "المدينة ", 'required');
            $this->form_validation->set_rules('content_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('places_id', "ادخل المكان  ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('shop_image');
                    $new_path = 'uploads/shops/';
                    $uploading = $this->shops->do_upload('logo', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('logo' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->logo, strrpos($find->logo, '_') + 1);
                        $files = array(
                            FCPATH . 'uploads/shops/' . $image_original,
                            FCPATH . 'uploads/shops/' . $find->logo,
                        );
                        foreach ($files as $file) {
                            if (!is_dir($file)) {
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                            }
                        }
                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['logo'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->logo)) {
                $message['logo'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri("done");
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['phone'] = \xss_clean($_POST['phone']);
            $data_array['email'] = \xss_clean($_POST['email']);
            $data_array['address_ar'] = \xss_clean($_POST['address_ar']);            
            $data_array['content_ar'] = \xss_clean($_POST['content_ar']);
            $data_array['map_url'] = \xss_clean($_POST['map_url']);
            $data_array['country_id'] = \xss_clean($_POST['country_id']);
            $data_array['places_id'] = \xss_clean($_POST['places_id']);
            $data_array['area_id'] = 0;
            $data_array['video'] = \xss_clean($_POST['video']);
       //     $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);
            $data_array['created_by'] = 97;
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);
            $restaurants_where['id'] = $shop_id;
            $update_1 = false;
            $update_2 = false;
            $update = $this->shops->update($data_array, $restaurants_where);
            if ($update) {
                $update_1 = true;
            } else {
                $update_1 = false;
            }
            //pri("updated");

            if (!empty($_POST['shop_advantages_ids'])) {
                $shop_advantages_where['shop_id'] = $shop_id;
               
                $this->shop_advantages->delete($shop_advantages_where);
                 //pri("done");
                $shop_advantages_ids = $_POST['shop_advantages_ids'];
                foreach ($shop_advantages_ids as $advantage) {
                    $advantages_data['shop_id'] = $shop_id;
                    $advantages_data['feature_id'] = $advantage;
                    $add_advantages = $this->shop_advantages->add($advantages_data);

                    if ($add_advantages) {
                        $update_2 = true;
                    } else {
                        $update_2 = false;
                    }
                }
                //pri("done");
            }


            if (!empty($_POST['shop_tags_ids'])) {
                $shop_tags_where['shop_id'] = $shop_id;
               
                $this->shop_tags->delete($shop_tags_where);
                 //pri("done");
                $shop_tags_ids = $_POST['shop_tags_ids'];
                foreach ($shop_tags_ids as $tag) {
                    $tags_data['shop_id'] = $shop_id;
                    $tags_data['tag_id'] = $tag;
                    $add_tags = $this->shop_tags->add($tags_data);

                    if ($add_tags) {
                        $update_2 = true;
                    } else {
                        $update_2 = false;
                    }
                }
                //pri("done");
            }


            //pri("updated");

            if ($update_1 || $update_2) {
                print_json('success', _lang('updated_successfully'));
            }
            if (!$update_1 && !$update_2) {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $shop_id = $_POST['shop_id'];
            $find = $this->shops->findById($shop_id);
            $where_array['id'] = $shop_id;
            $delete = $this->shops->delete($where_array);
            if ($delete) {
                $image_original = substr($find->logo, strrpos($find->logo, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/shops/' . $image_original,
                    FCPATH . 'uploads/shops/' . $find->logo,
                );
                foreach ($files as $file) {
                    if (!is_dir($file)) {
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function add_images(){
            //pri($_FILES);
            $shop_id = $_POST['shop_id'];
            //pri($_POST);
            //$errors = array();
            $errors = 0;
            $images_names = array();
            if (!empty($_FILES['file'])) {
                $this->config->load('files');
                $config = $this->config->item('shop_images_slider');
                $files = $_FILES;
                $number_of_files = count($_FILES['file']['name']);
                //pri($number_of_files);
                for ($i = 0; $i < $number_of_files; $i++) {
                    $_FILES['file']['name'] = $files['file']['name'][$i];
                    $_FILES['file']['type'] = $files['file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $files['file']['error'][$i];
                    $_FILES['file']['size'] = $files['file']['size'][$i];
                    $uploading = $this->shop_slider->do_upload('file', $config, 'uploads/shop_slider/');
                    //pri($files);
                    if (!$uploading) {
                        $errors++;
                    } else {

                        $images_names[] = $uploading;
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
                        $data_array['image'] = $image;
                        $data_array['shop_id'] = $shop_id;
                        
                        $add = $this->shop_slider->add($data_array);
                    }
                    print_json('success', _lang('added_successfully'));
                }
            } else {
                print_json('error', _lang('no_file_to_upload'));
            }
        }

        public function listFiles(){
            //pri($_POST);
            $shop_id = $_POST['shop_id'];
            $find = $this->shop_slider->GetAll($shop_id);
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
            $delete = $this->shop_slider->delete($where_array);
            if ($delete) {
                $image_original = substr($image_name, strrpos($image_name, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/shop_slider/' . $image_original,
                    FCPATH . 'uploads/shop_slider/' . $image_name,
                );
                foreach ($files as $file) {
                    if (!is_dir($file)) {
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
                print_json('success', 'deleted');
            } else {
                print_json('error', 'no deleted');
            }
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
            //pri("ddd");
            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['place_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $cities = $this->shops->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $c) {
                    if ($c->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $c->id . '>' . $c->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,phone,email,address_ar,content_ar,map_url,logo as image")
                    ->from("shops")
                    //->join("places p1", "restaurants.places_id=p1.id")
                    ->where("shops.is_active", 1)
                    ->where("shops.branches_id", $this->current_user_company->id);



            $this->datatables->add_column('main_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/shops/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');
            $this->datatables->add_column('images', function($data) {

                $back = '<a href="#" title="' . _lang("gallery") . '" class="tooltips" onclick="Shops.add_images(this);return false;" data-id="' . $data["id"] . '">' . _lang('gallery') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Shops.edit_hotels(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Shops.delete_hotels(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        function getCountryCities(){
            //pri($_POST);
            $cond['place_id'] = $_POST['country_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $places = $this->hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($places) > 0) {
                foreach ($places as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

    }
