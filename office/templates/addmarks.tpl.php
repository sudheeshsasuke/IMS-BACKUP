<?php ob_start();?>
   <HTML>
      <body>
        <?php $x=$_GET['id']; ?>
        <?php $y=$_GET['roundid']; ?>
        <?php $z=$_GET['pid']; ?>
        <form action='/admin/score_management/insertmarks' method="POST">
        <div class="container">
		      <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-body">							
                    <table  class="table table-bordered table-striped">
                      <div>
                        <input type="hidden" name="p_id" value="<?=$z?>">
                        <input type="hidden" name="id" value="<?=$_GET['id']?>">
                        <label>Round</label><br>
                        <select name="round" onchange="self.location=''+'?id=<?=$x?>&pid=<?=$z?>&roundid='+this.value"> 
                          <option value=" " selected>select round</options>
                          <?php foreach($rounds as $round):?>
                            <?php if($y == $round['id']) {?>
                              <option value="<?= $round['id']?>" selected><?=$round['name']?></options>
                            <?php }
                            else {?>
                              <option value="<?= $round['id']?>"><?=$round['name']?></options>
                            <?php } ?>
                          <?php endforeach; ?>
                        </select><br>
                        <br><label>mark</label><br>
                        <input type="text" name="mark" value="<?=$part_score['score']?>" class = "form-control"><br>
                        <input type="hidden" name="old_mark" value="<?=$part_score['score']?>" class = "form-control"><br>
                        <label>comment</label><br>                 
                        <textarea rows="4" cols="50" name="comment"  class = "form-control"><?=$part_score['comment']?></textarea><br>
                        <input class = "btn btn-danger" type="submit" value="Submit">
                      </table>   
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </form>
        </body>
    </html>
      
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php'; ?>