<?php

    class Ajax extends MY_Controller{

        public $_upload_config = array();

        public function __construct(){
            parent::__construct();
            $this->load->model('Ajax_model', 'ajax_model');
            $this->load->model('Front_hotels_model', 'hotels');
            $this->load->model('Front_destinations_model', 'destinations');
            $this->load->model('Home_model', 'home');
        }

        public function moreHotels(){
            //pri($_POST);
            //pri($new_limit);
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $hotels = $this->hotels->getHotelsForFilter(0, $offset, $filter_array = array(), $city_id, false);
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
                $hotels_view = $this->load->view('main_content/ajax/destinations_hotels_more', $this->data, true);
            } else {
                $hotels_view = '';
            }

            echo $hotels_view;
        }

        public function moreShrines(){  //for destinations page
            //pri($_POST);
            //pri($new_limit);
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $shrines = $this->destinations->getShrinesInCity($city_id, $offset);
            if (count($shrines) > 0) {
                $this->data['shrines'] = $shrines;
                $hotels_view = $this->load->view('main_content/ajax/destinations_shrines_more', $this->data, true);
            } else {
                $hotels_view = '';
            }

            echo $hotels_view;
        }

        public function morePrograms(){ //for destinations page
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $where_array['places.id'] = $city_id;
            $programs = $this->destinations->getPrograms($offset, $where_array);
            //pri($this->db->last_query());
            if (count($programs) > 0) {
                $this->data['programs'] = $programs;
                $ajax_content = $this->load->view('main_content/ajax/destinations_programs_more', $this->data, true);
            } else {
                $ajax_content = '';
            }

            echo $ajax_content;
        }

        public function getCitiesInOutEgypt(){ //for ajax
            //pri($_POST);
            $in_out_egypt = $_POST['in_out_egypt'];
            $cities = $this->home->getAllCities($in_out_egypt);
            $new_cities = array();
            if (!empty($cities)) {
                foreach ($cities as $city) {
                    $city->country_name = $this->home->getCountryById($city->place_id);
                    $new_cities[] = $city;
                }
            }
            //pri($new_cities);
            //$this->data['country_name'] = 'sss';

            if (count($new_cities) > 0) {
                $this->data['cities'] = $new_cities;
                $ajax_content = $this->load->view('main_content/ajax/cities', $this->data, true);
            } else {
                $ajax_content = '';
            }

            echo $ajax_content;
        }

    }
