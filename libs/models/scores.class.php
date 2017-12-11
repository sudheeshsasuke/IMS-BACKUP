<?php

// round.class.php
//require_once 'database.php';

class Scores extends database {
    


    public function get_all_scores($IR,$rounds,$participants) {
        $part = array();
        $score1 = array();

        

        foreach($participants as $participant){
            foreach($IR as $IRarray) { 
                foreach ($IRarray as $intround) {
                $score1[$participant['part_id']][$intround['id']]['score'] = 0;
                $score1[$participant['part_id']][$intround['id']]['status'] = NULL;
                $score1[$participant['part_id']][$intround['id']]['comment'] = NULL;   
                }
            }
        }
        $score = array();
        $score = $score1;
       // $part = $this->query_execute("SELECT p.id as id, s.int_round_id as irid, s.score, s.comment, s.status 
        //                            FROM participant p LEFT JOIN score s ON p.id = s.part_id
         //                            JOIN interview i ON i.id=WHERE ", NULL);  
         $query = "SELECT s.part_id as pid,s.int_round_id as irid,s.score,s.comment,s.status FROM score as s JOIN interview_rounds as ir ON s.int_round_id = ir.id WHERE ir.int_id = :interviewid";   
         $values = array(':interviewid'=>$_REQUEST['id']);
        $part = $this->query_execute($query, $values); 
        foreach ($part as $p) {
            //foreach($IR as $ir) {
            $score[$p['pid']][$p['irid']]['score'] = $p['score'];
            $score[$p['pid']][$p['irid']]['status'] = $p['status'];
            $score[$p['pid']][$p['irid']]['comment'] = $p['comment'];
            //}
        }                
        return $score;
    }
    
    
    
    public function get_score($ir) {
        $query = "SELECT * FROM score WHERE part_id = :pid AND int_round_id = :irid";
        $values = array(':pid'=>$_REQUEST['pid'],
                        ':irid'=>$ir['id']);
        $part_score = $this->query_execute($query, $values); 
        return $part_score;
    }
        
   
    public function part_round_score() {
        $query = "SELECT * FROM score WHERE part_id = :partid AND int_round_id = :introundid";
        $values = array(':partid'=>$_REQUEST['p_id'],
                        ':introundid'=>$_REQUEST['round']);
        $part_round_scores = $this->query_execute($query, $values);
        return $part_round_scores;
    }
    public function update_marks(){
        $query = "SELECT id FROM interview_rounds WHERE int_id = :intid AND round_id = :roundid
                    AND soft_delete=:soft_delete";
        $soft_delete = 0;
        $values = array(':intid'=>$_REQUEST['id'],
                        ':roundid'=>$_REQUEST['round'],
                        ':soft_delete' => $soft_delete);
        $irid =  $this->query_execute($query, $values);
        if ($_POST['old_mark'] != NULL) {
            $query = "UPDATE score SET score = :score, comment = :comment WHERE part_id = :partid AND int_round_id = :introundid" ;
            $values = array(':partid'=>$_REQUEST['p_id'],
                            ':introundid'=>$irid[0]['id'],
                            ':score'=>$_POST['mark'],
                            ':comment'=>$_POST['comment']);
            $this->query_execute($query, $values);
        }
        else {
            $query = "INSERT INTO score (part_id, int_round_id, score, comment, status) VALUES (:partid, :int_round_id, :score, :comment, :status)" ;
            $values = array(':partid'=>$_POST['p_id'],
                            ':int_round_id'=>$irid[0]['id'],
                            ':score'=>$_POST['mark'],
                            ':comment'=>$_POST['comment'],
                            ':status'=>"");
            $this->query_execute($query, $values);
        }
       
        
    }

    //updating the round status for selected candidates
    public function update_round_status($intid) {
        $st = "1";
        $participants = $_POST['checkedusers'];
        foreach($participants as $participant) {
            $query = "UPDATE score SET status = :stat WHERE int_round_id = :intid AND part_id = :part_id";
            $values = array(':stat'=>$st,
                            ':intid'=>$intid,
                            ':part_id'=>$participant);
            $irid =  $this->query_execute($query, $values);
        }
        
    }
    public function count_cand($intid,$partid) {
        $status = 1;
        $query = "SELECT COUNT(s.id) as count FROM score AS s JOIN interview_rounds as ir ON s.int_round_id=ir.id WHERE s.part_id = :pid AND ir.int_id = :intid AND s.status = :status";
        $values = array(':pid'=>$partid,
                        ':intid'=>$intid,
                        ':status'=>$status);
        $count = $this->query_execute($query, $values); 
        return $count[0]['count'];
    }
}


    