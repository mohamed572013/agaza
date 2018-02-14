<?php

    class Maka_madina_hotels_slider extends C_Controller{
        public function __construct(){
            parent::__construct();
//        $this->CheckLogin(true);
//        $this->CheckAccess('maka_madina_hotels_slider_controll', 'open', true);
            $this->load->model('Maka_madina_hotels_slider_model', 'maka_madina_hotels_slider');
        }

        public function show($hotels = ""){
            $cond = array();
            if ($hotels > 0) {
                $cond['maka_madina_hotels_id'] = \xss_clean($hotels);
            }


            $this->data['page_list'] = $this->maka_madina_hotels_slider->GetWhere("maka_madina_hotels_slider", "id", "ASC", $cond);
            $this->view('admin/maka_madina_hotels_slider/view');
        }

        public function add($hotels = ""){
            $hotels = \xss_clean($hotels);


            $cond['active'] = 1;
            $this->data['hotels'] = $this->maka_madina_hotels_slider->GetWhere("maka_madina_hotels", "id", "ASC", $cond);
            if (\count($_POST) > 0) {


                $title_ar = $this->_lang['title_ar'];
                $hotels = $this->_lang['hotels'];

                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');
                $this->form_validation->set_rules('maka_madina_hotels_id', "$hotels", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $image = $this->maka_madina_hotels_slider->do_upload('image', 'uploads/maka_madina_hotels_slider/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                    }
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['maka_madina_hotels_id'] = $_POST['maka_madina_hotels_id'];
                    $array_data['created_by'] = $this->_login_data['user_id'];
                    $array_data['active'] = \xss_clean($_POST['active']);

                    $this->maka_madina_hotels_slider->add($array_data);
                    $maka_madina_hotels_id = $_POST['maka_madina_hotels_id'];

                    \redirect(\base_url("admin/maka_madina_hotels_slider/show/$maka_madina_hotels_id"));
                }
            }

            $this->view('admin/maka_madina_hotels_slider/form');
        }

        public function edit($id = ""){



            $cond['active'] = 1;

            $this->data['hotels'] = $this->maka_madina_hotels_slider->GetWhere("maka_madina_hotels", "id", "ASC", $cond);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/maka_madina_hotels_slider/show'));
            }

            if (!empty($_POST)) {
                $title_ar = $this->_lang['title_ar'];
                $hotels = $this->_lang['hotels'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');
                $this->form_validation->set_rules('maka_madina_hotels_id', "$hotels", 'required');



                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $image = $this->maka_madina_hotels_slider->do_upload('image', 'uploads/maka_madina_hotels_slider/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                    }

                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['maka_madina_hotels_id'] = $_POST['maka_madina_hotels_id'];
                    $array_data['active'] = \xss_clean($_POST['active']);

                    $this->maka_madina_hotels_slider->update($array_data, array(
                        'id' => $id
                    ));
                    $maka_madina_hotels_id = $_POST['maka_madina_hotels_id'];

                    \redirect(\base_url("admin/maka_madina_hotels_slider/show/$maka_madina_hotels_id"));
                }
            }

            $edit = $this->maka_madina_hotels_slider->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/maka_madina_hotels_slider/form");
        }

        public function delete($id = "", $maka_madina_hotels_id = ""){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url("admin/maka_madina_hotels_slider/show/$maka_madina_hotels_id"));
                return false;
            }
            $this->db->where("id", $id);
            $this->db->delete("maka_madina_hotels_slider");
            echo 'yes';
        }

        public function status($id = NULL, $maka_madina_hotels_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->maka_madina_hotels_slider->GetWhere("maka_madina_hotels_slider", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->maka_madina_hotels_slider->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function do_upload_images(){
            $table = "maka_madina_hotels_slider";
            $folder = "maka_madina_hotels_slider";
            $maka_madina_hotels_id = $_POST['maka_madina_hotels_id'];
            $array_data['created_by'] = $this->_login_data['user_id'];
            $array_data['active'] = 1;
            $array_data['maka_madina_hotels_id'] = $_POST['maka_madina_hotels_id'];

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

                $this->maka_madina_hotels_slider->add($array_data);
            }
            \redirect(\base_url("admin/maka_madina_hotels_slider/show/$maka_madina_hotels_id"));
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
