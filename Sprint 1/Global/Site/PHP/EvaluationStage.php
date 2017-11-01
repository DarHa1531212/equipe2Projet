<?php 
      include 'Session.php'; 
      include 'ConnexionBD.php';
?>


<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Évaluation des stages</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="../CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="../CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="../CSS/style-735px.css" />
    </head>

    <body onload="chargementPage()">
        <header>
            <aside class="left">
                <img id="logo" src="Images/LogoDICJ2.png"/>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right "id="profil">
                <a class="zoneCliquable" href="Profil.php">
                    <h3>Bonjour</h3>
                    <h3><?php echo $_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte']; ?></h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete">
                    <h1>Description</h1>
                </div>
                
                <p class="description">
                    La première évaluation servira à noter de façon générale l’élève stagiaire en vue d'un réajustement possible. Il serait grandement souhaitable que cette évaluation se fasse conjointement avec l’élève stagiaire et que la démarche s'effectue de façon formative. Une fois complété, le formulaire devra être remis à votre stagiaire qui se chargera de nous l'expédier. 
                </p>
            </div>
            
            <div class="conteneur">

                <div class="entete">
                    <h1>Identification</h1>
                </div>
                <?php

                    $requeteInfosEntreprise = $bdd->prepare('select En.Id, En.Nom
                                                                FROM vEntreprise as En
                                                                WHERE En.Id = 
                                                                ( 
                                                                    SELECT IdEntreprise
                                                                    FROM vEmploye
                                                                    WHERE IdUtilisateur = :IdUtilisateur
                                                                );');

                     $requeteEnseignantStage = $bdd->prepare("select Id, Nom, Prenom, NumTel
                                                from vEmploye
                                                where IdUtilisateur = (

                                                select IdEnseignant
                                                from vStage
                                                where Id = :IdStage

                                                );");

                    $requeteStagiaireStage = $bdd->prepare("select Id, Nom, Prenom, NumTel
                                                from vStagiaire
                                                where IdUtilisateur = (

                                                select IdStagiaire
                                                from vStage
                                                where Id = :IdStage

                                                );");

                    $requeteInfosEntreprise->execute(array('IdUtilisateur'=>$_SESSION['idConnecte']));

                    $requeteStagiaireStage->execute(array('IdStage'=>$_POST['IdStage']));
                    //$requeteInfosResponsableEntreprise->execute(array('idStagiaire'=>1));
                    $requeteEnseignantStage->execute(array('IdStage'=>$_POST['IdStage']));

                    $entreprises = $requeteInfosEntreprise->fetchAll();
                    $stagiaires = $requeteStagiaireStage->fetchAll();
                    //$responsablesEntreprise = $requeteInfosResponsableEntreprise->fetchAll();
                    $enseignants = $requeteEnseignantStage->fetchAll();

                    echo '<table cla/ss="table tableIdentification">
                    <tbody>
                        <tr>
                            <td class="rowTitle">
                                Organisation
                            </td>';

                    echo '<td>'.$entreprises[0]['Nom'].'</td><tr>
                            <td class="rowTitle">
                                Responsable en entreprise
                            </td><td>'.$_SESSION['PrenomConnecte'].' '.$_SESSION['NomConnecte'].'</td></tr>
                        
                        <tr>
                            <td class="rowTitle">
                                Enseignant
                            </td>
                            
                            <td>'.$enseignants[0]['Prenom'].' '.$enseignants[0]['Nom'].'</td></tr>
                        
                        <tr>
                            <td class="rowTitle">
                                Élève stagiaire
                            </td>
                            
                            <td>'.$stagiaires[0]['Prenom'].' '.$stagiaires[0]['Nom'].'</td></tr>
                            </tbody>
                        </table>';
                ?>
                

               
            </div>

           
            
            <div class="conteneur" id="conteneurEvaluation">

                <div class="entete">
                    <h1>Évaluation</h1>
                </div>

              

                <?php

                     $_SESSION['IdEvaluation'] = $_POST['IdEvaluation'];

                    $requeteTypeEvaluation = $bdd->prepare('select distinct(IdTypeEvaluation)
                                                                from vEvaluations
                                                                where IdEvaluation = :IdEvaluation;');

                    $requeteTypeEvaluation->execute(array('IdEvaluation'=>$_SESSION['IdEvaluation']));

                    $typeEvaluation =  $requeteTypeEvaluation->fetchAll();

                    if($typeEvaluation[0]['IdTypeEvaluation'] == 1)//evaluation mi-stage
                    {
                        include 'EvaluationMiStage.php';
                    }
                    else if($typeEvaluation[0]['IdTypeEvaluation'] == 2)//evaluation finale
                    {
                        include 'EvaluationFinale.php';
                    }
                    else
                    {
                        echo 'aucun type';
                    }
                ?>

            </div>

        </content>
        
        <footer>
        
        </footer>

        <script src="../js/scripts.js">

        </script>

    </body>
</html>

