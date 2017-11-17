<?php 


        
        $name = 'sud';
        $email_address = 'sudheesh.qbgxc.zyxware@gmail.com';
        $mail = $email_address;
        $code = 123;
        
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
        
?>