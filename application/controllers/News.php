<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class News extends MY_Controller{
		public function __construct(){

			parent::__construct();
			$this->load->model("News_model", "news");
		}

		public function index(){

			$this->data['news_count'] = count($this->news->getAllActiveNews());
			$this->data['news'] = $this->news->getAllActiveNews(9);

			if($this->input->is_ajax_request()) {
				$offset = $_POST['offset'];
				$this->data['news'] = $this->news->getAllActiveNews(9, $offset);
				echo $this->load->view("main_content/ajax/news", $this->data, true);
				die();
			}


			$main_content = 'news/index';
            $this->_view($main_content);
		}

		function show(){
			$url_segment = $this->uri->segment(4);
			$url_array = explode("-", $url_segment);
			$id = $url_array[0];

			$this->data['latest_news'] = $this->news->findLastThree();
			$this->data['details'] = $details = $this->news->findById($id);

			// seo keywords and description
            $seo = null;
            $seo['keywords'] = $details->keywords_ar;
            $seo['description'] = $details->desc_ar;
            $this->data['seo'] = $seo; 

            // facebook sharer
            $image = substr($details->image, strpos($details->image, '_') + 1);        
            $og = null;
            $og['title'] = $details->title_ar;
            $og['description'] = $details->desc_ar;
            $og['image'] = base_url() . "uploads/news/l_" . $image;
            $this->data['og'] = $og;  
			

			$main_content = 'news/show';
            $this->_view($main_content);
		}

	}
	