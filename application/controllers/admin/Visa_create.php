<?php

    class Visa_create extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Visa_create_model', 'visa_create');
        }

        public function index(){
            $this->data['places'] = $this->visa_create->places($this->current_user_company->id);
            $this->data['visa_types'] = $this->visa_create->visa_types($this->current_user_company->id);
            $this->data['visa_periods'] = $this->visa_create->visa_periods($this->current_user_company->id);
            $this->data['visa_documents'] = $this->visa_create->visa_documents($this->current_user_company->id);
            $this->data['visa_jobs'] = $this->visa_create->visa_jobs($this->current_user_company->id);
            //pri($this->data['visa_types']);
            $main_content = 'visa_create/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $this->data['places'] = $this->visa_create->places($this->current_user_company->id);
            $this->data['visa_types'] = $this->visa_create->visa_types($this->current_user_company->id);
            $this->data['visa_periods'] = $this->visa_create->visa_periods($this->current_user_company->id);
            $this->data['visa_documents'] = $this->visa_create->visa_documents($this->current_user_company->id);
            $this->data['visa_jobs'] = $this->visa_create->visa_jobs($this->current_user_company->id);
            //pri($this->data['visa_types']);
            $main_content = 'visa_create/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            $code = $_POST['code'];
            $places_id = $_POST['places_id'];
            $find = $this->visa_create->findByCode($code);
            $data = array();
            foreach ($find as $value) {
                $data['places_id'] = $value->places_id;
                $data['price'] = $value->price;
                $data['active'] = $value->active;
                $data['visa_types'][] = $value->visa_types_id;
                $data['visa_periods'][] = $value->visa_periods_id;
                $data['visa_jobs'][] = $value->visa_jobs_id;
                $documents = $this->visa_create->findDocuments($value->id);
                foreach ($documents as $document) {
                    $data['visa_documents'][] = $document->visa_documents_id;
                }
            }
            $data['code'] = $code;
            if (!empty($data)) {
                print_json('success', $data);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            pri('here');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('places_id', 'الدولة', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $last_code = $this->visa_create->last_added_code($this->current_user_company->id);

                if ($last_code) {
                    $code = $last_code + 1;
                } else {
                    $code = 1;
                }
                $visa_types_ids = xss_clean($_POST['visa_types']);
                $visa_jobs_ids = xss_clean($_POST['visa_jobs']);
                $visa_periods_ids = xss_clean($_POST['visa_periods']);
                $inserted_ids = array();
                $inserted_codes = array();
                foreach ($visa_types_ids as $type_id) {
                    foreach ($visa_jobs_ids as $job_id) {
                        foreach ($visa_periods_ids as $period_id) {
                            $data_array['visa_types_id'] = $type_id;
                            $data_array['visa_jobs_id'] = $job_id;
                            $data_array['visa_periods_id'] = $period_id;
                            $data_array['places_id'] = xss_clean($_POST['places_id']);
                            $check = $this->check($data_array);
                            if ($check) {
                                print_json('error', _lang('added_before'));
                            }
                            //$code = 'V_' . 'T' . $type_id . '_' . 'J' . $job_id . '_' . 'P' . $period_id;
                            $data_array['code'] = $code;
                            $data_array['price'] = xss_clean($_POST['price']);
                            $data_array['active'] = xss_clean($_POST['active']);
                            $data_array['branches_id'] = $this->current_user_company->id;
                            $data_array['created_by'] = $this->_current_user->user_id;
                            $add = $this->visa_create->add($data_array);
                            $inserted_ids[] = $add;
                            $inserted_codes[] = $code;
                        }
                    }
                }


                //pri('here');
                if (!empty($inserted_ids)) {
                    foreach ($inserted_ids as $key => $id) {
                        $visa_documents_ids = xss_clean($_POST['visa_documents']);
                        foreach ($visa_documents_ids as $document_id) {
                            $data2_array['visas_code'] = $inserted_codes[$key];
                            $data2_array['visas_id'] = $id;
                            $data2_array['visa_documents_id'] = $document_id;
                            $add = $this->visa_create->addByTable('visas_documents', $data2_array);
                        }
                    }
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        public function edit(){
            //pri($_POST);
            $code = $_POST['code'];
            $this->load->library('form_validation');
            $this->form_validation->set_rules('places_id', 'الدولة', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $this->visa_create->deleteByTable('visas', array('code' => $code));
                $this->visa_create->deleteByTable('visas_documents', array('visas_code' => $code));
                $last_code = $this->visa_create->last_added_code($this->current_user_company->id);
                if ($last_code) {
                    $code = $last_code + 1;
                } else {
                    $code = 1;
                }
                $visa_types_ids = xss_clean($_POST['visa_types']);
                $visa_jobs_ids = xss_clean($_POST['visa_jobs']);
                $visa_periods_ids = xss_clean($_POST['visa_periods']);
                $inserted_ids = array();
                $inserted_codes = array();
                foreach ($visa_types_ids as $type_id) {
                    foreach ($visa_jobs_ids as $job_id) {
                        foreach ($visa_periods_ids as $period_id) {
                            $data_array['visa_types_id'] = $type_id;
                            $data_array['visa_jobs_id'] = $job_id;
                            $data_array['visa_periods_id'] = $period_id;
                            $data_array['places_id'] = xss_clean($_POST['places_id']);
                            $check = $this->check($data_array);
                            if ($check) {
                                print_json('error', _lang('added_before'));
                            }
                            //$code = 'V_' . 'T' . $type_id . '_' . 'J' . $job_id . '_' . 'P' . $period_id;
                            $data_array['code'] = $code;
                            $data_array['price'] = xss_clean($_POST['price']);
                            $data_array['active'] = xss_clean($_POST['active']);
                            $data_array['branches_id'] = $this->current_user_company->id;
                            $data_array['created_by'] = $this->_current_user->user_id;
                            $add = $this->visa_create->add($data_array);
                            $inserted_ids[] = $add;
                            $inserted_codes[] = $code;
                        }
                    }
                }
                if (!empty($inserted_ids)) {
                    foreach ($inserted_ids as $key => $id) {
                        $visa_documents_ids = xss_clean($_POST['visa_documents']);
                        foreach ($visa_documents_ids as $document_id) {
                            $data2_array['visas_code'] = $inserted_codes[$key];
                            $data2_array['visas_id'] = $id;
                            $data2_array['visa_documents_id'] = $document_id;
                            $add = $this->visa_create->addByTable('visas_documents', $data2_array);
                        }
                    }
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        public function delete(){
            $code = $_POST['code'];
            $deleted_1 = $this->visa_create->deleteByTable('visas', array('code' => $code));
            $deleted_2 = $this->visa_create->deleteByTable('visas_documents', array('visas_code' => $code));
            if ($deleted_1 && $deleted_2) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("visas.code as visa_code,visas.created_at as visa_created_at,visas.active as visa_active,places.title_ar as country_title_ar,visa_jobs.title_ar as job_title_ar,"
                            . "visa_periods.period,visa_types.title_ar as type_title_ar,visas.places_id as visa_places_id"
                    )
                    //->where("user_type","admin")
                    ->from("visas")
                    ->join("places", "visas.places_id=places.id")
                    ->join("visa_jobs", "visas.visa_jobs_id=visa_jobs.id")
                    ->join("visa_periods", "visas.visa_periods_id=visa_periods.id")
                    ->join("visa_types", "visas.visa_types_id=visa_types.id")
                    ->where("visas.branches_id", $this->current_user_company->id)
                    ->group_by("visas.code");

            $this->datatables->add_column('visa_active', function($data) {
                return ($data['visa_active'] == 1) ? 'نشط' : 'غير نشط';
            }, 'visa_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="Visa_create.edit(this);return false;" data-places-id="' . $data["visa_places_id"] . '" data-code="' . $data["visa_code"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-code="' . $data["visa_code"] . '"
                onclick="Visa_create.delete(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';

                //endif;
                return $back;
            }, 'visa_code');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function check($check_array = array()){
            $errors = array();
            $where_array = array(
                'branches_id' => $this->current_user_company->id,
            );
            foreach ($check_array as $key => $value) {
                $where_array[$key] = $value;
            }
            $find = $this->visa_create->findWhere($where_array);
            if ($find) {
                return true;
            } else {
                return false;
            }
        }

    }
