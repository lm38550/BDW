<?php 

// Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444

/*
Structure de données permettant de manipuler une base de données :
- Gestion de la connexion
----> Connexion et déconnexion à la base
- Accès au dictionnaire
----> Liste des tables et statistiques
- Informations (structure et contenu) d'une table
----> Schéma et instances d'une table
- Traitement de requêtes
----> Schéma et instances résultant d'une requête de sélection
*/



////////////////////////////////////////////////////////////////////////
///////    Gestion de la connxeion   ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

/**
 * Initialise la connexion à la base de données courante (spécifiée selon constante 
	globale SERVEUR, UTILISATEUR, MOTDEPASSE, BDD)			
 */
function open_connection_DB() {
	global $connexion;

	$connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
}

/**
 *  	Ferme la connexion courante
 * */
function close_connection_DB() {
	global $connexion;

	mysqli_close($connexion);
}


////////////////////////////////////////////////////////////////////////
///////            index             ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

/**
 *  Retourne les ID , les nom, et les prénom des employés
 * */
function get_nom_fondateurs()
{
	global $connexion;

	$requete = "SELECT IDemploye, nom, prenom FROM Employé ORDER BY nom, prenom;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nom_federations()
{
	global $connexion;

	$requete = "SELECT IDfede, nom FROM Fédération ORDER BY nom;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

////////////////////////////////////////////////////////////////////////
///////            ecole_mainboard             /////////////////////////
////////////////////////////////////////////////////////////////////////

function set_ecole_ID ( $IDemploye )
{
	global $connexion;

	$requete = "SELECT IDecole FROM travaille WHERE IDemploye = ".$IDemploye.";";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_info_ecole ( $IDecole )
{
	global $connexion;

	$requete = "SELECT E.nom, A.numVoie, A.rue, A.CP, A.ville FROM Ecole_de_Danse E, Adresse A WHERE E.IDadresse = A.IDadresse AND E.IDecole = ".$IDecole.";";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_list_employe ( $IDecole )
{
	global $connexion;

	$requete = "SELECT EM.nom, EM.prenom FROM Ecole_de_Danse E, travaille T, Employé EM WHERE E.IDecole = T.IDecole AND T.IDemploye = EM.IDemploye AND T.IDecole = ".$IDecole." ORDER BY EM.nom ASC;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_adh ( $IDecole )
{
	global $connexion;

	$requete = "SELECT COUNT(A.numLicence) as nb_adh FROM Ecole_de_Danse E, adhère AD, Adhérent A WHERE E.IDecole = AD.IDecole AND AD.numLicence = A.numLicence AND E.IDecole = ".$IDecole." GROUP BY (E.IDecole)";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_cours ( $IDecole )
{
	global $connexion;

	$requete = "SELECT libelle, categorieAge FROM Cours WHERE IDecole = ".$IDecole.";";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_comp( $IDecole )
{
	global $connexion;

	$requete = "SELECT COUNT(A.numLicence) as nb FROM Adhérent A, Ecole_de_Danse E, adhère AD Where E.IDecole = ".$IDecole." AND E.IDecole = AD.IDecole AND AD.numLicence = A.numLicence AND A.numLicence IN
	( SELECT G1.numLicence FROM Groupe G1 UNION SELECT G2.numLicence_1 FROM Groupe G2 ) GROUP BY (E.IDecole);";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

////////////////////////////////////////////////////////////////////////
///////              fed_mainboard             /////////////////////////
////////////////////////////////////////////////////////////////////////

function get_info_fed ( $IDfed )
{
	global $connexion;

	$requete = "SELECT F.nom, F.sigle, F.president, A.numVoie, A.rue, A.CP, A.ville FROM Fédération F, Adresse A WHERE F.IDadresse = A.IDadresse AND F.IDfede = ".$IDfed." ORDER BY F.nom ASC;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_comite( $fed )
{
	global $connexion;

	$requete = "SELECT COUNT(IDcomité) as nb FROM Comité WHERE IDfede = ".$fed." GROUP BY IDfede;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_membre( $fed )
{
	global $connexion;

	$requete = "SELECT COUNT(AD.numLicence) as nb FROM est_fédéré_par EFP, adhère AD WHERE EFP.IDfede = ".$fed." AND EFP.IDecole = AD.IDecole GROUP BY IDfede;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_liste_compet( $fed )
{
	global $connexion;

	$requete = "SELECT C.libelle, C.niveau FROM Compétition C WHERE C.IDfede = ".$fed.";";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_adh_compet( $fed )
{
	global $connexion;

	$requete = "SELECT COUNT(AD.numLicence) as nb FROM est_fédéré_par EFP, adhère AD WHERE EFP.IDfede = ".$fed." AND EFP.IDecole = AD.IDecole AND AD.numLicence IN
				( SELECT G1.numLicence FROM Groupe G1 UNION SELECT G2.numLicence_1 FROM Groupe G2 ) GROUP BY IDfede;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_inscrit ($fed) 
{
	global $connexion;

	$requete = "SELECT COUNT(*) as nb FROM Membre M WHERE M.IDfede = ".$fed." OR M.IDcomité IN ( SELECT C.IDcomité FROM Comité C WHERE C.IDfede = ".$fed.")";
	$res = mysqli_query($connexion, $requete);
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC); 
	return $instances;
}

////////////////////////////////////////////////////////////////////////
///////             statistiques               /////////////////////////
////////////////////////////////////////////////////////////////////////

function get_nb_fed () {
	global $connexion;

	$requete1 = "SELECT COUNT(F.nom) as nbFed FROM Fédération F GROUP BY F.IDfede";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_comD () {
	global $connexion;

	$requete1 = "SELECT COUNT(C.IDcomité) as nbCD FROM Comité C WHERE C.niveau = 'dept' GROUP BY C.niveau";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_comR () {
	global $connexion;

	$requete1 = "SELECT COUNT(C.IDcomité) as nbCR FROM Comité C WHERE C.niveau = 'reg' GROUP BY C.niveau";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_com_par_dept () {
	global $connexion;

	$requete1 = "
	SELECT A.code, COUNT(ED.IDecole) as nb
	FROM Ecole_de_Danse ED JOIN (
    SELECT CASE LEFT (A.CP,2) WHEN '97'
    	   THEN LEFT (A.CP,3)
    	   ELSE LEFT (A.CP,2) END as code, A.IDadresse
    FROM Adresse A) A
    ON ED.IDadresse = A.IDadresse
	GROUP BY A.code
	";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nom_comR () {
	global $connexion;

	$requete1 = "
	SELECT C.nom
	FROM Comité C JOIN Fédération F ON C.IDfede = F.IDfede
	WHERE C.niveau = 'reg' AND F.nom = 'Fédération Française de Danse'
	ORDER BY C.nom ASC
	";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nb_adh_par_ecole () {
	global $connexion;

	$requete1 = "
	SELECT E.nom, COUNT(A.numLicence) as nb
	FROM adhère A, Ecole_de_Danse E
	WHERE A.IDecole = E.IDecole
	GROUP BY A.IDecole
	ORDER BY `nb`
	DESC LIMIT 5
	";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;

}

////////////////////////////////////////////////////////////////////////
///////                   Page ecole_info                     //////////
////////////////////////////////////////////////////////////////////////

function get_info_fondation ($IDecole)
{
	global $connexion;

	$requete = "SELECT E.fondateur, E.nom, A.numVoie, A.rue, A.CP, A.ville, A.pays, A.BP, A.cedex, A.complement FROM Ecole_de_Danse E, Adresse A WHERE E.IDadresse = A.IDadresse AND E.IDecole = ".$IDecole.";";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function modif_ecole ($ecole, $nom, $rue, $voie, $compl, $CP, $ville, $pays, $BP, $cedex, $fondateur)
{
	global $connexion;

	$requete = "UPDATE Ecole_de_Danse E, Adresse AD SET E.nom = '".$nom."', E.fondateur = '".$fondateur."', AD.numVoie = ".$voie.", AD.rue = '".$rue."', AD.complement = '".$compl."', AD.ville = '".$ville."', AD.CP = ".$CP.", AD.pays = '".$pays."', AD.BP = '".$BP."', AD.cedex = ".$cedex." WHERE E.IDecole = ".$ecole." AND AD.IDadresse = E.IDadresse;"; 
	$res1 = mysqli_query($connexion, $requete);
	echo "<meta http-equiv='refresh' content='0'>";
}


////////////////////////////////////////////////////////////////////////
///////                 Page ecole_adherent                   //////////
////////////////////////////////////////////////////////////////////////

function get_nom_adh ($ecole) {
	global $connexion;

	$requete1 = "SELECT A.numLicence, A.nom, A.prenom FROM Adhérent A, adhère AD WHERE AD.IDecole = ".$ecole." AND A.numLicence = AD.numLicence ORDER BY A.prenom ASC";
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}


function new_adh($prenom, $nom, $ddn, $rue, $voie, $compl, $CP, $ville, $pays, $ecole)
{
	global $connexion;

	$requete1 = "INSERT INTO Adresse(numVoie,rue,complement,CP,ville,pays) VALUES(".$voie.",'".$rue."','".$compl."',".$CP.",'".$ville."','".$pays."');";

	$res1 = mysqli_query($connexion, $requete1);

	close_connection_DB();
	open_connection_DB();

	$requete2 = "
	SELECT IDadresse FROM Adresse
	WHERE numVoie = ".$voie."
	AND rue = '".$rue."'
	AND complement = '".$compl."'
	AND CP = ".$CP."
	AND ville = '".$ville."'
	AND pays = '".$pays."'
	";

	$res2 = mysqli_query($connexion, $requete2);
	$instances = mysqli_fetch_all($res2, MYSQLI_ASSOC);
	$IDadr = $instances[0]['IDadresse'];
	
	close_connection_DB();
	open_connection_DB();

	$requete3 = "INSERT INTO Adhérent(IDadresse,dateDeNaissance,nom,prenom) VALUES(".$IDadr.",'".$ddn."','".$nom."','".$prenom."');";

	$res3 = mysqli_query($connexion, $requete3);
	
	close_connection_DB();
	open_connection_DB();

	$requete4 = "
	SELECT numLicence FROM Adhérent
	WHERE IDadresse = ".$IDadr."
	AND dateDeNaissance = '".$ddn."'
	AND nom = '".$nom."'
	AND prenom = '".$prenom."';
	";
	
	$res4 = mysqli_query($connexion, $requete4);
	$instances = mysqli_fetch_all($res4, MYSQLI_ASSOC);
	$numLI = $instances[0]['numLicence'];

	close_connection_DB();
	open_connection_DB();
	
	$requete5 = "INSERT INTO adhère(IDecole,numLicence) VALUES(".$ecole.",".$numLI.");";

	$res5 = mysqli_query($connexion, $requete5);
}

function get_adh ($num)
{
	global $connexion;

	$requete1 = "SELECT A.nom, A.prenom, A.dateDeNaissance, ADR.numVoie, ADR.rue, ADR.complement, ADR.ville, ADR.CP, ADR.pays FROM Adhérent A, Adresse ADR WHERE A.numLicence = ".$num." AND A.IDadresse = ADR.IDadresse"; 
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function modif_adh ($num, $prenom, $nom, $ddn, $rue, $voie, $compl, $CP, $ville, $pays)
{
	global $connexion;

	$requete1 = "UPDATE Adhérent A, Adresse AD SET A.nom = '".$nom."', A.prenom = '".$prenom."', A.dateDeNaissance = '".$ddn."', AD.numVoie = ".$voie.", AD.rue = '".$rue."', AD.complement = '".$compl."', AD.ville = '".$ville."', AD.CP = ".$CP.", AD.pays = '".$pays."' 
				 WHERE A.numLicence = ".$num." AND AD.IDadresse = A.IDadresse"; 
	$res1 = mysqli_query($connexion, $requete1);
}

////////////////////////////////////////////////////////////////////////
///////                   Page fed_membre                     //////////
////////////////////////////////////////////////////////////////////////

function get_nom_membre ($fed) {
	global $connexion;

	$requete1 = "SELECT M.IDmembre, M.nom, M.prenom FROM Membre M WHERE M.IDfede = ".$fed." OR M.IDcomité IN ( SELECT C.IDcomité FROM Comité C WHERE C.IDfede = ".$fed.") ORDER BY M.nom ASC";
	$res1 = mysqli_query($connexion, $requete1);
	
	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC); return $instances;
}

function get_nom_fed ($fed) {
	global $connexion;

	$requete1 = "SELECT nom FROM Fédération WHERE IDfede = ".$fed.";";
	$res1 = mysqli_query($connexion, $requete1);
	
	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function get_nom_com ($fed) {
	global $connexion;

	$requete1 = "SELECT IDcomité, nom FROM Comité WHERE IDfede = ".$fed." ORDER BY nom ASC;";
	$res1 = mysqli_query($connexion, $requete1);
	
	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}


function new_membre($prenom, $nom, $ddn, $rue, $voie, $compl, $CP, $ville, $pays, $IDfede, $IDcomite, $fonction)
{
	global $connexion;

	$requete1 = "INSERT INTO Adresse(numVoie,rue,complement,CP,ville,pays) VALUES('".$voie."','".$rue."','".$compl."','".$CP."','".$ville."','".$pays."');";

	$res1 = mysqli_query($connexion, $requete1);

	close_connection_DB();
	open_connection_DB();

	$requete2 = "
	SELECT IDadresse FROM Adresse
	WHERE numVoie = '".$voie."'
	AND rue = '".$rue."'
	AND complement = '".$compl."'
	AND CP = '".$CP."'
	AND ville = '".$ville."'
	AND pays = '".$pays."'
	";

	$res2 = mysqli_query($connexion, $requete2);
	$instances = mysqli_fetch_all($res2, MYSQLI_ASSOC);
	$IDadr = $instances[0]['IDadresse'];
	
	close_connection_DB();
	open_connection_DB();

	if ($IDfede == NULL) {$requete3 = "INSERT INTO Membre(IDadresse,dateDeNaissance,nom,prenom,IDfede,IDcomité,fonction) VALUES(".$IDadr.",'".$ddn."','".$nom."','".$prenom."',NULL,'".$IDcomite."','".$fonction."');";}
	if ($IDcomite == NULL) {$requete3 = "INSERT INTO Membre(IDadresse,dateDeNaissance,nom,prenom,IDfede,IDcomité,fonction) VALUES(".$IDadr.",'".$ddn."','".$nom."','".$prenom."','".$IDfede."',NULL,'".$fonction."');";}
	
	$res3 = mysqli_query($connexion, $requete3);
}

function get_membre ($IDmembre)
{
	global $connexion;

	$requete1 = "SELECT M.nom, M.prenom, M.dateDeNaissance, ADR.numVoie, ADR.rue, ADR.complement, ADR.ville, ADR.CP, ADR.pays, M.IDfede, M.IDcomité, M.fonction FROM Membre M, Adresse ADR WHERE M.IDmembre = ".$IDmembre." AND M.IDadresse = ADR.IDadresse"; 
	$res1 = mysqli_query($connexion, $requete1);

	$instances = mysqli_fetch_all($res1, MYSQLI_ASSOC);
	return $instances;
}

function modif_membre ($num, $prenom, $nom, $ddn, $rue, $voie, $compl, $CP, $ville, $pays, $IDfede, $IDcomite, $fonction)
{
	global $connexion;

	if ($IDfede == NULL) {$requete1 = "UPDATE Membre M, Adresse AD SET M.nom = '".$nom."', M.prenom = '".$prenom."', M.dateDeNaissance = '".$ddn."', AD.numVoie = ".$voie.", AD.rue = '".$rue."', AD.complement = '".$compl."', AD.ville = '".$ville."', AD.CP = ".$CP.", AD.pays = '".$pays."', M.IDfede = NULL, M.IDcomité = '".$IDcomite."', M.fonction = '".$fonction."'
				WHERE M.IDmembre = ".$num." AND AD.IDadresse = M.IDadresse"; }
	if ($IDcomite == NULL) {$requete1 = "UPDATE Membre M, Adresse AD SET M.nom = '".$nom."', M.prenom = '".$prenom."', M.dateDeNaissance = '".$ddn."', AD.numVoie = ".$voie.", AD.rue = '".$rue."', AD.complement = '".$compl."', AD.ville = '".$ville."', AD.CP = ".$CP.", AD.pays = '".$pays."', M.IDfede = '".$IDfede."', M.IDcomité = NULL, M.fonction = '".$fonction."'
				WHERE M.IDmembre = ".$num." AND AD.IDadresse = M.IDadresse"; }
	$res1 = mysqli_query($connexion, $requete1);
}


////////////////////////////////////////////////////////////////////////
/////////                        OLD                          //////////
////////////////////////////////////////////////////////////////////////

/**
 * Retourne le résultat (schéma et instances) de la requ$ete $requete
 * */
function executer_une_requete( $requete ) {
	global $connexion;

	if ($requete != "")
	{
		// récupération des informations sur la table (schema + instance)
		$res = mysqli_query($connexion, $requete);  
		if (! is_bool($res))
		{
			// extraction des informations sur le schéma à partir du résultat précédent
			$infos_atts = mysqli_fetch_fields($res); 

			// filtrage des information du schéma pour ne garder que le nom de l'attribut
			$schema = array();
			foreach( $infos_atts as $att ){
				array_push( $schema , array( 'nom' => $att->{'name'} ) ); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
			}

			// récupération des données (instances) de la table
			$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

			// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
			return array('schema'=> $schema , 'instances'=> $instances);
		}
	}
	return null;
}

/**
 *  Retourne la liste des tables définies dans la base de données courantes
 * */
function get_tables() {
	global $connexion;

	$requete = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '". BDD ."'";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function convertir_type( $code ){
	switch( $code ){
		case 1 : return 'BOOL/TINYINT';
		case 2 : return 'SMALLINT';
		case 3 : return 'INTEGER';
		case 4 : return 'FLOAT';
		case 5 : return 'DOUBLE';
		case 7 : return 'TIMESTAMP';
		case 8 : return 'BIGINT/SERIAL';
		case 9 : return 'MEDIUMINT';
		case 10 : return 'DATE';
		case 11 : return 'TIME';
		case 12 : return 'DATETIME';
		case 13 : return 'YEAR';
		case 16 : return 'BIT';
		case 246 : return 'DECIMAL/NUMERIC/FIXED';
		case 252 : return 'BLOB/TEXT';
		case 253 : return 'VARCHAR/VARBINARY';
		case 254 : return 'CHAR/SET/ENUM/BINARY';
		default : return '?';
	}

}

/**
 *  Retourne le détail des infos sur une table
 * */
function get_infos( $typeVue, $nomTable ) {
	global $connexion;

	switch ( $typeVue) {
		case 'schema': return get_infos_schema( $nomTable ); break;
		case 'data': return get_infos_instances( $nomTable ); break;
		default: return null; 
	}
}

/**
 * Retourne le détail sur le schéma de la table
*/
function get_infos_schema( $nomTable ) {
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);

	// construction du schéma qui sera composé du nom de l'attribut et de son type	
	$schema = array( array( 'nom' => 'nom_attribut' ), array( 'nom' => 'type_attribut' ) , array('nom' => 'clé')) ;

	// récupération des valeurs associées au nom et au type des attributs
	$metadonnees = mysqli_fetch_fields($res);

	$infos_att = array();
	foreach( $metadonnees as $att ){
		//var_dump($att);

 		$is_in_pk = ($att->flags & MYSQLI_PRI_KEY_FLAG)?'PK':'';
 		$type = convertir_type($att->{'type'});

		array_push( $infos_att , array( 'nom' => $att->{'name'}, 'type' => $type , 'cle' => $is_in_pk) );	
	}

	return array('schema'=> $schema , 'instances'=> $infos_att);

}

/**
 * Retourne les instances de la table
*/
function get_infos_instances( $nomTable ) {
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";  
 	$res = mysqli_query($connexion, $requete);  

 	// extraction des informations sur le schéma à partir du résultat précédent
	$infos_atts = mysqli_fetch_fields($res); 

	// filtrage des information du schéma pour ne garder que le nom de l'attribut
	$schema = array();
	foreach( $infos_atts as $att ){
		array_push( $schema , array( 'nom' => $att->{'name'} ) ); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
	}

	// récupération des données (instances) de la table
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

	// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
	return array('schema'=> $schema , 'instances'=> $instances);

}



?>
