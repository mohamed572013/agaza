<?php

class Header_images extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Header_image_model', 'header_image');
    }

    public function show() {
        $all_pages = $this->header_image->get_pages();
        $pages_array = null;
        if ($all_pages) {
            foreach ($all_pages as $value) {
                $pages_array[] = $value->page;
            }
        }
        $this->data['pages_array'] = $pages_array;
        $main_content = 'headers/index';
        $this->_view($main_content, 'admin');
    }

    public function index() {
        $all_pages = $this->header_image->get_pages();
        $pages_array = null;
        if ($all_pages) {
            foreach ($all_pages as $value) {
                $pages_array[] = $value->page;
            }
        }
        $this->data['pages_array'] = $pages_array;
        $main_content = 'headers/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {


        $id = $_POST['id'];
        $find = $this->header_image->find($id);

        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_title_ar', _lang('first_title_ar'), 'required');
        $this->form_validation->set_rules('second_title_ar', _lang('second_title_ar'), 'required');
        $this->form_validation->set_rules('page', _lang('page'), 'required|is_unique[header_images.page]');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if (isset($_FILES['header_image']) && $_FILES['header_image']['name'] != "") {

                $this->config->load('files');
                $config = $this->config->item('header_image');
                $new_path = 'uploads/headers/';
                $uploading = $this->header_image->do_upload('header_image', $config, $new_path);

                if (!$uploading) {
                    $errors = array('header_image' => $this->upload->display_errors());
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
                $data['header_image'] = $image_name;
            }
        } else {
            $message['header_image'] = _lang('no_file_to_upload');
            print_json('error', $message);
        }
        $data['first_title_ar'] = trim(xss_clean($_POST['first_title_ar']));
        $data['second_title_ar'] = trim(xss_clean($_POST['second_title_ar']));
        $data['page'] = trim(xss_clean($_POST['page']));
        $data['branches_id'] = $this->current_user_company->id;
        $add = $this->header_image->add($data);
        if ($add) {
            print_json('success', _lang('added_successfully'));
        } else {
            print_json('error', 'error');
        }
    }

    public function edit() {
        $id = $_POST['id'];
        $find = $this->header_image->find($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_title_ar', _lang('first_title_ar'), 'required');
        $this->form_validation->set_rules('second_title_ar', _lang('second_title_ar'), 'required');
        $this->form_validation->set_rules('page', _lang('page'), 'required|is_unique[header_images.page]');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if (isset($_FILES['header_image']) && $_FILES['header_image']['name'] != "") {

                $this->config->load('files');
                $config = $this->config->item('header_image');
                $new_path = 'uploads/headers/';
                $uploading = $this->header_image->do_upload('header_image', $config, $new_path);

                if (!$uploading) {
                    $errors = array('header_image' => $this->upload->display_errors());
                    print_json('error', $errors);
                } else {
                    $image_original = substr($find->header_image, strrpos($find->header_image, '_') + 1);
                    $image_without_prefix = substr($find->header_image, strpos($find->header_image, '_') + 1); //without s_
                    $files = array(
                        FCPATH . 'uploads/headers/' . $image_original,
                        FCPATH . 'uploads/headers/s_' . $image_without_prefix,
                        FCPATH . 'uploads/headers/m_' . $image_without_prefix,
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
        if ($valid_upload) {
            if ($image_name != "") {
                $data['header_image'] = $image_name;
            }
        } else if (!$valid_upload && empty($find->header_image)) {
            $message['header_image'] = _lang('no_file_to_upload');
            print_json('error', $message);
        }
        $data['first_title_ar'] = trim(xss_clean($_POST['first_title_ar']));
        $data['second_title_ar'] = trim(xss_clean($_POST['second_title_ar']));
        $data['page'] = trim(xss_clean($_POST['page']));
        $data['branches_id'] = $this->current_user_company->id;
        $where_array['id'] = $id;
        $update = $this->header_image->update($data, $where_array);
        if ($update) {
            print_json('success', _lang('updated_successfully'));
        } else {
            print_json('error', _lang('no_affected_rows'));
        }
    }

    public function delete() {
        $id = $_POST['id'];
        $find = $this->header_image->find($id);
        $deleted = $this->header_image->delete(array('id' => $id));
        if ($deleted) {
            $image_original = substr($find->header_image, strrpos($find->header_image, '_') + 1);
            $image_without_prefix = substr($find->header_image, strpos($find->header_image, '_') + 1); //without s_

            $files = array(
                FCPATH . 'uploads/headers/' . $image_original,
                FCPATH . 'uploads/headers/s_' . $image_without_prefix,
                FCPATH . 'uploads/headers/l_' . $image_without_prefix,
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

    function data() {

        $this->load->library('datatables');
        $this->datatables
                ->select("id,first_title_ar,second_title_ar,page,header_image as image")
                ->from("header_images")
                ->where("branches_id", $this->current_user_company->id);


        $this->datatables->add_column('image', function($data) {
            $back = '<img src="' . base_url() . 'uploads/headers/' . $data['image'] . '" style="height:64px;width:64px;"/>';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {

            $back = "";
            $back .= '<a href="#" title="تعديل" class="tooltips" onclick="header_image.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="حذف" class="tooltips" onclick="header_image.delete(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-times"></i></a>';
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

}
