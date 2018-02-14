<?php

    class Programs_flight extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_flight_model', 'programs_flight');
        }

        public function show($Programs = ""){
            $cond_pro['id'] = $Programs;
            $this->data['Programs'] = $this->programs_flight->GetWhere("programs", "id", "ASC", $cond_pro);

            $this->data['page_list'] = $this->programs_flight->GetAllFlightPrograms($Programs);
            $this->view('admin/programs_flight/view');
        }

        public function add($Programs = ""){
            $Programs = \xss_clean($Programs);


            $cond['active'] = 1;
            $cond['id'] = $Programs;
            $this->data['Programs'] = $this->programs_flight->GetWhere("programs", "id", "ASC", $cond);
            $flights_where['flight_reservation.branches_id'] = $this->_current_user->branches_id;
            $flights_where['flight_reservation.active'] = 1;
            $this->data['flights'] = $this->programs_flight->GetAllFlight($flights_where);

            if (\count($_POST) > 0) {



                $this->form_validation->set_rules('flight_reservation_id', " رحلة الطيران", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['flight_reservation_id'] = \xss_clean($_POST['flight_reservation_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_flight->GetWhere("programs_flight", "id", "ASC", $cond_test);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {

                        $array_data['flight_reservation_id'] = \xss_clean($_POST['flight_reservation_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];
                        $array_data['child_price'] = \xss_clean($_POST['child_price']);
                        $array_data['infant_price'] = \xss_clean($_POST['infant_price']);
                        $array_data['created_by'] = $this->_login_data['user_id'];
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_flight->add($array_data);
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_flight/show/$programs_id"));
                    }
                }
            }

            $this->view('admin/programs_flight/form');
        }

        public function edit($id = ""){



            $cond['active'] = 1;
            $this->data['Programs'] = $this->programs_flight->GetWhere("programs", "id", "ASC", $cond);
            $flights_where['flight_reservation.branches_id'] = $this->_current_user->branches_id;
            $flights_where['flight_reservation.active'] = 1;
            $this->data['flights'] = $this->programs_flight->GetAllFlight($flights_where);

            $id = \intval($id);
            if ($id < 0) {
                \redirect(\base_url('admin/programs_flight/show'));
            }

            if (!empty($_POST)) {
                $this->form_validation->set_rules('flight_reservation_id', " رحلة الطيران", 'required');
                $this->form_validation->set_rules('programs_id', "البرنامج", 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['error'] = validation_errors();
                } else {
                    $cond_test['flight_reservation_id'] = \xss_clean($_POST['flight_reservation_id']);
                    $cond_test['programs_id'] = $_POST['programs_id'];
                    $test = $this->programs_flight->GetWherenotId("programs_flight", "id", "ASC", $cond_test, $id);
                    if (\count($test) > 0 && $test[0]->id > 0) {
                        $this->data['error'] = "<li>هذه البيانات موجوده بالفعل</li>";
                    } else {
                        $array_data['flight_reservation_id'] = \xss_clean($_POST['flight_reservation_id']);
                        $array_data['programs_id'] = $_POST['programs_id'];

                        $array_data['child_price'] = \xss_clean($_POST['child_price']);
                        $array_data['infant_price'] = \xss_clean($_POST['infant_price']);
                        $array_data['active'] = \xss_clean($_POST['active']);

                        $this->programs_flight->update($array_data, array(
                            'id' => $id
                        ));
                        $programs_id = $_POST['programs_id'];

                        \redirect(\base_url("admin/programs_flight/show/$programs_id"));
                    }
                }
            }

            $edit = $this->programs_flight->Getpages(array(
                'id' => $id
            ));

            $this->data['edit'] = $edit[0];

            $this->view("admin/programs_flight/form");
        }

        public function delete($id = "", $programs_id = ""){

            $cond['programs_flight_id'] = $id;
            $test_2 = $this->programs_flight->GetWhere("reservation", "id", "ASC", $cond);
            if (count($test_2) > 0 && $test_2[0]->id > 0) {
                echo 'no';
            } else {
                $this->db->where("id", $id);
                $this->db->delete("programs_flight");
                echo 'yes';
            }
        }

        public function status($id = NULL, $programs_id = ""){
            if ($id):
                $cond['id'] = $id;
                $all_data = $this->programs_flight->GetWhere("programs_flight", "id", "ASC", $cond);

                $this->data['all_data'] = $all_data[0];
            else:
            endif;

            if ($this->data['all_data']->active == 1) {
                $array_data['active'] = 0;
            } else {
                $array_data['active'] = 1;
            }
            if (isset($id)) {
                $this->programs_flight->update($array_data, array(
                    'id' => $id
                ));
                echo 'yes';
            }
        }

    }
