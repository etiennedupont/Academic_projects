<?php

if(isset($_POST['string_test'])){
    $texte = $_POST['string_test'];
    $texte_nettoyé = filter_var($texte,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    echo ($texte_nettoyé==$texte);
}

