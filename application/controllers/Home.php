<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Home_model', 'home');
            $this->load->model("Clients_model", "clients");
            $this->load->model('Home_slider_model', 'home_slider');
            $this->load->model('Front_programs_model', 'programs');
            $this->load->model('Front_hotels_model', 'hotels');
        }

        public function index(){
			//$this->home->set_global_sql();
            //pri('agazabook');
            $this->config->load('whitelabels');
            $whitelabels_config = $this->config->item('whitelabels'); 
            
            $whitelabels_ids = array_keys($whitelabels_config);
            $programs = $this->programs->get_offers_reserved_viewed_Programs('last_added', array(), 8, 0, $whitelabels_ids);
            $last_added = $this->programs->get_offers_reserved_viewed_Programs('last_added', array('programs.branches_id' => $this->whitelabel_id), 8);

            //pri($programs);
            //$merged_programs = array_merge($programs, $last_added);






            $slider_where['programs.show_in_agazabook'] = 1;
            $slider_where['programs.show_in_slider'] = 1;
            $slider_programs = $this->programs->get_offers_reserved_viewed_Programs('last_added', array(), 3, 0, $whitelabels_ids);
            $special_offers = $this->home->getHoteslCombinedDestibations($this->whitelabel_id, 2, 12);
            if ($special_offers) {
                $special_offers = array_chunk($special_offers, 2);
            } else {
                $special_offers = array();
            }
            //pri($special_offers);
            $in_egypt = $this->home->getHoteslCombinedDestibations($this->whitelabel_id, 1);
            //pri($special_offers);
            $hotels = $this->hotels->getAll($whitelabels_ids, 6, 0);
            //pri($hotels);
            $programs_after_edited = array();
            $new_programs = array();
            $new_slider_programs = array();
            $new_hotels = array();
            $new_in_egypt = array();



            if (!empty($merged_programs)) {
                foreach ($merged_programs as $program) {
                    if (!empty($whitelabels_config[$program->program_branches_id])) {
                        $program->company_url = $whitelabels_config[$program->program_branches_id]['url'];
                        $programs_after_edited[] = $program;
                    } else {
                        $program->company_url = "#";
                        $programs_after_edited[] = $program;
                    }
                }
            }

            //pri($merged_programs);

            $home_slider = $this->home_slider->GetWhere('home_slider', 'this_order', 'ASC', array('branches_id' => $this->whitelabel_id), 8);
            $this->data['home_slider'] = $home_slider;
            if (!empty($slider_programs)) {
                foreach ($slider_programs as $slider_program) {
                    if (!empty($whitelabels_config[$slider_program->program_branches_id])) {
                        $slider_program->company_url = $whitelabels_config[$slider_program->program_branches_id]['url'];
                        $new_slider_programs[] = $slider_program;
                    }
                }
            }
            if (!empty($hotels)) {
                foreach ($hotels as $hotel) {
                    if (!empty($whitelabels_config[$hotel->branches_id])) {
                        $hotel->company_url = $whitelabels_config[$hotel->branches_id]['url'];
                        $country_city = $this->hotels->getHotelCountryAndCity($hotel->places_id);
                        //pri($country_city);
                        $hotel->country = $country_city->country_title;
                        $hotel->city = $country_city->city_title;
                        $hotel->country_id = $country_city->country_id;
                        $hotel->city_id = $country_city->city_id;
                        $new_hotels[] = $hotel;
                    }
                }
            }
            shuffle($new_slider_programs);



            $all_programs = $this->programs->get_offers_reserved_viewed_Programs();


            $this->data['clients'] = $this->clients->getAllActiveClients(14);



            $new_programs['first'] = (isset($all_programs[0])) ? $all_programs[0] : false;
            $new_programs['second'] = (isset($all_programs[1]) && isset($all_programs[2])) ? array($all_programs[1], $all_programs[2]) : array();
            $new_programs['third'] = (isset($all_programs[3]) && isset($all_programs[4]) && isset($all_programs[5])) ? array($all_programs[3], $all_programs[4], $all_programs[5]) : array();
            $new_in_egypt['first'] = (isset($in_egypt[0])) ? $in_egypt[0] : false;
            $new_in_egypt['second'] = (isset($in_egypt[1]) && isset($in_egypt[2])) ? array($in_egypt[1], $in_egypt[2]) : array();
            $new_in_egypt['third'] = (isset($in_egypt[3]) && isset($in_egypt[4]) && isset($in_egypt[5])) ? array($in_egypt[3], $in_egypt[4], $in_egypt[5]) : array();
            //pri($new_programs);
            $this->data['programs'] = $new_programs;
            $this->data['hotels'] = $new_hotels;
            $this->data['slider_programs'] = $new_slider_programs;
            $this->data['special_offers'] = $special_offers;
            $this->data['new_in_egypt'] = $new_in_egypt;
            //pri($new_in_egypt);
            //$this->data['slider_programs'] = $slider_programs;
            $main_content = 'index';
            $this->_view($main_content);
        }

        function subscribe(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'البريد الإلكترونى', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $where_array['branches_id'] = $this->whitelabel_id;
                $where_array['email'] = $this->input->post('email');
                $test = $this->home->getWhere("subscribe", "id", "DESC", $where_array);
                if ($test) {
                    print_json('error', _lang('you_are_subscribed_before'));
                } else {
                    $data_array['branches_id'] = $this->whitelabel_id;
                    $data_array['email'] = $this->input->post('email');
                    $add = $this->home->add("subscribe", $data_array);
                    if ($add) {
                        print_json('success', _lang('subscribed_successfully'));
                    } else {
                        print_json('error', _lang('error'));
                    }
                }
            }
        }

	function getDB() {
	        $this->load->dbutil();
	        $filename = 'Agazabook -' . date("Y-m-d h-i-s a");
	        $prefs = array(
	            'format' => 'zip',
	            'filename' => "$filename.sql"
	        );
	        $backup = & $this->dbutil->backup($prefs);
	        $db_name = 'Agazabook -' . date("Y-m-d h:i:s a") . '.zip';
	        $save = '/opt/lampp/htdocs/' . $db_name;
	        $this->load->helper('file');
	        write_file($save, $backup);
	        $this->load->helper('download');
        	force_download($db_name, $backup);
    	}
		
		
		
		

    public function sitemap() {
        $branches_id = $this->whitelabel_id;

        // load all models
        $this->load->model("Sitemap_model", "sitemap");
        $this->load->model("Shops_model", "shops");
        $this->load->model("Restaurants_model", 'restaurants');
        $this->load->model("Etiquette_model", "etiquette");
        $this->load->model('Front_shrines_model', 'shriness');  
        $this->load->model("Transportations_model", "transport");
        
		
        // rename site map 
        $this->sitemap->file_name("sitemap.xml");

		
        // get data would be added in sitemap     
        $shops = $this->shops->getAllTitles($branches_id);        
        $all_restaurants = $this->restaurants->getAllTitles($branches_id);
        $all_programs = $this->programs->get_offers_reserved_viewed_Programs("by_order", null);
        $etiquette = $this->etiquette->getAllActiveEtiquette($branches_id);
        $shrines = $this->shriness->all_sitemap($this->whitelabel_id);
        $transports = $this->transport->getAllActive($this->whitelabel_id);

		
		
        // basic urls     http://agazabook.com/ar/clients
        $this->sitemap->addUrl("http://agazabook.com/ar", date('c'), 'daily', '0.1');
        $this->sitemap->addUrl("http://agazabook.com/ar/about_us", date('c'), 'daily', '0.2');
        $this->sitemap->addUrl("http://agazabook.com/ar/contact_us", date('c'), 'daily', '0.2');
        $this->sitemap->addUrl("http://agazabook.com/ar/shops", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/restaurants", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/etiquette", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/programs", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/shrines", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/transports", date('c'),  'daily',    '1');
        $this->sitemap->addUrl("http://agazabook.com/ar/clients", date('c'),  'daily',    '0.5');

        if($shops) {
            foreach ($shops as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/shops/show/$title", date('c'),  'daily');
            }    
        }
        if($all_restaurants) {
            foreach ($all_restaurants as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/restaurants/show/$title", date('c'),  'daily');
            }
        }
        if($all_programs) {
            foreach ($all_programs as $key => $value) {
                $title = str_replace(' ', '_', $value->program_title) . '-' . $value->program_flight_id . '-' . $value->program_id;
                $this->sitemap->addUrl("http://agazabook.com/ar/programs/detail/$title", date('c'),  'daily');
            }    
        }
        if($etiquette) {
            foreach ($etiquette as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/etiquette/show/$title", date('c'),  'daily');
            }    
        }
        if($shrines) {
            foreach ($shrines as $key => $value) {
                $title = str_replace(' ', '-', $value->shrine_title_ar) . "-" . $value->shrine_id;
                $this->sitemap->addUrl("http://agazabook.com/ar/shrines/details/$title", date('c'),  'daily');
            }    
        }
        if($transports) {
            foreach ($transports as $key => $value) {
                $title = $value->id . "-" . str_replace(' ', '-', $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/transports/show/$title", date('c'),  'daily');
            }    
        }
        $this->sitemap->createSitemap();
        $this->sitemap->writeSitemap();
        $this->sitemap->submitSitemap();
    }








    }
