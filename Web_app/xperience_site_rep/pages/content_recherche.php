<?php

generatemenugauche();
$tabfon=$_POST;
generate_table_search_header($tabfon['annee'], $tabfon['organisme'], $tabfon['pays'], $tabfon['xperience'], $tabfon['domaine'], $tabfon['remuneration']);
//boucle for à instaurer portant sur la requête liée aux filtres, ici la boucle est totalement fictive
//    print_r(experiences::recherche_xp($dbh, $_POST['pays'], $_POST['remuneration'], $_POST['organisme'], $_POST['xperience'], $_POST['domaine'],$_POST['annee']));
//    print_r($_POST);
$i=0;
foreach (experiences::recherche_xp($dbh, $_POST['pays'], $_POST['remuneration'], $_POST['organisme'], $_POST['xperience'], $_POST['domaine'],$_POST['annee']) as $ligne) {
    $temoin = utilisateurs::get_user ($ligne['id_temoin'],$dbh);
    $organisme = organisme::get_organisme ($ligne['id_org'],$dbh);
    $id=$temoin['prenom']." " .$temoin['nom']." ";
    $nomtab= $id . $temoin['promotion'];
    $annee=date_parse($ligne['date_debut'])['year'];
    $type=ucfirst($ligne['type']);
    $like="J'aime";
    $idxp=$ligne['id_xp'];
    generate_line_search($idxp,$nomtab,$_POST['annee'], $annee, $_POST['organisme'], $organisme['nom'], $_POST['pays'], $ligne['pays'], $_POST['xperience'], $type, $_POST['domaine'], $ligne['domaine'], $ligne['remuneration']+"€");
    //generate_panel_search($idxp,$ligne,$temoin,$organisme,$idxp,$annee,$type,$like,$dbh);
    $i++;
}


/*for ($k = 0; $k < 4; $k = $k + 1) {
    generate_line_search("Etienne DUPONT X15", $_POST['annee'], "2016", $_POST['organisme'], "Total", $_POST['pays'], "France", $_POST['xperience'], "Ouvrier", $_POST['domaine'], "Physique", "500E");
}*/

generate_table_search_footer();

foreach (experiences::recherche_xp($dbh, $_POST['pays'], $_POST['remuneration'], $_POST['organisme'], $_POST['xperience'], $_POST['domaine'],$_POST['annee']) as $ligne) {
    $temoin = utilisateurs::get_user ($ligne['id_temoin'],$dbh);
    $organisme = organisme::get_organisme ($ligne['id_org'],$dbh);
    $id=$temoin['prenom']." " .$temoin['nom']." ";
    $nomtab= $id . $temoin['promotion'];
    $annee=date_parse($ligne['date_debut'])['year'];
    $type=ucfirst($ligne['type']);
    $like="J'aime";
    $idxp=$ligne['id_xp'];
    $mail=$temoin['email'];
    $tel=$temoin['tel'];
    //generate_line_search($i,$nomtab,$_POST['annee'], $annee, $_POST['organisme'], $organisme['nom'], $_POST['pays'], $ligne['pays'], $_POST['xperience'], $type, $_POST['domaine'], $ligne['domaine'], $ligne['remuneration']+"€");
    generate_panel_search($mail,$tel,$idxp,$ligne,$temoin,$organisme,$idxp,$annee,$type,$like,$dbh);
    $i++;
}

generate_map_filtered($dbh,$_POST['pays'],$_POST['remuneration'], $_POST['organisme'],  $_POST['xperience'], $_POST['domaine'],$_POST['annee']);
echo "</div>";
ferme_div();





