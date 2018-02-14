<?php

    class Property extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Front_hotels_model', 'hotels');
        }

        public function index(){

            $this->config->load('whitelabels');
            $whitelabels_config = $this->config->item('whitelabels');
            /* edit 1-12-2016 */
            $hotel_title = urldecode($this->uri->segment(3));
            $country_title = urldecode($this->uri->segment(4));
            $city_title = urldecode($this->uri->segment(5));
            $hotel_title_explode = explode('-', $hotel_title);
            $country_title_explode = explode('-', $country_title);
            $hotel_id = end($hotel_title_explode);
            $country_id = end($country_title_explode);

            $city = $this->hotels->findByTableAndID('places', $country_id);
            //pri($city);
            $hotel = $this->hotels->findById($hotel_id);
            if (!$hotel) {
                redirect(site_url('hotels'));
            }
            $hotel->company_url = $whitelabels_config[$hotel->branches_id]['url'];
            $hotel->images = $this->hotels->getHotelsImages($hotel->id); //images

            $hotel_advantage_ids_array = explode(',', $hotel->hotels_advantage_ids);
            $hotel->advantages = $this->hotels->getHotelsAdvantages($hotel_advantage_ids_array); //advantages
            $hotel->extra_services = $this->hotels->getHotelsExtraServices($hotel->id); //extra services
            $hotel->rooms_prices = $this->hotels->getHotelsRoomsPrices($hotel->id); //rooms prices
            //pri($hotel);
            $rooms_prices_max = array();
            $adult_prices = array();
            if (!empty($hotel->rooms_prices)) {
                //pri('here');
                foreach ($hotel->rooms_prices as $room_price) {
                    $adult_prices[] = $room_price->adult_price;
                    $hotel_rooms_max = $this->hotels->getHotelsRoomsMax($hotel->id, $room_price->hotel_rooms_id);
                    if ($hotel_rooms_max) {
                        $room_price->max_child = $this->hotels->getHotelsRoomsMax($hotel->id, $room_price->hotel_rooms_id)->number_of_child_extra;
                        $room_price->max_infant = $this->hotels->getHotelsRoomsMax($hotel->id, $room_price->hotel_rooms_id)->number_of_infant_extra;
                    }

                    $rooms_prices_max[] = $room_price;
                }
            }

            $hotel->hotels_in_same_country = $this->hotels->getHotelsInCountry($country_id, $hotel->id); //hotels in same country
            $hotel->rooms_prices_max = $rooms_prices_max; //room prices and max
            //pri($this->hotels->getHotelsExtraServices($hotel->id));
            $this->data['hotel_id'] = $hotel->id;
            $this->data['hotel_title'] = $hotel_title;
            $this->data['hotel'] = $hotel;
            $this->data['city'] = $city;
            $this->data['lowest_adult_price'] = min($adult_prices);
            //$this->data['hotel_country_city'] = $this->hotels->getHotelCountryAndCity($country_id);
            //pri($this->data['hotel_country_city']);
            $main_content = 'hotels/hotel_details';
            $this->_view($main_content);
        }

        public function shrines(){
            $main_content = 'shrines/shrine_details';
            $this->_view($main_content);
        }

    }
