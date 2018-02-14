<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transports extends MY_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->model("Transportations_model", "transportation");
        }


    	public function index() {   


            $branches_id = $this->whitelabel_id;

            $this->data['all_active_transportations'] = $this->transportation->getAllActive($this->whitelabel_id, 12);
            $this->data['count'] = count($this->transportation->getAllActive($this->whitelabel_id));

            $this->data['brands'] = $this->transportation->getAllBrands($this->whitelabel_id);

            if($this->input->is_ajax_request()) {
                $offset = $_POST['page_count'];
                
                $this->data['all_active_transportations'] = $this->transportation->getAllActive($this->whitelabel_id, 12, $offset);

                $view_ajax = $this->load->view('main_content/ajax/transports', $this->data, true);
                echo $view_ajax;
                die();
            }

            

            $main_content = 'transports/index';
            $this->_view($main_content);



    	}

    	public function show() {
            $uri_segment = $this->uri->segment(4);
            $uri_segment_array = explode("-", $uri_segment);
            $id = $uri_segment_array[0];
            $transportation_details = $this->transportation->findById($id);
            $transportation_details->images = $this->transportation->getAllImages($id);
		//	print_r($transportation_details); die();
			
			
			// seo keywords and description
            $seo = null;
            $seo['keywords'] = $transportation_details->keywords_ar;
            $seo['description'] = $transportation_details->description_ar;
            $this->data['seo'] = $seo; 

            // facebook sharer
            $image = substr($transportation_details->logo, strpos($transportation_details->logo, '_') + 1);        
            $og = null;
            $og['title'] = $transportation_details->title_ar;
            $og['description'] = $transportation_details->description_ar;
            $og['image'] = base_url() . "uploads/transportations/l_" . $image;
            $this->data['og'] = $og; 
			
            $this->data['transportation_details'] = $transportation_details;
    		$main_content = 'transports/show';
            $this->_view($main_content);
    	}


        public function getTransportsByTags() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }
            //pri($searched_value)         ;

            $branches_id = $this->whitelabel_id;  
            $this->data['all_active_transportations'] = $this->transportation->getTransportsByTags($branches_id, $searched_value);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/transports', $this->data, true);
            echo $view_ajax;
            die();
        }


    }




?>