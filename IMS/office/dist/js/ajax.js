$(document).ready(function(){
    //alert("hii");
    $(".delbtn").click(function(){
        //alert("functioncall");
        
        
        var intrvwid = $(this).val();
      
       // alert(pid);
       console.log(intrvwid);
        $.ajax({
            type:"POST",
            data:{"id":intrvwid}, 
            url: "http://ims.com/admin/interview/deleteinterview", 
            success: function(result){intrvwdisplay();}
        });
        return false;
    });

    //jquery for deleting rounds
    $(".rounddelbtn").click(function(){
        // alert("hiii hghf");
         
         
         var roundid = $(this).val();
       
        // alert(pid);
        // console.log(pid);
         $.ajax({
             type:"POST",
             data:{"id":roundid}, 
             url: "http://ims.com/admin/round/deleteround", 
             success: function(result){rounddisplay();}
         });
         return false;
     });

     $("#btn_finallist").click(function(){
        //alert("finallistfncall");
       
         var intrvwid = $(this).val();
         //var intrvwid = $interviewtitle['id'];
         alert(intrvwid);
        // console.log(pid);
         $.ajax({
             type:"POST",
             data:{"final_list":intrvwid,"id":intrvwid}, 
             url: "http://ims.com/admin/score_management", 
             success: function(result){
                $('body').html(result);   
             }
         });
         return false;
     });

     //change button view on clicking completelist
     $("#btn_full_list").click(function(){
        var intrvwid = $(this).val();
        $.ajax({
             type:"POST",
             data:{"id":intrvwid}, 
             url: "http://ims.com/admin/score_management", 
             success: function(result){
                $('body').html(result);   
             }
         });
         return false;
     });

     //round update button 
     $("#btn_update_confirm").click(function(){
        
         //alert("updateclick");
        var intrvwid = $(this).val();
        var rid = $("#select_round").val();
        //alert(rid);
        //console.log(rid);

        var checked = [];
        $.each($("input[name='checkedusers[]']:checked"), function(){            
            checked.push($(this).val());
        });
        //alert("Checked candidates  are: " + checked.join(", "));

        //var checkedlist = (array) ($("#checkedusers").val());
        console.log(checked);
        $.ajax({
             type:"POST",
             data:{"id":intrvwid,"roundid":rid,"checkedusers":checked}, 
             url: "http://ims.com/admin/score_management/updatestatus", 
             success: function(result){score_display(intrvwid);}
            });
            return false;
        });

    function score_display(intrvwid){
        $.ajax({
            type:"POST",
            data:{"id":intrvwid},
            url: "http://ims.com/admin/score_management",
            success: function(result) {
                $('body').html(result);
            }
       });
    };

   function intrvwdisplay(){
        $.ajax({
           url: "http://ims.com/admin/interview",
            success: function(result) {
                $('body').html(result);
            }
       });
    };

   function rounddisplay(){
        $.ajax({
            url: "http://ims.com/admin/round",
            success: function(result){    
                $('body').html(result);
            }
        });
    };
});

/*
//jquery for deleting rounds
$(document).ready(function(){
    alert("hiii");
    $(".rounddelbtn").click(function(){
       // alert("hiii hghf");
        
        
        var roundid = $(this).val();
      
       // alert(pid);
       // console.log(pid);
        $.ajax({
            type:"POST",
            data:{"id":intrvwid}, 
            url: "http://ims.com/admin/round/deleteround", 
            success: function(result){display();}
        });
        return false;
    });
   function display(){
        
        $.ajax({
           url: "http://ims.com/admin/round",
            success: function(result){
            $('body').html(result);}
       });
    
  };
});

*/
