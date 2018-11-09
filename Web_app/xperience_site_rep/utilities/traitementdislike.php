<?php
require('Database.php');
require('xperience.php');

$dbh = Database::connect();
if(isset($_POST['idxp']) & isset($_POST['id_user'])){
    $idxp = $_POST['idxp'];
    $id_user = $_POST['id_user'];
    experiences_aimees::delete_xp($dbh,$idxp,$id_user);
}
else{
    echo "<h1> database error </h1>";
}
$dbh = null;
