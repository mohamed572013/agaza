<?php

    class Haj_umrah_hotels_slider extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            //$this->CheckAccess('programs', 'open', true);
            $this->load->model('Programs_model', 'programs');
            $this->load->model('Haj_umrah_hotels_model', 'haj_umrah_hotels');
            if ($this->_settings->site_language == "arabic") {
                $this->config->set_item('language', 'arabic');
            } else {
                $this->config->set_item('language', 'english');
            }
        }

        public function index(){

            $main_content = 'haj_umrah_hotels/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $cond_maka['maka_or_madina'] = 0; //maka
            $cond_madina['maka_or_madina'] = 1; //madina
            $cond_active['active'] = 1; //active

            $this->data['maka_hotels'] = $this->haj_umrah_programs->GetWhere("maka_madina_hotels", "id", "ASC", $cond_active);
            $this->data['madina_hotels'] = $this->haj_umrah_programs->GetWhere("maka_madina_hotels", "id", "ASC", $cond_active);
            $this->data['branches'] = $this->haj_umrah_programs->GetWhere("branches", "id", "ASC", $cond_active);
//            $this->data['programs_seasons'] = $this->programs->GetWhere("programs_seasons", "id", "ASC", $cond_active);
            $this->data['programs_levels'] = $this->haj_umrah_programs->GetWhere("programs_levels", "id", "ASC", $cond_active);
            $this->data['programs_advantage'] = $this->haj_umrah_programs->GetWhere("programs_advantage", "id", "ASC", $cond_active);
            $this->data['flights'] = $this->haj_umrah_programs->GetAllFlight();
            $programs_where['branches_id'] = $this->_current_user->branches_id;
            $programs_where['active'] = 1;
            $this->data['page_list'] = $this->programs->GetWhere("programs", "id", "ASC", $programs_where);
            $main_content = 'haj_umrah_programs/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $find = $this->haj_umrah_programs->findById($haj_umrah_program_id);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_FILES);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "الاسم لدينا", 'required');
            $this->form_validation->set_rules('programs_levels', $this->_lang['programs_levels'], 'required');
            $this->form_validation->set_rules('this_order', $this->_lang['this_order'], 'required');
            $this->form_validation->set_rules('price_start_from', "السعر يبدا من", 'required');
            $this->form_validation->set_rules('program_include', $this->_lang['program_include'], 'required');
            $this->form_validation->set_rules('program_not_include', $this->_lang['program_not_include'], 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['program_image']) && $_FILES['program_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('program_image');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('program_image')) {
                        $errors = array('program_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                        $valid_upload = true;
                    }
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            }
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            //$data_array['programs_seasons'] = \xss_clean($_POST['programs_seasons']);
            $data_array['programs_levels'] = \xss_clean($_POST['programs_levels']);
            $data_array['price_start_from'] = \xss_clean($_POST['price_start_from']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['special_offer'] = \xss_clean($_POST['special_offer']);
            $data_array['program_view_in_home'] = \xss_clean($_POST['program_view_in_home']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['program_include'] = \xss_clean($_POST['program_include']);
            $data_array['program_not_include'] = \xss_clean($_POST['program_not_include']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['departments_id'] = $this->current_user_branch->id;
            $add = $this->haj_umrah_programs->addWithReturn($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function edit(){
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $haj_umrah_program = $this->haj_umrah_programs->findById($haj_umrah_program_id);
            //pri($haj_umrah_program_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title_ar', "الاسم لدينا", 'required');
            $this->form_validation->set_rules('programs_levels', $this->_lang['programs_levels'], 'required');
            $this->form_validation->set_rules('this_order', $this->_lang['this_order'], 'required');
            $this->form_validation->set_rules('price_start_from', "السعر يبدا من", 'required');
            $this->form_validation->set_rules('program_include', $this->_lang['program_include'], 'required');
            $this->form_validation->set_rules('program_not_include', $this->_lang['program_not_include'], 'required');
            $valid_upload = true;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['program_image']) && $_FILES['program_image']['name'] != "") {
                    //pri('here');
                    $this->config->load('files');
                    $config = $this->config->item('program_image');

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('program_image')) {
                        $errors = array('program_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {

                        $upload_data = $this->upload->data();
                        $image_name = $upload_data['file_name'];
                        $valid_upload = true;
                    }
                }

                if (empty($_FILES['program_image']['name']) && empty($haj_umrah_program->image)) {
                    $errors = array('program_image' => 'من فضلك أدخل صورة البرنامج');
                    print_json('error', $errors);
                }
            }
            //pri('stop');
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            }
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            //$data_array['programs_seasons'] = \xss_clean($_POST['programs_seasons']);
            $data_array['programs_levels'] = \xss_clean($_POST['programs_levels']);
            $data_array['price_start_from'] = \xss_clean($_POST['price_start_from']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['special_offer'] = \xss_clean($_POST['special_offer']);
            $data_array['program_view_in_home'] = \xss_clean($_POST['program_view_in_home']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['program_include'] = \xss_clean($_POST['program_include']);
            $data_array['program_not_include'] = \xss_clean($_POST['program_not_include']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $where_array['id'] = $haj_umrah_program_id;
            $update = $this->haj_umrah_programs->updateByTableName('haj_umrah_programs', $data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $where_array['id'] = $haj_umrah_program_id;
            $delete = $this->haj_umrah_programs->delete2($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete2($id = ""){

            $permission = $this->CheckAccessStatusDelete('programs', 'delete', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {

                $cond['programs_id'] = $id;
                $test = $this->programs->GetWhere("programs_advantage_all", "id", "ASC", $cond);
                $test_1 = $this->programs->GetWhere("programs_extra_service", "id", "ASC", $cond);
                $test_2 = $this->programs->GetWhere("programs_flight", "id", "ASC", $cond);
                //$test_3 = $this->programs->GetWhere("programs_rooms_prices", "id", "ASC", $cond);
                $test_4 = $this->programs->GetWhere("programs_slider", "id", "ASC", $cond);
                pri('ssss');
                if ((count($test) > 0 && $test[0]->id > 0 ) || (count($test_1) > 0 && $test_1[0]->id > 0 ) || (count($test_2) > 0 && $test_2[0]->id > 0 ) || (count($test_3) > 0 && $test_3[0]->id > 0 ) || (count($test_4) > 0 && $test_4[0]->id > 0 )) {
                    echo 'no';
                } else {
                    $this->db->where("id", $id);
                    $this->db->delete("programs");
                    echo 'yes';
                }
            }
        }

        public function deleteDate($id = ""){

            $id = $_POST['id'];
            $this->db->where("id", $id);
            $this->db->delete("programs_dates");
            echo 'yes';
        }

        public function status($id = NULL){
            $permission = $this->CheckAccessStatusDelete('programs', 'edit', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {
                if ($id):
                    $cond['id'] = $id;
                    $all_data = $this->programs->GetWhere("programs", "id", "ASC", $cond);

                    $this->data['all_data'] = $all_data[0];
                else:
                endif;

                if ($this->data['all_data']->active == 1) {
                    $array_data['active'] = 0;
                } else {
                    $array_data['active'] = 1;
                }
                if (isset($id)) {
                    $this->programs->update($array_data, array(
                        'id' => $id
                    ));
                    echo 'yes';
                }
//			\redirect(\base_url("admin/programs/show"));
            }
        }

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $cities = $this->programs->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                $str = "";
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    ->from("haj_umrah_hotels")
                    ->where("active", 1)
                    ->where("branches_id", $this->current_user_company->id);



            $this->datatables->add_column('images', function($data) {
                $back = '<a href="" class="hotel-data-box" data-type="hotels_images" data-id="' . $data["id"] . '">' . _lang('hotels_images') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit_room_classes") . '" class="tooltips" onclick="Haj_umrah_programs.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-1-8x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("remove_room_classes") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Haj_umrah_programs.delete(this);return false;"><i class="fa fa-times fa-1-8x text-danger"></i></a>';

                //endif;
                return $back;
//                $back = "";
//                $back .='<a class="btn btn-xs  ls-green-btn fa fa-file-image-o"  target="_blank" data-placement="top"  href="' . base_url('admin/programs_slider/show') . '/' . $data['id'] . '" title="صور البرامج"></a>';
//                $back .='<a class = "btn btn-xs  ls-red-btn fa  fa-fighter-jet" target = "_blank" data-placement = "top" href = "' . base_url('admin/programs_flight/show') . '/' . $data['id'] . '" title = "رحلات الطيران"></a>';
//                $back .='<a class = "btn btn-xs  ls-green-btn fa fa-cogs" target = "_blank" data-placement = "top" href = "' . base_url('admin/programs_advantage_all/show') . '/' . $data['id'] . '" title = "مميزات البرنامج"></a>';
//                $back .='<a class = "btn btn-xs  ls-light-green-btn fa fa-asterisk " target = "_blank" data-placement = "top" href = "' . base_url('admin/programs_extra_service/show') . '/' . $data['id'] . '" title = "الخدمات الاضافية"></a>';
//                $back .='<a class = "btn btn-xs btn-warning" title = "' . _lang('edit') . '" href = "' . base_url('admin/haj_umrah_programs/edit') . '/' . $data['id'] . '"><i class = "fa fa-pencil-square-o"></i> </a>';
//
//
//                $back .='<a class = "btn btn-xxl " title = "' . $lang['state'] . '">';
//                $back .='<input id = "users_controll_show" title = "' . $lang['state'] . '" name = "group_options" type = "checkbox" class = "js-switch " value=""   onclick="" ></a>';
//                $back .='<a class = "btn btn-xs btn-danger" title = "' . $lang['delete'] . '" ><i class = "fa fa-trash-o"></i> </a >';
//
//                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
