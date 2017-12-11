<?php ob_start() ?>
<div class="container">      
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8" style="padding-right: 30px;">

<div class="tab-content">
<div class="tab-pane active" id="Login">
    <form role="form" method="post" action="http://ims.com/user/set_new_password?email=<?=$mail?>" class="form-horizontal">
    <div style="margin-top:10px;" class="form-group">
        <label for="newpassword" class="col-sm-2 control-label">
            Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="password" />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <button id="onpa" type="submit" class="btn btn-primary-custom btn-sm">
                Submit</button>
        </div>
    </div>
    </form>
</div>
</div>
</div>
                </div>
            <div class="col-md-2"></div>
        </div>
    </div>
<?php $content = ob_get_clean() ?>

<?php include 'user/templates/layout.tpl.php' ?>
