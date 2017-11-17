<?php ob_start() ?>
<section id="interviews">
    <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="row">
                <div class="col-md-8 login" style="padding-right: 30px;">
                    <h1 syle="margin: 30px;">Recovery Mail Form</h1>
                    <p>We will send you an recovery mail to the enetered email</p>
                    <form role="form" id="recoverymail" method="post" action="http://ims.com/user/forgot_passowrd_action" class="form-horizontal">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">
                                Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="recovery_email" id="email1" placeholder="Email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary-custom btn-sm login-btn">
                                    Submit</button>
                            </div>
                            <div id="loader" >
                                sending recovery mail ...
                                <img class="moveright" src="http://ims.com/user/img/loader.gif" width=100/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); 

require "layout.tpl.php" ?>