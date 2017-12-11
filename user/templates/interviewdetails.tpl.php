<?php ob_start();?>

<!-- Services -->
<section id="interviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>
                    <?php echo $interview[0]['title'];?>
                </h1>
                <p>
                    Location : <?php echo htmlentities($interview[0]['location']);?><br>
                    Department : <?php echo htmlentities($interview[0]['department']);?><br>
                    Start Date : <?php echo htmlentities($interview[0]['start_date']);?><br>
                    End Date : <?php echo htmlentities($interview[0]['end_date']);?><br><br>
                    <?php $x = $interview[0]['body']; echo $x;?>

                    <ul><?php $criteria = explode(" - ", htmlentities($interview[0]['criteria']));
                                foreach($criteria as $c):?>
                                    <li><?php echo $c;?></li>
                        <?php   endforeach;
                    ?></ul><br><br>
                </p>
                <?php if(!isset($_GET['flag']) && empty($_GET['flag'])):?>
                <form  method="post">
                    <input type="hidden" name="int_id" value='<?php echo $_GET['interview_id'];?>'>
                    
                    <?php if(!isset($_SESSION['id'])) :?>
                        <button class="btn btn-sucess-custom homepageapply" value='<?php echo $_GET['interview_id'];?>'>Apply</button>
                    <?php else:?>
                        <button class="btn btn-sucess-custom descriptionapply" value='<?php echo $_GET['interview_id'];?>'>Apply</button>
                    <?php endif; ?>
                </form>
                <?php endif;?>
                <h2>Interview Process</h2>
                Our selection process includes <?php echo $round_count;?> different stages:
                <br><br>
                A brief description of the <?php echo $round_count;?> stages are given below.
                <?php
                    foreach($interview as $i):?>
                        <li><?php echo $i['name'] . " - " . $i['description'];?></li>
            <?php   endforeach;
                ?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
    include './user/templates/layout.tpl.php';
?>