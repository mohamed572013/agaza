<?php

class Shrines extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Front_shrines_model', 'shrines');
    }

    public function index() {
        $shrines = $this->shrines->all($this->whitelabel_id);   //latest 6
//        pri($shrines);
        $cities = $this->shrines->cities($this->whitelabel_id);
      //  pri($cities);
        $this->data['shrines'] = $shrines;
        $this->data['cities'] = $cities;
        $main_content = 'shrines/index';
        $this->_view($main_content);
    }

    public function details() {
        $shrine_title = urldecode($this->uri->segment(4));
        $shrine_title_explode = explode('-', $shrine_title);
        $shrine_id = end($shrine_title_explode);
        $shrine = $this->shrines->findById($shrine_id);
        $shrine->images = $this->shrines->findImages($shrine_id);
        
		
		
		$seo = null;
        $seo['keywords'] = $shrine->keywords_ar;
        $seo['description'] = $shrine->body_ar;
        $this->data['seo'] = $seo;  

        $image = substr($shrine->image, strpos($shrine->image, '_') + 1);        
        $og = null;
        $og['title'] = $shrine->title_ar;
        $og['description'] = mb_substr($shrine->body_ar, 0, 100);
        $og['image'] = base_url() . "uploads/maka_madina_shrines/l_" . $image;
        $this->data['og'] = $og;  
		
        $this->data['shrine'] = $shrine;
        $main_content = 'shrines/shrine_details';
        $this->_view($main_content);
    }

    public function ShrinesByCity() {
        //pri($_POST);
        $city_id = $_POST['city_id'];
        $offset = ((isset($_POST['offset']) && !empty($_POST['offset']))) ? $_POST['offset'] : false; //for filter by city
        $data = array();
        $shrines = $this->shrines->getSrinesByCity($this->whitelabel_id, $city_id, 6, $offset);
        $shrines_count = count($this->shrines->getSrinesByCity($this->whitelabel_id, $city_id, false, false));
        $data['shrines'] = $shrines;
        $data['shrines_count'] = $shrines_count;
        //pri($data);
        if ($shrines) {
            print_json('success', $data);
        } else {
            print_json('error', _lang('not_found'));
        }
    }

}
