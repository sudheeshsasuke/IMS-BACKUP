<?php

class interviewrounds extends database {

    public function get_all_IR($rounds) {
        $IR = array();
        foreach($rounds as $round) {  
            $query = "SELECT id FROM interview_rounds WHERE int_id = :intid AND round_id = :roundid AND soft_delete=:soft_delete";
            $soft_delete = 0;
            $values = array(':intid'=>$_REQUEST['id'],
                            ':roundid'=>$round['round_id'],
                            ':soft_delete' => $soft_delete
                        );
            $IR[] =  $this->query_execute($query, $values);   
            
        }
        return $IR;
    }

    public function get_ir($round) {
        $query = "SELECT id FROM interview_rounds WHERE int_id = :intid AND round_id = :roundid AND soft_delete=:soft_delete";
        $soft_delete = 0;
        $values = array(':intid'=>$_REQUEST['id'],
                        ':roundid'=>$round,
                        ':soft_delete' => $soft_delete);
        $ir =  $this->query_execute($query, $values);   
        return $ir;
    }
    public function delete_rounds() {
        $query = "DELETE  FROM interview_rounds WHERE rid = :id AND intid = :intid";
        $values = array(':rid'=>$rid,
                        ':intid'=>$intid);
        $this->query_execute($query, $values);
    }
    public function int_rounds() {
        $query = "SELECT * FROM interview_rounds ir "
        . " JOIN rounds r ON r.id = ir.round_id "
        . " WHERE int_id = :intid AND ir.soft_delete=:soft_delete";
        $soft_delete = 0;
        $values = array(
            ':intid'=>$_REQUEST['id'],
            ':soft_delete' => $soft_delete
        );
        $rounds= $this->query_execute($query, $values);
        return $rounds;
    }
    public function insert_rounds(){
        $query = "INSERT INTO interview_rounds (int_id, round_id) VALUES (:intid, :round_id)" ;
        $values = array(':intid'=>$_POST['intid'],
                        ':round_id'=>$_POST['rid']);                       
        $this->query_execute($query, $values);
    }
    public function del_rounds() {
        $query = "UPDATE `interview_rounds` SET `soft_delete`=:soft_delete "
        . " WHERE round_id = :round_id AND int_id = :int_id";
        $soft_delete = 1;
        $values = array(
                ':round_id'=>$_POST['rid'],
                ':int_id'=>$_POST['intid'],
                ':soft_delete' => $soft_delete
            );
        $this->query_execute($query, $values);
    }
}