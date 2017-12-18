-- BD POUR PROJET PACKAGES 1-4
-- CRÉÉE LE 06/09/2017 PAR MARC-ANTOINE DUCHESNE

-- Création de la bd
-- USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
DROP DATABASE IF EXISTS BDProjet_equipe2V2; CREATE DATABASE BDProjet_equipe2V2; USE bdprojet_equipe2v2;
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
	IdReponse				INT				NOT NULL,
	IdQuestion				INT				NOT NULL,
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
    Commentaire 			VARCHAR(3000)	NULL,
	PRIMARY KEY(IdQuestion,IdEvaluation)
);


DROP VIEW IF EXISTS vEvaluationQuestionReponse;
CREATE VIEW vEvaluationQuestionReponse AS SELECT IdQuestion,IdReponse,IdEvaluation,Commentaire,
CONCAT(Commentaire,IdQuestion,IdReponse,IdEvaluation) AS tag FROM tblEvaluationQuestionReponse;


-- Table Evaluation

DROP TABLE IF EXISTS tblEvaluation;
CREATE TABLE tblEvaluation(
	Id						INT				AUTO_INCREMENT,
	Statut					CHAR(1)			NOT	NULL,
	DateDébut				DATE			NULL,
	DateFin					DATE			NULL,
	DateComplétée			DATE			NULL,
	Commentaire				VARCHAR(2000)	NULL,
	PRIMARY KEY(Id),
	IdTypeEvaluation		INT				NOT NULL
);

DROP VIEW IF EXISTS vEvaluation;
CREATE VIEW vEvaluation AS SELECT Id,Statut,DateComplétée,DateDébut,DateFin,Commentaire,
CONCAT(Id,Statut,DateComplétée,DateDébut,DateFin,IdTypeEvaluation,IdTypeEvaluation,Statut,IFNULL(DateComplétée,'')) AS tag,IdTypeEvaluation FROM tblEvaluation;


-- Table tblTypeEvaluation

DROP TABLE IF EXISTS tblTypeEvaluation;
CREATE TABLE tblTypeEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NOT NULL,
	DateLimite				DATE			NOT NULL DEFAULT '2010-01-01',
	Description				VARCHAR(300)	NULL,
	Objectif				VARCHAR(1000)	NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vTypeEvaluation;
CREATE VIEW vTypeEvaluation AS SELECT Id,Titre,DateLimite,Objectif,Description,CONCAT(Titre,DateLimite,Description) AS tag FROM tblTypeEvaluation;

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
	CourrielPersonnel		VARCHAR(320)	NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	NumTelPerso		 		CHAR(14)		NULL,
	NumTelEntreprise 		CHAR(14)		NULL,
	Poste 					VARCHAR(7)		NULL,
	CourrielEntreprise	 	VARCHAR(320)	NULL,
	CodePermanent			VARCHAR(12)		NULL,
	Adresse					VARCHAR(350)	NULL,
	PRIMARY KEY(Id),
	IdUtilisateur			INT				NULL,
	CONSTRAINT Constraint_UNIQUE_Stagiaire UNIQUE (CourrielScolaire)
);

DROP VIEW IF EXISTS vStagiaire;
CREATE VIEW vStagiaire AS SELECT Id,CourrielScolaire,Nom,Prenom,NumTelPerso,CourrielPersonnel
,NumTelEntreprise,Poste,CourrielEntreprise,CodePermanent,Adresse,
CONCAT(CourrielScolaire,Nom,Prenom,NumTelPerso
,IFNULL(NumTelEntreprise,''),IFNULL(Poste,''),IFNULL(CourrielEntreprise,''),IdUtilisateur,IFNULL(CodePermanent, ''),IFNULL(CourrielPersonnel, '')) AS tag,
IdUtilisateur FROM tblStagiaire;

-- Table tblUtilisateur

DROP TABLE IF EXISTS tblUtilisateur;
CREATE TABLE tblUtilisateur(
	Id			 			INT				AUTO_INCREMENT,
	Courriel		 		VARCHAR(320)	NOT NULL,
	MotDePasse				VARCHAR(250)	NOT NULL,
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
	Dates			 		DATETIME		NOT NULL,
	Entree			 		VARCHAR(700)	NOT NULL,
	Documents	 			VARCHAR(255)	NULL,
	PRIMARY KEY(Id),
	IdStagiaire				INT				NOT NULL
);

DROP VIEW IF EXISTS vJournalDeBord;
CREATE VIEW vJournalDeBord AS SELECT Id,Dates,Entree,Documents,CONCAT(Dates,IFNULL(Entree,''),IdStagiaire) AS tag,
 IdStagiaire FROM tblJournalDeBord;

-- Table tblRole

DROP TABLE IF EXISTS tblRole;
CREATE TABLE tblRole(
	Id			 			INT				AUTO_INCREMENT,
	Titre			 		VARCHAR(100)	NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vRole;
CREATE VIEW vRole AS SELECT Id,Titre,CONCAT(Titre)AS tag
FROM tblRole;

-- Table Stage

DROP TABLE IF EXISTS tblStage;
CREATE TABLE tblStage(
	Id			 			INT				AUTO_INCREMENT,
	DescriptionStage		VARCHAR(1000)	NULL,
	CompetenceRecherche		VARCHAR(1000)	NULL,
	RaisonSociale			VARCHAR(1000)	NULL,
	NbHeureSemaine			INT				NULL,
	SalaireHoraire			VARCHAR(20)		NULL,
	DateDebut				DATE			NULL,
	DateFin					DATE			NULL,
	LettreEntenteVide		VARCHAR(255)	NULL,
	LettreEntenteSignee		VARCHAR(255)	NULL,
	OffreStage				VARCHAR(255)	NULL,
	PRIMARY KEY(Id),
	IdResponsable			INT				NOT NULL,
	IdSuperviseur			INT				NOT NULL,
	IdStagiaire				INT				NULL,
	IdSession				INT				NOT NULL DEFAULT 1,
	IdEnseignant			INT				NULL
);

DROP VIEW IF EXISTS vStage;
CREATE VIEW vStage AS SELECT Id,RaisonSociale,DescriptionStage,CompetenceRecherche,NbHeureSemaine,
SalaireHoraire,DateDebut,DateFin,LettreEntenteVide,LettreEntenteSignee,OffreStage,IdSession,CONCAT(IdResponsable,IdSuperviseur,IdStagiaire,IdEnseignant,DescriptionStage,CompetenceRecherche,NbHeureSemaine,
SalaireHoraire,DateDebut,DateFin,LettreEntenteVide,LettreEntenteSignee,OffreStage)
AS tag,IdResponsable,IdSuperviseur,IdStagiaire,IdEnseignant FROM tblStage;

-- Table Session

DROP TABLE IF EXISTS tblSession;
CREATE TABLE tblSession(
	Id			 			INT				AUTO_INCREMENT,
	Annee		 			YEAR(4)			NOT NULL, -- -----------------------------------------------
	Periode		 			VARCHAR(10)		NOT NULL, -- -----------------------------------------------
	CahierEntreprise		VARCHAR(255)	NULL,
	CahierStagiaire			VARCHAR(255)	NULL,
	MiStageDebut			DATE			NULL,
	MiStageLimite			DATE			NULL,
	FinaleDebut				DATE			NULL,
	FinaleLimite			DATE			NULL,
	FormationDebut			DATE			NULL,
	FormationLimite			DATE			NULL,
	JanvierDebut			DATE			NULL,
	JanvierLimite			DATE			NULL,
	FevrierDebut			DATE			NULL,
	FevrierLimite			DATE			NULL,
	MarsDebut				DATE			NULL,
	MarsLimite				DATE			NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vSession;
CREATE VIEW vSession AS SELECT Id, Annee,Periode,CahierEntreprise,CahierStagiaire,MiStageDebut
, MiStageLimite,FinaleDebut,FinaleLimite,
FormationDebut,FormationLimite,JanvierDebut,JanvierLimite,FevrierDebut,FevrierLimite,MarsDebut,MarsLimite FROM tblSession;

	
--  Table Entreprise

DROP TABLE IF EXISTS tblEntreprise;
CREATE TABLE tblEntreprise(
	Id			 			INT				AUTO_INCREMENT,
	CourrielEntreprise		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(100)	NOT NULL,
	NumTel			 		CHAR(14) 		NOT NULL,
	NumCivique 				VARCHAR(10)		NOT NULL,
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
	NumTelEntreprise		CHAR(14)		NOT NULL,
	Poste 					VARCHAR(7)		NULL,
	PRIMARY KEY(Id),
	IdEntreprise			INT				NOT NULL,
	IdUtilisateur			INT				NOT NULL,
	CONSTRAINT Constraint_UNIQUE_EmployeEntreprise UNIQUE (CourrielEntreprise)
);

DROP VIEW IF EXISTS vEmploye;
CREATE VIEW vEmploye AS SELECT Id,CourrielEntreprise,Nom,Prenom,
NumTelEntreprise,Poste,CONCAT(CourrielEntreprise,Nom,Prenom,
NumTelEntreprise,IFNULL(Poste, ""),IdEntreprise,IdUtilisateur) AS tag,IdEntreprise,IdUtilisateur FROM tblEmploye;


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

-- ----------------
 
 -- table typeEtatAvancement
 
 DROP TABLE IF EXISTS tblTypeEtatAvancement;
	CREATE TABLE tblTypeEtatAvancement
	(
		Id							INT				NOT NULL,
		Description					VARCHAR(3000)	NULL,
		PRIMARY KEY(Id)
	);
	
DROP VIEW IF EXISTS vTypeEtatAvancement;
CREATE VIEW vTypeEtatAvancement AS 
SELECT Id,Description,
CONCAT(Description) AS tag FROM tblTypeEtatAvancement;
 
-- Table Etat d'avancement
	
	DROP TABLE IF EXISTS tblEtatAvancement;
	CREATE TABLE tblEtatAvancement
	(
		Id						INT				AUTO_INCREMENT,	
		-- communs
		EcheancierTachesAVenir	VARCHAR(3000)	NULL,	
		AppreciationTravail		TINYINT(1)		NULL,
		IntegrationMilieuStage	VARCHAR(3000)	NULL,
		InteractionAvecAutres	VARCHAR(3000)	NULL,
		FaconDeFaire			VARCHAR(3000)	NULL,
		Statut					CHAR(1)			NOT NULL,
		DateComplétée			DATE			NULL,
		PRIMARY KEY(Id),
		IdStage					INT				NOT NULL,
		IdTypeEtatAvancement	INT				NOT NULL
	);
	
DROP VIEW IF EXISTS vEtatAvancement;
CREATE VIEW vEtatAvancement AS 
SELECT Id,EcheancierTachesAVenir,AppreciationTravail,IntegrationMilieuStage,InteractionAvecAutres,FaconDeFaire,Statut,DateComplétée,IdTypeEtatAvancement,IdStage,
CONCAT(EcheancierTachesAVenir,AppreciationTravail,IntegrationMilieuStage,InteractionAvecAutres,FaconDeFaire,Statut,DateComplétée) AS tag FROM tblEtatAvancement;
	
-- Table Etat d'avancement janvier
	
	DROP TABLE IF EXISTS tblEtatAvancementJanvier;
	CREATE TABLE tblEtatAvancementJanvier
	(
		Id							INT				NOT NULL,
		NomOrganisation 			VARCHAR(200) 	NULL,
		MissionOrganisation			VARCHAR(3000)	NULL,
		AcceuilDebutStage			TINYINT(1)		NULL,	
		OrganigrammeOrganisation	VARCHAR(255)	NULL,
		DescriptionApprentissage	VARCHAR(3000)	NULL,
		TransitionAuTravail			VARCHAR(3000)	NULL,
		DescriptionGeneralStage		VARCHAR(3000)	NULL,
		PRIMARY KEY(Id)
	);
	
		
DROP VIEW IF EXISTS vEtatAvancementJanvier;
CREATE VIEW vEtatAvancementJanvier AS 
SELECT Id,NomOrganisation, MissionOrganisation,AcceuilDebutStage,OrganigrammeOrganisation,DescriptionApprentissage,TransitionAuTravail,DescriptionGeneralStage,
CONCAT(NomOrganisation, MissionOrganisation,AcceuilDebutStage,OrganigrammeOrganisation,DescriptionApprentissage,TransitionAuTravail,DescriptionGeneralStage) AS tag FROM tblEtatAvancementJanvier;
		
-- Table Etat d'avancement fevrier

	
	DROP TABLE IF EXISTS tblEtatAvancementFevrier;
	CREATE TABLE tblEtatAvancementFevrier
	(
		Id							INT				NOT NULL,
		apprentissageTechnique		VARCHAR(3000)	NULL,
		apprentissageLogiciel		VARCHAR(3000)	NULL,
		apprentissageEnvironement	VARCHAR(3000)	NULL,
		
		PRIMARY KEY(Id)
	);
	
	
DROP VIEW IF EXISTS vEtatAvancementFevrier;
CREATE VIEW vEtatAvancementFevrier AS 
SELECT Id,apprentissageTechnique,apprentissageLogiciel,apprentissageEnvironement,
CONCAT(apprentissageTechnique,apprentissageLogiciel,apprentissageEnvironement) AS tag FROM tblEtatAvancementFevrier;
	
	
-- Table Etat d'avancement mars

	
	DROP TABLE IF EXISTS tblEtatAvancementMars;
	CREATE TABLE tblEtatAvancementMars
	(
		Id							INT				NOT NULL,
		apprentissageTechnique		VARCHAR(3000)	NULL,
		apprentissageLogiciel		VARCHAR(3000)	NULL,
		apprentissageEnvironement	VARCHAR(3000)	NULL,
		
		PRIMARY KEY(Id)
	);
	
DROP VIEW IF EXISTS vEtatAvancementMars;
CREATE VIEW vEtatAvancementMars AS 
SELECT Id,apprentissageTechnique,apprentissageLogiciel,apprentissageEnvironement,
CONCAT(apprentissageTechnique,apprentissageLogiciel,apprentissageEnvironement) AS tag FROM tblEtatAvancementMars;
	

-- Table tacheEffectuee

	DROP TABLE IF EXISTS tblTacheEffectuee;
	CREATE TABLE tblTacheEffectuee
	(
		Id							INT				AUTO_INCREMENT,
		DescriptionTache			VARCHAR(3000)	NOT NULL,
		PRIMARY KEY(Id),
		IdEtatAvancement			INT 			NOT NULL
	);
	
DROP VIEW IF EXISTS vTacheEffectuee;
CREATE VIEW vTacheEffectuee AS 
SELECT Id,DescriptionTache,
CONCAT(DescriptionTache) AS tag FROM tblTacheEffectuee;
	
-- Table MembreEquipeStagiaire

	DROP TABLE IF EXISTS tblMembreEquipeStagiaire;
	CREATE TABLE tblMembreEquipeStagiaire
	(
		Id						INT					AUTO_INCREMENT,
		Nom 					VARCHAR(100)		NOT NULL,
		Prenom					VARCHAR(100)		NOT NULL,
		Responsabilites			VARCHAR(3000)		NOT NULL,
		PRIMARY KEY(Id),
		IdEtatAvancementJanvier	INT 				NOT NULL
	);
	
DROP VIEW IF EXISTS vMembreEquipeStagiaire;
CREATE VIEW vMembreEquipeStagiaire AS 
SELECT Id, Nom,Prenom, Responsabilites,IdEtatAvancementJanvier,
CONCAT(Nom,Prenom, Responsabilites,IdEtatAvancementJanvier) AS tag FROM tblMembreEquipeStagiaire;

-- table TypeTache
	
	DROP TABLE IF EXISTS tblTypeTache;
	CREATE TABLE tblTypeTache
	(
		Id						INT					AUTO_INCREMENT,
		NomTypeTache			VARCHAR(200)		NOT NULL,			
		Proportion				INT					NOT NULL,
		PRIMARY KEY(Id),
		IdEtatAvancementJanvier	INT 				NOT NULL
	);
	
DROP VIEW IF EXISTS vTypeTache;
CREATE VIEW vTypeTache AS 
SELECT Id, NomTypeTache, Proportion,IdEtatAvancementJanvier,
CONCAT(NomTypeTache, Proportion,IdEtatAvancementJanvier) AS tag FROM tblTypeTache;

-- ----------------

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
ADD FOREIGN KEY (IdEnseignant)
REFERENCES
tblEnseignant(Id);



ALTER TABLE tblJournalDeBord
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


ALTER TABLE tblEvaluationQuestionReponse
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);

ALTER TABLE tblEtatAvancement
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);

ALTER TABLE tblEtatAvancementJanvier
ADD FOREIGN KEY (Id)
REFERENCES
tblEtatAvancement(Id);

ALTER TABLE tblEtatAvancementFevrier
ADD FOREIGN KEY (Id)
REFERENCES
tblEtatAvancement(Id);

ALTER TABLE tblEtatAvancementMars
ADD FOREIGN KEY (Id)
REFERENCES
tblEtatAvancement(Id);

ALTER TABLE tblTacheEffectuee
ADD FOREIGN KEY (IdEtatAvancement)
REFERENCES
tblEtatAvancement(Id); 

ALTER TABLE tblMembreEquipeStagiaire
ADD FOREIGN KEY (IdEtatAvancementJanvier)
REFERENCES
tblEtatAvancementJanvier(Id); 

ALTER TABLE tblTypeTache
ADD FOREIGN KEY (IdEtatAvancementJanvier)
REFERENCES
tblEtatAvancementJanvier(Id);

 
ALTER TABLE tblEtatAvancement
ADD FOREIGN KEY (IdTypeEtatAvancement)
REFERENCES
tblTypeEtatAvancement(Id); 