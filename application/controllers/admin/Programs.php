<?php

class Programs extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Branches_model", "branches");
        $this->load->model('Programs_model', 'programs');
        $this->load->model('Programs_slider_model', 'programs_slider');
    }

    public function index() {
        $condition['parent_id'] ; $this->_current_user->branches_id;
        $this->data['branches'] = $this->branches->GetAllPages($condition);

        $cond['branches_id'] = $this->_current_user->branches_id;
        $this->data['programs_levels'] = $this->programs->GetWhere("programs_levels", "id", "ASC", $cond);
        $this->data['currency'] = $this->programs->GetWhere("currency", "id", "ASC", $cond);
        $this->data['program_categories'] = $this->programs->GetWhere("program_categories", "id", "ASC", array(
            'branches_id' => $this->_current_user->branches_id,
            'parent_id' => 0,
        ));
        $main_content = 'programs/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $condition['parent_id'] = $this->_current_user->branches_id;
        $this->data['branches'] = $this->branches->GetAllPages($condition);

        $cond['branches_id'] = $this->_current_user->branches_id;
        $this->data['programs_levels'] = $this->programs->GetWhere("programs_levels", "id", "ASC", $cond);
        $this->data['currency'] = $this->programs->GetWhere("currency", "id", "ASC", $cond);
        $this->data['program_categories'] = $this->programs->GetWhere("program_categories", "id", "ASC", array(
            'branches_id' => $this->_current_user->branches_id,
            'parent_id' => 0,
        ));
        $main_content = 'programs/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        //pri($_POST);
        $id = $_POST['id'];
        $find = $this->programs->findById($id);
        $agazabook_find = $this->programs->findByProgramId($id);
        $find->agazabook_url = $agazabook_find->url;   
        $find->agaza_category = $agazabook_find->agaza_category;     
        $find->company_id = $agazabook_find->company_id;   
        
        //pri($find);
        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        //pri($_POST);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('agaza_this_order', "الترتيب ", 'required');
        $this->form_validation->set_rules('agaza_title_ar', "العنوان بالعربية ", 'required');
        $this->form_validation->set_rules('agaza_title_en', "العنوان بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_program_include_ar', "المحتوى بالعربية ", 'required');
        $this->form_validation->set_rules('agaza_program_include_en', "المحتوى بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_desc_ar', "الوصف بالعربية  ", 'required');
        $this->form_validation->set_rules('agaza_desc_en', "الوصف بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
        $this->form_validation->set_rules('agaza_keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
        $this->form_validation->set_rules('programs_levels', 'مستوى البرنامج', 'required');
        $this->form_validation->set_rules('maka_nights', "عدد الليالي ", 'required');
        $this->form_validation->set_rules('price_start_from', "السعر ", 'required');
        $this->form_validation->set_rules('currency_id', "العملة ", 'required');
        $this->form_validation->set_rules('parent_category_id', "تصنيف البرنامج الرئيسى ", 'required');
//            $this->form_validation->set_rules('category_id', "تصنيف البرنامج الفرعى ", 'required');
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

                        $images_names[$key] = $uploading;
                        $valid_upload = true;
                    }
                } else {
                    if ($key == 'prog_main_image') {
                        $errors['prog_main_image'] = _lang('main_image_is_required');
                    }
                }
            }
        }
        $data_array = array();
        if (empty($errors)) {
            if (!empty($images_names)) {
                $data_array['image'] = $data_array['agaza_image'] = (!empty($images_names['prog_main_image'])) ? $images_names['prog_main_image'] : '';
                $data_array['slider_image'] = (!empty($images_names['prog_slider_image'])) ? $images_names['prog_slider_image'] : '';
            }
        } else {
            print_json('error', $errors);
        }
        $data_array['title_ar'] = $data_array['agaza_title_ar'] = \xss_clean($_POST['agaza_title_ar']);
        $data_array['title_en'] = $data_array['agaza_title_en'] = \xss_clean($_POST['agaza_title_en']);
        $data_array['price_start_from'] = \xss_clean($_POST['price_start_from']);
        $data_array['maka_nights'] = \xss_clean($_POST['maka_nights']);
        $data_array['programs_levels'] = \xss_clean($_POST['programs_levels']);
        $data_array['currency_id'] = \xss_clean($_POST['currency_id']);
        $data_array['parent_category_id'] = $data_array['agaza_parent_category_id'] = \xss_clean($_POST['parent_category_id']);
        $data_array['category_id'] = $data_array['agaza_category_id'] = (isset($_POST['category_id'])) ? xss_clean($_POST['category_id']) : '';
        $data_array['this_order'] = $data_array['agaza_this_order'] = \xss_clean($_POST['agaza_this_order']);
        $data_array['program_include_ar'] = $data_array['agaza_program_include_ar'] = \xss_clean($_POST['agaza_program_include_ar']);
        $data_array['program_include_en'] = $data_array['agaza_program_include_en'] = \xss_clean($_POST['agaza_program_include_en']);
        $data_array['desc_ar'] = $data_array['agaza_desc_ar'] = \xss_clean($_POST['agaza_desc_ar']);
        $data_array['desc_en'] = $data_array['agaza_desc_en'] = \xss_clean($_POST['agaza_desc_en']);
        $data_array['keywords_ar'] = $data_array['agaza_keywords_ar'] = \xss_clean($_POST['agaza_keywords_ar']);
        $data_array['keywords_en'] = $data_array['agaza_keywords_en'] = \xss_clean($_POST['agaza_keywords_en']);
        $data_array['active'] = \xss_clean($_POST['active']);
        $data_array['stars'] = \xss_clean($_POST['stars']);
        $data_array['show_in_slider'] = \xss_clean($_POST['show_in_slider']);
		$data_array['special_offer'] = \xss_clean($_POST['special_offer']);
        $data_array['show_in_agazabook'] = 1;
        $data_array['branches_id'] = $this->current_user_company->id;
        $add = $this->programs->addWithReturn($data_array);



        // agazabook personal programs
        $agaza_data_array['program_id'] = $add;
        $agaza_data_array['branches_id'] = $this->current_user_company->id;
        $agaza_data_array['url'] = $agaza_data_array['image_url'] = $agaza_data_array['slider_url'] = base_url();
        $agaza_data_array['is_active'] = 1;
        $agaza_data_array['agaza_category'] = \xss_clean($_POST['agaza_category']);
        $agaza_data_array['created'] = date("Y-m-d h:i:s a");
        $agaza_data_array['company_id'] = xss_clean($_POST['branches_id']);
        $agaza_programs = $this->programs->addNewAgazaProgram($agaza_data_array);   
        // end




        if ($agaza_programs) {
            print_json('success', _lang('added_successfully'));
        } else {
            print_json('error', 'added_failed');
        }
    }

    public function edit() {
        //pri($_POST);
        $id = $_POST['id'];

        $find = $this->programs->findById($id);
        //pri($find);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('agaza_this_order', "الترتيب ", 'required');
        $this->form_validation->set_rules('agaza_title_ar', "العنوان بالعربية ", 'required');
        $this->form_validation->set_rules('agaza_title_en', "العنوان بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_program_include_ar', "المحتوى بالعربية ", 'required');
        $this->form_validation->set_rules('agaza_program_include_en', "المحتوى بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_desc_ar', "الوصف بالعربية  ", 'required');
        $this->form_validation->set_rules('agaza_desc_en', "الوصف بالإنجليزية ", 'required');
        $this->form_validation->set_rules('agaza_keywords_ar', "الكلمات الدلالية بالعربية  ", 'required');
        $this->form_validation->set_rules('agaza_keywords_en', "الكلمات الدلالية بالإنجليزية ", 'required');
        $this->form_validation->set_rules('programs_levels', 'مستوى البرنامج', 'required');
        $this->form_validation->set_rules('maka_nights', "عدد الليالي ", 'required');
        $this->form_validation->set_rules('price_start_from', "السعر ", 'required');
        $this->form_validation->set_rules('currency_id', "العملة ", 'required');
        $this->form_validation->set_rules('parent_category_id', "تصنيف البرنامج الرئيسى ", 'required');
//            $this->form_validation->set_rules('category_id', "تصنيف البرنامج الفرعى ", 'required');
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
                            $files[] = FCPATH . 'uploads/programs/' . $image_original;
                            $files[] = FCPATH . 'uploads/programs/' . $find->image;
                        }
                        if ($key == 'prog_slider_image') {
                            $slider_image_original = substr($find->slider_image, strrpos($find->slider_image, '_') + 1);
                            $files[] = FCPATH . 'uploads/programs_slider/' . $find->slider_image;
                            $files[] = FCPATH . 'uploads/programs_slider/' . $slider_image_original;
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
                    $data_array['image'] = $data_array['agaza_image'] = $images_names['prog_main_image'];
                }
            }
        } else {
            print_json('error', $errors);
        }
        $data_array['title_ar'] = $data_array['agaza_title_ar'] = \xss_clean($_POST['agaza_title_ar']);
        $data_array['title_en'] = $data_array['agaza_title_en'] = \xss_clean($_POST['agaza_title_en']);
        $data_array['price_start_from'] = \xss_clean($_POST['price_start_from']);
        $data_array['maka_nights'] = \xss_clean($_POST['maka_nights']);
        $data_array['programs_levels'] = \xss_clean($_POST['programs_levels']);
        $data_array['currency_id'] = \xss_clean($_POST['currency_id']);
        $data_array['parent_category_id'] = $data_array['agaza_parent_category_id'] = \xss_clean($_POST['parent_category_id']);
        $data_array['category_id'] = $data_array['agaza_category_id'] = (isset($_POST['category_id'])) ? xss_clean($_POST['category_id']) : '';
        $data_array['this_order'] = $data_array['agaza_this_order'] = \xss_clean($_POST['agaza_this_order']);
        $data_array['program_include_ar'] = $data_array['agaza_program_include_ar'] = \xss_clean($_POST['agaza_program_include_ar']);
        $data_array['program_include_en'] = $data_array['agaza_program_include_en'] = \xss_clean($_POST['agaza_program_include_en']);
        $data_array['desc_ar'] = $data_array['agaza_desc_ar'] = \xss_clean($_POST['agaza_desc_ar']);
        $data_array['desc_en'] = $data_array['agaza_desc_en'] = \xss_clean($_POST['agaza_desc_en']);
        $data_array['keywords_ar'] = $data_array['agaza_keywords_ar'] = \xss_clean($_POST['agaza_keywords_ar']);
        $data_array['keywords_en'] = $data_array['agaza_keywords_en'] = \xss_clean($_POST['agaza_keywords_en']);
        $data_array['active'] = \xss_clean($_POST['active']);
        $data_array['stars'] = \xss_clean($_POST['stars']);
        $data_array['show_in_slider'] = \xss_clean($_POST['show_in_slider']);
		$data_array['special_offer'] = \xss_clean($_POST['special_offer']);
        $data_array['show_in_agazabook'] = 1;
        $data_array['branches_id'] = $this->current_user_company->id;
        $where_array['id'] = $id;
        $update = $this->programs->update($data_array, $where_array);


        $agaza_data_array['agaza_category'] = \xss_clean($_POST['agaza_category']);
        $agaza_data_array['company_id'] = xss_clean($_POST['branches_id']);
        $edit_agaza = $this->programs->editAgazaProgram($id, $agaza_data_array);


        if ($update || $edit_agaza) {
            print_json('success', _lang('updated_successfully'));
        } else {
            print_json('error', 'no_affected_rows');
        }
    }

    public function delete() {
        $id = $_POST['id'];
        $find = $this->programs->findById($id);
        $where_array['id'] = $id;
        $delete = $this->programs->delete($where_array);
        if ($delete != "done") {
            if ($delete == "reservations") {
                print_json('success', _lang('not_valid_there_are_programs_reservations'));
            } else if ($delete == "programs_advantages") {
                print_json('success', _lang('not_valid_there_are_programs_advantages'));
            } else if ($delete == "programs_cities") {
                print_json('success', _lang('not_valid_there_are_programs_cities'));
            } else if ($delete == "programs_extra_service") {
                print_json('success', _lang('not_valid_there_are_programs_extra_service'));
            } else if ($delete == "programs_flight") {
                print_json('success', _lang('not_valid_there_are_programs_flight'));
            } else if ($delete == "data") {
                print_json('success', "error");
            }
        } else {
            $image_original = substr($find->image, strrpos($find->image, '_') + 1);
            $slider_image_original = substr($find->slider_image, strrpos($find->slider_image, '_') + 1);
            $files = array(
                FCPATH . 'uploads/programs/' . $image_original,
                FCPATH . 'uploads/programs/' . $find->image,
                FCPATH . 'uploads/programs_slider/' . $find->slider_image,
                FCPATH . 'uploads/programs_slider/' . $slider_image_original,
            );
            foreach ($files as $file) {
                if (!is_dir($file)) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
            $this->programs->deleteExistingAgazaProgram($id); 

            print_json('success', _lang('deleted_successfully'));
        }
    }

    function data() {
        $CI = & get_instance();
        $this->load->library('datatables');
        $this->datatables
                ->select('agaza_programs.program_id as agazabook_program_id, agaza_programs.branches_id as agazabook_branches_id, agaza_programs.url as agazabook_url, agaza_programs.created as agazabook_created, programs.title_ar,programs.image,programs.id,branches.title_ar as branche_title')
                ->from("agaza_programs")
                ->join("programs", "agaza_programs.program_id=programs.id")
                ->join("branches", "agaza_programs.company_id=branches.id")
                ->where("agaza_programs.branches_id", $CI->current_user_company->id);
                //->where("agaza_programs.is_active", 1)
                



        $this->datatables->add_column('image', function($data) {
            $back = '<img src="' . $data['agazabook_url'] . 'uploads/programs/' . $data['image'] . '" style="height:64px;width:64px;"/>';
            return $back;
        }, 'id');
        $this->datatables->add_column('images', function($data) {

            $back = '<a href="#" title="' . _lang("gallery") . '" class="tooltips" onclick="Programs.add_images(this);return false;" data-id="' . $data["id"] . '">' . _lang('gallery') . '</a>';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {
            $back = "";
            //if( check_permission("admins", "add_update") ):

            $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Programs.edit_programs(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";


            //if($CI->current_user_company->id == $data['branches_id']) {

                $back .= '<a href="#"
                    title="' . _lang("delete") . '"
                    class="tooltips"
                    data-id="' . $data["id"] . '"
                    onclick="Programs.delete_programs(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
            //}
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
        //pri($find);
        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'no images');
        }
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

}
