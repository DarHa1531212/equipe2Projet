/*SELECT * FROM vquestion;
SELECT * FROM vReponse;
SELECT * FROM vReponse WHERE Id>4 AND Id<115;
*/

SELECT * FROM tblEvaluationQuestionReponse LIMIT 1000000;
UPDATE tblEvaluationQuestionReponse
SET IdReponse = 110
WHERE IdQuestion = 22;