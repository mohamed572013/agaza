<?php

    class About_us extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('About_us_model', 'about_us');
        }

        public function index(){
            $about_us = $this->about_us->getAboutUs($this->current_user_company->id);
            $this->data['about_us'] = $about_us;
            $main_content = 'about_us/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $about_us = $this->about_us->getAboutUs($this->current_user_company->id);
            $this->data['about_us'] = $about_us;
            $main_content = 'about_us/index';
            $this->_view($main_content, 'admin');
        }

        function edit(){
            $about_us = $this->about_us->getAboutUs($this->current_user_company->id);
            //pri($about_us);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            $this->form_validation->set_rules('desc_ar', 'الوصف بالعربية', 'required');
            $this->form_validation->set_rules('desc_en', 'الوصف بالإنجليزية', 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['about_us_image']) && $_FILES['about_us_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('about_us');
                    $uploading = $this->about_us->do_upload('about_us_image', $config);

                    if (!$uploading) {
                        $errors = array('about_us_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        if (!empty($about_us->image)) {
                            unlink($config['upload_path'] . '/' . $about_us->image);
                        }

                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                }
                if (empty($_FILES['about_us_image']['name']) && empty($about_us->image)) {
                    $errors = array('about_us_image' => 'من فضلك أدخل صورة');
                    print_json('error', $errors);
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            }
            //pri($array_data);
            $data_array['title_ar'] = $_POST['title_ar'];
            $data_array['title_en'] = $_POST['title_en'];
            $data_array['desc_ar'] = $_POST['desc_ar'];
            $data_array['desc_en'] = $_POST['desc_en'];
            $where_array['branches_id'] = $this->current_user_company->id;
            //pri($where_array);
            $update = $this->about_us->update($data_array, $where_array);
            $about_us_after_update = $this->about_us->getAboutUs($this->current_user_company->id);
            if ($update) {
                print_json('success', $about_us_after_update);
            } else {
                print_json('error', 'no_affected_rows');
            }
            //save data here
        }

    }
