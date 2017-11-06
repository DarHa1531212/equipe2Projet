SELECT * FROM vquestion;
SELECT * FROM vReponse;
SELECT * FROM vReponse WHERE Id>4 AND Id<115;

UPDATE tblEvaluationQuestionReponse
SET IdReponse = 5
WHERE IdQuestion = 1;