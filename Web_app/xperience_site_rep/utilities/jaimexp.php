<?php

        $query = "INSERT INTO `experiences_aimees` ('id_user','id_xp') VALUES (?,?)";
        $sth = $dbh->prepare($query);
        $id=$_SESSION['id'];
        $sth->execute(array($_POST['id_temoin'],$_POST['idxp']));
    
