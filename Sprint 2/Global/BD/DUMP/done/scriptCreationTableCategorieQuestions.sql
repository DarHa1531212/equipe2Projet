
--creation

CREATE TABLE tblCategorieQuestion 
(
Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
descriptionCategorie varchar(100) not null
)
ENGINE=INNODB;

--insertion

INSERT INTO tblCategorieQuestion VALUES
('MOTIVATION'),
('ATTITUDES ET COMPORTEMENT'),
('APTITUDES'),
('Éthique'),
('ADAPTABILITÉ'),
('QUALITÉ DU TRAVAIL'),
('RELATION AVEC LES AUTRES'),
('La connaissance du milieu de stage'),
('Le comportement de la ou du stagiaire'),
('Le travail de la ou du stagiaire :'),
('Le potentiel de la ou du stagiaire'),
('L\'appréciation globale');


--penser a faire une autre table tblCategorieQuestionCommentaire pour les 
--categories de questions qui ont des commentaires(Evaluation de la formation)


--Ce serait pertinent de faire une requete  qui va chercher les 
--questions dans les deux tables pour les deux types de questions
--et leurs reponses groupées par categories

--je parcour chaque categorie de questions.
--je cherche toutes les questions qui sont cette categorie