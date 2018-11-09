php
function generate_panel_search ($idxp,$ligne,$temoin,$organisme,$i,$annee,$type,$like,$dbh){
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    function AfficherPanel$i()
    {
        divInfo = document.getElementById('panel $i');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }

    }
    function MasquerPanel$i()
    {
        divInfo = document.getElementById('panel $i');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }

    }   



    $("boutonjaime").click(function{
$.ajax({
       url : 'jaimexp.php',
       type : 'POST', // Le type de la requête HTTP, ici devenu POST
       data : 'id_temoin=' + $temoin[id] + '&idxp=' + $idxp, // On fait passer nos variables, exactement comme en GET, au script more_com.php
       dataType : 'html'
    });

    });
</script>


<div id="panel $i" style="border:solid grey 1px;z-index:100;display:none;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
   <div class="row">
    <div class="debutpanel" style="font-size:18px ;color: rgb (1,1,50);font-weight:bold">
        $organisme[nom], $ligne[poste]<br></div>
    <div class="panelsoustitre" style="margin-bottom:10px;font-size:15px">
        $type, $annee<br>
        Xperience de $temoin[prenom] $temoin[nom], X$temoin[promotion] <br></div>

    <div class="contenupanel1 col-md-6" style="border-right:solid 1px grey;text-align:left">

    
        <span style="font-weight:bold">Durée:</span> $ligne[duree] mois.<br>
        <span style="font-weight:bold">Pays:</span> $ligne[pays]<br>
        <span style="font-weight:bold">Rémunération:</span> $ligne[remuneration]  €/mois <br>
        <span style="font-weight:bold">Domaines:</span> $ligne[domaine]<br>
        <span style="font-weight:bold">Accueil:</span> $ligne[accueil] /5<br>
        <span style="font-weight:bold">Responsabilités:</span> $ligne[responsabilite] /5<br>
        <span style="font-weight:bold">Charge de travail:</span> $ligne[charge_travail] /5<br>
        <span style="font-weight:bold">Ambiance:</span> $ligne[ambiance] /5<br>
    </div>
    <div class="contenupanel2 col-md-6" style="text-align:center">
        <span style="font-weight:bold">Référent:</span><br> $ligne[referent]<br>
        <span style="font-weight:bold">Logement:</span><br> $ligne[logement]<br>
        <span style="font-weight:bold">Bons plans autour:</span><br> $ligne[bons_plans]<br>
        <span style="font-weight:bold">Conseils de $temoin[prenom]:</span><br> $ligne[conseil]<br>
    </div>
</div>
    <div class="panelsousfin" style="margin-top:10px">
        <span style="font-weight:bold">Appréciation générale de $temoin[prenom]:</span><br> $ligne[appreciation]<br>
   <script>
    function cestlike() {
        var element = document.getElementById("boutonjaime");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime");
        element.style.display="block";
    }
        function cestpluslike() {
        var element = document.getElementById("boutondejaaime");
        element.style.display="none";
        var element = document.getElementById("boutonjaime");
        element.style.display="block";
    }
    var element = document.getElementById('boutonjaime');
    element.addEventListener(click,traitementlike($idxp));
    var element2 = document.getElementById('boutondejaaime');
    element2.addEventListener(click,traitementdislike($idxp));
</script>     
   <input type="button" id="boutonjaime" value="Ajouter à mes expériences aimées" onClick="cestlike()" style="margin:auto;display:block;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime" value="Retirer des expériences aimées" onClick="cestpluslike()" style="margin:auto;display:none;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   
           <br>
   <button type="button" class="glyphicon glyphicon-remove-circle" onClick="MasquerPanel$i()" style="border:white;background-color:white;"/>

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
 echo "</div>";*/
}
