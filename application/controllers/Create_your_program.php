<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Create_your_program extends MY_Controller{
		public function __construct(){

			parent::__construct();
			$this->load->model('Share_model', 'Share_model');
		}

		public function index(){
			$cond['active'] = 1;
			$this->data['programs_levels'] = $this->Share_model->GetWhere("programs_levels", "id", "ASC", $cond);
			$this->data['programs_seasons'] = $this->Share_model->GetWhere("programs_seasons", "id", "ASC", $cond);
			$this->data['programs_advantage'] = $this->Share_model->GetWhere("programs_advantage", "id", "ASC", $cond);
			$this->data['hotel_rooms'] = $this->Share_model->GetWhere("hotel_rooms", "id", "ASC", $cond);

			$cond_maka['maka_or_madina'] = 0;
			$cond_madina['maka_or_madina'] = 1;
			$this->data['maka_hotels'] = $this->Share_model->GetWhere("maka_madina_hotels", "id", "ASC", $cond_maka);
			$this->data['madina_hotels'] = $this->Share_model->GetWhere("maka_madina_hotels", "id", "ASC", $cond_madina);

			$this->data['TravelFromCity'] = $this->Share_model->GetTravelFromCity();
			$this->data['TravelToCity'] = $this->Share_model->GetTravelToCity();
			$this->data['TravelReturnFromCity'] = $this->Share_model->GetTravelReturnFromCity();
			$this->data['TravelReturnToCity'] = $this->Share_model->GetTravelReturnToCity();


			$this->data['view'] = "create_your_program";
			$this->load->view("main_layout", $this->data);
		}

		public function sending_data(){
			$this->load->library('email');


			if (isset($_POST['g-recaptcha-response']))
				$captcha = $_POST['g-recaptcha-response'];

			if (!$captcha) {
				echo '<h5>Please check the the captcha form.</h5>';
				exit;
			}
			$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdxfAgUAAAAADzrNmXMytVjaBn78h33Ekj437Y6&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
			if ($response['success'] == false) {
				echo '<h5>You are spammer ! Get the @$%K out</h5>';
			} else {



				$message = "<div style='text-align : right'>";
				$message .= " الاسم   :  " . \strip_tags($_POST['full_name']) . " <br/>";
				$message .= " الايميل   :  " . \strip_tags($_POST['email']) . " <br/>";
				$message .= " رقم التليفون   :  " . \strip_tags($_POST['phone']) . " <br/>";
				$message .= " اسم الموسم :  " . \strip_tags($_POST['program_season']) . " <br/>";
				$message .= " اسم المستوى :  " . \strip_tags($_POST['programs_levels']) . " <br/>";
				$message .= " تاريخ الرحلة :  " . \strip_tags($_POST['program_date']) . " <br/>";
				$message .= " فندق مكة    :  " . \strip_tags($_POST['program_mecca_hotel']) . " <br/>";
				$message .= " عدد الليالى:  " . \strip_tags($_POST['program_nights_in_mecca']) . " <br/>";
				$message .= "    فندق مكة غير موجود بالقائمه:  " . \strip_tags($_POST['makka_hotel_additional']) . " <br/>";
				$message .= " فندق المدينة    :  " . \strip_tags($_POST['program_medina_hotel']) . " <br/>";
				$message .= " عدد الليالى:  " . \strip_tags($_POST['program_nights_in_medina']) . " <br/>";
				$message .= " فندق المدينة غير موجود بالقائمه:  " . \strip_tags($_POST['medina_hotel_additional']) . " <br/>";
				$message .= "   الذهاب من     :  " . \strip_tags($_POST['program_go_direction_from']) . " <br/>";
				$message .= " الذهاب الى :  " . \strip_tags($_POST['program_go_direction_to']) . " <br/>";
				$message .= "  العودة من :  " . \strip_tags($_POST['program_return_direction_from']) . " <br/>";
				$message .= " العودة الى :  " . \strip_tags($_POST['program_return_direction_to']) . " <br/>";
				$message .= " التفاصيل      :  " . \strip_tags($_POST['program_details']) . " <br/>";
				if (isset($_POST['programs_features'])) {
					$message .= " المميزات      :  " . \implode(' / ', $_POST['programs_features']) . " <br/>";
				}
				$message .= " <br/> ";
				$message .= " الغرف:  ";
				$message .= " <br/> ";

				foreach ($_POST['hotel_rooms'] as $key => $value) {
					$message .= " نوع الغرفه:  " . $_POST['hotel_rooms'][$key];
					$message .= " عدد الغرف:  " . $_POST['room_count'][$key];
					$message .= " عدد الافراد بالغين:  " . $_POST['room_count_adult'][$key];
					$message .= " عدد الافراد طفل:  " . $_POST['room_count_kid'][$key];
					$message .= " عدد الافراد رضيع:  " . $_POST['room_count_infant'][$key];
				}
				$message .= " </div> ";

				$from = $_POST["email"];
				$this->email->from($from, $_POST["full_name"]);
				$subject = "Message from Omera Partners website 'creat your program'  ";
				$this->email->to($this->data['site_email']);
				$this->email->reply_to($from);
				$this->email->subject($subject);
				$this->email->message($message);

//If the email is sent
				if ($this->email->send()) {
					echo '1';
// echo $this->email->print_debugger();
					//return true;
				} else { //echo $this->email->print_debugger();
					echo '0';
					//return false;
				}
			}
		}

	}
	