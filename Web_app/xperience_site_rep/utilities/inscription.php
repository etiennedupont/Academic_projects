<?php
function generate_formulaire_inscription() {
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
       <span id="alerte_prenom" style="color:red;display:none">Caractère interdit utilisé</span>
       
       <br />
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Nom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="nom" id="nom" placeholder="Nom"  required/>
       <span id="alerte_nom" style="color:red;display:none">Caractère interdit utilisé</span>
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
<input type="submit" value="Je m'inscris !" id="inscription" style="color:rgb(1,1,100);border:rgb(1,1,100);border-radius:3px"/>
</form>
                
   </div>
        <a href="index.php?page=accueil" style="color:rgb(200,200,250)">Retour au menu de connexion</a>

            </div>
        </div>
CHAINE_DE_FIN;
}

function generate_formulaire_inscriptionfail() {
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
       <span id="alerte_prenom" style="color:red;display:none">Caractère interdit utilisé</span>
       
       <br />
       <label for="pseudo" style="color:rgb(200,200,250)">&nbsp;<span style="color:red;font-size:1.3em">*</span>Nom&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="nom" id="nom" placeholder="Nom"  required/>
       <span id="alerte_nom" style="color:red;display:none">Caractère interdit utilisé</span>
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
<input type="submit" value="Je m'inscris !" id="inscription" style="color:rgb(1,1,100);border:rgb(1,1,100);border-radius:3px"/>
</form>
                
   </div>
            <a href="index.php?page=accueil" style="color:rgb(200,200,250)">Retour au menu de connexion</a>

            </div>
        </div>
CHAINE_DE_FIN;
}

