<?php

class InterviewParticipantController extends InterviewParticipant {

    public function register_applied() {
        // function to insert the applied interview into table
        $this->register_applied_interview();
    }

    public function display_applied() {
        //function to display the interview from table
        $result = $this->display_applied_interview();
    }

}