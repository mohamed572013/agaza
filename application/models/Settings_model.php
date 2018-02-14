<?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of settings
     *
     * @author Abd Elfttah Ahmed <thisphp.com@gmail.com>
     */
    class Settings_model extends CI_Model{

        private $_table = 'settings';

        public function __construct(){
            parent::__construct();
        }

//        public function GetSettings2(){
//            $query = $this->db->get($this->_table, 1000);
//            $array_return = array();
//            foreach ($query->result() as $key => $value) {
//
//                switch ($value->setting_name) {
//                    case 'site_contacts':
//                    case 'default_group_options':
//                        $array_return[$value->setting_name] = json_decode($value->setting_value, true);
//                        break;
//
//                    default:
//                        $array_return[$value->setting_name] = $value->setting_value;
//                        break;
//                }
//            }
//            return (object) $array_return;
//        }

        public function GetSettings($branches_id){
            $this->db->select('*');
            $this->db->from('branches_settings');
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function UpdateSettings($array_date = array(), $where_array = array()){
            try {
                if (\is_array($array_date) && \count($array_date) > 0) {
                    $this->db->trans_start();
                    foreach ($array_date as $key => $value) {
                        $this->db->query("UPDATE settings SET setting_value = '" . $value . "' WHERE setting_name = '" . $key . "'");
                    }
                    $this->db->trans_complete();
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

    }
    