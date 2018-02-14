<?php

    class Visa_features extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Visa_features_model', 'visa_features');
        }

        public function index(){
            $visa_types = $this->visa_features->visa_types($this->current_user_company->id);
            $visa_periods = $this->visa_features->visa_periods($this->current_user_company->id);
            $visa_documents = $this->visa_features->visa_documents($this->current_user_company->id);
            $visa_jobs = $this->visa_features->visa_jobs($this->current_user_company->id);
            $places = $this->visa_features->places($this->current_user_company->id);
            $this->data['visa_types'] = $visa_types;
            $this->data['visa_periods'] = $visa_periods;
            $this->data['visa_documents'] = $visa_documents;
            $this->data['visa_jobs'] = $visa_jobs;
            $this->data['places'] = $places;
            //pri($this->data['cities']);
            $main_content = 'visa_features/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $visa_types = $this->visa_features->visa_types($this->current_user_company->id);
            $visa_periods = $this->visa_features->visa_periods($this->current_user_company->id);
            $visa_documents = $this->visa_features->visa_documents($this->current_user_company->id);
            $visa_jobs = $this->visa_features->visa_jobs($this->current_user_company->id);
            $places = $this->visa_features->places($this->current_user_company->id);
            $this->data['visa_types'] = $visa_types;
            $this->data['visa_periods'] = $visa_periods;
            $this->data['visa_documents'] = $visa_documents;
            $this->data['visa_jobs'] = $visa_jobs;
            $this->data['places'] = $places;
            //pri($visa_jobs);
            $main_content = 'visa_features/index';
            $this->_view($main_content, 'admin');
        }

        function data(){


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

        function getCities(){

            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $cities = $this->visa_features->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $c) {
                    if ($c->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $c->id . '>' . $c->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function getHotels(){
            //pri($_POST);
            $selected_id = $_POST['selected_id'];
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['places_id'] = $_POST['city_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $hotels = $this->visa_features->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
            //pri($hotels);
            if (count($hotels) > 0) {
                foreach ($hotels as $h) {
                    if ($h->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $h->id . '>' . $h->title_ar . '</option>';
                }
            }

            echo $str;
        }

    }
