<?php

    // Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

    $info_fondation = get_info_fondation($_SESSION['ecole']);

    $nom_ecole = $info_fondation[0]['nom'];
    $rue_ecole = $info_fondation[0]['rue'];
    $voie_ecole = $info_fondation[0]['numVoie'];
    $CP_ecole = $info_fondation[0]['CP'];
    $ville_ecole = $info_fondation[0]['ville'];
    $pays_ecole = $info_fondation[0]['pays'];
    $BP_ecole = $info_fondation[0]['BP'];
    $cedex_ecole = $info_fondation[0]['cedex'];
    $complement_ecole = $info_fondation[0]['complement'];
    $nom_fondateur = $info_fondation[0]['fondateur'];
    $warning = "";

    if(isset($_POST['modif_ecole']))
    {
        if ( ( $_POST['nom'] == "") || ( $_POST['rue'] == "") || ( $_POST['voie'] == "") || ( $_POST['compl'] == "") || ( $_POST['CP'] == "") || ( $_POST['ville'] == "") || ( $_POST['pays'] == "") || ( $_POST['BP'] == "") || (  $_POST['cedex'] == "") || (  $_POST['fondateur'] == "") )
        {
            $warning = "Veuillez remplir correctement les champs obligatoires";
        } else {
            modif_ecole($_SESSION['ecole'],$_POST['nom'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'], $_POST['BP'], $_POST['cedex'], $_POST['fondateur']);
            $warning = "";
        }
    }
    
?>