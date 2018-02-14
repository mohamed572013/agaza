<?php

    class Employees extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->CheckAccess('employees_controll', 'open', true);
            $this->load->model('Employees_model', 'employees');
            $this->load->model('Users_model', 'Users');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->employees->find($id);

            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('e_title_ar', 'الاسم بالعربية', 'required');
            $this->form_validation->set_rules('e_title_en', 'الاسم بالإنجليزية', 'required');
            $this->form_validation->set_rules('gender', 'النوع', 'required');
            $this->form_validation->set_rules('job_title', 'الوظيفة', 'required');
            $this->form_validation->set_rules('e_email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('password', 'كلمة السر', 'required');
            $this->form_validation->set_rules('e_address', 'العنوان', 'required');
            $this->form_validation->set_rules('start_working_date', 'تاريخ بدء العمل', 'required');
            $this->form_validation->set_rules('emergency_phone_1', 'رقم طوارئ اول', 'required');
            $this->form_validation->set_rules('emergency_name_1', 'الاسم', 'required');
            $this->form_validation->set_rules('emergency_phone_2', 'رقم طوارئ ثانى', 'required');
            $this->form_validation->set_rules('emergency_name_2', 'الاسم', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['e_title_ar']);
                $data_array['title_en'] = xss_clean($_POST['e_title_en']);
                $data_array['gender'] = xss_clean($_POST['gender']);
                $data_array['job_title'] = xss_clean($_POST['job_title']);
                $data_array['email'] = xss_clean($_POST['e_email']);
                $data_array['password'] = md5($_POST['password']);
                $data_array['address'] = xss_clean($_POST['e_address']);
                $data_array['start_working_date'] = xss_clean($_POST['start_working_date']);
                $data_array['emergency_phone_1'] = xss_clean($_POST['emergency_phone_1']);
                $data_array['emergency_name_1'] = xss_clean($_POST['emergency_name_1']);
                $data_array['emergency_phone_2'] = xss_clean($_POST['emergency_phone_2']);
                $data_array['emergency_name_2'] = xss_clean($_POST['emergency_name_2']);
                //$data_array['active'] = $_POST['e_active'];
                $data_array['branches_id'] = $_POST['branches_id'];
                $data_array['departments_id'] = $_POST['departments_id'];
                $data_array['whitelabel_id'] = $this->whitelabel_id;
                $data_array['created_by'] = $this->_current_user->user_id;
                $array_data['employee_type'] = 'reservation';
                //pri($data_array);
                $add = $this->employees->add($data_array);
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
            $this->load->library('form_validation');
            $this->form_validation->set_rules('e_title_ar', 'الاسم بالعربية', 'required');
            $this->form_validation->set_rules('e_title_en', 'الاسم بالإنجليزية', 'required');
            $this->form_validation->set_rules('gender', 'النوع', 'required');
            $this->form_validation->set_rules('job_title', 'الوظيفة', 'required');
            $this->form_validation->set_rules('e_email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('e_address', 'العنوان', 'required');
            $this->form_validation->set_rules('start_working_date', 'تاريخ بدء العمل', 'required');
            $this->form_validation->set_rules('emergency_phone_1', 'رقم طوارئ اول', 'required');
            $this->form_validation->set_rules('emergency_name_1', 'الاسم', 'required');
            $this->form_validation->set_rules('emergency_phone_2', 'رقم طوارئ ثانى', 'required');
            $this->form_validation->set_rules('emergency_name_2', 'الاسم', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['e_title_ar']);
                $data_array['title_en'] = xss_clean($_POST['e_title_en']);
                $data_array['gender'] = xss_clean($_POST['gender']);
                $data_array['job_title'] = xss_clean($_POST['job_title']);
                $data_array['email'] = xss_clean($_POST['e_email']);
                if (!empty($_POST['password'])) {
                    $data_array['password'] = md5($_POST['password']);
                }
                $data_array['address'] = xss_clean($_POST['e_address']);
                $data_array['start_working_date'] = xss_clean($_POST['start_working_date']);
                $data_array['emergency_phone_1'] = xss_clean($_POST['emergency_phone_1']);
                $data_array['emergency_name_1'] = xss_clean($_POST['emergency_name_1']);
                $data_array['emergency_phone_2'] = xss_clean($_POST['emergency_phone_2']);
                $data_array['emergency_name_2'] = xss_clean($_POST['emergency_name_2']);
                $data_array['active'] = $_POST['e_active'];
                $where_array['id'] = $id;
                //pri($where_array);
                $update = $this->employees->update($data_array, $where_array);
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
            $deleted = $this->employees->delete($where_array);
            if ($deleted) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){
            $company_id = $_GET['company_id'];
            $branch_id = $_GET['branch_id'];
            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,title_en,email,active")
                    ->from("employees");
            $this->datatables->where("branches_id", $company_id);
            $this->datatables->where("departments_id", $branch_id);
            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('departments', function($data) {

                $back = '<a href="#" title="' . _lang("departments") . '" class="data-box tooltips"  data-type="branches"  data-id="' . $data["id"] . '">' . _lang('departments') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" data-type="branches" onclick="Companies.edit_employees(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Companies.delete_employees(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
