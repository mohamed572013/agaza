<?php

    class Groups extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Permissions_model', 'permissions');
        }

        public function index(){
            if ($this->_current_user->user_type == 'owner') {
                $this->data['group_list'] = $this->Groups->GetGroups();
            }

            if ($this->_current_user->user_type == 'super admin') {
                $this->data['group_list'] = $this->Groups->GetGroups(array('branches_id' => $this->current_user_company->id));
            }

            $main_content = 'groups/view';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            if ($this->_current_user->user_type == 'owner') {
                $this->data['group_list'] = $this->Groups->GetGroups();
            }

            if ($this->_current_user->user_type == 'super admin') {
                $this->data['group_list'] = $this->Groups->GetGroups(array('branches_id' => $this->current_user_company->id));
            }

            $main_content = 'groups/view';
            $this->_view($main_content, 'admin');
        }

        public function add(){
            $user_group_id = $this->_current_user->user_group_id;
            $current_user_group = $this->Groups->findById($user_group_id);
            $this->data['m_pages'] = $this->Groups->getPages('main');
            $this->data['pages_data'] = $this->Groups->getPages('sub'); //main pages
            if (\count($this->input->post()) > 0) {

                $array_rules = array(
                    array(
                        'field' => 'group_name',
                        'label' => $this->_lang['group_name'],
                        'rules' => 'required'
                    ),
                );

                $this->form_validation->set_rules($array_rules);


                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {
                    if (!empty($_POST['group_close'])) {
                        $array_data['group_close'] = $_POST['group_close'];
                    }

                    $array_data['group_name'] = $_POST['group_name'];
                    $array_data['branches_id'] = $this->current_user_company->id;
                    $array_data['group_create_by'] = $this->_login_data['user_id'];
                    $array_data['group_options'] = json_encode($_POST['group_options']);
                    //pri($array_data);

                    $this->Groups->add($array_data);
                    \redirect(\base_url('admin/groups/show'));
                }
            }

            $main_content = 'groups/form';
            $this->_view($main_content, 'admin');
        }

        public function edit($id){
            $id = intval($id);
            $group = $this->Groups->findById($id);
            //pri($group);
            if ($id < 0) {
                redirect(base_url('admin/groups/show'));
            }
            $user_group_id = $this->_current_user->user_group_id;
            $current_user_group = $this->Groups->findById($user_group_id);
            $this->data['m_pages'] = $this->Groups->getPages('main');
            $this->data['pages_data'] = $this->Groups->getPages('sub'); //main pages
            if (count($this->input->post())) {
                $array_rules = array(
                    array(
                        'field' => 'group_name',
                        'label' => $this->_lang['group_name'],
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($array_rules);

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {
                    if (!empty($_POST['group_close'])) {
                        $array_data['group_close'] = $_POST['group_close'];
                    }
                    $array_data['group_name'] = $_POST['group_name'];
                    $array_data['branches_id'] = $this->current_user_company->id;
                    $array_data['group_options'] = json_encode($_POST['group_options']);
                    $this->Groups->update($array_data, array(
                        'group_id' => $id
                    ));
                    \redirect(\base_url('admin/groups/show'));
                }
            }
            $edit = $this->Groups->GetGroups(array(
                'group_id' => $id
            ));
            $edit[0]->group_options = json_decode($edit[0]->group_options);
            $this->data['edit'] = $edit[0];
            $main_content = 'groups/form';
            $this->_view($main_content, 'admin');
        }

        public function delete($id){
            $id = intval($id);
            if ($id < 0) {
                redirect(base_url('admin/groups/show'));
                return false;
            }
            $sql = " SELECT * FROM users  WHERE   user_group_id = $id  ";
            $query = $this->db->query($sql);
            $result = $query->result();
            if (count($result) < 1) {
                $this->Groups->update(array(
                    'group_is_delete' => '1',
                    'group_deleted_by' => $this->_login_data['user_id']
                        ), array(
                    'group_id' => $id
                ));
            }
            redirect(base_url('admin/groups/show'));
            return false;
        }

    }
