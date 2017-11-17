$(document).ready(function(){

    //loader gif animation
    $("#loader").hide();

    /*get the height of all interviews div
    * set it t the empty div in the middle
    */
    var x = $("#getheight").height();
    $("#fillspace").height(x);
    $("#user_registration_form").submit(function(event) {

        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            alert("Please check the recaptcha");                  
        }
        else {

            //loader gif for confirmation mail process
            $("#loader").show();
        }                    
    });

    //loader gif for recovery mail process
    $('#recoverymail').submit(function () {
        $("#loader").show();
    }); 
})

//for form validation
function Validate() {
    var input = document.getElementById('input_name').value;

    if (input === '') {
        alert("Form is empty");
        return false;
    }
    else {
        return true;
    }
}