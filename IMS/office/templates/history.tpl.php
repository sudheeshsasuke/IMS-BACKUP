<?php ob_start();?>
<html>
<body>
<h1> INTERVIEW TITLE : <?=$interviewtitle['title']?></h1>
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
        </tr>
        <?php foreach($rounds as $round) :?>
          <th>mark</th>
          <th>status</th>
          <th>comment</th>
        <?php endforeach?>
      </thead>
      <tbody>
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
            
          </tr>
        <?php endforeach;?>
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