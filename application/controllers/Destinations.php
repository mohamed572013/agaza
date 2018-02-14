<?php

    class Destinations extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Home_model', 'home');
            $this->load->model('Front_hotels_model', 'hotels');
            $this->load->model('Front_destinations_model', 'destinations');
        }

        public function index(){
            $countries = $this->home->getAllCountries();
            $cities = $this->home->getAllCities();
            $new_cities = array();
            if (!empty($cities)) {
                foreach ($cities as $city) {
                    $city->country_name = $this->home->getCountryById($city->place_id);
                    $new_cities[] = $city;
                }
            }

            //$this->data['country_name'] = 'sss';
            $this->data['cities'] = $new_cities;
            $main_content = 'destinations/cities';
            $this->_view($main_content);
        }

        public function detail(){
            $city_title = str_replace('-', ' ', urldecode($this->uri->segment(3)));
            $shrine_title = str_replace('-', ' ', urldecode($this->uri->segment(2)));
            $shrine = $this->shrines->getShrinesByTitle($shrine_title);
            pri($shrine);
        }

        public function cities(){
            //pri('ssss');
            $segment = $this->uri->segment(2);
            $country_title = str_replace('-', ' ', urldecode($segment));
            $country_id = $this->home->getCountryIdByTitle($country_title);
            //pri($country_id);
            $cities = $this->home->getAllCitiesInCountry($country_id);
            //pri($cities);
            $this->data['country_id'] = $country_id;
            $this->data['country_name'] = $country_title;
            $this->data['cities'] = $cities;
            $main_content = 'destinations/cities';
            $this->_view($main_content);
        }

        public function city(){
            //pri('ss');
            $city_title = $this->uri->segment(3);
            $country_title = $this->uri->segment(4);
            $country_title = str_replace('-', ' ', urldecode($country_title));
            $country_id = $this->home->getCountryIdByTitle($country_title);
            $city_name = str_replace('-', ' ', urldecode($city_title));
            $city = $this->home->getCityByTitle($city_name, $country_id);
            $city->shrines = $this->destinations->getShrinesInCity($city->id);
            $hotels = $this->destinations->getHotelsInCity($city->id, false, false);
            $new_hotels = array();
            if ($hotels) {
                foreach ($hotels as $hotel) {
                    $hotels_advantage_ids = $hotel->hotels_advantage_ids;
                    $hotels_advantage_ids_array = explode(',', $hotels_advantage_ids);
                    $hotels_advantages = $this->hotels->getHotelsAdvantages($hotels_advantage_ids_array);
                    $hotels_advantages = ($hotels_advantages) ? $hotels_advantages : array();
                    $hotel->advantages = $hotels_advantages;
                    $country_city = $this->hotels->getHotelCountryAndCity($hotel->places_id);
                    $hotel->country = $country_city->country_title;
                    $hotel->city = $country_city->city_title;
                    $new_hotels[] = $hotel;
                }
            }
            $city->hotels = $new_hotels;
            if ($this->whitelabel_id > 0) {
                $where_array['programs.branches_id'] = $this->whitelabel_id;
            } else {
                $where_array['programs.branches_id'] = 14;
            }
            $where_array['places.id'] = $city->id;
            $city->programs = $this->destinations->getPrograms(false, $where_array);
            //pri($city->shrines);
            $this->data['all_hotels_count'] = $this->destinations->countAllInCity($city->id);
            $this->data['all_shrines_count'] = $this->destinations->getShrinesInCityCount($city->id);
            $this->data['all_programs_count'] = count($this->destinations->getPrograms(false, $where_array, true));
            //pri($this->data['all_hotels_count']);
            $this->data['city_name'] = $city_name;
            $this->data['city'] = $city;
            $this->data['city_id'] = $city->id;
            $main_content = 'destinations/city';
            //pri($city);
            $this->_view($main_content);
        }

        public function getCountryCode($country_title){
            $json = file_get_contents(base_url('countries.json'));
            $countries_array = json_decode($json, true);
            //pri($countries_array);
            foreach ($countries_array as $country) {
                $title = ucwords($country_title);
                if ($country['name'] == $title) {
                    return strtolower($country['code']);
                }
            }
        }

        public function test(){
            $this->data['city_name'] = 'test';
            $main_content = 'destinations/city';

            $this->_view($main_content);
        }

        public function moreHotels(){
            pri($_POST);


            $filter_array = compact(array("cities_ids", "hotels_ids", "prices", "stars", "advantages_ids", "sort", "inputs_search"));
            //pri($new_limit);
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $hotels = $this->hotels->getHotelsForFilter(0, $offset, $filter_array, $city_id, $new_limit);
            //pri($this->db->last_query());
            $new_hotels = array();
            if (!empty($hotels)) {
                foreach ($hotels as $hotel) {
                    $hotels_advantage_ids = $hotel->hotels_advantage_ids;
                    $hotels_advantage_ids_array = explode(',', $hotels_advantage_ids);
                    $hotels_advantages = $this->hotels->getHotelsAdvantages($hotels_advantage_ids_array);
                    $hotels_advantages = ($hotels_advantages) ? $hotels_advantages : array();
                    $hotel->advantages = $hotels_advantages;
                    $country_city = $this->hotels->getHotelCountryAndCity($hotel->places_id);
                    $hotel->country = $country_city->country_title;
                    $hotel->city = $country_city->city_title;
                    $new_hotels[] = $hotel;
                }
            }
            if (count($new_hotels) > 0) {
                $this->data['hotels'] = $new_hotels;
                $this->data['all_hotels_count'] = $this->hotels->getHotelsForFilterCount(0, $filter_array, $city_id);
                $hotels_view = $this->load->view('main_content/ajax/hotels_filter', $this->data, true);
            } else {
                $hotels_view = '';
            }

            echo $hotels_view;
        }

    }
