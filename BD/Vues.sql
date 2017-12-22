-- USE BDProjet_equipe2V2;
-- USE cegepjon_p2017_2_dev;
 USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
-- ------------------------------------------------
-- Sélectionne tous les enseignants.
-- ------------------------------------------------
DROP VIEW IF EXISTS vEnseignant;
CREATE VIEW vEnseignant AS 
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdEnseignant, Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise,
CONCAT(Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise) AS Tag
FROM vEmploye AS Emp
JOIN vUtilisateur AS Util
ON Util.Id = Emp.IdUtilisateur
JOIN vUtilisateurRole AS UR
ON UR.IdUtilisateur = Util.Id
JOIN vRole AS Role
ON Role.Id = UR.IdRole
WHERE Role.Titre = 'Enseignant';

-- ------------------------------------------------
-- Sélectionne tous les gestionnaires.
-- ------------------------------------------------
DROP VIEW IF EXISTS vGestionnaire;
CREATE VIEW vGestionnaire AS 
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdGestionnaire, Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise,
CONCAT(Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise) AS Tag
FROM vEmploye AS Emp
JOIN vUtilisateur AS Util
ON Util.Id = Emp.IdUtilisateur
JOIN vUtilisateurRole AS UR
ON UR.IdUtilisateur = Util.Id
JOIN vRole AS Role
ON UR.IdRole = Role.Id
WHERE Role.Titre = 'Gestionnaire';

-- ------------------------------------------------
-- Sélectionne tous les responsables.
-- ------------------------------------------------
DROP VIEW IF EXISTS vResponsable;
CREATE VIEW vResponsable AS 
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdResponsable, Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise,
CONCAT(Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise) AS Tag
FROM vEmploye AS Emp
JOIN vUtilisateur AS Util
ON Util.Id = Emp.IdUtilisateur
JOIN vUtilisateurRole AS UR
ON UR.IdUtilisateur = Util.Id
JOIN vRole AS Role
ON UR.IdRole = Role.Id
WHERE Role.Titre = 'Responsable';

-- ------------------------------------------------
-- Sélectionne tous les superviseurs.
-- ------------------------------------------------
DROP VIEW IF EXISTS vSuperviseur;
CREATE VIEW vSuperviseur AS 
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdSuperviseur, Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise,
CONCAT(Prenom, Nom, NumTelEntreprise, IdEntreprise, Poste, CourrielEntreprise) AS Tag
FROM vEmploye AS Emp
JOIN vUtilisateur AS Util
ON Util.Id = Emp.IdUtilisateur
JOIN vUtilisateurRole AS UR
ON UR.IdUtilisateur = Util.Id
JOIN vRole AS Role
ON UR.IdRole = Role.Id
WHERE Role.Titre = 'Superviseur';

-- ------------------------------------------------
-- Sélectionne tous les enseignants, superviseur et stagiaire lié au même stage.
-- ------------------------------------------------
DROP VIEW IF EXISTS vTableauBord;
CREATE VIEW vTableauBord AS
SELECT     Stagiaire.IdUtilisateur AS 'Id', Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPerso,
        Enseignant.IdUtilisateur AS 'IdEnseignant', Enseignant.Prenom AS 'PrenomEnseignant', Enseignant.Nom AS 'NomEnseignant', Enseignant.NumTelEntreprise AS 'TelEnseignant',
        Sup.IdUtilisateur AS 'IdSuperviseur', Sup.Prenom AS 'PrenomSuperviseur', Sup.Nom AS 'NomSuperviseur', Sup.NumTelEntreprise AS 'TelSuperviseur',
        res.IdUtilisateur AS 'IdResponsable', Stage.Id AS 'IdStage', Session.Id AS 'IdSession', 
        Session.JanvierDebut, Session.JanvierLimite, Session.FevrierDebut, Session.FevrierLimite, Session.MarsDebut,
        Session.MarsLimite, Session.Annee, Session.Periode, Session.MiStageDebut, Session.MiStageLimite,
        Session.FinaleDebut, Session.FinaleLimite, Session.FormationDebut, Session.FormationLimite
FROM vStage AS Stage
JOIN vStagiaire AS Stagiaire
ON Stagiaire.IdUtilisateur = Stage.IdStagiaire
JOIN vEmploye AS Enseignant
ON Enseignant.IdUtilisateur = Stage.IdEnseignant
JOIN vEmploye AS Sup
ON Sup.IdUtilisateur = Stage.IdSuperviseur
JOIN vEmploye AS res
ON res.IdUtilisateur = Stage.IdResponsable
JOIN vSession AS Session
ON Session.Id = Stage.IdSession;


-- ------------------------------------------------
-- Sélectionne les informations globales sur les évaluations de chaque stagiaire
-- ------------------------------------------------


DROP VIEW IF EXISTS vInfoEvalGlobale;
CREATE VIEW vInfoEvalGlobale AS
SELECT 	St.Id as 'IdStage', Eva.Id as 'IdEvaluation',Eva.DateComplétée as 'DateComplétée',Eva.Statut as 'Statut',
		Eva.DateDébut as 'DateDébut',Eva.DateFin as 'DateFin',TE.Id as 'IdTypeEvaluation', TE.Titre as 'TitreTypeEvaluation',
        St.IdStagiaire
FROM vEvaluation as Eva
join vTypeEvaluation as TE
on TE.Id = Eva.IdTypeEvaluation
JOIN vEvaluationStage as ES
on Eva.Id = ES.IdEvaluation
join vStage as St
on St.Id = ES.IdStage;

----------------------------
-- selectionne les informations des etats d'avancement globale
-----------------------------

DROP VIEW IF EXISTS vInfoEtatAvancement;
CREATE VIEW vInfoEtatAvancement AS 
select etat.Id as 'IdEtatAvancement',etat.Statut as 'Statut', DateComplétée as 'DateComplétée', sta.Id as 'IdStage', 
		typeetat.Description as 'TitreTypeEtat', typeetat.Id as 'IdTypeEtatAvancement'
from vEtatAvancement as etat
join vStage as sta
on sta.Id = etat.IdStage
join vTypeEtatAvancement as typeetat
on typeetat.Id = etat.IdTypeEtatAvancement;

-- ------------------------------------------------
-- Récupère toutes les évaluations des stagiaires selon leur ID et le type d'évaluation avec leurs réponses choisies.
-- ------------------------------------------------
DROP VIEW IF EXISTS vEvaluationCompletee;
CREATE VIEW vEvaluationCompletee AS 
SELECT Stagiaire.Id AS IdStagiaire, Stagiaire.Prenom, Stagiaire.Nom, Eval.Id AS IdEvaluation, 
TypeEval.Titre AS Evaluation, Question.Texte AS Question,Lettre,TitreCategorie,DescriptionCategorie, EQR.IdReponse, Reponse.Texte AS Reponse,
CONCAT(Enseignant.Prenom,' ',Enseignant.Nom) AS Enseignant,
CONCAT(Responsable.Prenom,' ',Responsable.Nom) AS Responsable,
CONCAT(Superviseur.Prenom,' ',Superviseur.Nom) AS Superviseur,
Entreprise.Nom AS Entreprise,TypeEval.Id AS TypeEvaluation, Competence
FROM vStagiaire AS Stagiaire
JOIN vUtilisateur AS Util
ON Stagiaire.IdUtilisateur = Util.Id
JOIN vStage AS Stage
ON Stage.IdStagiaire = Util.Id
JOIN vEvaluationStage AS EV
ON EV.IdStage = Stage.Id
JOIN vEvaluation AS Eval
ON Eval.Id = EV.IdEvaluation
JOIN vTypeEvaluation AS TypeEval
ON TypeEval.Id = Eval.IdTypeEvaluation
JOIN vEvaluationQuestionReponse AS EQR
ON EQR.IdEvaluation = Eval.Id
JOIN vQuestion AS Question
ON Question.Id = EQR.IdQuestion
JOIN vCategorieQuestion AS CategorieQuestion
ON Question.IdCategorieQuestion = CategorieQuestion.Id
JOIN vReponse AS Reponse
ON Reponse.Id = EQR.IdReponse
JOIN vEnseignant AS Enseignant
ON Enseignant.IdUtilisateur = Stage.IdEnseignant
JOIN vResponsable AS Responsable
ON Responsable.IdUtilisateur = Stage.IdResponsable
JOIN vSuperviseur AS Superviseur
ON Superviseur.IdUtilisateur = Stage.IdSuperviseur
JOIN vEntreprise AS Entreprise
ON Entreprise.Id = Superviseur.IdEntreprise;

-- ------------------------------------------------
-- Récupère toutes les évaluations des stagiaires selon leur ID et le type d'évaluation avec leurs réponses choisies.
-- ------------------------------------------------

DROP VIEW IF EXISTS vEvaluations;
CREATE VIEW vEvaluations AS
SELECT St.Id AS 'IdStage',St.IdResponsable AS 'IdResponsable',Eva.Id AS 'IdEvaluation',TE.Id AS 'IdTypeEvaluation',TE.Titre AS 'TypeEvaluation',Qu.Id AS 'IdQuestion',Qu.Texte AS 'DescriptionQuestion',CQ.DescriptionCategorie AS 'DescriptionCategorie',TQ.Description AS 'DescriptionTypeQuestion',Re.Id AS 'IdReponse',Re.Texte AS 'DescriptionReponse'
FROM tblStage AS St
JOIN tblEvaluationStage AS Es
ON Es.IdStage = St.Id
JOIN tblEvaluation AS Eva
ON Eva.Id = Es.IdEvaluation
JOIN tblEvaluationQuestionReponse AS EQR
ON EQR.IdEvaluation = Eva.Id
JOIN tblQuestion AS Qu
ON Qu.Id = EQR.IdQuestion
JOIN tblReponseQuestion AS RQ
ON RQ.IdQuestion = Qu.Id
JOIN tblReponse AS Re
ON RQ.IdReponse = Re.Id
JOIN tblCategorieQuestion AS CQ
ON CQ.Id = Qu.IdCategorieQuestion
JOIN tblTypeQuestion AS TQ
ON TQ.Id = Qu.IdTypeQuestion
JOIN tblTypeEvaluation AS TE
ON TE.Id = Eva.IdTypeEvaluation
LIMIT 20000;

-- ------------------------------------------------
-- Récupère les noms des différents noms des utilisateurs lié au stage
-- ------------------------------------------------
DROP VIEW IF EXISTS vIdentification;
CREATE VIEW vIdentification AS
SELECT	Sup.Prenom AS 'PrenomSup', Sup.Nom AS 'NomSup',
		Ens.Prenom AS 'PrenomEns', Ens.Nom AS 'NomEns',
        Resp.Prenom AS 'PrenomResp', Resp.Nom AS 'NomResp',
        Sta.Prenom AS 'PrenomSta', Sta.Nom AS 'NomSta',
        Ent.Nom AS 'NomEnt', Sta.IdUtilisateur AS 'IdStagiaire',
        Stage.Id AS 'IdStage'
FROM vStage AS Stage
JOIN vSuperviseur AS Sup
ON Sup.IdUtilisateur = Stage.IdSuperviseur
JOIN vEnseignant AS Ens
ON Ens.IdUtilisateur = Stage.IdEnseignant
JOIN vResponsable AS Resp
ON Resp.IdUtilisateur = Stage.IdResponsable
JOIN vStagiaire AS Sta
ON Sta.IdUtilisateur = Stage.IdStagiaire
JOIN vEmploye AS Emp
ON Emp.IdUtilisateur = Sup.IdUtilisateur
JOIN vEntreprise AS Ent
ON Ent.Id = Emp.IdEntreprise;

-- ------------------------------------------------
-- Récupère toutes les noms et les informations nécéssaires à la génération du pdf de la lettre d'entente
-- ------------------------------------------------
DROP VIEW IF EXISTS vInfoStagiaire;
CREATE VIEW vInfoStagiaire AS
SELECT CONCAT(Prenom,' ',Nom) AS NomComplet,IdUtilisateur,Adresse AS  'AdresseStagiaire',NumTelPerso AS NumTelStagiaire,CourrielScolaire AS CourrielPersonnel FROM vUtilisateur 

	JOIN vStagiaire
	ON vStagiaire.IdUtilisateur = vUtilisateur.Id;

DROP VIEW IF EXISTS vEntente;
CREATE VIEW vEntente AS 
SELECT Annee,Periode,Stage.Id AS IdStage,Stagiaire.NomComplet,Stagiaire.IdUtilisateur,Stagiaire.AdresseStagiaire,Stagiaire.NumTelStagiaire,Stagiaire.CourrielPersonnel,
Entreprise.nom AS NomEntreprise,CONCAT(Entreprise.NumCivique,' ',Entreprise.Rue) AS AdresseEntreprise,Entreprise.NumTel,
Entreprise.CourrielEntreprise,DATE_FORMAT(DateDebut, "%d/%m/%Y") AS DateDebut,DATE_FORMAT(DateFin, "%d/%m/%Y") AS DateFin FROM vStage AS Stage
	JOIN vUtilisateur AS Utilisateur
	ON Stage.IdSuperviseur = Utilisateur.Id 

	JOIN vEmploye AS Employe
	ON Employe.IdUtilisateur = Utilisateur.Id

	JOIN vEntreprise AS Entreprise
	ON Entreprise.Id = Employe.IdEntreprise

	JOIN vInfoStagiaire AS Stagiaire
	ON Stage.IdStagiaire = Stagiaire.IdUtilisateur

	JOIN vSession AS Sess
	ON Stage.IdSession = Sess.Id;

-- ------------------------------------------------
-- Récupère toutes les informations nécéssaires à l'offre de stage.
-- ------------------------------------------------
DROP VIEW IF EXISTS vSuperviseurEntreprise;
CREATE VIEW vSuperviseurEntreprise AS SELECT Superviseur.Id AS IdSuperviseur,CONCAT(Superviseur.Prenom,' ',Superviseur.Nom) AS NomSuperviseur,Entreprise.Id AS IdEntreprise,Entreprise.Nom AS NomEntreprise,Entreprise.CourrielEntreprise,Entreprise.NumTel,
CONCAT(Entreprise.NumCivique,' ',Entreprise.Rue) AS AdresseEntreprise
  FROM vEmploye AS Superviseur
	JOIN vEntreprise AS Entreprise
	ON Superviseur.IdEntreprise = Entreprise.Id;

DROP VIEW IF EXISTS vOffre;
CREATE VIEW vOffre AS SELECT CONCAT('Session ',Periode, ' ', Annee) AS AnneeSession,DATE_FORMAT(DateDebut, "%d/%m/%Y") AS DateDebut,
NbHeureSemaine,SalaireHoraire,CompetenceRecherche,Stage.DescriptionStage,Stage.ID AS IdStage,RaisonSociale,Entreprise.Nom AS NomEntreprise,SupEnt.CourrielEntreprise,
SupEnt.NumTel,SupEnt.AdresseEntreprise,
CONCAT(Employe.Prenom,' ',Employe.Nom) AS NomResponsable,SupEnt.NomSuperviseur FROM vStage AS Stage
	JOIN vSuperviseurEntreprise AS SupEnt
	ON Stage.IdSuperviseur = SupEnt.IdSuperviseur

	JOIN vUtilisateur AS Responsable
	ON Responsable.Id = Stage.IdResponsable

	JOIN vEmploye AS Employe
	ON Employe.IdUtilisateur = Responsable.Id

	JOIN vEntreprise AS Entreprise
	ON Employe.IdEntreprise = Entreprise.Id

	JOIN vSession 
	ON Stage.IdSession = vSession.Id;

-- ------------------------------------------------
-- Récupère toutes les informations des stages.
-- ------------------------------------------------

DROP VIEW IF EXISTS vListeStage;
CREATE VIEW vListeStage AS 
SELECT     Stage.Id AS 'IdStage', RaisonSociale, DescriptionStage, CompetenceRecherche, NbHeureSemaine, SalaireHoraire,
        DateDebut, DateFin, LettreEntenteVide, LettreEntenteSignee, OffreStage, IdSession,
        IdResponsable, IdSuperviseur, IdStagiaire, IdEnseignant, CONCAT(Resp.Prenom, ' ', Resp.Nom) AS 'NomResponsable',
        CONCAT(Ens.Prenom, ' ', Ens.Nom) AS 'NomEnseignant', CONCAT(Sup.Prenom, ' ', Sup.Nom) AS 'NomSuperviseur',
        CONCAT(Stagiaire.Prenom, ' ', Stagiaire.Nom) AS 'NomStagiaire', CONCAT(Sess.Periode, ' ', Sess.Annee) AS 'NomSession',
        Ent.Nom AS 'NomEntreprise', Ent.Id AS 'IdEntreprise'
FROM vStage AS Stage
JOIN vSession AS Sess
ON Sess.Id = Stage.IdSession
JOIN vEmploye AS Resp
ON Stage.IdResponsable = Resp.IdUtilisateur
JOIN vEmploye AS Ens
ON Ens.IdUtilisateur = Stage.IdEnseignant
JOIN vEmploye AS Sup
ON Sup.IdUtilisateur = Stage.IdSuperviseur
JOIN vStagiaire AS Stagiaire
ON Stagiaire.IdUtilisateur = Stage.IdStagiaire
JOIN vEntreprise AS Ent
ON Ent.Id = Sup.IdEntreprise
ORDER BY IdStage DESC;