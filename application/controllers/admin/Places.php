<?php

    class Places extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
//            $this->CheckAccess('places_controll', 'open', true);
            $this->load->model('Places_model', 'places');
        }

        public function index(){
            $segment = $this->uri->segment(4);
            $place_id = ($segment) ? $segment : '';
            $this->data['place_id'] = $place_id;
            $main_content = 'places/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $segment = $this->uri->segment(4);
            $place_id = ($segment) ? $segment : '';
            $this->data['place_id'] = $place_id;
            $main_content = 'places/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->places->findById($id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('desc_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('desc_en', "الوصف بالإنجليزية ", 'required');
            $this->form_validation->set_rules('keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
            $this->form_validation->set_rules('keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['place_image']) && $_FILES['place_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('place_image');
                    $new_path = 'uploads/places/';
                    $uploading = $this->places->do_upload('place_image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('place_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            } else {
                $message['place_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['place_id'] = \xss_clean($_POST['place_id']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['body_ar'] = \xss_clean($_POST['body_ar']);
            $data_array['body_en'] = \xss_clean($_POST['body_en']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['desc_en'] = \xss_clean($_POST['desc_en']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['keywords_en'] = \xss_clean($_POST['keywords_en']);
            $data_array['branches_id'] = $this->current_user_company->id;
            //pri($data_array);
            $add = $this->places->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit(){
            //pri($_POST);
            $id = $_POST['id'];
            $find = $this->places->findById($id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
            $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية ", 'required');
            $this->form_validation->set_rules('desc_ar', "الوصف بالعربية  ", 'required');
            $this->form_validation->set_rules('desc_en', "الوصف بالإنجليزية ", 'required');
            $this->form_validation->set_rules('keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
            $this->form_validation->set_rules('keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['place_image']) && $_FILES['place_image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('place_image');
                    $new_path = 'uploads/places/';
                    $uploading = $this->places->do_upload('place_image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('place_image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                        $image_without_prefix = substr($find->image, strpos($find->image, '_') + 1); //without s_
                        $files = array(
                            FCPATH . 'uploads/places/' . $image_original,
                            FCPATH . 'uploads/places/' . $find->image,
                            FCPATH . 'uploads/places/m_' . $image_without_prefix,
                            FCPATH . 'uploads/places/l_' . $image_without_prefix,
                        );
                        foreach ($files as $file) {
                            if (!is_dir($file)) {
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                            }
                        }
                        $image_name = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    $valid_upload = false;
                }
            }
            //pri($image_name);
            if ($valid_upload) {
                if ($image_name != "") {
                    $data_array['image'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->image)) {
                $message['place_image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['title_en'] = \xss_clean($_POST['title_en']);
            $data_array['place_id'] = \xss_clean($_POST['place_id']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['body_ar'] = \xss_clean($_POST['body_ar']);
            $data_array['body_en'] = \xss_clean($_POST['body_en']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['desc_en'] = \xss_clean($_POST['desc_en']);
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['keywords_en'] = \xss_clean($_POST['keywords_en']);
            $where['id'] = $id;
            //pri($where);
            $update = $this->places->update($data_array, $where);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $id = $_POST['id'];
            $find = $this->places->findById($id);
            $where_array['id'] = $id;
            $delete = $this->places->delete($where_array);
            if ($delete) {
                $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                $image_without_prefix = substr($find->image, strpos($find->image, '_') + 1); //without s_
                $files = array(
                    FCPATH . 'uploads/maka_madina_hotels/' . $image_original,
                    FCPATH . 'uploads/maka_madina_hotels/' . $find->image,
                    FCPATH . 'uploads/places/m_' . $image_without_prefix,
                    FCPATH . 'uploads/places/l_' . $image_without_prefix,
                );
                foreach ($files as $file) {
                    if (!is_dir($file)) {
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'no_affected_rows');
            }
        }

        public function data(){
            $CI = & get_instance();
            $this->load->library('datatables');
            $this->datatables
                    ->select('title_ar,id,image')
                    ->from("places")
                    ->where("place_id", $_GET['place_id'])
                    ->where("branches_id", $CI->current_user_company->id);



            $this->datatables->add_column('image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/places/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');
            $this->datatables->add_column('cities', function($data) {

                $back = '<a href="#" title="' . _lang("cities") . '" class="places_btn tooltips"  data-id="' . $data["id"] . '">' . _lang('cities') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Places.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Places.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function status($id = NULL, $type = null){

            $permission = $this->CheckAccessStatusDelete('places_controll', 'edit', true);
            if ($permission != 0) {
                echo 'pemision_denied';
            } else {

                if ($id):
                    $cond['id'] = $id;
                    $all_data = $this->places->GetWhere("places", "id", "ASC", $cond);

                    $this->data['all_data'] = $all_data[0];
                else:
                endif;

                if ($this->data['all_data']->active == 1) {
                    $array_data['active'] = 0;
                } else {
                    $array_data['active'] = 1;
                }
                if (isset($id)) {
                    $this->places->update($array_data, array(
                        'id' => $id
                    ));
                    echo 'yes';
                }
            }
        }

    }
