/*
*  validation for any form
*/
function validate(formname) {

    var values = {};
   
    //get input form values of job post into values associative array
    $.each($(formname).serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });

    //check validation in values array
    for(var key in values) {
        if (values[key] == "" || values[key] == " ") {
            alert("Input field is empty");
            return false;
        }
    }

    return true;
}

//validation while updating round status
function validate_roundupdate() {
    var select_box = document.getElementById("select_round");
   
    if(select_box.value == " ") {
        alert("please select a round");
        e.stopPropagation();
        return false;
    }
    else if(document.getElementById("checkeduser").checked == false)
    {
       alert("No candidate selected");
       //event.preventDefault();
       return false;
    }
    else {
        $("#update_stat").modal();
    }
}


function validate_round() {
    var check_select_box = document.getElementById("selectround")
    console.log(check_select_box.value);
    if(check_select_box.value == " ") {
        alert("please select a round");
        return false;
    }
    else {
        return true;
    }
  }