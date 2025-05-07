<?php

    // Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

    $numAdh = NULL;
    $prenom = " ";
    $nom = " ";
    $ddn = " ";
    $rue = " ";
    $voie = " ";
    $compl = " ";
    $CP = " ";
    $ville = " ";
    $pays = " ";
    $warning = "";

    $ecole = $_SESSION['ecole'];

    $nom_adh = get_nom_adh($ecole);

    if(isset($_POST['liste_adh']))
    {
        $numAdh = $_POST['liste'];
        $adh = get_adh($numAdh);
        $prenom = $adh[0]['prenom'];
        $nom = $adh[0]['nom'];
        $ddn = $adh[0]['dateDeNaissance'];
        $rue = $adh[0]['rue'];
        $voie = $adh[0]['numVoie'];
        $compl = $adh[0]['complement'];
        $CP = $adh[0]['CP'];
        $ville = $adh[0]['ville'];
        $pays = $adh[0]['pays'];
    }

    if(isset($_POST['boutonExec']))
    {
        if ( ($_POST['prenom'] == "") || ( $_POST['nom'] == "") || ( $_POST['ddn'] == "") || ( $_POST['rue'] == "") || ( $_POST['voie'] == "") || ( $_POST['compl'] == "") || ( $_POST['CP'] == "") || ( $_POST['ville'] == "") || ( $_POST['pays'] == "") )
        {
            $warning = "Veuillez remplir correctement les champs obligatoires";
        } else {
            new_adh($_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'],$ecole);
            get_nom_adh($ecole);
            echo "<meta http-equiv='refresh' content='0'>";
            $warning = "";
        }
    }

    if(isset($_POST['modif_adh']))
    {
        if ( ($_POST['prenom'] == "") || ( $_POST['nom'] == "") || ( $_POST['ddn'] == "") || ( $_POST['rue'] == "") || ( $_POST['voie'] == "") || ( $_POST['compl'] == "") || ( $_POST['CP'] == "") || ( $_POST['ville'] == "") || ( $_POST['pays'] == "") )
        {
            $warning = "Veuillez remplir correctement les champs obligatoires";
        } else {
            modif_adh($_POST['numAdh'],$_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays']);
            echo "<meta http-equiv='refresh' content='0'>";
            $warning = "";
        }
    }
?>
