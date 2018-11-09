<div class="pageajout">
    <div class="col-md-10 col-md-offset-1 corpsajout">
        <form method="post" action="index.php?todo=traite&page=fintraitement">
            <div class="titreajout">
                Partage ton experience !
            </div>

            <div class="row">
                <div class='col-md-6 info1ajout'>
                    <div class="formulairesajout">
                        <p>
                            <label for="xperience">Xperience:</label>
                            <select name="xperience" id="xperiencedemandee" required>
                                <option value="stage dfhm">Stage DFHM (1A)</option>                                
                                <option value="stage en entreprise">Stage en entreprise (2A)</option>
                                <option value="stage de recherche">Stage de recherche (3A)</option>
                                <option value="4A">4A</option> 
                            </select></br></br>

                            <?php
                            formulaires_stage();
                            ?>
                        </p>
                    </div>
                </div>

                <div class='col-md-6 info2ajout'>
                    Donne plus d'infos sur...<br>
                    <div class="formulaires2ajout">
                        <?php
                        formulaires_commun();
                        ?>
                    </div>
                </div>

            </div>
            <?php
            formulaires_appreciation();
            ?>

            <input type="submit" value="Envoyer" />

        </form>
    </div>
</div>


