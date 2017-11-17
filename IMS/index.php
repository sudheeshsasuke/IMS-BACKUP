<?php

// index.php
session_start();

// load autoloader file
require_once 'autoloader.php';
$flag = 0;
// route the request internally
//TODO: Get request path from php super global $_SERVER 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//$controller = new Controllers();
$user_interview_controller = new UserInterviewController();
$adminController = new AdminController(); 
$interviewController = new AdminInterviewController(); 
$roundController = new AdminRoundController();
$scorecontroller = new ScoreController();
$user_register_controller = new UserRegisterController();
$participant = new Participant();
$interviewparticipantcontroller = new InterviewParticipantController();
$adminParticipant = new AdminParticipantController();
$user_profile_controller = new UserProfileController();
$userlogincontroller = new UserLoginController();
$googleregistercontroller = new GoogleRegisterController();

if ('/' == $uri && isset($_SESSION['id'])) {

    //TODO: list interviews in home page
    $user_interview_controller->list_appliedinterviews();
    
    //login();
} 

else if('/' == $uri) {
    $user_interview_controller->list_interviews();
}

elseif ('/admin' == $uri || '/admin/' == $uri) {

	
  //show home page or login page
  $adminController->homepage();
}
elseif ('/admin/logout' == $uri) {
	
  //logout admin
  $adminController->logout();
}
elseif ('/admin/list_candidates' == $uri) {
	
  //list all the candidates who registered
  $adminParticipant->list_participants();
}
elseif ('/admin/new_reg' == $uri) {
	
  //register candidate by admin
  $adminParticipant->new_registration();
}
elseif ('/admin/new_registration' == $uri) {
	
  //register candidate by admin
  $adminParticipant->new_register();
}
elseif ('/admin/interview' == $uri) {
    
  //show interview page listing all interviews
  $interviewController->interviewpage();
}
elseif ('/admin/interview/addinterviewpage' == $uri) {
	
  //show page for adding interview
  $interviewController->addinterviewpage();
}
elseif ('/admin/interview/addinterview' == $uri) {
	
	//function call to insert the new interview into db
  $interviewController->addinterview();
}
elseif ('/admin/interview/editinterview' == $uri) {
	
	//function call to modify an interview from db
  $interviewController->editinterview();
}
elseif ('/admin/interview/deleteinterview' == $uri) {
	
	//function call to delete interview into db
  $interviewController->deleteinterview();
}

elseif ('/admin/round' == $uri) {
    
  //show interview page listing all rounds
  $roundController->roundpage();
}

elseif ('/insert_into_intpart' == $uri) {
  
    //enter the applied interview into intreview participant table
    if(!empty($_SESSION['id'])) { 
      $interviewparticipantcontroller->register_applied();
    }
    else {
       $_SESSION['apply_interview_id'] = $_POST['int_id'];
    }

}


elseif ('/directtohomepage' == $uri ) {
  
  header("Location:http://ims.com/"); 
}

elseif ('/display_appliedinterview' == $uri ) {
    
    //enter the applied interview into intreview participant table
    $interviewparticipantcontroller->display_applied();
  }

elseif('/user/google_login_insertion' == $uri && isset($_POST['email'])) {

    //insert google data into database    
    $googleregistercontroller->googlelogin_register_database();

}
  
elseif ('/admin/round/addroundpage' == $uri) {
	
	//show page for adding a new round
  $roundController->addroundpage();
}
elseif ('/admin/round/addround' == $uri) {
	
	//function call to insert the new round into db
  $roundController->addround();
}
elseif ('/admin/round/editround' == $uri) {
	
	//function call to insert the new round into db
  $roundController->editround();
}
elseif ('/admin/round/deleteround' == $uri) {
	
	//function call to insert the new round into db
  $roundController->deleteround();
}
elseif ('/admin/send_report' == $uri){

  //function to send mail containing confirmation link to CEO
  $adminController->send_report_();
}
elseif ('/admin/resend_report' == $uri){

  //function to send mail containing confirmation link to CEO
  $adminController->resend_report_();
}
elseif ('/admin/resend_report' == $uri){
  
  //function to send mail containing confirmation link to CEO
  $adminController->confirm_report_();
}
elseif('/ceo/score_management' == $uri){
  $flag=1;
  $scorecontroller->score_management($flag);

}
elseif ('/user/login' == $uri) {
    
    //show login template
    $participant->loginuser();
}
elseif ('/user/googlelogin' == $uri) {
  
  //show login template
  $participant->google_login();
}
elseif ('/user/show' == $uri && isset($_GET['id'])) {
    
    //TODO: show action
    $x = $_SESSION['user_id'];
    $controller->show_action($_GET['id']);
} 
elseif ('/user/register' == $uri) {
    
    //TODO: register
    //echo "hii";
    $user_register_controller->registeruser();    
} 
elseif ('/user/register_action' == $uri) {
    
    //TODO: resgister
     $controller->RegisterAction();    
}
elseif ('/user/login_action' == $uri) {
    
    //TODO: resgister
    $controller->LoginAction($_POST['name'], $_POST['password']);  
}
elseif ('/user/comment_action' == $uri) {
    
    //TODO: resgister
    $controller->comment_action();  
}
elseif ('/user/logout' == $uri) {
    
    //logout
    session_destroy();
    header("Location:http://ims.com/");  
}
elseif ('/admin/score_management' == $uri) {
	$flag=0;
  //show score management page
    $scorecontroller->score_management($flag);
}
elseif ('/admin/score_management/updatestatus' == $uri) {
	
	//show score management page
  $scorecontroller->updateroundstatus();
}
elseif ('/user/visit_profile' == $uri) {
	
	//TODO:check whether the user is loged in, if not redirect to login page
    //TODO:perform apply interview action
 
    $user_profile_controller->get_participant_details();
}
elseif ('/user/apply_for_interview' == $uri && isset($_GET['interview_id'])) {
    $user_interview_controller->get_interview_details($_GET['interview_id']);
}
elseif ('/user/submit_profile' == $uri) {
	
	//TODO:check whether the user is loged in, if not redirect to login page
    //TODO:perform apply interview action
 
    $user_profile_controller->update_participant_details();
}
elseif ('/user/confirm_mail' == $uri && isset($_GET['email']) && isset($_GET['code'])) {
	
    $userlogincontroller->confirm_user($_GET['email'], $_GET['code']);

}
elseif ('/admin/score_management/delete' == $uri) {
	
	//delete the scores of a participant
  $scorecontroller->score_delete();
}
elseif ('/admin/score_management/edit' == $uri) {
  $scorecontroller->score_edit();
}
elseif ('/admin/score_management/insertmarks' == $uri) {		
  $scorecontroller->score_insert();
}
elseif ('/admin/score_management/roundactivate' == $uri) {
  $scorecontroller->add_int_round();
}
elseif ('/admin/score_management/rounddeactivate' == $uri) {
  $scorecontroller->del_int_round();
}
elseif ('/user/forgot_password' == $uri) {		
  $userlogincontroller->forgot_password_form();
}
elseif('/user/forgot_passowrd_action' == $uri && isset($_POST['recovery_email'])) {		
  $userlogincontroller->forgot_password_form_action();
}
elseif('/user/recovery_mail' == $uri && isset($_GET['email']) && isset($_GET['otp'])) {
    $userlogincontroller->forgot_password_user($_GET['email'], $_GET['otp']);
}
elseif ('/user/applied_for_interview' == $uri && isset($_GET['interview_id']) && isset($_GET['flag'])) {
    $user_interview_controller->get_interview_details($_GET['interview_id']);
}
elseif ('/admin/score_management/showprofile' == $uri) {
  $scorecontroller->show_profile();
}
elseif ('/admin/score_management/history' == $uri) {
  $scorecontroller->view_history();
}

else {
   
    //TODO: page not found message with proper http header.
    include 'user/templates/pagenotfound.php';
}
