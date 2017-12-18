
-- USE cegepjon_p2017_2_dev;
 USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;
-- USE bdprojet_equipe2v2;
DROP TRIGGER IF EXISTS After_Insert_Stage;

DELIMITER //

CREATE TRIGGER After_Insert_Stage AFTER INSERT
ON tblStage 
FOR EACH ROW
	BEGIN
-- -------------------------------------------------
		SET @IDSTAGE = new.Id;
		SET @IDEVALUATION = (SELECT COUNT(*) FROM vEvaluation);
		SET @IDETATAVANCEMENT = (SELECT COUNT(*) FROM vEtatAvancement);



		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('0', ' 2017-10-20 ', ' 2018-04-04 ',NULL,1);
			INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IDEVALUATION+1,@IDSTAGE);
				SET @X =  23;
					WHILE @X < 57 DO
					INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (@X,1,@IDEVALUATION+1);
					SET @X=@X+1;
					END WHILE ;
				-- INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (67,115,@IDEVALUATION+1);
		

		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('0', ' 2017-10-20 ', ' 2018-04-04 ',NULL,2);
			INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IDEVALUATION+2,@IDSTAGE);
				SET @X =  1;
					WHILE @X < 23 DO
					INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (@X,(@X*5),@IDEVALUATION+2);
					SET @X=@X+1;
					END WHILE ;
				-- INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (66,115,@IDEVALUATION+2);


		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('0', ' 2017-10-20 ', ' 2018-04-04 ',NULL,3);
			INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IDEVALUATION+3,@IDSTAGE);
				SET @X =  57;
					WHILE @X < 66 DO
					INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (@X,1,@IDEVALUATION+3);
					SET @X=@X+1;
					END WHILE ;
		INSERT INTO `tblEvaluation` (`Statut`,`DateDébut`,`DateFin`,`DateComplétée`,`IdTypeEvaluation`) VALUES ('0', ' 2017-10-20 ', ' 2018-04-04 ',NULL,4);
			INSERT IGNORE INTO `tblEvaluationStage` (`IdEvaluation`,`IdStage`) VALUES (@IDEVALUATION+4,@IDSTAGE);
				SET @X =  23;
					WHILE @X < 57 DO
					INSERT IGNORE INTO `tblEvaluationQuestionReponse` (`IdQuestion`,`IdReponse`,`IdEvaluation`) VALUES (@X,1,@IDEVALUATION+4);
					SET @X=@X+1;
					END WHILE ;
		INSERT INTO `tblEtatAvancement` (`Statut`,`IdStage`,`IdTypeEtatAvancement`) VALUES('0',@IDSTAGE,1);
			INSERT INTO `tblEtatAvancementJanvier`(`Id`) VALUES (@IDETATAVANCEMENT+1);
            
		INSERT INTO `tblEtatAvancement` (`Statut`,`IdStage`,`IdTypeEtatAvancement`) VALUES('0',@IDSTAGE,2);
			INSERT INTO `tblEtatAvancementFevrier`(`Id`) VALUES (@IDETATAVANCEMENT+2);
            
		INSERT INTO `tblEtatAvancement` (`Statut`,`IdStage`,`IdTypeEtatAvancement`) VALUES('0',@IDSTAGE,3);
			INSERT INTO `tblEtatAvancementMars`(`Id`) VALUES (@IDETATAVANCEMENT+3);
		
		

-- -------------------------------------------------
END//	




DELIMITER ;
DROP TRIGGER IF EXISTS After_Insert_Entreprise;

DELIMITER //
CREATE TRIGGER After_Insert_Entreprise BEFORE INSERT
ON tblEntreprise 
FOR EACH ROW
	BEGIN
-- -------------------------------------------------
		SET new.Logo = CONCAT('Entreprises/',new.Nom,new.NumCivique);
-- -------------------------------------------------
END//	

DELIMITER ;
