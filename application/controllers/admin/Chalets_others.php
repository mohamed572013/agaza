<?php

    class Chalets_others extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Chalet_other_model', 'chalet_other');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function index(){
            $main_content = 'chalets_others/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $main_content = 'chalets_others/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $chalets_others_id = $_POST['chalets_others_id'];
            $find = $this->chalet_other->find($chalets_others_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', 'العنوان', 'required|callback_title_ar_check');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = $_POST['title_ar'];
                if (!empty($_POST['active'])) {
                    $data_array['active'] = $_POST['active'];
                }
                $data_array['branches_id'] = $this->current_user_company->id;
                $data_array['created_by'] = $this->_current_user->user_id;
                //pri($where_array);
                $add = $this->chalet_other->add($data_array);
                if ($add) {
                    print_json('success', 'تم الإضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $chalets_others_id = $_POST['chalets_others_id'];
            $find = $this->chalet_other->find($chalets_others_id);
            //pri($_POST['title_ar']);
            //pri(trim($_POST['title_ar']));
            $this->load->library('form_validation');
            if ($find->title_ar == trim($_POST['title_ar'])) {
                $this->form_validation->set_rules('title_ar', 'العنوان', 'required');
            } else {
                $this->form_validation->set_rules('title_ar', 'العنوان', 'required|callback_title_ar_check');
            }
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['title_ar'] = $_POST['title_ar'];
                if (!empty($_POST['active'])) {
                    $data_array['active'] = $_POST['active'];
                }
                $where_array['id'] = $chalets_others_id;
                $update = $this->chalet_other->update($data_array, $where_array);
                if ($update) {
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $chalets_others_id = $_POST['chalets_others_id'];
            $where_array['id'] = $chalets_others_id;
            $delete = $this->chalet_other->delete($where_array);
            if ($delete) {
                print_json('success', 'تم الحذف بنجاح');
            } else {
                print_json('error', 'error');
            }
        }

        public function delete2(){
            //pri($_POST);
            $chalets_others_id = $_POST['chalets_others_id'];
            $where_array['id'] = $chalets_others_id;
            $tables_related = array('hotels_chalets_others_prices');
            $ok_delete = true;
            if (!empty($tables_related)) {
                foreach ($tables_related as $table) {
                    $test = $this->chalet_other->findForDelete($chalets_others_id, $table);
                    if ($test) {
                        $ok_delete = false;
                    }
                }
            }
            if ($ok_delete) {
                $delete = $this->chalet_other->delete($where_array);
                if ($delete) {
                    print_json('success', 'تم الحذف بنجاح');
                } else {
                    print_json('error', 'error');
                }
            } else {
                print_json('error', 'لا يمكن حذف العنصر لإرتباطه بعناصر اخرى');
            }
        }

        function data(){
            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    //->where("user_type","admin")
                    ->from("chalets_others")
                    ->where("branches_id", $this->current_user_company->id);

            $this->datatables->add_column('active', function($data) {
                return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Chalets_others.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Chalets_others.delete(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function title_ar_check($title_ar){
            $where_array['branches_id'] = $this->current_user_company->id;
            $find = $this->chalet_other->findByTitle(trim($title_ar), $where_array);
            if ($find) {
                $this->form_validation->set_message('title_ar_check', 'تمت اضافته من قبل');
                return FALSE;
            } else {
                return TRUE;
            }
        }

    }
