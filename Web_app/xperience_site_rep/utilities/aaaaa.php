function generate_map_filtered($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) {
echo<<<FIN
    <div id = "EmplacementDeMaCarte" class = "carte" style="display : none">
        <noscript>
        <p>Attention : </p>
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
        <p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
        </noscript>

        <script>
            function codeAddress(i, geocoder, map, address, organisme, nom, type, domaine, salaire, note) {
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }

                    var contentString = '<h2><span style="align:center">' + organisme + '</span></h2>' +
                            '<p><b>Nom </b>:   ' + nom + '</p>' +
                            '<p><b>Type </b>:   ' + type + '</p>' +
                            '<p><b>Domaine </b>:   ' + domaine + '</p>' +
                            '<p><b>Rémunération </b>:   ' + salaire + '</p>' +
                            '<p><b>Note </b>:   ' + note + ' / 5 </p>' +
                            '<input id="unique"+i class="bleu" type="button" value="Voir plus" onClick="essai()" />';

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
                    $i = 0;
                    foreach (experiences::recherche_xp($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) as $ligne) {
            $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
                    $organisme = organisme::get_organisme($ligne['id_org'], $dbh);
                    $user_name = $user['prenom']." ".$user['nom']." (X".$user['promotion'].")";
                    $note = ($ligne['responsabilite'] + $ligne['charge_travail'] + $ligne['accueil'] + $ligne['ambiance']) / 4;
                    $adresse = $organisme['adresse'];
                    $annee = date_parse($ligne['date_debut'])['year'];
                    $idxp = $ligne['id_xp'];
                    $nom = $organisme['nom'];
                    $type = $ligne['type'];
                    $domaine = $ligne['domaine'];
                    $remuneration = $ligne['remuneration'];
                    $nomorganisme = $organisme['nom'];
                    $poste = $ligne['poste'];
                    $duree = $ligne['duree'];
                    $pays = $ligne['pays'];
                    $accueil = $ligne['accueil'];
                    $responsabilite = $ligne['responsabilite'];
                    $charge = $ligne['charge_travail'];
                    $ambiance = $ligne['ambiance'];
                    $prenomtemoin = $user['prenom'];
                    $referent = $ligne['referent'];
                    $logement = $ligne['logement'];
                    $bons_plans = $ligne['bons_plans'];
                    $conseil = $ligne['conseil'];
                    $appreciation = $ligne['appreciation'];
                    echo 'codeAddress('.$idxp.',geocoder,maCarte,"'."$adresse".'","'."$nom".'","'."$user_name".'","'."$type".'","'."$domaine".'","'."$remuneration".'","'."$note".'");';
                    $i++;
            }
            echo << <FIN
                    }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initialisation"></script>
    </div>
    FIN;
    }
