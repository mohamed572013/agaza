<?php

    class Maka_madina_shrines extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Maka_madina_shrines_model', 'maka_madina_shrines');
            $this->load->model('Shrines_slider_model', 'shrines_slider');
        }

        public function index(){

            $cond['place_id'] = 0;
            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['countries'] = $this->maka_madina_shrines->GetWhere("places", "id", "ASC", $cond);
            $main_content = 'shrines/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $cond['place_id'] = 0;
            $cond['branches_id'] = $this->_current_user->branches_id;
            $cond['active'] = 1;
            $this->data['countries'] = $this->maka_madina_shrines->GetWhere("places", "id", "ASC", $cond);
            $main_content = 'shrines/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->maka_madina_shrines->findById($id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('body_ar', "المحتوى بالعربية ", 'required');
            $this->form_validation->set_rules('body_en', "المحتوى بالإنجليزية ", 'required');
            $this->form_validation->set_rules('desc_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('desc_en', "الوصف بالإنجليزية ", 'required');
            $this->form_validation->set_rules('keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
            $this->form_validation->set_rules('keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
            $this->form_validation->set_rules('places_id', "المدينة ", 'required');
            $this->form_validation->set_rules('country_id', "الدولة ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('shrine_image');
                    $new_path = 'uploads/maka_madina_shrines/';
                    
                    $uploading = $this->maka_madina_shrines->do_upload('image', $config, $new_path);

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
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['country_id'] = \xss_clean($_POST['country_id']);
            $data_array['places_id'] = \xss_clean($_POST['places_id']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['body_ar'] = $_POST['body_ar'];
            $data_array['body_en'] = $_POST['body_en'];
            $data_array['desc_ar'] = $_POST['desc_ar'];
            $data_array['desc_en'] = $_POST['desc_en'];
            $data_array['keywords_ar'] = $_POST['keywords_ar'];
            $data_array['keywords_en'] = $_POST['keywords_en'];
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['branches_id'] = $this->current_user_company->id;
            $add = $this->maka_madina_shrines->add($data_array);
            if ($add) {


                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            $id = $_POST['id'];
            $find = $this->maka_madina_shrines->findById($id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('body_ar', "المحتوى بالعربية ", 'required');
            $this->form_validation->set_rules('body_en', "المحتوى بالإنجليزية ", 'required');
            $this->form_validation->set_rules('desc_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('desc_en', "الوصف بالإنجليزية ", 'required');
            $this->form_validation->set_rules('keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
            $this->form_validation->set_rules('keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
            $this->form_validation->set_rules('places_id', "المدينة ", 'required');
            $this->form_validation->set_rules('country_id', "الدولة ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('shrine_image');
                    $new_path = 'uploads/maka_madina_shrines/';
                    
                    $uploading = $this->maka_madina_shrines->do_upload('image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                        $files = array(
                            FCPATH . 'uploads/maka_madina_shrines/' . $image_original,
                            FCPATH . 'uploads/maka_madina_shrines/' . $find->image,
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
                $message['hotel_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['country_id'] = \xss_clean($_POST['country_id']);
            $data_array['places_id'] = \xss_clean($_POST['places_id']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['body_ar'] = $_POST['body_ar'];
            $data_array['body_en'] = $_POST['body_en'];
            $data_array['desc_ar'] = $_POST['desc_ar'];
            $data_array['desc_en'] = $_POST['desc_en'];
            $data_array['keywords_ar'] = $_POST['keywords_ar'];
            $data_array['keywords_en'] = $_POST['keywords_en'];
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['branches_id'] = $this->current_user_company->id;
            $where_array['id'] = $id;
            $update = $this->maka_madina_shrines->update($data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', _lang('no_affected_rows'));
            }
        }

        public function delete(){

            $id = $_POST['id'];
            $find = $this->maka_madina_shrines->findById($id);
            $where_array['id'] = $id;
            $delete = $this->maka_madina_shrines->delete($where_array);
            if ($delete) {
                $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/maka_madina_shrines/' . $image_original,
                    FCPATH . 'uploads/maka_madina_shrines/' . $find->image,
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

        public function data(){
            $CI = & get_instance();
            $this->load->library('datatables');
            $this->datatables
                    ->select("shrines.id as shrine_id,shrines.title_ar as shrine_title_ar,shrines.title_en as shrine_title_en,shrines.image as shrine_image,"
                            . "p1.title_ar as city_title_ar, p1.title_en as city_title_en,"
                    )
                    ->from("maka_madina_shrines shrines")
                    ->join("places p1", "p1.id=shrines.places_id")
                    ->where("shrines.branches_id", $CI->_current_user->branches_id);
            $this->datatables->add_column('images', function($data) {

                $back = '<a href="#" title="' . _lang("gallery") . '" class="tooltips" onclick="Shrines.add_images(this);return false;" data-id="' . $data["shrine_id"] . '">' . _lang('gallery') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('shrine_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/maka_madina_shrines/' . $data['shrine_image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'shrine_id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Shrines.edit(this);return false;" data-id="' . $data["shrine_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["shrine_id"] . '"
                onclick="Shrines.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                return $back;
            }, 'shrine_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        function getPlaces(){
            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['place_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $cities = $this->maka_madina_shrines->GetWhere('places', 'id', "ASC", $cond);
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

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $cities = $this->maka_madina_shrines->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                $str = "";
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        public function listFiles(){
            //pri($_POST);
            $where_array['shrine_id'] = $_POST['shrine_id'];
            $find = $this->shrines_slider->GetAll($where_array);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'no images');
            }
        }

        public function add_images(){
            
            $shrine_id = $_POST['shrine_id'];
            //$errors = array();
            $errors = 0;
            $images_names = array();
            if (!empty($_FILES['file'])) {
                //pri($_FILES['file']);
                $this->config->load('files');
                $config = $this->config->item('shrine_slider_image');
                $files = $_FILES;
                $number_of_files = count($_FILES['file']['name']);
                //pri($number_of_files);
                for ($i = 0; $i < $number_of_files; $i++) {
                    //pri($files['file']);
                    //pri($number_of_files);
                    $_FILES['file']['name'] = $files['file']['name'][$i];
                    $_FILES['file']['type'] = $files['file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $files['file']['error'][$i];
                    $_FILES['file']['size'] = $files['file']['size'][$i];
                    //pri($_FILES['file']['name']);
                    $uploading = $this->shrines_slider->do_upload('file', $config, 'uploads/shrines_slider/');
                    
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
                        $data_array['shrine_id'] = $shrine_id;
                        //$data_array['image'] = $image;
                        $data_array['image'] = $image;
                        $add = $this->shrines_slider->add($data_array);
                    }
                    print_json('success', \_lang('added_successfully'));
                }
            } else {
                print_json('error', _lang('no_file_to_upload'));
            }
        }

        public function remove_image(){
            //pri($_POST);
            $image_id = $_POST['image_id'];
            $image_name = $_POST['image'];
            $where_array['id'] = $image_id;
            $delete = $this->shrines_slider->delete($where_array);
            if ($delete) {
                $image_original = substr($image_name, strrpos($image_name, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/shrines_slider/' . $image_name,
                    FCPATH . 'uploads/shrines_slider/' . $image_original,
                );
                foreach ($files as $file) {
                    if (!is_dir($file)) {
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
                print_json('success', \_lang('deleted_successfully'));
            } else {
                print_json('error', 'no deleted');
            }
        }

    }
