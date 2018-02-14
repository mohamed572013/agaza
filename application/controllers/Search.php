<?php

    class Search extends MY_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Employee_model', 'employee');
            $this->load->model('Guest_model', 'guest');
            $this->load->model('Home_model', 'home');
            $this->load->model('Search_model', 'search');
            $this->load->model('Front_hotels_model', 'hotels');
            //parse_str($_SERVER['QUERY_STRING'], $_GET);
        }

        public function index(){
            //pri($this->uri->segment(2));
            $search_type = $this->uri->segment(3);  //programs or hotels
            //pri($search_type);
            if ($search_type == 'programs') {
                $parameters = explode('-', $this->uri->segment(4));
                $query_id = end($parameters);
                $query = $this->load_query($query_id);
                parse_str($query->query, $_GET);
                //pri($_GET);
                $where_array = array();
                if (isset($_GET['p_city']) && !empty($_GET['p_city'])) {
                    $where_array['places.title_ar'] = trim($_GET['p_city']);
                    $this->data['p_city'] = $_GET['p_city'];
                }
                if (isset($_GET['p_hotel']) && !empty($_GET['p_hotel'])) {
                    $where_array['hotels.title_ar'] = trim($_GET['p_hotel']);
                    $this->data['p_hotel'] = $_GET['p_hotel'];
                }
//                if (isset($_GET['p_city']) && !empty($_GET['p_city'])) {
//                    $where_array['places.title_ar'] = $_GET['p_city'];
//
//                }
                if (isset($_GET['p_arrive_date']) && !empty($_GET['p_arrive_date'])) {
                    $where_array['flight_reservation.going_date <='] = $_GET['p_arrive_date'];
                    $this->data['p_arrive_date'] = $_GET['p_arrive_date'];
                }
                if (isset($_GET['p_departing_date']) && !empty($_GET['p_departing_date'])) {
                    $where_array['flight_reservation.return_date >='] = $_GET['p_departing_date'];
                    $this->data['p_arrive_date'] = $_GET['p_arrive_date'];
                }



                $segment_4 = $this->uri->segment(5);
                $arr = explode('-', $segment_4);
                $page = end($arr);
                if ($page) {
                    $current_page = $page;
                } else {
                    $current_page = 1;
                }

                $per_page = 1;
                $prev_page = $current_page - 1;
                $next_page = $current_page + 1;

                $offset = ($current_page - 1) * $per_page;
                if ($this->whitelabel_id > 0) {
                    $where_array['programs.branches_id'] = $this->whitelabel_id;
                } else {
                    $where_array['programs.branches_id'] = 14;
                }
                $result = $this->search->getPrograms($per_page, $offset, false, $where_array);
                $min_max_price = $this->search->getMinMaxPrice($where_array);
                $prices = array();
                if (!empty($min_max_price)) {
                    foreach ($min_max_price as $price) {
                        $prices[] = $price->price_start_from;
                    }
                    $this->data['min_price'] = min($prices);
                    $this->data['max_price'] = max($prices);
                }
                //pri($result);
                // exit;
                $total = count($this->search->getPrograms('', '', true, $where_array));
                $pages = ceil($total / $per_page);
                //pri($total);
                $this->data['pages'] = $pages;
                $this->data['prev_page'] = $prev_page;
                $this->data['next_page'] = $next_page;
                $this->data['url'] = site_url('search/programs/' . \urldecode($this->uri->segment(4)) . '/');
                $this->data['site_works'] = $result;
                $this->data['show_links'] = $page + 3;
                $this->data['current_page'] = $current_page;
                //$this->data['page_title'] = $page_title;
                $this->data['view'] = 'home/category3';
                if ($this->input->is_ajax_request()) {
                    $this->data['all_programs'] = $result;

                    $ajax_content = $this->load->view('main_content/ajax/programs', $this->data, true);
                    echo $ajax_content;
                    exit();
                }

                $this->data['all_programs'] = $this->search->getPrograms($per_page, $offset, false, $where_array);
                $main_content = 'search/programs/programs';
                $this->_view($main_content);
            }
            if ($search_type == 'hotels') {
                $parameters = explode('-', $this->uri->segment(3));
                $query_id = end($parameters);
                $query = $this->load_query($query_id);
                parse_str($query->query, $_GET);
                //pri($_GET);
                $title_ar = $_GET['country_hotel'];

                //check if this title of city or hotel
                $searched_city = $this->search->getCitiesByTitle($title_ar);
                $searched_hotel = $this->search->getHotelsByTitle($title_ar);
                //pri($hotel);
                if ($searched_city) {  //find hotels in city
                    $hotels = $this->search->getHotelsInCity($searched_city->id, false, false);
                    //pri($hotels);
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
                    //pri($this->search->countAllInCity($city->id));
                    $this->data['hotels'] = $new_hotels;
                    $this->data['all_hotels_count'] = $this->search->countAllInCity($searched_city->id);
                    $this->data['hotels_advantages'] = $this->search->getAllHotelsAdvantages(0);
                    $this->data['city_id'] = $searched_city->id;
                    $main_content = 'search/hotels/index';
                    //$this->_view($main_content);
                    $this->_view($main_content);
                }
                if ($searched_hotel) { //find special hotel
                    //pri($searched_hotel);
                    $searched_hotel->images = $this->hotels->getHotelsImages($searched_hotel->id); //images

                    $hotel_advantage_ids_array = explode(',', $searched_hotel->hotels_advantage_ids);
                    $searched_hotel->advantages = $this->hotels->getHotelsAdvantages($hotel_advantage_ids_array); //advantages
                    $searched_hotel->extra_services = $this->hotels->getHotelsExtraServices($searched_hotel->id); //extra services
                    $searched_hotel->rooms_prices = $this->hotels->getHotelsRoomsPrices($searched_hotel->id); //rooms prices
                    //pri($hotel->rooms_prices);
                    $rooms_prices_max = array();
                    if (!empty($searched_hotel->rooms_prices)) {
                        //pri('here');
                        foreach ($searched_hotel->rooms_prices as $room_price) {
                            $hotel_rooms_max = $this->hotels->getHotelsRoomsMax($searched_hotel->id, $room_price->hotel_rooms_id);
                            if ($hotel_rooms_max) {
                                $room_price->max_child = $this->hotels->getHotelsRoomsMax($searched_hotel->id, $room_price->hotel_rooms_id)->number_of_child_extra;
                                $room_price->max_infant = $this->hotels->getHotelsRoomsMax($searched_hotel->id, $room_price->hotel_rooms_id)->number_of_infant_extra;
                            }

                            $rooms_prices_max[] = $room_price;
                        }
                    }

                    $searched_hotel->hotels_in_same_country = $this->hotels->getHotelsInCountry($searched_hotel->places_id, $searched_hotel->id); //hotels in same country
                    $searched_hotel->rooms_prices_max = $rooms_prices_max; //hotels in same country
                    //pri($rooms_prices_max);
                    //pri($this->hotels->getHotelsExtraServices($hotel->id));
                    $this->data['hotel_id'] = $searched_hotel->id;
                    $this->data['hotel_title'] = $searched_hotel->title_ar;
                    $this->data['hotel'] = $searched_hotel;
                    $this->data['hotel_country_city'] = $this->hotels->getHotelCountryAndCity($searched_hotel->places_id);
                    //pri($this->data['hotel_country_city']);
                    $main_content = 'hotels/hotel_details';
                    $this->_view($main_content);
                }

                //pri($main_content);
            }
        }

        public function save_query(){
            //pri($_POST);
            $query = $_POST['query'];
            $array_data['query'] = $query;
            $add = $this->search->add('search_query', $array_data);
            if ($add) {
                print_json('success', $add);
            } else {
                print_json('error', 'error');
            }
        }

        public function load_query($query_id){
            $find = $this->search->findById('search_query', $query_id);
            return $find;
        }

        public function auto_complete(){
            //pri($_POST);
            $country_hotel = $_POST['country_hotel'];
            $cities = $this->search->getCitiesLike($country_hotel);
            //pri($cities);
            $hotels = $this->search->getHotelsLike($country_hotel);
            //pri($hotels);
            if ($cities && !$hotels) {
                if (count($cities) == 1) {
                    $city = $cities[0];
                    //pri($city->id);
                    $city->hotels = $this->search->getAllHotelsInCity($city->id);
                    //pri($city);
                    print_json('city', $city);
                } else {
                    print_json('city', $cities);
                }
            } else if (!$cities && $hotels) {
                print_json('hotel', $hotels);
            } else if ($cities && $hotels) {
                $cities_hotels['hotels'] = $hotels;
                $cities_hotels['cities'] = $cities;
                \print_json('mix', $cities_hotels);
            } else {
                print_json('error', 'error');
            }
        }

        public function getHotelsInCity(){
            $country_id = $_POST['country_id'];
            $hotels = $this->search->getAllHotelsInCity($country_id);
            if ($hotels) {
                print_json('success', $hotels);
            } else {
                print_json('error', 'لا يوجد فنادق');
            }
        }

    }
