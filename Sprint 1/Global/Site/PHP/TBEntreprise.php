<?php include 'Session.php'; ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Entreprise</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1240px)" href="../CSS/style-1240px.css" />
        <link rel="stylesheet" media="screen and (max-width: 1040px)" href="../CSS/style-1040px.css" />
        <link rel="stylesheet" media="screen and (max-width: 735px)" href="../CSS/style-735px.css" />
    </head>
    <body>
        <script src="../js/scripts.js"></script>
        <header>
            <aside class="left">
                <a href="http://dicj.info">
                    <img id="logo" src="../Images/LogoDICJ2.png"/>
                </a>
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
                    <h1>Ressources</h1>
                </div>
                
                <ul class="item">
                    <li><a href="../PDF/Offre%20de%20stage%202017.docx">Offre de stage 2017.docx</a></li>
                    <li><a href="../PDF/Cahier%20entreprise%202017.pdf">Cahier entreprise 2017.pdf</a></li>
                    <li><a href="../PDF/Cahier%20stagiaire%202017.pdf">Cahier stagiaire 2017.pdf</a></li>
                    <li><a href="../PDF/Lettre%20d'entente%202017.docx">Lettre d'entente 2017.docx</a></li>
                </ul>
            </div>
            
            <div class="conteneur">
                <div class="entete">
                    <h1>Stagiaires</h1>
                </div>
                
                
                <div class="slideContainerAsides">
                    <input class="asideButtons" id="btnPrecedent" type="button" onclick="SlideMove(this)"/>
                
                    <div id="slideContainer">
                        <?php include 'stagiaireSlideShow.php';?>
                    </div>
                    
                    <input class="asideButtons" id="btnSuivant" type="button" onclick="SlideMove(this)"/>
                    
                </div>
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>