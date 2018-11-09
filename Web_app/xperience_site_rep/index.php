<?php

session_name("sessionxp");

// ne pas mettre d'espace dans le nom de session !

session_start();

if (!isset($_SESSION['initiated'])) {

    session_regenerate_id();

    $_SESSION['initiated'] = true;
}

// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
//print_r($_SESSION);

require('utilities/utils.php');

require ('utilities/Database.php');

require ('utilities/xperience.php');

require('utilities/traitement.php');

require('utilities/printForms.php');

require('utilities/logInOut.php');

require('utilities/inscription.php');

$page_list = array("inscriptionfail" => "inscriptionfail","fininscription" => "fininscription", "inscription" => "inscription", "accueilfail" => "accueilfail", "accueil" => "accueil", "global" => "global", "ajout" => "ajout", "mes_experiences" => "mes_experiences", "fintraitement" => "fintraitement", "recherche" => "recherche", "mes_experiences_aimees" => "mes_experiences_aimees");

//on regarde la page demandée

if (array_key_exists('page', $_GET)) {

    $askedPage = $_GET['page'];
} else {

    $askedPage = "accueil";
}

$authorized = checkPage($askedPage, $page_list);

generateHTMLHeader("Xperience", "css/carte", "css/ajout");

$dbh = Database::connect();

//on regarde si il y a dans todo des choses à traiter

if (array_key_exists('todo', $_GET)) {

    //ici c'est le cas ou le gars a ajouté une experience on l'ajoute dans la base

    if ($_GET['todo'] == "traite") {

        ajout_fin_formulaire($dbh);
    }

    if ($_GET['todo'] == "inscription") {
        if (utilisateurs::inscriptionok($dbh)) {
            utilisateurs::inscription($dbh);
            loginafterinscription($dbh);
            $askedPage = "fininscription";
        } else {
            $askedPage = "inscriptionfail";
        }
    }

    //ici le cas ou le mec s'est connecté (a essaye en fait plutot)

    if ($_GET['todo'] == "login") {

        login($dbh);

        //si ses id et password sont bons

        if (utilisateurs::bon_mdp($dbh, $_POST['Identifiant'], $_POST['pass'])) {

            //menu avec deconnexion possible et on va à global

            $askedPage = "global";
            session_remplit($dbh, $_POST['Identifiant'], $_POST['pass']);
        } else { //if (!user_co::bon_mdp($dbh, $_POST['Identifiant'], $_POST['pass']))//
            //echec on reessaye
            $askedPage = "accueilfail";
        }
    }

    if ($_GET['todo'] == "delog") {

        logout();
    }

    if ($_GET['todo'] == "recherche") {
        $askedPage = "recherche";
    }
}

if (array_key_exists('loggedIn', $_SESSION)) {

    if ($_SESSION["loggedIn"]) {

        if ($askedPage == "accueil")
            $askedPage = "global";

        head_nav_bar_deco();
    } else {

        if (!$_GET['page'] == "accueil") {

            head_nav_bar_co();
        }
    }
}
if (!array_key_exists('loggedIn', $_SESSION)) {

    if ($askedPage == "inscription" || $askedPage=="inscriptionfail") {
        $authorized = true;
    } else if ($askedPage != "accueil") {

        $authorized = false;
    }
}



//contenu généré dynamiquement

if ($authorized) {

    require 'pages/content_' . $askedPage . '.php';
} else {

    echo "désolé vous n'avez pas les droits d'accès à cette page";
}

//fin contenu dynamique



generateHTMLFooter();
