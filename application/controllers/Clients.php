<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Clients extends MY_Controller{


        public function __construct() {
            parent::__construct();
            $this->load->model("Clients_model", "clients");
        }

    	public function index() {
            $all_clients = $this->clients->getAllActiveClients($this->whitelabel_id);
            $this->data['all_clients'] = $all_clients;            
    		$main_content = 'clients/index';
            $this->_view($main_content);
    	}


		public function gett() {
		   
			
		}



    }




?>