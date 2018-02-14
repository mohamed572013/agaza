<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Restaurants extends MY_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->model("Restaurants_model", 'restaurants');
        }
		
		
		
		public function et() {$main_content = 'restaurants/et';
            $this->_view($main_content);}


    	public function index() {
            $branches_id = $this->whitelabel_id;

            $this->data['restaurants'] = $restaurants = $this->restaurants->getAllActiveRestaurants($this->whitelabel_id, 12);
            $this->data['count'] = count($this->restaurants->getAllActiveRestaurants($this->whitelabel_id));

            $ids = $this->restaurants->getIds($this->whitelabel_id);

            if($this->input->is_ajax_request()) {
                $offset = $_POST['page_count'];

                $this->data['restaurants'] = $restaurants =  $this->restaurants->getAllActiveRestaurants($this->whitelabel_id, 12, $offset);

                $view_ajax = $this->load->view('main_content/ajax/restaurants', $this->data, true);
                echo $view_ajax;
                die();
            }




            $all_restaurants = $this->restaurants->getAllTitles($branches_id);
            


            $restaurants_ids = null;
            foreach ($ids as $key => $value) {
                $restaurants_ids[] = $value->places_id;
                
            }

            $tags = $this->restaurants->getAllTags($branches_id);                       

            
            $restaurants_cities = $this->restaurants->getCities($branches_id, $restaurants_ids);
            
            $this->data['restaurants_cities'] = $restaurants_cities;
            $this->data['all_restaurants'] = $all_restaurants;
            $this->data['tags'] = $tags;

    		$main_content = 'restaurants/index';
            $this->_view($main_content);
    	}


    	public function show() {
            $url_segment = $this->uri->segment(4);

            if($url_segment == "") {
                redirect(site_url()."/restaurants");
            }



            $url_array = explode("-", $url_segment);
            $id = $url_array[0];

            $restaurant_details = $this->restaurants->findById($id);
            $restaurant_details->slider = $this->restaurants->getRestaurantSlider($id);
            //$restaurant_details->features = $this->restaurants->getRestaurantFeatures($id);

            // seo keywords and description
            $seo = null;
            $seo['keywords'] = $restaurant_details->keywords_ar;
            $seo['description'] = $restaurant_details->description_ar;
            $this->data['seo'] = $seo; 

            // facebook sharer
            $image = substr($restaurant_details->logo, strpos($restaurant_details->logo, '_') + 1);        
            $og = null;
            $og['title'] = $restaurant_details->title_ar;
            $og['description'] = $restaurant_details->description_ar;
            $og['image'] = base_url() . "uploads/restaurants/l_" . $image;
            $this->data['og'] = $og; 

            $this->data['restaurant_details'] = $restaurant_details;

    		$main_content = 'restaurants/show';
            $this->_view($main_content);
    	}

        public function getCitiesLike() {            
            $city_title = $_POST['searched_value']; 
            
            
            $branches_id = $this->whitelabel_id;
            $data = $this->restaurants->getCitiesLike($branches_id, $city_title);
            print_json("success", $data);
        }

        public function getRestaurantLike() {            
            $restaurant_title = $_POST['searched_value']; 
            
            $branches_id = $this->whitelabel_id;
            $data = $this->restaurants->getRestaurantLike($branches_id, $restaurant_title);
            print_json("success", $data);
        }


        public function getRestaurantsByCity() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }        
            $branches_id = $this->whitelabel_id;  
            $this->data['restaurants'] = $this->restaurants->getRestaurantsByCity($searched_value, $branches_id);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/restaurants', $this->data, true);
            echo $view_ajax;
            die();
        }

        public function getRestaurantsByTitle() {

            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }        

            $branches_id = $this->whitelabel_id;  
            $this->data['restaurants'] = $this->restaurants->getRestaurantsByTitle($searched_value, $branches_id);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/restaurants', $this->data, true);
            echo $view_ajax;
            die();
        }


        public function getRestaurantsByTags() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }
            //pri($searched_value)         ;

            $branches_id = $this->whitelabel_id;  
            $this->data['restaurants'] = $this->restaurants->getRestaurantsByTags($branches_id, $searched_value);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/restaurants', $this->data, true);
            echo $view_ajax;
            die();
        }


        public function getRestaurantsByCitySidebar() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $cities = $_POST['searched_value']; 
            } else {
                $cities = false;
            }


            $branches_id = $this->whitelabel_id;
            $data = $this->restaurants->getRestaurantsByCitySidebar($branches_id, $cities);
           // pri($data);
            print_json("success", $data);
        }
		
		 public function sitemap() {
        $this->load->model("Sitemap_model", "sitemap");

        $this->sitemap->file_name("resraurants.xml");

        $branches_id = $this->whitelabel_id;
        $all_restaurants = $this->restaurants->getAllTitles($branches_id);
        //pri($all_restaurants);

        $this->sitemap->addUrl("http://agazabook.com/ar/restaurants", date('c'),  'daily',    '1');

        if($all_restaurants) {
            foreach ($all_restaurants as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/restaurants/show/$title", date('c'),  'daily');
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




?>