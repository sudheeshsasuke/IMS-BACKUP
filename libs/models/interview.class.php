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
                ':ti' => addslashes($_POST['jobpost']),
                ':lo'=> $_POST['location'],
                ':de'=> $_POST['department'],
                ':sd'=> $_POST['startdate'],
                ':ed'=> $_POST['enddate']);
        $this->query_execute($query, $values); 
        return $this->lastId;              
    }
    public function add_details($lid){
        $desc = addslashes($_POST['description']);
        $cre = addslashes($_POST['criteria']);
        $query = "INSERT INTO interview_details (body,criteria,int_id)"
        . " VALUES(:body,:cr,:id)";
        $values = array(
            ':body' => $desc,
            ':cr'=> $cre,
            ':id'=> $lid
        );
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
    public function edit_details() {
        $desc = addslashes($_POST['description']);
        $cre = addslashes($_POST['criteria']);
        $query = "UPDATE interview_details set"  
            . " body =:body, criteria=:cr"
            . " WHERE int_id = :id";
        $values = array(
            ':body' => $desc,
            ':cr'=> $cre,
            ':id'=> $_POST['jobid']
        );
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
     
    public function get_interview($intid) {
        $query = "SELECT * FROM interview WHERE id = :id";
        $values = array(':id' => $intid);
        $interview = $this->query_execute($query, $values);
        return $interview[0];
    }

    public function get_int_details($id){
        $query = "SELECT * FROM `interview_details` "
        . " WHERE int_id =:id";
        $values = array(':id' => $id);
        $interview_det = $this->query_execute($query,$values);
        return $interview_det[0];     
    }
        
    public function get_interview_title() {
        $query = "SELECT title, id FROM interview WHERE id = :id";
        $values = array(':id' => $_REQUEST['id']);
        $interviewtitles = $this->query_execute($query, $values);
        $interviewtitle = $interviewtitles[0];
        return $interviewtitle;
    }

    public function get_interview_details($interview_id) {
        
        // $query = "SELECT * FROM `interview` "
        // . " WHERE `id` = :interview_id";
        $query = "SELECT * FROM `interview` AS i"
        . " LEFT JOIN `interview_details` AS i_d ON i.id = i_d.int_id"
        . " LEFT JOIN `interview_rounds` AS i_r ON i.id = i_r.int_id"
        . " LEFT JOIN `rounds`AS r ON r.id = i_r.round_id "
        . " WHERE i.id = :interview_id";
        $values = array(
            ':interview_id' => $interview_id
        );
        $query2 = "SELECT COUNT(*) as count FROM `interview_rounds`"
        . " WHERE int_id = :interview_id";
        $data = $this->query_execute($query2, $values);
        $round_count = $data[0]['count'];
        $interview = $this->query_execute($query, $values);
        include 'user/templates/interviewdetails.tpl.php';
    }
    public function get_interview_last_date() {
        $query = "SELECT end_date FROM interview WHERE id = :id";
        $values = array(':id' => $_REQUEST['id']);
        $interview = $this->query_execute($query, $values);
        return $interview[0];

    }
    public function finished($id){
        $query = "UPDATE `interview` SET `finished`=:finished  WHERE `id` = :id";
        $finished = 1;
        $values = array(
                ':id' => $id,
                ':finished' => $finished
            );
        $this->query_execute($query, $values);
    }
}
