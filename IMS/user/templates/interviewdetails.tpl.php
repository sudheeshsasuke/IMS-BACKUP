<?php ob_start();?>

<!-- Services -->
<section id="interviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>
                    <?php echo $interview['title'];?>
                </h1>
                <p>
                    Location : <?php echo htmlentities($interview['location']);?><br><br>
                    Department : <?php echo htmlentities($interview['department']);?><br><br>
                    Start Date : <?php echo htmlentities($interview['start_date']);?><br><br>
                    End Date : <?php echo htmlentities($interview['end_date']);?><br><br>
                </p>
                <?php if(empty($_GET['flag'])):?>
                <form action="http://ims.com/insert_into_intpart" method="post">
                    <input type="hidden" name="int_id" value='<?php echo $_GET['interview_id'];?>'>
                    <button class="btn btn-sucess-custom">Apply</button>
                </form>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
    require 'layout.tpl.php';
?>