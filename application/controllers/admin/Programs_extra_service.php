<?php

    class Programs_extra_service extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_extra_service_model', 'programs_extra_service');
        }

        public function show($Programs = ""){
            $cond_pro['id'] = $Programs;
            $this->data['Programs'] = $this->programs_extra_service->GetWhere("programs", "id", "ASC", $cond_pro);


            $this->data['page_list'] = $this->programs_extra_service->GetallProgramExtra_service($Programs);
            $this->view('admin/programs_extra_service/view');
        }

        public function add($Programs = ""){
            $Programs = \xss_clean($Programs);


            $programs_extra_service_where['branches_id'] = $this->_current_user->branches_id;
            $programs_extra_service_where['is_deleted'] = 0;
            $programs_extra_service_where['active'] = 1;
            $this->data['extra_services'] = $this->programs_extra_service->GetWhere("extra_services", "id", "ASC", $programs_extra_service_where);
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_extra_service->GetWhere("programs", "id", "ASC", $cond);
            if (\count($_POST) > 0) {



                $extra_service_id = $this->_lang['extra_services'];
                $this->form_validation->set_rules('extra_service_id', "$extra_service_id", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                $this->form_validation->set_rules('price', "السعر", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['extra_service_id'] = \xss_clean($_POST['extra_service_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_extra_service->GetWhere("programs_extra_service", "id", "ASC", $cond_test);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {

                        $array_data['extra_service_id'] = \xss_clean($_POST['extra_service_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];
                        $array_data['price'] = $_POST['price'];
                        $array_data['created_by'] = $this->_login_data['user_id'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_extra_service->add($array_data);
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_extra_service/show/$programs_id"));
                    }
                }
            }

            $this->view('admin/programs_extra_service/form');
        }

        public function edit($id = "", $Programs = ""){



            $cond['active'] = 1;
            $this->data['extra_services'] = $this->programs_extra_service->GetWhere("extra_services", "id", "ASC", $cond);
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_extra_service->GetWhere("programs", "id", "ASC", $cond);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_extra_service/show'));
            }

            if (!empty($_POST)) {
                $extra_service_id = $this->_lang['extra_services'];
                $this->form_validation->set_rules('extra_service_id', "$extra_service_id", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                $this->form_validation->set_rules('price', "السعر", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['extra_service_id'] = \xss_clean($_POST['extra_service_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_extra_service->GetWherenotId("programs_extra_service", "id", "ASC", $cond_test, $id);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {


                        $array_data['extra_service_id'] = \xss_clean($_POST['extra_service_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];
                        $array_data['price'] = $_POST['price'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_extra_service->update($array_data, array(
                            'id' => $id
                        ));
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_extra_service/show/$programs_id"));
                    }
                }
            }

            $edit = $this->programs_extra_service->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_extra_service/form");
        }

        public function delete($id = "", $programs_id = ""){

            $id = \intval($id);
            $cond['id'] = $id;
            $programs_extra_service = $this->programs_extra_service->GetWhere("programs_extra_service", "id", "ASC", $cond);
            $cond_2['extra_services_id'] = $programs_extra_service[0]->extra_service_id;
            $test_2 = $this->programs_extra_service->GetWhere("reservation_extra_services", "id", "ASC", $cond_2);
            if (count($test_2) > 0 && $test_2[0]->id > 0) {
                echo 'no';
            } else {
                $this->db->where("id", $id);
                $this->db->delete("programs_extra_service");
                echo 'yes';
            }
        }

        public function status($id = NULL, $programs_id = ""){
            $permission = $this->CheckAccessStatusDelete('programs', 'edit', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {


                if ($id):
                    $cond['id'] = $id;
                    $all_data = $this->programs_extra_service->GetWhere("programs_extra_service", "id", "ASC", $cond);

                    $this->data['all_data'] = $all_data[0];
                else:
                endif;

                if ($this->data['all_data']->active == 1) {
                    $array_data['active'] = 0;
                } else {
                    $array_data['active'] = 1;
                }
                if (isset($id)) {
                    $this->programs_extra_service->update($array_data, array(
                        'id' => $id
                    ));
                    echo 'yes';
                }
//			\redirect(\base_url("admin/programs_extra_service/show/$programs_id"));
            }
        }

        function do_upload_images(){
            $table = "programs_extra_service";
            $folder = "programs_extra_service";
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

                $this->programs_extra_service->add($array_data);
            }
            \redirect(\base_url("admin/programs_extra_service/show/$programs_id"));
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
