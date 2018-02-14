<?php

    class Programs_rooms_prices extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_rooms_prices_model', 'programs_rooms_prices');
        }

        public function show($programs_flight_id = ""){
            $this->data['Programs'] = $this->programs_rooms_prices->GetProgFlightsWhere($programs_flight_id);
            $branches_id = $this->current_user_company->id;
            $this->data['page_list'] = $this->programs_rooms_prices->GetallProgramRooms_prices($programs_flight_id, $branches_id);
            $this->view('admin/programs_rooms_prices/view');
        }

        public function add($programs_flight_id = ""){
            $programs_flight_id = \xss_clean($programs_flight_id);


            $cond['active'] = 1;
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['is_deleted'] = 0;
            $this->data['hotel_rooms'] = $this->programs_rooms_prices->GetWhere("hotel_rooms", "id", "ASC", $cond);
            $this->data['Programs'] = $this->programs_rooms_prices->GetProgFlightsWhere($programs_flight_id);
            if (\count($_POST) > 0) {



                $hotel_rooms_id = $this->_lang['hotel_rooms'];
                $this->form_validation->set_rules('hotel_rooms_id', "$hotel_rooms_id", 'required');
                $this->form_validation->set_rules('programs_flight_id', "البرنامج", 'required');
                $this->form_validation->set_rules('number_of_rooms', "عدد الغرف", 'required');
                $this->form_validation->set_rules('price', "السعر", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['hotel_rooms_id'] = \xss_clean($_POST['hotel_rooms_id']);
                    $cond_test['programs_flight_id'] = $_POST['programs_flight_id'];
                    $test = $this->programs_rooms_prices->GetWhere("programs_rooms_prices", "id", "ASC", $cond_test);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {

                        $array_data['hotel_rooms_id'] = \xss_clean($_POST['hotel_rooms_id']);
                        $array_data['programs_flight_id'] = $_POST['programs_flight_id'];
                        $array_data['number_of_rooms'] = $_POST['number_of_rooms'];
                        $array_data['price'] = $_POST['price'];
                        $array_data['branches_id'] = $this->current_user_company->id;
                        $array_data['created_by'] = $this->_login_data['user_id'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_rooms_prices->add($array_data);
                        $programs_flight_id = $_POST['programs_flight_id'];

                        \redirect(\base_url("admin/programs_rooms_prices/show/$programs_flight_id"));
                    }
                }
            }

            $this->view('admin/programs_rooms_prices/form');
        }

        public function edit($id = "", $programs_flight_id = ""){



            $cond['active'] = 1;
            $this->data['hotel_rooms'] = $this->programs_rooms_prices->GetWhere("hotel_rooms", "id", "ASC", $cond);
            $this->data['Programs'] = $this->programs_rooms_prices->GetProgFlightsWhere($programs_flight_id);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_rooms_prices/show'));
            }

            if (!empty($_POST)) {
                $hotel_rooms_id = $this->_lang['hotel_rooms'];
                $this->form_validation->set_rules('hotel_rooms_id', "$hotel_rooms_id", 'required');
                $this->form_validation->set_rules('programs_flight_id', "البرنامج", 'required');
                $this->form_validation->set_rules('number_of_rooms', "عدد الغرف", 'required');
                $this->form_validation->set_rules('price', "السعر", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['hotel_rooms_id'] = \xss_clean($_POST['hotel_rooms_id']);
                    $cond_test['programs_flight_id'] = $_POST['programs_flight_id'];
                    $test = $this->programs_rooms_prices->GetWherenotId("programs_rooms_prices", "id", "ASC", $cond_test, $id);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {


                        $array_data['hotel_rooms_id'] = \xss_clean($_POST['hotel_rooms_id']);
                        $array_data['programs_flight_id'] = $_POST['programs_flight_id'];
                        $array_data['price'] = $_POST['price'];
                        $array_data['number_of_rooms'] = $_POST['number_of_rooms'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_rooms_prices->update($array_data, array(
                            'id' => $id
                        ));
                        $programs_flight_id = $_POST['programs_flight_id'];

                        \redirect(\base_url("admin/programs_rooms_prices/show/$programs_flight_id"));
                    }
                }
            }

            $edit = $this->programs_rooms_prices->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_rooms_prices/form");
        }

        public function delete($id = "", $programs_flight_id = ""){

            $id = \intval($id);
            $cond['programs_rooms_prices_id'] = $id;
            $test_2 = $this->programs_rooms_prices->GetWhere("reservation_closed_rooms", "id", "ASC", $cond);
            if (count($test_2) > 0 && $test_2[0]->id > 0) {
                echo 'no';
            } else {
                $this->db->where("id", $id);
                $this->db->delete("programs_rooms_prices");
                echo 'yes';
            }
        }

        public function status($id = NULL, $programs_flight_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_rooms_prices->GetWhere("programs_rooms_prices", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_rooms_prices->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

    }
