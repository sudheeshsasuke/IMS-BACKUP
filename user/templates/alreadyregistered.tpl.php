<?php ob_start();?>

<!-- Services -->
<section id="interviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h3>
                This user has been registered
            </h3>
        </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
    require 'layout.tpl.php';
?>