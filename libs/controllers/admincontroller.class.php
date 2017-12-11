<?php 
//Admin controller
class AdminController extends Employee{
	
	//checking the login status
	public function check_log() {
		if (isset($_SESSION['admin'])) {
			return true;
		}
		else {
			header("Location:http://ims.com/admin/");
		}
	}

	public function homepage(){

		//login and homepage
		$usrIntController = new AdminInterviewController;
		
		if (isset($_SESSION['admin'])){
			$interviews = $usrIntController->get_all_interviews();
			require './office/templates/homepage.tpl.php';
		}
		elseif (isset($_POST['user'])){
			$this->login();
		}
		else {
			require './office/templates/login.tpl.php';
		}
	}
	public function logout(){

		//admin logout
		session_destroy();
		header('Location:http://ims.com/admin/'); 
	}

	//mailtemplate
	public function mailtemplatepage() {
		$mail = new MailTemplate();
		$mailtemplates = $mail->get_all_mailtemplates();
		require './office/templates/mail_template.tpl.php';
	}

	public function addmailtemplatepage() {
		require './office/templates/addmailtemplatepage.tpl.php';
	}

	//add mailtemplate in DB
	public function addmailtemplate() {
		$mail = new MailTemplate();
		if($_POST['templateid'] != NULL) {
			$mail->edit_mailtemplate();
		}
		else {
			$mail->add_mailtemplate();
		}
		header("location:http://ims.com/admin");
	}

	//function to prepopuluate the values for the selected mailtemplate id
	public function editmailtemplate() {
		$mail = new MailTemplate();
		$template = $mail->get_template_byid($_REQUEST['templateid']);
		require './office/templates/addmailtemplatepage.tpl.php';		
	}

	public function deletemailtemplate() {
		$mail = new MailTemplate();
		$interview = $mail->delete_mailtemplate();
		
	}
	
	public function send_report_(){
		$otp = rand(1000,getrandmax());
		$otp_enc = sha1($otp);
		$final_list = 1;
		$otpcontroller = new Otp;
		$otpcontroller->insert_otp($otp_enc);
		$int = new Interview();
		$intrvw = $int->get_interview($_REQUEST['id']);
		$rec[0]['email']= $_POST['tomail'];
				
		// Mail it
		$this->send_mail($rec, "sendreport_ceo",$otp_enc);
	}
	public function resend_report_(){
		$int = new Interview();
		$intrvw = $int->get_interview($_POST['id']);
		$rec[0]['email'] = $_POST['tomail']; // note the comma
		$otpcontroller = new Otp;
		$otpcontroller->remove_otp();
		
		// Mail it
		$this->send_mail($rec,"resend_report",null);
	}


	//function to confirm the final list by ceo and send mail to selected candidates
	public function final_confirm() {

		//get the list of selected candidates
		$int = new Interview();
		$intrvw = $int->get_interview($_REQUEST['id']);
		$iroun = new interviewrounds();
		$round_count = $iroun->round_count($_REQUEST['id']);
		$sco = new Scores();
		$selected = array();
    $i=0;
		$intpart = new InterviewParticipant();
		$int_participants = $intpart->get_interview_part();
		foreach($int_participants as $int_participant){
			$count = $sco->count_cand($_REQUEST['id'],$int_participant['part_id']);
			if($count == $round_count){
				$selected[$i++] = $int_participant['part_id']; 
			}
		}
		$intpart->update_intrvw_part($selected);

		//update status of interview as passed for the selected candidates
		$selected_candidates = $intpart->interview_selected_part($_REQUEST['id']);
		//mail template
		
			// Mail it
			$this->send_mail($selected_candidates, "offer_letter",null);
		//}
		$otpcontroller = new Otp;
		$otpcontroller->remove_otp();
		$int->finished($_REQUEST['id']);
	}


	//send notification mail for  the selected candidates
	public function notification_mail($pid_array,$intid) {
		$participant_ = new Participant();
		$participants = $participant_->get_participants($pid_array);
		$round_ = new Rounds();
		$round = $round_->get_round_($_POST['roundid']);
		$interview = new Interview();
		$intrvw =$interview ->get_interview($_REQUEST['id']);
		$this->send_mail($participants,"RoundUpdate",null);
	}

	public function send_mail($recepient,$templatecode,$otp) {
		$round_ = new Rounds();
		$round = $round_->get_round_($_POST['roundid']);
		$interview = new Interview();
		$intrvw =$interview ->get_interview($_REQUEST['id']);
		$mail = new MailTemplate();
		$template = $mail->get_template($templatecode);
		foreach ($recepient as $rec) {
			$to = $rec['email'];

			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			
			// Additional headers
			$headers[] = 'To:'.$rec['email'];
			$headers[] = 'From: InterviewManager@admin <donot@replay.com>';
			$subject = $template['subject'];
			$message = $template['text'];
			//str_replace(find,replace,string,count)
			$message = str_replace('[candidate_name]',$rec['name'],$message);
			$message = str_replace('[interview_title]',$intrvw['title'],$message);
			$message = str_replace('[round_name]',$round['name'],$message);
			$message = str_replace('[interview_id]',$intrvw['id'],$message);
			$message = str_replace('[otp_enc]',$otp,$message);
			$subject = str_replace('[interview_title]',$intrvw['title'],$subject);
			mail($to, $subject, $message, implode("\r\n", $headers));
		}
	}




}


?>