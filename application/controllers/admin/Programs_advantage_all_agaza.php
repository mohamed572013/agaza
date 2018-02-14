<?php

    class Programs_advantage_all extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_advantage_all_model', 'programs_advantage_all');
        }

        public function show($Programs = ""){
            $cond_pro['id'] = $Programs;
            $this->data['Programs'] = $this->programs_advantage_all->GetWhere("programs", "id", "ASC", $cond_pro);

            $this->data['page_list'] = $this->programs_advantage_all->GetallProgramExtra_service($Programs);
            $this->view('admin/programs_advantage_all/view');
        }

        public function add($Programs = ""){
            $Programs = \xss_clean($Programs);


            $programs_advantage_where['branches_id'] = $this->_current_user->branches_id;
            $programs_advantage_where['is_deleted'] = 0;
            $this->data['programs_advantage'] = $this->programs_advantage_all->GetWhere("programs_advantage", "id", "ASC", $programs_advantage_where);
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_advantage_all->GetWhere("programs", "id", "ASC", $cond);
            if (\count($_POST) > 0) {



                $programs_advantage_id = $this->_lang['programs_advantage'];
                $this->form_validation->set_rules('programs_advantage_id', "$programs_advantage_id", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['programs_advantage_id'] = \xss_clean($_POST['programs_advantage_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_advantage_all->GetWhere("programs_advantage_all", "id", "ASC", $cond_test);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {

                        $array_data['programs_advantage_id'] = \xss_clean($_POST['programs_advantage_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];
                        $array_data['created_by'] = $this->_login_data['user_id'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_advantage_all->add($array_data);
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_advantage_all/show/$programs_id"));
                    }
                }
            }

            $this->view('admin/programs_advantage_all/form');
        }

        public function edit($id = "", $Programs = ""){



            $programs_advantage_where['branches_id'] = $this->_current_user->branches_id;
            $programs_advantage_where['is_deleted'] = 0;
            $programs_advantage_where['active'] = 1;
            $this->data['programs_advantage'] = $this->programs_advantage_all->GetWhere("programs_advantage", "id", "ASC", $programs_advantage_where);
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_advantage_all->GetWhere("programs", "id", "ASC", $cond);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_advantage_all/show'));
            }

            if (!empty($_POST)) {
                $programs_advantage_id = $this->_lang['programs_advantage'];
                $this->form_validation->set_rules('programs_advantage_id', "$programs_advantage_id", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['programs_advantage_id'] = \xss_clean($_POST['programs_advantage_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_advantage_all->GetWherenotId("programs_advantage_all", "id", "ASC", $cond_test, $id);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {


                        $array_data['programs_advantage_id'] = \xss_clean($_POST['programs_advantage_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_advantage_all->update($array_data, array(
                            'id' => $id
                        ));
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_advantage_all/show/$programs_id"));
                    }
                }
            }

            $edit = $this->programs_advantage_all->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_advantage_all/form");
        }

        public function delete($id = "", $programs_id = ""){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url("admin/programs_advantage_all/show/$programs_id"));
                return false;
            }
            $this->db->where("id", $id);
            $this->db->delete("programs_advantage_all");
            echo 'yes';
        }

        public function status($id = NULL, $programs_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_advantage_all->GetWhere("programs_advantage_all", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_advantage_all->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        function do_upload_images(){
            $table = "programs_advantage_all";
            $folder = "programs_advantage_all";
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

                $this->programs_advantage_all->add($array_data);
            }
            \redirect(\base_url("admin/programs_advantage_all/show/$programs_id"));
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
