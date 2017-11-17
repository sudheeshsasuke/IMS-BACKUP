
<?php ob_start();?>
<?php 
  if($_SESSION['sent'] = 0 && $_SESSION['confirm'] == 1){

    $num = rand(1000,getrandmax());
    $nums = sha1($num);
    $_SESSION['ceo']=$num;
  }
?>
<html>


<?php $y = $_REQUEST['id']; ?>

  <body>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <table width=100%>
              <tbody>
                <tr>
                  <td>
                  <?php if($flag == 0):?>
                  
                    <select class="btn btn-block btn-default btn-sm" id="select_round" name="round" onchange="self.location=''+'?id=<?=$y?>&roundid='+this.value">
                    <option value=" " selected>select one</option>
                      <?php foreach($rounds as $round):?>
                        <?php if($_GET['roundid'] == $round['id']) {?>
                          <option value="<?= $round['id']?>" selected><?=$round['name']?></option>
                        <?php }
                        else {?>
                          <option value="<?= $round['id']?>"><?=$round['name']?></option>
                        <?php } ?>
                       <?php endforeach; ?> 
                    </select>
                  </td>
                  <td>
                    <button class="btn btn-block btn-default btn-sm"  type="button" data-toggle="modal" data-target="#update_stat" >Round Update</button>
                  </td>
                  <td>
                    <button id="btn_finallist" class="btn btn-block btn-default btn-sm" type="button" value="<?=$y?>">Final List</button>
                  </td>
                  <td>
                    <button id="btn_full_list" class="btn btn-block btn-default btn-sm" type="button" value="<?=$y?>" style="display: none;float:right;" >Complete List</button>
                  </td>
                  <td>        
                    <button type="button" id="snd_rpt_btn" class="btn btn-block btn-default btn-sm" data-toggle="modal" data-target="#snd_rpt">
                      <i class="fa fa-fw fa-send"></i>
                        send report 
                    </button>
                  </td>
                    <?php elseif($flag == 1):?>
                    <td>
                      <button id="btn_finallist" class="btn btn-block btn-default btn-sm" type="button" value="<?=$y?>">Final List</button>
                    </td>
                    <td>
                      <button id="btn_full_list" class="btn btn-block btn-default btn-sm" type="button" value="<?=$y?>" style="display: none;float:right;" >Complete List</button>
                    </td>
                    <td>
                      <button type="button" id="cnf_rpt_btn" class="btn btn-block btn-default btn-sm" data-toggle="modal" data-target="#cnf_rpt">
                        <i class="fa fa-fw fa-play"></i>
                          Approve the list 
                      </button>
                    </td>
                    <td>
                      <button type="button" id="cnf_rpt_btn" class="btn btn-block btn-default btn-sm" data-toggle="modal" data-target="#rsnd_rpt">
                        <i class="fa fa-fw fa-play"></i>
                          Apply changes  
                      </button>
                    </td>  
                  <?php endif;?>
                  </td>
                  
                </tr>
              </tbody>
            </table>		
          </div>
        </div>
      </div>

      <div class="modal fade" id="update_stat">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Are you sure!!</h4>
            </div>
            <div class="modal-body">
              Following candidates are getting selected to next round
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="btn_update_confirm" value="<?=$y?>" class="btn btn-primary" >Confirm</button>
            </div>
        </div> 
          
      </div>
       
    </div>

    

      <div class="modal fade" id="snd_rpt">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Are you sure!!</h4>
            </div>
            <div class="modal-body">
              The mail containing final result will send to CEO
            </div>
            <div class="loader" id="loader"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="confirm" class="btn btn-primary" onclick="send_report()">Confirm</button>
            </div>
          </div> 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="cnf_rpt">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Are you sure!!</h4>
            </div>
            <div class="modal-body">
              Confirm the list??
            </div>
            <div class="loader" id="loader"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="confirm" class="btn btn-primary" onclick="confirm_report()">Confirm</button>
              
            </div>
          </div> 
        <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="rsnd_rpt">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Make some changes</h4>
            </div>
            <div class="modal-body">
              Specify the changes here:
              <textarea id="resultchangemail" class="form-controll" rows="3" placeholder="Enter.."></textarea>
            </div>
            <div class="loader" id="loader"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="confirm" class="btn btn-primary" onclick="resend_report()">Confirm</button>
            </div>
          </div> 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="cnf_rpt">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Are you sure!!</h4>
          </div>
          <div class="modal-body">
            Confirm the list??
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="confirm_report()">Confirm</button>
          </div>
        </div> 
      <!-- /.modal-content -->
      </div>
    </div>
    <div>
      <?php $y = $_REQUEST['id']; ?>
      <h1> INTERVIEW TITLE : <?=$interviewtitle['title']?></h1>
      <h2> ROUNDS </h2>
      <table class="table table-bordered">
      <?php foreach($allrounds as $allround) : ?>
       
        <tr>     
          <td><a><?=$allround['name']?> </a> </td>
          <input  id="intid" class="intid" type="hidden"  name="interviewid" value=<?=$_REQUEST['id']?>> 
          <td><button id="<?=$allround['id']?>" class="act" value = "<?=$allround['id']?>">activate</button>   </td>      
          <td><button id="<?=$allround['id']?>" class="deact" value = "<?=$allround['id']?>">deactivate</button> </td>
       
        </tr>
      <?php endforeach?>
      </table>
			<input  id="intrid" type="hidden"  name="interviewid" value=<?=$_REQUEST['id']?>>
			<input  id="ceo" type="hidden"  name="interviewid" value=<?=$nums?>>
			<input  id="inttitle" type="hidden"  name="interviewid" value=<?=$interviewtitle['title']?>>
    </div>
   
    <!--SCORE TABLE with each round-->
    <h3>Scores </h3>
    <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
    <table id = "scoremanagement" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th rowspan="2">Participant ID </th>
          <th rowspan="2">Participant Name </th>
          <?php foreach($rounds as $round) :?>
            <th colspan="3"><?=$round['name']?></th> 
          <?php endforeach?>
          <th rowspan="2" colspan="3"> </th>
        </tr>
        <?php foreach($rounds as $round) :?>
        <th class="sorting_asc" tabindex="0" aria-controls="scoremanagement" rowspan="1" colspan="1" aria-label="mark: activate to sort column descending" style="width: 33px;" aria-sort="ascending">mark</th>
          <th>status</th>
          <th>comment</th>
        <?php endforeach?>
        
      </thead>
      <tbody>
        <?php $count = 0;?>
       
      
    
    <?php if (ISSET($_POST['final_list'])):?>
    <script>
    document.getElementById("btn_finallist").style.display = "none";
    document.getElementById("btn_full_list").style.display = "block";
    </script>
    <?php foreach ($participants as $participant) :?>
    <?php $flag = 0;?>
        <?php foreach($IR as $intround) :?>
          <?php foreach($intround as $round) :?>
            <?php if ($score[$participant['part_id']][$round['id']]['status'] != "1"):
                $flag = 1;
                break;
            endif;
          endforeach;  
        endforeach;  
        if ($flag == 0) :?>
        <tr>
        <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['part_id']?></a></td><td><?=$participant['name']?></td>
        
            <?php foreach($IR as $intround) :?>
            <?php foreach($intround as $round) :?>
             <td><?=$score[$participant['part_id']][$round['id']]['score']?></td>
             <td><?=$score[$participant['part_id']][$round['id']]['status']?></td>
             <td><?=$score[$participant['part_id']][$round['id']]['comment']?></td>
          
            <?php endforeach;?>
            <?php endforeach;?>
            <td> <button type="button"><a href = "http://ims.com/admin/score_management/edit?pid=<?=$participant['part_id']?>&id=<?=$y?>"> edit </a></button></td>
           <td> <button id="del" class="<?=$participant['id']?>" value ="<?=$participant['part_id']?>" type="button">delete</button></td>
           
           <td> <input type = "checkbox" id="checkeduser" name = "checkedusers[]" value="<?php echo $participant['part_id']; ?>"> </td>
           
        </tr>
        <?php endif; 
    
    endforeach; ?> 
    <?php else: ?>
      <?php $count = 0;?>
      <?php foreach($participants as $participant) :?>
      <tr>
      <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['part_id']?></a></td><td><?=$participant['name']?></td>
      
          <?php foreach($IR as $intround) :?>
          <?php foreach($intround as $round) :?>
           <td><?=$score[$participant['part_id']][$round['id']]['score']?></td>
           <td><?=$score[$participant['part_id']][$round['id']]['status']?></td>
           <td><?=$score[$participant['part_id']][$round['id']]['comment']?></td>
        
          <?php endforeach;?>
          <?php endforeach;?>
          <td> <button type="button"><a href = "http://ims.com/admin/score_management/edit?pid=<?=$participant['part_id']?>&id=<?=$y?>"> edit </a></button></td>
          <td> <button id="del" class="<?=$participant['id']?>" value ="<?=$participant['part_id']?>" type="button">delete</button></td>
          <td> <input type = "checkbox" id="checkedusers[]" name = "checkedusers[]" value="<?php echo $participant['part_id']; ?>" > </td>
        </tr>
      <?php endforeach;?>
      <?php endif; ?>

 
        
      </tbody>
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
  </body>
</html>
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php'; ?>