$(document).ready(function () {
    
   
    $("#skill_addrow").on("click", function () {
        var counter = $('#skill_counter').val();
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="title' + counter + '"/></td>';
        cols += '<td><label><input type="radio" name="score' + counter + '" value="1">Low</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter + '" value="2">Medium</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter + '" value="3">High</label></td>';
        cols += '<td><label><input type="radio" name="score' + counter + '" value="4">Very high</label></td>';
        
        cols += '<td><input type="button" class="ibtnDel btn btnprofile btn-delete"  value="Delete"></td>';
        newRow.append(cols);
        $("#skillTable").append(newRow);
        counter++;
        $('#skill_counter').val(counter);
    });



    $("#skillTable").on("click", ".ibtnDel", function (event) {
        var removedid = $(this).closest("tr").find('#skill_findid').attr('value');
        $('#skill_removedid').val(removedid);
        $(this).closest("tr").remove();
    });
});