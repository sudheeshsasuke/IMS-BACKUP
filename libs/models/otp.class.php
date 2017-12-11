<?php
class Otp extends Database{
    public $mailid;

    public function insert_otp($otp){
    
      $mail ="harikk173@gmail.com";
      $mailid = $mail;
      $query = "INSERT INTO `otp`(`otp`, `flag`, `date`, `email`)"
        . " VALUES (:otp, :flag, :date, :email)";

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

    public function get_otp() {
        
        $mail ="harikk173@gmail.com";
        $query = "SELECT * FROM `otp`"
        . " WHERE `email` = :email ";

        $values = array(
            ':email' => $mail
        );

        $data = $this->query_execute($query, $values);
        return $data[0];

    }

    public function remove_otp(){
        $mail ="harikk173@gmail.com";
        $query = "DELETE FROM `otp`"
        . " WHERE `email` = :email ";

        $values = array(
            ':email' => $mail,
        );

        $data = $this->query_execute($query, $values);

    }

}
?>