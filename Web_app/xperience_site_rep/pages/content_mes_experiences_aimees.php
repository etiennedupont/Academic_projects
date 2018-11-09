<?php
generate_menu_gauche_mesxpaimees();

$tabfon=$_POST;
generate_table_search_headerfull();
//boucle for à instaurer portant sur la requête liée aux filtres, ici la boucle est totalement fictive
//    print_r(experiences::recherche_xp($dbh, $_POST['pays'], $_POST['remuneration'], $_POST['organisme'], $_POST['xperience'], $_POST['domaine'],$_POST['annee']));
//    print_r($_POST);
$i=0;
foreach (experiences_aimees::get_xpaimee($dbh,$_SESSION['id']) as $ligne) {
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
    generate_line_searchfull($i,$nomtab, $annee,  $organisme['nom'],  $ligne['pays'], $type, $ligne['domaine'], $ligne['remuneration']+"€");
    generate_panel_searchdejaaime($mail,$tel,$idxp,$ligne,$temoin,$organisme,$i,$annee,$type,$like,$dbh);
    $i++;
}


/*for ($k = 0; $k < 4; $k = $k + 1) {
    generate_line_search("Etienne DUPONT X15", $_POST['annee'], "2016", $_POST['organisme'], "Total", $_POST['pays'], "France", $_POST['xperience'], "Ouvrier", $_POST['domaine'], "Physique", "500E");
}*/

generate_table_search_footer();
ferme_div();
//generate_map_filtered($dbh);
echo "</div>";






