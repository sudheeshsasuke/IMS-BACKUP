<?php ob_start();?>
<html>
<body>
    <?php $pid = $_GET['id'];?>

    <form method="post" action="/admin/round/addround">
    <div class="container">
	  <h1 class="well">Round Info:</h1>
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
               <div class="box">
                  <form method="post" action="/admin/interview/addinterview">
    		        <!-- /.box-header -->
                    <div class="box-body">							
                      <table  class="table table-bordered table-striped">
                        <?php if($round) { ?>
                            <tr>
                                <td><input type="hidden" name="roundid" value=<?=$_GET['id']?>></td>
                            </tr>
                            <tr>
                                <td>Round Title</td>
                                <td><input type="text" name="roundname" value="<?=htmlentities($round['name'])?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Maximum Score</td>
                                <td><input type="text" name="maxscore" value="<?=htmlentities($round['max_score'])?>" class="form-control"></td>
                            </tr>
                    
                        <?php }        
                        else { ?>
                            <tr>
                                <td>Round Title</td>
                                <td><input type="text" name="roundname" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Maximum Score</td>
                                <td><input type="text" name="maxscore" class="form-control"></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td > <input type="submit" class="btn btn-primary" value="Submit" ></td>
                            </tr>
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

    </div>  

    </form>
     
</body>

</html>
<?php $content = ob_get_clean()?>
<?php include "layout.tpl.php" ?>