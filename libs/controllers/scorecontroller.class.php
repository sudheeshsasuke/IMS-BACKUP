<?php
// scorecontroller.php


class ScoreController extends model {

    
    /*public function score_management($flag) {
        
        $nums = sha1($_SESSION['ceo']);
        $num = $_REQUEST['num'];
        if( $flag == 0 || ( $flag == 1 && $nums == $num )){
        $x = $_REQUEST['id'];
        $part = new InterviewParticipant();
        $participants = $part->get_interview_part();
        $part_int_status = $participants[0]['status'];


        $interviews = new Interview();
        $interviewtitle = $interviews->get_interview_title();
        $allround = new Rounds();
        $allrounds = $allround->get_all_rounds();
        $iroun = new interviewrounds();
        $rounds = $iroun->int_rounds();
        $sco = new Scores();
        $IR = $sco->get_all_IR($rounds);
        $score = $sco->get_all_scores($IR, $rounds,$participants);
        require './office/templates/scoremanagement.tpl.php';
        }
        else{
            include 'templates/pagenotfound.php';
        }
    }*/

    public function score_management($flag) {
        //fetch otp from DB
        $otpcontroller = new Otp;
        $otp=$otpcontroller->get_otp();
        if( $flag == 0 || ( $flag == 1 && $otp['otp'] == $_GET['otp_enc'] )){
            $x = $_REQUEST['id'];
            $interview = new Interview();
            $int_det= $interview->get_interview($x);
            $end_date = $int_det['end_date'];
            $today = date("Y-m-d");
            if ( $today <= $end_date && $int_det['finished'] == 0){
                $part = new InterviewParticipant();
                $participants = $part->get_interview_part();
                $part_int_status = $participants[0]['status'];
                $interviews = new Interview();
                $interviewtitle = $interviews->get_interview_title();
                $allround = new Rounds();
                $allrounds = $allround->get_all_rounds();
                $iroun = new interviewrounds();
                $rounds = $iroun->int_rounds();
                $sco = new Scores();
                $IR = $iroun->get_all_IR($rounds);
                $score = $sco->get_all_scores($IR, $rounds,$participants);
                require './office/templates/scoremanagement.tpl.php';
            }
            else {
                //require './admin/templates/addmarks.tpl.php';
                $interviews = new Interview();
                $interviewtitle = $interviews->get_interview_title();
                $part = new InterviewParticipant();
                $selected_participants = $part->interview_selected_part($_REQUEST['id']);
                require './office/templates/selectedcandidates.tpl.php';
            }
            
        }
        else{
            include 'templates/pagenotfound.php';
        }
    }
    public function score_delete() {
        $part = new participant();
        $part->delete_participant();
    }   
    public function score_edit() {
        $iroun = new interviewrounds();
        $rounds = $iroun->int_rounds();
        $part_round = $_GET['roundid'];
        $sco = new Scores();
        $ir =  $iroun->get_ir($part_round);
        $part_score_arr = $sco->get_score($ir[0]);
        $part_score = $part_score_arr[0];
        require './office/templates/addmarks.tpl.php';
    }   
    public function score_insert() {
        $roun = new Scores();
        $roun->update_marks();
        $this->score_management();
    }   
    public function delete_round() {
        $roun = new Rounds();
        $rounds = $roun->delete_rounds();
        require './office/templates/addmarks.tpl.php';
    }

    //Changing the round status of selected candidates,by fetching interview_round id 
    //for corresponding interview and selected round
    public function updateroundstatus() {
        $sco = new Scores();
        $iroun = new interviewrounds();
        $ir =  $iroun->get_ir($_POST['roundid']);
        $roun = new Rounds();
        $sco->update_round_status($ir[0]['id']);
        //send notification mail for  the selected candidates
        $admnctrlr = new AdminController();
        $admnctrlr->notification_mail($_POST['checkedusers'],$_REQUEST['id']);
    }
        
    public function add_int_round() {
        $iroun = new interviewrounds();
        $iroun->insert_rounds();
    }
    public function del_int_round() {
        $iroun = new interviewrounds();
        $iroun->del_rounds();
    }   
    public function show_profile() {
        $part = new participant();
        $personal_details = $part->personal_details();
        $academic = new academics();
        $academic_details = $academic->academic_details();
        $experience = new experience();
        $experience_details = $experience->experience_details();
        $skill = new skill();
        $skill_details = $skill->skill_details();
        require './office/templates/profiles.tpl.php';

    }
    public function view_history() {
        $part = new InterviewParticipant();
        $participants = $part->get_interview_part();
        $part_int_status = $participants[0]['status'];
        $interviews = new Interview();
        $interviewtitle = $interviews->get_interview_title();
        $allround = new Rounds();
        $allrounds = $allround->get_all_rounds();
        $iroun = new interviewrounds();
        $rounds = $iroun->int_rounds();
        $sco = new Scores();
        $IR = $iroun->get_all_IR($rounds);
        $score = $sco->get_all_scores($IR, $rounds,$participants);
        require './office/templates/history.tpl.php';
    }
}    
