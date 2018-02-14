<?php

    class Admin extends C_Controller{
        function __construct(){
            parent::__construct();
        }

        function index(){
            $main_content = 'index';
            $this->_view($main_content, 'admin');
        }

    }
