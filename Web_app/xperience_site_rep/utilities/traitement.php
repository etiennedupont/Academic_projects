<?php

function ajout_fin_formulaire($dbh) {

    experiences::ajout_xp($_POST, $dbh);

    
}

?>