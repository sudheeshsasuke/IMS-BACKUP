<?php 
//Admin controller
class AdminController extends Employee{

	

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
public function send_report_(){
	$_SESSION['confirm']=0;
	$_SESSION['send']=1;
	$to = 'harikk173@gmail.com';
	
	$subject = 'Confirmation of '.$_POST['title'].' final result';

	$message = '
	<html>
	<head>
	  <title>'.$_POST['title'].' final result</title>
	</head>
	<body>
	  <p>Approve the final list by clicking the link!</p>
	  <p><a href="http://ims.com/ceo/score_management?id='.$_POST['intid'].'&num='.$_POST['ceo'].'">http://ims.com/ceo/score_management?id='.$_POST['intid'].'</a></p>
	</body>
	</html>
	';
	
	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
	
	// Additional headers
	$headers[] = 'To: Hari <harikk173@gmail.com.com>';
	$headers[] = 'From: InterviewManager@admin <donot@replay.com>';

	
	// Mail it
	mail($to, $subject, $message, implode("\r\n", $headers));
}
public function resend_report_(){
	$to = 'harikk173@gmail.com'; // note the comma
	
	// Subject
	$subject = 'Recheck the list '.$_POST['title'].' final result';
	
	// Message
	$message = '
	<html>
	<head>
	  <title>'.$_POST['title'].' final result </title>
	</head>
	<body>
	  <p>'.$_POST['change'].'</p>
	</body>
	</html>
	';
	
	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
	
	// Additional headers
	$headers[] = 'To: Hari <harikk173@gmail.com.com>';
	$headers[] = 'From: InterviewManager@admin <donot@replay.com>';

	
	// Mail it
	mail($to, $subject, $message, implode("\r\n", $headers));
}
public function confirm_report_(){
	$_SESSION['confirm']=1;
	$_SESSION['send']=0;
}


//send notification mail for  the selected candidates
public function notification_mail($pid_array,$roundid,$intid) {
	$participant_ = new Participant();
	$participants = $participant_->get_participants($pid_array);
	$round_ = new Rounds();
	$round = $round_->get_round_($roundid);
	$interview = new Interview();
	$intrvw =$interview ->get_interview();

	//mail template
	
	
	foreach ($participants as $participant) {
		// Subject
	$subject = 'Interview status of '.$intrvw['title'];
	
	// Message
	$message = '
	<html>
	<head>
	 
	</head>
	<body>
	
	</p>
	  <p>Hi '.$participant['name'].',</p>
	  <p>Greetings from Zyxware Technologies</p>
	  <p>We are  happy to inform you that you have been successfully cleared '.$round['name'].' round.
	  Please attend the nextround for the position of '.$intrvw['title'].' as per details given below.
	 </p>

	 <table>
		 <tr>
			 <td>Venue    : </td>
			 <td>Zyxware Technologies,phase 3,Yamuna Building</td>
		 </tr>
		 <tr>
			 <td>Date    : </td>
			 <td></td>
		  </tr>
		  <tr>
			 <td>Time    : </td>
			 <td>10.30 AM</td>
		  </tr>
	 </table>
	 <p>Contact  Numbers:- +91-889999999</p>
	 
	 
	 <p>Note: Candidate has to bring the printout of this call letter for gate pass entrance and updated resume /CV
	 along with you while attending the Interview without which they will not be allowed to take up the interview.</p>
			  
	 <p>We look forward to meeting you.</p>
	 
	 <p>Kindly acknowledge the receipt of this email</p>
	 
	 
	 <p>Regards,</p>
	 <p>Zyxware Technologies Pvt. Ltd</p>
	 <p>Yamuna Building, TechnoPark- Phase 3,</p>
	 <p>Trivandrum, Kerala, India.</p>
	</body>
	</html>
	';
	
	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
	
	// Additional headers
	$headers[] = 'To:'.$participant['email'];
	$headers[] = 'From: InterviewManager@admin <donot@replay.com>';

		$to = $participant['email']; // note the comma
		
		
		// Mail it
		mail($to, $subject, $message, implode("\r\n", $headers));
	}

}




}


?>