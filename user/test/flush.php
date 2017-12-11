<?php

spl_autoload_register(function ($class_name) {
    
    $file_name = '/home/user/Projects/IMS/libs/controllers/' . strtolower($class_name) . '.class.php';
    if(file_exists($file_name)) {
        require_once $file_name;
    }
    
    $file_name = '/home/user/Projects/IMS/libs/models/' . strtolower($class_name) . '.class.php';
    if(file_exists($file_name)) {
        require_once $file_name;
    }

});

$db = new Database();

//flush otp table
$flag = 1;
$query = "DELETE FROM `otp` " 
. " WHERE `date` <= CURDATE() AND `flag`= :flag";
$values = array(
        ':flag' => $flag
    );
$a = $db->query_execute($query, $values);

//flush inactive users from participants
$query2 = "DELETE FROM `participant` "
. " WHERE `active` IS NULL";
$b = $db->query_execute($query2, NULL);

echo $a . "\n" . $b;
?>