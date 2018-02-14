<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Programs extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Front_programs_model', 'programs');
            $this->load->model("Restaurants_model", "restaurants");
            $this->load->model('Home_model', 'home');
            
        }

public function get_index() {
 $programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null, 12);
pri($programs);
}

        public function index(){
            $programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null, 12);
            $count = count($this->programs->get_offers_reserved_viewed_Programs());

            $filter_array = (!empty($_POST)) ? $this->handleWhereArrayForFilter($_POST) : array();

            if($this->input->is_ajax_request()) {
                $current_length = 0;
                if(isset($_POST['current_length']) && $_POST['current_length'] != "")  {
                    $current_length = $_POST['current_length'];
                } else {
                    $current_length = false;
                }
                
                $programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null, 12, $current_length, array(), $filter_array);
                $count = count($this->programs->get_offers_reserved_viewed_Programs());

                $this->data['all_programs'] = $programs;
                $this->data['programs_count'] = $count;
                
                $ajax_content = $this->load->view('main_content/ajax/programs', $this->data, true);
                echo $ajax_content;
                exit();
            }



            // start 
            $branches_id = $this->whitelabel_id;
            $ids = $this->programs->getIds();

            $places_ids = null;
			if($ids){
            foreach ($ids as $key => $value) {
                $places_ids[] = $value->places_id;
                
            }}


            $programs_cities = $this->programs->getCities($places_ids);

            $slidebar_programs = $this->programs->getAllAgazaPrograms();
          //  pri($programs);
            //pri($programs_cities);
            // end
           
            $this->data['slidebar_programs'] = $slidebar_programs;
            $this->data['all_programs'] = $programs;
            $this->data['programs_count'] = $count;

            $this->data['cities'] = $programs_cities;


            $main_content = 'programs/index';
            $this->_view($main_content);
        }

    public function handleWhereArrayForFilter($post_array) {
        $cities_ids = array();
        $hotels_ids = array();
        $prices = array();
        $stars = array();
        $sort = array();
        $inputs_search = array(); //only if filter happend after search from home page
        foreach ($post_array as $key => $value) {
            if (startsWith($key, 'city_')) {
                $cities_ids[] = $value;
               // pri("dddd");
            }
            if (startsWith($key, 'program_')) {
                $hotels_ids[] = $value;
            }
            if (startsWith($key, 'price_')) {
                $prices[$key] = (int) substr($value, 3);
            }
            if (startsWith($key, 'star_')) {
                $stars[] = $value;
            }
            if (startsWith($key, 'sort_type')) {
                $sort[$key] = $value;
            }
            if (startsWith($key, 'sort_value')) {
                $sort[$key] = $value;
            }
            if (startsWith($key, 'p_')) {
                $inputs_search[$key] = $value;
            }
        }

        $filter_array = compact(array("cities_ids", "hotels_ids", "prices", "stars", "sort", 'inputs_search'));
        return $filter_array;
    }

        function detail(){
            $this->config->load('whitelabels');
            $whitelabels_config = $this->config->item('whitelabels');
            $program_name = $this->uri->segment(4);
            $pieces = explode("-", $program_name);

            $program_id = end($pieces);

            /* start from here */
            $this->data['program_details'] = $program_details = $this->programs->get_program($program_id);
            
            //pri($this->data['program_details']);
            $this->data['program_advantages'] = $this->programs->get_program_advantages($program_id);

            $this->data['program_services'] = $this->programs->get_program_services($program_id);

            $this->data['program_dates'] = $this->programs->get_program_dates($program_id);

            $this->data['program_images'] = $this->programs->get_program_images($program_id);
			
			$seo = null;
            $seo['keywords'] = $this->data['program_details']->agaza_keywords_ar;
            $seo['description'] = $this->data['program_details']->agaza_desc_ar;
            $this->data['seo'] = $seo; 
			
			$og = null;
            $og['title'] = $program_details->program_title;
            $og['description'] = $program_details->program_desc;
            $image = substr($program_details->agaza_image, strpos($program_details->agaza_image, '_') + 1);
            $og['image'] = $program_details->agaza_image_url . "uploads/programs/l_" . $image;
            $this->data['og'] = $og;  


            $this->data['hotels'] = $this->programs->program_hotels($program_id);
            $this->data['cities'] = $this->programs->program_cities($program_id);

            $main_content = 'programs/program_details';
            $this->_view($main_content);
        }



    public function getCitiesLike() {            
            $city_title = $_POST['searched_value']; 
            
            
            $branches_id = $this->whitelabel_id;
            $data = $this->programs->getCitiesLike($branches_id, $city_title);
            
            print_json("success", $data);
        }


        public function getProgramsLike() {            
            $city_title = $_POST['searched_value']; 
            
            
            $branches_id = $this->whitelabel_id;
            $data = $this->programs->getProgramsLike($branches_id, $city_title);
            
            print_json("success", $data);
        }


        public function getProgramsByCity() {
//pri($_POST);
            $filter_array = (!empty($_POST)) ? $this->handleWhereArrayForFilter($_POST) : array(); 
  //          pri($filter_array);
            $branches_id = $this->whitelabel_id;  
            $programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null, 12, false, array(), $filter_array);
            $this->data['programs_count'] = count($this->programs->get_offers_reserved_viewed_Programs("by_order", null, false, false, null, $filter_array));
            $this->data['all_programs'] = $programs;
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/programs', $this->data, true);
            echo $view_ajax;
            die();
        }

         public function getProgramsByProgram() {
            if(isset($_POST['programs']) && $_POST['programs'] != "") {
                $programs = array_values($_POST['programs']);
            } else {
                $programs = "";
            }

           // pri($_POST['programs']);
            $this->data['programs_count'] = count($this->programs->getProgramsByProgram());
            $this->data['all_programs'] = $this->programs->getProgramsByProgram($programs);

           // pri($programs);
            

            $view_ajax = $this->load->view('main_content/ajax/programs', $this->data, true);
            echo $view_ajax;
            die();
        }
		
		
		 public function sitemap() {
        $this->load->model("Sitemap_model", "sitemap");

        $this->sitemap->file_name("programs.xml");

        $branches_id = $this->whitelabel_id;
        $all_programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null);
        //pri($all_restaurants);
        $this->sitemap->addUrl("http://agazabook.com/ar/programs", date('c'),  'daily',    '1');

        if($all_programs) {
            foreach ($all_programs as $key => $value) {
                $title = str_replace(' ', '_', $value->program_title) . '-' . $value->program_flight_id . '-' . $value->program_id;
                $this->sitemap->addUrl("http://agazabook.com/ar/programs/detail/$title", date('c'),  'daily');
            }    
        }
            
        // create sitemap
        $this->sitemap->createSitemap();

        // write sitemap as file
        $this->sitemap->writeSitemap();

        // update robots.txt file
   //     $this->sitemap->updateRobots();

        // submit sitemaps to search engines
        $this->sitemap->submitSitemap();
    }


}
