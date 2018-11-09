 


<?php 
$filtre_annee="toutes";
$filtre_domaine="tous";
$filtre_type="tous";
$filtre_organisme="";
$filtre_pays="";
require 'utilities/Database.php';
require 'utilities/xperience.php';
echo "<html> <head> </head> <body>";
$dbh = Database::connect();
$date_query="`date_debut`";
$type_query="`type`";
$domaine_query="`domaine`";
$pays_query="`pays`";
$organisme_query="`nom`";
if($filtre_annee!="toutes"){$date_query=$filtre_annee;}
if($filtre_type!="toutes"){$type_query='"'.$filtre_type.'"';}
if($filtre_domaine!="tous"){$date_query=$filtre_domaine;}
$query = "SELECT *"
        ."FROM `experiences` AS `xp`"
        ."INNER JOIN `organisme` AS `org`"
        ."ON xp.id_org=org.id_org "
        ."WHERE `date_debut`=$date_query AND `type`=$type_query OR `type` IS NULL AND `domaine`=$domaine_query OR `domaine` IS NULL"
        ." AND `pays`=$pays_query AND `nom`=$organisme_query";
$sth = $dbh->prepare($query);
$request_succeeded = $sth->execute();
if ($request_succeeded) {
while ($ligne = $sth->fetch(PDO::FETCH_ASSOC)) {
    $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
    $user_name = $user['prenom']." ".$user['nom']." (X".$user['promotion'].")";
    $note = 3;
    $adresse = $ligne['adresse'];
    $nom = $ligne['nom'];
    $type = $ligne['type'];
    $domaine = $ligne['domaine'];
    $remuneration = $ligne['remuneration'];
echo 'codeAddress(geocoder,maCarte,"'."$adresse".'","'."$nom".'","'."$user_name".'","'."$type".'","'."$domaine".'","'."$remuneration".'","'."$note".'");';
}
}
$dbh = null;
echo "</body> </html>";

//        ."WHERE `date_debut`='toutes'";