<?php

class GoogleRegistration extends database {
    
    public function googleregister() {
        $a = 1;
        $id_token = $_POST['id_token'];
        $CLIENT_ID = "954781805397-vgrd061a992gdn9c4r7d3rum4m72303v.apps.googleusercontent.com";
        $client = new Google_Client(['client_id' => $CLIENT_ID]);
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $userid = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'];
            $arra = array(':email'=>$email,
                        ':password'=>$a
            );
            $queryi = "SELECT * FROM participant WHERE email=:email AND password=:password";
            $count = $this->query_execute($queryi, $arra);
            if(empty($count)) { 
                $arr = array(':email'=>$email,
                            ':name'=>$name,
                            ':password'=>$a
                );
                $query = "INSERT INTO participant(`name`, `email`, `password`) VALUES(:name, :email, :password)";
                $this->query_execute($query, $arr);
                $_SESSION['gmail'] = $email; 
                header("Location:http://ims.com/user/googlelogin"); 
            }
            
            else {
                $_SESSION['gmail'] = $email; 
                header("Location:http://ims.com/user/googlelogin"); 
        
            }
        }  
        
        else {
            echo "invalid token";
        }
    }
}    