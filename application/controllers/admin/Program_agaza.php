<?php

class Program_agaza extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Programs_model', 'programs');
        $this->load->model('Hotels_model', 'hotels');
        $this->load->model('Programs_slider_model', 'programs_slider');
        $this->config->load('whitelabels');
        $whitelabels_config = $this->config->item('whitelabels'); 
    }

    public function index() {

        $countries = $this->hotels->places($this->current_user_company->id);
        $this->data['countries'] = $countries;
        $main_content = 'programs_agaza/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $countries = $this->hotels->places($this->current_user_company->id);

        $this->data['countries'] = $countries;
      
        $main_content = 'programs_agaza/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        //pri($_POST);
        $id = $_POST['id'];
        $find = $this->programs->findById($id);
        $agazabook_find = $this->programs->findByProgramId($id);
        $find->agazabook_url = $agazabook_find->url;  
        $find->image_url = $agazabook_find->image_url;  
        $find->country_id = $agazabook_find->country_id;
        $find->places_id = $agazabook_find->places_id;
        //pri($find);
        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    

    public function edit() {
        //pri($_POST);
        $id = $_POST['id'];

        $find = $this->programs->findById($id);
        $agazabook_find = $this->programs->findByProgramId($id);
        $find->agazabook_url = $agazabook_find->url;  
        //pri($find);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
        $this->form_validation->set_rules('title_ar', "العنوان بالعربية ", 'required');
        $this->form_validation->set_rules('title_en', "العنوان بالإنجليزية ", 'required');
        $this->form_validation->set_rules('program_include_ar', "المحتوى بالعربية ", 'required');
        $this->form_validation->set_rules('program_include_en', "المحتوى بالإنجليزية ", 'required');
        $this->form_validation->set_rules('desc_ar', "الوصف بالعربية  ", 'required');
        $this->form_validation->set_rules('desc_en', "الوصف بالإنجليزية ", 'required');
        $this->form_validation->set_rules('keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
        $this->form_validation->set_rules('keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
        $this->form_validation->set_rules('country_id', "إسم الدولة", 'required');
        $this->form_validation->set_rules('places_id', "إسم المدينة", 'required');
        
        $errors = array();
        $images_names = array();
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            foreach ($_FILES as $key => $value) {
                if (isset($_FILES[$key]) && $_FILES[$key]['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item($key);
                    if ($key == 'prog_main_image') {
                        $new_path = 'uploads/programs/';
                    }
                    if ($key == 'prog_slider_image') {
                        $new_path = 'uploads/programs_slider/';
                    }
                    $uploading = $this->programs->do_upload($key, $config, $new_path, $key);

                    if (!$uploading) {
                        $errors[$key] = $this->upload->display_errors();
                        //print_json('error', $errors);
                    } else {

                        if ($key == 'prog_main_image') {
                            $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                            $files[] = $find->agazabook_url . '/uploads/programs/' . $image_original;
                            $files[] = FCPATH . 'uploads/programs/' . $find->image;
                            $this->programs->editImageURL($id, base_url());
                        }
                        if ($key == 'prog_slider_image') {
                            $slider_image_original = substr($find->slider_image, strrpos($find->slider_image, '_') + 1);
                            $files[] = FCPATH . 'uploads/programs_slider/' . $find->slider_image;
                            $files[] =  $find->agazabook_url . '/uploads/programs_slider/' . $slider_image_original;
                        }
                        foreach ($files as $file) {
                            if (!is_dir($file)) {
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                            }
                        }
                        $images_names[$key] = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    if ($key == 'prog_main_image') {
                        if (empty($find->image)) {
                            $errors['prog_main_image'] = _lang('main_image_is_required');
                        }
                    }
                }
            }
        }
        $data_array = array();
        if (empty($errors)) {
            if (!empty($images_names)) {
                if (!empty($images_names['prog_slider_image'])) {
                    $data_array['slider_image'] = $images_names['prog_slider_image'];
                }
                if (!empty($images_names['prog_main_image'])) {
                    $data_array['agaza_image'] = $images_names['prog_main_image'];

                }
            }
        } else {
            print_json('error', $errors);
        }
        $data_array['agaza_title_ar'] = \xss_clean($_POST['title_ar']);
        $data_array['agaza_title_en'] = \xss_clean($_POST['title_en']);        
        $data_array['agaza_this_order'] = \xss_clean($_POST['this_order']);
        $data_array['agaza_program_include_ar'] = \xss_clean($_POST['program_include_ar']);
        $data_array['agaza_program_include_en'] = \xss_clean($_POST['program_include_en']);
        $data_array['agaza_desc_ar'] = \xss_clean($_POST['desc_ar']);
        $data_array['agaza_desc_en'] = \xss_clean($_POST['desc_en']);
        $data_array['agaza_keywords_ar'] = \xss_clean($_POST['keywords_ar']);
        $data_array['agaza_keywords_en'] = \xss_clean($_POST['keywords_en']);
        $data_array['agaza_category'] = \xss_clean($_POST['agaza_category']);

        
        $where_array['id'] = $id;
        
        $update = $this->programs->update($data_array, $where_array);



        // edit in agaza programs
        $update_data = array();
        $update_data['agaza_category'] = \xss_clean($_POST['agaza_category']);
        $update_data['country_id'] = xss_clean($_POST['country_id']);
        $update_data['places_id'] = xss_clean($_POST['places_id']);
        $agaza_update = $this->programs->editAgazaProgram($id, $update_data);
        // end



        
        //pri($agaza_category);
        

        if ($update || $agaza_update) {
            print_json('success', _lang('updated_successfully'));
        } else {
            print_json('error', 'no_affected_rows');
        }
    }

  
    function data() {
        $CI = & get_instance();
        $this->load->library('datatables');
        $this->datatables
                ->select('agaza_programs.program_id as agazabook_program_id, agaza_programs.branches_id as agazabook_branches_id, agaza_programs.image_url as agazabook_url, agaza_programs.created as agazabook_created, programs.agaza_title_ar as title_ar,programs.agaza_image as image,programs.id,branches.title_ar as branche_title,agaza_programs.is_active')
                ->from("agaza_programs")
                ->join("programs", "agaza_programs.program_id=programs.id")
                ->join("branches", "agaza_programs.branches_id=branches.id")
                ->join('programs_flight', 'programs_flight.programs_id = programs.id')
                ->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id')
                ->where('flight_reservation.going_date >=', date("Y-m-d"))
                ->where("agaza_programs.branches_id <>", $CI->current_user_company->id);
                //->where("agaza_programs.is_active", 1)                

        $this->datatables->add_column('image', function($data) {
            $back = '<img src="' . $data['agazabook_url'] . '/uploads/programs/' . $data['image'] . '" style="height:64px;width:64px;"/>';
            return $back;
        }, 'id');
        $this->datatables->add_column('images', function($data) {

            $back = '<a href="#" title="' . _lang("gallery") . '" class="tooltips" onclick="Programs.add_images(this);return false;" data-id="' . $data["id"] . '">' . _lang('gallery') . '</a>';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {
            $back = "";
            $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Programs.edit_programs(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";

            $result = ($data['is_active'])?"checked":"";

            $back .= "<input ".$result." type='checkbox'  value='' onclick='Programs.activate_programs(this);return false;' data-id=".$data['id']." data-status=". $data['is_active'] ." >";

            
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

    public function listFiles() {
        //pri($_POST);
        $where_array['programs_id'] = $_POST['program_id'];
        $find = $this->programs_slider->GetAll($where_array);
        $agazabook_find = $this->programs->findByProgramId($_POST['program_id']);
       // pri($agazabook_find);
        $agaza_find = new stdClass;
        $agaza_find->agazabook_url = $agazabook_find->url;  
        $agaza_find->image_url = $agazabook_find->image_url;  
        $agaza_find->slider_url = $agazabook_find->slider_url;
        //$find['agazabook_fields'] = $agaza_find;

        $data['find'] = $find;
        $data['agazabook_fields'] = $agazabook_find;
        
        if ($find) {
            print_json('success', $data);
        } else {
            print_json('error', 'no images');
        }
    }

    public function activate() {
        $status = $_POST['status'];
        $program_id = $_POST['id'];                
        if($status == 0) {
            $array_data['is_active'] = 1;    
        } else {
            $array_data['is_active'] = 0;
        }
        
        $data = $this->programs->activateProgram($program_id, $array_data);
        print_json("success", $data);
    }

    public function add_images() {
        //pri($_FILES);
        $program_id = $_POST['program_id'];
        //$errors = array();
        $errors = 0;
        $images_names = array();
        if (!empty($_FILES['file'])) {
            $this->config->load('files');
            $config = $this->config->item('prog_slider_image');
            $files = $_FILES;
            $number_of_files = count($_FILES['file']['name']);
            //pri($number_of_files);
            for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['file']['name'] = $files['file']['name'][$i];
                $_FILES['file']['type'] = $files['file']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['file']['error'][$i];
                $_FILES['file']['size'] = $files['file']['size'][$i];
                $uploading = $this->programs_slider->do_upload('file', $config, 'uploads/programs_slider/');
                if (!$uploading) {
                    $errors++;
                } else {
                    $images_names[] = $uploading;
                }
            }

            if ($errors > 0) {
                //pri($errors);
                $message = _lang('there_is_number');
                $message .= ' ';
                $message .= $errors;
                $message .= ' ';
                $message .= _lang('file');
                $message .= ' ';
                $message .= _lang('not_uploaded');
                print_json('error', $message);
            } else {
                //pri($images_names);
                foreach ($images_names as $image) {
                    $data_array['programs_id'] = $program_id;
                    //$data_array['image'] = $image;
                    $data_array['image'] = $image;
                    $add = $this->programs_slider->add($data_array);
                }
                print_json('success', \_lang('added_successfully'));
            }
        } else {
            print_json('error', _lang('no_file_to_upload'));
        }
    }

    public function remove_image() {
        //pri($_POST);
        $image_id = $_POST['image_id'];
        $image_name = $_POST['image'];
        $where_array['id'] = $image_id;
        $delete = $this->programs_slider->delete($where_array);
        if ($delete) {
            $image_original = substr($image_name, strrpos($image_name, '_') + 1);
            $files = array(
                FCPATH . 'uploads/programs_slider/' . $image_name,
                FCPATH . 'uploads/programs_slider/' . $image_original,
            );
            foreach ($files as $file) {
                if (!is_dir($file)) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
            print_json('success', 'deleted');
        } else {
            print_json('error', 'no deleted');
        }
    }

    function getSubCategoriesForEdit() {
        $selected_id = $_POST['selected_id'];
        $cond['parent_id'] = $_POST['parent_category_id'];
        $str = '<option disabled="disabled">اختر</option>';
        $sub = $this->programs->GetWhere('program_categories', 'id', "ASC", $cond);
        if (count($sub) > 0) {
            foreach ($sub as $one) {
                if ($one->id == $selected_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $str .= '<option ' . $selected . ' value=' . $one->id . '>' . $one->title_en . " - " . $one->title_ar . '</option>';
            }
        }

        echo $str;
    }

    function getSubCategories() {
        //pri($_POST);
        $cond['parent_id'] = $_POST['parent_category_id'];
        $str = '<option disabled="disabled" selected>اختر</option>';
        $sub = $this->programs->GetWhere('program_categories', 'id', "ASC", $cond);
        if (count($sub) > 0) {
            foreach ($sub as $one) {
                $str .= '<option value=' . $one->id . '>' . $one->title_en . " - " . $one->title_ar . '</option>';
            }
        }

        echo $str;
    }


    function getCityRegions(){
            $cond['place_id'] = $_POST['city_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $regions = $this->haj_umrah_hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($regions) > 0) {
                foreach ($regions as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function getPlaces(){
            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['place_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $cities = $this->hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $c) {
                    if ($c->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $c->id . '>' . $c->title_ar . '</option>';
                }
            }

            echo $str;
        }


         function getCountryCities(){
            //pri($_POST);
            $cond['place_id'] = $_POST['country_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $places = $this->hotels->GetWhere('places', 'id', "ASC", $cond);
            if (count($places) > 0) {
                foreach ($places as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

}
