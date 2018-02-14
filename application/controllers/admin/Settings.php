<?php

    class Settings extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Branches_settings_model', 'branches_settings');
        }

        public function index(){
            $settings = $this->branches_settings->getSettings($this->current_user_company->id);
            $settings->site_contacts = json_decode($settings->site_contacts);
            //pri($settings);
            $this->data['settings'] = $settings;
            $main_content = 'settings/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $settings = $this->branches_settings->getSettings($this->current_user_company->id);
            $settings->site_contacts = json_decode($settings->site_contacts);
            //pri($settings);
            $this->data['settings'] = $settings;
            $main_content = 'settings/index';
            $this->_view($main_content, 'admin');
        }

        public function edit(){
            //pri($this->input->post());
            //pri($about_us);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('site_title_ar', 'السم الموقع', 'required');
            $this->form_validation->set_rules('site_title_en', 'السم الموقع', 'required');
            $this->form_validation->set_rules('site_phone', 'التليفون', 'required');
            $this->form_validation->set_rules('site_email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('address_ar', 'العنوان', 'required');
            $this->form_validation->set_rules('address_en', 'العنوان', 'required');
            $this->form_validation->set_rules('site_desc_ar', 'الوصف', 'required');
            $this->form_validation->set_rules('site_desc_en', 'الوصف', 'required');
            $this->form_validation->set_rules('keywords_ar', 'الكلمات الدلالية', 'required');
            $this->form_validation->set_rules('keywords_en', 'الكلمات الدلالية', 'required');
            $this->form_validation->set_rules('site_close_message_ar', 'رسالة اغلاق الموقع', 'required');
            $this->form_validation->set_rules('site_close_message_en', 'رسالة اغلاق الموقع', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                //pri($array_data);
                $data_array['site_title_ar'] = $this->input->post('site_title_ar');
                $data_array['site_title_en'] = $this->input->post('site_title_en');
                $data_array['site_phone'] = $this->input->post('site_phone');
                $data_array['site_email'] = $this->input->post('site_email');
                $data_array['address_ar'] = $this->input->post('address_ar');
                $data_array['address_en'] = $this->input->post('address_en');
                $data_array['site_desc_ar'] = $this->input->post('site_desc_ar');
                $data_array['site_desc_en'] = $this->input->post('site_desc_en');
                $data_array['keywords_ar'] = $this->input->post('keywords_ar');
                $data_array['keywords_en'] = $this->input->post('keywords_en');
                $data_array['site_close_message_ar'] = $this->input->post('site_close_message_ar');
                $data_array['site_close_message_en'] = $this->input->post('site_close_message_en');
                $data_array['site_contacts'] = json_encode($this->input->post('site_contacts'));
                $where_array['branches_id'] = $this->current_user_company->id;
                //pri($data_array);
                $update = $this->branches_settings->update($data_array, $where_array);

                if ($update) {
                    $settings_after_update = $this->branches_settings->getSettings($this->current_user_company->id);
                    print_json('success', $settings_after_update);
                } else {
                    print_json('error', \_lang('no_affected_rows'));
                }
            }
        }

    }
