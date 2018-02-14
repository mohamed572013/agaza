<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Shops extends MY_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->model("Shops_model", "shops");
        }


    	public function index() {
            $branches_id = $this->whitelabel_id;

            $this->data['active_shops'] = $active_shops = $this->shops->getAllActiveShops($this->whitelabel_id, 12);
            $this->data['count'] = count($this->shops->getAllActiveShops($this->whitelabel_id));

            $ids = $this->shops->getIds($this->whitelabel_id);

            if($this->input->is_ajax_request()) {
                $offset = $_POST['page_count'];

                $this->data['shops'] = $active_shops =  $this->shops->getAllActiveShops($this->whitelabel_id, 12, $offset);

                $view_ajax = $this->load->view('main_content/ajax/shops', $this->data, true);
                echo $view_ajax;
                die();
            }




            $all_shops = $this->shops->getAllTitles($branches_id);

            $tags = $this->shops->getAllTags($branches_id);
            


            $shops_ids = null;
            foreach ($ids as $key => $value) {
                $shops_ids[] = $value->places_id;
                
            }

            $shops_cities = $this->shops->getCities($branches_id, $shops_ids);
            
            $this->data['shops_cities'] = $shops_cities;
            $this->data['all_shops'] = $all_shops;
            $this->data['shops'] = $active_shops;   
          //  pri($active_shops);
            $this->data['tags'] = $tags;         

            $main_content = 'shops/index';
            $this->_view($main_content);


    	}

    	public function show() {
            $url_segment = $this->uri->segment(4);
            $url_array = explode("-", $url_segment);
            $id = $url_array[0];
            $shop_details = $this->shops->findById($id);
            $shop_details->slider = $this->shops->getShopSliders($id);
            $shop_details->features = $this->shops->getShopFeatures($id);
			
			//pri($shop_details);
            $seo = null;
            $seo['keywords'] = $shop_details->keywords_ar;
            $seo['description'] = $shop_details->description_ar;
            $this->data['seo'] = $seo;  

            $image = substr($shop_details->logo, strpos($shop_details->logo, '_') + 1);        
            $og = null;
            $og['title'] = $shop_details->title_ar;
            $og['description'] = $shop_details->description_ar;
            $og['image'] = base_url() . "uploads/shops/l_" . $image;
            $this->data['og'] = $og;  
			
            $this->data['shop_details'] = $shop_details;            
    		$main_content = 'shops/show';
            $this->_view($main_content);
    	}

        public function getCitiesLike() {            
            $city_title = $_POST['searched_value']; 
            
            
            $branches_id = $this->whitelabel_id;
            $data = $this->shops->getCitiesLike($branches_id, $city_title);
            print_json("success", $data);
        }


        public function getShopLike() {            
            $shop_title = $_POST['searched_value']; 
            
            $branches_id = $this->whitelabel_id;
            $data = $this->shops->getShopLike($branches_id, $shop_title);
            print_json("success", $data);
        }


        public function getShopsByTags() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }
            //pri($searched_value)         ;

            $branches_id = $this->whitelabel_id;  
            $this->data['shops'] = $this->shops->getShopsByTags($branches_id, $searched_value);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/shops', $this->data, true);
            echo $view_ajax;
            die();
        }


        public function getShopsByCity() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }        
            $branches_id = $this->whitelabel_id;  
            $this->data['shops'] = $this->shops->getShopsByCity($searched_value, $branches_id);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/shops', $this->data, true);
            echo $view_ajax;
            die();
        }


        public function getShopsByCitySidebar() {
            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $cities = $_POST['searched_value']; 
            } else {
                $cities = false;
            }


            $branches_id = $this->whitelabel_id;
            $data = $this->shops->getShopsByCitySidebar($branches_id, $cities);
           // pri($data);
            print_json("success", $data);
        }



        public function getShopsByTitle() {

            if(isset($_POST['searched_value']) && $_POST['searched_value'] != "") {
                $searched_value = $_POST['searched_value']; 
            } else {
                $searched_value = false;
            }        

            $branches_id = $this->whitelabel_id;  
            $this->data['shops'] = $this->shops->getShopsByTitle($searched_value, $branches_id);
            //pri($this->data['restaurants']);
            $view_ajax = $this->load->view('main_content/ajax/shops', $this->data, true);
            echo $view_ajax;
            die();
        }
		
		    public function sitemap() {
        $this->load->model("Sitemap_model", "sitemap");

        $this->sitemap->file_name("shops.xml");

        $branches_id = $this->whitelabel_id;
        $shops = $this->shops->getAllTitles($branches_id);
        //pri($all_restaurants);
        $this->sitemap->addUrl("http://agazabook.com/ar/shops", date('c'),  'daily',    '1');

        if($shops) {
            foreach ($shops as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/shops/show/$title", date('c'),  'daily');
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