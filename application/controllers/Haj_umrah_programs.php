<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Haj_umrah_programs extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Front_haj_umrah_programs_model', 'programs');
            $this->load->model('Programs_flight_model', 'programs_flight');
            $this->load->model('Home_model', 'home');
            $this->load->library('pagination');
        }

        public function index(){

            //pri(GetDaysAndNames('2016-11-12', '2017-01-01'));
            //pri(GetDays('2016-11-12', '2017-01-01'));
            $segment_2 = $this->uri->segment(3);
            $arr = explode('-', $segment_2);
            $page = end($arr);
            //pri($page);
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
                $where_array = array();
            }
            $result = $this->programs->getPrograms($per_page, $offset, false, $where_array);

            $min_max_price = $this->programs->getMinMaxPrice($where_array);
            $prices = array();
            if (!empty($min_max_price)) {
                foreach ($min_max_price as $price) {
                    $prices[] = $price->price_start_from;
                }
                $this->data['min_price'] = min($prices);
                $this->data['max_price'] = max($prices);
            }
            //pri(max($prices));
            $total = count($this->programs->getPrograms('', '', true, $where_array));
            $pages = ceil($total / $per_page);
            //pri($total);
            $this->data['pages'] = $pages;
            $this->data['per_page'] = $per_page;
            $this->data['prev_page'] = $prev_page;
            $this->data['next_page'] = $next_page;
            $this->data['url'] = site_url('haj_umrah_programs/');
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

            $this->data['all_programs'] = $this->programs->getPrograms($per_page, $offset, false, $where_array);
            //pri($this->data['all_programs']);
            $hotels = $this->home->getAllHotels(0);
            $cities = $this->home->getAllCities();
            $this->data['cities'] = $cities;
            $this->data['hotels'] = $hotels;
            $main_content = 'programs/index';
            $this->_view($main_content, 'haj_umrah');
        }

        function detail(){
            //pri('here');
            //pri($this->programs->get_program_id_from_flight());
            $program_name = $this->uri->segment(4);
            $pieces = explode("-", $program_name);
            if (count($pieces) == 3) {
                $program_flight_id = $pieces[1];
            } else {
                $program_flight_id = '';
            }

            $program_id = end($pieces);
            //pri($program_id);
            /* handle most viewed programs */
            //$this->programs->handleMostViewedReservedIncrements($program_id, 'viewed');
            /* end */

            /* start from here */
            $this->data['program_details'] = $this->programs->get_program($program_id);

            $this->data['program_advantages'] = $this->programs->get_program_advantages($program_id);

            $this->data['program_services'] = $this->programs->get_program_services($program_id);

            $this->data['program_dates'] = $this->programs->get_program_dates($program_id);

            $this->data['program_images'] = $this->programs->get_program_images($program_id);

            $this->data['most_viewed'] = $this->programs->get_offers_reserved_viewed_Programs('most_viewed', array(), 4);

            $this->data['hotels'] = $this->programs->programs_cities_hotels($program_id);
            $this->data['cities'] = $this->programs->programs_cities_hotels($program_id, true);
            //pri($this->data['hotels']);
            $program_date = $this->data['program_dates'][0];

            if ($program_flight_id != '') {
                $program_room_prices = $this->programs->get_program_room_prices($program_flight_id);
            } else {
                $program_room_prices = $this->programs->get_program_room_prices($program_date->programs_flight_id);
            }
            //pri($this->data['programs_cities_hotels']);
            $program_date->room_prices = $program_room_prices;
            $this->data['program_flight_info_prices'] = $program_date;
            //pri($this->data['program_flight_info_prices']);
            $this->data['program_flight_id'] = $program_flight_id;
            $main_content = 'programs/program_details';
            $this->_view($main_content, 'haj_umrah');
        }

        function getProgramFlight(){
            //pri($_POST);
            if (!empty($_POST)) {
                $program_flight_id = $_POST['program_flight_id'];
                $program_id = $_POST['program_id'];
                $program_dates = $this->programs->get_program_dates($program_id, $program_flight_id, true);
                $program_room_prices = $this->programs->get_program_room_prices($program_flight_id);
                $program_dates->room_prices = $program_room_prices;
                //pri($program_dates);
                //pri($program_dates);
                $data['program_flight_info_prices'] = $program_dates;
                //print_json('success', $program_dates);
                $ajax_content = $this->load->view('main_content/ajax/program_flight_prices', $data, true);
                echo $ajax_content;
            }
        }

        public function omra_program_form_send(){
            $this->load->model('Mahmoud_share', 'mahmoud_share');

            $lang = $this->uri->segment(1);
            if ($lang == "ar") {
                $this->config->set_item('language', 'arabic');
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
            $this->form_validation->set_rules('email', $this->lang->line("email"), 'required|valid_email');
            $this->form_validation->set_rules('phone', $this->lang->line("phone"), 'required');
            $this->form_validation->set_rules('message', $this->lang->line("Message"), 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $form_data["admin"] = $this->data['site_email'];
                $form_data['program_type'] = strip_tags($_POST['program_type']);
                $form_data['program_title'] = strip_tags($_POST['program_title']);
                $form_data['program_code'] = strip_tags($_POST['program_code']);
                $form_data['name'] = strip_tags($_POST['program_title']);
                $form_data['phone'] = strip_tags($_POST['phone']);
                $form_data['email'] = strip_tags($_POST['email']);
                $form_data['Departure_date'] = strip_tags($_POST['Departure_date']);
                $form_data['message'] = strip_tags($_POST['message']);

                if ($this->mahmoud_share->send_contact_mail_info($form_data)) {
                    //echo "yes";
                    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ' . $this->lang->line("success") . '</div>';
                } else {
                    //echo "no";
                    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ' . $this->lang->line("failed") . '</div>';
                }
            }
        }

        public function search(){

            $programs_seasons = \xss_clean($_GET['programs_seasons']);
            $programs_levels = \xss_clean($_GET['programs_levels']);
            $going_from_place = \xss_clean($_GET['going_from_place']);
            $date = date("Y-m-d", \strtotime($_GET['date']));
            $this->data['programs'] = $this->programs->GetWhereSearch($programs_seasons, $programs_levels, $going_from_place, $date);
//			echo '<pre>';
//			\print_r($this->data['programs']);
//			exit();

            $this->data['view'] = "programs_search";
            $this->load->view("main_layout", $this->data);
        }

        public function GetProgramFlightReservationPrices(){
            $prog_id = \xss_clean($_POST['program_id']);
            $flight_reservation_id = \xss_clean($_POST['flight_reservation_id']);
            $program_dates = $this->programs->GetProgramDates($prog_id, $flight_reservation_id);
            $ProgramRooms_prices = $this->programs->GetallProgramRooms_prices($prog_id, $flight_reservation_id);
            if (\count($program_dates) > 0) {
                ?>
                <div class="col-md-12">
                    <h4>السعر حسب طبيعة الدور	</h4>
                    <table class="table table-bordered table-hover">
                        <thead class="alert-success">
                            <tr>
                                    <!--<th>تاريخ الرحلة</th>-->
                                <th>المتاح طيران  </th>
                                <th>المتاح حسب طبيعة الدور </th>
                                <th>السعر حسب طبيعة الدور </th>
                                <th>  سعر الطفل  </th>
                                <th> سعر الرضيع</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $value = $program_dates[0];
                            $avaliable = $value->no_of_beds - $value->no_of_beds_reserved;
//									<td>$value->going_date</td>
                            echo "<tr>
									<td>$value->flight_available</td>
									<td>$avaliable</td>
									<td>$value->price_for_bed</td>
									<td>$value->child_price</td>
									<td>$value->infant_price</td>
								</tr>";
                            ?>

                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
            <?php
            if (\count($program_dates) > 0 && \count($ProgramRooms_prices) > 0) {
                ?>
                <div class="col-md-12">
                    <h4>سعر الفرد فى الغرفة</h4>
                    <table class="table table-bordered table-hover">
                        <thead class="alert-success">
                            <tr>
                                    <!--<th>تاريخ الرحلة</th>-->
                                <th>  نوع الغرفة</th>
                                <th>  السعر    </th>
                                <th>   المتاح</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ProgramRooms_prices as $value) {
                                if ($value->going_date == $program_dates[0]->going_date) {
                                    $avaliable = $value->number_of_rooms - $value->number_of_rooms_reserved;
//                                        <td>$value->going_date</td>
                                    echo "<tr>
                                        <td>$value->title_ar</td>
                                        <td>$value->price</td>
                                        <td>$avaliable</td>
                                </tr>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <?php
            }
        }

        public function booking(){
            //pri($this->Employee);
            $program_name = $this->uri->segment(4);
            $pieces = explode("-", $program_name);
            if (count($pieces) == 3) {
                $program_flight_id = $pieces[1];
            } else {
                $program_flight_id = '';
            }

            $program_id = end($pieces);
            $program_flight = $this->programs_flight->findById($program_flight_id);
            //pri($program_flight);

            $programs_extra_service_cards = $this->programs->programs_extra_service($program_id, 1); // card
            $programs_extra_service_person = $this->programs->programs_extra_service($program_id, 0); //persons

            $program_room_prices = $this->programs->get_program_room_prices($program_flight_id);

            $this->data['program_room_prices'] = $program_room_prices;
            //pri($programs_extra_service_person);
            $this->data['program_flight_id'] = $program_flight_id;
            $this->data['program_flight'] = $program_flight;
            $this->data['programs_extra_service_cards'] = $programs_extra_service_cards;
            $this->data['programs_extra_service_person'] = $programs_extra_service_person;
            $this->data['program_id'] = $program_id;

            $main_content = 'programs_booking';
            $this->_view($main_content);
        }

        public function test(){
            //pri($_POST);
            $errors = array();
            $room_type = $_POST['room_type']; //return array with rooms types ids (بترجع مصفوفة بانواع الغرف)
            $room_num = $_POST['room_num']; //return array with rooms num (بترجع مصفوفة بالعدد اللى اتحجز على كل غرفة)
            $program_room_prices_ids = $_POST['program_room_prices_ids']; //بترجع مصفوفة المفتاح بتاعها أى دى الغرفة والقيمة أى دى تاجدول اللى فيه سعرها
            $program_id = $_POST['program_id'];
            $programs_flight_id = $_POST['program_flight_id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $birthdate = $_POST['birthdate'];
            $adult_num = $_POST['adult_num'];
            $childs_num = $_POST['childs_num'];
            //pri($childs_num);
            $infant_num = $_POST['infant_num'];
            $travellers_names_adult = (!empty($_POST['travellers_names_adult'])) ? $_POST['travellers_names_adult'] : array();
            $travellers_names_childs = (!empty($_POST['travellers_names_childs'])) ? $_POST['travellers_names_childs'] : array();
            $travellers_names_infant = (!empty($_POST['travellers_names_infant'])) ? $_POST['travellers_names_infant'] : array();
            $travellers_gender_adult = (!empty($_POST['travellers_gender_adult'])) ? $_POST['travellers_gender_adult'] : array();
            $travellers_gender_childs = (!empty($_POST['travellers_gender_childs'])) ? $_POST['travellers_gender_childs'] : array();
            $travellers_gender_infant = (!empty($_POST['travellers_gender_infant'])) ? $_POST['travellers_gender_infant'] : array();
            $travellers_birthdates_adult = (!empty($_POST['birthdate_adult'])) ? $_POST['birthdate_adult'] : array();
            $travellers_birthdates_childs = (!empty($_POST['birthdate_childs'])) ? $_POST['birthdate_childs'] : array();
            $travellers_birthdates_infant = (!empty($_POST['birthdate_infant'])) ? $_POST['birthdate_infant'] : array();
            $travellers_names = array_merge($travellers_names_adult, $travellers_names_childs, $travellers_names_infant);
            $travellers_gender = array_merge($travellers_gender_adult, $travellers_gender_childs, $travellers_gender_infant);
            $travellers_birthdates = array_merge($travellers_birthdates_adult, $travellers_birthdates_childs, $travellers_birthdates_infant);
            //pri($room_num);
            $reservation_price = $_POST['booking_price'];
            if (isset($_POST['extra_service_for_person_ids']) && !empty($_POST['extra_service_for_person_ids'])) {
                $extra_service_for_person_ids = $_POST['extra_service_for_person_ids'];
            }
            if (isset($_POST['extra_service_for_person_num']) && !empty($_POST['extra_service_for_person_num'])) {
                $extra_service_for_person_num = $_POST['extra_service_for_person_num'];
            }
            if (isset($_POST['extra_services_for_cards']) && !empty($_POST['extra_services_for_cards'])) {
                $extra_services_for_cards = $_POST['extra_services_for_cards'];
            }


            $number_of_travellers = $adult_num + $childs_num + $infant_num; //for table reservation_limit
            $flight_traveller_number = $adult_num + $childs_num; //for table flight_reservation

            /* check rooms */
            $room_extra_test = 0;
            foreach ($room_type as $key => $value) {
                $cond_room_price['id'] = $program_room_prices_ids[$value];
                $room_price_test = $this->programs->GetWhere("programs_rooms_prices", "id", "DESC", $cond_room_price);
                if (($room_price_test[0]->number_of_rooms - $room_price_test[0]->number_of_rooms_reserved ) < $room_num[$key]) {
                    $room_extra_test = 1;
                }
            }
            if ($room_extra_test == 1) {
                $errors[] = 'لا يمكنك الحجز حيث ان عدد الغرف المتاح اقل من الغرف المختاره للحجز من فضلك قم بتحديث الصفحة ثم الحجزمن جديد';
            }
            /* end */

            /* check reservation limit */
            $reservation_limit = $this->programs->GetWhere("reservation_limit", "id", "DESC", array());
            $company_number_max = $reservation_limit[0]->number; //العدد المسوح للشركة كأفراد لحمل حجوزات
            $company_date_contarct = $reservation_limit[0]->date; //تاريخ العقد مع الشركة

            $today = date("Y-m-d");
            if ($today > $company_date_contarct) { //لازم تاريخ العقد مع الشركة يكون اكبر من تاريخ اليوم
                $errors[] = 'لا يمكنك الحجز من فضلك اتصل بالمزود من اجل تجديد تاريخ نهاية الحجز';
            }
            if ($number_of_travellers > $company_number_max) {
                $errors[] = 'لا يمكنك الحجز من فضلك اتصل بالمزود من اجل تجديد العدد';
                // pri($errors);
            }
            // pri($errors);
            /* end */
            if (empty($errors)) {
                $reservation_data['programs_id'] = $program_id;
                $reservation_data['programs_flight_id'] = $programs_flight_id;
                $reservation_data['head_booker_name'] = $username;
                $reservation_data['head_booker_phone'] = $phone;
                $reservation_data['head_booker_email'] = $email;
                $reservation_data['head_booker_address'] = $address;
                $reservation_data['head_booker_birthdate'] = $birthdate;
                $reservation_data['no_of_adults'] = $adult_num;
                $reservation_data['no_of_child'] = $childs_num;
                $reservation_data['no_of_infant'] = $infant_num;
                $reservation_data['number_of_traveller'] = $number_of_travellers;
                $reservation_data['reservation_price'] = $reservation_price;
                $reservation_data['whitelabel_id'] = $this->whitelabel_id;
                if ($this->isEmployee) {
                    $reservation_data['branches_id'] = $this->Employee->branches_id;
                    $reservation_data['departments_id'] = $this->Employee->departments_id;
                    $reservation_data['created_by'] = $this->Employee->id;
                    $reservation_data['created_by_type'] = 'employee';
                }
                if ($this->isGuest) {
                    $reservation_data['branches_id'] = 0;
                    $reservation_data['departments_id'] = 0;
                    $reservation_data['created_by'] = $this->Guest->id;
                    $reservation_data['created_by_type'] = 'guest';
                }
                $reservation_data['active'] = 1;
                $reservtion_id = $this->programs->addwithTable("reservation", $reservation_data);
                //next update column reserved_no in programs_flight table (نضيفله واحد)
                $all_reserved_rooms = 0;
                if (isset($room_type)) {
                    foreach ($room_type as $key => $value) {
                        if (empty($room_num[$key]) || $room_num[$key] == 0) {
                            continue;
                        }
                        $room_data['reservation_id'] = $reservtion_id;
                        $room_data['no_of_rooms'] = $room_num[$key];
                        $programs_rooms_prices_id_for_this = $program_room_prices_ids[$value];
                        $room_data['programs_rooms_prices_id'] = $programs_rooms_prices_id_for_this;
                        $room_data['hotel_rooms_id'] = $value;
                        $room_data['active'] = 1;
                        $all_reserved_rooms.=$room_num[$key];
                        $this->programs->addwithTable("reservation_closed_rooms", $room_data);
                        $sql_update = "update programs_rooms_prices set number_of_rooms_reserved = ( number_of_rooms_reserved + $room_num[$key] )
                                    where id = $programs_rooms_prices_id_for_this  ";
                        $query = $this->db->query($sql_update);
                    }
                }
                if (isset($extra_services_for_cards)) {

                    foreach ($extra_services_for_cards as $value) {
                        $extra_data['reservation_id'] = $reservtion_id;
                        $extra_data['extra_services_id'] = $value;
                        $extra_data['person_or_card'] = 0;
                        $extra_data['active'] = 1;
                        //$extra_data['created_by'] = $this->session->userdata("reservarion_user_id");
                        $this->programs->addwithTable("reservation_extra_services", $extra_data);
                    }
                }
                if (isset($extra_service_for_person_ids)) {
                    foreach ($extra_service_for_person_ids as $key => $value) {
                        if ($value > 0) {
                            $extra_data_person['reservation_id'] = $reservtion_id;
                            $extra_data_person['extra_services_id'] = $extra_service_for_person_ids[$key];
                            $extra_data_person['number_of_traveller'] = $extra_service_for_person_num[$key];
                            $extra_data_person['person_or_card'] = 1;
                            $extra_data_person['active'] = 1;
                            //$extra_data_person['created_by'] = $this->session->userdata("reservarion_user_id");
                            $this->programs->addwithTable("reservation_extra_services", $extra_data_person);
                        }
                    }
                }
                $flight_reservation_id = $this->programs->getFlightReservationId($programs_flight_id);
                $sql_update = "update flight_reservation set passenger_reserved = ( passenger_reserved + $flight_traveller_number )
                                    where id = $flight_reservation_id  ";
                $query = $this->db->query($sql_update);
                $sql_update = "update reservation_limit set number = ( number - $number_of_travellers )
                                    where branches_id = $this->whitelabel_id  ";
                $query = $this->db->query($sql_update);
                foreach ($travellers_names as $key => $value) {
                    $prson_data['reservation_id'] = $reservtion_id;
                    $prson_data['name'] = $value;
                    $prson_data['gender'] = $travellers_gender[$key];
                    $prson_data['birthdate'] = $travellers_birthdates[$key];
                    $this->programs->addwithTable("reservation_traveller", $prson_data);
                }
                $this->htmlmail($reservtion_id, $programs_flight_id);
                $json_data['message'] = 'تم الحجز بنجاح';
                $json_data['reservation_id'] = $reservtion_id;

                /* handle most viewed programs */
                $this->programs->handleMostViewedReservedIncrements($program_id, 'reserved');
                /* end */
                print_json('success', $json_data);
            } else {
                print_json('error', $errors);
            }
        }

        public function booking_persons_form(){
            $to_day = date("Y-m-d");
            $program_id = \xss_clean($_POST['program_id']);
            $flight_reservation_id = \xss_clean($_POST['flight_reservation_id']);
            $no_of_bed_reserved = xss_clean($_POST['no_of_beds_persons']);
            $no_of_beds_men = xss_clean($_POST['no_of_beds_men_persons']);
            $no_of_beds_weman = xss_clean($_POST['no_of_beds_weman_persons']);
            $no_of_child = xss_clean($_POST['no_of_child_persons']);
            $no_of_infant = xss_clean($_POST['no_of_infant_persons']);
            if (isset($_POST['hotel_rooms_id_persons'])) {
                $hotel_rooms_id = xss_clean($_POST['hotel_rooms_id_persons']);
                $room_closed_number = xss_clean($_POST['room_closed_number_persons']);
                $hotel_rooms_bed = xss_clean($_POST['hotel_rooms_bed_persons']);
                $programs_rooms_prices_id = xss_clean($_POST['programs_rooms_prices_id_persons']);
                $room_closed_number = xss_clean($_POST['room_closed_number_persons']);
            }
            $programs_flight_id = xss_clean($_POST['programs_flight_id']);
            $note = xss_clean($_POST['note_persons']);
            $traveller_name = xss_clean($_POST['traveller_name']);
            $traveller_gender = xss_clean($_POST['traveller_gender']);
            $traveller_birthdate = xss_clean($_POST['traveller_birthdate']);

            $number_of_traveller = $no_of_bed_reserved + $no_of_child + $no_of_infant;
            if (isset($_POST['hotel_rooms_id_persons'])) {
                if (count($room_closed_number) > 0) {
                    foreach ($room_closed_number as $key => $value) {
                        $number_of_traveller += $room_closed_number[$key] * $hotel_rooms_bed[$key];
                    }
                }
            }
            $flight_traveller_number = $number_of_traveller - $no_of_infant;

            $program_dates = $this->programs->GetProgramDates($program_id, $flight_reservation_id);
            $going_date = $program_dates[0]->going_date;
            $program_flight_count = $this->programs->GetCountprogramsFlightreservation($program_id, $flight_reservation_id);

            $reservation_limit = $this->programs->GetWhere("reservation_limit", "id", "DESC", array());
            $traveller_number_max = $reservation_limit[0]->number;
            $traveller_date_max = $reservation_limit[0]->date;

            $traveller_number_all = $_POST['traveller_number'];
            if ($traveller_number_all != $number_of_traveller) {
                echo '<li> لابد ان يكون اجمالى عدد الافراد من بالغين واطفال ورضع مساوى لعدد الاسرة وعدد الاطفال وعدد الرضع واجمالى عدد افراد الغرف </li>';
            } else if ($no_of_bed_reserved != ($no_of_beds_men + $no_of_beds_weman )) {
                echo '<li>لابد ان يكون عدد الرجال وعدد النساء مساوى لعدد حجز حسب طبيعة الدور </li>';
            } else if ($to_day > $traveller_date_max) {
                echo '<li>لا يمكنك الحجز من فضلك اتصل بالمزود من اجل تجديد تاريخ نهاية الحجز</li>';
            } else if ($traveller_number_max < $number_of_traveller) {
                echo '<li>لا يمكنك الحجز من فضلك اتصل بالمزود من اجل تجديد العدد</li>';
            } else if ($program_dates[0]->flight_available < ( $flight_traveller_number )) {
                echo '<li>عدد المسافرين اكبر من عدد المتاح طيران من فضلك راجع الحجز</li>';
            } else {
                $no_of_beds_avaliable = $program_dates[0]->no_of_beds - $program_dates[0]->no_of_beds_reserved;
                if ($no_of_bed_reserved > $no_of_beds_avaliable) {
                    echo '<li>لا يمكنك الحجز حيث ان عدد الاسره حسب طبيعة الدور اكبر من عدد السراير المتبقية لهذا البرنامج</li>';
                } else {
                    $room_extra_test = 0;
                    if (isset($_POST['hotel_rooms_id'])) {
                        foreach ($programs_rooms_prices_id as $key => $value) {
                            $cond_room_price['id'] = $programs_rooms_prices_id[$key];
                            $room_price_test = $this->programs->GetWhere("programs_rooms_prices", "id", "DESC", $cond_room_price);
                            if (($room_price_test[0]->number_of_rooms - $room_price_test[0]->number_of_rooms_reserved ) < $room_closed_number[$key]) {
                                $room_extra_test = 1;
                                break;
                            }
                        }
                    }
                    if ($room_extra_test == 1) {
                        echo '<li>لا يمكنك الحجز حيث ان عدد الغرف المتاح اقل من الغرف المختاره للحجز من فضلك قم بتحديث الصفحة ثم الحجزمن جديد</li>';
                    } else {
                        //  حفظ بيانات الحجز///
                        $reservation_data['programs_id'] = $program_id;
                        $reservation_data['flight_reservation_id'] = $flight_reservation_id;
                        $reservation_data['programs_flight_id'] = $programs_flight_id;
                        $reservation_data['groups_or_persons'] = 1;
                        $reservation_data['no_of_beds'] = $no_of_bed_reserved;
                        $reservation_data['no_of_beds_men'] = $no_of_beds_men;
                        $reservation_data['no_of_beds_weman'] = $no_of_beds_weman;
                        $reservation_data['no_of_child'] = $no_of_child;
                        $reservation_data['no_of_infant'] = $no_of_infant;
                        $reservation_data['note'] = $note;
                        $reservation_data['number_of_traveller'] = $number_of_traveller;
                        $reservation_data['active'] = 1;
                        $reservation_data['created_by'] = $this->session->userdata("reservarion_user_id");

                        $reservtion_id = $this->programs->addwithTable("reservation", $reservation_data);
                        $sql_update = "update programs_flight set no_of_beds_reserved = ( no_of_beds_reserved + $no_of_bed_reserved ) where id = $programs_flight_id  ";
                        $query = $this->db->query($sql_update);


                        $user_data = $this->get_user_data($this->session->userdata("reservarion_user_id"));
                        $branches_code = $user_data->code;
                        $program_coude = \xss_clean($_POST['program_coude']);
                        $reservation_code = $branches_code . "_" . $this->session->userdata("reservarion_user_code") . "_" . $program_coude . "_" . \date("d/m/Y", \strtotime($going_date)) . "_" . $program_flight_count . "_" . $reservtion_id;
                        $sql_update = "update reservation set reservation_code =  '$reservation_code' where id = $reservtion_id  ";
                        $query = $this->db->query($sql_update);

                        // closed room
                        if (isset($_POST['hotel_rooms_id_persons'])) {
                            if (count($room_closed_number) > 0) {
                                foreach ($room_closed_number as $key => $value) {
                                    $room_data['no_of_rooms'] = $room_closed_number_number = $room_closed_number[$key];
                                    if ($room_closed_number_number > 0) {
                                        $room_data['reservation_id'] = $reservtion_id;
                                        $programs_rooms_prices_id_for_this = $programs_rooms_prices_id[$key];
                                        $room_data['programs_rooms_prices_id'] = $programs_rooms_prices_id[$key];
                                        $room_data['hotel_rooms_id'] = $hotel_rooms_id[$key];
                                        $room_data['active'] = 1;
                                        $room_data['created_by'] = $this->session->userdata("reservarion_user_id");

                                        $this->programs->addwithTable("reservation_closed_rooms", $room_data);
                                        $sql_update = "update programs_rooms_prices set number_of_rooms_reserved = ( number_of_rooms_reserved + $room_closed_number_number )
                                    where id = $programs_rooms_prices_id_for_this  ";
                                        $query = $this->db->query($sql_update);
                                    }
                                }
                            }
                        }

                        if (isset($_POST['programs_extra_service_cards_persons'])) {
                            $programs_extra_service_cards = xss_clean($_POST['programs_extra_service_cards_persons']);
                            foreach ($programs_extra_service_cards as $value) {
                                $extra_data['reservation_id'] = $reservtion_id;
                                $extra_data['extra_services_id'] = $value;
                                $extra_data['person_or_card'] = 0;
                                $extra_data['active'] = 1;
                                $extra_data['created_by'] = $this->session->userdata("reservarion_user_id");
                                $this->programs->addwithTable("reservation_extra_services", $extra_data);
                            }
                        }
                        if (isset($_POST['programs_extra_service_cards_persons'])) {
                            $programs_extra_service_person = xss_clean($_POST['programs_extra_service_person_persons']);
                            $programs_extra_service_person_number = xss_clean($_POST['programs_extra_service_person_number_persons']);
                            foreach ($programs_extra_service_person_number as $key => $value) {
                                if ($value > 0) {
                                    $extra_data_person['reservation_id'] = $reservtion_id;
                                    $extra_data_person['extra_services_id'] = $programs_extra_service_person[$key];
                                    $extra_data_person['number_of_traveller'] = $programs_extra_service_person_number[$key];
                                    $extra_data_person['person_or_card'] = 1;
                                    $extra_data_person['active'] = 1;
                                    $extra_data_person['created_by'] = $this->session->userdata("reservarion_user_id");
                                    $this->programs->addwithTable("reservation_extra_services", $extra_data_person);
                                }
                            }
                        }

                        $sql_update = "update flight_reservation set passenger_reserved = ( passenger_reserved + $flight_traveller_number )
                                    where id = $flight_reservation_id  ";
                        $query = $this->db->query($sql_update);
                        $sql_update = "update reservation_limit set number = ( number - $number_of_traveller )
                                    where id = 1  ";
                        $query = $this->db->query($sql_update);
                        foreach ($traveller_name as $key => $value) {
                            $prson_data['reservation_id'] = $reservtion_id;
                            $prson_data['name'] = $traveller_name[$key];
                            $prson_data['gender'] = $traveller_gender[$key];
                            $prson_data['birthdate'] = $traveller_birthdate[$key];
                            $prson_data['created_by'] = $this->session->userdata("reservarion_user_id");
                            $this->programs->addwithTable("reservation_traveller", $prson_data);
                        }
                        echo $reservtion_id;
                    }
                }

//            print_r($_POST);
            }
        }

        function print_reservation2($reservation_id){
            $cond['id'] = $reservation_id;
            $this->data['reservation_detail'] = $this->programs->GetWhere("reservation", "id", "ASC", $cond);
            $prog_id = $this->data['reservation_detail'][0]->programs_id;
            $flight_reservation_id = $this->data['reservation_detail'][0]->flight_reservation_id;
            $this->data['program_detail'] = $this->programs->GetProgram($prog_id);
            $this->data['program_dates'] = $this->programs->GetProgramDates($prog_id, $flight_reservation_id);

            $cond_person['reservation_id'] = $reservation_id;
            $this->data['reservation_traveller'] = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
            $this->data['closed_room'] = $this->programs->GetclosedRoomsreservation($reservation_id);
            $this->data['reservation_extra_services_card'] = $this->programs->reservation_extra_services($reservation_id, 1);
            $this->data['reservation_extra_services_persons'] = $this->programs->reservation_extra_services($reservation_id, 0);

            $this->load->view("print_reservation", $this->data);
        }

        public function checkBirthdates(){
            //pri($_POST);
            $errors = array();
            $today_date = date('y-m-d');
            if (!empty($_POST)) {



                if (isset($_POST['birthdate_adult']) && !empty($_POST['birthdate_adult'])) {
                    $birthdate_adult = $_POST['birthdate_adult'];
                    $x = 1;
                    $adult_flag = 'birthdate_adult_';
                    foreach ($birthdate_adult as $value) {
                        $age = get_age($value, $today_date);
                        if ($age > 10) {

                        } else {
                            $birthdate_id = $adult_flag . $x;
                            $errors[$birthdate_id] = 'سن البالغ يجب أن يكون أكبر من  عشرة سنين';
                        }
                        $x++;
                    }
                }
                if (isset($_POST['birthdate_childs']) && !empty($_POST['birthdate_childs'])) {
                    $birthdate_childs = $_POST['birthdate_childs'];
                    $y = 1;
                    $childs_flag = 'birthdate_childs_';
                    foreach ($birthdate_childs as $value) {
                        $age = get_age($value, $today_date);
                        if ($age >= 2 && $age < 10) {

                        } else {
                            $birthdate_id = $childs_flag . $y;
                            $errors[$birthdate_id] = 'سن الطفل  يجب أن يكون أكبر من  سنتين وأقل من عشرة سنين ';
                        }
                        $y++;
                    }
                }
                if (isset($_POST['birthdate_infant']) && !empty($_POST['birthdate_infant'])) {
                    $birthdate_infant = $_POST['birthdate_infant'];
                    $z = 1;
                    $infant_flag = 'birthdate_infant_';
                    foreach ($birthdate_infant as $value) {
                        $age = get_age($value, $today_date);
                        if ($age < 2) {

                        } else {
                            $birthdate_id = $infant_flag . $z;
                            $errors[$birthdate_id] = 'سن الرضيع  يجب أن يكون أقل من  سنتين';
                        }
                        $z++;
                    }
                }
            }
            //pri($errors);
            if (!empty($errors)) {
                print_json('error', $errors);
            } else {
                print_json('success', 'all birthdates is correct');
            }
        }

        public function print_reservation(){
            $reservation_id = $_POST['reservation_id'];
            $program_flight_id = $_POST['program_flight_id'];

            $cond['id'] = $reservation_id;
            $this->data['reservation_detail'] = $this->programs->GetWhere("reservation", "id", "ASC", $cond);

            $prog_id = $this->data['reservation_detail'][0]->programs_id;
            $flight_reservation_id = $this->data['reservation_detail'][0]->flight_reservation_id;
            $this->data['program_detail'] = $this->programs->GetProgram($prog_id);
            $this->data['program_dates'] = $this->programs->GetProgramDates($prog_id, $flight_reservation_id);
            //pri($prog_id);
            $cond_person['reservation_id'] = $reservation_id;
            $reservation_travellers = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
            if (count($reservation_travellers) <= 6) {
                $this->data['reservation_traveller_first_table'] = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
                $this->data['page_break'] = false;
                $table_count = 1;
            } else if (count($reservation_travellers) > 6 && count($reservation_travellers) <= 12) {
                $travellers_pieces = array_chunk($reservation_travellers, ceil(count($reservation_travellers) / 2));
                $this->data['reservation_traveller_first_table'] = $travellers_pieces[0];
                $this->data['reservation_traveller_second_table'] = $travellers_pieces[1];
                $this->data['page_break'] = false;
                $table_count = 2;
            } else if (count($reservation_travellers) > 12) {
                $this->data['reservation_traveller_first_table'] = array_slice($reservation_travellers, 0, 6);
                $this->data['reservation_traveller_second_table'] = array_slice($reservation_travellers, 7, 6);
                $last_table = array_slice($reservation_travellers, 12);
                $last_tables = array_chunk($last_table, ceil(count($last_table) / 2));
                $this->data['reservation_traveller_third_table'] = $last_tables[0];
                $this->data['reservation_traveller_fourth_table'] = $last_tables[1];
                $this->data['page_break'] = true;
            }

            $this->data['closed_room'] = $this->programs->GetclosedRoomsreservation($reservation_id);
            $this->data['reservation_extra_services_card'] = $this->programs->reservation_extra_services($reservation_id, 1, $prog_id);
            $this->data['reservation_extra_services_persons'] = $this->programs->reservation_extra_services($reservation_id, 0, $prog_id);
            //pri($this->data['reservation_extra_services_persons']);
            $print_reservation = $this->load->view("main_content/print_reservation2", $this->data, true);
            echo $print_reservation;
        }

        public function print_reservation3(){
            $reservation_id = 70;
            $cond['id'] = $reservation_id;
            $this->data['reservation_detail'] = $this->programs->GetWhere("reservation", "id", "ASC", $cond);

            $prog_id = $this->data['reservation_detail'][0]->programs_id;
            $flight_reservation_id = $this->data['reservation_detail'][0]->flight_reservation_id;
            $this->data['program_detail'] = $this->programs->GetProgram($prog_id);
            $this->data['program_dates'] = $this->programs->GetProgramDates($prog_id, $flight_reservation_id);
            //pri($prog_id);
            $cond_person['reservation_id'] = $reservation_id;
            $reservation_travellers = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
            if (count($reservation_travellers) <= 6) {
                $this->data['reservation_traveller_first_table'] = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
                $this->data['page_break'] = false;
                $table_count = 1;
            } else if (count($reservation_travellers) > 6 && count($reservation_travellers) <= 12) {
                $travellers_pieces = array_chunk($reservation_travellers, ceil(count($reservation_travellers) / 2));
                $this->data['reservation_traveller_first_table'] = $travellers_pieces[0];
                $this->data['reservation_traveller_second_table'] = $travellers_pieces[1];
                $this->data['page_break'] = false;
                $table_count = 2;
            } else if (count($reservation_travellers) > 12) {
                $this->data['reservation_traveller_first_table'] = array_slice($reservation_travellers, 0, 6);
                $this->data['reservation_traveller_second_table'] = array_slice($reservation_travellers, 7, 6);
                $last_table = array_slice($reservation_travellers, 12);
                $last_tables = array_chunk($last_table, ceil(count($last_table) / 2));
                $this->data['reservation_traveller_third_table'] = $last_tables[0];
                $this->data['reservation_traveller_fourth_table'] = $last_tables[1];
                $this->data['page_break'] = true;
            }

            $this->data['closed_room'] = $this->programs->GetclosedRoomsreservation($reservation_id);
            $this->data['reservation_extra_services_card'] = $this->programs->reservation_extra_services($reservation_id, 1);
            $this->data['reservation_extra_services_persons'] = $this->programs->reservation_extra_services($reservation_id, 0);
            //pri($last_table);
            $print_reservation = $this->load->view("main_content/print_reservation2", $this->data, true);
            echo $print_reservation;
        }

        public function htmlmail($reservation_id, $programs_flight_id){
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mv-is.com',
                'smtp_port' => 587,
                'smtp_user' => 'no-reply@mv-is.com',
                'smtp_pass' => 'yQs1&y77',
                'smtp_timeout' => '4',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('no-reply@agazabook.com');
            $this->email->to('mr.success789@gmail.com');  // replace it with receiver mail id
            $this->email->subject('test agazabook'); // replace it with relevant subject


            $reservation_id = $reservation_id;
            $cond['id'] = $reservation_id;
            $this->data['reservation_detail'] = $this->programs->GetWhere("reservation", "id", "ASC", $cond);

            $prog_id = $this->data['reservation_detail'][0]->programs_id;
            $flight_reservation_id = $this->data['reservation_detail'][0]->flight_reservation_id;
            $this->data['program_detail'] = $this->programs->GetProgram($prog_id);
            $this->data['program_dates'] = $this->programs->GetProgramDates($prog_id, $flight_reservation_id);

            $cond_person['reservation_id'] = $reservation_id;
            $this->data['reservation_traveller'] = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $cond_person);
            $this->data['closed_room'] = $this->programs->GetclosedRoomsreservation($reservation_id);
            $this->data['reservation_extra_services_card'] = $this->programs->reservation_extra_services($reservation_id, 1, $programs_flight_id);
            $this->data['reservation_extra_services_persons'] = $this->programs->reservation_extra_services($reservation_id, 0, $programs_flight_id);
            $body = $this->load->view("main_content/print_reservation2", $this->data, true);
            $this->email->message($body);
            $this->email->send();
        }

        public function getCitiesLike(){
            $city_name = $_POST['city_name'];
            //pri($_POST);
            $cities = $this->programs->getCitiesLike($city_name);
            if ($cities) {
                print_json('success', $cities);
            } else {
                print_json('error', 'no result');
            }
        }

        public function getHotelsLike(){
            $hotel_name = $_POST['hotel_name'];
            //pri($_POST);
            $hotels = $this->programs->getHotelsLike($hotel_name);
            if ($hotels) {
                print_json('success', $hotels);
            } else {
                print_json('error', 'no result');
            }
        }

        public function filter(){
            //pri($_POST);
            $cities_ids = array();
            $hotels_ids = array();
            $prices = array();
            $stars = array();
            $sort = array();
            $inputs_search = array(); //only if filter happend after search from home page
            foreach ($_POST as $key => $value) {
                if (startsWith($key, 'city_id')) {
                    $cities_ids[] = $value;
                }
                if (startsWith($key, 'hotel_id')) {
                    $hotels_ids[] = $value;
                }
                if (startsWith($key, 'price_')) {
                    $prices[$key] = (int) substr($value, 3);
                }
                if (startsWith($key, 'star_')) {
                    $stars[] = $value;
                }
                if (startsWith($key, 'sort_type')) {
                    $sort[$key] = $value;
                }
                if (startsWith($key, 'sort_value')) {
                    $sort[$key] = $value;
                }
                if (startsWith($key, 'p_')) {
                    $inputs_search[$key] = $value;
                }
            }

            if (!empty($_POST['new_limit'])) {
                $new_limit = $_POST['new_limit'];
                $this->data['new_limit'] = $new_limit;
            } else {
                $new_limit = false;
                $this->data['new_limit'] = 0;
            }
            //pri($sort);
            $filter_array = compact(array("cities_ids", "hotels_ids", "prices", "stars", "sort", 'inputs_search'));
            //pri($filter_array);
            $result = $this->programs->getProgramsForFilter($this->whitelabel_id, false, $where_array = array(), $filter_array, $new_limit);
            //pri($this->db->last_query());
            $this->data['all_programs_count'] = $this->programs->getProgramsForFilterCount($this->whitelabel_id, $where_array = array(), $filter_array);
            $this->data['all_programs'] = $result;
            //pri($this->data['all_programs_count']);
            $ajax_content = $this->load->view('main_content/ajax/programs_filter', $this->data, true);
            //pri($this->data['all_programs_count']);
            echo $ajax_content;
        }

        public function morePrograms(){ //for ajax
            //pri($_POST);
            $cities_ids = array();
            $hotels_ids = array();
            $prices = array();
            $stars = array();
            $sort = array();
            $inputs_search = array(); //only if filter happend after search from home page
            foreach ($_POST as $key => $value) {
                if (startsWith($key, 'city_id')) {
                    $cities_ids[] = $value;
                }
                if (startsWith($key, 'hotel_id')) {
                    $hotels_ids[] = $value;
                }
                if (startsWith($key, 'price_')) {
                    $prices[$key] = (int) substr($value, 3);
                }
                if (startsWith($key, 'star_')) {
                    $stars[] = $value;
                }
                if (startsWith($key, 'sort_type')) {
                    $sort[$key] = $value;
                }
                if (startsWith($key, 'sort_value')) {
                    $sort[$key] = $value;
                }
                if (startsWith($key, 'p_')) {
                    $inputs_search[$key] = $value;
                }
            }
            $filter_array = compact(array("cities_ids", "hotels_ids", "prices", "stars", "sort", "inputs_search"));
            $offset = $_POST['current_length'];
            $programs = $this->programs->getProgramsForFilter($this->whitelabel_id, $offset, $where_array = array(), $filter_array);
            //pri($this->db->last_query());
            if (count($programs) > 0) {
                $this->data['all_programs'] = $programs;
                $ajax_content = $this->load->view('main_content/ajax/programs', $this->data, true);
            } else {
                $ajax_content = '';
            }

            echo $ajax_content;
        }

        public function getProgramsFlightExtraServicesPerson(){
            //pri($_POST);
            $program_id = $_POST['program_id'];
            $programs_extra_service_person = $this->programs->programs_extra_service($program_id, 0); //persons
            if ($programs_extra_service_person) {
                print_json('success', $programs_extra_service_person);
            } else {
                print_json('error', 'error');
            }
        }

        /* 	public function AddProgramPriceRoomNum(){
          $program_id = $_POST['program_id'];
          $flight_reservation_id = $_POST['flight_reservation_id'];
          $room_details = $this->programs->GetProgramPriceRoomNum($program_id, $flight_reservation_id);
          if (\count($room_details) > 0 && $room_details[0]->room_id > 0) {
          $i = 0;
          foreach ($room_details as $value) {
          if ($value->max_room_num > 0) {
          $i++;
          ?>
          <div class="col-lg-4">
          <label>  عدد  الاطفال :</label>
          <input type="number" min="0"  value="0" name="no_of_child" id="no_of_child" />
          </div>
          <div class="col-lg-4">
          <label>  عدد    :</label>
          <input type="number" min="0"  value="0" name="room_closed_number[]"   />
          </div>
          <?php
          }
          }
          if ($i == 0) {
          echo "<li>لا يوجد غرف متاحة للحجز </li>";
          }
          } else {
          echo "<li>لا يوجد غرف متاحة للحجز </li>";
          }
          } */
        /* 	public function AddProgramPriceRoomNum(){
          $program_id = $_POST['program_id'];
          $flight_reservation_id = $_POST['flight_reservation_id'];
          $room_details = $this->programs->GetProgramPriceRoomNum($program_id, $flight_reservation_id);
          if (\count($room_details) > 0 && $room_details[0]->room_id > 0) {
          $i = 0;
          foreach ($room_details as $value) {
          if ($value->max_room_num > 0) {
          $i++;
          ?>
          <div class="col-lg-4">
          <label>  عدد  الاطفال :</label>
          <input type="number" min="0"  value="0" name="no_of_child" id="no_of_child" />
          </div>
          <div class="col-lg-4">
          <label>  عدد    :</label>
          <input type="number" min="0"  value="0" name="room_closed_number[]"   />
          </div>
          <?php
          }
          }
          if ($i == 0) {
          echo "<li>لا يوجد غرف متاحة للحجز </li>";
          }
          } else {
          echo "<li>لا يوجد غرف متاحة للحجز </li>";
          }
          } */
    }
