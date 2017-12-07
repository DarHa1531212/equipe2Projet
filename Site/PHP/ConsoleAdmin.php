<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width"/>
        <title>Console d'administration</title>
        <link rel="sortcut icon" href="../Images/DICJIcone.PNG" type="image/x-icon"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">
    </head>
    
    <body onload="SetTimeout()">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/navigation.js"></script>
        <script src="../js/regex.js"></script>
        <script src="../js/slideShow.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/creationUtilisateur.js"></script>
        <script src="../js/supressionUtilisateur.js"></script>


        
        <?php 
            include('Header.php'); 
            AfficherHeader("Console d'administration", 185);
        ?>
    
        <section>
            
            <article class="ressources">
            </article>
            
            <div class="stagiaireContainer">
                <?php
                    include 'ConsoleAdminMain.php';
                    echo $content;
                ?>         
            </div>
            
        </section>
        
       <?php include('Footer.php'); ?>
    </body>
</html>