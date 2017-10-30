<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Stagiaire</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">
        <?php include 'vTableauBord.php' ?>
    </head>
    <body>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/navigation.js"></script>
        <script src="../js/regexProfilStag.js"></script>
        <script src="../js/image.js"></script>
        
        <?php include('Header.php'); ?>
        
        <section>
            <article class="stagiaire">
                <?php 
                    include 'TBSMain.php';
                    echo $content;
                ?>
            </article>
        </section>
        
        <?php include('Footer.php'); ?>
    </body>
    
</html>