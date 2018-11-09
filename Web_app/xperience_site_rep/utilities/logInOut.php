<?php

function login($dbh) {
    if (utilisateurs::bon_mdp($dbh, $_POST['Identifiant'], $_POST['pass'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['identifiant'] = $_POST['Identifiant'];
        $query = "SELECT * FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(strtolower($_POST['Identifiant'])));
        $ligne = $sth->fetch();
        $_SESSION['id_user'] = $ligne['id_user'];
        $_SESSION['prenom']=$ligne['prenom'];
    } else {
        $_SESSION['loggedIn'] = false;
    }
}

function loginafterinscription($dbh) {
    $id=$_POST['prenom'].".".$_POST['nom'];
    if (utilisateurs::bon_mdp($dbh, $id, $_POST['pass'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['identifiant'] = $id;
        $query = "SELECT * FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        $ligne = $sth->fetch();
        $_SESSION['id'] = $ligne['id_user'];
        $_SESSION['id_user'] = $ligne['id_user'];
        $_SESSION['prenom']=$ligne['prenom'];
    } else {
        $_SESSION['loggedIn'] = false;
    }
}
function logout() {
    unset($_SESSION['loggedIn']);
}
