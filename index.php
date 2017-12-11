<?php

/**
 * @file
 * This is index.php.
 */

session_start();

// Load autoloader file.
require_once 'autoloader.php';
require_once 'google-api-php-client/vendor/autoload.php';
$flag = 0;

// TODO: Get request path from php super global $_SERVER.
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
elseif ('/admin/list_candidates' == $uri && $adminController->check_log()) {
	
  //list all the candidates who registeredn
  $adminParticipant->list_participants();
}
elseif ('/admin/new_reg' == $uri && $adminController->check_log()) {
	
  //register candidate by admin
  $adminParticipant->new_registration();
}
elseif ('/admin/new_registration' == $uri && $adminController->check_log()) {
	
  //register candidate by admin
  $adminParticipant->new_register();
}
elseif ('/admin/interview' == $uri && $adminController->check_log()) {
    
  //show interview page listing all interviews
  $interviewController->interviewpage();
}
elseif ('/admin/mail_template' == $uri && $adminController->check_log()) {
  
  //show interview page listing all interviews
  $adminController->mailtemplatepage();
}
//page to add mailtemplate
elseif ('/admin/mailtemplate/addmailtemplatepage' == $uri && $adminController->check_log()) {
  
  //show page to add mailtemplate
  $adminController->addmailtemplatepage();
}
elseif ('/admin/addmailtemplate' == $uri && $adminController->check_log()) {
  
  //inser mailtemplate to  DB
  $adminController->addmailtemplate();
}
elseif ('/admin/mailtemplate/editmailtemplate' == $uri && $adminController->check_log()) {
	
	//function call to modify an interview from db
  $adminController->editmailtemplate();
}
elseif ('/admin/mailtemplate/deletemailtemplate' == $uri && $adminController->check_log()) {
	
	//function call to delete interview into db
  $adminController->deletemailtemplate();
}
elseif ('/admin/interview/addinterviewpage' == $uri && $adminController->check_log()) {
	
  //show page for adding interview
  $interviewController->addinterviewpage();
}
elseif ('/admin/interview/addinterview' == $uri && $adminController->check_log()) {
	
	//function call to insert the new interview into db
  $interviewController->addinterview();
}
elseif ('/admin/interview/editinterview' == $uri && $adminController->check_log()) {
	
	//function call to modify an interview from db
  $interviewController->editinterview();
}
elseif ('/admin/interview/deleteinterview' == $uri && $adminController->check_log()) {
	
	//function call to delete interview into db
  $interviewController->deleteinterview();
}

elseif ('/admin/round' == $uri && $adminController->check_log()) {
    
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
    //header('location:http://ims.com');
  }
}


elseif ('/directtohomepage' == $uri ) {
  
  header("Location:http://ims.com/"); 
}

elseif ('/display_appliedinterview' == $uri ) {
    
  //enter the applied interview into intreview participant table
  $interviewparticipantcontroller->display_applied();
}

elseif('/user/google_login_insertion' == $uri) {

  //insert google data into database    
  $googleregistercontroller->googlelogin_register_database();
}
  
elseif ('/admin/round/addroundpage' == $uri && $adminController->check_log()) {
	
	//show page for adding a new round
  $roundController->addroundpage();
}
elseif ('/admin/round/addround' == $uri && $adminController->check_log()) {
	
	//function call to insert the new round into db
  $roundController->addround();
}
elseif ('/admin/round/editround' == $uri && $adminController->check_log()) {
	
	//function call to insert the new round into db
  $roundController->editround();
}
elseif ('/admin/round/deleteround' == $uri && $adminController->check_log()) {
	
	//function call to insert the new round into db
  $roundController->deleteround();
}
elseif ('/admin/send_report' == $uri && $adminController->check_log()){

  //function to send mail containing confirmation link to CEO
  $adminController->send_report_();
}
elseif ('/admin/resend_report' == $uri && $adminController->check_log()){

  //function to send mail containing confirmation link to CEO
  $adminController->resend_report_();
}

elseif ('/ceo/confirm_report' == $uri && isset($_POST['otp'])) {
 
  //function to confirm the final list by ceo and send mail to selected candidates
  $adminController->final_confirm();
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
elseif ('/admin/score_management' == $uri && $adminController->check_log()) {
	$flag=0;
  
  //show score management page
  $scorecontroller->score_management($flag);
}
elseif ('/admin/score_management/updatestatus' == $uri && $adminController->check_log()) {
	
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
elseif ('/admin/score_management/delete' == $uri && $adminController->check_log()) {
	
	//delete the scores of a participant
  $scorecontroller->score_delete();
}
elseif ('/admin/score_management/edit' == $uri && $adminController->check_log()) {
  $scorecontroller->score_edit();
}
elseif ('/admin/score_management/insertmarks' == $uri && $adminController->check_log()) {		
  $scorecontroller->score_insert();
}
elseif ('/admin/score_management/roundactivate' == $uri && $adminController->check_log()) {
  $scorecontroller->add_int_round();
}
elseif ('/admin/score_management/rounddeactivate' == $uri && $adminController->check_log()) {
  $scorecontroller->del_int_round();
}
elseif ('/user/forgot_password' == $uri) {		
  $userlogincontroller->forgot_password_form();
}
elseif('/user/forgot_password_action' == $uri && isset($_POST['recovery_email'])) {		
  $userlogincontroller->forgot_password_form_action();
}
elseif('/user/recovery_mail' == $uri && isset($_GET['email']) && isset($_GET['otp'])) {
  $userlogincontroller->forgot_password_user($_GET['email'], $_GET['otp']);
}
elseif('/user/set_new_password' == $uri) { 
  $userlogincontroller->new_password_user($_GET['email'], $_POST['newpassword']);
}

elseif ('/user/applied_for_interview' == $uri && isset($_GET['interview_id']) && isset($_GET['flag'])) {
  $user_interview_controller->get_interview_details($_GET['interview_id']);
}
elseif ('/admin/score_management/showprofile' == $uri && $adminController->check_log()) {
  $scorecontroller->show_profile();
}
elseif ('/admin/score_management/history' == $uri && $adminController->check_log()) {
  $scorecontroller->view_history();
}
elseif ('/final_ceo' == $uri) {
  include './office/templates/ceo.tpl.php';
}
else {
  
  //TODO: page not found message with proper http header.
  header("Location:http://ims.com/user/templates/pagenotfound.php");
}
