window.onload = display();
    $(document).ready(function(){
      
        $(".apply").click(function() {
        var x = $(this).val();
        console.log(x);
        var z = "."+x;
        $(z).remove();

            $.ajax({type:"POST", url: "http://ims.com/insert_into_intpart",
            data:"int_id="+x ,
            success: function(result){
             
                $.ajax({type:"POST", url: "http://ims.com/display_appliedinterview",
                data:"int_id="+x ,
                success: function(result){
                        //alert("hi2");
                    display();
            
                }})            
            }})      
        });

        $(".homepageapply").click(function() {
            var x = $(this).val();
            
            console.log(x);
            var z = "."+x;
            $(z).remove();
    
                $.ajax({type:"POST", url: "http://ims.com/insert_into_intpart",
                data:"int_id="+x ,
                success: function(result){
                    window.location = "http://ims.com/user/templates/login.tpl.php";
            }})       
            
    }); 

    $(".descriptionapply").click(function() {
      
        var x = $(this).val();
        console.log(x);
        $(this).remove();
            $.ajax({type:"POST", url: "http://ims.com/insert_into_intpart",
            data:"int_id="+x ,
            success: function(result){
                //alert("hi");
                window.location = "http://ims.com/";
            }})      
        });
})   

    function display() {
                //   alert("hi");
       $.ajax({type:"POST", url: "http://ims.com/display_appliedinterview",
                data:"int_id=1" ,
                success: function(result){
                   // alert("hi");
                    var response = $(".printhere",result).html();
                   // alert(response);              
                    $(".printhere").html(response); 
                           
        }})     
            
    }