$(document).ready(function () {
     
    $("#profilesubmit").on("click", function () {
        
        var entered_email = $('#emailid').val(); 
        var entered_phno = $('#phone').val();  
        if (!(/^([a-z0-9])([\w\.\-\+])+([a-z0-9])\@(([\w\-]?)+\.)+([a-z]{2,4})$/i.test(entered_email))) {
            alert ("Invalid email address!");
            return false;
            }
        if (!(/^[789]\d{9}$/.test(entered_phno))) {
            alert ("Invalid phone number!\nEnter your mobile number without country code.");
            return false;
        }
    });

});