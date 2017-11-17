<?php

class InterviewParticipant extends database {

    public function  get_interview_part(){
            
        $query = "SELECT * FROM participant p JOIN interview_participant ip ON p.id = ip.part_id WHERE int_id = :intid";
        $values = array(':intid'=>$_REQUEST['id']);
        $participants = $this->query_execute($query, $values);
        return $participants;
    }
    public function register_applied_interview() {
        
        $status = "Applied";
        if(!empty($_SESSION['apply_interview_id'])){
            $arr = array(':part_id'=>$_SESSION['id'],
                ':int_id'=>$_SESSION['apply_interview_id'],
                ':status'=>$status
            );
           
        }
        else {
            $arr = array(':part_id'=>$_SESSION['id'],
                ':int_id'=>$_POST['int_id'],
                ':status'=>$status
            );
        }
        $arra = array(':int_id'=>$_SESSION['apply_interview_id'],
                    ':part_id'=>$_SESSION['id']
        );
        $queryi = "SELECT COUNT(int_id) FROM interview_participant WHERE int_id=:int_id AND part_id=:part_id";
        $count = $this->query_execute($queryi, $arra);
        $a = $count[0];
        if($a['COUNT(int_id)'] == 0) {
            $query = "INSERT INTO interview_participant(`part_id`, `int_id`, `status`) VALUES(:part_id, :int_id, :status)";
            $this->query_execute($query, $arr);
            header("Location:http://ims.com/");
            unset($_SESSION['apply_interview_id']);
        }
        else {
            header("Location:http://ims.com/");
        } 
    }

    public function display_applied_interview() {

        $arr = array(':part_id'=>$_SESSION['id']);
        $query = "SELECT DISTINCT *  FROM interview_participant ip JOIN interview i ON i.id=ip.int_id WHERE part_id=:part_id";
        $result = $this->query_execute($query, $arr);
        include "user/templates/homepage.tpl.php";
    }
    public function interview_selected_part(){
        $query = "SELECT * FROM participant p JOIN interview_participant ip ON p.id = ip.part_id WHERE int_id = :intid AND status = :status";
        $status = 1;
        $values = array(':intid'=>$_REQUEST['id'],
                        ':status'=>$status);
        $part_selected = $this->query_execute($query, $values);
        return $part_selected;
    }
}
?>