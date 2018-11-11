<?php

function checkPage($askedPage, $page_list) {
    foreach ($page_list as $page) {
        if ($page == $askedPage)
            return true;
    }
    return false;
}

function generateHTMLHeader($titre, $chemincss, $chemincss2) {
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
            <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8" />
        <title>$titre</title>

        <!-- CSS Bootstrap -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <!-- CSS Perso -->
        <link href="$chemincss.css" rel="stylesheet">
        <link href="$chemincss2.css" rel="stylesheet">
            
        <link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/pluginDatatableFrench.js" type="text/javascript"></script>
        <script src="js/verificationInscription.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#table_recherche').DataTable(
                    {
                      "language":{
                            "url":"js/pluginDatatableFrench.json"
                        }
                    }
                );});
        </script>
        </head>
        <body>
CHAINE_DE_FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
            </body>
</html>
CHAINE_DE_FIN;
}

function generate_menu_accueil() {
    echo<<<CHAINE_DE_FIN
        <div class="menuaccueil">
            <div class="welcome">
                Welcome to Xperience
            </div>
            <div class="formulaires">
                <span style="color:rgb(200,200,250)">Entrez vos identifiants frankiz</span>
                
                <div class="cases">
                <form method="post" action="index.php?page=global&todo=login">
   <p>
       <label for="pseudo">&nbsp;Identifiant&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="Identifiant" id="Identifiant" placeholder="Identifiant" autofocus required/>
       
       <br />
       <label for="pass">Mot de passe&nbsp;&nbsp;  </label>
       <input type="password" name="pass" id="pass" placeholder="Mot de passe" required/>
          
   </p>
<input type="submit" value="Go !" style="width:40px;color:rgb(1,1,100);border:rgb(1,1,100);border-radius:3px"/>
</form>
                </div>
    <a href="index.php?page=inscription" style="color:rgb(200,200,250)">Pas encore inscrit?</a>
            </div>
        </div>
CHAINE_DE_FIN;
}

function generate_formulaire_inscription2() {
    echo<<<CHAINE_DE_FIN
        <div class="menuaccueil">
            <div class="welcome">
                Welcome to Xperience
            </div>
            <div class="formulaires">
                
                <div class="cases">
                <form method="post" action="index.php?todo=inscription">
   <p>
    <span style="color:rgb(200,200,250)">Votre login sera : "prenom.nom" (identifiant frankiz)<br/><br/></span>
     
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Prénom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="prenom" id="prenom" placeholder="Prénom" autofocus required/>
       
       <br />
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Nom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="nom" id="nom" placeholder="Nom"  required/>
       
       <br />
    
       <label for="pass" style="color:rgb(200,200,250)"><span style="color:red;font-size:1.3em">*</span>Mot de passe&nbsp;&nbsp;  </label>
       <input type="password" name="pass" id="pass" placeholder="Mot de passe" required/>
          <br/>
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Promotion&nbsp;&nbsp;&nbsp; </label>
       <input type="number" name="promo" id="promo" placeholder="Promotion (ex:2015)"  required/>
       
       <br />
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Adresse mail&nbsp;&nbsp;&nbsp; </label>
       <input type="email" name="mail" id="mail" placeholder="Adresse mail" />
       
       <br />
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Téléphone&nbsp;&nbsp;&nbsp; </label>
       <input type="tel" name="tel" id="tel" placeholder="Numéro de téléphone" />
       
       <br />
           <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Adresse&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="adresse" id="adresse" placeholder="Adresse"/>
       
       <br />
   </p>
    <span style="color:red">* Champs obligatoires</span><br/><br/>
<input type="submit" value="Je m'inscris !" style="color:rgb(1,1,100);border:rgb(1,1,100);border-radius:3px"/>
</form>
                
   </div>
        <a href="index.php?page=accueil" style="color:rgb(200,200,250)">Retour au menu de connexion</a>

            </div>
        </div>
CHAINE_DE_FIN;
}

function generate_formulaire_inscriptionfail2() {
    echo<<<CHAINE_DE_FIN
        <div class="menuaccueil">
            <div class="welcome">
                Welcome to Xperience
            </div>
            <div class="formulaires">
                
                <div class="cases">
                <form method="post" action="index.php?todo=inscription">
   <p>
          <span style="color:red">Ces login et mot de passe sont déjà pris!<br/><br/></span>
    <span style="color:rgb(200,200,250)">Votre login sera : "prenom.nom" (identifiant frankiz)<br/><br/></span>
     
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Prénom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="prenom" id="prenom" placeholder="Prénom" autofocus required/>
       
       <br />
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Nom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="nom" id="nom" placeholder="Nom"  required/>
       
       <br />
    
       <label for="pass" style="color:rgb(200,200,250)"><span style="color:red;font-size:1.3em">*</span>Mot de passe&nbsp;&nbsp;  </label>
       <input type="password" name="pass" id="pass" placeholder="Mot de passe" required/>
          <br/>
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Promotion&nbsp;&nbsp;&nbsp; </label>
       <input type="number" name="promo" id="promo" placeholder="Promotion (ex:2015)"  required/>
       
       <br />
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Adresse mail&nbsp;&nbsp;&nbsp; </label>
       <input type="email" name="mail" id="mail" placeholder="Adresse mail" />
       
       <br />
    <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Téléphone&nbsp;&nbsp;&nbsp; </label>
       <input type="tel" name="tel" id="tel" placeholder="Numéro de téléphone" />
       
       <br />
           <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;Adresse&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="adresse" id="adresse" placeholder="Adresse"/>
       
       <br />
   </p>
    <span style="color:red">* Champs obligatoires</span><br/><br/>
<input type="submit" value="Je m'inscris !" style="color:rgb(1,1,100);border:rgb(1,1,100);border-radius:3px"/>
</form>
                
   </div>
            <a href="index.php?page=accueil" style="color:rgb(200,200,250)">Retour au menu de connexion</a>

            </div>
        </div>
CHAINE_DE_FIN;
}

function generate_menu_accueil_fail() {
    echo<<<CHAINE_DE_FIN
        <div class="menuaccueil">
            <div class="welcome">
                Welcome to Xperience
            </div>
            <div class="formulaires">
                <p style="color:red">Identifiant ou mot de passe invalide</p>
                Entrez vos identifiants frankiz
                
                <div class="cases">
                <form method="post" action="index.php?page=global&todo=login">
   <p>
       <label for="pseudo">&nbsp;Identifiant&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="Identifiant" id="Identifiant" placeholder="Identifiant" autofocus required/>
       
       <br />
       <label for="pass">Mot de passe&nbsp;&nbsp;  </label>
       <input type="password" name="pass" id="pass" placeholder="Mot de passe" required/>
          
   </p>
<input type="submit" value="Go !" />
</form>
                </div>
    <a href="index.php?page=inscription" style="color:rgb(200,200,250)">Pas encore inscrit?</a>
            </div>
        </div>
CHAINE_DE_FIN;
}

function generatemenugauche() {
    $_GET['page'] = 'global';
    echo <<<CHAINE_DE_FIN
<div class="col-md-4 menugauche">
                <div class="welcome2">
                    Xperience
                </div>
                <div class="formulaires" style="color:rgb(1,1,100)">
                    Que recherchez-vous?
<br><br>
                    <div class="cases">
                        <form method="post" action="index.php?todo=recherche">
                            <p>
                                <label for="xperience">Xperience</label>
                                <select name="xperience" id="xperiencedemande">
                                    <option value="toutes">Toutes</option>
                                    <option value="stage dfhm">Stage DFHM(1A)</option>
                                    <option value="stage en entreprise">Stage en entreprise (2A)</option>
                                    <option value="stage de recherche">Stage de recherche (3A)</option>
                                    <option value="4A">4A</option>
                                    </select><br>

                                <label for="domaine">Domaine académique</label>
                                <select name="domaine" id="domainedemande">
                                    <option value="tous">Tous</option>
                                    <option value="mecanique">Mécanique</option>
                                    <option value="physique">Physique</option>
                                    <option value="economie">Economie</option>
                                    <option value="biologie">Biologie</option>
                                    <option value="chimie">Chimie</option>
                                    <option value="informatique">Informatique</option>
                                    <option value="mathématiques">Mathématiques</option>
                                    <option value="mathapps">Maths app'</option>
                                </select><br>
                                
                                <label for="annee">Année</label>
                                <select name="annee" id="anneedemandee">
                                    <option value="toutes">Toutes</option>
                                    <option value="2016">16</option>                                 
                                    <option value="2015">15</option>
                                    <option value="2014">14</option>
                                    <option value="2013">13</option>
                                    <option value="2012">12</option>
                                    <option value="2011">11</option>
                                    <option value="2010">10</option>
                                    <option value="2009">09</option>
                                    <option value="2008">08</option>
                                    <option value="2007">07</option>
                                    <option value="2006">06</option>
                                </select><br>
                                <label for="pays">Pays</label>
                                 <input type="text" name="pays" id="pays" placeholder="Tous"><br>
    <label for="remuneration">Rémunération min(€/mois)</label>
                                 <input type="number" name="remuneration" id="remuneration" placeholder="Toutes"><br>
    <label for="organisme">Nom Organisme</label>
                                 <input type="text" name="organisme" id="organisme" placeholder="Tous">
                            </p>
                                <input class= "bleu" type="submit" value="Envoyer" />
                        </form>

                        <script type="text/javascript">
                            /* Voici la fonction javascript qui change la propriété "display"
                             pour afficher ou non le div selon que ce soit "none" ou "block". */

                            function AfficherMasquer()
                            {
                                divInfo = document.getElementById('EmplacementDeMaCarte');
                                divInfo2 = document.getElementById('EmplacementDeMaListe');
                                if (divInfo.style.display == 'none') {
                                    divInfo2.style.display = 'none';
                                    divInfo.style.display = 'block';
                                } else {
                                    divInfo.style.display = 'none';
                                    divInfo2.style.display = 'block';
                                }

                            }

                        </script>
                        <input class="bleu" type="button" value="Liste/Carte" onClick="AfficherMasquer()" />
                    </div>
                </div>
</div>
CHAINE_DE_FIN;
}

function generatemenugauche_global() {
    $_GET['page'] = 'global';
    echo <<<CHAINE_DE_FIN
<div class="col-md-4 menugauche">
                <div class="welcome2">
                    Xperience
                </div>
                <div class="formulaires" style="color:rgb(1,1,100)">
                    Faites votre recherche:
<br><br>
                    <div class="cases">
                        <form method="post" action="index.php?todo=recherche">
                            <p>
                                <label for="xperience">Xperience</label>
                                <select name="xperience" id="xperiencedemande">
                                    <option value="toutes">Toutes</option>
                                    <option value="stage dfhm">Stage DFHM(1A)</option>
                                    <option value="stage en entreprise">Stage en entreprise (2A)</option>
                                    <option value="stage de recherche">Stage de recherche (3A)</option>
                                    <option value="4A">4A</option>
                                    </select><br>

                                <label for="domaine">Domaine académique</label>
                                <select name="domaine" id="domainedemande">
                                    <option value="tous">Tous</option>
                                    <option value="mecanique">Mécanique</option>
                                    <option value="physique">Physique</option>
                                    <option value="economie">Economie</option>
                                    <option value="biologie">Biologie</option>
                                    <option value="chimie">Chimie</option>
                                    <option value="informatique">Informatique</option>
                                    <option value="mathématiques">Mathématiques</option>
                                    <option value="mathapps">Maths app'</option>
                                </select><br>
                                
                                <label for="annee">Année</label>
                                <select name="annee" id="anneedemandee">
                                    <option value="toutes">Toutes</option>
                                    <option value="2016">16</option>                                 
                                    <option value="2015">15</option>
                                    <option value="2014">14</option>
                                    <option value="2013">13</option>
                                    <option value="2012">12</option>
                                    <option value="2011">11</option>
                                    <option value="2010">10</option>
                                    <option value="2009">09</option>
                                    <option value="2008">08</option>
                                    <option value="2007">07</option>
                                    <option value="2006">06</option>
                                </select><br>
                                <label for="pays">Pays</label>
                                 <input type="text" name="pays" id="pays" placeholder="Tous"><br>
    <label for="remuneration">Rémunération min(€/mois)</label>
                                 <input type="number" name="remuneration" id="remuneration" placeholder="Toutes"><br>
    <label for="organisme">Nom Organisme</label>
                                 <input type="text" name="organisme" id="organisme" placeholder="Tous">
                            </p>
                                <input class= "bleu" type="submit" value="Envoyer" />
                        </form>

                    </div>
                </div>
            </div>
CHAINE_DE_FIN;
}

function generatemenugauche_globalafterinscription() {
    $_GET['page'] = 'global';
    echo <<<CHAINE_DE_FIN
<div class="col-md-4 menugauche">
                <div class="welcome2">
                    Xperience
                </div>
                <div class="formulaires" style="color:rgb(1,1,100)">
                    Vous êtes bien inscrit!<br/>
                    Faites votre recherche:
<br><br>
                    <div class="cases">
                        <form method="post" action="index.php?todo=recherche">
                            <p>
                                <label for="xperience">Xperience</label>
                                <select name="xperience" id="xperiencedemande">
                                    <option value="toutes">Toutes</option>
                                    <option value="stage dfhm">Stage DFHM(1A)</option>
                                    <option value="stage en entreprise">Stage en entreprise (2A)</option>
                                    <option value="stage de recherche">Stage de recherche (3A)</option>
                                    <option value="4A">4A</option>
                                    </select><br>

                                <label for="domaine">Domaine académique</label>
                                <select name="domaine" id="domainedemande">
                                    <option value="tous">Tous</option>
                                    <option value="mecanique">Mécanique</option>
                                    <option value="physique">Physique</option>
                                    <option value="economie">Economie</option>
                                    <option value="biologie">Biologie</option>
                                    <option value="chimie">Chimie</option>
                                    <option value="informatique">Informatique</option>
                                    <option value="mathématiques">Mathématiques</option>
                                    <option value="mathapps">Maths app'</option>
                                </select><br>
                                
                                <label for="annee">Année</label>
                                <select name="annee" id="anneedemandee">
                                    <option value="toutes">Toutes</option>
                                    <option value="2016">16</option>                                 
                                    <option value="2015">15</option>
                                    <option value="2014">14</option>
                                    <option value="2013">13</option>
                                    <option value="2012">12</option>
                                    <option value="2011">11</option>
                                    <option value="2010">10</option>
                                    <option value="2009">09</option>
                                    <option value="2008">08</option>
                                    <option value="2007">07</option>
                                    <option value="2006">06</option>
                                </select><br>
                                <label for="pays">Pays</label>
                                 <input type="text" name="pays" id="pays" placeholder="Tous"><br>
    <label for="remuneration">Rémunération min(€/mois)</label>
                                 <input type="number" name="remuneration" id="remuneration" placeholder="Toutes"><br>
    <label for="organisme">Nom Organisme</label>
                                 <input type="text" name="organisme" id="organisme" placeholder="Tous">
                            </p>
                                <input class= "bleu" type="submit" value="Envoyer" />
                        </form>

                    </div>
                </div>
            </div>
CHAINE_DE_FIN;
}

function head_nav_bar_deco2() {
$nom=htmlspecialchars($_SESSION['prenom']);
    echo <<<FIN
    <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid ; border-color: white;border-bottom-width:2px; background-color:rgba(0,0,0,0.6)">
  <div class="container-fluid">
    
    <!-- Brand and toggle get grouped for better mobile display -->
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page=global" id="Xperience">Accueil</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li style="border-left: solid; border-right: solid;border-width:1px;border-color:white"><a href="index.php?page=ajout" style="color:white;font-size:16px;font-family:Raleway">Ajouter une Xperience </a></li>
        <li><a href="index.php?page=mes_experiences" style="color:white;font-family:Raleway;font-size:16px">Mes Xperiences</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?page=accueil&todo=delog"style="color:white ;font-family:Raleway;font-size:16px">Déconnexion</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"style="color:white;font-family:Raleway;border-right:white 1px solid;font-size:16px">Bonjour $nom !</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <div class="corps"> 
                <div class = "row">
FIN;
}

function head_nav_bar_deco() {
$nom=htmlspecialchars($_SESSION['prenom']);
    echo <<<FIN
    <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid ; border-color: white;border-bottom-width:2px; background-color:rgba(0,0,0,0.6)">
  <div class="container-fluid">
    
    <!-- Brand and toggle get grouped for better mobile display -->
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page=global" id="Xperience">Accueil</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li style="border-left: solid; border-right: solid;border-width:1px;border-color:white"><a href="index.php?page=ajout" style="color:white;font-size:16px;font-family:Raleway">Ajouter une Xperience </a></li>
        <li><div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color:white;font-family:Raleway;font-size:16px;background-color:rgba(0,0,0,0);border:transparent;margin:0 auto;height:50px">
    Mes expériences
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="background-color:rgba(0,0,0,0.6)">
    <li><a href="index.php?page=mes_experiences_aimees" style="color:white">Expériences aimées</a></li>
    <li><a href="index.php?page=mes_experiences" style="color:white">Expériences déposées</a></li>
  </ul>
</div></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?page=accueil&todo=delog"style="color:white ;font-family:Raleway;font-size:16px">Déconnexion</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"style="color:white;font-family:Raleway;border-right:white 1px solid;font-size:16px">Bonjour $nom !</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <div class="corps"> 
                <div class = "row">
FIN;
}

function ferme_div(){
    echo"</div>";
}

function head_nav_bar_co() {

    echo <<<FIN
    <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid ; border-color: white;border-bottom-width:2px; background-color:rgba(100,100,100,1)">
  <div class="container-fluid">
    
    <!-- Brand and toggle get grouped for better mobile display -->
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page=global" id="Xperience">Xperience</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li style="border-left: solid; border-right: solid; color:white;border-width:1px;"><a href="index.php?page=ajout" style="color:rgba(230,230,230,0.95)">Ajouter une Xperience </a></li>
        <li><a href="index.php?page=mes_experiences" style="color:rgba(230,230,230,0.95);font-family:Raleway">Mes Xperiences</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style=" font-weight:normal;margin-right:5px">
    <p class="formco">
       <form method="post" action="index.php?page=global&todo=login">
       <label for="pseudo" style="color:white">&nbsp;Identifiant&nbsp;&nbsp;&nbsp; </label>
       <input type="text" style="color:black" name="Identifiant" id="Identifiant" placeholder="Identifiant" autofocus required/>&nbsp;&nbsp;
       <label for="pass" style="font-weight:normal;color:white">Mot de passe&nbsp;&nbsp;  </label>
       <input type="password"style="color:black" name="pass" id="pass" placeholder="Mot de passe" required/>&nbsp;&nbsp;
       <input type="submit" value=" Connexion" / style="color:black">
    </p>
</form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </div>
        <div class="corps"> 
                <div class = "row">
FIN;
}

function head_nav_bar_ajout() {

    echo <<<FIN
    <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid ; border-color: white;border-bottom-width:2px; background-color:rgba(100,100,100,1)">
  <div class="container-fluid">
    
    
    <!-- Brand and toggle get grouped for better mobile display -->
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="global.php" id="Xperience">Xperience</a>
    </div>

    
    <!-- Collect the nav links, forms, and other content for toggling -->
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li style="border-left: solid; border-right: solid; color:white;border-width:1px;"><a href=# style="color:rgba(230,230,230,0.95)">Ajouter une Xperience </a></li>
        <li><a href="mes_experiences.php"style="color:rgba(230,230,230,0.95);font-family:Raleway">Mes Xperiences</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"style="color:rgba(230,230,230,0.95);font-family:Raleway">Déconnexion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
FIN;
}

function bottom_nav_bar() {

    echo <<<FIN
    <nav class="navbar navbar-default navbar-fixed-bottom" style="background-color:rgba(0,0,0,0);border-color:rgba(0,0,0,0)">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Contact</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
FIN;
}

function ligneliste($nom, $prenom, $promotion, $email, $feuille) {
    echo <<<CHAINE_DE_FIN
 <tr style="border-bottom:solid rgba(200,200,200,0.4) 4px ; margin-top:5px;background-color:white;font-size:12px">
                <td style="border-right:2px solid rgba(0,0,200,0.3);padding-left:5px">$prenom $nom <br>$promotion</td>
                <td style="padding-left:5px">$email<br> $feuille</td>
            </tr>
CHAINE_DE_FIN;
}

function ligneliste2() {
    echo <<<CHAINE_DE_FIN
 <tr style="border-bottom:solid rgba(200,200,200,0.4) 4px ; margin-top:5px;background-color:white;font-size:12px">
                <td style="border-right:2px solid rgba(0,0,200,0.3);padding-left:5px">Lui <br> X 3</td>
                <td style="padding-left:5px">Super Xperience j'ai plus faim <br> Un peu d'eau?</td>
            </tr>
CHAINE_DE_FIN;
}

function formulaires_stage() {
    echo <<<CHAINE_DE_FIN
    <div class="coucou">
<label for="organisme">Nom de l'organisme:</label><br>
                            <input type="text" name="organisme" id="organismedemande" placeholder="Université, Entreprise..." required class="largeassezajout"><br><br>

                            <label for="poste">Poste occupé:</label><br>
                            <input type="text" name="poste" id="postedemande" class="largeassezajout"><br><br>

                            <label for="date">Date de début:</label><br>
                            <input type="date" name="datededebut" id="datededebut"><br><br>

                            <label for="duree">Durée (en mois):</label><br>
                            <input type="number" name="duree" id="dureedemandee" style="width:80px" placeholder="Nombre"><br><br>

                            <label for="pays">Pays:</label><br>
                            <input type="text" name="pays" id="paysdemande" style="width:120px" required><br><br>

                            <label for="adresse">Adresse:</label><br>
                            <input type="text" name="adresse" id="adressedemandee" class="largeassezajout" required><br><br>

                            <label for="remuneration">Rémunération (€/mois):</label><br>
                            <input type="number" name="remuneration" id="remuneration" style="width:80px"><br><br>

                            <label for="domaine">Domaines académiques en rapport avec ton experience:</label><br>
                            <input type="checkbox" name="domaine[]" value="informatique"/><label for="informatique" class="caseajout">Informatique </label><br/>
                            <input type="checkbox" name="domaine[]" value="mecanique"/><label for="mecanique" class="caseajout">Mécanique </label><br/>
                            <input type="checkbox" name="domaine[]" value="mathapps"/><label for="mathsapp" class="caseajout">Maths appliquées </label><br/>
                            <input type="checkbox" name="domaine[]" value="physique"/><label for="physique" class="caseajout">Physique</label><br/>
                            <input type="checkbox" name="domaine[]" value="biologie"/><label for="biologie" class="caseajout">Biologie </label><br/>
                            <input type="checkbox" name="domaine[]" value="economie"/><label for="economie" class="caseajout">Economie </label><br/>
                            <input type="checkbox" name="domaine[]" value="chimie"/><label for="chimie" class="caseajout">Chimie </label><br/>
                            <input type="checkbox" name="domaine[]" value="maths"/><label for="maths" class="caseajout">Maths </label><br/>
</div>
CHAINE_DE_FIN;
}

function formulaires_4A() {
    echo <<<CHAINE_DE_FIN
<label for="organisme">Nom de l'établissement:</label>
                            <input type="text" name="organisme" id="organisme" required><br><br>

                            <label for="date">Date de début:</label>
                            <input type="date" name="datededebut" id="datededebut"><br><br>

                            <label for="duree">Durée (en mois):</label>
                            <input type="number" name="duree" id="dureedemandee" placeholder="Nombre décimal"><br><br>

                            <label for="pays">Pays:</label>
                            <input type="text" name="pays" id="paysdemande" required><br><br>

                            <label for="adresse">Adresse:</label>
                            <input type="text" name="adresse" id="adressedemandee" required><br><br>

                            <label for="remuneration">Coût (€):</label>
                            <input type="number" name="remuneration" id="remuneration"><br><br>

                            <label for="domaine">Domaines académiques étudiés:</label><br>
                            <input type="checkbox" name="informatique" id="informatique"/><label for="informatique" class="case">Informatique </label><br/>
                            <input type="checkbox" name="mecanique" id="mecanique"/><label for="mecanique" class="case">Mécanique </label><br/>
                            <input type="checkbox" name="mathsapp" id="mathsapp"/><label for="mathsapp" class="case">Maths appliquées </label><br/>
                            <input type="checkbox" name="physique" id="physique"/><label for="physique" class="case">Physique</label><br/>
                            <input type="checkbox" name="biologie" id="biologie"/><label for="biologie" class="case">Biologie </label><br/>
                            <input type="checkbox" name="economie" id="economie"/><label for="economie" class="case">Economie </label><br/>
                            <input type="checkbox" name="chimie" id="chimie"/><label for="chimie" class="case">Chimie </label><br/>
                            <input type="checkbox" name="maths" id="maths"/><label for="maths" class="case">Maths </label><br/>
CHAINE_DE_FIN;
}

function formulaires_origine() {
    echo <<<CHAINE_DE_FIN
<label for="organisme">Nom de l'établissement:</label>
                            <input type="text" name="organisme" id="organisme" required><br><br>

                            <label for="date">Date de début:</label>
                            <input type="date" name="datededebut" id="datededebut"><br><br>

                            <label for="duree">Durée (en mois):</label>
                            <input type="number" name="duree" id="dureedemandee" placeholder="Nombre décimal"><br><br>

                            <label for="pays">Pays:</label>
                            <input type="text" name="pays" id="paysdemande" required><br><br>

                            <label for="adresse">Adresse:</label>
                            <input type="text" name="adresse" id="adressedemandee" required><br><br>

                            <label for="remuneration">Coût (€/an):</label>
                            <input type="number" name="remuneration" id="remuneration"><br><br>

                            <label for="domaine">Domaines académiques étudiés:</label><br>
                            <input type="checkbox" name="informatique" id="informatique"/><label for="informatique" class="case">Informatique </label><br/>
                            <input type="checkbox" name="mecanique" id="mecanique"/><label for="mecanique" class="case">Mécanique </label><br/>
                            <input type="checkbox" name="mathsapp" id="mathsapp"/><label for="mathsapp" class="case">Maths appliquées </label><br/>
                            <input type="checkbox" name="physique" id="physique"/><label for="physique" class="case">Physique</label><br/>
                            <input type="checkbox" name="biologie" id="biologie"/><label for="biologie" class="case">Biologie </label><br/>
                            <input type="checkbox" name="economie" id="economie"/><label for="economie" class="case">Economie </label><br/>
                            <input type="checkbox" name="chimie" id="chimie"/><label for="chimie" class="case">Chimie </label><br/>
                            <input type="checkbox" name="maths" id="maths"/><label for="maths" class="case">Maths </label><br/>
CHAINE_DE_FIN;
}

function formulaires_commun() {
    echo <<<CHAINE_DE_FIN
    <div class="coucou">
    <br>
    
                            <label for="accueil">L'accueil :</label>
                            <select name="accueil" id="accueil">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                </select><br><br>
    
                            <label for="reponsabilites">Les responsabilités :</label><br>
                            <select name="responsabilites" id="responsabilites">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select><br><br>
                            
                            <label for="charge">La charge de travail :</label><br>
                            <select name="charge" id="charge">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select><br><br>               
                            
                            <label for="ambience">L'ambiance :</label><br>
                            <select name="ambiance" id="ambiance">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select><br><br>
    
                            <label for="referent">Un référent :</label><br>
                            <textarea name="referent" id="referent" class="grandescasesajout" placeholder="Referent pour le poste, ou des informations..."></textarea><br><br>

                            <label for="logement">Le logement :</label><br>
                            <textarea name="logement" id="logement" class="grandescasesajout" placeholder="Tes baux pour te loger"></textarea><br><br>

                            <label for="bonsplans">Les bons plans autour:</label><br>
                            <textarea name="bonsplans" id="bonsplans" class="grandescasesajout" placeholder="Tes baux pour t'enjailler sur ton temps libre"></textarea><br><br>
    
                            <label for="conseils">Conseils :</label><br>
                            <textarea name="conseils" id="conseils" class="grandescasesajout"placeholder="Que conseillerais tu à un TOS qui ferait ce stage?"></textarea><br><br>

                            
</div>
CHAINE_DE_FIN;
}

function formulaires_appreciation() {
    echo <<<CHAINE_DE_FIN
    <br>    
                <label for="appreciation">Appréciation :</label><br>
                            <textarea name="appreciation" id="appreciation" class="grandescasesajout" placeholder="C'est ton espace, lâche toi!"></textarea><br><br>

CHAINE_DE_FIN;
}

function cree_table_aimees($dbh) {
    if (isset($_SESSION['login'])) {
        $query = "SELECT * FROM `experiences_aimees` WHERE `id_user`=" . user_co::get_user($_SESSION['login'], $dbh)['id_user'];
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'experiences_aimees');
        $request_succeeded = $sth->execute();
        if ($request_succeeded) {
            generate_table_search_header("toutes", "", "", "toutes", "tous");
            while ($courant = $sth->fetch()) {
                $user = utilisateurs::get_user($courant->id_user, $dbh);
                $experience = experiences::get_xp($courant->id_xp, $dbh);
                $organisme = organisme::get_organisme($experience['id_org'], $dbh);
                $nom = $user['nom'];
                $prenom = $user['prenom'];
                $date = $experience['date_debut'];
                $type = $experience['type'];
                $promotion = $user['promotion'];
                $domaine = $experience['domaine'];
                $pays = $organisme['pays'];
                $remuneration = $experience['remuneration'];
                generate_line_search($prenom . " " . $nom . " " . $promotion, "toutes", $date, "", $organisme['nom'], "", $pays, "toutes", $type, "tous", $domaine, $remuneration);
                //generate_line_search($nom, $filtre_annee, $annee, $filtre_organisme, $organisme, $filtre_pays, $pays, $filtre_type, $type, $filtre_domaine, $domaine, $remuneration);
            }
            generate_table_search_footer();
        }
    }
}

function cree_table_depose($dbh) {
    if (isset($_SESSION['login'])) {
        $query = "SELECT * FROM `experiences` WHERE `id_temoin`=" . user_co::get_user($_SESSION['login'], $dbh)['id_user'];
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        if ($request_succeeded) {
            echo<<<CHAINE_DE_FIN
            <div class='col-md-offset-3'>
        <table class="table table-hover" style='margin-top: 50px; margin-left: 20px'>
            <thead>
            <tr style='border-bottom: solid; border-bottom-color: whitesmoke'> 
                <th>Date </th>
                <th>Organisme </th>
                <th>Type d'expérience </th> 
            </tr>
            </thead>
            <tbody>
CHAINE_DE_FIN;
            while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
                $date = $courant['date_debut'];
                $type = $courant['type'];
                $organisme = organisme::get_organisme($courant['id_org'], $dbh)['nom'];
                $date_fin = $courant['duree'];
                echo <<<CHAINE_DE_FIN
                <tr>
                <td style='border-right : solid; border-right-width: 2px; border-right-color: whitesmoke'> $date / $date_fin mois </td>
                <td style='border-right : solid; border-right-width: 2px; border-right-color: whitesmoke'> $organisme</td>
                <td style='border-right : solid; border-right-width: 2px; border-right-color: whitesmoke'> $type </td>
                    </tr>
CHAINE_DE_FIN;
            }
            echo <<<CHAINE_DE_FIN
            </tbody>
          </table>
            </div>
CHAINE_DE_FIN;
        }
    }
}

function generate_menu_gauche_mesxp() {
    echo<<<CHAINE_DE_FIN
    <div class='col-md-3 menugauche'>
        <div class="welcome2">
            Xperience <br><BR>
        </div>
        <a href="index.php?page=mes_experiences"><button type="button" class="btn btn-success">Expériences déposées</button> <br><BR></a>
        <a href="index.php?page=mes_experiences_aimees"><button type="submit" class="btn btn-danger" style="width: 165px">Expériences aimées</button><br><BR></a>
    </div>
CHAINE_DE_FIN;
}

function generate_menu_gauche_mesxpaimees() {
    echo<<<CHAINE_DE_FIN
    <div class='col-md-3 menugauche'>
        <div class="welcome2">
            Xperience <br>
                <span style="font-size:18px;font-style:italic;color:rgb(0,0,0,0.8)">Expériences aimées</span><br><br>
    
        </div>
        <a href="index.php?page=mes_experiences"><button type="button" class="bleu" style="margin:auto">Expériences déposées</button> <br><BR></a>
    </div>
CHAINE_DE_FIN;
}

function generate_menu_gauche_mesxpdeposees() {
    echo<<<CHAINE_DE_FIN
    <div class='col-md-3 menugauche'>
        <div class="welcome2">
            Xperience <br>
                <span style="font-size:18px;font-style:italic;color:rgb(0,0,0,0.8)">Expériences déposées</span><br><br>
    
        </div>
        <a href="index.php?page=mes_experiences_aimees"><button type="submit" class="bleu" style="width: 165px">Expériences aimées</button><br><BR></a>
    </div>
CHAINE_DE_FIN;
}

function generate_table_search_headerfull() {
    echo <<<FIN
    <!-- attention, pour la version définitive il ne faut pas oublier d'ajouter display:none dans le style -->
    <div id = "EmplacementDeMaListe" class = "col-md-offset-3 liste" style = "margin-top:65px;margin-right:15px;">
    <div class = "liste">
        <div class="queue" style="margin-left:15px;margin-right:5px">
            <table id="table_recherche" class="display" width="100%" cellspacing="0" style="color:rgb(1,1,100);z-index:2">
                <thead>
                    <tr><th></th>
                        <th>Nom</th>
FIN;
    echo "<th> Année </th>";


    echo "<th> Organisme </th>";
    echo "<th>Pays</th>";

    echo "<th>Type d'expérience</th>";

    echo "<th>Domaine</th>";

    echo "<th>Rémunération (€/mois)</th>";
    echo "</tr>";
    echo "</thead>";
    echo <<<FIN
                    <tfoot>
                    <tr><th></th>
                        <th>Nom</th>
FIN;

    echo "<th> Année </th>";
    echo "<th> Organisme </th>";
    echo "<th>Pays</th>";
    echo "<th>Type d'expérience</th>";
    echo "<th>Domaine</th>";
    echo "<th> Rémunération (€/mois)</th> </tr> </tfoot>  <tbody>";
}

//Attention : la fonction prend en paramètres les valeurs des filtres demandés par l'utilisateur ($_POST[annee], etc.)
function generate_table_search_header($filtre_annee, $filtre_organisme, $filtre_pays, $filtre_type, $filtre_domaine) {
    echo <<<FIN
    <!-- attention, pour la version définitive il ne faut pas oublier d'ajouter display:none dans le style -->
    <div id = "EmplacementDeMaListe" class = "col-md-offset-3 liste" style = "display:none;margin-top:65px;margin-right:15px;">
    <div class = "liste">
        <div class="queue" style="margin-left:15px;margin-right:5px">
            <table id="table_recherche" class="display" width="100%" cellspacing="0" style="color:rgb(1,1,100);z-index:2">
                <thead>
                    <tr>
    <th></th>
                        <th>Nom</th>
FIN;
    if ($filtre_annee == "toutes") {
        echo "<th> Année </th>";
    }

    echo "<th> Organisme </th>";
    if ($filtre_pays == "") {
        echo "<th>Pays</th>";
    }
    if ($filtre_type == "toutes") {
        echo "<th>Type d'expérience</th>";
    }
    if ($filtre_domaine == "tous") {
        echo "<th>Domaine</th>";
    }
    echo "<th>Rémunération (€/mois)</th>";
    echo "</tr>";
    echo "</thead>";
    echo <<<FIN
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Nom</th>
FIN;
    if ($filtre_annee == "toutes") {
        echo "<th> Année </th>";
    }
    if ($filtre_organisme == "") {
        echo "<th> Organisme </th>";
    }
    if ($filtre_pays == "") {
        echo "<th>Pays</th>";
    }
    if ($filtre_type == "toutes") {
        echo "<th>Type d'expérience</th>";
    }
    if ($filtre_domaine == "tous") {
        echo "<th>Domaine</th>";
    }
    echo "<th> Rémunération (€/mois)</th> </tr> </tfoot>  <tbody>";
}

//Ici on met en paramètre les données à insérer dans chacune des lignes du tableau ET la valeur des filtres demandés par l'utilisateur, afin de discriminer les données à effectivement afficher
function generate_line_search($i, $nom, $filtre_annee, $annee, $filtre_organisme, $organisme, $filtre_pays, $pays, $filtre_type, $type, $filtre_domaine, $domaine, $remuneration) {
    echo "<tr>";
    echo<<<FIN
    <td> <button type="button" style="color:rgba(100,200,10,0.6);border:0px" class="btn btn-default btn-md" title="plus d'infos !" onClick="AfficherPanel$i()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button></td>
FIN;
    echo "<td> $nom </td>";
    if ($filtre_annee == "toutes") {
        echo "<td> $annee </td>";
    }

    echo "<td> $organisme </td>";

    if ($filtre_pays == "") {
        echo "<td> $pays</td>";
    }
    if ($filtre_type == "toutes") {
        echo "<td>$type</td>";
    }
    if ($filtre_domaine == "tous") {
        echo "<td>$domaine</td>";
    }
    echo <<<FIN
    <td> $remuneration </td>
FIN;

    echo "</tr>";
}

function generate_line_searchfull($i, $nom, $annee, $organisme, $pays, $type, $domaine, $remuneration) {
    echo "<tr>";
    echo<<<FIN
    <td> <button type="button" style="color:rgba(100,200,10,0.6);border:0px" class="btn btn-default btn-md" title="plus d'infos !" onClick="AfficherPanel$i()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button></td>
FIN;
    echo "<td> $nom </td>";
    echo "<td> $annee </td>";

    echo "<td> $organisme </td>";

    echo "<td> $pays</td>";
    echo "<td>$type</td>";
    echo "<td>$domaine</td>";
    echo <<<FIN
    <td> $remuneration </td>
FIN;

    echo "</tr>";
}

function generate_panel_search($mail,$tel,$idxp, $ligne, $temoin, $organisme, $i, $annee, $type, $like, $dbh) {
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    function AfficherPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }
    }
    

    function MasquerPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }
     }       
            
   $(document).ready(function(){ 
    $("#boutonjaime$i").click(function(){
     $.post("utilities/traitementlike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });
    $("#boutondejaaime$i").click(function(){
     $.post("utilities/traitementdislike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });            
   });
       
</script>


<div id="panel$i" style="border:solid grey 1px;z-index:100;display:none;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
   <div class="row">
    <div class="debutpanel" style="font-size:18px ;color: rgb (1,1,50);font-weight:bold">
        $organisme[nom], $ligne[poste]<br></div>
    <div class="panelsoustitre" style="margin-bottom:10px;font-size:15px">
        $type, $annee<br>
        Xperience de $temoin[prenom] $temoin[nom], X$temoin[promotion] <br>
            <span style="font-size:16 px;color:rgba(0,0,0,0.8)">$mail
CHAINE_DE_FIN;
    if ($tel>0){echo", $tel <br>";}
    echo<<<CHAINE_DE_FIN
    </span><br></div>

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
    function cestlike$i() {
        var element = document.getElementById("boutonjaime$i");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="block";
    }
        function cestpluslike$i() {
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="none";
        var element = document.getElementById("boutonjaime$i");
        element.style.display="block";
    }
   
   
  
   
   </script>
        
            
CHAINE_DE_FIN;


    $dbh = Database::connect();
    if (experiences_aimees::is_aimee($dbh, $_SESSION['id'], $idxp)) {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:none;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:block;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    } else {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:block;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:none;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    }
    $dbh = NULL;

    echo <<<CHAINE_DE_FIN
           
           <br>
   <button type="button" class="glyphicon glyphicon-remove-circle" onClick="MasquerPanel$i()" style="border:white;background-color:white;"></button>

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

function generate_panel_searchmap($idxp, $ligne, $temoin, $organisme, $i, $annee, $type, $like, $dbh) {
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    function AfficherPanel$i()
    {
        divInfo = document.getElementById('panelmap $i');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }
    }
    

    function MasquerPanel$i()
    {
        divInfo = document.getElementById('panelmap $i');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }
     }       
            
   $(document).ready(function(){ 
    $("#boutonjaime$i").click(function(){
     $.post("utilities/traitementlike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });
    $("#boutondejaaime$i").click(function(){
     $.post("utilities/traitementdislike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });            
   });
       
</script>


<div id="panelmap $i" style="border:solid grey 1px;z-index:100;display:none;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
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
    function cestlike$i() {
        var element = document.getElementById("boutonjaime$i");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="block";
    }
        function cestpluslike$i() {
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="none";
        var element = document.getElementById("boutonjaime$i");
        element.style.display="block";
    }
   
   
  
   
   </script>
        
            
CHAINE_DE_FIN;


    $dbh = Database::connect();
    if (experiences_aimees::is_aimee($dbh, $_SESSION['id'], $idxp)) {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:none;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:block;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    } else {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:block;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:none;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    }
    $dbh = NULL;

    echo <<<CHAINE_DE_FIN
           
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
      echo "</div>"; */
}

function generate_panel_searchdejaaime($mail,$tel,$idxp, $ligne, $temoin, $organisme, $i, $annee, $type, $like, $dbh) {
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    
    function AfficherPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }
    }
            
    function MasquerPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }
    }
           
   $(document).ready(function(){ 
    $("#boutonjaime$i").click(function(){
     $.post("utilities/traitementlike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });
    $("#boutondejaaime$i").click(function(){
     $.post("utilities/traitementdislike.php", {idxp: $idxp, id_user: $_SESSION[id]});
    });            
   });
                   
            
</script>

            

<div id="panel$i" style="border:solid grey 1px;z-index:100;display:none;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
   <div class="row">
    <div class="debutpanel" style="font-size:18px ;color: rgb (1,1,50);font-weight:bold">
        $organisme[nom], $ligne[poste]<br></div>
    <div class="panelsoustitre" style="margin-bottom:10px;font-size:15px">
        $type, $annee<br>
        Xperience de $temoin[prenom] $temoin[nom], X$temoin[promotion] <br>
            <span style="font-size:16 px;color:rgba(0,0,0,0.8)">$mail
CHAINE_DE_FIN;
    if ($tel>0){echo ", $tel";}
    echo<<<CHAINE_DE_FIN
    </span><br></div>

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
    function cestlike$i() {
        alert('traitement en cours');
        $.post("utilities/traitementlike.php", {idxp: $idxp}, function(rep) {});
        var element = document.getElementById("boutonjaime$i");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="block";
    }
        function cestpluslike$i() {
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="none";
        var element = document.getElementById("boutonjaime$i");
        element.style.display="block";
    }
    var element = document.getElementById('boutonjaime$i');
    element.addEventListener(click,traitementlike($idxp));
    var element2 = document.getElementById('boutondejaaime$i');
    element2.addEventListener(click,traitementdislike($idxp));
</script>     
CHAINE_DE_FIN;

    $dbh = Database::connect();
    if (experiences_aimees::is_aimee($dbh, $_SESSION['id'], $idxp)) {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:none;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:block;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    } else {
        echo <<<FIN
   <input type="button" id="boutonjaime$i" value="Ajouter à mes expériences aimées" onClick="cestlike$i()" style="margin:auto;display:block;background-color:white;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   <input type="button" id="boutondejaaime$i" value="Retirer des expériences aimées" onClick="cestpluslike$i()" style="margin:auto;display:none;background-color:LawnGreen;color:rgb(1,1,100);border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
FIN;
    }
    $dbh = NULL;

    echo <<<CHAINE_DE_FIN
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
      echo "</div>"; */
}

function generate_panel_searchdepose($mail,$tel,$idxp, $ligne, $temoin, $organisme, $i, $annee, $type, $like, $dbh) {
    //mettre la div qui s'affiche par dessus le tableau.
    echo<<<CHAINE_DE_FIN

    <script>
    function AfficherPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }

    }
    function MasquerPanel$i()
    {
        divInfo = document.getElementById('panel$i');
        if (divInfo.style.display == 'block') {
            divInfo.style.display = 'none';
        }

    }
            
   $(document).ready(function(){ 
    $("#boutonsupprimer$i").click(function(){
    var result=confirm("Etes-vous sûr de vouloir supprimer cette Xperience?");
    if (result==true){
         MasquerPanel$i();       
         $.post("utilities/traitementdelete.php", {idxp: $idxp},function(rep){alert(rep);});
    }
    });           
   });
       
</script>


<div id="panel$i" style="border:solid grey 1px;z-index:100;display:none;background-color:white;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:15px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align:center;color:rgb(1,1,100);font-family:Raleway;border-radius:5px;box-shadow:12px 12px 9px rgba(0,0,0,0.5)">
   <div class="row">
    <div class="debutpanel" style="font-size:18px ;color: rgb (1,1,50);font-weight:bold">
        $organisme[nom], $ligne[poste]<br></div>
    <div class="panelsoustitre" style="margin-bottom:10px;font-size:15px">
        $type, $annee<br>
        Xperience de $temoin[prenom] $temoin[nom], X$temoin[promotion] <br>
            <span style="font-size:16 px;color:rgba(0,0,0,0.8)">$mail
CHAINE_DE_FIN;
    if ($tel>0){echo", $tel";}
    echo<<<CHAINE_DE_FIN
    </span><br></div>

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
        var element = document.getElementById("boutonjaime$i");
        element.style.display="none";
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="block";
    }
        function cestpluslike() {
        var element = document.getElementById("boutondejaaime$i");
        element.style.display="none";
        var element = document.getElementById("boutonjaime$i");
        element.style.display="block";
    }
            function cestsupprime$i() {
        var element = document.getElementById("boutonsupprimer$i");
        element.style.backgroundColor="rgba(250,50,0,0.7)";
            element.style.borderColor="red";
        element.value="Supprimé";
    }
            function supprimer$i(){
            var result=confirm("Etes-vous sûr de vouloir supprimer cette Xperience?");
            if (result==true){
                MasquerPanel$i();
            }
   }
    
</script>     
   <input type="button" id="boutonsupprimer$i" value="Supprimer cette Xperience" style="margin:auto;display:block;background-color:white;color:black;border-color:rgb(1,1,50);border-width:1px;border-radius:3px;margin-top:10px" />
   
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
      echo "</div>"; */
}

function generate_table_search_footer() {
    echo <<<FIN
 
                    </tbody>
                    </table>
        </div>
    </div>
</div>
FIN;
}

function generate_map_filtered($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) {
    echo<<<FIN
        <div id = "EmplacementDeMaCarte" class = "col-md-offset-3" style="margin-top:60px">
        <noscript>
        <p>Attention : </p>
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
        <p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
        </noscript>
   
        <script>
    function affichepanel(i){
     divInfo = document.getElementById('panel'+i);
        if (divInfo.style.display == 'none') {
            divInfo.style.display = 'block';
        }
   }
    function essai(i){
   alert("ça marche! " +i); 
   }
    
    //////////////////
    
                function codeAddress(i,geocoder,map,address,organisme,nom,type,domaine,salaire,note) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    marker.addListener('click',function(){infowindow.open(map,marker);});
                  } 
                  
                  var contentString =         '<h2><span style="color:rgb(1,1,100)">'+organisme+'</span></h2>'+
        '<p><b>Nom </b>:   '+nom+'</p>'+ 
        '<p><b>Type </b>:   '+type+'</p>'+
        '<p><b>Domaine </b>:   '+domaine+'</p>'+ 
        '<p><b>Rémunération </b>:   '+salaire+'</p>'+ 
        '<p><b>Note </b>:   '+note+' / 5 </p>'+
        '<input id="unique"'+i+' class="bleu" type="button" value="Voir plus" onClick="affichepanel('+i+')" />';
    
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
        $user_name = $user['prenom'] . " " . $user['nom'] . " (X" . $user['promotion'] . ")";
        $note = ($ligne['responsabilite'] + $ligne['charge_travail'] + $ligne['accueil'] + $ligne['ambiance']) / 4;
        $adresse = $organisme['adresse'];
        $annee = date_parse($ligne['date_debut'])['year'];
        $idxp = $ligne['id_xp'];
        $nom = $organisme['nom'];
        $type = $ligne['type'];
        $domaine = $ligne['domaine'];
        $remuneration = $ligne['remuneration'];
        $nomorganisme=$organisme['nom'];
        $poste=$ligne['poste'];
        $duree=$ligne['duree'];
        $pays=$ligne['pays'];
        $accueil=$ligne['accueil'];
        $responsabilite=$ligne['responsabilite'];
        $charge=$ligne['charge_travail'];
        $ambiance=$ligne['ambiance'];
        $prenomtemoin=$user['prenom'];
        $referent=$ligne['referent'];
        $logement=$ligne['logement'];
        $bons_plans=$ligne['bons_plans'];
        $conseil=$ligne['conseil'];
        $appreciation=$ligne['appreciation'];
        echo 'codeAddress(' . $idxp . ',geocoder,maCarte,"' . "$adresse" . '","' . "$nom" . '","' . "$user_name" . '","' . "$type" . '","' . "$domaine" . '","' . "$remuneration" . '","' . "$note" . '");';
        
        $i++;
    }
echo"}";
     echo<<<FIN
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=callback=initialisation"></script>

FIN;

    echo"</div>";
}

function generate_map_filtered_accueil($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) {
    echo<<<FIN
        <div id = "EmplacementDeMaCarte" class = "col-md-offset-3" style="margin-top:60px">
        <noscript>
        <p>Attention : </p>
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
        <p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
        </noscript>
   
        <script>
                function codeAddress(i,geocoder,map,address,organisme,nom,type,domaine,salaire,note) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    marker.addListener('click',function(){infowindow.open(map,marker);});
                  } 
                  
                  var contentString =         '<h2><span style="color:rgb(1,1,100)">'+organisme+'</span></h2>'+
        '<p><b>Nom </b>:   '+nom+'</p>'+ 
        '<p><b>Type </b>:   '+type+'</p>'+
        '<p><b>Domaine </b>:   '+domaine+'</p>'+ 
        '<p><b>Rémunération </b>:   '+salaire+'</p>'+ 
        '<p><b>Note </b>:   '+note+' / 5 </p>';
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
        $user_name = $user['prenom'] . " " . $user['nom'] . " (X" . $user['promotion'] . ")";
        $note = ($ligne['responsabilite'] + $ligne['charge_travail'] + $ligne['accueil'] + $ligne['ambiance']) / 4;
        $adresse = $organisme['adresse'];
        $nom = $organisme['nom'];
        $type = $ligne['type'];
        $domaine = $ligne['domaine'];
        $remuneration = $ligne['remuneration'];
        echo 'codeAddress(' . $i . ',geocoder,maCarte,"' . "$adresse" . '","' . "$nom" . '","' . "$user_name" . '","' . "$type" . '","' . "$domaine" . '","' . "$remuneration" . '","' . "$note" . '");';
        $i++;
    }

    $dbh = null;

    echo <<<FIN
                    }
            </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=callback=initialisation"></script>
    </div>
FIN;
}

function session_remplit($dbh, $logentre, $mdpentre) {
    $_SESSION['login'] = $logentre;
    $query = "SELECT * FROM `utilisateurs` WHERE (login=? AND mdp=?)";
    $sth = $dbh->prepare($query);
    $sth->execute(array($logentre, $mdpentre));
    $ligne = $sth->fetch();
    $_SESSION['prenom'] = $ligne['prenom'];
    $_SESSION['nom'] = $ligne['nom'];
    $_SESSION['id'] = $ligne['id_user'];
}

function generate_etoiles($nb) {
    for ($i = 0; $i < $nb; $i++) {
        echo"☆";
    }
    for ($j = $nb; $j < 5; $j++) {
        echo"<span style='color:orange'>☆</span>";
    }
}

function generate_map_filteredetienne($filtre_annee, $filtre_organisme, $filtre_pays, $filtre_type, $filtre_domaine, $dbh) {
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
    $date_query = "`date_debut`";
    $type_query = "`type`";
    $domaine_query = "`domaine`";
    $pays_query = "`pays`";
    $organisme_query = "`nom`";
    if ($filtre_annee != "toutes") {
        $date_query = '"' . $filtre_annee . '"';
    }
    if ($filtre_type != "toutes") {
        $type_query = '"' . $filtre_type . '"';
    }
    if ($filtre_domaine != "tous") {
        $date_query = '"' . $filtre_domaine . '"';
    }
    if ($filtre_pays != "") {
        $domaine_query = '"' . $filtre_domaine . '"';
    }
    if ($filtre_organisme != "") {
        $organisme_query = '"' . $filtre_organisme . '"';
    }
    $query = "SELECT *"
            . "FROM `experiences` AS `xp`"
            . "INNER JOIN `organisme` AS `org`"
            . "ON xp.id_org=org.id_org "
            . "WHERE `date_debut`=$date_query AND (`type`=$type_query OR `type` IS NULL) AND (`domaine`=$domaine_query OR `domaine` IS NULL)"
            . " AND `pays`=$pays_query AND `nom`=$organisme_query";
    $sth = $dbh->prepare($query);
    $request_succeeded = $sth->execute();
    if ($request_succeeded) {
        while ($ligne = $sth->fetch(PDO::FETCH_ASSOC)) {
            $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
            $user_name = $user['prenom'] . " " . $user['nom'] . " (X" . $user['promotion'] . ")";
            $note = 3;
            $adresse = $ligne['adresse'];
            $nom = $ligne['nom'];
            $type = $ligne['type'];
            $domaine = $ligne['domaine'];
            $remuneration = $ligne['remuneration'];
            echo 'codeAddress(geocoder,maCarte,"' . "$adresse" . '","' . "$nom" . '","' . "$user_name" . '","' . "$type" . '","' . "$domaine" . '","' . "$remuneration" . '","' . "$note" . '");';
        }
    }
    $dbh = null;

    echo <<<FIN
                    }
            </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=callback=initialisation"></script>
    </div>
FIN;
}


//$j = 0;
//echo"$(document).ready(function(){";
//    foreach (experiences::recherche_xp($dbh, $paysform, $salaireform, $nomorgform, $typeform, $domaineform, $anneeform) as $ligne) {
//        $user = utilisateurs::get_user($ligne['id_temoin'], $dbh);
//        $organisme = organisme::get_organisme($ligne['id_org'], $dbh);
//        $user_name = $user['prenom'] . " " . $user['nom'] . " (X" . $user['promotion'] . ")";
//        $note = ($ligne['responsabilite'] + $ligne['charge_travail'] + $ligne['accueil'] + $ligne['ambiance']) / 4;
//        $adresse = $organisme['adresse'];
//        $annee = date_parse($ligne['date_debut'])['year'];
//        $idxp = $ligne['id_xp'];
//        $nom = $organisme['nom'];
//        $type = $ligne['type'];
//        $domaine = $ligne['domaine'];
//        $remuneration = $ligne['remuneration'];
//        $nomorganisme=$organisme['nom'];
//        $poste=$ligne['poste'];
//        $duree=$ligne['duree'];
//        $pays=$ligne['pays'];
//        $accueil=$ligne['accueil'];
//        $responsabilite=$ligne['responsabilite'];
//        $charge=$ligne['charge_travail'];
//        $ambiance=$ligne['ambiance'];
//        $prenomtemoin=$user['prenom'];
//        $referent=$ligne['referent'];
//        $logement=$ligne['logement'];
//        $bons_plans=$ligne['bons_plans'];
//        $conseil=$ligne['conseil'];
//        $appreciation=$ligne['appreciation'];
//       // echo 'codeAddress(' . $i . ',geocoder,maCarte,"' . "$adresse" . '","' . "$nom" . '","' . "$user_name" . '","' . "$type" . '","' . "$domaine" . '","' . "$remuneration" . '","' . "$note" . '");';
//        echo<<<FIN
//         
//    $("#unique"+$idxp).click(function(){
//$.post("utilities/panelmap.php", {prenom:$prenomtemoin,referent:$referent,bons_plans:$bons_plans,logement:$logement,appreciation:$appreciation,conseil:$conseil,ambiance:$ambiance,charge_travail:$charge,responsabilite:$responsabilite,accueil:$accueil,pays:$pays,duree:$duree,remuneration:$remuneration,domaine:$domaine,poste:$poste, username:$user_name, type:$type, annee:$annee, idxp:$idxp, organisme:$nomorganisme, temoin:$user_name});
//    });            
//   
//        
//FIN;
//        $j++;
//    }
//    $dbh = null;
//echo "});"; 
//        
//
//      echo<<<FIN
//            </script>
