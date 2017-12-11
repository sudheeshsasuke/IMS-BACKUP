<?php ob_start() ?>

<h3> confirm your account via email first </h3>

<?php $confrimation_error = ob_get_clean(); 

require "login.tpl.php" ?>