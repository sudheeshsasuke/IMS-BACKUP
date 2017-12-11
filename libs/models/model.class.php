<?php

// model.php
//require_once 'database.php';

class model extends database {



    public function get_all_notappliedinterviews() {

        //optimized code
        /*$interviews = $this->prepare("SELECT" , "*", "interview", NULL)
                    ->fetch();
        return $interviews;*/
        $flag = 0;
        $arr = array(
            ":id"=>$_SESSION['id'],
            ':soft_delete' => $flag,
            ':finished' => $flag
        );
        $query ="SELECT * FROM `interview` 
        WHERE title NOT IN 
        (SELECT DISTINCT i.title FROM interview_participant ip JOIN interview i ON i.id=ip.int_id 
        WHERE ip.part_id=:id) AND soft_delete=:soft_delete AND finished=:finished";
        $interviews = $this->query_execute($query,$arr);
        return $interviews;
        
    }

    public function get_all_interviews() {

        $flag = 0;
        $query = "SELECT * FROM `interview` "
        . " WHERE soft_delete=:soft_delete AND finished=:finished";
        $values = array(
            ':soft_delete' => $flag,
            ':finished' => $flag
        );
        $interviews = $this->query_execute($query, $values);
        return $interviews;
    }

    


    //insert interviews into interview table
    public function register() {        

        $code = rand(100, 1000);
        $code = sha1($code);
        $arra = array(':email'=>$_POST['emailid'],
                    ':password'=>sha1($_POST['password'])
        );
        $queryi = "SELECT * FROM participant WHERE email=:email";
        $count = $this->query_execute($queryi, $arra);
        if(empty($count)) { 
            $arr =  array(':name'=>$_POST['name'],
                        ':email'=>$_POST['emailid'],
                        ':password'=>sha1($_POST['password']),
                        ':phone'=>$_POST['mobile'],
                        ':code'=>$code
                        );
            $query = "INSERT INTO participant(`name`, `email`, `password`, `phone`, `code`)" 
            . " VALUES(:name, :email, :password, :phone, :code)";
            $this->query_execute($query, $arr);
            
            $this->confirm_registration($_POST['emailid'], $code); 
            //header("Location:http://ims.com/");      
        }             
        
        else {

            include 'user/templates/error.tpl.php';

        }
    }

    public function confirm_registration($mail, $code) {

        //TODO registartion confirmation
        $this->sendmail($mail, $code);
        include 'user/templates/registrationconfirmation.tpl.php';   
    }


    public function sendmail($mail, $code) {

        // Check for empty fields
        if(empty($_POST['emailid']))
        {
        echo "Invalid email!";
        return false;
        }
        
        $name = strip_tags(htmlspecialchars($_POST['name']));
        $email_address = strip_tags(htmlspecialchars($_POST['emailid']));
        
        $confirmation_link = 'http://ims.com/user/confirm_mail?email=' 
        . $mail . '&code=' . $code; 

        // Create the email and send the message
        $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Email verification mail to:  $name";
        $email_body = "You have registered to IMS.com with the following details.\n\n"
        . " Here are the details:\n\nName: $name\n\nEmail: $email_address"
        . "\n Please confirm your registartion by visiting/clicking on the link below"
        . "\n $confirmation_link";
        $headers = "From: noreply@IMS.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: $email_address";   
        mail($to,$email_subject,$email_body,$headers);
        return true;         

    }

    public function get_comment($id) {
        $query = "SELECT *, users.username AS uname FROM `comment`"
        . " JOIN users ON comment.user_id = users.id"
        . " WHERE post_id = :id";
        $values = array('id' => $id);
        $comments = $this->query_execute($query, $values);
        return $comments;
    }

    //adding data to user database table
    public function addUser($name, $email, $password)
    {
        /* $link = $this->open_database_connection();
        $password = sha1($password);
        $result = $link->prepare("INSERT INTO `users`
        (`username`, `email`, `password`, `image_path`) 
        VALUES (:name, :email, :password, :path)");
        $result->bindParam(':name',$name); 
        $result->bindParam(':email',$email); 
        $result->bindParam(':password',$password);
        $result->bindParam(':path', $_SESSION['taget_image_path']);
        
        // $password = sha1($password);
        $t = $result->execute();

        //set image name
        $_SESSION['image_name'] = $link->lastInsertId();
        $this->close_database_connection($link);
        return $t; */


        /* $query = "INSERT INTO `users`(`username`, `email`, `password`, `image_path`)" 
        . " VALUES (:name, :email, :password, :path)";
        $values = array(':name' => $name,
            ':email' => $email,
            ':password' => sha1($password),
            ':path' => $_SESSION['taget_image_path']
        );
        $posts = $this->query_execute($query, $values);
        $_SESSION['image_name'] = $this->lastId;
        return $this->t; */

        //optimized code
        $values = array('username' => $name,
            'email' => $email,
            'password' => sha1($password),
            'image_path' => $_SESSION['taget_image_path']
        );
        $obj = $this->prepare("INSERT", NULL, 'users', $values)
                    ->bind($values)
                    ->execute();
        $_SESSION['image_name'] = $obj->last_insert_id(); //calling last inert id()seperately
        return $obj->t;         
    }

    public function register_comment() {

        $values = array('user_id' => $_SESSION['user_id'],
            'comment' => $_POST['comment_text'],
            'date' => date("Y-m-d"),
            'post_id' => $_POST['post_id']
        );
        $obj = $this->prepare("INSERT", NULL, 'comment', $values)
                    ->bind($values)
                    ->execute();
    }

    //checking user with user database table
    public function checkUser($name, $password)
    {
        /* $link = $this->open_database_connection();

        $password = sha1($password);
        
        $result = $link->prepare("SELECT * FROM `users` WHERE username = :name AND password = :password");
        $result->bindParam(':name',$name); 
        $result->bindParam(':password', $password);
        
        //debug
        $t = $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->close_database_connection($link);
        if($password === $row['password']) {
            return $row;
        } else {
            return NULL;
        } */
        $password = sha1($password);
        $query = "SELECT * FROM `users`" 
        . " WHERE `username` = :name AND `password` = :password";
        
        //parse_str(":name=$name&:password=$password", $values);
        $values = array(':name' => $name,
            ':password' => $password
        );
        $posts = $this->query_execute($query, $values);
        return $posts[0];
    }

    //GetImageName()
    // i.e fetch the last inserted id and add one to it
    //it will be the image name
    public function GetImageName() {
        return $_SESSION['image_name'];
    }

    //update image path
    public function UpdateUser($name, $password) {
       /*  $link = $this->open_database_connection();
        $password = sha1($password);
        $result = $link->prepare("UPDATE `users` SET `image_path`=:val 
        WHERE `username`=:user AND `password`=:pass");
        $result->bindParam(':val', $_SESSION['taget_image_path']);
        $result->bindParam(':user', $name);
        $result->bindParam(':pass', $password);

        $t = $result->execute();
        $this->close_database_connection($link); */
        $query = "UPDATE `users` SET `image_path`=:val "
        . " WHERE `username`=:user AND `password`=:pass";
        $values = array(':val' => $_SESSION['taget_image_path'],
            ':user' => $name,
            ':pass' => sha1($password)
        );
        $posts = $this->query_execute($query, $values);
    }
    public function addinterview() {
        $query = "INSERT INTO interview (title,location,department,startdate,enddate) VALUES(':ti',':lo',':de',':sd',':ed')";
        $values = array(':ti' => $_POST['jobpost'],':lo'=> $_POST['location'],':de'=> $_POST['department'],':sd'=> $_POST['startdate'],':ed'=> $_POST['enddate']);
        $this->query_execute($query, $values);               
        }
}
