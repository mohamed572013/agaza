<?php

    class Ads extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->CheckLogin(true);
            $this->load->model('Ads_model', 'ads');
        }

        public function show(){
            $cond = array();
            $this->data['page_list'] = $this->ads->GetWhere("ads", "id", "ASC", $cond);
            $this->view('admin/ads/view');
        }

        public function add(){


            if (\count($_POST) > 0) {


                $title_ar = $this->_lang['title_ar'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $image = $this->ads->do_upload('image', 'uploads/ads/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                    }
                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['this_order'] = $_POST['this_order'];
                    $array_data['up_or_down'] = \xss_clean($_POST['up_or_down']);
                    $array_data['url'] = $_POST['url'];
                    $array_data['created_by'] = $this->_login_data['user_id'];

                    $this->ads->add($array_data);

                    \redirect(\base_url("admin/ads/show"));
                }
            }

            $this->view('admin/ads/form');
        }

        public function edit($id = ""){



            $cond['active'] = 1;


            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/ads/show'));
            }

            if (!empty($_POST)) {
                $title_ar = $this->_lang['title_ar'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $image = $this->ads->do_upload('image', 'uploads/ads/');
                    if ($image != FALSE) {
                        $array_data['image'] = $image;
                    }

                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['up_or_down'] = \xss_clean($_POST['up_or_down']);
                    $array_data['this_order'] = $_POST['this_order'];
                    $array_data['url'] = $_POST['url'];

                    $array_data['active'] = \xss_clean($_POST['active']);

                    $this->ads->update($array_data, array(
                        'id' => $id
                    ));

                    \redirect(\base_url("admin/ads/show"));
                }
            }

            $edit = $this->ads->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/ads/form");
        }

        public function delete($id = ""){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url("admin/ads/show"));
                return false;
            }
            $this->db->where("id", $id);
            $this->db->delete("ads");
            echo 'yes';
        }

        public function status($id = NULL){


            if ($id):
                $cond['id'] = $id;
                $all_data = $this->ads->GetWhere("ads", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->ads->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function do_upload_images(){

            $last_order = $this->ads->GetWhere("ads", "this_order", "DESC", array());
            $this_order = $last_order[0]->this_order;

            $table = "ads";
            $folder = "ads";

            $this->load->library('upload');

            $files = $_FILES;

            $cpt = count($_FILES ['images'] ['name']);
            for ($i = 0; $i < $cpt; $i++) {

                $this_order++;
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

                $array_data['active'] = 1;
                $array_data['image'] = $file_name;
                $array_data['title_ar'] = $upload_data['raw_name'];
                $array_data['this_order'] = $this_order;
                $array_data['url'] = "#";
                $array_data['created_by'] = $this->_login_data['user_id'];

                $this->ads->add($array_data);
            }
            \redirect(\base_url("admin/ads/show"));
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
