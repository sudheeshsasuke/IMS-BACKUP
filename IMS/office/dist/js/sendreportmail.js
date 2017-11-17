$(".loader").css("display","none");
function send_report(){
    $("#confirm").prop('disabled', true);
    var intrvtitle = $("#inttitle").val();
    var intid = $("#intrid").val();
    var ceo = $("#ceo").val();
    //alert(intrvtitle);
    //alert(intid);
    $(".loader").css("display","block");
    $(".modal-body").css("display","none");
    $.ajax({
        type:"POST",
        data:{
              ceo:ceo,
              title:intrvtitle,
              intid:intid
        }, 
        url: "http://ims.com/admin/send_report", 
        success: function(result){(alert("Successful"));
        $(".loader").css("display","none");
        $(".modal-body").css("display","block");
    }
    });
}
function confirm_report(){
    $("#confirm").prop('disabled', true);
    var intrvtitle = $("#inttitle").val();
    var intid = $("#intrid").val();
    var ceo = $("#ceo").val();
    $(".loader").css("display","block");
    $(".modal-body").css("display","none");
    $.ajax({
        type:"POST",
        data:{
              ceo:ceo,
              title:intrvtitle,
              intid:intid
        }, 
        url: "http://ims.com/admin/confirm_report", 
        success: function(result){(alert("Successful"));
        $(".loader").css("display","none");
        $(".modal-body").css("display","block");    
        }
    });
}
function resend_report(){
    $("#confirm").prop('disabled', true);
    var intrvtitle = $("#inttitle").val();
    var changes_text = $("#resultchangemail").val();
    $(".loader").css("display","block");
    $(".modal-body").css("display","none");
    $.ajax({
        type:"POST",
        data:{
              title:intrvtitle,
              change:changes_text
        }, 
        url: "http://ims.com/admin/resend_report", 
        success: function(result){(alert("Successful"));
        $(".loader").css("display","none");
        $(".modal-body").css("display","block");
        }
    });
}