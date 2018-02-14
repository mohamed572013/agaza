<?php

class Program_flights extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Programs_model', 'programs');
        $this->load->model('Program_categories_model', 'program_categories');
        $this->load->model('Program_flights_model', 'program_flights');
    }

    public function row() {
        //pri($_POST);
        $program_flight_id = $_POST['program_flight_id'];
        //pri($haj_umrah_programs_flight_id);
        $find = $this->program_flights->findById($program_flight_id);
        //pri($find);
        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        //pri($_POST);
        $program_id = $_POST['program_id'];
        $going_date = $_POST['going_date'];
        $return_date = $_POST['return_date'];
        //$this->nights_check($program_id, $going_date, $return_date);

        /* check if there is the same data in the table */
        $where_array['programs_id'] = $_POST['program_id'];
        $where_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
        $check = $this->program_flights->findWhere($where_array);
        if ($check) {
            print_json('error', _lang('added_before'));
        }
        /* end */
        $program = $this->programs->findById($program_id);
        $category = $this->program_categories->find($program->category_id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('flight_reservation_id', 'الرحلة', 'required');
        $this->form_validation->set_rules('child_price', 'سعر الطفل', 'required');
        $this->form_validation->set_rules('infant_price', 'سعر الرضيع', 'required');
        if ($category && $category->hotels_required == 0) {
            $this->form_validation->set_rules('f_adult_price', 'سعر البالغ', 'required');
        }
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            $data_array['flight_reservation_id'] = xss_clean($_POST['flight_reservation_id']);
            $data_array['child_price'] = xss_clean($_POST['child_price']);
            $data_array['infant_price'] = xss_clean($_POST['infant_price']);
            $data_array['adult_price'] = (isset($_POST['f_adult_price'])) ? xss_clean($_POST['f_adult_price']) : 0;
            $data_array['programs_id'] = xss_clean($_POST['program_id']);

            //pri($data_array);
            $add = $this->program_flights->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'error');
            }
        }
    }

    function edit() {
        //pri($_POST);
        $program_id = $_POST['program_id'];
        $going_date = $_POST['going_date'];
        $return_date = $_POST['return_date'];
        //$this->nights_check($program_id, $going_date, $return_date);
        //pri('stop');
        $program_flights_id = $_POST['program_flights_id'];
        /* check if there is the same data in the table */
        $find = $this->program_flights->findById($program_flights_id);
        $where_array['programs_id'] = $_POST['program_id'];
        $where_array['flight_reservation_id !='] = $find->flight_reservation_id;
        $where_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
        $check = $this->program_flights->findWhere($where_array);
        if ($check) {
            print_json('error', _lang('added_before'));
        }
        /* end */
        $program = $this->programs->findById($program_id);
        $category = $this->program_categories->find($program->category_id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('flight_reservation_id', 'الرحلة', 'required');
        $this->form_validation->set_rules('child_price', 'سعر الطفل', 'required');
        $this->form_validation->set_rules('infant_price', 'سعر الرضيع', 'required');

        if ($category && $category->hotels_required == 0) {
            $this->form_validation->set_rules('f_adult_price', 'سعر البالغ', 'required');
        }
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            $data_array['flight_reservation_id'] = xss_clean($_POST['flight_reservation_id']);
            $data_array['child_price'] = xss_clean($_POST['child_price']);
            $data_array['infant_price'] = xss_clean($_POST['infant_price']);
            $data_array['adult_price'] = (isset($_POST['f_adult_price'])) ? xss_clean($_POST['f_adult_price']) : 0;
            $data_array['programs_id'] = xss_clean($_POST['program_id']);
            $where['id'] = xss_clean($_POST['program_flights_id']);

            //pri($where);
            $update = $this->program_flights->update($data_array, $where);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', _lang('no_affected_rows'));
            }
        }
    }

    public function delete() {
        //pri($_POST);
        $program_flights_id = $_POST['program_flights_id'];
        $where_array['id'] = $program_flights_id;
        $delete = $this->program_flights->delete($where_array);
        if ($delete != "done") {
            if ($delete == "programs_rooms_prices") {
                print_json('success', _lang('not_valid_there_are_programs_rooms_prices'));
            } else if ($delete == "data") {
                print_json('success', "error");
            }
        } else {
            print_json('success', _lang('deleted_successfully'));
        }
    }

    function data($program_id) {
        $program = $this->programs->findById($program_id);
        $category = $this->program_categories->find($program->category_id);
        $this->load->library('datatables');
        $this->datatables
                ->select(' programs_flight.id as program_flights_id , flight_reservation.going_date,flight_reservation.return_date')
                ->from('flight_reservation')
                ->join('programs_flight', 'flight_reservation.id = programs_flight.flight_reservation_id')
                ->where("programs_flight.programs_id", $program_id);

        $this->datatables->add_column('room_prices', function($data) {
            $back = '<a href="" class="program-data-box" data-type="program_rooms_prices" data-id="' . $data["program_flights_id"] . '">' . _lang('room_prices') . '</a>';
            return $back;
        }, 'program_flights_id');
        $this->datatables->add_column('options', function($data) {

            $back = "";
            $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Program_data.edit_flights(this);return false;" data-id="' . $data["program_flights_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="حذف" class="tooltips" onclick="Program_data.delete_flights(this);return false;" data-id="' . $data["program_flights_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';
            return $back;
        }, 'program_flights_id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

    function GetCItyHotel() {
        //$cond['branches_id'] = $this->current_user_company->id;
        $cond['branches_id'] = 14;
        $cond['places_id'] = $_POST['places_id'];
        $cond['active'] = 1;
        $str = '<option disabled="disabled" selected>اختر</option>';
        $hotels = $this->haj_umrah_program->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
        if (count($hotels) > 0) {
            foreach ($hotels as $p) {
                $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
            }
        }

        echo $str;
    }

    function gatCountryCities() {
        $cond['place_id'] = $_POST['country_id'];
        $cond['is_delete'] = 0;
        $cond['active'] = 1;
        $str = '<option disabled="disabled" selected>اختر</option>';
        $cities = $this->haj_umrah_program->GetWhere('places', 'id', "ASC", $cond);
        if (count($cities) > 0) {
            foreach ($cities as $p) {
                $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
            }
        }

        echo $str;
    }

    public function nights_check($program_id, $going_date, $return_date) {
        $program_id = $this->programs->findById($program_id); //from haj umrah programs table
        $total_nights = $program_id->maka_nights;
        $days = GetDays($going_date, $return_date);

        $days_count = count($days);
        $days_count_as_nights = $days_count - 1;
        //pri($days_count_as_nights);
        if ($total_nights == $days_count_as_nights) {

        } else {
            print_json('error', _lang('nights_check_error') . $total_nights);
        }
    }

}
