<?php
	class Experience extends database{
        public function get_experience_details()
        {
            $query = "SELECT * FROM work_experience";
            $posts = $this->query_execute($query, $values);
            return $posts; 
        }
        public function experience_details() {                
            $query = "SELECT * FROM work_experience WHERE part_id = :part_id";
            $values = array(':part_id' => $_GET['pid']); 
            $experience_details = $this->query_execute($query,$values);            
            return  $experience_details;
    
        }
	} 
?>