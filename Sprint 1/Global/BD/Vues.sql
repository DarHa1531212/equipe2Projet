 USE BDProjet_equipe2V2;
-- USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
-- ------------------------------------------------
-- Récupère toutes les évaluations des stagiaires selon leur ID et le type d'évaluation avec leurs réponses choisies.
-- ------------------------------------------------
DROP VIEW IF EXISTS vEvaluationCompletee;
CREATE VIEW vEvaluationCompletee AS 
SELECT Stagiaire.Id AS IdStagiaire, Prenom, Nom, Eval.Id AS IdEvaluation, 
TypeEval.Titre AS Evaluation, Question.Texte AS Question, EQR.IdReponse, Reponse.Texte AS Reponse
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
JOIN vReponse AS Reponse
ON Reponse.Id = EQR.IdReponse
WHERE IdStagiaire = 2 AND TypeEval.Id = 1;

-- ------------------------------------------------
-- Sélectionne tous les enseignants.
-- ------------------------------------------------
DROP VIEW IF EXISTS vEnseignant;
CREATE VIEW vEnseignant AS 
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdEnseignant, Prenom, Nom, NumTel, CourrielPersonnel, IdEntreprise, NumTelEntreprise, Poste, CourrielEntreprise, CodePermanent
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
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdGestionnaire, Prenom, Nom, NumTel, CourrielPersonnel, IdEntreprise, NumTelEntreprise, Poste, CourrielEntreprise, CodePermanent
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
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdResponsable, Prenom, Nom, NumTel, CourrielPersonnel, IdEntreprise, NumTelEntreprise, Poste, CourrielEntreprise
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
SELECT Util.Id AS IdUtilisateur, Emp.Id AS IdSuperviseur, Prenom, Nom, NumTel, CourrielPersonnel, IdEntreprise, NumTelEntreprise, Poste, CourrielEntreprise
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
SELECT 	Stagiaire.Id, Stagiaire.Prenom, Stagiaire.Nom, Stagiaire.NumTelPersonnel,
		Enseignant.IdEnseignant AS 'Id Enseignant', Enseignant.Prenom AS 'Prenom Enseignant', Enseignant.Nom AS 'Nom Enseignant', Enseignant.NumTel AS 'Tel Enseignant',
        Sup.IdSuperviseur AS 'Id Superviseur', Sup.Prenom AS 'Prenom Superviseur', Sup.Nom AS 'Nom Superviseur', Sup.NumTel AS 'Tel Superviseur'
FROM vStage AS Stage
JOIN vStagiaire AS Stagiaire
ON Stagiaire.IdUtilisateur = Stage.IdStagiaire
JOIN vEnseignant AS Enseignant
ON Enseignant.IdUtilisateur = Stage.IdEnseignant
JOIN vSuperviseur AS Sup
ON Sup.IdUtilisateur = Stage.IdSuperviseur;

-- ------------------------------------------------
-- Sélectionne les informations globales sur les évaluations de chaque stagiaire
-- ------------------------------------------------
DROP VIEW IF EXISTS vInfoEvalGlobale;
CREATE VIEW vInfoEvalGlobale AS
SELECT IdStagiaire, Titre, Statut, DateLimite, DateComplétée
FROM vStage AS Stage
JOIN vEvaluationStage AS ES
ON Stage.Id = ES.IdStage
JOIN vEvaluation AS Eval
ON Eval.Id = ES.IdEvaluation
JOIN vTypeEvaluation AS TE
ON TE.Id = Eval.IdTypeEvaluation;