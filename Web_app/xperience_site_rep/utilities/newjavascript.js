function codeAddress(i, geocoder, map, address, organisme, nom, type, domaine, salaire, note) {
geocoder.geocode({ 'address': address}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
var marker = new google.maps.Marker({
map: map,
        position: results[0].geometry.location
});
        marker.addListener('click', function(){infowindow.open(map, marker); });
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
        var geocoder = new google.maps.Geocoder(); codeAddress(15, geocoder, maCarte, "9 boulevard du palais, Paris", "SGZDS", "Baptiste Bouvier (X2015)", "stage dfhm", "informatique mathsapp ", "1000", "4"); codeAddress(16, geocoder, maCarte, "rue des terriers, Berlin", "Terrier", "Lapin Lapinou (X2015)", "stage de recherche", "mecanique ", "0", "1.75"); codeAddress(17, geocoder, maCarte, "128 Baker Street, London", "EDF", "Lapin Lapinou (X2015)", "stage en entreprise", "mathapps biologie ", "3200", "4"); codeAddress(19, geocoder, maCarte, "10 boulevard des maréchaux, Appartement 102029", "Ecole polytechnique", "Baptiste Bouvier (X2015)", "stage de recherche", "physique ", "0", "4.25"); }
$(document).ready(function(){
$("#unique" + 15).click(function(){
$.post("utilities/panelmap.php", {prenom:Baptiste, referent:defhy - hyhyjj, bons_plans:rfr, logement:jyjy, appreciation:rgr, conseil:frfrrgfr, ambiance:4, charge_travail:5, responsabilite:3, accueil:4, pays:France, duree:6, remuneration:1000, domaine:informatique mathsapp, poste:Chef de projet, username:Baptiste Bouvier (X2015), type:stage dfhm, annee:2013, idxp:15, organisme:SGZDS, temoin:Baptiste Bouvier (X2015)});
});
        $("#unique" + 16).click(function(){
$.post("utilities/panelmap.php", {prenom:Lapin, referent:Lapinou en chef, bons_plans:Terriers des copains, logement:Terrier lapinade, appreciation:Carotte, conseil:Eviter les renards, ambiance:3, charge_travail:1, responsabilite:2, accueil:1, pays:Allemagne, duree:12, remuneration:0, domaine:mecanique, poste:Chef de terrier, username:Lapin Lapinou (X2015), type:stage de recherche, annee:2016, idxp:16, organisme:Terrier, temoin:Lapin Lapinou (X2015)});
});
        $("#unique" + 17).click(function(){
$.post("utilities/panelmap.php", {prenom:Lapin, referent:egihrezig, bons_plans:dgkrjj, logement:grg, appreciation:knk, conseil:lnln, ambiance:4, charge_travail:4, responsabilite:4, accueil:4, pays:Royaume - Uni, duree:5, remuneration:3200, domaine:mathapps biologie, poste:cochon d'inde, username:Lapin Lapinou (X2015), type:stage en entreprise, annee:2015, idxp:17, organisme:EDF, temoin:Lapin Lapinou (X2015)});
});
        $("#unique" + 19).click(function(){
$.post("utilities/panelmap.php", {prenom:Baptiste, referent:ds, bons_plans:dff, logement:dfdf, appreciation:dfdf, conseil:dffdfdfdfdf, ambiance:5, charge_travail:4, responsabilite:3, accueil:5, pays:France, duree:6, remuneration:0, domaine:physique, poste:Chercheur, username:Baptiste Bouvier (X2015), type:stage de recherche, annee:2017, idxp:19, organisme:Ecole polytechnique, temoin:Baptiste Bouvier (X2015)});
});
});