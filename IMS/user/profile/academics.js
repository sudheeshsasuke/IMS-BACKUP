$(document).ready(function () {
    
   
    $("#acadaddrow").on("click", function () {
        var counter = $('#acad_counter').val();
       //alert(counter);
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="course' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="math_score' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="percentage' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="year_of_passout' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btnprofile btn-delete"  value="Delete"></td>';
        newRow.append(cols);
        newRow.append("</tr>");
        $("#academicsTable").append(newRow);
        counter++;  
        //alert(counter);
        $('#acad_counter').val(counter);
    });


    $("#academicsTable").on("click", ".ibtnDel", function (event) {
        var removedid = $(this).closest("tr").find('#findid').attr('value');
        $('#removedid').val(removedid);
        $(this).closest("tr").remove();
       // alert(removedid);
       
       
    });
    

});