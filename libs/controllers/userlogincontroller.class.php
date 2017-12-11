<?php

class UserLoginController extends participant {

    public function loginuser() {
        //this calls the function loginuser from participant for logging the user
        $this->loginuser();

    }
    
    public function confirm_user($mail, $code) {
        $result = $this->confirm_participant($mail, $code);
        if($result) {
            include 'user/templates/login.tpl.php';
        }
        else {
            include 'user/templates/registrationerror.tpl.php';
        }
   }
   
   public function forgot_password_form() {
        include 'user/templates/forgotpasswordform.tpl.php';
   }
   
   public function forgot_password_form_action() {
       $result = $this->recovery_email();
       if($result != NULL) {
            $this->send_recovery_mail($result['mail'], $result['otp']);
            include 'user/templates/forgotpassword.tpl.php';
        }
        else {
            include 'user/templates/recoverymailerror.tpl.php';
        }
   }


    public function send_recovery_mail($mail, $code) {
        
        $email_address = $mail;

        $confirmation_link = 'http://ims.com/user/recovery_mail?email=' 
        . $mail . '&otp=' . $code; 

        // Create the email and send the message
        $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Recovery Mail";
        $email_body = "You have received a recovery mail to login IMS.com"
        . "\nPlease enter a new password by visiting/clicking on the link below"
        . "\n $confirmation_link";
        $headers = "From: noreply@IMS.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: $email_address";   
        mail($to,$email_subject,$email_body,$headers);
        return true;         

    }

    public function forgot_password_user($mail, $otp) {
        $result = $this->forgot_password_user_verification($mail, $otp);
        if(!empty($result)) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['name'];
            include 'user/templates/setnewpassword.tpl.php';
           // header('location:http://ims.com/user/set_new_password');
        }
        else {
            include 'user/templates/error.tpl.php';
        }
    }

    public function new_password_user($loginemail,$loginpassword) {
        $query = "UPDATE participant SET password =:password WHERE email = :email";
        $array = array(':password'=>sha1($loginpassword),
                        ':email'=>$loginemail);
        $this->query_execute($query, $array);
        header('location:http://ims.com');
    }
}    