<?php

class Home_slider extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_slider_model', 'home_slider');
    }

    public function show() {
        $main_content = 'home_slider/index';
        $this->_view($main_content, 'admin');
    }

    public function index() {
        $main_content = 'home_slider/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        // pri($_POST);
        $id = $_POST['id'];
        $find = $this->home_slider->find($id);

        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function add() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_title_ar', _lang('first_title_ar'), 'required');
        $this->form_validation->set_rules('first_title_en', _lang('first_title_en'), 'required');
        $this->form_validation->set_rules('second_title_ar', _lang('second_title_ar'), 'required');
        $this->form_validation->set_rules('second_title_en', _lang('second_title_en'), 'required');
        $this->form_validation->set_rules('url', _lang('url'), 'required');
        $this->form_validation->set_rules('this_order', _lang('this_order'), 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if (isset($_FILES['home_slider_image']) && $_FILES['home_slider_image']['name'] != "") {

                $this->config->load('files');
                $config = $this->config->item('home_slider_image');
                $new_path = 'uploads/home_slider/';
                $uploading = $this->home_slider->do_upload('home_slider_image', $config, $new_path);

                if (!$uploading) {
                    $errors = array('home_slider_image' => $this->upload->display_errors());
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
                $data['image'] = $image_name;
            }
        } else {
            $message['home_slider_image'] = _lang('no_file_to_upload');
            print_json('error', $message);
        }
        $data['first_title_ar'] = trim(xss_clean($_POST['first_title_ar']));
        $data['first_title_en'] = trim(xss_clean($_POST['first_title_en']));
        $data['second_title_ar'] = trim(xss_clean($_POST['second_title_ar']));
        $data['second_title_en'] = trim(xss_clean($_POST['second_title_en']));
        $data['url'] = (isset($_POST['url'])) ? trim(xss_clean($_POST['url'])) : '';
        $data['this_order'] = xss_clean($_POST['this_order']);
        $data['active'] = xss_clean($_POST['active']);
        $data['branches_id'] = $this->current_user_company->id;
        $add = $this->home_slider->add($data);
        if ($add) {
            print_json('success', _lang('added_successfully'));
        } else {
            print_json('error', 'error');
        }
    }

    public function edit() {
        $id = $_POST['id'];
        $find = $this->home_slider->find($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_title_ar', _lang('first_title_ar'), 'required');
        $this->form_validation->set_rules('first_title_en', _lang('first_title_en'), 'required');
        $this->form_validation->set_rules('second_title_ar', _lang('second_title_ar'), 'required');
        $this->form_validation->set_rules('second_title_en', _lang('second_title_en'), 'required');
        $this->form_validation->set_rules('url', _lang('url'), 'required');
        $this->form_validation->set_rules('this_order', _lang('this_order'), 'required');
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            print_json('error', $errors);
        } else {
            if (isset($_FILES['home_slider_image']) && $_FILES['home_slider_image']['name'] != "") {

                $this->config->load('files');
                $config = $this->config->item('home_slider_image');
                $new_path = 'uploads/home_slider/';
                $uploading = $this->home_slider->do_upload('home_slider_image', $config, $new_path);

                if (!$uploading) {
                    $errors = array('home_slider_image' => $this->upload->display_errors());
                    print_json('error', $errors);
                } else {
                    $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                    $image_without_prefix = substr($find->image, strpos($find->image, '_') + 1); //without s_
                    $files = array(
                        FCPATH . 'uploads/home_slider/' . $image_original,
                        FCPATH . 'uploads/home_slider/s_' . $image_without_prefix,
                        FCPATH . 'uploads/home_slider/m_' . $image_without_prefix,
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
                $data['image'] = $image_name;
            }
        } else if (!$valid_upload && empty($find->image)) {
            $message['home_slider_image'] = _lang('no_file_to_upload');
            print_json('error', $message);
        }
        $data['first_title_ar'] = trim(xss_clean($_POST['first_title_ar']));
        $data['first_title_en'] = trim(xss_clean($_POST['first_title_en']));
        $data['second_title_ar'] = trim(xss_clean($_POST['second_title_ar']));
        $data['second_title_en'] = trim(xss_clean($_POST['second_title_en']));
        $data['url'] = (isset($_POST['url'])) ? trim(xss_clean($_POST['url'])) : '';
        $data['this_order'] = xss_clean($_POST['this_order']);
        $data['active'] = xss_clean($_POST['active']);
        $where_array['id'] = $id;
        $update = $this->home_slider->update($data, $where_array);
        if ($update) {
            print_json('success', _lang('updated_successfully'));
        } else {
            print_json('error', _lang('no_affected_rows'));
        }
    }

    public function delete() {
        $id = $_POST['id'];
        $find = $this->home_slider->find($id);
        $deleted = $this->home_slider->delete(array('id' => $id));
        if ($deleted) {
            $image_original = substr($find->image, strrpos($find->image, '_') + 1);
            $image_without_prefix = substr($find->image, strpos($find->image, '_') + 1); //without s_

            $files = array(
                FCPATH . 'uploads/home_slider/' . $image_original,
                FCPATH . 'uploads/home_slider/s_' . $image_without_prefix,
                FCPATH . 'uploads/home_slider/l_' . $image_without_prefix,
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
                ->select("id,first_title_en,second_title_en,active,image")
                ->from("home_slider")
                ->where("branches_id", $this->current_user_company->id);

        $this->datatables->add_column('active', function($data) {
            return ($data['active'] == 1) ? _lang('active') : _lang('not_active');
        }, 'id');
        $this->datatables->add_column('image', function($data) {
            $back = '<img src="' . base_url() . 'uploads/home_slider/' . $data['image'] . '" style="height:64px;width:64px;"/>';
            return $back;
        }, 'id');
        $this->datatables->add_column('options', function($data) {

            $back = "";
            $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Home_slider.edit(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
            $back .= "&nbsp;&nbsp;";
            $back .= '<a href="#" title="حذف" class="tooltips" onclick="Home_slider.delete(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-times"></i></a>';
            return $back;
        }, 'id');

        $results = $this->datatables->generate();
        echo $results;
        exit;
    }

}
