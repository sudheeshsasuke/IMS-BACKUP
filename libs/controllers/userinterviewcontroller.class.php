<?php

class UserInterviewController extends model {
   
    public function list_appliedinterviews() {
        $interviews = $this->get_all_notappliedinterviews();
        require 'user/templates/homepage.tpl.php';
   }

   public function list_interviews() {

    $interviews = $this->get_all_interviews();
    require 'user/templates/homepage.tpl.php';
   }

   public function get_interview_details($interview_id) {
       
        $interview_model = new interview();
        $interview_model->get_interview_details($interview_id);
   }
}

?>