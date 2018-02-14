<?php

    class Branches extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->CheckAccess('branches_controll', 'open', true);
            $this->load->model('Branches_model', 'branches');
            $this->load->model('Departments_model', 'departments');
            $this->load->model('Branches_settings_model', 'branches_settings');
            $this->load->model('About_us_model', 'about_us');
            $this->load->model('Advertismnent_model', 'advertismnent');            
            $this->load->model('Pay_ways_model', 'pay_ways');
            $this->load->model('Discount_type_model', 'discount_type');
        }

        public function show2(){
            $user_type = $this->_current_user->user_type;
            $company_id = $this->current_user_company->id;
            if ($user_type == 'owner') {
                $cond['branches.is_deleted'] = 0;
            }
            if ($user_type == 'super admin') {
                $cond['branches.parent_id'] = $company_id;
                $cond['branches.is_deleted'] = 0;
            }
            $this->data['page_list'] = $this->branches->GetAllBranchesDetails($cond);
            $this->view('admin/branches/view');
        }

        public function show(){
            $this->data['pay_ways'] = $this->pay_ways->getAll();
            $this->data['discount_types'] = $this->discount_type->getAll();
            $this->data['user_type'] = $this->_current_user->user_type;
            $main_content = 'branches/index';
            $this->_view($main_content, 'admin');
        }

        public function index(){
            $this->data['pay_ways'] = $this->pay_ways->getAll();
            $this->data['discount_types'] = $this->discount_type->getAll();
            $this->data['user_type'] = $this->_current_user->user_type;
            $main_content = 'branches/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->branches->find($id);

            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية", 'required');
            $this->form_validation->set_rules('code', "الكود", 'required');

            $this->form_validation->set_rules('email', "البريد الإلكترونى", 'required|valid_email');
            $this->form_validation->set_rules('phone', "الموبايل", 'required');
            $this->form_validation->set_rules('address', "العنوان", 'required');
            if ($this->_current_user->user_type == 'owner') {
                $this->form_validation->set_rules('site_url', "رابط الموقع", 'required');
            }
            if ($this->_current_user->user_type == 'super admin') {
                $this->form_validation->set_rules('pay_ways_id', "طريقة الدفع", 'required');
                $this->form_validation->set_rules('pay_way_value', "القيمة", 'required');
                $this->form_validation->set_rules('discount_types_id', "نوع الخصم", 'required');
                $this->form_validation->set_rules('discount_value', "القيمة", 'required');
            }
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                $array_data['title_en'] = \xss_clean($_POST['title_en']);
                $array_data['code'] = \xss_clean($_POST['code']);
                $array_data['email'] = $_POST['email'];
                $array_data['phone'] = $_POST['phone'];
                $array_data['address'] = $_POST['address'];
                $array_data['created_by'] = $this->_login_data['user_id'];
                $array_data['active'] = $_POST['active'];
                $array_data['parent_id'] = $this->current_user_company->id;
                if ($this->_current_user->user_type == 'owner') {
                    $array_data['site_url'] = $_POST['site_url'];
                }
                if ($this->_current_user->user_type == 'super admin') {
                    $array_data['pay_ways_id'] = $_POST['pay_ways_id'];
                    $array_data['pay_way_value'] = $_POST['pay_way_value'];
                    $array_data['discount_types_id'] = $_POST['discount_types_id'];
                    $array_data['discount_value'] = $_POST['discount_value'];
                }
                //pri($array_data);
                $last_inserted_id = $this->branches->add($array_data);
                if ($last_inserted_id) {
                    if ($this->_current_user->user_type == 'owner') {
                        //insert new row in branches_settings table for new company added
                        $branches_settings_data['branches_id'] = $last_inserted_id;
                        $this->branches_settings->add($branches_settings_data);
                        $about_us_data['branches_id'] = $last_inserted_id;
                        $this->about_us->add($about_us_data);
                        $this->advertismnent->add($about_us_data);
                        
                    }
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
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية", 'required');
            $this->form_validation->set_rules('code', "الكود", 'required');

            $this->form_validation->set_rules('email', "البريد الإلكترونى", 'required|valid_email');
            $this->form_validation->set_rules('phone', "الموبايل", 'required');
            $this->form_validation->set_rules('address', "العنوان", 'required');
            if ($this->_current_user->user_type == 'owner') {
                $this->form_validation->set_rules('site_url', "رابط الموقع", 'required');
            }
            if ($this->_current_user->user_type == 'super admin') {
                $this->form_validation->set_rules('pay_ways_id', "طريقة الدفع", 'required');
                $this->form_validation->set_rules('pay_way_value', "القيمة", 'required');
                $this->form_validation->set_rules('discount_types_id', "نوع الخصم", 'required');
                $this->form_validation->set_rules('discount_value', "القيمة", 'required');
            }
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $array_data['title_ar'] = \xss_clean($_POST['title_ar']);
                $array_data['title_en'] = \xss_clean($_POST['title_en']);
                $array_data['code'] = \xss_clean($_POST['code']);
                $array_data['email'] = $_POST['email'];
                $array_data['phone'] = $_POST['phone'];
                $array_data['address'] = $_POST['address'];
                $array_data['created_by'] = $this->_login_data['user_id'];
                $array_data['active'] = $_POST['active'];
                $array_data['parent_id'] = $this->current_user_company->id;
                if ($this->_current_user->user_type == 'owner') {
                    $array_data['site_url'] = $_POST['site_url'];
                }
                if ($this->_current_user->user_type == 'super admin') {
                    $array_data['pay_ways_id'] = $_POST['pay_ways_id'];
                    $array_data['pay_way_value'] = $_POST['pay_way_value'];
                    $array_data['discount_types_id'] = $_POST['discount_types_id'];
                    $array_data['discount_value'] = $_POST['discount_value'];
                }
                $where_array['id'] = $id;
                //pri($where_array);
                $update = $this->branches->update($array_data, $where_array);
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
            $deleted = $this->branches->delete($where_array);
            if ($deleted) {
                $this->departments->delete(array('branches_id' => $id));
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){
            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,title_en,code,active,parent_id")
                    ->from("branches");
            $this->datatables->where("parent_id", $this->current_user_company->id);
            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('departments', function($data) {

                $back = '<a href="#" title="' . _lang("departments") . '" class="data-box tooltips"  data-type="branches"  data-id="' . $data["id"] . '">' . _lang('departments') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" data-type="branches" onclick="Companies.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Companies.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
