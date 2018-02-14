<?php

    class Hotels_advantage extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Hotels_advantage_model', 'hotels_advantage');
        }

        public function index(){
            $this->data['features_image'] = $this->hotels_advantage->GetWhere("features_image", "id", "ASC", array());
            $main_content = 'hotel_advantages/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $this->data['features_image'] = $this->hotels_advantage->GetWhere("features_image", "id", "ASC", array());
            $main_content = 'hotel_advantages/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $id = $_POST['id'];
            $find = $this->hotels_advantage->find($id);

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
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['title_ar']);
                $data_array['title_en'] = xss_clean($_POST['title_en']);
                $data_array['image'] = xss_clean($_POST['image']);
                $data_array['active'] = $_POST['active'];
                $data_array['branches_id'] = $this->current_user_company->id;
                //pri($data_array);
                $add = $this->hotels_advantage->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        public function edit(){
            //pri($_POST);
            $id = $_POST['id'];
            $titles = array(
                'title_ar' => \xss_clean($_POST['title_ar']),
                'title_en' => \xss_clean($_POST['title_en']),
            );
            $this->titles_check($titles, $id);

            //pri('here');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
            $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = xss_clean($_POST['title_ar']);
                $data_array['title_en'] = xss_clean($_POST['title_en']);
                $data_array['image'] = xss_clean($_POST['image']);
                $data_array['active'] = $_POST['active'];
                $where_array['id'] = $id;
                //pri($data_array);
                $update = $this->hotels_advantage->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            $id = $_POST['id'];
            $where_array['id'] = $id;
            $deleted = $this->hotels_advantage->delete($where_array);
            if ($deleted) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,title_en,image,active"
                    )
                    //->where("user_type","admin")
                    ->from("hotels_advantage")
                    ->where("branches_id", $this->current_user_company->id);

            $this->datatables->add_column('image', function($data) {
                $back = '<img style="width: 30px;height: 30px"  class="img-responsive" src="' . base_url("theme/features_image/" . $data["image"]) . '"/>';
                return $back;
            }, 'id');
            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Hotels_advantages.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Hotels_advantages.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

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
                $find = $this->hotels_advantage->findTitle($where_array);
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
