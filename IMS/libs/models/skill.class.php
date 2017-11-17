<?php

class skill extends database {
    public function skill_details() {     
        $query = "SELECT * FROM skill WHERE pid = :part_id";
        $values = array(':part_id' => $_GET['pid']);
        $skill_details = $this->query_execute($query,$values);            
        return  $skill_details;
    }
}