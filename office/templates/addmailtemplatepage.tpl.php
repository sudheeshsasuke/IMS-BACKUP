<!DOCTYPE html>
<html>
<?php ob_start();?>
<head>
 </head>
<body class="hold-transition skin-blue sidebar-mini">
<section class="content">
<div class="row">
<div class="col-md-9">

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Compose New Mail Template</h3>
  </div>
  
  <!-- /.box-header 
  <div class="box-body"> -->
  <div class="box-body pad">
  <form id="mailtemplateform" method="post" action="/admin/addmailtemplate">
  <?php if($template) : ?>
    <input type="hidden" name="templateid" value = <?=$_GET['templateid']?>>
    <div class="form-group">
      <input class="form-control" placeholder="Template code:" name="code" value=<?=$template['code']?>>
    </div>
    <div class="form-group">
      <input class="form-control" placeholder="Subject:" name="subject" value=<?=$template['subject']?>>
    </div>
    <div class="form-group">
          <label>Mail Content</label>
          <textarea id="compose-textarea" class="form-control" style="height: 300px" placeholder="Type your text here" name="mailtext" >
            <?=$template['text']?>
          </textarea>
    </div>
    <div class="form-group">
          <label>Description</label>
          <textarea id="mail_des" class="form-control" style="height: 300px"  name="description" >
            <?=$template['description']?>
          </textarea>
    </div>
  <?php else:?>
    <div class="form-group">
      <input class="form-control" placeholder="Template code:" name="code">
    </div>
    <div class="form-group">
      <input class="form-control" placeholder="Subject:" name="subject">
    </div>
    <div class="form-group">
      <label>Mail Content</label>
      <textarea id="compose-textarea" class="form-control" style="height: 300px" placeholder="Type your text here" name="mailtext">
      </textarea>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea id="mail_des" class="form-control" style="height: 300px"  name="description">
      </textarea>
    </div>
    <?php endif ?>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    <!--  <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
      <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Save</button>
    </div>
   <!--   <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button> -->
  </div>
  <!-- /.box-footer -->
</div>
<!-- /. box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</body>
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php'; ?>
</html>
