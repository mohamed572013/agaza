<?php

    class Users extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Users_model', 'Users');
            $this->load->model('Groups_model', 'groups');
            $this->load->model('Departments_model', 'departments');
        }

        public function index(){
            if ($this->_current_user->user_type == 'owner') {
                $company_id = false;
            }
            if ($this->_current_user->user_type == 'super admin') {
                $company_id = $this->current_user_company->id;
            }

            //pri($company_id);
            $this->data['user_list'] = $this->Users->GetUsers2($company_id);

            $main_content = 'users/view';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            if ($this->_current_user->user_type == 'owner') {
                $company_id = false;
            }
            if ($this->_current_user->user_type == 'super admin') {
                $company_id = $this->current_user_company->id;
            }

            //pri($company_id);
            $this->data['user_list'] = $this->Users->GetUsers2($company_id);

            $main_content = 'users/view';
            $this->_view($main_content, 'admin');
        }

        public function add(){
            //pri($_POST);
            //show all companies except master vission and all branches
            if ($this->_current_user->user_type == 'owner') {
                $cond_branches['parent_id !='] = 0;
                $cond_departments['branches_id'] = $this->current_user_company->id;
                $this->data['group_list'] = $this->Groups->GetGroups();
            }
            //show all companies and all branches of current user company
            if ($this->_current_user->user_type == 'super admin') {
                $cond_branches['parent_id'] = $this->current_user_company->id;
                $cond_departments['branches_id'] = $this->current_user_company->id;
                $this->data['group_list'] = $this->Groups->GetGroups(array('branches_id' => $this->current_user_company->id));
            }
            $cond_branches['is_deleted'] = 0;
            $cond_branches['active'] = 1;
            $this->data['branches'] = $this->Users->GetWhere("branches", "id", "ASC", $cond_branches);

            $cond_departments['is_deleted'] = 0;
            $cond_departments['active'] = 1;
            $this->data['departments'] = $this->Users->GetWhere("departments", "id", "ASC", $cond_departments);



            if (\count($_POST) > 0) {

                $array_rules = array(
                    array('field' => 'user_name', 'label' => $this->_lang['user_name'], 'rules' => 'required|is_unique[users.user_name]|trim'),
                    array('field' => 'user_email', 'label' => $this->_lang['user_email'], 'rules' => 'required|valid_email'),
                    array('field' => 'user_phone', 'label' => $this->_lang['user_phone'], 'rules' => 'required'),
                    array('field' => 'confirm_password', 'label' => $this->lang->line("confirm_password"), 'rules' => 'required|trim|min_length[6]'),
                    array('field' => 'user_password', 'label' => $this->lang->line("user_password"), 'rules' => 'required|trim|matches[confirm_password]|min_length[6]'),
                );
                if ($this->_current_user->user_type == 'super admin') {
                    $array_rules[] = array('field' => 'user_group_id', 'label' => _lang('user_group_id'), 'rules' => 'required');
                }
                if ($_POST['add_to'] == 'other') {
                    $array_rules[] = array('field' => 'branches_id', 'label' => _lang('branches'), 'rules' => 'required');
                }
                $this->form_validation->set_rules($array_rules);

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {
                    //$array_data['admin_or_reservarion'] = \xss_clean($_POST['admin_or_reservarion']);
                    $array_data['user_name'] = \xss_clean($_POST['user_name']);

                    $array_data['user_email'] = \xss_clean($_POST['user_email']);
                    $array_data['user_phone'] = \xss_clean($_POST['user_phone']);
                    $array_data['user_full_address'] = \xss_clean($_POST['user_full_address']);
                    $array_data['user_password'] = \md5($_POST['user_password']);
                    $array_data['user_create_by'] = $this->_login_data['user_id'];
                    $array_data['user_group_id'] = xss_clean($_POST['user_group_id']);
                    $array_data['departments_id'] = xss_clean($_POST['departments_id']);
                    //adding users to master vission
                    if ($this->_current_user->user_type == 'owner' && empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['user_type'] = 'owner';
                        //$_POST['departments_id'] = '';
                    }
                    //adding users as super admin
                    if ($this->_current_user->user_type == 'owner' && !empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $_POST['branches_id'];
                        $array_data['branches_id'] = $_POST['branches_id'];
                        $array_data['user_type'] = 'super admin';
                    }
                    //adding users as admin but for companies under white labels(super admin)
                    if ($this->_current_user->user_type == 'super admin' && !empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $_POST['branches_id'];
                        $array_data['user_type'] = 'admin';
                    }
                    //adding users as admin but for branches under white labels(super admin)
                    if ($this->_current_user->user_type == 'super admin' && empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['user_type'] = 'super admin';
                    }
                    if ($this->_current_user->user_type == 'owner' && empty($_POST['user_group_id'])) {
                        $user_group = $this->groups->add(array(
                            'group_name' => 'super admin',
                            'branches_id' => $_POST['branches_id'],
                            'group_create_by' => $this->_current_user->user_id,
                        ));
                        $array_data['user_group_id'] = $user_group;
                    }
                    $add_users = $this->Users->add($array_data);

                    \redirect(\base_url('admin/users/show'));
                }
            }


            $main_content = 'users/form';
            $this->_view($main_content, 'admin');
        }

        public function edit($id){
            $user = $this->Users->find($id);
            //show all companies except master vission and all branches
            if ($this->_current_user->user_type == 'owner') {
                $cond_branches['parent_id !='] = 0;
                $cond_departments['branches_id'] = $user->branches_id;
                $this->data['group_list'] = $this->Groups->GetGroups();
            }
            //show all companies and all branches of current user company
            if ($this->_current_user->user_type == 'super admin') {

                $cond_branches['parent_id'] = $this->current_user_company->id;
                $cond_departments['branches_id'] = $user->branches_id;
                $this->data['group_list'] = $this->Groups->GetGroups(array('branches_id' => $this->current_user_company->id));
            }

            $cond_branches['is_deleted'] = 0;
            $cond_branches['active'] = 1;
            $this->data['branches'] = $this->Users->GetWhere("branches", "id", "ASC", $cond_branches);

            $cond_departments['is_deleted'] = 0;
            $cond_departments['active'] = 1;
            $this->data['departments'] = $this->Users->GetWhere("departments", "id", "ASC", $cond_departments);


            $id = \intval($id);

            //pri($user);
            if ($id < 0) {
                \redirect(\base_url('admin/users/show'));
            }

            if (\count($_POST) > 0) {
                $array_rules = array(
                    array('field' => 'user_name', 'label' => $this->_lang['user_name'], 'rules' => 'required|is_unique[users.user_name.user_id.' . $id . ']|trim'),
                    array('field' => 'user_email', 'label' => $this->_lang['user_email'], 'rules' => 'required|valid_email'),
                    array('field' => 'user_phone', 'label' => $this->_lang['user_phone'], 'rules' => 'required'),
                );
                if ($this->_current_user->user_type == 'super admin') {
                    $array_rules[] = array('field' => 'user_group_id', 'label' => _lang('user_group_id'), 'rules' => 'required');
                }
                if (!empty($_POST['user_password'])) {
                    $this->form_validation->set_rules('user_password', $this->lang->line('user_password'), 'required');
                    $this->form_validation->set_rules('confirm_password', $this->lang->line('confirm_password'), 'required');
                }
                if ($_POST['add_to'] == 'other') {
                    $array_rules[] = array('field' => 'branches_id', 'label' => _lang('branches'), 'rules' => 'required');
                }
                $this->form_validation->set_rules($array_rules);
                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {
                    $array_data['user_name'] = \xss_clean($_POST['user_name']);
                    $array_data['user_email'] = \xss_clean($_POST['user_email']);
                    $array_data['user_phone'] = \xss_clean($_POST['user_phone']);
                    $array_data['user_full_address'] = \xss_clean($_POST['user_full_address']);
                    $array_data['user_group_id'] = xss_clean($_POST['user_group_id']);
                    $array_data['departments_id'] = xss_clean($_POST['departments_id']);
                    if (!empty($_POST['user_password'])) {
                        $array_data['user_password'] = \md5($_POST['user_password']);
                    }
                    $array_data['user_create_by'] = $this->_login_data['user_id'];
                    //adding users to master vission
                    if ($this->_current_user->user_type == 'owner' && empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['user_type'] = 'owner';
                        //$_POST['departments_id'] = '';
                    }
                    //adding users as super admin
                    if ($this->_current_user->user_type == 'owner' && !empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $_POST['branches_id'];
                        $array_data['branches_id'] = $_POST['branches_id'];
                        $array_data['user_type'] = 'super admin';
                    }
                    //adding users as admin but for companies under white labels(super admin)
                    if ($this->_current_user->user_type == 'super admin' && !empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $_POST['branches_id'];
                        $array_data['user_type'] = 'admin';
                    }
                    //adding users as admin but for branches under white labels(super admin)
                    if ($this->_current_user->user_type == 'super admin' && empty($_POST['branches_id'])) {
                        $array_data['whitelabel_id'] = $this->current_user_company->id;
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['user_type'] = 'super admin';
                    }
                    if ($this->_current_user->user_type == 'owner' && empty($_POST['user_group_id'])) {
                        $user_group = $this->groups->add(array(
                            'group_name' => 'super admin',
                            'branches_id' => $_POST['branches_id'],
                            'group_create_by' => $this->_current_user->user_id,
                        ));
                        $array_data['user_group_id'] = $user_group;
                    }
                    //pri($array_data);
                    $this->Users->update($array_data, array(
                        'user_id' => $id
                    ));
                    \redirect(\base_url('admin/users/show'));
                }
            }
            if ($this->_current_user->user_type == 'owner') {
                $edit = $this->Users->GetUser($id);
            }
            if ($this->_current_user->user_type == 'super admin') {
                $edit = $this->Users->GetUser($id, true);
            }

            if (count($edit) > 0) {
                $this->data['edit'] = $edit;
            } else {
                $this->data['error'] = $this->_lang['error_404'];
            }

            //pri($edit);
            $main_content = 'users/form';
            $this->_view($main_content, 'admin');
        }

        public function delete($id){

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/users/show'));
                return false;
            }
            $this->Users->update(array(
                'user_is_delete' => '1',
                'user_deleted_by' => $this->_login_data['user_id']
                    ), array(
                'user_id' => $id
            ));
            \redirect(\base_url('admin/users/show'));
            return false;
        }

        public function getBranches(){
            $company_id = $_POST['company_id'];
            $find = $this->Users->getCompanyBranches($company_id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', _lang('no branches'));
            }
        }

    }
    