


$(document).ready(function(){
  $(".act").click(function(){
    
      var rid = $(this).val();
      var intid = $(".intid").val(); 
      $.ajax({ type:"post", 
               data:{"rid":rid, "intid":intid },
               url: "http://ims.com/admin/score_management/roundactivate",
               success: function(result){  
               display(intid);
      }}); 
      return false;
  });
    
});
function display(intid) {

  //var intid = $(".intid").val(); 
 
  //document.getElementById(".act").disabled = true;
  //document.getElementById(".deact").disabled = false;
$.ajax({type:"post", 
        data:{"id":intid}, 
        url: "http://ims.com/admin/score_management", 
        success: function(result){
  
$('body').html(result);

}});
}



$(document).ready(function(){
  $(".deact").click(function(){
     
      var rid = $(this).val();
   
      var intid = $(".intid").val(); 
      $.ajax({ type:"post", 
               data:{"rid":rid, "intid":intid },
               url: "http://ims.com/admin/score_management/rounddeactivate",
               success: function(result){  
               display1(intid);
      }}); 
      return false;
  });
});
function display1(intid) {
  //var intid = $(".intid").val(); 
 
  //document.getElementById(".act").disabled = true;
  //document.getElementById(".deact").disabled = false;
$.ajax({type:"post", 
        data:{"id":intid}, 
        url: "http://ims.com/admin/score_management", 
        success: function(result){
 
$('body').html(result);
}});
}

$(document).ready(function(){
  $("#del").click(function(){
      alert("gh");
      var x = $(this).val();
      alert(x);
      var partid = $("#pid").val(); 
      
      alert(partid);
      $.ajax({url: "http://ims.com/admin/score_management/delete?id=" + partid, success: function(result){
        
      display3();
              
      }}); 
      return false;
  });
});
function display3() {
$.ajax({url: "http://ims.com/admin/score_management", success: function(result){
  $('body').html(result);
}});
}
