<?php

// round.class.php
//require_once 'database.php';

class Interview extends database {
    public function get_all_interviews() {
        
                //$query = "SELECT * FROM interview ORDER BY start_date";
                $query = "SELECT * FROM `interview` "
                . " WHERE `soft_delete` = '0'";

                $interviews = $this->query_execute($query,NULL);
                return $interviews;
        
            }
        
    //insert interviews into interview table
     public function add_interview() {
        $query = "INSERT INTO interview (title,location,department,start_date,end_date)"
                . " VALUES(:ti,:lo,:de,:sd,:ed)";
        $values = array(
                ':ti' => $_POST['jobpost'],
                ':lo'=> $_POST['location'],
                ':de'=> $_POST['department'],
                ':sd'=> $_POST['startdate'],
                ':ed'=> $_POST['enddate']);
        $this->query_execute($query, $values);               
    }

    public function edit_interview() {
        $query = "UPDATE interview set"  
            . " title = :ti,location = :lo,department = :de,start_date = :sd,end_date = :ed"
            . " WHERE id = :id";
        $values = array(
            ':id'=> $_POST['jobid'],
            ':ti' => $_POST['jobpost'],
            ':lo'=> $_POST['location'],
            ':de'=> $_POST['department'],
            ':sd'=> $_POST['startdate'],
            ':ed'=> $_POST['enddate']);
        $this->query_execute($query, $values);               
    }
    public function delete_interview() {
        //$query = "DELETE FROM interview WHERE id = :id";
        $query = "UPDATE `interview` SET `soft_delete`=:soft_delete "
        . " WHERE `id` = :id";
        $soft_delete = 1;
        $values = array(
                ':id' => $_POST['id'],
                ':soft_delete' => $soft_delete
            );
        $this->query_execute($query, $values);               
    }
     
    public function get_interview() {
        $query = "SELECT * FROM interview WHERE id = :id";
        $values = array(':id' => $_REQUEST['id']);
        $interview = $this->query_execute($query, $values);
        
        return $interview[0];
    }
    
        
    public function get_interview_title() {
        $query = "SELECT title, id FROM interview WHERE id = :id";
        $values = array(':id' => $_REQUEST['id']);
        $interviewtitles = $this->query_execute($query, $values);
        $interviewtitle = $interviewtitles[0];
        return $interviewtitle;
    }

    public function get_interview_details($interview_id) {
        
        $query = "SELECT * FROM `interview` "
        . " WHERE `id` = :interview_id";
        $values = array(
            ':interview_id' => $interview_id
        );
        $interviews = $this->query_execute($query, $values);
        $interview = $interviews[0];
        include 'user/templates/interviewdetails.tpl.php';
    }
    public function get_interview_last_date() {
        $query = "SELECT end_date FROM interview WHERE id = :id";
        $values = array(':id' => $_REQUEST['id']);
        $interview = $this->query_execute($query, $values);
        return $interview[0];

    }
}
