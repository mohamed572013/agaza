<?php

    class Hotel_extra_services extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Hotel_extra_services_model', 'hotel_extra_services');
        }

        public function index(){
            $main_content = 'hotel_extra_services/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'hotel_extra_services/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $id = $_POST['id'];
            $find = $this->hotel_extra_services->find($id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $titles = array(
                'title_ar' => xss_clean($_POST['title_ar']),
                'title_en' => \xss_clean($_POST['title_en']),
            );
            $this->titles_check($titles);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            $this->form_validation->set_rules('room_or_person', 'نوع الخدمة', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = $_POST['title_ar'];
                $data_array['title_en'] = $_POST['title_en'];
                $data_array['active'] = $_POST['active'];
                $data_array['room_or_person'] = $_POST['room_or_person'];
                $data_array['branches_id'] = $this->current_user_company->id;
                //pri($data_array);
                $add = $this->hotel_extra_services->add($data_array);
                if ($add) {
                    print_json('success', 'تم الإضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $id = $_POST['id'];
            $titles = array(
                'title_ar' => \xss_clean($_POST['title_ar']),
                'title_en' => \xss_clean($_POST['title_en']),
            );
            $this->titles_check($titles, $id);
            $find = $this->hotel_extra_services->find($id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            $this->form_validation->set_rules('room_or_person', 'نوع الخدمة', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = $_POST['title_ar'];
                $data_array['title_en'] = $_POST['title_en'];
                $data_array['active'] = $_POST['active'];
                $data_array['room_or_person'] = $_POST['room_or_person'];
                $where_array['id'] = $id;
                //pri($where_array);
                $update = $this->hotel_extra_services->update($data_array, $where_array);
                if ($update) {
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', \_lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $id = $_POST['id'];
            $where_array['id'] = $id;
            $delete = $this->hotel_extra_services->delete($where_array);
            if ($delete) {
                print_json('success', 'تم الحذف بنجاح');
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,title_en,active,room_or_person"
                    )
                    //->where("user_type","admin")
                    ->from("hotel_extra_services")
                    ->where("branches_id", $this->current_user_company->id);

            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('room_or_person', function($data) {
                return ($data['room_or_person'] == 1) ? 'غرفة' : 'فرد';
            }, 'id');


            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Hotel_extra_services.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Hotel_extra_services.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function titles_check($titles = array(), $id = false){
            $errors = array();


            foreach ($titles as $key => $title) {
                $where_array = array(
                    'branches_id' => $this->current_user_company->id,
                    $key => $title
                );
                if ($id) {
                    $where_array['id !='] = $id;
                }
                $where_array[$key] = $title;
                $find = $this->hotel_extra_services->findTitle($where_array);
                //pri($find);
                if ($find) {
                    $errors[$key] = _lang('added_before');
                }
            }

            if (!empty($errors)) {
                print_json('error', $errors);
            }
            return true;
        }

    }
