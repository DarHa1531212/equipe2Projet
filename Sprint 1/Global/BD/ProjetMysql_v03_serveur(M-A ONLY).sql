-- BD POUR PROJET PACKAGES 1-4
-- CRÉÉE LE 06/09/2017 PAR MARC-ANTOINE DUCHESNE

-- Création de la bd
-- DROP DATABASE IF EXISTS BDProjet_equipe2V2;
-- CREATE DATABASE BDProjet_equipe2V2;-

-- USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;

-- Table Reponse

DROP TABLE IF EXISTS tblReponse;
CREATE TABLE tblReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id)
);


DROP VIEW IF EXISTS vReponse;
CREATE VIEW vReponse AS SELECT Id,Texte,CONCAT(Id,Texte) AS tag FROM tblReponse;


-- Table ReponseQuestion

DROP TABLE IF EXISTS tblReponseQuestion;
CREATE TABLE tblReponseQuestion(
	IdQuestion		INT				NOT NULL,
	IdReponse		INT			 	NOT NULL,
	PRIMARY KEY(IdQuestion,IdReponse)
);
DROP VIEW IF EXISTS vReponseQuestion;
CREATE VIEW vReponseQuestion AS SELECT IdQuestion,IdReponse,CONCAT(IdQuestion,IdReponse) AS tag FROM tblReponseQuestion;



-- Table QuestionEvaluation

DROP TABLE IF EXISTS tblQuestionEvaluation;
CREATE TABLE tblQuestionEvaluation(
	IdQuestion				INT				NOT NULL,
	IdEvaluation			INT			 	NOT NULL,
	IdReponseChoisie		INT 			NOT NULL,
	PRIMARY KEY(IdQuestionEvaluation,IdEvaluation)
);

DROP VIEW IF EXISTS vQuestionEvaluation;
CREATE VIEW vQuestionEvaluation AS SELECT 
IdQuestion,IdEvaluation,IdReponseChoisie, CONCAT(IdQuestion,IdEvaluation,IdReponseChoisie) AS tag FROM tblQuestionEvaluation;

-- Table Categorie Question


DROP TABLE IF EXISTS tblCategorieQuestion;
CREATE TABLE tblCategorieQuestion 
(
	Id 						INT 			AUTO_INCREMENT,
	descriptionCategorie	 VARCHAR(500) 	NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vCategorieQuestion;
CREATE VIEW vCategorieQuestion AS SELECT Id,descriptionCategorie,CONCAT(Id,descriptionCategorie) AS tag FROM tblCategorieQuestion;


-- Table TypeQuestion

DROP TABLE IF EXISTS tblTypeQuestion;
CREATE TABLE tblTypeQuestion(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vTypeQuestion;
CREATE VIEW vTypeQuestion AS SELECT 
Id,Texte,CONCAT(Id,Texte) AS tag FROM tblTypeQuestion;

-- Table Question

DROP TABLE IF EXISTS tblQuestion;
CREATE TABLE tblQuestion(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id),
	IdCategorieQuestion		INT				NOT NULL,
	IdTypeQuestion			INT				NOT NULL
);

DROP VIEW IF EXISTS vQuestion;
CREATE VIEW vQuestion AS SELECT Id,Texte,CONCAT(Id,Texte,IdCategorieQuestion,IdTypeQuestion) 
AS tag,IdCategorieQuestion,IdTypeQuestion FROM tblQuestion;

-- Table TypeEvaluation

DROP TABLE IF EXISTS tblTypeEvaluation;
CREATE TABLE TypeEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NOT NULL,
	DateLimite				DATE			NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vTypeEvaluation;
CREATE VIEW vTypeEvaluation AS SELECT Id,Titre,DateLimite CONCAT(Id,Titre,DateLimite) AS tag FROM tblTypeEvaluation;

-- Table Evaluation

DROP TABLE IF EXISTS tblEvaluation;
CREATE TABLE tblEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NOT NULL,
	DateComplétée			DATE			NOT NULL,
	Statut					VARCHAR(50)		NOT NULL,
	IdTypeEvaluation		INT 			NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vEvaluation;
CREATE VIEW vEvaluation AS SELECT Id,Titre,DateComplétée,Statut,IdTypeEvaluation CONCAT(Id,Titre,DateComplétée,Statut,IdTypeEvaluation) AS tag FROM tblEvaluation;

-- Table tblEvaluationStageUtilisateur

DROP TABLE IF EXISTS tblEvaluationStageUtilisateur;
CREATE TABLE tblEvaluationStageUtilisateur
(
	IdEvaluation			INT				NOT NULL,
	IdStage					INT				NOT NULL,
	IdResponsable			INT				NOT NULL,
	PRIMARY KEY(IdEvaluation,IdStage,IdResponsable)
);

DROP VIEW IF EXISTS vEvaluationStageUtilisateur;
CREATE VIEW vEvaluationStageUtilisateur AS SELECT IdEvaluation,IdStage,IdResponsable
CONCAT(IdEvaluation,IdStage,IdResponsable) AS tag FROM tblEvaluationStageUtilisateur;

-- Table stagiaire

DROP TABLE IF EXISTS tblStagiaire;
CREATE TABLE tblStagiaire(
	Id			 			INT				AUTO_INCREMENT,
	CourrielScolaire 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	NumTelPersonnel 		CHAR(14)		NOT NULL,
	NumTelMaison 			CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	NumTelEntreprise 		CHAR(14)		NULL,
	Poste 					VARCHAR(7)		NULL,
	CourrielEntreprise	 	VARCHAR(320)	NULL,
	PRIMARY KEY(Id),
	IdUtilisateur			INT 			NOT NULL,
	CONSTRAINT Constraint_UNIQUE_Stagiaire UNIQUE (CourrielScolaire)
);

DROP VIEW IF EXISTS vStagiaire;
CREATE VIEW vStagiaire AS SELECT Id,CourrielScolaire,Nom,Prenom,NumTelPersonnel,NumTelMaison,CourrielPersonnel
,NumTelEntreprise,Poste,CourrielEntreprise,IdUtilisateur, CONCAT(Id,CourrielScolaire,Nom,Prenom,NumTelPersonnel,NumTelMaison,CourrielPersonnel
,IFNULL(NumTelEntreprise,''),IFNULL(Poste,''),IFNULL(CourrielEntreprise,''),IdUtilisateur) AS tag FROM tblStagiaire;

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
CREATE VIEW vJournalDeBord AS SELECT Id,Dates,Entree,Documents,CONCAT(Id,Dates,Entree,IdStagiaire) AS tag,
 IdStagiaire FROM tblJournalDeBord;

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
CREATE VIEW vStage AS SELECT Id,CONCAT(Id,IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant)
AS tag,IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant FROM tblStage;

-- Table Utilisateur

DROP TABLE IF EXISTS tblUtilisateur;
CREATE TABLE tblUtilisateur(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	Courriel				VARCHAR(320)	NOT NULL,
	MotDePasse				VARCHAR(320)	NOT NULL
);

DROP VIEW IF EXISTS vUtilisateur;
CREATE VIEW vUtilisateur AS SELECT Id,Courriel,MotDePasse, CONCAT(Id,Courriel,MotDePasse) AS tag FROM tblUtilisateur;

-- Table Role

DROP TABLE IF EXISTS tblRole;
CREATE TABLE tblRole(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	Texte					VARCHAR(320)	NOT NULL
);

DROP VIEW IF EXISTS vRole;
CREATE VIEW vRole AS SELECT Id,Texte,CONCAT(Id,Texte) AS tag FROM tblRole;

-- Table UtilisateurRole

DROP TABLE IF EXISTS tblUtilisateurRole;
CREATE TABLE tblUtilisateurRole(
	IdRole						INT				NOT NULL,
	IdUtilisateur	 			INT				NOT NULL,
	PRIMARY KEY(IdRole,IdUtilisateur)
);


DROP VIEW IF EXISTS vUtilisateurRole;
CREATE VIEW vUtilisateurRole AS SELECT IdRole,IdUtilisateur, CONCAT(IdRole,IdUtilisateur) AS tag FROM tblUtilisateurRole;

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
CONCAT(Id,CourrielEntreprise,Nom,NumTel,NumCivique,Rue,Ville,Province,CodePostal,IFNULL(Logo,'')) AS tag FROM tblEntreprise;

-- Table Employe

DROP TABLE IF EXISTS tblEmploye;
CREATE TABLE tblEmploye(
	Id						INT				AUTO_INCREMENT,
	CourrielProfessionel 	VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOt NULL,
	NumTelCell		 		CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	NumTelEntreprise 		CHAR(14)		NOT NULL,
	Poste 					VARCHAR(7)		NULL,
	CodePermanent			CHAR(7)			NOT NULL,
	PRIMARY KEY(Id),
	IdEntreprise			INT				NOT NULL,
	IdUtilisateur			INT 			NOT NULL,
	CONSTRAINT Constraint_UNIQUE_EmployeEntreprise UNIQUE (CourrielProfessionel)
);

DROP VIEW IF EXISTS vEmploye;
CREATE VIEW vEmploye AS SELECT Id,CourrielProfessionel,Nom,Prenom,NumTelCell,
CourrielPersonnel,NumTelEntreprise,Poste,CodePermanent, CONCAT(CourrielEntreprise,Nom,Prenom,NumTelCell,
CourrielPersonnel,NumTelEntreprise,IFNULL(Poste, ""),CodePermanent,IdEntreprise,IdUtilisateur) AS tag,IdEntreprise,IdUtilisateur FROM tblEmploye;


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


-- Foreign key

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

ALTER TABLE tblEvaluation
ADD FOREIGN KEY (IdTypeEvaluation)
REFERENCES
tblTypeEvaluation(Id);

ALTER TABLE tblQuestionEvaluation
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);




ALTER TABLE tblQuestionEvaluation
ADD FOREIGN KEY (IdQuestion)
REFERENCES
tblQuestion(Id);


ALTER TABLE tblReponseQuestion
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);


ALTER TABLE tblReponseQuestion
ADD FOREIGN KEY (IdQuestion)
REFERENCES
tblQuestion(Id);

ALTER TABLE tblQuestion
ADD FOREIGN KEY (IdCategorieQuestion)
REFERENCES
tblCategorieQuestion(Id);

ALTER TABLE tblQuestion
ADD FOREIGN KEY (IdTypeQuestion)
REFERENCES
tblTypeQuestion(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdResponsable)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdSuperviseur)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdGestionnaire)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdEnseignant)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblEvaluationStageUtilisateur
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblEvaluationStageUtilisateur
ADD FOREIGN KEY (IdResponsable)
REFERENCES
tblUtilisateur(Id);


ALTER TABLE tblEvaluationStageUtilisateur
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);


ALTER TABLE tblJournalDeBord
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


