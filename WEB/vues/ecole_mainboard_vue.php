
<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->
<main>
	<body class="ecole-mainboard">

		<p id="titre" class="tdb">Bienvenue sur le tableau de bord de l' <?php echo $nom_ecole ?> </p>

		<p class="tdb">Adresse : <?php echo $adresse_ecole ?></p>

		<div class="tdb">
			<table> <br>
            <thead>
				<p id="sous-titre"> Liste des employés: </p>
                <tr>
                    <th> Nom </th>
                    <th> Prénom </th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($list_employe as $employe) { ?> 
                        <tr>
                            <td> <?php echo $employe['nom']; ?> </td>
                            <td> <?php echo $employe['prenom']; ?> </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
		</div>

		<p class="tdb"> → <?php echo $nb_adherent ?> adhérents sont inscrits cette année.</p>

		<div class="tdb">
			<table> <br>
            <thead>
				<p id="sous-titre"> Liste des cours: </p>
                <tr>
                    <th> Nom </th>
                    <th> Prénom </th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($list_cours as $cours) { ?> 
                        <tr>
                            <td> <?php echo $cours['libelle']; ?> </td>
                            <td> <?php echo $cours['categorieAge']; ?> </td>
                        </tr>
                    <?php } ?>
            </tbody>
        	</table>
	
		</div>

		<p class="tdb"> →
		<?php
		if ($nb_adh_compet == null) {
			echo "0";
		} else {
			echo $nb_adh_compet[0]['nb'];
		}
		
		?>
		adhérents sont inscrits en compétition cette année.</p>

		<div class="tdb"><img class="ACCimg" src="img\logo_ucbl.jpg" alt="logo UCBL"></div>
	</body>
</main>