$(document).ready(function () {
    
   
    $("#acadaddrow").on("click", function () {
        var counter = $('#acad_counter').val();
       //alert(counter);
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><select class="form-control" name="course' + counter + '"><option value="10">10</option><option value="12">12</option><option value="UG">UG</option><option value="PG">PG</option></select></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Board/Course" name="course_name' + counter + '"/></td>';													
        cols += '<td><input type="text" class="form-control" placeholder="Score in maths" name="math_score' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Enter Percentage" name="percentage' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Enter year" name="year_of_passout' + counter + '"/></td>';

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