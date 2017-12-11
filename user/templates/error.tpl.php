<?php ob_start();?>

<!-- Services -->
<section id="interviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h1>
                ERROR! 
            </h1>
        </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
    require 'layout.tpl.php';
?>