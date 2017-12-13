
<?php ob_start();?>
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
                    <input type="hidden" id="txt_intid" value="<?= $y;?>">
                    <select class="btn btn-block btn-success btn-sm" id="select_round" name="round" style="font-size:15px">
                    <option value=" " selected>select one</option>
                      <?php foreach($rounds as $round):?>
                        <?php if($_POST['roundid'] == $round['id']) {?>
                          <option value="<?= $round['id']?>" selected><?=$round['name']?></option>
                        <?php }
                        else {?>
                          <option value="<?= $round['id']?>"><?=$round['name']?></option>
                        <?php } ?>
                        <?php endforeach; ?> 
                    </select>
                    </td>
                    <td>
                      <button class="btn btn-block btn-primary btn-sm"  type="button"  style="font-size:15px" onclick="return validate_roundupdate();" >Round Update</button>
                    </td>
                    <td>
                      <a href="/admin/new_reg?intid=<?=$y?>"><button class="btn btn-block btn-danger btn-sm"  type="button" style="font-size:15px" >Add candidate</button>
                    </td>
                    <td>
                      <button id="btn_finallist" class="btn btn-block btn-primary btn-sm" type="button" style="font-size:15px" value="<?=$y?>">Final List</button>
                    </td>
                    <td>
                      <button id="btn_full_list" class="btn btn-block btn-success btn-sm" type="button" value="<?=$y?>" style="display: none;float:right;font-size:15px;" >Complete List</button>
                    </td>
                    <td>        
                      <button type="button" id="snd_rpt_btn" class="btn btn-block btn-warning btn-sm" style="font-size:15px" data-toggle="modal" data-target="#snd_rpt">
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
            <h4 class="modal-title">Updating Round Status</h4>
          </div>
          <div class="modal-body">
            Following candidates are getting selected to next round
          </div>
          <div class="loader" id="loader"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="btn_update_confirm" value="<?=$y?>" class="btn btn-primary">Confirm</button>
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
          <p>The mail containing final result will be sent to CEO</p>
          <label for="email_ceo">Email(CEO/Incharge)</label>
          <input type="text" class="form-controll" id="email_ceo" placeholder="email" required>
        </div>
        <div class="loader" id="loader"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" id="confirm" class="btn btn-primary" onclick="send_report()">Confirm</button>
          <input type="hidden" id="otp" name="otp" value=<?=isset($otp['email'])?>>
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
          <button type="button" id="confirmed" class="btn btn-primary" onclick="confirm_report()">Confirm</button>
          <input type="hidden" id="otp_conf" name="otp_conf" value=<?=$_GET['otp_enc']?>>
        </div>
      </div> 
    <!-- /.modal-content -->
    </div>
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
          <label for="email_hr">Email(HR/Incharge)</label>
          <input type="text" class="form-controll" id="email_hr" placeholder="email" required>
        </div>
        <div class="loader" id="loader"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" id="confirm1" class="btn btn-primary" onclick="resend_report()">Confirm</button>
        </div>
      </div> 
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h1> INTERVIEW TITLE : <?=$interviewtitle['title']?></h1><br>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">ACTIVATE AND DEACTIVATE ROUNDS</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" title data-original-title="Collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div> 
            <?php $y = $_REQUEST['id']; ?>
            <table class="table table-bordered">
              <?php foreach($allrounds as $allround) : ?>
                <tr>     
                  <td><h4><?=$allround['name']?></h4></td>
                  <input  id="intid" class="intid" type="hidden"  name="interviewid" value=<?=$_REQUEST['id']?>> 
                  <?php $active_flag = 0; ?>
                  <?php foreach($rounds as $round) : ?>
                    <?php if ($allround['id'] == $round['id']) :?>
                      <?php $active_flag = 1; ?>
                    <?php endif;?>
                      <?php endforeach;?>
                  <?php if ($active_flag == 1): ?>
                    <td><button id="deact_btn".<?=$allround['id']?> class="deact btn btn-danger" value = "<?=$allround['id']?>">deactivate</button>   </td> 
                  <?php else: ?>
                    <td><button id="act_btn".<?=$allround['id']?> class="act btn btn-success" value = "<?=$allround['id']?>">activate</button>   </td> 
                  <?php endif;?>
                </tr>
              <?php endforeach;?>
            </table>
            <input  id="intrid" type="hidden"  name="interviewid" value=<?=$_REQUEST['id']?>>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->

    <!--SCORE TABLE with each round-->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <h3>Scores</h3>
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
                    <th>mark</th>
                    <th>status</th>
                    <th>comment</th>
                  <?php endforeach?>
                </thead>
                <tbody>
                <?php $count = 0;?>
                <?php if (ISSET($_REQUEST['final_list'])):?>
                <script>
                  document.getElementById("btn_finallist").style.display = "none";
                  document.getElementById("btn_full_list").style.display = "block";
                </script>
                <?php foreach ($participants as $participant) :?>
                  <?php $pflag = 0;?>
                  <?php foreach($IR as $intround) :?>
                    <?php foreach($intround as $round) :?>
                      <?php if ($score[$participant['part_id']][$round['id']]['status'] != "1"):
                        $pflag = 1;
                        break;
                      endif;
                    endforeach;  
                  endforeach;  
                  if ($pflag == 0) :?>
                    <tr>
                      <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['part_id']?></a></td>
                      <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['name']?></td>
                      <?php foreach($IR as $intround) :?>
                        <?php foreach($intround as $round) :?>
                          <td><?=$score[$participant['part_id']][$round['id']]['score']?></td>
                          <?php if ($score[$participant['part_id']][$round['id']]['status'] == "1"): ?>
                            <td> passed </td>
                          <?php elseif ($score[$participant['part_id']][$round['id']]['status'] == "0"):?>
                            <td> failed </td>
                          <?php else : ?>
                            <td><?=$score[$participant['part_id']][$round['id']]['status']?></td>
                          <?php endif;  ?>
                          <td><?=$score[$participant['part_id']][$round['id']]['comment']?></td>
                        <?php endforeach;?>
                      <?php endforeach;?>
                      <?php if($flag == 0):?>
                      <td> <a href = "http://ims.com/admin/score_management/edit?pid=<?=$participant['part_id']?>&id=<?=$y?>"><button type="button" class="btn btn-warning"> edit </button></a></td>
                      <td> <input type = "checkbox" id="checkeduser" name = "checkedusers[]" value="<?php echo $participant['part_id']; ?>"> </td>   
                      <?php endif;  ?>
                    </tr>
                  <?php endif; 
                      endforeach; ?> 
                  <?php else: ?>
                      <?php $count = 0;?>
                      <?php foreach($participants as $participant) :?>
                        <tr>
                          <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['part_id']?></a></td>
                          <td><a href="http://ims.com/admin/score_management/showprofile?pid=<?=$participant['part_id']?>"><?=$participant['name']?></td>
                          <?php foreach($IR as $intround) :?>
                            <?php foreach($intround as $round) :?>
                              <td><?=$score[$participant['part_id']][$round['id']]['score']?></td>
                              <?php if ($score[$participant['part_id']][$round['id']]['status'] == "1"): ?>
                                <td> passed </td>
                              <?php elseif ($score[$participant['part_id']][$round['id']]['status'] == "0"):?>
                                <td> failed </td>
                              <?php else : ?>
                                <td><?=$score[$participant['part_id']][$round['id']]['status']?></td>
                              <?php endif;  ?>
                              <td><?=$score[$participant['part_id']][$round['id']]['comment']?></td>
                            <?php endforeach;?>
                          <?php endforeach;?>
                          <?php if($flag == 0):?>
                          <td> <a href = "http://ims.com/admin/score_management/edit?pid=<?=$participant['part_id']?>&id=<?=$y?>"><button type="button" class="btn btn-warning"> edit </button></a></td>
                          <td> <input type = "checkbox" id="checkeduser" name = "checkedusers[]" value="<?php echo $participant['part_id']; ?>"> </td>
                          <?php endif;  ?>
                        </tr>
                      <?php endforeach;?>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <!-- /.box -->
      </div>
    </section>
  </div>
</body>
</html>
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php'; ?>