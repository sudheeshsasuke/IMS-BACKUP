<?php

class GoogleRegistration extends database {
    
    public function googleregister() {
        $a = 1;
        $arra = array(':email'=>$_POST['email'],
                    ':password'=>$a
        );
        $queryi = "SELECT * FROM participant WHERE email=:email AND password=:password";
        $count = $this->query_execute($queryi, $arra);
        if(empty($count)) { 
            $arr = array(':email'=>$_POST['email'],
                        ':name'=>$_POST['name'],
                        ':password'=>$a
            );
            $query = "INSERT INTO participant(`name`, `email`, `password`) VALUES(:name, :email, :password)";
            $this->query_execute($query, $arr);
            $_SESSION['gmail'] = $_POST['email']; 
            header("Location:http://ims.com/user/googlelogin"); 
        }
        else {
            $_SESSION['gmail'] = $_POST['email']; 
            header("Location:http://ims.com/user/googlelogin"); 
        }
    }
}    