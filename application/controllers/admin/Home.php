<?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of Home
     *
     * @author Abd Elfttah Ahmed <thisphp.com@gmail.com>
     */
    class Home extends MY_Controller{
        public function __construct(){
            parent::__construct();
        }

        public function AdminHomePage(){
            $this->CheckLogin(true);
            $this->view('admin/home/home');
        }

        public function AdminLogin(){
            //pri('here');
            if (isset($this->_login_data['user_id'])) {
                \redirect(\base_url("admin"));
            }

            if (!empty($_POST['user_name']) || !empty($_POST['user_password'])) {

                $array_rules = array(
                    array(
                        'field' => 'user_name',
                        'label' => $this->_lang['user_name'],
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'user_password',
                        'label' => $this->_lang['user_password'],
                        'rules' => 'required'
                    )
                );

                $this->form_validation->set_rules($array_rules);

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = $this->_lang['error_user_login'];
                } else {
                    $array_data = $this->input->post();
                    $array_data['user_password'] = md5($array_data['user_password']);
                    $array_data['admin_or_reservarion'] = 0; // adminstration
                    if ($this->LogIn($array_data) !== false) {
                        redirect(\base_url('admin'));
                    }
                }
            }
            $this->view('admin/home/login', '', true);
        }

        public function AdminLogout(){
            $this->LogOut();
            redirect(\base_url('admin'));
        }

    }
