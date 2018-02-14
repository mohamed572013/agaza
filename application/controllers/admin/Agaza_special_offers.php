<?php

    class Agaza_special_offers extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Agaza_special_offers_model', 'agaza_special_offers');
        }

        public function index(){
            $main_content = 'agaza_special_offers/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'agaza_special_offers/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->agaza_special_offers->findById($id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        function add(){
            //pri($about_us);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنونا بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            $this->form_validation->set_rules('url', 'الرابط', 'required');
            $this->form_validation->set_rules('section_type', 'مكانها فى اجازة بوك', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('image');
                    $uploading = $this->agaza_special_offers->do_upload('image', $config);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        //$upload_data = $this->upload->data();
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
            //pri($array_data);
            $data_array['title_ar'] = $_POST['title_ar'];
            $data_array['title_en'] = $_POST['title_en'];
            $data_array['url'] = $_POST['url'];
            $data_array['price'] = $_POST['price'];
            $data_array['active'] = $_POST['active'];
            $data_array['section_type'] = $_POST['section_type'];
            $data_array['branches_id'] = $this->current_user_company->id;
            //pri($where_array);
            $add = $this->agaza_special_offers->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
            //save data here
        }

        function edit(){
            $id = $_POST['id'];
            $find = $this->agaza_special_offers->findById($id);
            //pri($about_us);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنونا بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            $this->form_validation->set_rules('url', 'الرابط', 'required');
            $this->form_validation->set_rules('section_type', 'مكانها فى اجازة بوك', 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('image');
                    $uploading = $this->agaza_special_offers->do_upload('image', $config);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        if (!empty($find->image)) {
                            $image = substr($find->image, strrpos($find->image, '_') + 1);
                            $files[] = FCPATH . 'uploads/agaza_special_offers/' . $find->image;
                            $files[] = FCPATH . 'uploads/agaza_special_offers/' . $image;
                            foreach ($files as $file) {
                                if (!is_dir($file)) {
                                    if (file_exists($file)) {
                                        unlink($file);
                                    }
                                }
                            }
                        }
                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                }
                if (empty($_FILES['image']['name']) && empty($find->image)) {
                    $errors = array('image' => 'من فضلك أدخل صورة');
                    print_json('error', $errors);
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            }
            $data_array['title_ar'] = $_POST['title_ar'];
            $data_array['title_en'] = $_POST['title_en'];
            $data_array['url'] = $_POST['url'];
            $data_array['price'] = $_POST['price'];
            $data_array['active'] = $_POST['active'];
            $data_array['section_type'] = $_POST['section_type'];
            $data_array['branches_id'] = $this->current_user_company->id;
            $where_array['id'] = $id;
            //pri($where_array);
            $update = $this->agaza_special_offers->update($data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
            //save data here
        }

        public function delete(){
            $id = $_POST['id'];
            $where_array['id'] = $id;
            $deleted = $this->agaza_special_offers->delete($where_array);
            if ($deleted) {
                $find = $this->agaza_special_offers->findById($id);
                if (!empty($find->image)) {
                    $image = substr($find->image, strrpos($find->image, '_') + 1);
                    $files[] = FCPATH . 'uploads/agaza_special_offers/' . $find->image;
                    $files[] = FCPATH . 'uploads/agaza_special_offers/' . $image;
                    foreach ($files as $file) {
                        if (!is_dir($file)) {
                            if (file_exists($file)) {
                                unlink($file);
                            }
                        }
                    }
                }
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    ->from("agaza_special_offers")
                    ->where("branches_id", $this->current_user_company->id);
//
//            $this->datatables->add_column('user_input', function($data) {
//                return '<input type="checkbox" name="id[]" value="' . $data['user_id'] . '" class="cbr check-me">';
//            }, 'user_id');

            $this->datatables->add_column('image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/agaza_special_offers/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {
                $back = "";

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Agaza_special_offers.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Agaza_special_offers.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
    