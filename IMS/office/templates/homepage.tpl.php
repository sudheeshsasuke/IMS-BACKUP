
<?php ob_start() ?>
<h2>List of Posts</h2>

<!--TODO: loop through posts array and list the blog titles as an
unordered list with link to the corresponding blog post.
Eg. /boot-camp/show.php?id=123 -->
<ul class="timeline">
<?php foreach($interviews as $interview):?>
		<li class="time-label">
			<span class="bg-blue">
				<?=$interview['start_date']?>
			</span>
		</li>
		<li>
			<i class="fa fa-envelope bg-blue"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="http://ims.com/admin/score_management?id=<?= $interview['id']?>"><?= $interview['title']?></a></h3>
			</div>
		</li>
	
<?php endforeach;?>

</ul>
<?php $content=ob_get_clean()?>
<?php require_once 'layout.tpl.php'?>