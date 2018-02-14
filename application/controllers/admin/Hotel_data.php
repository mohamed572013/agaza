<?php

class Hotel_data extends C_Controller {

    public function __construct() {
        parent::__construct();
        //$this->CheckLogin(true);
        $this->load->model('Hotel_data_model', 'hotel_data');

        if (!empty($this->_settings->site_language)) {
            $this->config->set_item('language', $this->_settings->site_language);
        }
    }

    public function index() {
        $all_hotels = $this->hotel_data->allHotels($this->current_user_company->id);
        $rooms = $this->hotel_data->rooms($this->current_user_company->id);
        $chalets_others = $this->hotel_data->chalets_others($this->current_user_company->id);
        //pri($chalets_others);
        $extra_services = $this->hotel_data->extra_services($this->current_user_company->id);
        $countries = $this->hotel_data->countries($this->current_user_company->id);
        //pri($countries);
        $this->data['all_hotels'] = $all_hotels;
        $this->data['rooms'] = $rooms;
        $this->data['chalets_others'] = $chalets_others;
        $this->data['extra_services'] = $extra_services;
        $this->data['countries'] = $countries;
        $main_content = 'hotel_data/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $all_hotels = $this->hotel_data->allHotels($this->current_user_company->id);
        $rooms = $this->hotel_data->rooms($this->current_user_company->id);
        $chalets_others = $this->hotel_data->chalets_others($this->current_user_company->id);
        //pri($chalets_others);
        $extra_services = $this->hotel_data->extra_services($this->current_user_company->id);
        $countries = $this->hotel_data->countries($this->current_user_company->id);
        //pri($countries);
        $this->data['all_hotels'] = $all_hotels;
        $this->data['rooms'] = $rooms;
        $this->data['chalets_others'] = $chalets_others;
        $this->data['extra_services'] = $extra_services;
        $this->data['countries'] = $countries;
        $main_content = 'hotel_data/index';
        $this->_view($main_content, 'admin');
    }

    function data() {


        $this->load->library('datatables');
        $this->datatables
                ->select("*"
                )
                //->where("user_type","admin")
                ->from("maka_madina_hotels")
                ->where("active", 1)
                ->where("branches_id", $this->current_user_company->id);

        $this->datatables->add_column('options', function($data) {

            $back = "";
            //if( check_permission("admins", "add_update") ):

            $back .= '<a href="#" title="' . _lang("determine_rooms") . '" class="tooltips testo"  data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="' . _lang("determine_rooms_prices") . '" class="tooltips" onclick="Hotel_data.determine_rooms_prices(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="' . _lang("determine_extra_services_prices") . '" class="tooltips" onclick="Hotel_data.determine_extra_services_prices(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="' . _lang("add_hotel_images") . '" class="tooltips" onclick="Hotel_data.add_hotel_images(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';

            //endif;
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

    public function availableRooms() {
        //pri($_POST);
        $hotel_id = $_POST['hotel_id'];
        $rooms = $this->hotel_data->roomsAvailable($this->current_user_company->id, $hotel_id);
        //pri($rooms);
        if ($rooms) {
            print_json('success', $rooms);
        } else {
            print_json('error', 'error');
        }
    }

    public function availableExtraServices() {
        $hotel_id = $_POST['hotel_id'];
        $services = $this->hotel_data->extraServicesAvailable($this->current_user_company->id, $hotel_id);
        if ($services) {
            print_json('success', $services);
        } else {
            print_json('error', 'error');
        }
    }

    public function getOthersRoomsForMax() {
        //pri('here');
    }

}
