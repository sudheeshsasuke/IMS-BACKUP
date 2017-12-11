<html>

<?php ob_start();?>

<body>   
    
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <form action="/admin/round/addroundpage" method="post">
        <div class="box-header">
          <h3 class="box-title">Interview Rounds</h3>
          <div class="sidebutton" style="float:right;">
              <input type="submit" class="btn btn-success" value="Add Round" >
          </div>
        </div>
      </form>
        <!-- /.box-header -->
        <div class="box-body">
        
          <table id="example1" class="table table-bordered table-striped">
   
     
        
        <?php foreach($rounds as $round): ?>

        <tr> 
            <td>
            <ul>
            <li><?php echo htmlentities($round['name'])?></li>
            </ul>
            </td>
            <td>
                <a href="/admin/round/editround?id=<?=$round['id']?>">
                  <button class="btn btn-warning">Edit</button>
                </a>
            </td>
            <td>  </td>
            <td>
                <!--<a href="/index.php/admin/round/deleteround?id=">Delete</a> -->
                <button class="rounddelbtn btn btn-danger" type="button"  value="<?=$round['id']?>">Remove </button>
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


<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php' ?>
</html>