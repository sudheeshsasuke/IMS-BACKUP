$(document).ready(function () {
    //var counter;
    //var removeid;
    
    $("#acadaddrow").on("click", function () {
        var counter = $('#acad_counter').val();
       //alert(counter);
        var newRow = $("<tr>");
        var cols = "";
        counter++; 
        cols += '<td><input type="text" class="form-control" name="course' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="math_score' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="percentage' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="year_of_passout' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        newRow.append("</tr>");
        $("#academicsTable").append(newRow);
        $('#acad_counter').val(counter);
       // alert(counter);
        
       
    });
    

    $("#academicsTable").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        $('#acad_counter').val(counter);
       // alert(removedid);
    });
    
    
    $("#addrow").on("click", function () {
        var counter1 = $('#exp_counter').val();
        var newRow = $("<tr>");
        var cols = "";
        counter1++;
        cols += '<td><input type="text" class="form-control" name="start_date' + counter1 + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="end_date' + counter1 + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="company' + counter1 + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="location' + counter1 + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="position' + counter1 + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="reason_for_leaving' + counter1 + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("#experienceTable").append(newRow);
        $('#exp_counter').val(counter1);
        
    });
    
    $("#experienceTable").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        $('#exp_counter').val(counter1);
    });
    var counter2 = 1;
    $("#skill_addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        counter2++;
        cols += '<td><input type="text" class="form-control" name="title' + counter2 + '"/></td>';
        cols += '<td><label><input type="radio" name="score' + counter2 + '" value="1">Low</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter2 + '" value="2">Medium</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter2 + '" value="3">High</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter2 + '" value="4">Very high</label></td>';
        
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("#skillTable").append(newRow);
        $('#skill_counter').val(counter2);
        
    });

    

    $("#skillTable").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        $('#skill_counter').val(counter2);
    });

});