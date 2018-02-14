<?php

class Front_shrines_model extends CI_Model {

    private $table = 'maka_madina_shrines';
    private $images_table = 'shrines_slider';

    public function __construct() {
        parent::__construct();
    }

    public function all($branches_id) {
//        $this->db->select("maka_madina_shrines.*");
//        $this->db->select('maka_madina_shrines.title_ar as shrine_title_ar,maka_madina_shrines.title_en as shrine_title_en,'
//                . 'maka_madina_shrines.id as shrine_id,p1.title_ar as country_title_ar,p1.title_en as country_title_en,maka_madina_shrines.image as shrine_image,'
//                . 'p2.title_ar as city_title_ar,p2.title_en as city_title_en,');
        $this->db->select('maka_madina_shrines.title_ar as shrine_title_ar,maka_madina_shrines.title_en as shrine_title_en,maka_madina_shrines.country_id,maka_madina_shrines.image as shrine_image,'
                . 'maka_madina_shrines.id as shrine_id,p2.title_ar as city_title_ar,p2.title_en as city_title_en');
        $this->db->from('maka_madina_shrines');
//        $this->db->join('places p1', 'p1.id=maka_madina_shrines.country_id');
        $this->db->join('places p2', 'p2.id=maka_madina_shrines.places_id');
        $this->db->where('maka_madina_shrines.active', 1);
        $this->db->where('maka_madina_shrines.branches_id', $branches_id);
        $this->db->order_by('maka_madina_shrines.created_at', 'DESC');
        //$this->db->limit(12);
        $query = $this->db->get();
//        pri($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	
    public function all_sitemap($branches_id) {
        $this->db->select('maka_madina_shrines.title_ar as shrine_title_ar,maka_madina_shrines.title_en as shrine_title_en,maka_madina_shrines.country_id,maka_madina_shrines.image as shrine_image,'
                . 'maka_madina_shrines.id as shrine_id,p2.title_ar as city_title_ar,p2.title_en as city_title_en');
        $this->db->from('maka_madina_shrines');
        $this->db->join('places p2', 'p2.id=maka_madina_shrines.places_id');
        $this->db->where('maka_madina_shrines.active', 1);
        $this->db->where('maka_madina_shrines.branches_id', $branches_id);
        $this->db->order_by('maka_madina_shrines.created_at', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function findById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function findImages($id) {
        $this->db->select('*');
        $this->db->from($this->images_table);
        $this->db->where('shrine_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getShrinesInCity($city_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('places_id', $city_id);
        $this->db->where('active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getSrinesByCity($branches_id, $places_id, $limit = false, $offset = false) {
        $this->db->select('maka_madina_shrines.title_ar as shrine_title_ar,maka_madina_shrines.title_en as shrine_title_en,'
                . 'maka_madina_shrines.id as shrine_id,p1.title_ar as country_title_ar,p1.title_en as country_title_en,maka_madina_shrines.image as shrine_image,'
                . 'p2.title_ar as city_title_ar,p2.title_en as city_title_en,');
        $this->db->from('maka_madina_shrines');
        $this->db->join('places p1', 'p1.id=maka_madina_shrines.country_id');
        $this->db->join('places p2', 'p2.id=maka_madina_shrines.places_id');
        $this->db->where('maka_madina_shrines.active', 1);
        $this->db->where('maka_madina_shrines.branches_id', $branches_id);
        $this->db->where('maka_madina_shrines.places_id', $places_id);
        $this->db->order_by('maka_madina_shrines.created_at', 'DESC');

        if ($limit && !$offset) {
            $this->db->limit($limit);
        }
        if ($limit && $offset) {
            $this->db->limit($limit, $offset);
        }


        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getShrinesByTitle($shrine_title) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('title_ar', $shrine_title);
        $this->db->where('active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function cities($branches_id) {
        $this->db->select('*');
        $this->db->from('places');
        $this->db->where('place_id !=0');
        $this->db->where('active', 1);
        $this->db->where('branches_id', $branches_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
