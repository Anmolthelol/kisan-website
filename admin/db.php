<?php

$dns = 'mysql:host=localhost;"root";"";dbname=kisaansuvidha';
$user = 'admin';
$pass = 'admin';

try{
  $db = new PDO ($dns, $user, $pass);
  
}catch( PDOException $e){
    $error = $e->getMessage();
    echo $error;
}
?>