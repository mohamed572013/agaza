<?php

class Program_categories extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Program_categories_model', 'program_categories');
    }

    public function index() {
        $main_content = 'program_categories/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $main_content = 'program_categories/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        // pri($_POST);
        $id = $_POST['id'];
        $find = $this->program_categories->find($id);

        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
//        pri($_POST);
        $titles = array(
            'title_ar' => xss_clean($_POST['title_ar']),
            'title_en' => \xss_clean($_POST['title_en']),
        );
        $this->titles_check($titles);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title_ar', 'العنوان', 'required');
        $this->form_validation->set_rules('title_en', 'العنوان', 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
//            pri($array_data);
            $data_array['title_ar'] = xss_clean($_POST['title_ar']);
            $data_array['title_en'] = xss_clean($_POST['title_en']);
            $data_array['parent_id'] = xss_clean($_POST['parent_id']);
            $data_array['hotels_required'] = xss_clean($_POST['hotels_required']);
            $data_array['active'] = $_POST['active'];
            $data_array['branches_id'] = $this->current_user_company->id;
//            pri($data_array);
            $add = $this->program_categories->add($data_array);
            if ($add) {
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'error');
            }
        }
    }

    public function edit() {
        $id = $_POST['id'];
        //pri($id);
        $titles = array(
            'title_ar' => \xss_clean($_POST['title_ar']),
            'title_en' => \xss_clean($_POST['title_en']),
        );
        $this->titles_check($titles, $id);

        //pri('here');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title_ar', 'العنوان', 'required');
        $this->form_validation->set_rules('title_en', 'العنوان', 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            //pri($array_data);
            $data_array['title_ar'] = xss_clean($_POST['title_ar']);
            $data_array['title_en'] = xss_clean($_POST['title_en']);
            $data_array['hotels_required'] = xss_clean($_POST['hotels_required']);
            $data_array['active'] = $_POST['active'];
            $where_array['id'] = $id;
            //pri($data_array);
            $update = $this->program_categories->update($data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', _lang('no_affected_rows'));
            }
        }
    }

    public function delete() {
        $id = $_POST['id'];
        $parent_id = $_POST['parent'];
        $where_array['id'] = $id;
        $where_array['parent'] = $parent_id;
        $delete = $this->program_categories->delete($where_array);
        if ($delete != "done") {
            if ($delete == "program_categories") {
                print_json('success', _lang('not_valid_there_are_program_categories'));
            } else if ($delete == "programs") {
                print_json('success', _lang('not_valid_there_are_programs'));
            } else if ($delete == "data") {
                print_json('success', "error");
            }
        } else {
            print_json('success', _lang('deleted_successfully'));
        }
    }

    function data() {

        $this->load->library('datatables');
        $this->datatables
                ->select("*"
                )
                //->where("user_type","admin")
                ->from("program_categories")
                ->where("parent_id", $_GET['parent_id'])
                ->where("branches_id", $this->current_user_company->id);

        $this->datatables->add_column('active', function($data) {
            return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
        }, 'id');
        $this->datatables->add_column('sub', function($data) {

            $back = '<a href="#" title="' . _lang("sub") . '" class="sub_btn tooltips"  data-id="' . $data["id"] . '">' . _lang('sub') . '</a>';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {

            $back = "";
            //if( check_permission("admins", "add_update") ):

            $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Program_categories.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";


            $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                data-parent="' . $data["parent_id"] . '"
                onclick="Program_categories.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

            //endif;
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

    public function titles_check($titles = array(), $id = false) {
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
            $find = $this->program_categories->findTitle($where_array);
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
