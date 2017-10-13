SELECT COUNT(q.Texte) FROM tblevaluation as ev
JOIN tblevaluationquestionreponse as evq
ON evq.IdEvaluation = ev.Id
JOIN tblquestion as q
ON q.Id = evq.IdQuestion
JOIN tblreponsequestion as rq
ON rq.IdQuestion = q.Id
 WHERE IdTypeEvaluation LIKE 1 AND ev.Id = 1