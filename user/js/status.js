$(document).ready(function () {
   
    var btnstatus = $('#status').val();
    $(btnstatus).on("click", function () {
        
        var result = $('#statusresult').val();
        alert(result);
        var newRow = $("<p>");
        var round = "";
        
         for(var key in result) {
             if(key==btnstatus) {
                 round +='<p>Shortlisted for'+result['name']+'round</p>';
             }
         }
        $('.modal-body').html(newrow);
    });

    $(".interviewstatus").on("click", ".statusdetails", function (event){
    
});
});
