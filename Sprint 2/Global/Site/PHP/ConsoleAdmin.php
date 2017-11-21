<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width"/>
        <title>Tableau de bord - Entreprise</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">
        <?php include 'vTableauBord.php' ?>
    </head>
    
    <body onload="CacherDiv('stagiaire')">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/navigation.js"></script>
        <script src="../js/regexProfilStag.js"></script>
        <script src="../js/slideShow.js"></script>
        <script src="../js/scripts.js"></script>
        
        <?php include('Header.php'); ?>
    
        <section>
            
            <div class="stagiaireContainer">
                <?php 
                    include 'TBEMain.php';
                    echo $content;
                ?>
            </div>
            
        </section>
        
       <?php include('Footer.php'); ?>
    </body>
</html>