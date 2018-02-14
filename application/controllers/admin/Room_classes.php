<?php

    class Room_classes extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->load->model('Room_classes_model', 'room_classes');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function index(){
            $main_content = 'room_classes/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'room_classes/index';
            $this->_view($main_content, 'admin');
        }

        function edit(){
            $about_us = $this->about_us->getAboutUs($this->current_user_company->id);
            //pri($about_us);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان', 'required');
            $this->form_validation->set_rules('desc_ar', 'الوصف', 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['about_us_image']) && $_FILES['about_us_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('about_us');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('about_us_image')) {
                        $errors = array('about_us_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        if (!empty($about_us->image)) {
                            unlink($config['upload_path'] . '/' . $about_us->image);
                        }

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
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
            $data_array['desc_ar'] = $_POST['desc_ar'];
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

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    //->where("user_type","admin")
                    ->from("room_classes");

//            $this->datatables->add_column('user_input', function($data) {
//                return '<input type="checkbox" name="id[]" value="' . $data['user_id'] . '" class="cbr check-me">';
//            }, 'user_id');


            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit_room_classes") . '" class="tooltips" onclick="Room_classes.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-1-8x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("remove_room_classes") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"

                onclick="Room_classes.delete(this);return false;"><i class="fa fa-times fa-1-8x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
