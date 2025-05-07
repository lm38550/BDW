<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->
<main>
  <body class="ecole-info">
		  <p style="color : red; font-size : 30px;"> <?php echo $warning ?> </p>
          <div class="EI_new">
            <p id="titre"> Modifications des données de l'école : </p>
            <form method="post" action="#">
              <table class="EI_tab">
                <tr>
                  <td class="nom_case"><label for="nom">Nom : *</label></td>
                  <td><input type="text" name="nom" id="nom" size="51" value=<?php echo '"'.$nom_ecole.'"'?> maxlength="20"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="rue">Rue : *</label></td>
                  <td><input type="text" name="rue" id="rue" size="51" value=<?php echo '"'.$rue_ecole.'"'?> maxlength="40"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="voie">Numéro de voie : *</label></td>
                  <td><input type="text" name="voie" id="voie" size="51" value=<?php echo '"'.$voie_ecole.'"'?> maxlength="6"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="compl">Complément : *</label></td>
                  <td><input type="text" name="compl" id="compl" size="51" value=<?php echo '"'.$complement_ecole.'"'?> maxlength="50"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="CP">Code Postal : *</label></td>
                  <td><input type="text" name="CP" id="CP" size="51" value=<?php echo '"'.$CP_ecole.'"'?> maxlength="5"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="ville">Ville : *</label></td>
                  <td><input type="text" name="ville" id="ville" size="51" value=<?php echo '"'.$ville_ecole.'"'?> maxlength="30"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="pays">Pays : *</label></td>
                  <td><input type="text" name="pays" id="pays" size="51" value=<?php echo '"'.$pays_ecole.'"'?> maxlength="20"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="BP">BP : *</label></td>
                  <td><input type="text" name="BP" id="BP" size="51" value=<?php echo '"'.$BP_ecole.'"'?> maxlength="20"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="cedex">Cedex : *</label></td>
                  <td><input type="text" name="cedex" id="cedex" size="51" value=<?php echo '"'.$cedex_ecole.'"'?> maxlength="20"></td>
                </tr>
                <tr>
                  <td class="nom_case"><label for="fondateur">Nom du fondateur : *</label></td>
                  <td><input type="text" name="fondateur" id="fondateur" size="51" value=<?php echo '"'.$ville_ecole.'"'?> maxlength="30"></td>
                </tr>
              </table> <br>
              <p class="warning"> Les champs notés d'une * sont obligatoires </p> <br>
              <input type="submit" name="modif_ecole" value="Valider les modifications" />
            </form>
          </div>
  </body>
</main>
