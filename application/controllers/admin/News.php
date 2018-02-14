<?php

    class News extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model("News_model", "news");
        }

        public function index(){            
            $this->data['news'] = $this->news->GetNews();
            
            $main_content = 'news/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $this->data['news'] = $this->news->GetNews();            
            $main_content = 'news/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            $news_id = $_POST['news_id'];
            $find = $this->news->findById($news_id);            
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "عنوان الخبر بالعربية ", 'required');
            $this->form_validation->set_rules('body_ar', "المحتوى بالعربية", 'required');
            $this->form_validation->set_rules('desc_ar', "SEO description", 'required');
            $this->form_validation->set_rules('keywords_ar', "SEO keywords", 'required');
            
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('news_image');
                    $new_path = 'uploads/news/';
                    $uploading = $this->news->do_upload('image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
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
                $message['image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri($data_array);
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['active'] = \xss_clean($_POST['active']);
            $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['body_ar'] = $_POST['body_ar'];

            $add = $this->news->add($data_array);
            if ($add) {                
                print_json('success', _lang('added_successfully'));
            } else {
                print_json('error', 'added_failed');
            }
        }

        public function edit($id = ""){            
            $news_id = $_POST['news_id'];
            $find = $this->news->findById($news_id);
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('this_order', "الترتيب ", 'required');
            $this->form_validation->set_rules('title_ar', "عنوان الخبر بالعربية ", 'required');
            $this->form_validation->set_rules('body_ar', "المحتوى بالعربية", 'required');
            $this->form_validation->set_rules('desc_ar', "SEO description", 'required');
            $this->form_validation->set_rules('keywords_ar', "SEO keywords", 'required');
            $valid_upload = false;
            $image_name = "";
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

                    $this->config->load('files');
                    $config = $this->config->item('news_image');
                    $new_path = 'uploads/news/';
                    $uploading = $this->news->do_upload('image', $config, $new_path);

                    if (!$uploading) {
                        $errors = array('image' => $this->upload->display_errors());
                        print_json('error', $errors);
                    } else {
                        $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                        $files = array(
                            FCPATH . 'uploads/news/' . $image_original,
                            FCPATH . 'uploads/news/' . $find->image,
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
                    $data_array['image'] = $image_name;
                }
            } else if (!$valid_upload && empty($find->image)) {
                $message['image'] = _lang('no_file_to_upload');
                print_json('error', $message);
            }
            //pri("done");
            $data_array['title_ar'] = \xss_clean($_POST['title_ar']);
            $data_array['this_order'] = \xss_clean($_POST['this_order']);
            $data_array['active'] = \xss_clean($_POST['active']);
           // $data_array['created'] = date("Y-m-d h:s:i a");
            $data_array['keywords_ar'] = \xss_clean($_POST['keywords_ar']);
            $data_array['desc_ar'] = \xss_clean($_POST['desc_ar']);
            $data_array['body_ar'] = $_POST['body_ar'];
            $news_where['id'] = $news_id;
            $update_1 = false;
            $update_2 = false;
            $update = $this->news->update($data_array, $news_where);
            if ($update) {
                $update_1 = true;
            } else {
                $update_1 = false;
            }
            

            if ($update_1) {
                print_json('success', _lang('updated_successfully'));
            }
            if (!$update_1) {
                print_json('error', 'no_affected_rows');
            }
        }

        public function delete(){
            $news_id = $_POST['news_id'];
            $find = $this->news->findById($news_id);
            $where_array['id'] = $news_id;
            $delete = $this->news->delete($where_array);
            if ($delete) {
                $image_original = substr($find->image, strrpos($find->image, '_') + 1);
                $files = array(
                    FCPATH . 'uploads/news_id/' . $image_original,
                    FCPATH . 'uploads/news_id/' . $find->image,
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

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select("id,title_ar,body_ar,image,desc_ar,keywords_ar,active")
                    ->from("news");



            $this->datatables->add_column('main_image', function($data) {
                $back = '<img src="' . base_url() . 'uploads/news/' . $data['image'] . '" style="height:64px;width:64px;"/>';
                return $back;
            }, 'id');

            $this->datatables->add_column('active', function($data) {
                $back = ($data['active'] == 1)? "مفعل": "غير مفعل";
                return $back;
            }, 'id');
            
            $this->datatables->add_column('options', function($data) {
                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("edit") . '" class="tooltips" onclick="News.edit_news(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";


                $back .= '<a href="#"
                title="' . _lang("delete") . '"
                class="tooltips"
                data-id="' . $data["id"] . '"
                onclick="News.delete_news(this);return false;"><i class="fa fa-times fa-2x text-danger"></i></a>';
                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
