<main>
    
<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->

    <body>
	<p style="color : red; font-size : 30px;"> <?php echo $warning ?> </p>
    <div class="EA_list">
        <form class="connect" method="post" action="#">
            <p id="sous-titre"> Adhérent : </p>
            <select name="liste" id="liste">
            <?php 
            
            foreach($nom_adh as $adh) {
                echo "<option
                value='".$adh['numLicence']."'>".$adh['nom']." ".$adh['prenom']."
                </option>";
            }
            ?>

            </select>

            <input type="submit" name="liste_adh" value="Modifier"/>
        </form>
    </div>

    <div class="EA_new">
    <p id="titre"> Création d'un nouvel adhérent : </p> <br> <br>
    <form method="post" action="#">
        <table class="EA_tab">
        <tr>
            <td class="nom_case"><label for="prenom">Prénom : *</label></td>
            <td><input type="text" name="prenom" id="prenom" size="51" maxlength="20"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="nom">Nom : *</label></td>
            <td><input type="text" name="nom" id="nom" size="51" maxlength="20"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="ddn" size="30">Date de naissance (Format AAAA-MM-JJ) : *</label></td>
            <td><input type="text" name="ddn" id="ddn" size="51" maxlength="10"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="rue">Rue : *</label></td>
            <td><input type="text" name="rue" id="rue" size="51" maxlength="40"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="voie">Numéro de voie : *</label></td>
            <td><input type="text" name="voie" id="voie" size="51" maxlength="6"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="compl">Complément : *</label></td>
            <td><input type="text" name="compl" id="compl" size="51" maxlength="50"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="CP">Code Postal : *</label></td>
            <td><input type="text" name="CP" id="CP" size="51" maxlength="5"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="ville">Ville : *</label></td>
            <td><input type="text" name="ville" id="ville" size="51" maxlength="30"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="pays">Pays : *</label></td>
            <td><input type="text" name="pays" id="pays" size="51" maxlength="20"></td>
        </tr>
        </table> <br>
        <p class="warning"> Les champs notés d'une * sont obligatoires </p> <br>
        <input type="submit" name="boutonExec" value="Valider l'inscription" />
    </form>
    </div>

    <div class="EA_visu">
    <p id="titre"> Modification d'un adhérent :</p>
    <form method="post" action="#">
    <p><input type="text" id="numAdh" name="numAdh" value=<?php echo '"'.$numAdh.'"'?> readonly="readonly" style="border: none;" /></p>
        <table class="EA_tab">
        <tr>
            <td class="nom_case"><label for="prenom">Prénom : *</label></td>
            <td><input type="text" name="prenom" id="prenom" size="51" value=<?php echo '"'.$prenom.'"'?> maxlength="20"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="nom">Nom : *</label></td>
            <td><input type="text" name="nom" id="nom" size="51" value=<?php echo '"'.$nom.'"'?> maxlength="20"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="ddn" size="30">Date de naissance (Format AAAA-MM-JJ) : *</label></td>
            <td><input type="text" name="ddn" id="ddn" size="51" value=<?php echo '"'.$ddn.'"'?> maxlength="10"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="rue">Rue : *</label></td>
            <td><input type="text" name="rue" id="rue" size="51" value=<?php echo '"'.$rue.'"'?> maxlength="40"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="voie">Numéro de voie : *</label></td>
            <td><input type="text" name="voie" id="voie" size="51" value=<?php echo '"'.$voie.'"'?> maxlength="6"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="compl">Complément : *</label></td>
            <td><input type="text" name="compl" id="compl" size="51" value=<?php echo '"'.$compl.'"'?> maxlength="50"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="CP">Code Postal : *</label></td>
            <td><input type="text" name="CP" id="CP" size="51" value=<?php echo '"'.$CP.'"'?> maxlength="5"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="ville">Ville : *</label></td>
            <td><input type="text" name="ville" id="ville" size="51" value=<?php echo '"'.$ville.'"'?> maxlength="30"></td>
        </tr>
        <tr>
            <td class="nom_case"><label for="pays">Pays : *</label></td>
            <td><input type="text" name="pays" id="pays" size="51" value=<?php echo '"'.$pays.'"'?> maxlength="20"></td>
        </tr>
        </table> <br>
        <p class="warning"> Les champs notés d'une * sont obligatoires </p> <br>
        <input type="submit" name="modif_adh" value="Valider les modifications" />
    </form>
    </div>
    </body>
</main>