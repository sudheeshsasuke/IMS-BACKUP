
<?php ob_start();?>
<html>
<body>
    <!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <form action="/admin/interview/addinterviewpage" method="post">
        <div class="box-header">
          <h3 class="box-title">Job Posts</h3>
          <div class="sidebutton" style="float:right;">
            <input type="submit" class="btn btn-success" value="Add Interview" >
          </div>
        </div>
      </form>
        <!-- /.box-header -->
        <div class="box-body">
        
        <table id="example1" class="table table-bordered table-striped">
      
        <?php foreach($interviews as $interview): ?>
        <tr> 
            <td>
                <ul>
                    <li><?php echo $interview['title']?></li>
                </ul>
            </td>
            <td>
              <a href="/admin/interview/editinterview?id=<?=$interview['id']?>">
                <button type="button" class="btn btn-warning"> Edit</button>
              </a>
            </td>
            <td>  </td>
            <td>
                <button class="delbtn btn btn-danger" type="button" value="<?=$interview['id']?>">Remove </button>
                <!--<button type="button"><a href="/index.php/admin/interview/deleteinterview?id=">Delete</a></button> -->
            
            </td>
        </tr>
        <?php endforeach ?>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

        
      
     
</body>

</html>
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php' ?>