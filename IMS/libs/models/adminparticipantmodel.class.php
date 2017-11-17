<?php
  class AdminParticipantModel extends database{
      
    public $id;
      
    public function insert_personal_details() {
        //Update participant table
        $password=1;
        $query = "INSERT INTO participant (`name` ,`email`,`password` , `phone`) VALUES (:name, :email,:password, :phone)" ;  
        $values = array(':name'=>$_POST['name'],
                        ':email'=>$_POST['email'],
                        ':password'=>$password,
                        ':phone'=>$_POST['phone'],);
        $this->query_execute($query,$values);
        $this->id = $this->last_insert_id();  
    }

    public function upload_resume() {
        
        $target_dir = "user/uploads/";
        $target_file = $target_dir.$this->id."_".basename($_FILES["fileToUpload"]["name"]);
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
                $values = array(':id' => $this->id,
                                ':target_file' => $target_file);
                $this->query_execute($query,$values);  
            // $result = $link->prepare("UPDATE login SET photo = :target_file WHERE id = :id");
            //return $target_file;
            } else {
                echo "Error";
                return null;
            }
        }
    }
         
    public function insert_academic_details() {
        
        for($sid=1;$sid<=$_POST['acad_counter'];$sid++)   {
            $query ="INSERT INTO academics(part_id, course, math_score, percentage, year_of_passout)
                VALUES (:part_id, :course, :math_score, :percentage, :year_of_passout)";
                
            
            $values = array(':part_id' =>$this->id ,
            ':course'=>$_POST['course'.$sid],
            ':math_score'=>$_POST['math_score'.$sid],
            ':percentage'=>$_POST['percentage'.$sid],
            ':year_of_passout'=>$_POST['year_of_passout'.$sid]); 
            $this->query_execute($query,$values);      
            //echo "Inserted";  
        }
    
    }

    public function insert_experience_details()  {
        
        for($sid=1;$sid<=$_POST['exp_counter'];$sid++)   {
            $query ="INSERT INTO work_experience(part_id, company, position, location, start_date, end_date, reason_for_leaving)
                VALUES (:part_id, :company, :position, :location, :start_date, :end_date, :reason_for_leaving)";
            
            $values = array(':part_id' => $this->id,
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

    public function insert_skill_details()  {
    
        for($sid=1;$sid<=$_POST['skill_counter'];$sid++)   {
            $query ="INSERT INTO skill(pid, title, score)
                VALUES (:part_id, :title, :score)";
            $values = array(':part_id' => $this->id,
            ':title'=>$_POST['title'.$sid],
            ':score'=>$_POST['score'.$sid]);
            $this->query_execute($query,$values);      
            echo "Inserted";  
        }
        
  }
}
?>