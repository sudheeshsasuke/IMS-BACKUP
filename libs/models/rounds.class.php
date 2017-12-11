<?php

// round.class.php
//require_once 'database.php';

class Rounds extends database {



    public function get_all_rounds() {

        $query = "SELECT * FROM rounds"
        . " WHERE `soft_delete` = :soft_delete";
        $soft_delete = 0;
        $values = array(
            ':soft_delete' => $soft_delete
        );
        //fetch all rounds from round table
        $rounds= $this->query_execute($query, $values);
                    
        return $rounds;

    }

    public function add_round() {
        $des = addslashes($_POST['description_round']);
        $query = "INSERT INTO rounds (name,max_score,description) VALUES(:na,:ms,:des)";
        $values = array(':na' => $_POST['roundname'],':ms'=>$_POST['maxscore'],':des'=>$des);
        $this->query_execute($query, $values);               
    }

    public function get_round() {
        $query = "SELECT * FROM rounds WHERE id = :id";
        $values = array(':id' => $_GET['id']);
        $round= $this->query_execute($query, $values);
        return $round[0];
    }

    public function get_round_($rid) {
        $query = "SELECT * FROM rounds WHERE id = :id";
        $values = array(':id' => $rid);
        $round= $this->query_execute($query, $values);
        return $round[0];
    }


    public function edit_round() {
        $des = addslashes($_POST['description_round']);
        $query = "UPDATE rounds set name = :na,max_score = :ms,description =:des WHERE id = :id";
        $values = array(
            ':id'=> $_POST['roundid'],
            ':na' => $_POST['roundname'],
            ':des' =>$des,
            ':ms'=> $_POST['maxscore']);
        $this->query_execute($query, $values);               
    }
    public function delete_round() {
        /*$query = "DELETE FROM rounds WHERE id = :id";
        $values = array(':id' => $_POST['id']);
        */
        $delete = 1;
        $query = "UPDATE `rounds` SET `soft_delete`= :soft_delete " 
        . " WHERE `id` = :id";
        $values = array(
            ':id' => $_POST['id'],
            ':soft_delete' => $delete
        );
        $this->query_execute($query, $values);               
    }
     
}
