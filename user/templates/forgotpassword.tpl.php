<?php ob_start();?>

<!-- Services -->
<section id="interviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <p>
                We have sent you a 
                <a href="https://accounts.google.com/signin/v2/identifier?hl=en&passive=true&continue=https%3A%2F%2Fwww.google.co.in%2Fsearch%3Fq%3Dgmail%26oq%3Dgmail%26aqs%3Dchrome.0.69i59j69i60j69i61l2.1080j0j1%26sourceid%3Dchrome%26ie%3DUTF-8&flowName=GlifWebSignIn&flowEntry=ServiceLogin">
                    recovery email
                </a>. 
                <br>please go to your inbox and visit that url
            </p>
</div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
    require 'layout.tpl.php';
?>