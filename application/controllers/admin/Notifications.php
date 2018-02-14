<?php

class Notifications extends C_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Notification_model', 'notifications');
    }

    public function index() {
        $main_content = 'currency/index';
        $this->_view($main_content, 'admin');
    }

    public function show() {
        $main_content = 'currency/index';
        $this->_view($main_content, 'admin');
    }

    public function row() {
        // pri($_POST);
        $id = $_POST['id'];
        $find = $this->currency->find($id);

        if ($find) {
            print_json('success', $find);
        } else {
            print_json('error', 'error');
        }
    }

    public function addNotification() {
        $array_data['branches_id'] = $_POST['branches_id'];
        $array_data['property_id'] = $_POST['program_id'];
        $array_data['type'] =  "programs";
        $array_data['seen'] = 0;
        $array_data['created'] = date("Y-m-d h:i:s a");

        $this->notifications->add($array_data);
    }

   

    public function getLastNotifications() {
        $where_array['seen'] = 0;
        $notifications = $this->notifications->GetWhere("notifications", "id", "DESC", $where_array);
        $count = count($this->notifications->GetWhere("notifications", "id", "DESC", $where_array));
        $all_notifications_data['notifications'] = $notifications;
        $all_notifications_data['count'] = $count;
        $result = "";
        $result .= '<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <span class="fa fa-bell-o"></span>
                        <span class="badge badge-red" id="noti-count" >'.$count.'</span>
                        </a>
                        <div class="dropdown-menu right top-notification">
                        <h4>Notification</h4>
                        <ul class="ls-feed">';
        foreach ($notifications as $key => $value) {
            $result .= '<li><a href="javascript:void(0)"><span class="label label-red"><i class="fa fa-check white"></i></span>'.$value->event.'<span class="date">'.$value->created.'</span></a></li>';   
        }
        $result .= '  <li class="only-link"><a href="javascript:void(0)">View All</a></li></ul></div>'; 
        echo $result; die();
        
    }
}