<?php

// Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

    $resultat_ecole = get_nom_fondateurs();

    $resultat_fed = get_nom_federations();

    $nb_fed = get_nb_fed()[0]['nbFed'];

    $nb_comD = get_nb_comD()[0]['nbCD'];

    $nb_comR = get_nb_comR()[0]['nbCR'];

    $nb_com_par_dept = get_nb_com_par_dept();

    $nom_comR = get_nom_comR();

    $nb_adh_par_ecole = get_nb_adh_par_ecole();

?>