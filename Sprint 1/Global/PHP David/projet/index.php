<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Entreprise</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="CSS/style.css">
        <?php include 'PHP/connexionBDTest.php' ?>
        <?php include 'PHP/vProfilStagiaire.php' ?>
    </head>
    <body>
        <header>
            <aside class="left">
                <a href="http://dicj.info">
                    <img id="logo" src="Images/LogoDICJ2.png"/>
                </a>
            </aside>
            
            <div class="content">
            
            </div>
            
            <aside class="right "id="profil">
            
            </aside>
        </header>
        
        <content>
            <div class="ressource">
                <div class="entete">
                <h1>Profil Stagiaire</h1>
            </div>
                <div class = "martin">
                    <img class = "logoEntreprise" src="Images/LogoDICJ2Petit.png"/>
                    <h3 class="nom"><?php  echo $prenom . " " . $nom; ?></h3>
                    <h3 class="departement"><?php //echo $tagEvaluation; ?></h3>
                    <h4 class = "underline">Information personnelle</h4>
                    <p><?php echo $numTelMaison; ?></p>
                    <p><?php echo $numTelPersonnel; ?></p>
                    <p><?php echo $courrielPersonnel; ?></p>
                    <br/>
                    <hr/>
                    <h4 class = "underline">Informations professionnelles</h4>
                    <label><?php echo $numTelEntreprise; ?></label><label class="poste"><?php echo'Poste : ' . $poste;?></label></br>
                    <label><?php echo $courrielEntreprise; ?></label>
                    <a href="Html/ModifProfilStagiaire.html">
                        <button class="bouton">Modifier</button>
                    </a>
                </div>
            
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>