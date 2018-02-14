<?php

    class Brands extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Brands_model', 'brands');
        }

        public function index(){            
            $main_content = 'brands/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){            
            $main_content = 'brands/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $id = $_POST['id'];
            $find = $this->brands->find($id);

            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $titles = array(
                'title_ar' => xss_clean($_POST['title_ar']),
                
            );
            $this->titles_check($titles);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
           
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['title_ar']);
                
                $data_array['branches_id'] = $this->current_user_company->id;
                //pri($data_array);
                $add = $this->brands->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        public function edit(){
            //pri($_POST);
            $id = $_POST['id'];
            $titles = array(
                'title_ar' => \xss_clean($_POST['title_ar']),
               
            );
            $this->titles_check($titles, $id);

            //pri('here');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
        
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['title_ar']);
               
               
                $where_array['id'] = $id;
                //pri($data_array);
                $update = $this->brands->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            $id = $_POST['id'];
            $where_array['id'] = $id;
            $deleted = $this->brands->delete($where_array);
            if ($deleted) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar"
                    )
                    //->where("user_type","admin")
                    ->from("brands")
                    ->where("branches_id", $this->current_user_company->id);

           
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Brands.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Brands.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function titles_check($titles = array(), $id = false){
            $errors = array();
            foreach ($titles as $key => $title) {
                $where_array = array(
                    'branches_id' => $this->current_user_company->id,
                    $key => $title
                );
                if ($id) {
                    $where_array['id !='] = $id;
                }
                $where_array[$key] = $title;
                $find = $this->brands->findTitle($where_array);
                //pri($find);
                if ($find) {
                    $errors[$key] = _lang('added_before');
                }
            }
            if (!empty($errors)) {
                print_json('error', $errors);
            }
            return true;
        }

    }
