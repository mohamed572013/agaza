<?php

    class Visa_periods extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Visa_periods_model', 'visa_periods');
        }

        public function index(){
            $main_content = 'visa_periods/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'visa_periods/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $id = $_POST['id'];
            $find = $this->visa_periods->find($id);

            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $where_array['period'] = xss_clean($_POST['period']);
            $find = $this->visa_periods->findWhere($where_array);
            if ($find) {
                $errors['period'] = _lang('added_before');
                print_json('error', $errors);
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('period', 'عدد الشهور', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['period'] = xss_clean($_POST['period']);
                $data_array['active'] = $_POST['active'];
                $data_array['branches_id'] = $this->current_user_company->id;
                $data_array['created_by'] = $this->_current_user->user_id;
                //pri($data_array);
                $add = $this->visa_periods->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        public function edit(){
            $id = $_POST['id'];
            $where_array['id !='] = $id;
            $where_array['period'] = xss_clean($_POST['period']);
            $find = $this->visa_periods->findWhere($where_array);
            if ($find) {
                $errors['period'] = _lang('added_before');
                print_json('error', $errors);
            }

            //pri('here');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('period', 'عدد الشهور', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['period'] = xss_clean($_POST['period']);
                $data_array['active'] = $_POST['active'];
                $update_where_array['id'] = $id;
                //pri($where_array);
                $update = $this->visa_periods->update($data_array, $update_where_array);
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
            $deleted = $this->visa_periods->delete($where_array);
            if ($deleted) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    //->where("user_type","admin")
                    ->from("visa_periods")
                    ->where("branches_id", $this->current_user_company->id);

            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit_room_classes") . '" class="tooltips" onclick="Visa_periods.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("remove_room_classes") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Visa_periods.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function titles_check($titles = array(), $id = false){

        }

    }
