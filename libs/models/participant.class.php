<?php

// model.php
//require_once 'database.php';

class participant extends database {

    public function loginuser() {
        
        if(isset($_SESSION['apply_interview_id'])) {
            $active = 1;
            
                        // function for logging the user in
            $arr=array(':email'=>$_POST['loginemail'],
                        ':password'=>sha1($_POST['loginpassword']),
                        ':active'=>$active
                        );
            $query = "SELECT * FROM participant"
            . " WHERE email=:email AND password=:password AND active = :active";
            $result = $this->query_execute($query,$arr);
            $results = $result[0]; 
            
            if(isset($result) && !empty($result)) {
                $_SESSION['id'] = $results['id'];
                $_SESSION['username'] = $results['name'];
                header("Location:http://ims.com/insert_into_intpart"); 
            } 
        }
            
        else {
            $active = 1;

            // function for logging the user in
            $arr=array(':email'=>$_POST['loginemail'],
                    ':password'=>sha1($_POST['loginpassword']),
                    ':active'=>$active
                );
            $query = "SELECT * FROM participant"
            . " WHERE email=:email AND password=:password AND active = :active";
            $result = $this->query_execute($query,$arr);
            $results = $result[0];

            if(isset($result) && !empty($result)) {
                $_SESSION['id'] = $results['id'];
                $_SESSION['username'] = $results['name'];
                header("Location:http://ims.com/"); 
            }
            else {
                header("Location:http://ims.com/user/templates/confirmationerror.tpl.php"); 
            } 
        }       
    }
    public function get_all_participants() {
        $query = "SELECT * FROM participant";
        $participants = $this->query_execute($query, $values);
        return $participants;
    }

    //get the participant details corresponding to a list of participant IDs
    public function get_participants($pids) {
        foreach ($pids as $pid) {
            $query = "SELECT * FROM participant WHERE id = :id";
            $values = array(':id'=>$pid);
            $participant = $this->query_execute($query, $values);
            $participants[] = $participant[0];
        }
       
        return $participants;
    }
    public function delete_participant() {
        $query = "DELETE  FROM participant WHERE id = :id";
        $values = array(':id'=>$_GET['id']);
        $this->query_execute($query, $values);
    }

    public function confirm_participant($mail, $code) {
        
        $arr=array(':email'=>$mail,
                ':code'=>$code
            );
        $query = "SELECT * FROM participant WHERE email=:email AND code=:code";
        $result = $this->query_execute($query, $arr);
        $participant = $result[0];
        if(!empty($participant)) {
            $query = "UPDATE `participant` SET `active`=:active"
            . " WHERE id=:id";
            $array = array(
                ':active' => '1',
                ':id' => $participant['id']
            );
            $res = $this->query_execute($query, $array);
            if($res == NULL) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function recovery_email() {
        
        $mail = $_POST['recovery_email'];
  

        //generate a new otp and add it in otp table
        $query = "INSERT INTO `otp`(`otp`, `flag`, `date`, `email`)"
        . " VALUES (:otp, :flag, :date, :email)";

        $otp = sha1(rand(100, 1000));
        $flag = 1;
        $date = date("Y-m-d");

        $values = array(
            ':otp' => $otp,
            ':flag' => $flag,
            ':date' => $date,
            ':email' => $mail
        );

        $result = $this->query_execute($query, $values);
        if($result == NULL) {
            $data['mail'] = $mail;
            $data['otp'] = $otp;
            return $data;
        }
        else {
            return NULL;
        }
    }

    public function forgot_password_user_verification($mail, $otp) {
        
       // $query = "SELECT * FROM `otp`"
        //. " WHERE `email` = :email AND `otp` = :otp";
        $query = "SELECT p.id, p.name FROM `participant` AS p JOIN otp AS o
        ON o.email = p.email
        WHERE p.password != 1 AND p.email = :email AND o.otp = :otp";
        $values = array(
            ':email' => $mail,
            ':otp' => $otp
        );

        $data = $this->query_execute($query, $values);
        return $data[0];

    }
    public function forget_password_user_login($mail) {

    }
    public function google_login() {
        $a = 1;
        $arra = array(':email'=>$_SESSION['gmail'],
        ':password'=>$a
        );
        $queryi = "SELECT * FROM participant"
        . " WHERE email=:email AND password=:password";
        $result = $this->query_execute($queryi, $arra);
        $results = $result[0];
        $_SESSION['id'] = $results['id'];
        $_SESSION['username'] = $results['name'];
        //header("Location:http://ims.com/"); 
    }

    public function personal_details() {
        $query = "SELECT * FROM participant WHERE id = :part_id";        
        $values = array(':part_id' => $_GET['pid']);
        $personal_details = $this->query_execute($query,$values);     
        return $personal_details;
    } 
}