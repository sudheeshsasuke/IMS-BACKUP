$(document).ready(function () {   
  
    $("#addrow").on("click", function () {
        var counter = $('#exp_counter').val();
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="start_date' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="end_date' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="company' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="location' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="position' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="reason_for_leaving' + counter + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel btn btnprofile btn-delete"  value="Delete"></td>';
        newRow.append(cols);
        $("#experienceTable").append(newRow);
        counter++;
        $('#exp_counter').val(counter);
    });

    $("#experienceTable").on("click", ".ibtnDel", function (event) {
        var removedid = $(this).closest("tr").find('#exp_findid').attr('value');
        $('#exp_removedid').val(removedid);
        $(this).closest("tr").remove();
    });
    
});