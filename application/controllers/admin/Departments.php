<?php

    class Departments extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->CheckAccess('departments_controll', 'open', true);
            $this->load->model('Departments_model', 'departments');
            $this->load->model('Users_model', 'Users');
        }

        public function show($branches = ""){
            $cond = array();
            if ($branches != null) {
                //pri('here');
                $cond['branches_id'] = \xss_clean($branches);
                $this->data['page_list'] = $this->departments->GetWhere("departments", "id", "ASC", $cond);
            } else {
                $user_type = $this->_current_user->user_type;
                $company_id = $this->current_user_company->id;
                if ($user_type == 'owner') {
                    $this->data['page_list'] = $this->getAllBranchesForOneCompany($company_id, true);
                }
                if ($user_type == 'super admin') {
                    $this->data['page_list'] = $this->getAllBranchesForOneCompany($company_id);
                }
                //admin can't see branches
                if ($user_type == 'admin') {

                }
            }

            $this->view('admin/departments/view');
        }

        public function index($branches = ""){
            $cond = array();
            if ($branches != null) {
                //pri('here');
                $cond['branches_id'] = \xss_clean($branches);
                $this->data['page_list'] = $this->departments->GetWhere("departments", "id", "ASC", $cond);
            } else {
                $user_type = $this->_current_user->user_type;
                $company_id = $this->current_user_company->id;
                if ($user_type == 'owner') {
                    $this->data['page_list'] = $this->getAllBranchesForOneCompany($company_id, true);
                }
                if ($user_type == 'super admin') {
                    $this->data['page_list'] = $this->getAllBranchesForOneCompany($company_id);
                }
                //admin can't see branches
                if ($user_type == 'admin') {

                }
            }

            $this->view('admin/departments/view');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->departments->find($id);

            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('d_title_ar', 'العنوان', 'required');
            $this->form_validation->set_rules('d_title_en', 'العنوان', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['d_title_ar']);
                $data_array['title_en'] = xss_clean($_POST['d_title_en']);
                $data_array['active'] = $_POST['d_active'];
                $data_array['branches_id'] = ($_POST['branches_id'] == 0) ? $this->current_user_company->id : $_POST['branches_id'];
                $data_array['created_by'] = $this->_current_user->user_id;
                //pri($data_array);
                $add = $this->departments->add($data_array);
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
            $this->form_validation->set_rules('d_title_ar', 'العنوان', 'required');
            $this->form_validation->set_rules('d_title_en', 'العنوان', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['d_title_ar']);
                $data_array['title_en'] = xss_clean($_POST['d_title_en']);
                $data_array['active'] = $_POST['d_active'];
                $where_array['id'] = $id;
                //pri($where_array);
                $update = $this->departments->update($data_array, $where_array);
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
            $deleted = $this->departments->delete($where_array);
            if ($deleted) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){
            $company_id = $_GET['company_id'];
            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,title_en,active,branches_id")
                    ->from("departments");
            $this->datatables->where("branches_id", $company_id);
            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('employees', function($data) {

                $back = '<a href="#" title="' . _lang("employees") . '" class="data-box tooltips" data-type="employees"  data-departments-id="' . $data["id"] . '" data-branches-id="' . $data["branches_id"] . '">' . _lang('employees') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" data-type="branches" onclick="Companies.edit_branches(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Companies.delete_branches(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function status($id = NULL, $branches_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->departments->GetWhere("departments", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->departments->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

        public function getAllBranchesForOneCompany($company_id, $owner = false){

            $find = $this->departments->getAllBranchesForOneCompany($company_id, $owner);
            $new_array = array();
            foreach ($find as $value) {
                $company_name = $this->departments->getCurrentCompany($value->branches_id);
                $value->company_name = $company_name->title_ar;
                $new_array[] = $value;
            }
            return $new_array;
        }

    }
