-- BD POUR PROJET PACKAGES 1-4
-- CRÉÉE LE 06/09/2017 PAR MARC-ANTOINE DUCHESNE

-- Création de la bd
-- DROP DATABASE IF EXISTS BDProjet_equipe2V2;
-- CREATE DATABASE BDProjet_equipe2V2;

 USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
-- USE bdprojet_equipe2v2;
-- Table Reponsesss
DROP TABLE IF EXISTS tblReponse;
CREATE TABLE tblReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(3000) 	NOT NULL,
	PRIMARY KEY(Id)
);


DROP VIEW IF EXISTS vReponse;
CREATE VIEW vReponse AS SELECT Id,Texte,CONCAT(Texte) AS tag FROM tblReponse;


-- Table tblTypeQuestion

DROP TABLE IF EXISTS tblTypeQuestion;
CREATE TABLE tblTypeQuestion(
	Id						INT				AUTO_INCREMENT,
	Description				VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id)
);


DROP VIEW IF EXISTS vTypeQuestion;
CREATE VIEW vTypeQuestion AS SELECT Id,Description,CONCAT(Description) AS tag FROM tblTypeQuestion;



-- Table tblReponseQuestion

DROP TABLE IF EXISTS tblReponseQuestion;
CREATE TABLE tblReponseQuestion(
	IdReponse				INT				,
	IdQuestion				INT				,
	PRIMARY KEY(IdReponse,IdQuestion)
);


DROP VIEW IF EXISTS vReponseQuestion;
CREATE VIEW vReponseQuestion AS SELECT IdReponse ,IdQuestion,CONCAT(IdReponse ,IdQuestion) AS tag FROM tblReponseQuestion;




-- Table tblQuestion

DROP TABLE IF EXISTS tblQuestion;
CREATE TABLE tblQuestion(
	Id						INT				AUTO_INCREMENT,
	Texte					VARCHAR(250) 	NOT NULL,
	Competence				VARCHAR(50) 	NOT NULL,
	PRIMARY KEY(Id),
	IdTypeQuestion			INT				NOT NULL,
	IdCategorieQuestion		INT				NOT NULL
);


DROP VIEW IF EXISTS vQuestion;
CREATE VIEW vQuestion AS SELECT Id,Texte,Competence ,CONCAT(Texte,Competence) AS tag, IdTypeQuestion,IdCategorieQuestion FROM tblQuestion;




-- Table tblEvaluationQuestionReponse

DROP TABLE IF EXISTS tblEvaluationQuestionReponse;
CREATE TABLE tblEvaluationQuestionReponse(
	IdQuestion				INT				NOT NULL,
	IdReponse				INT				NULL,
	IdEvaluation			INT				NOT NULL,
	PRIMARY KEY(IdQuestion,IdEvaluation)
);


DROP VIEW IF EXISTS vEvaluationQuestionReponse;
CREATE VIEW vEvaluationQuestionReponse AS SELECT IdQuestion,IdReponse,IdEvaluation,
CONCAT(IdQuestion,IdReponse,IdEvaluation) AS tag FROM tblEvaluationQuestionReponse;


-- Table Evaluation

DROP TABLE IF EXISTS tblEvaluation;
CREATE TABLE tblEvaluation(
	Id						INT				AUTO_INCREMENT,
	Statut					CHAR(1)			NOT	NULL,
	DateDébut				DATE			NULL,
	DateFin					DATE			NULL,
	DateComplétée			DATE			NULL,
	PRIMARY KEY(Id),
	IdTypeEvaluation		INT				NOT NULL
);

DROP VIEW IF EXISTS vEvaluation;
CREATE VIEW vEvaluation AS SELECT Id,Statut,DateComplétée,DateDébut,DateFin,
CONCAT(Id,Statut,DateComplétée,DateDébut,DateFin,IdTypeEvaluation,IdTypeEvaluation,Statut,IFNULL(DateComplétée,'')) AS tag,IdTypeEvaluation FROM tblEvaluation;


-- Table tblTypeEvaluation

DROP TABLE IF EXISTS tblTypeEvaluation;
CREATE TABLE tblTypeEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NOT NULL,
	DateLimite				DATE			NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vTypeEvaluation;
CREATE VIEW vTypeEvaluation AS SELECT Id,Titre,DateLimite,CONCAT(Titre,DateLimite) AS tag FROM tblTypeEvaluation;

-- Table SuperviseurEvaluationStagiaireStage

DROP TABLE IF EXISTS tblEvaluationStage;
CREATE TABLE tblEvaluationStage(
	IdEvaluation			INT				NOT NULL,
	IdStage					INT				NOT NULL,
	PRIMARY KEY(IdEvaluation,IdStage)
);
DROP VIEW IF EXISTS vEvaluationStage;
CREATE VIEW vEvaluationStage AS SELECT IdEvaluation,IdStage,
CONCAT(IdEvaluation,IdStage) AS tag FROM tblEvaluationStage;

-- Table stagiaire

DROP TABLE IF EXISTS tblStagiaire;
CREATE TABLE tblStagiaire(
	Id			 			INT				AUTO_INCREMENT,
	CourrielScolaire 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	NumTel		 			CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	NumTelEntreprise 		CHAR(14)		NULL,
	Poste 					VARCHAR(7)		NULL,
	CourrielEntreprise	 	VARCHAR(320)	NULL,
	CodePermanent			VARCHAR(12)		NULL,
	PRIMARY KEY(Id),
	IdStage					INT				NULL,
	IdUtilisateur			INT				NULL,
	CONSTRAINT Constraint_UNIQUE_Stagiaire UNIQUE (CourrielScolaire)
);

DROP VIEW IF EXISTS vStagiaire;
CREATE VIEW vStagiaire AS SELECT Id,CourrielScolaire,Nom,Prenom,NumTel,CourrielPersonnel
,NumTelEntreprise,Poste,CourrielEntreprise,CodePermanent,
CONCAT(CourrielScolaire,Nom,Prenom,NumTel,CourrielPersonnel
,IFNULL(NumTelEntreprise,''),IFNULL(Poste,''),IFNULL(CourrielEntreprise,''),IFNULL(IdStage,''),IdUtilisateur,CodePermanent) AS tag,IdStage,IdUtilisateur FROM tblStagiaire;

-- Table tblUtilisateur

DROP TABLE IF EXISTS tblUtilisateur;
CREATE TABLE tblUtilisateur(
	Id			 			INT				AUTO_INCREMENT,
	Courriel		 		VARCHAR(320)	NOT NULL,
	MotDePasse				VARCHAR(250)		NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vUtilisateur;
CREATE VIEW vUtilisateur AS SELECT Id,LOWER(Courriel) AS Courriel,MotDePasse,CONCAT(LOWER(Courriel),MotDePasse) AS tag FROM tblUtilisateur;


-- Table tblUtilisateurRole

DROP TABLE IF EXISTS tblUtilisateurRole;
CREATE TABLE tblUtilisateurRole(
	IdUtilisateur 			INT				NOT NULL,
	IdRole		 			INT				NOT NULL,
	PRIMARY KEY(IdUtilisateur,IdRole)
);

DROP VIEW IF EXISTS vUtilisateurRole;
CREATE VIEW vUtilisateurRole AS SELECT IdUtilisateur,IdRole,CONCAT(IdUtilisateur,IdRole) AS tag FROM tblUtilisateurRole;

-- Table JournalDeBord

DROP TABLE IF EXISTS tblJournalDeBord;
CREATE TABLE tblJournalDeBord(
	Id			 			INT				AUTO_INCREMENT,
	Dates			 		DATETIME			NOT NULL,
	Entree			 		VARCHAR(700)		NOT NULL,
	Documents	 			VARCHAR(255)		NULL,
	PRIMARY KEY(Id),
	IdStagiaire				INT					NOT NULL
);

DROP VIEW IF EXISTS vJournalDeBord;
CREATE VIEW vJournalDeBord AS SELECT Id,Dates,Entree,Documents,CONCAT(Dates,IFNULL(Entree,''),IdStagiaire) AS tag,
 IdStagiaire FROM tblJournalDeBord;

-- Table tblRole

DROP TABLE IF EXISTS tblRole;
CREATE TABLE tblRole(
	Id			 			INT				AUTO_INCREMENT,
	Titre			 		VARCHAR(100)		NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vRole;
CREATE VIEW vRole AS SELECT Id,Titre,CONCAT(Titre)AS tag
FROM tblRole;

-- Table Stage

DROP TABLE IF EXISTS tblStage;
CREATE TABLE tblStage(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdResponsable			INT					NOT NULL,
	IdSuperviseur			INT					NOT NULL,
	IdStagiaire				INT					NOT NULL,
	IdGestionnaire			INT					NOT NULL,
	IdEnseignant			INT					NOT NULL
);

DROP VIEW IF EXISTS vStage;
CREATE VIEW vStage AS SELECT Id,CONCAT(IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant)
AS tag,IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant FROM tblStage;


--  Table Entreprise

DROP TABLE IF EXISTS tblEntreprise;
CREATE TABLE tblEntreprise(
	Id			 			INT				AUTO_INCREMENT,
	CourrielEntreprise		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(100)	NOT NULL,
	NumTel			 		CHAR(14) 		NOT NULL,
	NumCivique 				CHAR(5)			NOT NULL,
	Rue				 		VARCHAR(100)	NOT NULL,
	Ville			 		VARCHAR(100)	NOT NULL,
	Province				VARCHAR(25)		NOT NULL,
	CodePostal			 	VARCHAR(7)		NOT NULL,
	Logo 					VARCHAR(255)	NULL,
	PRIMARY KEY(Id),
	CONSTRAINT Constraint_UNIQUE_Entreprise UNIQUE (CourrielEntreprise)
);
DROP VIEW IF EXISTS vEntreprise;
CREATE VIEW vEntreprise AS SELECT Id,CourrielEntreprise,Nom,NumTel,NumCivique,Rue,Ville,Province,CodePostal,Logo,
CONCAT(CourrielEntreprise,Nom,NumTel,NumCivique,Rue,Ville,Province,CodePostal,IFNULL(Logo,'')) AS tag FROM tblEntreprise;

-- Table Employe

DROP TABLE IF EXISTS tblEmploye;
CREATE TABLE tblEmploye(
	Id						INT				AUTO_INCREMENT,
	CourrielEntreprise 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOt NULL,
	NumTelEntreprise 		CHAR(14)		NOT NULL,
	Poste 					VARCHAR(7)		NULL,
	PRIMARY KEY(Id),
	IdEntreprise			INT				NOT NULL,
	IdUtilisateur			INT				NOT NULL,
	CONSTRAINT Constraint_UNIQUE_EmployeEntreprise UNIQUE (CourrielEntreprise)
);

DROP VIEW IF EXISTS vEmploye;
CREATE VIEW vEmploye AS SELECT Id,CourrielEntreprise,Nom,Prenom,NumTel,
CourrielPersonnel,NumTelEntreprise,Poste,CodePermanent,CONCAT(CourrielEntreprise,Nom,Prenom,NumTel,
CourrielPersonnel,NumTelEntreprise,IFNULL(Poste, ""),CodePermanent,IdEntreprise,IdUtilisateur) AS tag,IdEntreprise,IdUtilisateur FROM tblEmploye;


-- Table Categorie Question


DROP TABLE IF EXISTS tblCategorieQuestion;
CREATE TABLE tblCategorieQuestion 
(
	Id 						INT 			AUTO_INCREMENT,
	TitreCategorie			VARCHAR(500)	NOT NULL,
	DescriptionCategorie	VARCHAR(500) 	NULL,
	Lettre					CHAR(1) 		NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vCategorieQuestion;
CREATE VIEW vCategorieQuestion AS SELECT Id,TitreCategorie,descriptionCategorie,Lettre,CONCAT(Id,TitreCategorie,descriptionCategorie,Lettre) AS tag FROM tblCategorieQuestion;


/*
-- VUE
DROP VIEW IF EXISTS vTableauBord;
CREATE VIEW vTableauBord AS 
SELECT  Stagiaire.Id, Stagiaire.Nom, Stagiaire.Prenom, Stagiaire.NumTelPersonnel, 
        Emp.Id AS 'Id Superviseur', Emp.Nom AS 'Nom Superviseur', Emp.Prenom AS 'Prenom Superviseur', Emp.NumTelCell AS 'Cell Superviseur', 
        EmpCeg.Id AS 'Id Enseignant', EmpCeg.Nom AS 'Nom Enseignant', EmpCeg.Prenom AS 'Prenom Enseignant', EmpCeg.NumTelCell AS 'Tel Enseignant' 
FROM vStagiaire AS Stagiaire
JOIN vStage AS Stage
ON Stage.IdStagiaire = Stagiaire.Id
JOIN vSuperviseur AS Sup
ON Sup.Id = Stage.IdSuperviseur
JOIN vEmployeEntreprise AS Emp
ON Emp.Id = Sup.IdEmployeEntreprise
JOIN vEnseignant AS Enseignant

ON Enseignant.Id = Stage.IdEnseignant
JOIN vEmployeCegep AS EmpCeg
ON EmpCeg.Id = Enseignant.IdEmployeCegep;
*/

-- Foreign key


ALTER TABLE tblUtilisateurRole
ADD FOREIGN KEY (IdUtilisateur)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblUtilisateurRole
ADD FOREIGN KEY (IdRole)
REFERENCES
tblRole(Id);


ALTER TABLE tblEmploye
ADD FOREIGN KEY (IdEntreprise)
REFERENCES
tblEntreprise(Id);


ALTER TABLE tblEmploye
ADD FOREIGN KEY (IdUtilisateur)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStagiaire
ADD FOREIGN KEY (IdUtilisateur)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdEnseignant)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdGestionnaire)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdSuperviseur)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdResponsable)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblEvaluationStage
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblEvaluationStage
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);


ALTER TABLE tblEvaluation
ADD FOREIGN KEY (IdTypeEvaluation)
REFERENCES
tblTypeEvaluation(Id);


ALTER TABLE tblEvaluationQuestionReponse
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblEvaluationQuestionReponse
ADD FOREIGN KEY (IdQuestion)
REFERENCES
tblQuestion(Id);


ALTER TABLE tblQuestion
ADD FOREIGN KEY (IdCategorieQuestion)
REFERENCES
tblCategorieQuestion(Id);


ALTER TABLE tblReponseQuestion
ADD FOREIGN KEY (IdQuestion)
REFERENCES
tblQuestion(Id);


ALTER TABLE tblReponseQuestion
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);


ALTER TABLE tblQuestion
ADD FOREIGN KEY (IdTypeQuestion)
REFERENCES
tblTypeQuestion(Id);



ALTER TABLE tblStage
ADD FOREIGN KEY (IdResponsable)
REFERENCES
tblResponsable(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdSuperviseur)
REFERENCES
tblSuperviseur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdGestionnaire)
REFERENCES
tblGestionnaire(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdEnseignant)
REFERENCES
tblEnseignant(Id);



ALTER TABLE tblStagiaire
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);


ALTER TABLE tblJournalDeBord
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


ALTER TABLE tblEvaluationQuestionReponse
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);

