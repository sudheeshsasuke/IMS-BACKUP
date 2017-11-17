
<?php ob_start() ?>



<h1 class = "well"> INTERVIEW TITLE : <?=$interviewtitle['title']?></h1>
<div class = "well">
<h2> selected candidates </h2> <br>
      <?php foreach($selected_participants as $selected_participant) : ?>
        <li>      
          <?=$selected_participant['name']?> 
        </li>
      <?php endforeach; ?></br>
      </div>
      <a href = "http://ims.com/admin/score_management/history?id=<?=$interviewtitle['id']?>"> <button type="button" class = " btn btn-primary">INTERVIEW HISTORY</button> </a>

<?php $content = ob_get_clean() ?>
<?php include 'layout.tpl.php' ?>
