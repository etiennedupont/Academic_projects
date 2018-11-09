<?php

function printLogin(){
    echo<<<CHAINE_DE_FIN
    <div class="formulaires">
                Entrez vos identifiants frankiz
                <div class="cases" style="margin-left:40px;margin-top:20px;">
                <form method="post" action="index.php?todo=login>
   <p>
       <label for="pseudo">&nbsp;Identifiant&nbsp;&nbsp;&nbsp; </label>
       <input type="text" name="Identifiant" id="Identifiant" placeholder="Identifiant" autofocus required/>
       
       <label for="pass">Mot de passe&nbsp;&nbsp;  </label>
       <input type="password" name="pass" id="pass" placeholder="Mot de passe" required/>
          
       <input type="submit" value="Go !" />
   </p>

</form>
                </div>
CHAINE_DE_FIN;
}

