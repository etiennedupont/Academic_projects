<?php


function generate_map_filteredetienne($filtre_annee,$filtre_organisme,$filtre_pays,$filtre_type,$filtre_domaine,$dbh){
    echo<<<FIN
        <div id = "EmplacementDeMaCarte" class = "carte">
        <noscript>
        <p>Attention : </p>
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
        <p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
        </noscript>
        <script>
                function codeAddress(geocoder,map,address,organisme,nom,type,domaine,salaire,note) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    marker.addListener('click',function(){infowindow.open(map,marker);});
                  } else {
                    alert("Geocode was not successful for the following reason: " + status);
                  }
                  
                  var contentString =         '<h2>'+organisme+'</h2>'+
        '<p><b>Nom </b>:   '+nom+'</p>'+ 
        '<p><b>Type </b>:   '+type+'</p>'+
        '<p><b>Domaine </b>:   '+domaine+'</p>'+ 
        '<p><b>Rémunération </b>:   '+salaire+'</p>'+ 
        '<p><b>Note </b>:   '+note+' / 5 </p>'+
        '<input class="bleu" type="button" value="Liste/Carte" onClick="AfficherMasquer()" />';

                  var infowindow = new google.maps.InfoWindow({
                  content: contentString
                  });

                });
                }
                
                function initialisation() {
                    var optionsCarte = {
                        zoom: 2,
                        center: new google.maps.LatLng(20, 0.6),

                        mapTypeId: google.maps.MapTypeId.SATELLITE
                    };
                    var maCarte = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);
                    var geocoder = new google.maps.Geocoder();
FIN;
$date_query="`date_debut`";
$type_query="`type`";
$domaine_query="`domaine`";
$pays_query="`pays`";
$organisme_query="`nom`";
if($filtre_annee!="toutes"){$date_query='"'.$filtre_annee.'"';}
if($filtre_type!="toutes"){$type_query='"'.$filtre_type.'"';}
if($filtre_domaine!="tous"){$date_query='"'.$filtre_domaine.'"';}
if($filtre_pays!=""){$domaine_query='"'.$filtre_domaine.'"';}
if($filtre_organisme!=""){$organisme_query='"'.$filtre_organisme.'"';}
$query = "SELECT *"
        ."FROM `experiences` AS `xp`"
        ."INNER JOIN `organisme` AS `org`"
        ."ON xp.id_org=org.id_org "
        ."WHERE `date_debut`=$date_query AND (`type`=$type_query OR `type` IS NULL) AND (`domaine`=$domaine_query OR `domaine` IS NULL)"
        ." AND `pays`=$pays_query AND `nom`=$organisme_query";
$sth = $dbh->prepare($query);
$request_succeeded = $sth->execute();
if ($request_succeeded) {
while ($ligne = $sth->fetch(PDO::FETCH_ASSOC)) {
    $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
    $user_name = $user['prenom']." ".$user['nom']." (X".$user['promotion'].")";
    $note = 3;
    $adresse = $ligne['adresse'];
    $nom = $ligne['nom'];
    $type = $ligne['type'];
    $domaine = $ligne['domaine'];
    $remuneration = $ligne['remuneration'];
echo 'codeAddress(geocoder,maCarte,"'."$adresse".'","'."$nom".'","'."$user_name".'","'."$type".'","'."$domaine".'","'."$remuneration".'","'."$note".'");';
}
}
$dbh = null;

    echo <<<FIN
                    }
            </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgi78_bEGXDfHtnar5SY4DFcP2rXqBgAg&callback=initialisation"></script>
    </div>
FIN;
      
}

function generate_map_filtered($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform){
    echo<<<FIN
        <div id = "EmplacementDeMaCarte" class = "carte">
        <noscript>
        <p>Attention : </p>
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
        <p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
        </noscript>
        <script>
                function codeAddress(geocoder,map,address,organisme,nom,type,domaine,salaire,note) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    marker.addListener('click',function(){infowindow.open(map,marker);});
                  } else {
                    alert("Geocode was not successful for the following reason: " + status);
                  }
                  
                  var contentString =         '<h2>'+organisme+'</h2>'+
        '<p><b>Nom </b>:   '+nom+'</p>'+ 
        '<p><b>Type </b>:   '+type+'</p>'+
        '<p><b>Domaine </b>:   '+domaine+'</p>'+ 
        '<p><b>Rémunération </b>:   '+salaire+'</p>'+ 
        '<p><b>Note </b>:   '+note+' / 5 </p>'+
        '<input class="bleu" type="button" value="Liste/Carte" onClick="AfficherMasquer()" />';

                  var infowindow = new google.maps.InfoWindow({
                  content: contentString
                  });

                });
                }
                
                function initialisation() {
                    var optionsCarte = {
                        zoom: 2,
                        center: new google.maps.LatLng(20, 0.6),

                        mapTypeId: google.maps.MapTypeId.SATELLITE
                    };
                    var maCarte = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);
                    var geocoder = new google.maps.Geocoder();
FIN;
foreach(experiences::recherche_xp($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) as $ligne) {
    $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
    $organisme = organisme::get_organisme ($ligne['id_org'],$dbh);
    $user_name = $user['prenom']." ".$user['nom']." (X".$user['promotion'].")";
    $note = ($ligne['responsabilite']+$ligne['charge_travail']+$ligne['accueil']+$ligne['ambiance'])/4;
    $adresse = $organisme['adresse'];
    $nom = $organisme['nom'];
    $type = $ligne['type'];
    $domaine = $ligne['domaine'];
    $remuneration = $ligne['remuneration'];
echo 'codeAddress(geocoder,maCarte,"'."$adresse".'","'."$nom".'","'."$user_name".'","'."$type".'","'."$domaine".'","'."$remuneration".'","'."$note".'");';
}

$dbh = null;

    echo <<<FIN
                    }
            </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgi78_bEGXDfHtnar5SY4DFcP2rXqBgAg&callback=initialisation"></script>
    </div>
FIN;
}  
