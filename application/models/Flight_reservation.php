<?php

class Flight_reservation extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Flight_reservation_model', 'flight_reservation');
    }

    public function index($pag_index = 0) {
        $cond_palces['place_id !='] = 0;
        $cond_palces['active'] = 1;
        $cond_palces['branches_id'] = $this->current_user_company->id;

        $this->data['places'] = $this->flight_reservation->GetWhere("places", "id", "ASC", $cond_palces);
        $cond_active['active'] = 1;
        $this->data['travel_way'] = $this->flight_reservation->GetWhere("travel_way", "id", "ASC", $cond_active);
        $main_content = 'flight_reservation/index';
        $this->_view($main_content, 'admin');
    }

    public function show($pag_index = 0) {
        $cond_palces['place_id !='] = 0;
        $cond_palces['active'] = 1;
        $cond_palces['branches_id'] = $this->current_user_company->id;

        $this->data['places'] = $this->flight_reservation->GetWhere("places", "id", "ASC", $cond_palces);
        $cond_active['active'] = 1;
        $this->data['travel_way'] = $this->flight_reservation->GetWhere("travel_way", "id", "ASC", $cond_active);
        $main_content = 'flight_reservation/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        //pri($_POST);
        $id = $_POST['id'];
        $find = $this->flight_reservation->findById($id);
        //pri($find);
        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        /*
         * flight type
         * 1:collective جماعية
         * 2:individual فردية
         */
        //pri($_POST);
        $flight_type = $_POST['flight_type'];
        $this->load->library('form_validation');
        if ($flight_type == '1') {
            $this->form_validation->set_rules('flight_company_name', "اسم الشركة الناقلة ", 'required');
            $this->form_validation->set_rules('travel_way_id', "وسيلة السفر ", 'required');
            $this->form_validation->set_rules('passenger_num', "عدد المسافرين ", 'required');
            $this->form_validation->set_rules('going_date', "تاريخ الذهاب ", 'required');
            $this->form_validation->set_rules('return_date', "تاريخ العودة ", 'required');
        }
        if ($flight_type == '2') {
            $this->form_validation->set_rules('individual_going_date', "تاريخ الذهاب ", 'required');
            $this->form_validation->set_rules('individual_return_date', "تاريخ العودة ", 'required');
        }
        $errors = array();
        $images_names = array();
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if ($flight_type == '1') {
                $data_array['active'] = xss_clean($_POST['active']);
                $data_array['flight_company_name'] = \xss_clean($_POST['flight_company_name']);
                $data_array['travel_way_id'] = \xss_clean($_POST['travel_way_id']);
                $data_array['passenger_num'] = \xss_clean($_POST['passenger_num']);
                $data_array['going_from_place'] = \xss_clean($_POST['going_from_place']);
                $data_array['going_to_place'] = \xss_clean($_POST['going_to_place']);
                $data_array['return_from_place'] = \xss_clean($_POST['return_from_place']);
                $data_array['return_to_place'] = \xss_clean($_POST['return_to_place']);
                $data_array['going_date'] = \xss_clean($_POST['going_date']);
                $data_array['return_date'] = \xss_clean($_POST['return_date']);
            }
            if ($flight_type == '2') {
                $data_array['active'] = xss_clean($_POST['individual_active']);
                $data_array['going_date'] = xss_clean($_POST['individual_going_date']);
                $data_array['return_date'] = xss_clean($_POST['individual_return_date']);
                $data_array['going_from_place'] = \xss_clean($_POST['individual_going_from_place']);
                $data_array['going_to_place'] = \xss_clean($_POST['individual_going_to_place']);
                $data_array['return_from_place'] = \xss_clean($_POST['individual_return_from_place']);
                $data_array['return_to_place'] = \xss_clean($_POST['individual_return_to_place']);
            }
            //pri($data_array);

            $data_array['flight_type'] = xss_clean($_POST['flight_type']);
            $data_array['branches_id'] = $this->current_user_company->id;
            $add = $this->flight_reservation->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }
    }

    public function edit() {
        /*
         * flight type
         * 1:collective جماعية
         * 2:individual فردية
         */
        //pri($_POST);
        $flight_type = $_POST['flight_type'];
        $this->load->library('form_validation');
        if ($flight_type == '1') {
            $this->form_validation->set_rules('flight_company_name', "اسم الشركة الناقلة ", 'required');
            $this->form_validation->set_rules('travel_way_id', "وسيلة السفر ", 'required');
            $this->form_validation->set_rules('passenger_num', "عدد المسافرين ", 'required');
            $this->form_validation->set_rules('going_date', "تاريخ الذهاب ", 'required');
            $this->form_validation->set_rules('return_date', "تاريخ العودة ", 'required');
        }
        if ($flight_type == '2') {
            $this->form_validation->set_rules('individual_going_date', "تاريخ الذهاب ", 'required');
            $this->form_validation->set_rules('individual_return_date', "تاريخ العودة ", 'required');
        }
        $errors = array();
        $images_names = array();
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if ($flight_type == '1') {
                $data_array['active'] = xss_clean($_POST['active']);
                $data_array['flight_company_name'] = \xss_clean($_POST['flight_company_name']);
                $data_array['travel_way_id'] = \xss_clean($_POST['travel_way_id']);
                $data_array['passenger_num'] = \xss_clean($_POST['passenger_num']);
                $data_array['going_from_place'] = \xss_clean($_POST['going_from_place']);
                $data_array['going_to_place'] = \xss_clean($_POST['going_to_place']);
                $data_array['return_from_place'] = \xss_clean($_POST['return_from_place']);
                $data_array['return_to_place'] = \xss_clean($_POST['return_to_place']);
                $data_array['going_date'] = \xss_clean($_POST['going_date']);
                $data_array['return_date'] = \xss_clean($_POST['return_date']);
            }
            if ($flight_type == '2') {
                $data_array['active'] = xss_clean($_POST['individual_active']);
                $data_array['going_date'] = xss_clean($_POST['individual_going_date']);
                $data_array['return_date'] = xss_clean($_POST['individual_return_date']);
                $data_array['going_from_place'] = \xss_clean($_POST['individual_going_from_place']);
                $data_array['going_to_place'] = \xss_clean($_POST['individual_going_to_place']);
                $data_array['return_from_place'] = \xss_clean($_POST['individual_return_from_place']);
                $data_array['return_to_place'] = \xss_clean($_POST['individual_return_to_place']);
            }
            $data_array['flight_type'] = xss_clean($_POST['flight_type']);
            $data_array['branches_id'] = $this->current_user_company->id;
            $where_array['id'] = $_POST['id'];
            //pri('sss');
            $update = $this->flight_reservation->update($data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', _lang('no_affected_rows'));
            }
        }
    }

    public function delete() {
        //pri($_POST);
        $id = $_POST['id'];
        $where_array['id'] = $id;
        $delete = $this->flight_reservation->delete($where_array);
        if ($delete != "done") {
            if ($delete == "program_flights_report") {
                print_json('success', _lang('not_valid_there_are_program_flights'));
            } else if ($delete == "islamic_program_flights_report") {
                print_json('success', _lang('not_valid_there_are_islamic_program_flights'));
            } else if ($delete == "data") {
                print_json('success', "error");
            }
        } else {
            print_json('success', _lang('deleted_successfully'));
        }
    }

    function data() {
        $CI = & get_instance();
        $this->load->library('datatables');
        $this->datatables
//                    ->select("haj_umrah_hotels.title_ar as hotel_title_ar,haj_umrah_hotels.id as haj_umrah_hotels_id,haj_umrah_hotels.image as image,"
//                            . "p1.title_ar as city_title_ar,p2.title_ar as region_title_ar")
                ->select('*')
                ->from("flight_reservation")
                ->where("branches_id", $CI->current_user_company->id);
        $this->datatables->add_column('flight_type', function($data) {
            $back = ($data['flight_type'] == 1) ? 'جماعية' : 'فردية';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {
            $back = "";
            //if( check_permission("admins", "add_update") ):

            $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Flight_reservation.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";


            $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Flight_reservation.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
            //endif;
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

    public function status($id = NULL) {
        if ($id):
            $cond['id'] = $id;
            $all_data = $this->flight_reservation->GetWhere("flight_reservation", "id", "ASC", $cond);

            $this->data['all_data'] = $all_data[0];
        else:
        endif;

        if ($this->data['all_data']->active == 1) {
            $array_data['active'] = 0;
        } else {
            $array_data['active'] = 1;
        }
        if (isset($id)) {
            $this->flight_reservation->update($array_data, array(
                'id' => $id
            ));
            echo 'yes';
        }
    }

}
