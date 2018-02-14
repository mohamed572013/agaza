<?php

    class Etiquette extends C_Controller{
        public function __construct(){
            parent::__construct();            
            $this->load->model('Etiquette_model', 'etiquette');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function index(){            
            $main_content = 'etiquette/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'etiquette/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            $etiquette_id = $_POST['etiquette_id'];
            $find = $this->etiquette->findById($etiquette_id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri("add");
            $this->load->library('form_validation');                        
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');            
            $this->form_validation->set_rules('tags', "المدينة ", 'required');
            $this->form_validation->set_rules('content_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('the_order', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('is_active', "الوصف بالعربية  ", 'required');
            
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('etiquette_image');
                    $new_path = 'uploads/etiquette/';
                    $uploading = $this->etiquette->do_upload('image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
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
                    $data_array['image'] = $image_name;
                }
            } else {
                $message['image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri($data_array);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);         
            $data_array['content_ar'] = \xss_clean($_POST['content_ar']);
            $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);            
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            $data_array['created'] = date("Y-m-d");
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);
            

            //pri($_POST);
            $add = $this->etiquette->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            //pri($_POST);
            $etiquette_id = $_POST['etiquette_id'];
            $find = $this->etiquette->findById($etiquette_id);
            //pri($find);
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');            
            $this->form_validation->set_rules('tags', "المدينة ", 'required');
            $this->form_validation->set_rules('content_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('the_order', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('is_active', "الوصف بالعربية  ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('etiquette_image');
                    $new_path = 'uploads/etiquette/';
                    $uploading = $this->etiquette->do_upload('image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                        $files = array(
                            FCPATH . 'uploads/etiquette/' . $image_original,
                            FCPATH . 'uploads/etiquette/' . $find->image,
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
                    $data_array['image'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->image)) {
                $message['image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri("done");
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);         
            $data_array['content_ar'] = \xss_clean($_POST['content_ar']);
            $data_array['tags'] = \xss_clean($_POST['tags']);
            $data_array['the_order'] = \xss_clean($_POST['the_order']);            
            $data_array['is_active'] = \xss_clean($_POST['is_active']);
            // /$data_array['created'] = date("Y-m-d");
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['description_ar'] = \xss_clean($_POST['description_ar']);
            $restaurants_where['id'] = $etiquette_id;
            $update_1 = false;
            $update_2 = false;
            $update = $this->etiquette->update($data_array, $restaurants_where);
            if ($update) {
                $update_1 = true;
            } else {
                $update_1 = false;
            }
           

            if ($update_1 || $update_2) {
                print_json('success', _lang('updated_successfully'));
            }
            if (!$update_1 && !$update_2) {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $etiquette_id = $_POST['etiquette_id'];
            $find = $this->etiquette->findById($etiquette_id);
            $where_array['id'] = $etiquette_id;
            $delete = $this->etiquette->delete($where_array);
            if ($delete) {
                $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/etiquette/' . $image_original,
                    FCPATH . 'uploads/etiquette/' . $find->image,
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

   

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,content_ar,image,created")
                    ->from("etiquette")
                    //->join("places p1", "restaurants.places_id=p1.id")
                    ->where("etiquette.is_active", 1)
                    ->where("etiquette.branches_id", $this->current_user_company->id);



            $this->datatables->add_column('main_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/etiquette/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');
            
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Etiquette.edit_hotels(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Etiquette.delete_hotels(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

  

    }
