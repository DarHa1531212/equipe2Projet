SELECT Prenom,qu.Texte,re.Texte, eqr.IdReponse, ev.Id FROM tblstagiaire as s
	JOIN tblUtilisateur AS u
	ON s.IdUtilisateur = u.id
	JOIn tblStage AS st
	ON st.IdStagiaire = u.Id
	JOIN tblEvaluationStage AS es
	ON es.IdStage = st.Id
	JOIN tblEvaluation AS ev
	ON ev.Id = es.IdEvaluation
	JOIN tblevaluationquestionreponse as eqr
	ON eqr.IdEvaluation = ev.Id
	JOIN tblQuestion AS qu
	ON qu.Id = eqr.IdQuestion
	JOIN tblreponsequestion AS rq
	ON rq.IdQuestion = qu.Id
	JOIN tblreponse AS re
	ON re.Id = rq.IdReponse
		WHERE Prenom = 'Olimpia' AND re.Id = eqr.IdReponse AND ev.IdTypeEvaluation = 2 AND ev.Id = 2