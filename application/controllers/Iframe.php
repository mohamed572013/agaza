<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class iframe extends MY_Controller{
        public function __construct(){

            parent::__construct();
        }

        public function index(){
            $main_content = "iframe";
            $this->_view($main_content);
        }

    }
