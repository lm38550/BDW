
<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->
<main>
	<p id="titre"> Page de connexion à votre fédération / école de Danse : </p>
    <form class="connect" method="post" action="ecole_mainboard.php">
        Connexion à votre école de danse :
        <select name="liste" id="liste">
        <?php 
        
        foreach($resultat_ecole as $ligne) {
            echo "<option
            value='".$ligne['IDemploye']."'>".$ligne['nom']." ".$ligne['prenom']."
            </option>";
        }
        ?>

        </select>

        <input type="submit" name="connexion" value="Connexion"/>
    </form>
        <br>
    <form class="connect" method="post" action="fed_mainboard.php">
        Connexion à votre fédération : 
        <select name="liste" id="liste">
        <?php 
        
        foreach($resultat_fed as $ligne) {
            echo "<option
            value='".$ligne['IDfede']."'>".$ligne['nom']."
            </option>";
        }
        ?>

        </select>

        <input type="submit" name="connexion" value="Connexion"/>
    </form>

    <div class="index" id="tab1">
        <table> <br>
            <tr>
                <th>Statistique</th>
                <th>Nombre</th>
            </tr>
            <tr>
                <td>Nombre de fédération :</td>
                <td><?php echo $nb_fed ?></td>
            </tr>
            <tr>
                <td>Nombre de comité départemental :</td>
                <td><?php echo $nb_comD ?></td>
            </tr>
            <tr>
                <td>Nombre de comité régional :</td>
                <td><?php echo $nb_comR ?></td>
            </tr>
        </table>
    </div>
    <div class="index" id="tab2">
        <table> <br>
            <thead>
                <tr>
                    <th> Departement </th>
                    <th> Nombre </th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($nb_com_par_dept as $dept) { ?> 
                        <tr>
                            <td> <?php echo $dept['code']; ?> </td>
                            <td> <?php echo $dept['nb']; ?> </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="index" id="tab3">
        <table> <br>
            <thead>
                <tr>
                    <th>Nom des comités régionaux : </th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($nom_comR as $comR) { ?> 
                        <tr>
                            <td> <?php echo $comR['nom'] ?> </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="index" id="tab4">
        <table> <br>
            <thead>
                <tr>
                    <th> Nom des écoles avec le plus d'adhérents : </th>
                    <th> Nom d'adhérents : </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($nb_adh_par_ecole as $adh_ecole) { ?> 
                    <tr>
                        <td> <?php echo $adh_ecole['nom']; ?> </td>
                        <td> <?php echo $adh_ecole['nb']; ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> <br>
</main>
