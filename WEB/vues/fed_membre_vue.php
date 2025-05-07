
<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->
<main>
    <body>
	<p style="color : red; font-size : 30px;"> <?php echo $warning ?> </p>
    <div class="EA_list">
        <form class="connect" method="post" action="#">
            <p id="sous-titre"> Membre : </p>
            <select name="liste" id="liste">
            <?php 
            
            foreach($nom_membre as $membre) {
                echo "<option
                value='".$membre['IDmembre']."'>".$membre['nom']." ".$membre['prenom']."
                </option>";
            }
            ?>

            </select>

            <input type="submit" name="liste_membre" value="Modifier"/>
        </form>
    </div>
    
    <div class="EA_new">
        <p id="titre"> Création d'un nouveau membre : </p> <br> <br>
        <form method="post" action="#">
            <table class="EA_tab">
            <tr>
                <td class="nom_case"><label  for="prenom">Prénom : *</label></td>
                <td><input type="text" name="prenom" id="prenom" size="51" maxlength="20"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="nom">Nom : *</label></td>
                <td><input type="text" name="nom" id="nom" size="51" maxlength="20"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="ddn">Date de naissance (Format AAAA-MM-JJ) : *</label></td>
                <td><input type="text" name="ddn" id="ddn" size="51" maxlength="10"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="contactChoice1">Membre d'une fédération : *</label>
                <input type="radio" id="contactChoice1" name="fedcom" value="fed"></td>
                <td><input type="text" name="fed" id="fed" size="51" maxlength="10" value=<?php echo '"'.$nom_fed.'"' ?> readonly="readonly" style="border: none;" /></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="contactChoice2">Membre d'un comité : *</label>
                <input type="radio" id="contactChoice2" name="fedcom" value="com"></td>
                <td><select name="com" id="com" style="width:394px;">
                <?php 
                foreach($nom_com as $com) {
                    echo "<option
                    value='".$com['IDcomité']."'>".$com['nom']."
                    </option>";
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="fonction">Fonction : *</label></td>
                <td><input type="text" name="fonction" id="fonction" size="51" maxlength="40"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="rue">Rue : *</label></td>
                <td><input type="text" name="rue" id="rue" size="51" maxlength="40"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="voie">Numéro de voie : *</label></td>
                <td><input type="text" name="voie" id="voie" size="51" maxlength="6"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="compl">Complément : *</label></td>
                <td><input type="text" name="compl" id="compl" size="51" maxlength="50"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="CP">Code Postal : *</label></td>
                <td><input type="text" name="CP" id="CP" size="51" maxlength="5"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="ville">Ville : *</label></td>
                <td><input type="text" name="ville" id="ville" size="51" maxlength="30"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="pays">Pays : *</label></td>
                <td><input type="text" name="pays" id="pays" size="51" maxlength="20"></td>
            </tr>
            </table> <br>
            <p class="warning"> Les champs notés d'une * sont obligatoires </p> <br>
            <input type="submit" name="boutonExec" value="Valider l'inscription" />
        </form>
    </div>
    
    <div class="EA_visu">
        <p id="titre">Modification d'un membre : </p>
        <form method="post" action="#">
        <input type="text" id="IDmembre" name="IDmembre" value=<?php echo '"'.$IDmembre.'"'?> readonly="readonly" style="border: none;" /> <br>
            <br>
            <table class="EA_tab">
            <tr>
                <td class="nom_case"><label  for="prenom">Prénom : *</label></td>
                <td><input type="text" name="prenom" id="prenom" size="51" value=<?php echo '"'.$prenom.'"'?> maxlength="20"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="nom">Nom : *</label></td>
                <td><input type="text" name="nom" id="nom" size="51" value=<?php echo '"'.$nom.'"'?> maxlength="20"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="ddn">Date de naissance (Format AAAA-MM-JJ) : *</label></td>
                <td><input type="text" name="ddn" id="ddn" size="51" value=<?php echo '"'.$ddn.'"'?> maxlength="10"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="contactChoice1">Membre d'une fédération : *</label>
                <input type="radio" id="contactChoice1" name="fedcom" value="fed" <?php if ($fedcom == "fed") echo "checked";?> ></td>
                <td><input type="text" name="fed" id="fed" size="51" value=<?php echo '"'.$nom_fed.'"' ?> maxlength="10" readonly="readonly" style="border: none;" /></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="contactChoice2">Membre d'un comité : *</label>
                <input type="radio" id="contactChoice2" name="fedcom" value="com" <?php if ($fedcom == "com") echo "checked";?> ></td>
                <td>
                <select name="com" id="com" style="width:394px;">
                <?php 
                foreach($nom_com as $com) {
                    if ($com['IDcomité'] == $IDcom) {$select = " selected";} else {$select = " ";}
                    echo "<option
                    value='".$com['IDcomité']."'".$select.">".$com['nom']."
                    </option>";
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="fonction">Fonction : *</label></td>
                <td><input type="text" name="fonction" id="fonction" value=<?php echo '"'.$fonction.'"' ?> size="51" maxlength="40"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="rue">Rue : *</label></td>
                <td><input type="text" name="rue" id="rue" size="51" value=<?php echo '"'.$rue.'"'?> maxlength="40"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="voie">Numéro de voie : *</label></td>
                <td><input type="text" name="voie" id="voie" size="51" value=<?php echo '"'.$voie.'"'?> maxlength="6"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="compl">Complément : *</label></td>
                <td><input type="text" name="compl" id="compl" size="51" value=<?php echo '"'.$compl.'"'?> maxlength="50"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="CP">Code Postal : *</label></td>
                <td><input type="text" name="CP" id="CP" size="51" value=<?php echo '"'.$CP.'"'?> maxlength="5"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="ville">Ville : *</label></td>
                <td><input type="text" name="ville" id="ville" size="51" value=<?php echo '"'.$ville.'"'?> maxlength="30"></td>
            </tr>
            <tr>
                <td class="nom_case"><label  for="pays">Pays : *</label></td>
                <td><input type="text" name="pays" id="pays" size="51" value=<?php echo '"'.$pays.'"'?> maxlength="20"></td>
            </tr>
            </table> <br>
            <p class="warning"> Les champs notés d'une * sont obligatoires </p> <br>
            <input type="submit" name="modif_membre" value="Valider les modifications" />
        </form>
    </div>
    </body>
</main>