<?php

    class Hotels_rooms extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
            $this->load->model('Hotel_rooms_model', 'hotel_rooms');
            $this->load->model('Hotels_rooms_model', 'hotels_rooms');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            //pri($_POST);
            $hotels_rooms_id = $_POST['hotels_rooms_id'];
            $find = $this->hotels_rooms->find($this->current_user_company->id, $hotels_rooms_id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            $hotel_id = $_POST['hotel_id'];
            $hotel_rooms_id = $_POST['room_id'];
            $check = $this->hotels_rooms->check_added_before($hotel_id, $hotel_rooms_id, false);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('room_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('number_of_child_extra', 'عدد الأطفال', 'required');
            $this->form_validation->set_rules('number_of_infant_extra', 'عدد الرضع', 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_rooms_id'] = $_POST['room_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['number_of_child_extra'] = $_POST['number_of_child_extra'];
                $data_array['number_of_infant_extra'] = $_POST['number_of_infant_extra'];
                //$data_array['branches_id'] = $this->current_user_company->id;
                //pri($where_array);
                $add = $this->hotels_rooms->add($data_array);
                if ($add) {
                    print_json('success', 'تمت الأضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $hotel_id = $_POST['hotel_id'];
            $hotel_rooms_id = $_POST['room_id'];
            $hotels_rooms_id = $_POST['hotels_rooms_id'];
            $check = $this->hotels_rooms->check_added_before($hotel_id, $hotel_rooms_id, $hotels_rooms_id);
            if ($check) {
                print_json('error', _lang('added_before'));
            }


            $this->load->library('form_validation');
            $this->form_validation->set_rules('room_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('number_of_child_extra', 'عدد الأطفال', 'required');
            $this->form_validation->set_rules('number_of_infant_extra', 'عدد الرضع', 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_rooms_id'] = $_POST['room_id'];
                $data_array['number_of_child_extra'] = $_POST['number_of_child_extra'];
                $data_array['number_of_infant_extra'] = $_POST['number_of_infant_extra'];
                $where_array['id'] = $hotels_rooms_id;
                $update = $this->hotels_rooms->update($data_array, $where_array);
                if ($update) {
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $hotels_rooms_id = $_POST['hotels_rooms_id'];
            $where_array['id'] = $hotels_rooms_id;
            $delete = $this->hotels_rooms->delete($where_array);
            ;
            if ($delete) {
                print_json('success', 'تم الحذف بنجاح');
            } else {
                print_json('error', 'تم الحذف بنجاح');
            }
        }

        function data($hotel_id){
            $key = '';
            $value = '';
            if ($hotel_id == 'all') {
                $key = 'hotel_id !=';
                $value = 0;
            } else {
                $key = 'hotel_id';
                $value = $hotel_id;
            }
            //pri($this->db->select('*')->from('hotels_rooms')->get()->result());
            $this->load->library('datatables');
            $this->datatables
                    ->select("hotels_rooms.number_of_child_extra,hotels_rooms.number_of_infant_extra,hotels_rooms.id as hotels_rooms_id,"
                            . "hotel_rooms.title_ar")
                    //->where("user_type","admin")
                    ->from("hotels_rooms")
                    ->join('hotel_rooms', 'hotel_rooms.id=hotels_rooms.hotel_rooms_id')
                    ->where($key, $value);

            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Hotel_data.edit_rooms(this);return false;" data-id="' . $data["hotels_rooms_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Hotel_data.delete_rooms(this);return false;" data-id="' . $data["hotels_rooms_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'hotels_rooms_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function check_added_before($hotel_id, $hotels_rooms_id){
            $check = $this->hotels_rooms->check_added_before($hotel_id, $hotels_rooms_id);
        }

    }
