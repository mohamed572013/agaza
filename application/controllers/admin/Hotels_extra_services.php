<?php

    class Hotels_extra_services extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Hotel_extra_services_model', 'hotel_extra_service');
            $this->load->model('Hotels_extra_services_model', 'hotels_extra_services');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function index(){
            $all_hotels = $this->hotel_prices->allHotels($this->current_user_company->id);
            //pri($hotel_extra_services);
            $this->data['all_hotels'] = $all_hotels;
            $main_content = 'hotel_prices/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $all_hotels = $this->hotel_prices->allHotels($this->current_user_company->id);
            //pri($hotel_extra_services);
            $this->data['all_hotels'] = $all_hotels;
            $main_content = 'hotel_prices/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $hotels_extra_services_id = $_POST['hotels_extra_services_id'];
            $find = $this->hotels_extra_services->find($hotels_extra_services_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $hotel_id = $_POST['hotel_id'];
            $extra_service_id = $_POST['extra_service_id'];
            $check = $this->hotels_extra_services->check_added_before($hotel_id, $extra_service_id, false);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            //pri('stop');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('extra_service_id', 'خدمة', 'required');
            $this->form_validation->set_rules('price_for_adult', 'السعر بالنسبة للبالغين', 'required');
            $this->form_validation->set_rules('price_for_child', 'السعر بالنسبة للأطفال', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_services_id'] = $_POST['extra_service_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['price_for_adult'] = $_POST['price_for_adult'];
                $data_array['price_for_child'] = $_POST['price_for_child'];
                //$data_array['branches_id'] = $this->current_user_company->id;
                //pri($where_array);
                $add = $this->hotels_extra_services->add($data_array);
                if ($add) {
                    print_json('success', 'تمت الأضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $hotels_extra_services_id = $_POST['hotels_extra_services_id'];
            $hotel_id = $_POST['hotel_id'];
            $extra_service_id = $_POST['extra_service_id'];
            $check = $this->hotels_extra_services->check_added_before($hotel_id, $extra_service_id, $hotels_extra_services_id);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            //pri('stop');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('extra_service_id', 'خدمة', 'required');
            $this->form_validation->set_rules('price_for_adult', 'السعر بالنسبة للبالغين', 'required');
            $this->form_validation->set_rules('price_for_child', 'السعر بالنسبة للأطفال', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_services_id'] = $_POST['extra_service_id'];
                $data_array['price_for_adult'] = $_POST['price_for_adult'];
                $data_array['price_for_child'] = $_POST['price_for_child'];
                $where_array['id'] = $hotels_extra_services_id;
                $update = $this->hotels_extra_services->update($data_array, $where_array);
                if ($update) {
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $hotels_extra_services_id = $_POST['hotels_extra_services_id'];
            $where_array['id'] = $hotels_extra_services_id;
            $delete = $this->hotels_extra_services->delete($where_array);
            ;
            if ($delete) {
                print_json('success', 'تم الحذف بنجاح');
            } else {
                print_json('error', 'error');
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
                    ->select("hotels_extra_services.id as hotels_extra_services_id,hotels_extra_services.price_for_adult,"
                            . "hotels_extra_services.price_for_child,hotel_extra_services.title_ar"
                    )
                    //->where("user_type","admin")
                    ->from("hotels_extra_services")
                    ->join("hotel_extra_services", 'hotels_extra_services.hotel_services_id=hotel_extra_services.id')
                    ->where($key, $value);

//            $this->datatables->add_column('hotel_services_id', function($data) {
//                $ci = & get_instance();
//                return $ci->hotel_extra_service->find($this->current_user_company->id, $data['hotel_services_id'])->title_ar;
//            }, 'hotel_services_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Hotel_data.edit_extra_services(this);return false;" data-id="' . $data["hotels_extra_services_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Hotel_data.delete_extra_services(this);return false;" data-id="' . $data["hotels_extra_services_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'hotels_extra_services_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
