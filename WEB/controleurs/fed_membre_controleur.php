<?php

// Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

    $IDmembre = NULL;
    $prenom = " ";
    $nom = " ";
    $ddn = " ";
    $fonction = " ";
    $rue = " ";
    $voie = " ";
    $compl = " ";
    $CP = " ";
    $ville = " ";
    $pays = " ";
    $fedcom = NULL;
    $warning = "";

    $fed = $_SESSION['fed'];

    $nom_membre = get_nom_membre($fed);

    $nom_fed = get_nom_fed($fed)[0]['nom'];
    
    $nom_com = get_nom_com($fed);

    if(isset($_POST['liste_membre']))
    {
        $IDmembre = $_POST['liste'];
        $membre = get_membre($IDmembre);
        $prenom = $membre[0]['prenom'];
        $nom = $membre[0]['nom'];
        $ddn = $membre[0]['dateDeNaissance'];
        $voie = $membre[0]['numVoie'];
        $rue = $membre[0]['rue'];
        $compl = $membre[0]['complement'];
        $ville = $membre[0]['ville'];
        $CP = $membre[0]['CP'];
        $pays = $membre[0]['pays'];
        $IDcom = $membre[0]['IDcomité'];
        if ($membre[0]['IDfede'] == NULL) {$fedcom = "com";} else {$fedcom = "fed";}
        $fonction = $membre[0]['fonction'];
    }

    if(isset($_POST['boutonExec']))
    {
        if ( ($_POST['prenom'] == "") || ( $_POST['nom'] == "") || ( $_POST['ddn'] == "") || ( $_POST['rue'] == "") || ( $_POST['voie'] == "") || ( $_POST['compl'] == "") || ( $_POST['CP'] == "") || ( $_POST['ville'] == "") || ( $_POST['pays'] == "") || ( $_POST['com'] == "") || ( $_POST['fonction']  == "") || (!isset($_POST['fedcom'])) || ($_POST['fedcom'] == "") )
        {
            $warning = "Veuillez remplir correctement les champs obligatoires";
        } else {
            if($_POST['fedcom'] == "fed") {new_membre($_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'],$fed,NULL,$_POST['fonction']);}
            if($_POST['fedcom'] == "com") {new_membre($_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'],NULL,$_POST['com'],$_POST['fonction']);}
            $warning = "";
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    if(isset($_POST['modif_membre']))
    {
        if ( ($_POST['prenom'] == "") || ( $_POST['nom'] == "") || ( $_POST['ddn'] == "") || ( $_POST['rue'] == "") || ( $_POST['voie'] == "") || ( $_POST['compl'] == "") || ( $_POST['CP'] == "") || ( $_POST['ville'] == "") || ( $_POST['pays'] == "") || ( $_POST['com'] == "") || ( $_POST['fonction'] == "") || ($_POST['fedcom'] == "") )
        {
            $warning = "Veuillez remplir correctement les champs obligatoires";
        } else {
            if($_POST['fedcom'] == "fed") {modif_membre($_POST['IDmembre'],$_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'],$fed,NULL,$_POST['fonction']);}
            if($_POST['fedcom'] == "com") {modif_membre($_POST['IDmembre'],$_POST['prenom'],$_POST['nom'],$_POST['ddn'],$_POST['rue'],$_POST['voie'],$_POST['compl'],$_POST['CP'],$_POST['ville'],$_POST['pays'],NULL,$_POST['com'],$_POST['fonction']);}
            $warning = ""; 
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

?>
