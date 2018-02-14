<?php

    class Programs_slider extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_slider_model', 'programs_slider');
        }

        public function show($Programs = ""){
            $cond_pro['id'] = $Programs;
            $this->data['Programs'] = $this->programs_slider->GetWhere("programs", "id", "ASC", $cond_pro);
            $cond = array();
            if ($Programs > 0) {
                $cond['programs_id'] = \xss_clean($Programs);
            }


            $this->data['page_list'] = $this->programs_slider->GetWhere("programs_slider", "id", "ASC", $cond);
            $this->view('admin/programs_slider/view');
        }

        public function add($Programs = ""){
            $Programs = \xss_clean($Programs);


            $cond['active'] = 1;
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_slider->GetWhere("programs", "id", "ASC", $cond);
            if (\count($_POST) > 0) {


                $title_ar = $this->_lang['title_ar'];

                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $image = $this->programs_slider->do_upload('image', 'uploads/programs_slider/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                        $file_name = $config['upload_path'] . "/" . $this->upload->file_name;
                    }
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['programs_id'] = $_POST['programs_id'];
                    $array_data['created_by'] = $this->_login_data['user_id'];
                    $array_data['active'] = \xss_clean($_POST['active']);

                    $this->programs_slider->add($array_data);
                    $programs_id = $_POST['programs_id'];

                    \redirect(\base_url("admin/programs_slider/show/$programs_id"));
                }
            }

            $this->view('admin/programs_slider/form');
        }

        public function edit($id = "", $Programs = ""){



            $cond['active'] = 1;
            $cond['id'] = $Programs;

            $this->data['Programs'] = $this->programs_slider->GetWhere("programs", "id", "ASC", $cond);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_slider/show'));
            }

            if (!empty($_POST)) {
                $title_ar = $this->_lang['title_ar'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');



                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $image = $this->programs_slider->do_upload('image', 'uploads/programs_slider/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                    }

                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['programs_id'] = $_POST['programs_id'];
                    $array_data['active'] = \xss_clean($_POST['active']);

                    $this->programs_slider->update($array_data, array(
                        'id' => $id
                    ));
                    $programs_id = $_POST['programs_id'];

                    \redirect(\base_url("admin/programs_slider/show/$programs_id"));
                }
            }

            $edit = $this->programs_slider->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_slider/form");
        }

        public function delete($id = "", $programs_id = ""){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url("admin/programs_slider/show/$programs_id"));
                return false;
            }
            $this->db->where("id", $id);
            $this->db->delete("programs_slider");
            echo 'yes';
        }

        public function status($id = NULL, $programs_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_slider->GetWhere("programs_slider", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_slider->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function do_upload_images(){
            $table = "programs_slider";
            $folder = "programs_slider";
            $programs_id = $_POST['programs_id'];
            $array_data['created_by'] = $this->_login_data['user_id'];
            $array_data['active'] = 1;
            $array_data['programs_id'] = $_POST['programs_id'];

            $this->load->library('upload');

            $files = $_FILES;

            $cpt = count($_FILES ['images'] ['name']);
            for ($i = 0; $i < $cpt; $i++) {

                $this->upload->initialize($this->set_upload_options($folder));

                $_FILES ['images'] ['name'] = $files ['images'] ['name'] [$i];
                $_FILES ['images'] ['type'] = $files ['images'] ['type'] [$i];
                $_FILES ['images'] ['tmp_name'] = $files ['images'] ['tmp_name'] [$i];
                $_FILES ['images'] ['error'] = $files ['images'] ['error'] [$i];
                $_FILES ['images'] ['size'] = $files ['images'] ['size'] [$i];

                $this->upload->do_upload('images');

                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
//				echo $file_name;
//				\pr($upload_data['raw_name']) . "<br>";

                $array_data['image'] = $file_name;
                $array_data['title_ar'] = $upload_data['raw_name'];

                $this->programs_slider->add($array_data);
            }
            \redirect(\base_url("admin/programs_slider/show/$programs_id"));
        }

        private function set_upload_options($folder = ""){


            // upload an image options
            $config = array();
            $config ['upload_path'] = "./uploads/$folder";
            $config ['allowed_types'] = 'gif|jpg|png';

            $config['quality'] = '100%';

            return $config;
        }

    }
