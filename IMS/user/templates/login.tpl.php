<?php ob_start() ?>
<section id="interviews">
    <div class="container">      
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8" style="padding-right: 30px;">
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
                                confirmation mail being sented to your email id...
                                <img class="moveright" src="http://ims.com/user/img/loader.gif" width=100/>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); 

require "layout.tpl.php" ?>