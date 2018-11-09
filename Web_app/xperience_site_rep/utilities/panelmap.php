<?php
require ('utilities/utils.php');
require ('utilities/traitementlike.php');
require ('utilities/traitementdislike.php');
require ('utilities/traitementdelete.php');
require('Database.php');
require('xperience.php');

$dbh=Database::connect();
$idxp=$_POST['idxp'];
$organisme=$_POST['organisme'];
$username=$_POST['username'];
$poste=$_POST['poste'];

$pays=$_POST['pays'];
$duree=$_POST['duree'];
$remuneration=$_POST['remuneration'];
$domaine=$_POST['domaine'];
$accueil=$_POST['accueil'];
$reponsabilite=$_POST['responsabilite'];
$charge_travail=$_POST['charge_travail'];
$ambiance=$_POST['ambiance'];
$referent=$_POST['referent'];
$logement=$_POST['logement'];
$bons_plans=$_POST['bons_plans'];
$conseil=$_POST['conseil'];
$appreciation=$_POST['appreciation'];


//generate_panel_search($_POST['idxp'], $ligne, $_POST['temoin'], $_POST['organisme'], $_POST['idxp'], $_POST['annee'], $_POST['type'], "ok", $dbh); 
{
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    function AfficherPanel$idxp()
    {
        divInfo = document.getElementById('panelmap $idxp');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }
    }
    

    function MasquerPanel$idxp()
    {
        divInfo = document.getElementById('panelmap $idxp');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }
     }       
            
   $(document).ready(function(){ 
    $("#boutonjaime$idxp").click(function(){
     $.post("utilities/traitementlike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });
    $("#boutondejaaime$idxp").click(function(){
     $.post("utilities/traitementdislike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });            
   });
       
</script>


<div id="panelmap $idxp" style="display:block;border:solid grey 1px;z-index:100;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
   <div class="row">
    <div class="debutpanel" style="font-size:18px ;color: rgb (1,1,50);font-weight:bold">
        $organisme, $poste<br></div>
    <div class="panelsoustitre" style="margin-bottom:10px;font-size:15px">
        $type, $annee<br>
        Xperience de $username <br></div>

    <div class="contenupanel1 col-md-6" style="border-right:solid 1px grey;text-align:left">

    
        <span style="font-weight:bold">Durée:</span> $duree mois.<br>
        <span style="font-weight:bold">Pays:</span> $pays<br>
        <span style="font-weight:bold">Rémunération:</span> $remuneration  €/mois <br>
        <span style="font-weight:bold">Domaines:</span> $domaine<br>
        <span style="font-weight:bold">Accueil:</span> $accueil /5<br>
        <span style="font-weight:bold">Responsabilités:</span> $responsabilite /5<br>
        <span style="font-weight:bold">Charge de travail:</span> $charge_travail /5<br>
        <span style="font-weight:bold">Ambiance:</span> $ambiance /5<br>
    </div>
    <div class="contenupanel2 col-md-6" style="text-align:center">
        <span style="font-weight:bold">Référent:</span><br> $referent<br>
        <span style="font-weight:bold">Logement:</span><br> $logement<br>
        <span style="font-weight:bold">Bons plans autour:</span><br> $bons_plans<br>
        <span style="font-weight:bold">Conseils de $prenom:</span><br> $conseil<br>
    </div>
</div>
    <div class="panelsousfin" style="margin-top:10px">
        <span style="font-weight:bold">Appréciation générale de $prenom:</span><br> $appreciation<br>
   
   
   <script>
    function cestlike$idxp() {
        var element = document.getElementById("boutonjaime$idxp");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime$idxp");
        element.style.display="block";
    }
        function cestpluslike$idxp() {
        var element = document.getElementById("boutondejaaime$idxp");
        element.style.display="none";
        var element = document.getElementById("boutonjaime$idxp");
        element.style.display="block";
    }
   
   
  
   
   </script>
        
            
CHAINE_DE_FIN;


    $dbh = Database::connect();
    if (experiences_aimees::is_aimee($dbh, $_SESSION['id'], $idxp)) {
        echo <<<FIN
   <input type="button" id="boutonjaime$idxp" value="Ajouter à mes expériences aimées" onClick="cestlike$idxp()" style="margin:auto;display:none;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$idxp" value="Retirer des expériences aimées" onClick="cestpluslike$idxp()" style="margin:auto;display:block;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    } else {
        echo <<<FIN
   <input type="button" id="boutonjaime$idxp" value="Ajouter à mes expériences aimées" onClick="cestlike$idxp()" style="margin:auto;display:block;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$idxp" value="Retirer des expériences aimées" onClick="cestpluslike$idxp()" style="margin:auto;display:none;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    }
    $dbh = NULL;

    echo <<<CHAINE_DE_FIN
           
           <br>
   <button type="button" class="glyphicon glyphicon-remove-circle" onClick="MasquerPanel$idxp()" style="border:white;background-color:white;"/>

   </div>
</div>

CHAINE_DE_FIN;
    //tentative de ne pas afficher appreciation et tout si c'est vide
    /* if (strlen($ligne['referent']>0)){
      echo "Référent: $ligne[referent]<br>";}
      echo "Logement: $ligne[logement]<br>";
      if (strlen($ligne['bons_plans']>0)){
      echo "Bons plans autour: $ligne[bons_plans]<br>";}
      if (strlen($ligne['conseil']>0)){
      echo "Conseils de $temoin[prenom]: $ligne[conseil]<br>";}

      echo"</div>";
      if (strlen($ligne['appreciation']>0)){
      echo "Appréciation générale de $temoin[prenom]: $ligne[appreciation]<br>";}
      echo"<input class='bleu' type='button' value='$like' onClick='traitement_like()' />";
      echo "</div>"; */
}



