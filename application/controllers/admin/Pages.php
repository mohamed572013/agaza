<?php

    class Pages extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
//			$this->CheckAccess('pages_controll', 'open', true);
            $this->load->model('Pages_model', 'pages');
        }

        public function show(){

            $cond = array();

            $this->data['page_list'] = $this->pages->GetWhere("pages", "id", "ASC", $cond);
            $this->view('admin/pages/view');
        }

        public function add(){


//			$this->CheckAccess('pages_controll', 'add', true);
            $cond_parent['parent_id'] = 0;
            $this->data['main_menu'] = $this->pages->GetWhere("pages", "id", "ASC", $cond_parent);
            if (\count($_POST) > 0) {



                $this->form_validation->set_rules('name', "name", 'required|is_unique[pages.name]');
                $this->form_validation->set_rules('controller', "controller", 'required|is_unique[pages.controller]');


                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {

                    $array_data['name'] = \xss_clean($_POST['name']);
                    $array_data['controller'] = \xss_clean($_POST['controller']);
                    $array_data['parent_id'] = \xss_clean($_POST['parent_id']);
                    $array_data['this_order'] = \xss_clean($_POST['this_order']);
                    $array_data['created_by'] = $this->_login_data['user_id'];

                    $this->pages->add($array_data);
                    \redirect(\base_url("admin/pages/show"));
                }
            }

            $this->view('admin/pages/form');
        }

        public function edit($id = ""){


//			$this->CheckAccess('pages_controll', 'edit', true);
            $cond['pages_id'] = \xss_clean($id);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/pages/show'));
            }

            $cond_parent['parent_id'] = 0;
            $this->data['main_menu'] = $this->pages->GetWhere("pages", "id", "ASC", $cond_parent);


            if (!empty($_POST)) {
                $this->form_validation->set_rules('name', "name", 'required|is_unique[pages.name.id.' . $id . ']');
                $this->form_validation->set_rules('controller', "controller", 'required|is_unique[pages.controller.id.' . $id . ']');


                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $array_data['name'] = \xss_clean($_POST['name']);
                    $array_data['controller'] = \xss_clean($_POST['controller']);
                    $array_data['parent_id'] = \xss_clean($_POST['parent_id']);
                    $array_data['this_order'] = \xss_clean($_POST['this_order']);

                    $this->pages->update($array_data, array(
                        'id' => $id
                    ));

                    \redirect(\base_url("admin/pages/show"));
                }
            }

            $edit = $this->pages->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/pages/form");
        }

    }
