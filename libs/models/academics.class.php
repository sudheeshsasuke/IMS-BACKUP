<?php

class Academics extends database {
    public function get_acadamic_details()
    {
        $query = "SELECT * FROM academics";
        $posts = $this->query_execute($query, $values);
        return $posts; 
    }
    public function academic_details() {                                       
        $query = "SELECT * FROM academics WHERE part_id = :part_id";       
        $values = array(':part_id' => $_GET['pid']);
        $academic_details = $this->query_execute($query,$values);        
        return $academic_details;
    }
}
?>