<?php

class experiences {

    public $id_xp;
    public $id_temoin;
    public $_id_org;
    public $type;
    public $domaine;
    public $date_debut;
    public $duree;
    public $remuneration;
    public $poste;
    public $logement;
    public $responsabilite;
    public $charge_travail;
    public $ambiance;
    public $accueil;
    public $appreciation;
    public $conseil;
    public $referent;
    public $bons_plans;

    public function __toString() {
        
    }

    //fonction pour récupérer tous les champs d'une expérience à partir de id_xp
    public function get_xp($id_xp, $dbh) {
        $query = "SELECT * FROM `experiences` WHERE id_xp=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_xp));
        return $sth->fetch();
    }

    public static function ajout_xp($tab, $dbh) {
        if (array_key_exists("domaine", $_POST)) {
            $domaines = "";
            foreach ($tab['domaine'] as $value) {
                $domaines .= "$value ";
            }
        } else {
            $domaines = null;
        }
        
        //là on va regarder si il faut ajouter l'organisme et trouver son identifiant pour le mettre dans l'xp
        $nbligne = organisme::nb_organisme(htmlspecialchars($_POST["organisme"]), $dbh)[0];
    echo $nbligne;
    if ($nbligne == 0) {
        organisme::ajout_organisme($tab, $dbh);
        $idorg=organisme::nb_organisme(htmlspecialchars($_POST["organisme"]), $dbh)[1];
    }
    else{     
        
    $idorg=organisme::nb_organisme(htmlspecialchars($_POST["organisme"]), $dbh)[1];}
        
        $query = " INSERT INTO `experiences` (`id_temoin`, `id_org`,`type`, `domaine`, `date_debut`, `duree`, `remuneration`, `poste`,`pays`, `logement`, `responsabilite`, `charge_travail`, `ambiance`, `accueil`, `appreciation`, `conseil`, `referent`, `bons_plans`) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);

        $request_succeeded = $sth->execute(array($_SESSION['id_user'],$idorg, $tab["xperience"],
            $domaines, $tab['datededebut'], $tab['duree'], $tab['remuneration'], htmlspecialchars($tab["poste"]),htmlspecialchars($tab['pays']), htmlspecialchars($tab["logement"]), $tab["responsabilites"], $tab['charge'], $tab['ambiance'], $tab['accueil'], htmlspecialchars($tab["appreciation"]), htmlspecialchars($tab["conseils"]), htmlspecialchars($tab["referent"]), htmlspecialchars($tab["bonsplans"])));
           
        }
        
    public static function delete_xp($dbh,$id_xp){
    $query = "DELETE FROM `experiences` WHERE `experiences`.`id_xp` = ?";
    $sth = $dbh->prepare($query);
    $sth->execute(array($id_xp));        
    }    

    public static function recherche_xp($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) {
//disonction des cas sur les filtres
        if ($paysform == "") {
            if ($typeform == "toutes") {
                if ($salaireform == "") {
                    $query = "SELECT * FROM `experiences`";
                    $sth = $dbh->prepare($query);
                    $sth->execute();
                } else {
                    $query = "SELECT * FROM `experiences` WHERE (remuneration>?)";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($salaireform));
                }
            } else {
                if ($salaireform == "") {
                    $query = "SELECT * FROM `experiences` WHERE type=?";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($typeform));
                } else {
                    $query = "SELECT * FROM `experiences` WHERE (remuneration>? AND type=?)";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($salaireform, $typeform));
                }
            }
        } else {
            if ($typeform == "toutes") {
                if ($salaireform == "") {
                    $query = "SELECT * FROM `experiences` WHERE pays=?";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($paysform));
                } else {
                    $query = "SELECT * FROM `experiences` WHERE (remuneration>? AND pays=?)";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($salaireform, $paysform));
                }
            } else {
                if ($salaireform == "") {
                    $query = "SELECT * FROM `experiences` WHERE (type=? AND pays=?)";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($typeform, $paysform));
                } else {
                    $query = "SELECT * FROM `experiences` WHERE (remuneration>? AND type=? AND pays=?)";
                    $sth = $dbh->prepare($query);
                    $sth->execute(array($salaireform, $typeform, $paysform));
                }
            }
        }


        $tab=array();
        //tableau ou une partie des valeurs correspondent. On traite à part les valeurs type (plusieurs possibles)
        // promo et organisme (autre table de données//
        while ($xp = $sth->fetch()) {
            if ($anneeform == "toutes" or $anneeform == date_parse($xp['date_debut'])['year']) {
                if ($nomorgform == "") {
                    if ($domaineform == "tous") {
                        array_push($tab, $xp);
                    } else if (stristr($xp['domaine'], $domaineform)) {
                        array_push($tab, $xp);
                    }
                } else if (stristr(organisme::get_organisme($xp['id_org'], $dbh)['nom'], $nomorgform)) {
                    //fonction suivante teste si chaine domaineform est contenue dans la case domaine de la table xperience
                    if ($domaineform == "tous") {
                        array_push($tab, $xp);
                    } else if (stristr($xp['domaine'], $domaineform)) {
                        array_push($tab, $xp);
                    }
                }
            }
        }
        return $tab;
    }

     public static function get_xpdeposee($dbh,$idtemoin) {
        $query = "SELECT * FROM `experiences` WHERE id_temoin=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($idtemoin));
        $tab = array();
        $res=array();
        while($ligne=$sth->fetch()) {
            array_push($tab,$ligne['id_xp']);
        }
        foreach ($tab as $idxp){
            array_push($res,experiences::get_xp($idxp,$dbh));
        }
        return $res;
    }
}

class organisme {

    public $id_org;
    public $nom;
    public $pays;
    public $adresse;
    public $gps;

    //fonction qui renvoie le nombre de lignes avec cet id organisme //
    public function nb_organisme($nom, $dbh) {
        $query = "SELECT * FROM `organisme` WHERE nom=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($nom));

        if ($request_succeeded) {
            $ligne=$sth->fetch();
            $sth->fetch(PDO::FETCH_ASSOC);
            $nbResult = $sth->rowCount();
            $tab=array();
            $tab[0]=$nbResult;
            $tab[1]=$ligne['id_org'];
            return $tab;
        }
    }

    //fonction pour récupérer tous les champs d'un organisme à partir de id_org
    public static function get_organisme($id_org, $dbh) {
        $query = "SELECT * FROM `organisme` WHERE id_org=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_org));
        $nbResult = $sth->rowCount();
        if ($request_succeeded) {
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function ajout_organisme($tab, $dbh) {

        $query = " INSERT INTO `organisme` (`nom`,`pays`,`adresse`) "
                . "VALUES (?,?,?)";
        $sth = $dbh->prepare($query);

        $request_succeeded = $sth->execute(array(htmlspecialchars($tab["organisme"]), htmlspecialchars($tab["pays"]), htmlspecialchars($tab["adresse"])));
    }

}

class utilisateurs {

    public $id_user;
    public $prenom;
    public $nom;
    public $promotion;
    public $email;
    public $addresse;

//fonction pour récupérer tous les champs d'un utilisateur à partir de id_user
    public static function get_user($id_user, $dbh) {
        $query = "SELECT * FROM `utilisateurs` WHERE id_user=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_user));
        if ($request_succeeded) {
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
    }
    public static function inscriptionok($dbh) {
        if(isset($_POST['prenom'])){
        $query = "SELECT * FROM `utilisateurs` WHERE (`login`,`promotion`)=(?,?)";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array(strtolower(htmlspecialchars($_POST['prenom'])).".".strtolower(htmlspecialchars($_POST['nom'])),htmlspecialchars($_POST['promo'])));
        $nbResult = $sth->rowCount();
        if ($nbResult==0) {
            return true;
        }
        else{
            return false;
        }
        }
        else{
            return false;
        }
    }
   
    
    public static function inscription($dbh) {
        $query = "INSERT INTO `utilisateurs` (`prenom`,`nom`,`promotion`,`email`,`addresse`,`tel`,`mdp`,`login`) VALUES (?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array(htmlspecialchars($_POST['prenom']),htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['promo']),htmlspecialchars($_POST['mail']),htmlspecialchars($_POST['adresse']),htmlspecialchars($_POST['tel']),$_POST['pass'],strtolower(htmlspecialchars($_POST['prenom'])).".".strtolower(htmlspecialchars($_POST['nom']))));
        
    }
    function exists($dbh, $logentre) {
        $query = "SELECT * FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array(strtolower($logentre)));
        $donnee = $sth->fetch();
        if ($donnee['login'] == strtolower($logentre)) {
            return true;
        }
        return false;
    }

    function bon_mdp($dbh, $logentre, $mdp) {
        if (utilisateurs::exists($dbh, $logentre)) {
            $query = "SELECT `mdp` FROM `utilisateurs` WHERE login=?";
            $sth = $dbh->prepare($query);
            $request_succeeded = $sth->execute(array(strtolower($logentre)));
            $donnee = $sth->fetch();
            if ($donnee['mdp'] == $mdp) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}

class experiences_aimees {

    public $id;
    public $id_user;
    public $id_xp;

//fonction pour récupérer les champs d'une xp aimee à partir de id_user
    public static function get_xpaimee($dbh,$id) {
        $query = "SELECT * FROM `experiences_aimees` WHERE id_user=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        $tab = array();
        $res=array();
        while($ligne=$sth->fetch()) {
            array_push($tab,$ligne['id_xp']);
        }
        foreach ($tab as $idxp){
            array_push($res,experiences::get_xp($idxp,$dbh));
        }
        return $res;
    }
 
    public static function get_unique_xpaimee($dbh,$id_user,$id_xp) {
        $query = "SELECT * FROM `experiences_aimees` WHERE id_user=? AND id_xp=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id_user,$id_xp));
        $request_succeeded = $sth->execute(array($id_user,$id_xp));
        if ($request_succeeded) {
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
    }
    
    
    public static function ajout_xp($dbh,$idxp,$id_user) {
        $query = "INSERT INTO `experiences_aimees` (`id`,`id_user`,`id_xp`) VALUES (NULL,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id_user,$idxp));
    }

    public static function delete_xp($dbh,$id_xp,$id_user){
        $query = "DELETE FROM `experiences_aimees` WHERE `experiences_aimees`.`id` = ?";
        $sth = $dbh->prepare($query);
        $id = experiences_aimees::get_unique_xpaimee($dbh,$id_user,$id_xp)['id'];
        $sth->execute(array($id));        
    }
    
    public static function is_aimee($dbh,$id_user,$id_xp){
        $query = "SELECT * FROM `experiences_aimees` WHERE id_user=? AND id_xp=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id_user,$id_xp));
        $request_succeeded = $sth->execute(array($id_user,$id_xp));
        if ($request_succeeded) {
            $res = $sth->fetch(PDO::FETCH_ASSOC);
            if($res == NULL){
                return FALSE;
            }
            else{
                return TRUE;
            }
        }        
    }
    
}

class user_co {

    public $id_user;
    public $login;
    public $mdp;

    function exists($dbh, $logentre) {
        $query = "SELECT * FROM `user_co` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($logentre));
        $donnee = $sth->fetch();
        if ($donnee['login'] == $logentre) {
            return true;
        }
        return false;
    }

    function bon_mdp($dbh, $logentre, $mdp) {
        if (user_co::exists($dbh, $logentre)) {
            $query = "SELECT `mdp` FROM `user_co` WHERE login=?";
            $sth = $dbh->prepare($query);
            $request_succeeded = $sth->execute(array($logentre));
            $donnee = $sth->fetch();
            if ($donnee['mdp'] == $mdp) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function get_user($login, $dbh) {
        $query = "SELECT * FROM `user_co` WHERE login=?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        if ($request_succeeded) {
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
    }

}

?>