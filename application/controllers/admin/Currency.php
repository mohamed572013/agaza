<?php

class Currency extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Currency_model', 'currency');
    }

    public function index() {
        $main_content = 'currency/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $main_content = 'currency/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        // pri($_POST);
        $id = $_POST['id'];
        $find = $this->currency->find($id);

        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        //pri($_POST);
        $titles = array(
            'title_ar' => xss_clean($_POST['title_ar']),
            'title_en' => \xss_clean($_POST['title_en']),
        );
        $this->titles_check($titles);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
        $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
        $this->form_validation->set_rules('sign', 'العلامة', 'required');
        $this->form_validation->set_rules('amount_le', 'القيمة بالجنيه المصرى', 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            //pri($array_data);
            $data_array['title_ar'] = xss_clean($_POST['title_ar']);
            $data_array['title_en'] = xss_clean($_POST['title_en']);
            $data_array['sign'] = xss_clean($_POST['sign']);
            $data_array['amount_le'] = xss_clean($_POST['amount_le']);
            $data_array['active'] = $_POST['active'];
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['updated_at'] = date("Y-m-d H:i:s");
            //pri($data_array);
            $add = $this->currency->add($data_array);
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
        $this->form_validation->set_rules('title_ar', 'العنوان بالعربية', 'required');
        $this->form_validation->set_rules('title_en', 'العنوان بالإنجليزية', 'required');
        $this->form_validation->set_rules('sign', 'العلامة', 'required');
        $this->form_validation->set_rules('amount_le', 'القيمة بالجنيه المصرى', 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            //pri($array_data);
            $data_array['title_ar'] = xss_clean($_POST['title_ar']);
            $data_array['title_en'] = xss_clean($_POST['title_en']);
            $data_array['sign'] = xss_clean($_POST['sign']);
            $data_array['amount_le'] = xss_clean($_POST['amount_le']);
            $data_array['active'] = $_POST['active'];
            $data_array['branches_id'] = $this->current_user_company->id;
            $data_array['updated_at'] = date("Y-m-d H:i:s");
            $where_array['id'] = $id;
            //pri($data_array);
            $update = $this->currency->update($data_array, $where_array);
            if ($update) {
                print_json('success', _lang('updated_successfully'));
            } else {
                print_json('error', _lang('no_affected_rows'));
            }
        }
    }

    public function delete() {
        $id = $_POST['id'];
        $where_array['id'] = $id;
        $delete = $this->currency->delete($where_array);
        if ($delete != "done") {
            if ($delete == "programs") {
                print_json('success', _lang('not_valid_there_are_currency_programs'));
            } else if ($delete == "visas") {
                print_json('success', _lang('not_valid_there_are_currency_visas'));
            } else if ($delete == "islamic_programs") {
                print_json('success', _lang('not_valid_there_are_currency_islamic_programs'));
            } else if ($delete == "maka_madina_hotels") {
                print_json('success', _lang('not_valid_there_are_currency_hotels'));
            } else if ($delete == "islamic_hotels") {
                print_json('success', _lang('not_valid_there_are_currency_islamic_hotels'));
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
                ->from("currency")
                ->where("branches_id", $this->current_user_company->id);

        $this->datatables->add_column('active', function($data) {
            return ($data['active'] == 1) ? 'نشط' : 'غير نشط';
        }, 'id');
        $this->datatables->add_column('options', function($data) {

            $back = "";
            //if( check_permission("admins", "add_update") ):

            $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Currency.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";


            $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="Currency.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

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
            $find = $this->currency->findTitle($where_array);
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
