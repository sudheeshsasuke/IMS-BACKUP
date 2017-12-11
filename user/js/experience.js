$(document).ready(function () {   
  
    $("#addrow").on("click", function () {
        var counter = $('#exp_counter').val();
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" placeholder="Date" name="start_date' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Date" name="end_date' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Enter Company Name Here.." name="company' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Company location.." name="location' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Designation.." name="position' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="Enter Reason.." name="reason_for_leaving' + counter + '"/></td>';
        

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