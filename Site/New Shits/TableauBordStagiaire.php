<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width"/>
        <title>Tableau de bord - Stagiaire</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">

        <?php include 'vTableauBord.php' ?>
        
    </head>
    
    <body onload="CacherDiv()">

        <script src="../js/jquery.min.js"></script>
        <script src="../js/navigation.js"></script>
        <script src="../js/regexProfilStag.js"></script>
        <script src="../js/image.js"></script>
        <script src="../js/slideShow.js"></script>

        <?php include('Header.php'); ?>
        
        <section>

            <article class="ressources">

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
                    <a target="_blank" class="linkFill" href="../PDF/Lettre%20d\'entente%202017.docx">
                        <div class="divImage imgDOC"></div>
                        <p>Lettre d'entente</p>
                    </a>
                </div>

            </article>
            
            <div class="stagiaireContainer">

                <?php 
                    include 'TBSMain.php';
                    echo $content;
                ?>

            </div>

        </section>
        
        <?php include('Footer.php'); ?>

    </body>
    
</html>