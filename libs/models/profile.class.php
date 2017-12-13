<?php

class profile extends database {
    
    public function get_personal_details() {
        //fetch all details of participant from participant table
        $query1 = "SELECT * FROM participant WHERE id = :part_id";        
        $values = array(':part_id' => $_SESSION['id']);
        $personal_details = $this->query_execute($query1,$values);
        return $personal_details;
    }

    public function get_academic_details() {
        //fetch all academic details of participant from academics table                                         
        $query2 = "SELECT * FROM academics WHERE part_id = :part_id AND soft_delete = :soft_delete";      
        $soft_delete=0;    
        $values = array(':part_id' => $_SESSION['id'],
                        ':soft_delete'=> $soft_delete);
        $academic_details = $this->query_execute($query2,$values);              
        return $academic_details;
    }
    public function get_experience_details() {
        //fetch all experience details of participant from work_experience table                     
        $query3 = "SELECT * FROM work_experience WHERE part_id = :part_id AND soft_delete = :soft_delete";
        $soft_delete=0;   
        $values = array(':part_id' => $_SESSION['id'],
                        ':soft_delete'=> $soft_delete);
        $experience_details = $this->query_execute($query3,$values);            
        return $experience_details;
    }

    public function get_skill_details() {
        //fetch all skill details of participant from skill table                   
        $query4 = "SELECT * FROM skill WHERE pid = :part_id AND soft_delete = :soft_delete";
        $soft_delete=0;   
        $values = array(':part_id' => $_SESSION['id'],
                        ':soft_delete'=> $soft_delete);
        $skill_details = $this->query_execute($query4,$values);            
        return  $skill_details;
    }
    
    public function update_personal_details() {
        //Update participant table
        $query = "UPDATE participant SET name = :name, email = :email, phone = :phone 
        WHERE id = :id";     
        $values = array(':name'=>$_POST['name'],
                        ':email'=>$_POST['email'],
                        ':phone'=>$_POST['phone'],
                        ':id' => $_SESSION['id']);
        $this->query_execute($query,$values);
        $_SESSION['username'] = $_POST['name']; 
    }

    public function upload_resume() {
        $id = $_SESSION['id'];
        $target_dir = "user/uploads/";
        $target_file = $target_dir.$id."_".basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $uploadOk = 1;
       
      
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            echo $imageFileType;
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {
                echo "The file ".basename($_FILES["fileToUpload"]["name"])."has been uploaded";
                $query = "UPDATE participant SET resume = :target_file WHERE id = :id";
                $values = array(':id' => $id,
                                ':target_file' => $target_file);
                $this->query_execute($query,$values);          
            } else {
                echo "Error";
                return null;
            }
        }
        }
         
    public function update_academic_details() {
        
        //Soft delete rows from academics table
        for($rid=1;$rid<$_POST['initial_acad_counter'];$rid++) {          
            if(isset($_POST['removedid'.$rid])) {
                $soft_delete = 1;                
                $query = "UPDATE academics SET soft_delete=:soft_delete WHERE id=:id";
                $values = array(':id' => $_POST['removedid'.$rid],
                                ':soft_delete'=> $soft_delete); 
                $this->query_execute($query,$values);        
            }
        }
        //Update details in academics table
        for($id=1;$id<$_POST['initial_acad_counter'];$id++)  {              
            $query = "UPDATE academics SET course = :course, course_name = :course_name, math_score = :math_score, percentage = :percentage, year_of_passout = :year_of_passout
                        WHERE part_id = :part_id AND id=:id" ;
            $values = array(':id' => $_POST['id'.$id],
                            ':part_id' => $_SESSION['id'],
                            ':course'=>$_POST['course'.$id],
                            ':course_name'=>$_POST['course_name'.$id],
                            ':math_score'=>$_POST['math_score'.$id],
                            ':percentage'=>$_POST['percentage'.$id],
                            ':year_of_passout'=>$_POST['year_of_passout'.$id]); 
            $this->query_execute($query,$values);        
        }   
        //If new rows are added, insert rows in academics table
        for($sid=$_POST['initial_acad_counter'];$sid<$_POST['acad_counter'];$sid++)   {
            $query ="INSERT INTO academics(part_id, course, course_name, math_score, percentage, year_of_passout)
                    VALUES (:part_id, :course, :course_name, :math_score, :percentage, :year_of_passout)";            
            $values = array(':part_id' => $_SESSION['id'],
                            ':course'=>$_POST['course'.$sid],
                            ':course_name'=>$_POST['course_name'.$id],
                            ':math_score'=>$_POST['math_score'.$sid],
                            ':percentage'=>$_POST['percentage'.$sid],
                            ':year_of_passout'=>$_POST['year_of_passout'.$sid]); 
            $this->query_execute($query,$values);      
        }
    
    }

    public function update_experience_details()  {
        
        for($rid=1;$rid<$_POST['initial_exp_counter'];$rid++) {
            if(isset($_POST['exp_removedid'.$rid])) {
                $soft_delete = 1;
                $query = "UPDATE work_experience SET soft_delete=:soft_delete WHERE id=:id";
                $values = array(':id' => $_POST['exp_removedid'.$rid],
                                ':soft_delete'=> $soft_delete); 
                $this->query_execute($query,$values);        
            }
        }
            for($id=1;$id<$_POST['initial_exp_counter'];$id++)  {

                $query = "UPDATE work_experience SET company = :company, position = :position, location = :location, start_date = :start_date, end_date = :end_date, reason_for_leaving = :reason_for_leaving
            WHERE part_id = :part_id AND id=:id" ;
            $values = array(':id' => $_POST['exp_id'.$id],
                            ':part_id' => $_SESSION['id'],
                            ':company'=>$_POST['company'.$id],
                            ':position'=>$_POST['position'.$id],
                            ':location'=>$_POST['location'.$id],
                            ':start_date'=>$_POST['start_date'.$id],
                            ':end_date'=>$_POST['end_date'.$id],
                            ':reason_for_leaving'=>$_POST['reason_for_leaving'.$id]); 
            $this->query_execute($query,$values);        
            }   
        
        
        for($sid=$_POST['initial_exp_counter'];$sid<$_POST['exp_counter'];$sid++)   {
            $query ="INSERT INTO work_experience(part_id, company, position, location, start_date, end_date, reason_for_leaving)
                VALUES (:part_id, :company, :position, :location, :start_date, :end_date, :reason_for_leaving)";
            
            $values = array(':part_id' => $_SESSION['id'],
                            ':company'=>$_POST['company'.$sid],
                            ':position'=>$_POST['position'.$sid],
                            ':location'=>$_POST['location'.$sid],
                            ':start_date'=>$_POST['start_date'.$sid],
                            ':end_date'=>$_POST['end_date'.$sid],
                            ':reason_for_leaving'=>$_POST['reason_for_leaving'.$sid]);  
            $this->query_execute($query,$values);      
            echo "Inserted";  
        }
        
    }

    public function update_skill_details()  {
        
        for($rid=1;$rid<$_POST['initial_skill_counter'];$rid++) {
            if(isset($_POST['skill_removedid'.$rid])) {             
                $query = "UPDATE skill SET soft_delete=:soft_delete WHERE id=:id";
                $values = array(':id' => $_POST['skill_removedid'.$rid]); 
                $this->query_execute($query,$values);        
            }
        }
        for($id=1;$id<$_POST['initial_skill_counter'];$id++)  {
        $query = "UPDATE skill SET title = :title, score=:score
        WHERE pid = :part_id AND id=:id" ;
        $values = array(':id' => $_POST['skill_id'.$id],
                        ':part_id' => $_SESSION['id'],
                        ':title'=>$_POST['title'.$id],
                        ':score'=>$_POST['score'.$id]);
        $this->query_execute($query,$values);        
        }   
        
        
        for($sid=$_POST['initial_skill_counter'];$sid<$_POST['skill_counter'];$sid++)   {
            $query ="INSERT INTO skill(pid, title, score)
                VALUES (:part_id, :title, :score)";
            $values = array(':part_id' => $_SESSION['id'],
                            ':title'=>$_POST['title'.$sid],
                            ':score'=>$_POST['score'.$sid]);
            $this->query_execute($query,$values);      
            echo "Inserted";  
        }
        
    }

}

?>

