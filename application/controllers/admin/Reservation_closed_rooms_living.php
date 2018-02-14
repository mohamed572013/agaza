<?php

    class Reservation_closed_rooms_living extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('reservation', 'edit', true);
            $this->load->model('Reservation_closed_rooms_living_model', 'reservation_closed_rooms_living');
        }

        public function show($reservation_id = 0){
            $this->data['RoomLivingTravellers'] = $this->reservation_closed_rooms_living->GetRoomLivingTravellers($reservation_id);
            $this->data['RoomLiving'] = $this->reservation_closed_rooms_living->GetRoomLiving($reservation_id);

            $this->data['traveller_not_living'] = $this->reservation_closed_rooms_living->GetNotLivingPersons($reservation_id);
            $this->data['traveller_rooms_not_living'] = $this->reservation_closed_rooms_living->GetRoomsNotLivingPersons($reservation_id);
            //pri($this->data['traveller_rooms_not_living']);
            $this->data['page_list'] = array();
            $this->view('admin/reservation_closed_rooms_living/view');
        }

        public function DeleteLiving($id = ""){
            $cond_room['operation_number'] = $id;
            $hotel_room_details = $this->reservation_closed_rooms_living->GetWhere("reservation_closed_rooms_living", "id", "ASC", $cond_room);

            $reservation_id = $hotel_room_details[0]->reservation_id;
            $hotel_rooms_id = $hotel_room_details[0]->hotel_rooms_id;


            $this->db->where("operation_number", $id);
            if ($this->db->delete("reservation_closed_rooms_living")) {

                echo "yes";
                $sql = "UPDATE `reservation_closed_rooms` SET no_of_rooms_living = (no_of_rooms_living - 1 )
								WHERE reservation_id = $reservation_id AND hotel_rooms_id = $hotel_rooms_id";
                $query = $this->db->query($sql);
            } else {
                echo 'no';
            }
        }

        public function DeleteRoom($id = ""){
            $cond_room['operation_number'] = $id;
            $hotel_room_details = $this->reservation_closed_rooms_living->GetWhere("reservation_closed_rooms_living", "id", "ASC", $cond_room);

            $reservation_id = $hotel_room_details[0]->reservation_id;
            $hotel_rooms_id = $hotel_room_details[0]->hotel_rooms_id;

            $cond_resv['id'] = $reservation_id;
            $reservation_details = $this->reservation_closed_rooms_living->GetWhere("reservation", "id", "ASC", $cond_resv);
            $flight_reservation_id = $reservation_details[0]->flight_reservation_id;


            $cond_clos_room['reservation_id'] = $reservation_id;
            $cond_clos_room['hotel_rooms_id'] = $hotel_rooms_id;
            $reservation_clos_room = $this->reservation_closed_rooms_living->GetWhere("reservation_closed_rooms", "id", "ASC", $cond_clos_room);
            $reservation_clos_room_id = $reservation_clos_room[0]->id;
            $reservation_clos_no_of_rooms = $reservation_clos_room[0]->no_of_rooms;


            if ($id) {

                if ($reservation_clos_no_of_rooms == 1) {
                    $this->db->where("id", $reservation_clos_room_id);
                    $this->db->delete("reservation_closed_rooms");
                } else {
                    $sql = "UPDATE `reservation_closed_rooms` SET no_of_rooms_living = (no_of_rooms_living - 1 ) ,no_of_rooms = (no_of_rooms - 1 )
								WHERE reservation_id = $reservation_id AND hotel_rooms_id = $hotel_rooms_id";
                    $this->db->query($sql);
                }
                $adults = 0;
                $children = 0;
                $infants = 0;
                $travellersInfo = $this->reservation_closed_rooms_living->GetRoomOperationTravellerInfo($id);

                foreach ($travellersInfo as $value) {
                    $today = date("Y-m-d");
                    $date1 = date_create($value->birthdate);
                    $date2 = date_create($today);
                    $diff = date_diff($date1, $date2);
                    $years = $diff->format("%Y");
                    if ($years < 2) {
                        $infants++;
                    } elseif ($years < 12) {
                        $children++;
                    } else {
                        $adults++;
                    }


                    $this->db->where("id", $value->id);
                    $this->db->delete("reservation_traveller");
                }


                $all_travellers = $adults + $children + $infants;
                $flight_travellers = $adults + $children;
                $sql = "UPDATE `reservation` SET number_of_traveller = (number_of_traveller - $all_travellers ) ,  no_of_adults = (no_of_adults - $adults ) ,"
                        . " no_of_child = (no_of_child - $children ) , no_of_infant = (no_of_infant - $infants ) "
                        . " WHERE id = $reservation_id  ";
                $this->db->query($sql);
                $sql = "UPDATE `flight_reservation` SET passenger_reserved = (passenger_reserved - $flight_travellers )  "
                        . " WHERE id = $flight_reservation_id  ";
                $this->db->query($sql);

                $this->db->where("operation_number", $id);
                $this->db->delete("reservation_closed_rooms_living");

                echo "yes";
            } else {
                echo 'no';
            }
        }

        public function reservation_room_living(){
            //pri($_POST);
            $reservation_id = \xss_clean($_POST['reservation_id']);
            $hotel_rooms_id = \xss_clean($_POST['hotel_rooms_id']);
            $allTravellersVals = \xss_clean($_POST['allTravellersVals']);
            $adults = 0;
            $children = 0;
            $infants = 0;

            $cond_room['id'] = $hotel_rooms_id;
            $hotel_room_details = $this->reservation_closed_rooms_living->GetWhere("hotel_rooms", "id", "ASC", $cond_room);
            $no_of_beds = $hotel_room_details[0]->no_of_bed;

            $cond['reservation_id'] = $reservation_id;
            $cond['hotel_rooms_id'] = $hotel_rooms_id;
            $test_room_available = $this->reservation_closed_rooms_living->GetWhere("reservation_closed_rooms", "id", "ASC", $cond);
            if (\count($test_room_available) > 0) {
                if ($test_room_available[0]->no_of_rooms_living >= $test_room_available[0]->no_of_rooms) {
                    echo 'لقد تم تسكين الغرفة لهذه الاستمارة من قبل';
                    exit();
                } else {
                    $testTravellersliving = $this->reservation_closed_rooms_living->TestTravellersliving($reservation_id, $allTravellersVals);
                    if (\count($testTravellersliving) > 0 && $testTravellersliving[0]->id > 0) {
                        echo 'يوجد مسافرين تم تسكينهم من قبل من فضلك قم بتحديث الصفحة بالضغط على F5';
                        exit();
                    } else {
                        $travellersInfo = $this->reservation_closed_rooms_living->GetTravellerInfo($reservation_id, $allTravellersVals);
                        foreach ($travellersInfo as $value) {
                            $today = date("Y-m-d");
                            $date1 = date_create($value->birthdate);
                            $date2 = date_create($today);
                            $diff = date_diff($date1, $date2);
                            $years = $diff->format("%Y");
                            if ($years < 2) {
                                $infants++;
                            } elseif ($years < 12) {
                                $children++;
                            } else {
                                $adults++;
                            }
                        }
                        //pri($adults);
                        if ($adults > $no_of_beds || $adults != $no_of_beds) {
                            echo 'لا يمكنك التسكين حيث ان عدد البالغين   غير مساوى  عدد الاسره للغرفة ';
                            exit();
                        } else {
                            $operation_number = $this->reservation_closed_rooms_living->GetOperationNumber();
                            $array_data['operation_number'] = $operation_number;
                            $array_data['reservation_id'] = $reservation_id;
                            $array_data['hotel_rooms_id'] = $hotel_rooms_id;
                            $array_data['created_by'] = $this->_login_data['user_id'];
                            foreach ($travellersInfo as $value) {
                                $array_data['reservation_traveller_id'] = $value->id;
                                $this->reservation_closed_rooms_living->add($array_data);
                            }
                            $sql = "UPDATE `reservation_closed_rooms` SET no_of_rooms_living = (no_of_rooms_living + 1 )
								WHERE reservation_id = $reservation_id AND hotel_rooms_id = $hotel_rooms_id";
                            $query = $this->db->query($sql);

                            echo '1';
                        }
                    }
                }
            } else {
                echo 'لقد تم حذف الغرفة لهذه الاستمارة';
            }
        }

    }
