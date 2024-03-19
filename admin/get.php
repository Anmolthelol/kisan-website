<?php
header("Content-type: application/json; charset=utf-8");
require_once('db.php');
$query = 'SELECT * FROM kisaansuvidha WHERE 1';
$stm = $db->prepare($query);
$stm->execute();
$row = $stm->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);
$row = $stm->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);
?>