<?php
require('Database.php');
require('xperience.php');

$dbh = Database::connect();
if(isset($_POST['idxp'])){
    $idxp = $_POST['idxp'];
    experiences::delete_xp($dbh,$idxp);
}
else{
    echo "<h1> database error </h1>";
}
$dbh = null;

