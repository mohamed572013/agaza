<?php

    class Transportations extends C_Controller{
        public function __construct(){
            parent::__construct();            
            $this->load->model('Transportations_model', 'transportations');
            $this->load->model('Transportations_slider_model', 'transportations_slider');
            $this->load->model('Brands_model', 'brands_tag');
            $this->load->model('Brands_all_model', 'brand_tags');
            //$this->load->model("Brands_model", "brands");
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function index(){     
            $brands = $this->brands_tag->getAll($this->current_user_company->id);
            $this->data['brands'] = $brands;
            $countries = $this->transportations->places($this->current_user_company->id);
            $this->data['countries'] = $countries;
            $main_content = 'transportations/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $brands = $this->brands_tag->getAll($this->current_user_company->id);
            $this->data['brands'] = $brands;
            $countries = $this->transportations->places($this->current_user_company->id);
            $this->data['countries'] = $countries;
            $main_content = 'transportations/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            $transportation_id = $_POST['transportation_id'];
            $find = $this->transportations->findById($transportation_id);
            $brand_tags = $this->brand_tags->GetAll($transportation_id);
            $find->tags = $brand_tags;
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
                    $new_path = 'uploads/transportations/';
                    $uploading = $this->transportations->do_upload('logo', $config, $new_path);

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
          //  $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);
            $data_array['created_by'] = 97;
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['branches_id'] = $this->current_user_company->id;
           // $data_array['brand_id'] = \xss_clean($_POST['brand_id']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);

            //pri($_POST);
            $add = $this->transportations->add($data_array);
            if ($add) {                
                if (!empty($_POST['transportation_tags_ids'])) {
                    $transportation_tags_ids = $_POST['transportation_tags_ids'];
                    foreach ($transportation_tags_ids as $tag) {
                        $tags_data['transport_id'] = $add;
                        $tags_data['tag_id'] = $tag;
                        $this->brand_tags->add($tags_data);
                    }
                }

                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            //pri($_POST);
            $transportation_id = $_POST['transportation_id'];
            $find = $this->transportations->findById($transportation_id);
            //pri($find);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('the_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('phone', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('address_ar', "المدينة ", 'required');
            $this->form_validation->set_rules('content_ar', "الوصف بالعربية  ", 'required');
          //  $this->form_validation->set_rules('tags', "الوصف بالإنجليزية ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('transportation_image');
                    $new_path = 'uploads/transportations/';
                    $uploading = $this->transportations->do_upload('logo', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('logo' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->logo, strrpos($find->logo, '_') + 1);
                        $files = array(
                            FCPATH . 'uploads/transportations/' . $image_original,
                            FCPATH . 'uploads/transportations/' . $find->logo,
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
       //     $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);
            $data_array['created_by'] = 97;
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['branches_id'] = $this->current_user_company->id;
            //$data_array['brand_id'] = \xss_clean($_POST['brand_id']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);
            $transportations_where['id'] = $transportation_id;
            $update_1 = false;
            $update_2 = false;
            $update = $this->transportations->update($data_array, $transportations_where);

            if ($update) {
                $update_1 = true;
            } else {
                $update_1 = false;
            }

            if (!empty($_POST['transportation_tags_ids'])) {
                $transportation_tags_where['transport_id'] = $transportation_id;
               
                $this->brand_tags->delete($transportation_tags_where);
                 //pri("done");
                $transportation_tags_ids = $_POST['transportation_tags_ids'];
                foreach ($transportation_tags_ids as $tag) {
                    $tags_data['transport_id'] = $transportation_id;
                    $tags_data['brand_id'] = $tag;
                    $add_tags = $this->brand_tags->add($tags_data);

                    if ($add_tags) {
                        $update_2 = true;
                    } else {
                        $update_2 = false;
                    }
                }
                //pri("done");
            }
          

            if ($update_1 || $update_2) {
                print_json('success', _lang('updated_successfully'));
            }
            if (!$update_1 && !$update_2) {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $transportation_id = $_POST['transportation_id'];
            $find = $this->transportations->findById($transportation_id);
            $where_array['id'] = $transportation_id;
            $delete = $this->transportations->delete($where_array);
            if ($delete) {
                $image_original = substr($find->logo, strrpos($find->logo, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/transportations/' . $image_original,
                    FCPATH . 'uploads/transportations/' . $find->logo,
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
            $transportation_id = $_POST['transportation_id'];
            $errors = 0;
            $images_names = array();
            if (!empty($_FILES['file'])) {
                $this->config->load('files');
                $config = $this->config->item('transportation_images_slider');
                $files = $_FILES;
                $number_of_files = count($_FILES['file']['name']);
                //pri($number_of_files);
                for ($i = 0; $i < $number_of_files; $i++) {
                    $_FILES['file']['name'] = $files['file']['name'][$i];
                    $_FILES['file']['type'] = $files['file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $files['file']['error'][$i];
                    $_FILES['file']['size'] = $files['file']['size'][$i];
                    $uploading = $this->transportations_slider->do_upload('file', $config, 'uploads/transportations_slider/');
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
                        $data_array['transportation_id'] = $transportation_id;
                        
                        $add = $this->transportations_slider->add($data_array);
                    }
                    print_json('success', _lang('added_successfully'));
                }
            } else {
                print_json('error', _lang('no_file_to_upload'));
            }
        }

        public function listFiles(){
            //pri($_POST);
            $transportaion_id = $_POST['transportation_id'];
            $find = $this->transportations_slider->GetAll($transportaion_id);
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
            $delete = $this->transportations_slider->delete($where_array);
            if ($delete) {
                $image_original = substr($image_name, strrpos($image_name, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/transportaion_slider/' . $image_original,
                    FCPATH . 'uploads/transportaion_slider/' . $image_name,
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
            $cities = $this->restaurants->GetWhere('places', 'id', "ASC", $cond);
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
                    ->select("id,title_ar,phone,email,address_ar,content_ar,map_url,logo as image,is_active")
                    ->from("transportations")
                    //->join("places p1", "restaurants.places_id=p1.id")
                    //->where("transportations.is_active", 1)
                    ->where("transportations.branches_id", $this->current_user_company->id);



            $this->datatables->add_column('main_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/transportations/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');
            $this->datatables->add_column('is_active', function($data) {
                $back = ($data['is_active'])?"مفعل":"معطل";
                return $back;
            }, 'id');
            $this->datatables->add_column('images', function($data) {

                $back = '<a href="#" title="' . _lang("gallery") . '" class="tooltips" onclick="Transportations.add_images(this);return false;" data-id="' . $data["id"] . '">' . _lang('gallery') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Transportations.edit_hotels(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Transportations.delete_hotels(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
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
