$(".loader").css("display","none");
var mail = $('#otp').val();
if(mail){
  $("#confirm").prop('disabled', true);
}
else{
  $("#confirm").prop('disabled', false);
}

function send_report(){
$("#confirm").prop('disabled', true);
var intid = $("#intrid").val();
var tomail = $("#email_ceo").val();
  $(".loader").css("display","block");
  $(".modal-body").css("display","none");
  $.ajax({
    type:"POST",
    data:{
        id:intid,
        tomail:tomail
    }, 
    url: "http://ims.com/admin/send_report", 
    success: function(result){(alert("Successful"));
      $(".loader").css("display","none");
      $(".modal-body").css("display","block");
    }  
  });
}
//final confirmation by CEO
function confirm_report(){
    
    $("#confirmed").prop('disabled', true);
    var intid = $("#intrid").val();
    var otp_conf=$("#otp_conf").val();
    $(".loader").css("display","block");
    $(".modal-body").css("display","none");
    $.ajax({
        type:"POST",
        data:{
              id:intid,
              otp:otp_conf
        }, 
        url: "http://ims.com/ceo/confirm_report", 
        success: function(result){(alert("Successful"));
        $(".loader").css("display","none");
        $(".modal-body").css("display","block");
        window.location="http://ims.com/final_ceo"    
        }
    });
}
function resend_report(){
    $("#confirm1").prop('disabled', true);
    var intid = $("#intrid").val();
    var changes_text = $("#resultchangemail").val();
    var tomail = $("#email_hr").val();
    $(".loader").css("display","block");
    $(".modal-body").css("display","none");
    $.ajax({
        type:"POST",
        data:{
            id:intid,
            change:changes_text,
            tomail:tomail
        }, 
        url: "http://ims.com/admin/resend_report", 
        success: function(result){(alert("Successful"));
        $(".loader").css("display","none");
        $(".modal-body").css("display","block");
        }
    });
}
