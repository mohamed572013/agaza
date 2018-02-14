<?php

    class Logout extends MY_Controller{
        function __construct(){
            parent::__construct();
        }

        function index(){
            $CI = & get_instance();
            unset(
                    $_SESSION['EMPLOYEE_SESSION_DATA'], $_SESSION['GUEST_SESSION_DATA']
            );
            $CI->session->sess_destroy();
            redirect(base_url());
        }

    }
