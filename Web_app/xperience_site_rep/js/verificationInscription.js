$(document).ready(function(){
    
        $("#prenom").keyup(function(){
            var prenomSaisi = $("#prenom").val();
            $.post("utilities/traitementinscription.php", {string_test: prenomSaisi}, function(rep) {
                if (rep != 1) {
                    $("#inscription").hide();
                    $("#alerte_prenom").show();
                }
                else{
                    $("#inscription").show();
                    $("#alerte_prenom").hide();
                }
            });
        });
        
        $("#nom").keyup(function(){
            var nomSaisi = $("#nom").val();
            $.post("utilities/traitementinscription.php", {string_test: nomSaisi}, function(rep) {
                if (rep != 1) {
                    $("#inscription").hide();
                    $("#alerte_nom").show();
                }
                else{
                    $("#inscription").show();
                    $("#alerte_nom").hide();
                }
            });
        });
        
});

