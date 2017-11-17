$(function () {

    $("#loader").hide();
    $('#user_registration_form').submit(function () {
        $("#loader").show();
    });
});


function Validate() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;

    if (name === '') {
        alert("Name is empty");
        return false;
    }
    if (email === '') {
        alert("email is empty");
        return false;
    }
    if (phone === '') {
        alert("phone is empty");
        return false;
    }

    else {
        return true;
    }
}