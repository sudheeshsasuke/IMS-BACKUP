<!DOCTYPE html>
<html lang="en">
<head>
<meta name="google-signin-client_id" content="954781805397-vgrd061a992gdn9c4r7d3rum4m72303v.apps.googleusercontent.com">
  <title>Interview management System - zyxware</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="http://ims.com/user/img/giphy.gif" type="image/gif" sizes="32x32">

  <!--custom css-->
  <link href="http://ims.com/user/css/mystyles.css" rel="stylesheet" type="text/css" />  
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="http://ims.com/user/js/interview.js"></script>
  <script src='http://ims.com/user/js/script.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
             
    //gmail email and name database insertion and redirected to candidate page    
    <?php if(!isset($_SESSION['gmail'])): ?>
        //google sigin
        function onSignIn(googleUser) {
            //alert('test');
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            var name = profile.getName();
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            var email = profile.getEmail();
            googlelogininsertion(email,name);
        }
    <?php endif; ?>

    //google login
    function googlelogininsertion(email,name) {
            //alert(email);
            //alert(name);
            //var flag = 1;
            
         $.ajax({type:"POST", url: "http://ims.com/user/google_login_insertion",
                data:{
                    email:email,
                    name:name
                } ,  
                success: function(result){
                        //alert("hi");
                    window.location = "http://ims.com/";
                    //alert("hi");
                    return false;
            }});
            return false;
        }

  </script>
  <script>
   // $(document).ready(function() {
        function signOut() {
            //alert("hi");
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                    console.log('User signed out.');
            });
      }
  
      </script>
    
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" id="logo" href="http://ims.com/">Interview Management System</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://ims.com/">HOME</a></li>       
        <?php if(isset($_SESSION['id'])): ?>
            <li class="nav-item">
                <a class="nav-link" href="http://ims.com/user/visit_profile"><?= strtoupper(htmlentities($_SESSION['username']));?></a>
            </li>               
            <li class="nav-item">
                <?php if(isset($_SESSION['gmail'])): ?>
                    <a class="nav-link js-scroll-trigger" href="http://ims.com/user/logout" data-target="#RegisterModal" onclick="signOut();">Sign out</a>
                <?php else: ?>
                    <a class="nav-link js-scroll-trigger" href="http://ims.com/user/logout"  data-target="#RegisterModal">LOGOUT</a>
                <?php endif ?>
            </li>       
        <?php  else:?>
         <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="" data-toggle="modal" data-target="#RegisterModal">REGISTER</a>
        </li>
        <li>
            <a class="nav-link js-scroll-trigger" href="" data-toggle="modal" data-target="#RegisterModal">LOGIN</a>
        </li>
        <?php endif?>
        <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
      </ul>
    </div>
  </div>
</nav>



<?php echo $content;  ?>

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <div class="row">
      <div class="col-md-4">
        <span class="copyright">Copyright &copy; IMS 2017</span>
      </div>
      <div class="col-md-4">
        <ul class="list-inline social-buttons">
          <li class="list-inline-item">
            <a href="https://twitter.com/zyxware?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://www.facebook.com/zyxware/">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://www.linkedin.com/company/711088/">
              <i class="fa fa-linkedin"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="list-inline quicklinks">
          <li class="list-inline-item">
            <a href="#">Privacy Policy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms of Use</a>
          </li>
        </ul>
      </div>
  </div>
</footer>

<!-- Loginmodal -->
    <div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Login/Registration
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                                <li><a href="#Registration" data-toggle="tab">Registration</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="Login">
                                    <form role="form" method="post" action="http://ims.com/user/login" class="form-horizontal">
                                    <div style="margin-top:10px;" class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="loginemail" id="email1" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div style="margin-top:10px;" class="form-group">
                                        <label for="exampleInputPassword1" class="col-sm-2 control-label">
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="loginpassword" id="exampleInputPassword1" placeholder="password" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary-custom btn-sm">
                                                Submit</button>
                                            <a href="http://ims.com/user/forgot_password">Forgot your password?</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="Registration">
                                    <form id="user_registration_form" role="form" action="http://ims.com/user/register"  method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Name</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select class="form-control" name="salutation">
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Mrs.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="name" placeholder="Name" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="emailid" id="email" placeholder="Email" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile" class="col-sm-2 control-label">
                                            Mobile</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" min="0" max="10"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name = "password" id="password" placeholder="Password" required/>
                                        </div>
                                    </div>
                                    <div class="g-recaptcha" id = "g-recaptcha-response" data-sitekey="6LfOazgUAAAAABW0eWmkzxLB2J5eRdqj4QwUGFWZ"></div> 
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-sm login-btn">
                                                Save & Continue</button>
                                            <button type="button" class="btn btn-default btn-sm" class="close" data-dismiss="modal" aria-hidden="true">
                                                Cancel</button>
                                        </div>
                                    </div>
                                    <div id="loader" >
                                        confirmation mail being sented to your email id.please wait.
                                        <img class="moveright" src="http://ims.com/user/img/loader.gif" width=100/>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div id="OR" class="hidden-xs">
                                OR</div>
                        </div>
                        <div class="col-md-4">
                            <div class="row text-center sign-with">
                                <div class="col-md-12">
                                    <h3>
                                        Sign in with</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="btn-group btn-group-justified">
                                        <div  class="g-signin2" data-onsuccess="onSignIn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>
<script src='http://ims.com/user/js/script.js'></script>
</body>
</html>
