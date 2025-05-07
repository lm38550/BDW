
<!-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444 -->
<main>
	<p id="titre" class="tdb">Bienvenue sur le tableau de bord de la <?php echo $nom_fed."( ".$sigle_fed." )" ?> </p>

	<p id="sous-titre" class="tdb">Adresse : <?php echo $adresse_fed ?></p>
    
	<p id= "sous-titre" class="tdb">Président : <?php echo $president_fed ?></p>

	<div class="EI_new">
		<table class="EI_tab"> <br>
            <thead>
				<p id="sous-titre"> Liste des compétitions </p>
                <tr>
                    <th> Libellé </th>
                    <th> Niveau </th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($compet_list as $compet) { ?> 
                        <tr>
                            <td> <?php echo $compet['libelle']; ?> </td>
                            <td> <?php echo $compet['niveau']; ?> </td>
                        </tr>
                    <?php } ?>
            </tbody>
        	</table>
	</div>

	<p class="tdb"> → <?php echo $nb_comite ?> comités sont rattachés à la fédération.</p>
    
	<p class="tdb"> → <?php echo $nb_membre ?> adhérents sont inscrits dans la fédération.</p>

    <p class="tdb"> → <?php echo $nb_inscrit ?> membres sont inscrits dans la fédération.</p>

	<p class="tdb"> → <?php echo $nb_adh_compet ?> adhérents de la fédération se sont inscrits dans une compétition.</p>

	<div class="tdb"><img class="ACCimg" src="img\logo_ucbl.jpg" alt="logo UCBL"></div>

</main>