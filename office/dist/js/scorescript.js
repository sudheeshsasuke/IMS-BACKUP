$(".loader").css("display","none");

$(document).ready(function(){
    $(".delbtn").click(function(){
        var intrvwid = $(this).val();
        $.ajax({
            type:"POST",
            data:{"id":intrvwid}, 
            url: "http://ims.com/admin/interview/deleteinterview", 
            success: function(result){intrvwdisplay();}
        });
        return false;
    });

    //jquery for deleting mail template
    $(".maildelbtn").click(function(){
        var templateid = $(this).val();
        $.ajax({
            type:"POST",
            data:{"templateid":templateid}, 
            url: "http://ims.com/admin/mailtemplate/deletemailtemplate", 
            success: function(result){mailtemplatedisplay();}
        });
        return false;
    });
    //jquery for deleting rounds
    $(".rounddelbtn").click(function(){
        var roundid = $(this).val();
        $.ajax({
             type:"POST",
             data:{"id":roundid}, 
             url: "http://ims.com/admin/round/deleteround", 
             success: function(result){rounddisplay();}
         });
         return false;
     });
     //changing select round options
    $("#select_round").change(function(){
        var intrvwid = $("#txt_intid").val();
        var rid = $("#select_round").val();
        $.ajax({
            type:"POST",
            data:{"id":intrvwid,"roundid":rid}, 
            url: "http://ims.com/admin/score_management", 
            success: function(result){
                var response = $(".box-header",result).html();   
                $("box-header").html(response); 
            }
         });
         return false;
     });


    $("#btn_finallist").click(function(){
        var intrvwid = $(this).val();
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


    //checking
    $("#btn_update_confirm").click(function(){
        
        var intrvwid = $(this).val();
        var rid = $("#select_round").val();
        var checked = [];
        $.each($("input[name='checkedusers[]']:checked"), function(){            
            checked.push($(this).val());
        });
        
        if(checked == "") {
           
            alert("No Candidate Selected");
            
        }
        
        if(checked != "" && rid != "") {
            $(".loader").css("display","block");
            $(".modal-body").css("display","none");
            $.ajax({
                type:"POST",
                data:{"id":intrvwid,"roundid":rid,"checkedusers":checked},
                url: "http://ims.com/admin/score_management/updatestatus",
                success: function(result) {
                    $(".loader").css("display","none");
                    $(".modal-body").css("display","block");
                    score_display(intrvwid);
                }
            });
        }
       
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
                var response = $(".box-body",result).html();
                $(".box-body").html(response);
            }
       });
    };

   function rounddisplay(){
       
        $.ajax({
            url: "http://ims.com/admin/round",
            success: function(result){ 
                var response = $(".box-body",result).html();   
                $('.box-body').html(response);
            }
        });
    };

    function mailtemplatedisplay(){
        
         $.ajax({
             url: "http://ims.com/admin/mail_template",
             success: function(result){    
                 $('body').html(result);
             }
         });
     };
});


