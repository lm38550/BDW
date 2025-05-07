<?php

// Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444


if (isset($_POST['connexion'])) 
{
    $_SESSION['fed'] = $_POST['liste'];
}

$fed=$_SESSION['fed'];

$info_fed = get_info_fed($fed);

$nom_fed = $info_fed[0]['nom'];

$sigle_fed = $info_fed[0]['sigle'];

$president_fed = $info_fed[0]['president'];

$adresse_fed = $info_fed[0]['numVoie']." ".$info_fed[0]['rue']." ".$info_fed[0]['CP']." ".$info_fed[0]['ville'];

$nb_comite = get_nb_comite($fed)[0]['nb'];

$nb_membre = get_nb_membre($fed)[0]['nb'];

$compet_list = get_liste_compet($fed);

$nb_adh_compet = get_nb_adh_compet($fed)[0]['nb'];

$nb_inscrit = get_nb_inscrit($fed)[0]['nb'];

?>