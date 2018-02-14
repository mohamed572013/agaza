<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Etiquette extends MY_Controller{


        public function __construct() {
            parent::__construct();
            $this->load->model("Etiquette_model", "etiquette");
        }

    	public function index() {
            $all_etiquette = $this->etiquette->getAllActiveEtiquette($this->whitelabel_id, 12);
            $count = count($this->etiquette->getAllActiveEtiquette($this->whitelabel_id));


            if($this->input->is_ajax_request()) {
                $offset = $_POST['page_count'];

                $this->data['all_etiquette'] = $this->etiquette->getAllActiveEtiquette($this->whitelabel_id,12, $offset);
                $this->data['count'] = count($this->etiquette->getAllActiveEtiquette($this->whitelabel_id));
                
                $ajax_content = $this->load->view('main_content/ajax/etiquette', $this->data, true);
                echo $ajax_content;
                exit();
            }



            $this->data['all_etiquette'] = $all_etiquette;            
            $this->data['count'] = $count;



    		$main_content = 'etiquette/index';
            $this->_view($main_content);
    	}


        public function show() {
            $url_segment = $this->uri->segment(4);
            $url_array = explode("-", $url_segment);
            $id = $url_array[0];

            $etiquette_details = $this->etiquette->findById($id);

            $this->data['etiquette_details'] = $etiquette_details;

            // seo keywords and description
            $seo = null;
            $seo['keywords'] = $etiquette_details->keywords_ar;
            $seo['description'] = $etiquette_details->description_ar;
            $this->data['seo'] = $seo; 

            // facebook sharer
            $image = substr($etiquette_details->image, strpos($etiquette_details->image, '_') + 1);        
            $og = null;
            $og['title'] = $etiquette_details->title_ar;
            $og['description'] = $etiquette_details->description_ar;
            $og['image'] = base_url() . "uploads/etiquette/l_" . $image;
            $this->data['og'] = $og;          

            $main_content = 'etiquette/show';
            $this->_view($main_content);
        }
		
		public function sitemap() {
        $this->load->model("Sitemap_model", "sitemap");

        $this->sitemap->file_name("etiquette.xml");

        $branches_id = $this->whitelabel_id;
        $etiquette = $this->etiquette->getAllActiveEtiquette($branches_id);
        //pri($all_restaurants);
        $this->sitemap->addUrl("http://agazabook.com/ar/etiquette", date('c'),  'daily',    '1');

        if($etiquette) {
            foreach ($etiquette as $key => $value) {
                $title = $value->id . "-" . str_replace(" ", "-", $value->title_ar);
                $this->sitemap->addUrl("http://agazabook.com/ar/etiquette/show/$title", date('c'),  'daily');
            }    
        }
            
        // create sitemap
        $this->sitemap->createSitemap();

        // write sitemap as file
        $this->sitemap->writeSitemap();

        // update robots.txt file
   //     $this->sitemap->updateRobots();

        // submit sitemaps to search engines
        $this->sitemap->submitSitemap();
    }


    }




?>