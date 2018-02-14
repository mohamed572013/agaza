<?php

    class Programs_seasons extends C_Controller{
        public function __construct(){
            parent::__construct();
//			$this->CheckLogin(true);
//			$this->CheckAccess('programs_seasons', 'open', true);
            $this->load->model('Programs_seasons_model', 'programs_seasons');
        }

        public function show($pag_index = 0){

            $cond['is_deleted'] = 0;
            $this->load->library('pagination');

            $config['base_url'] = base_url("admin/programs_seasons/show");
            $config['total_rows'] = $this->programs_seasons->GetCountWhere("programs_seasons", "id", "ASC", $cond);
            $config['per_page'] = 200;
            $config['next_link'] = $this->_lang['next'];
            $config['prev_link'] = $this->_lang['prev'];
            $config['first_link'] = $this->_lang['First'];
            $config['last_link'] = $this->_lang['Last'];
            $config['uri_segment'] = 4;



            $this->pagination->initialize($config);
            $this->data['links'] = $this->pagination->create_links();

            $this->data['page_list'] = $this->programs_seasons->GetWherePaging("programs_seasons", "id", "ASC", $cond, $pag_index, $config['per_page']);
            $this->view('admin/programs_seasons/view');
        }

        public function add(){


            if (\count($_POST) > 0) {


                $title_ar = $this->_lang['title_ar'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required|is_unique[programs_seasons.title_ar]');

                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $array_data['created_by'] = $this->_login_data['user_id'];

                    $this->programs_seasons->add($array_data);
                    \redirect(\base_url("admin/programs_seasons/show"));
                }
            }

            $this->view('admin/programs_seasons/form');
        }

        public function edit($id = ""){




            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_seasons/show'));
            }

            if (!empty($_POST)) {
                $title_ar = $this->_lang['title_ar'];
                $this->form_validation->set_rules('title_ar', "$title_ar", 'required|is_unique[programs_seasons.title_ar.id.' . $id . ']');

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {

                    $array_data['active'] = \xss_clean($_POST['active']);
                    $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                    $this->programs_seasons->update($array_data, array(
                        'id' => $id
                    ));

                    \redirect(\base_url("admin/programs_seasons/show"));
                }
            }

            $edit = $this->programs_seasons->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_seasons/form");
        }

        public function delete($id = ""){
            $cond['programs_seasons'] = $id;
            $test = $this->programs_seasons->GetWhere("programs", "id", "ASC", $cond);
            if (\count($test) > 0 && $test[0]->id > 0) {
                echo "no";
            } else {
                $this->db->where("id", $id);
                $this->db->delete("programs_seasons");
                echo "yes";
            }
        }

        public function status($id = NULL){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_seasons->GetWhere("programs_seasons", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_seasons->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

    }
