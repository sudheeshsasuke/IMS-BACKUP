<?php

class UserProfileController extends profile {
   
    public function get_participant_details() {
        $personal_details = $this->get_personal_details();
        $academic_details = $this->get_academic_details();
        $experience_details = $this->get_experience_details();
        $skill_details = $this->get_skill_details();
        require 'user/templates/profile.tpl.php';
   }
   public function update_participant_details() {
       $this->update_personal_details();
       $this->upload_resume();
       $this->update_academic_details();
       $this->update_experience_details();
       $this->update_skill_details();
       header("Location:http://ims.com/");   
    }

   
}

?>