<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width"/>
        <title>Tableau de bord - Entreprise</title>
        <link rel="sortcut icon" href="../Images/DICJIcone.PNG" type="image/x-icon"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">
    </head>
    
    <body onload="afficheFormulaire('milieuStage'); SetTimeout()">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/navigation.js"></script>
        <script src="../js/regex.js"></script>
        <script src="../js/slideShow.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/image.js"></script>
        <script src="../js/Journal.js"></script>
        <script src="../js/nicEdit.js"></script>
        <script src="../js/scriptEtatAvancement.js"></script>
        
        <header>
                <a href="http://dicj.info/">
                    <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
                </a>

                <div class="userHeader">
                    <p>
                        Bonjour FRANCK
                    </p>
                </div>

                <a href="logout.php">
                    <div class="logout">

                    </div>
                </a>

                <div class="headerTitre" style="left: calc(50% - '.$Left.'px);">
                    <h1 class = "tablinks"> Test </h1>
                </div>
        </header>
    
        <section>
            <article class="ressources">
                <div class="ressourceItem">
                    <a target="_blank" class="linkFill" href="../PDF/Cahier%20entreprise%202017.pdf">
                        <div class="divImage imgPDF"></div>
                        <p>Cahier Entreprise</p>
                    </a>
                </div>
                
                <div class="ressourceItem">
                    <a target="_blank" class="linkFill" href="../PDF/Cahier%20stagiaire%202017.pdf">
                        <div class="divImage imgPDF"></div>
                        <p>Cahier Stagiaire</p>
                    </a>
                </div>
                
                <div class="ressourceItem">
                    <a target="_blank" class="linkFill" href="../PDF/Offre%20de%20stage%202017.docx">
                        <div class="divImage imgDOC"></div>
                        <p>Offre de stage</p>
                    </a>
                </div>
                
                <div class="ressourceItem">
                    <a class="linkFill" href="../PDF/Lettre%20d'entente%202017.docx">
                        <div class="divImage imgDOC"></div>
                        <p>Lettre d'entente</p>
                    </a>
                </div>          
            </article>

            
            <div class="stagiaireContainer">

                    <div class="tab">
                      <button class="tablinks" id="menu1" onclick="afficheFormulaire('milieuStage')">Milieu de stage</button>
                      <button class="tablinks" id="menu2" onclick="afficheFormulaire('tacheEffectuee')">Tache effectuée</button>
                      <button class="tablinks" id="menu3" onclick="afficheFormulaire('projetAVenir')">Projet a venir</button>
                      <button class="tablinks" id="menu4" onclick="afficheFormulaire('reflexionPersonelle')">Reflexion personelle</button>
                    </div>
                
                    <div id="milieuStage" class="tabcontent">
                      <h3>Milieu de stage</h3>
                      <p>London is the capital city of England.</p>
                    </div>

                    <div id="tacheEffectuee" class="tabcontent">
                      <h3>Tache effectuée</h3>
                      <p>Paris is the capital of France.</p> 
                    </div>

                    <div id="projetAVenir" class="tabcontent">
                      <h3>Projet a venir</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>

                    <div id="reflexionPersonelle" class="tabcontent">
                      <h3>Reflexion personelle</h3>
                      <p>Tokyo is the capital of Japan.</p>
                    </div>

            </div>
            
            
        </section>
        
       <?php include('Footer.php'); ?>

    </body>
</html>