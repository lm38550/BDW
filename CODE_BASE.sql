
-- Developpé par DJAMAKORZIAN Sasha p2101813 et MOREL Louis p2100444
DROP TABLE IF EXISTS membre_de;
DROP TABLE IF EXISTS participe_a;
DROP TABLE IF EXISTS est_géré_par;
DROP TABLE IF EXISTS est_rattaché_a;
DROP TABLE IF EXISTS est_fédéré_par;
DROP TABLE IF EXISTS a_participé;
DROP TABLE IF EXISTS est_inscrit;
DROP TABLE IF EXISTS adhère;
DROP TABLE IF EXISTS est_pratiqué;
DROP TABLE IF EXISTS a_pour_influence;
DROP TABLE IF EXISTS travaille;
DROP TABLE IF EXISTS Edition;
DROP TABLE IF EXISTS Séance;
DROP TABLE IF EXISTS Danse;
DROP TABLE IF EXISTS Zumba;
DROP TABLE IF EXISTS Eveil_à_la_danse;
DROP TABLE IF EXISTS Cours;
DROP TABLE IF EXISTS Vestiaire;
DROP TABLE IF EXISTS Espace_danse;
DROP TABLE IF EXISTS Salle;
DROP TABLE IF EXISTS Ecole_de_Danse;
DROP TABLE IF EXISTS Membre;
DROP TABLE IF EXISTS Groupe;
DROP TABLE IF EXISTS Structure_sportive;
DROP TABLE IF EXISTS Compétition;
DROP TABLE IF EXISTS Comité;
DROP TABLE IF EXISTS Fédération;
DROP TABLE IF EXISTS Certificat;
DROP TABLE IF EXISTS Adhérent;
DROP TABLE IF EXISTS Type_danse;
DROP TABLE IF EXISTS Periode;
DROP TABLE IF EXISTS Employé;
DROP TABLE IF EXISTS Adresse;

CREATE TABLE Adresse(
   IDadresse INT AUTO_INCREMENT,
   numVoie INT,
   rue VARCHAR(50),
   complement VARCHAR(50),
   BP VARCHAR(50),
   cedex INT,
   CP VARCHAR(50),
   ville VARCHAR(50),
   pays VARCHAR(50),
   PRIMARY KEY(IDadresse)
);

CREATE TABLE Employé(
   IDemploye INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(IDemploye)
);

CREATE TABLE Periode(
   annee INT,
   PRIMARY KEY(annee)
);

CREATE TABLE Type_danse(
   nom VARCHAR(50),
   origine VARCHAR(50),
   PRIMARY KEY(nom)
);

CREATE TABLE Adhérent(
   numLicence INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   dateDeNaissance DATE,
   IDadresse INT NOT NULL,
   PRIMARY KEY(numLicence),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse)
);

CREATE TABLE Certificat(
   IDcertif INT AUTO_INCREMENT,
   annee INT NOT NULL,
   numLicence INT NOT NULL,
   PRIMARY KEY(IDcertif),
   FOREIGN KEY(annee) REFERENCES Periode(annee),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence)
);

CREATE TABLE Fédération(
   IDfede INT AUTO_INCREMENT,
   nom VARCHAR(50),
   sigle VARCHAR(50),
   president VARCHAR(50),
   IDadresse INT NOT NULL,
   PRIMARY KEY(IDfede),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse)
);

CREATE TABLE Comité(
   IDcomité INT AUTO_INCREMENT,
   nom VARCHAR(50),
   code VARCHAR(50),
   niveau VARCHAR(50),
   IDfede INT NOT NULL,
   IDadresse INT NOT NULL,
   PRIMARY KEY(IDcomité),
   FOREIGN KEY(IDfede) REFERENCES Fédération(IDfede),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse)
);

CREATE TABLE Compétition(
   codeComp VARCHAR(50),
   libelle VARCHAR(50),
   niveau VARCHAR(50),
   IDfede INT NOT NULL,
   PRIMARY KEY(codeComp),
   FOREIGN KEY(IDfede) REFERENCES Fédération(IDfede)
);

CREATE TABLE Structure_sportive(
   IDstructure INT AUTO_INCREMENT,
   nom VARCHAR(50),
   type VARCHAR(50),
   IDadresse INT NOT NULL,
   PRIMARY KEY(IDstructure),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse)
);

CREATE TABLE Groupe(
   IDequipe INT AUTO_INCREMENT,
   genre VARCHAR(50),
   nom VARCHAR(50),
   numLicence INT NOT NULL,
   numLicence_1 INT NOT NULL,
   PRIMARY KEY(IDequipe),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence),
   FOREIGN KEY(numLicence_1) REFERENCES Adhérent(numLicence)
);

CREATE TABLE Membre(
   IDmembre INT NOT NULL AUTO_INCREMENT,
   IDfede INT DEFAULT NULL,
   IDcomité INT DEFAULT NULL,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   dateDeNaissance DATE,
   fonction VARCHAR(50),
   IDadresse INT NOT NULL,
   PRIMARY KEY(IDmembre),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse),
   FOREIGN KEY(IDfede) REFERENCES Fédération(IDfede),
   FOREIGN KEY(IDcomité) REFERENCES Comité(IDcomité)   
);

CREATE TABLE Ecole_de_Danse(
   IDecole INT AUTO_INCREMENT,
   nom VARCHAR(50),
   fondateur VARCHAR(50),
   IDadresse INT NOT NULL,
   PRIMARY KEY(IDecole),
   FOREIGN KEY(IDadresse) REFERENCES Adresse(IDadresse)
);

CREATE TABLE Salle(
   IDecole INT,
   IDsalle INT,
   nom VARCHAR(50),
   superficie DECIMAL(15,2),
   PRIMARY KEY(IDecole, IDsalle),
   FOREIGN KEY(IDecole) REFERENCES Ecole_de_Danse(IDecole)
);

CREATE TABLE Espace_danse(
   IDecole INT,
   IDsalle INT,
   typeAeration VARCHAR(50),
   typeChauffage VARCHAR(50),
   PRIMARY KEY(IDecole, IDsalle),
   FOREIGN KEY(IDecole, IDsalle) REFERENCES Salle(IDecole, IDsalle)
);

CREATE TABLE Vestiaire(
   IDecole INT,
   IDsalle INT,
   mixte VARCHAR(50),
   avec_douches VARCHAR(50),
   PRIMARY KEY(IDecole, IDsalle),
   FOREIGN KEY(IDecole, IDsalle) REFERENCES Salle(IDecole, IDsalle)
);

CREATE TABLE Cours(
   IDcours INT AUTO_INCREMENT,
   codeCours INT,
   libelle VARCHAR(50),
   categorieAge VARCHAR(50),
   IDecole INT NOT NULL,
   IDemploye INT NOT NULL,
   annee INT NOT NULL,
   PRIMARY KEY(IDcours),
   FOREIGN KEY(IDecole) REFERENCES Ecole_de_Danse(IDecole),
   FOREIGN KEY(IDemploye) REFERENCES Employé(IDemploye),
   FOREIGN KEY(annee) REFERENCES Periode(annee)
);

CREATE TABLE Eveil_à_la_danse(
   IDcours INT,
   PRIMARY KEY(IDcours),
   FOREIGN KEY(IDcours) REFERENCES Cours(IDcours)
);

CREATE TABLE Zumba(
   IDcours INT,
   ambiance VARCHAR(50),
   PRIMARY KEY(IDcours),
   FOREIGN KEY(IDcours) REFERENCES Cours(IDcours)
);

CREATE TABLE Danse(
   IDcours INT,
   categorie VARCHAR(50),
   type VARCHAR(50),
   PRIMARY KEY(IDcours),
   FOREIGN KEY(IDcours) REFERENCES Cours(IDcours)
);

CREATE TABLE Séance(
   IDcours INT,
   numSeance INT,
   jour VARCHAR(50),
   creneau VARCHAR(50),
   PRIMARY KEY(IDcours, numSeance),
   FOREIGN KEY(IDcours) REFERENCES Cours(IDcours)
);

CREATE TABLE Edition(
   codeComp VARCHAR(50),
   année INT,
   ville VARCHAR(50),
   IDstructure INT DEFAULT NULL,
   PRIMARY KEY(codeComp, année),
   FOREIGN KEY(codeComp) REFERENCES Compétition(codeComp),
   FOREIGN KEY(IDstructure) REFERENCES Structure_sportive(IDstructure)
);

CREATE TABLE travaille(
   IDecole INT,
   annee INT,
   IDemploye INT,
   fonction VARCHAR(50),
   PRIMARY KEY(IDecole, annee, IDemploye),
   FOREIGN KEY(IDecole) REFERENCES Ecole_de_Danse(IDecole),
   FOREIGN KEY(annee) REFERENCES Periode(annee),
   FOREIGN KEY(IDemploye) REFERENCES Employé(IDemploye)
);

CREATE TABLE a_pour_influence(
   nom VARCHAR(50),
   nom_1 VARCHAR(50),
   PRIMARY KEY(nom, nom_1),
   FOREIGN KEY(nom) REFERENCES Type_danse(nom),
   FOREIGN KEY(nom_1) REFERENCES Type_danse(nom)
);

CREATE TABLE est_pratiqué(
   IDcours INT,
   nom VARCHAR(50),
   PRIMARY KEY(IDcours, nom),
   FOREIGN KEY(IDcours) REFERENCES Danse(IDcours),
   FOREIGN KEY(nom) REFERENCES Type_danse(nom)
);

CREATE TABLE adhère(
   IDecole INT,
   numLicence INT,
   PRIMARY KEY(IDecole, numLicence),
   FOREIGN KEY(IDecole) REFERENCES Ecole_de_Danse(IDecole),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence)
);

CREATE TABLE est_inscrit(
   IDcours INT,
   numLicence INT,
   PRIMARY KEY(IDcours, numLicence),
   FOREIGN KEY(IDcours) REFERENCES Cours(IDcours),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence)
);

CREATE TABLE a_participé(
   numLicence INT,
   IDcours INT,
   numSeance INT,
   PRIMARY KEY(numLicence, IDcours, numSeance),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence),
   FOREIGN KEY(IDcours, numSeance) REFERENCES Séance(IDcours, numSeance)
);

CREATE TABLE est_fédéré_par(
   IDecole INT,
   IDfede INT,
   PRIMARY KEY(IDecole, IDfede),
   FOREIGN KEY(IDecole) REFERENCES Ecole_de_Danse(IDecole),
   FOREIGN KEY(IDfede) REFERENCES Fédération(IDfede)
);

CREATE TABLE est_rattaché_a(
   IDcomité INT,
   IDcomité_1 INT,
   PRIMARY KEY(IDcomité, IDcomité_1),
   FOREIGN KEY(IDcomité) REFERENCES Comité(IDcomité),
   FOREIGN KEY(IDcomité_1) REFERENCES Comité(IDcomité)
);

CREATE TABLE est_géré_par(
   IDcomité INT,
   codeComp VARCHAR(50),
   PRIMARY KEY(IDcomité, codeComp),
   FOREIGN KEY(IDcomité) REFERENCES Comité(IDcomité),
   FOREIGN KEY(codeComp) REFERENCES Compétition(codeComp)
);

CREATE TABLE participe_a(
   codeComp VARCHAR(50),
   année INT,
   IDequipe INT,
   numPassage INT,
   rang INT,
   PRIMARY KEY(codeComp, année, IDequipe),
   FOREIGN KEY(codeComp, année) REFERENCES Edition(codeComp, année),
   FOREIGN KEY(IDequipe) REFERENCES Groupe(IDequipe)
);

-- INSTANCE 1

INSERT INTO Adresse(CP, numVoie, rue, ville)
	SELECT DISTINCT adr_comite_dept_cp, adr_comite_dept_numVoie, adr_comite_dept_rue, adr_comite_dept_ville
    	FROM donnees_fournies.instances1
      WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM Adresse);

INSERT INTO Adresse(CP, numVoie, rue, ville)
	SELECT DISTINCT adr_comite_reg_cp, adr_comite_reg_numVoie, adr_comite_reg_rue, adr_comite_reg_ville
    	FROM donnees_fournies.instances1
      WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM Adresse);

INSERT INTO Adresse(CP, numVoie, rue, ville)
	SELECT DISTINCT adr_fede_cp, adr_fede_numVoie, adr_fede_rue, adr_fede_ville
    	FROM donnees_fournies.instances1
      WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM Adresse);

INSERT INTO Fédération(nom, president, sigle, IDadresse)
	SELECT DISTINCT D.fede_nom, D.fede_dirigeant, D.fede_sigle, A.IDadresse
    	FROM donnees_fournies.instances1 D, p2101813.Adresse A
        WHERE A.rue = D.adr_fede_rue
        AND A.CP = D.adr_fede_cp
        AND A.ville = D.adr_fede_ville
        AND A.numVoie = D.adr_fede_numVoie;

INSERT INTO Comité(code, niveau, IDfede, IDadresse, nom)
	SELECT DISTINCT D.comite_reg_code_dept, D.comite_dept_niveau, F.IDfede, A.IDadresse, D.comite_dept_nom
    	FROM donnees_fournies.instances1 D, p2101813.Adresse A, p2101813.Fédération F
        WHERE A.rue = D.adr_comite_dept_rue
        AND A.CP = D.adr_comite_dept_cp
        AND A.ville = D.adr_comite_dept_ville
        AND A.numVoie = D.adr_comite_dept_numVoie
        AND F.nom = D.fede_nom
        AND D.comite_reg_code_dept IS NOT NULL;

INSERT INTO Comité(code, niveau, IDfede, IDadresse, nom)
	SELECT DISTINCT D.comite_reg_code_reg, D.comite_reg_niveau, F.IDfede, A.IDadresse, D.comite_reg_nom
    	FROM donnees_fournies.instances1 D, p2101813.Adresse A, p2101813.Fédération F
        WHERE A.rue = D.adr_comite_reg_rue
        AND A.CP = D.adr_comite_reg_cp
        AND A.ville = D.adr_comite_reg_ville
        AND A.numVoie = D.adr_comite_reg_numVoie
        AND F.nom = D.fede_nom
        AND D.comite_reg_code_reg IS NOT NULL;

INSERT INTO est_rattaché_a(IDcomité, IDcomité_1)
	SELECT DISTINCT C.IDcomité, C2.IDcomité
    	FROM donnees_fournies.instances1 D, p2101813.Comité C, p2101813.Comité C2
        WHERE comite_reg_code_dept = C.code
        AND comite_reg_code_reg = C2.code
        AND C.niveau LIKE 'dept'
        AND C2.niveau LIKE 'reg';

-- INSTANCE 2

INSERT INTO Compétition(codeComp, libelle, niveau, IDfede)
	SELECT DISTINCT D.compet_code, D.compet_libellé, D.compet_niveau, F.IDfede
    	FROM donnees_fournies.instances2 D, p2101813.Fédération F
      WHERE F.nom = D.fede_nom;

INSERT INTO Edition(codeComp, année, ville, IDstructure)
	SELECT DISTINCT D.compet_code, D.edition_année, D.edition_ville_orga, NULL
    	FROM donnees_fournies.instances2 D;

-- INSTANCE 3
INSERT INTO Adresse(CP, numVoie, rue, ville)
	SELECT  DISTINCT adr_ecole_cp, adr_ecole_numVoie, adr_ecole_rue, adr_ecole_ville
    	FROM donnees_fournies.instances3
      WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM Adresse);

INSERT INTO Ecole_de_Danse(fondateur, IDadresse, nom)
	SELECT DISTINCT D.ecole_fondateur, A.IDadresse, D.ecole_nom
    	FROM donnees_fournies.instances3 D, p2101813.Adresse A
        WHERE A.rue = D.adr_ecole_rue
        AND A.CP = D.adr_ecole_cp
        AND A.ville = D.adr_ecole_ville
        AND A.numVoie = D.adr_ecole_numVoie;

INSERT INTO est_fédéré_par(IDecole,IDfede)
	SELECT DISTINCT E.IDecole, F.IDfede 
      FROM donnees_fournies.instances3 D, p2101813.Ecole_de_Danse E, p2101813.Fédération F
      WHERE F.nom = D.fede_nom
      AND E.nom = D.ecole_nom
      AND E.fondateur = D.ecole_fondateur;

INSERT INTO Employé(nom, prenom)
	SELECT DISTINCT cours_resp_nom, cours_resp_prénom
        FROM donnees_fournies.instances3;

INSERT INTO Periode(annee)
   SELECT 2022;

INSERT INTO travaille(IDecole, annee, IDemploye)
	SELECT DISTINCT ED.IDecole, 2022, EM.IDemploye
    	FROM donnees_fournies.instances3 D, p2101813.Ecole_de_Danse ED, p2101813.Employé EM
        WHERE D.cours_resp_nom = EM.nom
        AND D.cours_resp_prénom = EM.prenom
        AND D.ecole_nom = ED.nom
        AND D.ecole_fondateur = ED.fondateur;

INSERT INTO Cours(codeCours, libelle, categorieAge, IDecole, IDemploye, annee)
	SELECT DISTINCT D.cours_code, D.cours_libellé, D.cours_categorie_age, ED.IDecole, EM.IDemploye, 2022
    	FROM donnees_fournies.instances3 D, p2101813.Ecole_de_Danse ED, p2101813.Employé EM
        WHERE D.cours_resp_nom = EM.nom
        AND D.cours_resp_prénom = EM.prenom
        AND D.ecole_nom = ED.nom
        AND D.ecole_fondateur = ED.fondateur;

-- INSTANCE 4

INSERT INTO Adresse(CP, numVoie, rue, ville)
	SELECT  DISTINCT adr_danseur_cp, adr_danseur_numVoie, adr_danseur_rue, adr_danseur_ville
    	FROM donnees_fournies.instances4
      WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM Adresse);

INSERT INTO Adresse(CP, numVoie, rue, ville)
   SELECT  DISTINCT adr_danseur_cp, adr_danseur_numVoie, adr_danseur_rue, adr_danseur_ville
      FROM donnees_fournies.instances4
         WHERE NOT EXISTS (SELECT CP, numVoie, rue, ville FROM p2101813.Adresse
                        WHERE adr_danseur_cp = CP
                        AND adr_danseur_numVoie = numVoie
                        AND adr_danseur_rue = rue
                        AND adr_danseur_ville = ville );

INSERT INTO Adhérent(numLicence, nom, prenom, dateDeNaissance, IDadresse)
	SELECT DISTINCT D.danseur_numLicence, D.danseur_nom, D.danseur_prenom, D.danseur_date_naissance, A.IDadresse
    	FROM donnees_fournies.instances4 D, p2101813.Adresse A
            WHERE adr_danseur_cp = CP
            AND adr_danseur_numVoie = numVoie
            AND adr_danseur_rue = rue
            AND adr_danseur_ville = ville;

INSERT INTO adhère(IDecole, numLicence)
	SELECT DISTINCT E.IDecole, AD.numLicence
    	FROM donnees_fournies.instances4 D, p2101813.Adresse A1, p2101813.Adresse A2, p2101813.Ecole_de_Danse E, p2101813.Adhérent AD
            WHERE AD.nom = D.danseur_nom
            AND AD.prenom = D.danseur_prenom 
            AND E.nom = D.ecole_nom 
            AND A1.ville = D.adr_ecole_ville 
            AND A1.Idadresse = E.Idadresse
            AND A2.ville = D.adr_danseur_ville
            AND A2.rue = D.adr_danseur_rue
            AND A2.numVoie = D.adr_danseur_numVoie
            AND A2.IDadresse = AD.IDadresse;

INSERT INTO Groupe(numLicence, numLicence_1)
	SELECT DISTINCT D.danseur_numLicence1, D.danseur_numLicence2
    	FROM donnees_fournies.instances2 D;

INSERT INTO Type_danse(nom)
	SELECT DISTINCT D.type_danse
    	FROM donnees_fournies.type_danse D;


INSERT INTO participe_a(année, codeComp,IDequipe,rang)
	SELECT DISTINCT I.edition_année, I.compet_code, E.IDequipe, I.rang_final FROM donnees_fournies.instances2 I, Groupe E
    WHERE E.numLicence = I.danseur_numLicence1 AND E.numLicence_1 = I.danseur_numLicence2