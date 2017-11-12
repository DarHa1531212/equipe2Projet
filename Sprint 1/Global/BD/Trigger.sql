
-- USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
 USE bdprojet_equipe2v2;
DROP Trigger IF EXISTS After_Insert_Stage;

DELIMITER //

CREATE TRIGGER After_Insert_Stage AFTER INSERT
ON tblStage 
FOR EACH ROW
	BEGIN
-- -------------------------------------------------
		SET @IdStage = new.Id;
		SET @IdEvaluation = (SELECT COUNT(*) FROM vEvaluation);
		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('1', ' 2017-10-20 ', ' 2018-04-04 ',NULL,1);
		INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IdEvaluation+1,@IdStage);
		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('1', ' 2017-10-20 ', ' 2018-04-04 ',NULL,2);
		INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IdEvaluation+2,@IdStage);
		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('1', ' 2017-10-20 ', ' 2018-04-04 ',NULL,3);
		INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IdEvaluation+3,@IdStage);
		

-- -------------------------------------------------
END//	

DELIMITER ;
INSERT IGNORE INTO `tblStage` (`IdResponsable`,`IdSuperviseur`,`IdStagiaire`,`IdEnseignant`) VALUES (101,51,1,131);

SELECT * FROM vStage;
SELECT COUNT(*) FROM vevaluation;