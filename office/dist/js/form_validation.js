/*
*  validation for any form
*/
function validate(formname) {

    var values = {};
    //alert(formname);

    //get input form values of job post into values associative array
    $.each($(formname).serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });

    //check validation in values array
    for(var key in values) {
        
        //alert(values[key]);
        if (values[key] == "" || values[key] == " ") {
            alert("Input field is empty");
            return false;
        }
    }

    return true;
}