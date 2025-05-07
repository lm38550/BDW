<?php

// Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

if (isset($_POST['connexion'])) 
{
    $temp = set_ecole_id($_POST['liste']);
    $_SESSION['ecole'] = $temp[0]['IDecole'];
}

$ecole=$_SESSION['ecole'];

$info_ecole = get_info_ecole($ecole);

$nom_ecole = $info_ecole[0]['nom'];

$adresse_ecole = $info_ecole[0]['numVoie']." ".$info_ecole[0]['rue']." ".$info_ecole[0]['CP']." ".$info_ecole[0]['ville'];

$list_employe = get_list_employe($ecole);

$nb_adherent = get_nb_adh($ecole)[0]['nb_adh'];

$list_cours = get_cours($ecole);

$nb_adh_compet = get_nb_comp($ecole);

?>