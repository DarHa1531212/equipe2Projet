<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Journal de bord - Étudiant</title>
        <link rel="stylesheet" href="../CSS/styleJournal.css">
        <link rel="shortcut icon" href="../Images/LogoDICJ2Petit.ico">

    </head>
    
    <body>
        <header>
            <aside class="left">
                <a href="http://dicj.info">
                    <img id="logo" src="../Images/LogoDICJ2.png"/>
                </a>
            </aside>
            
            <div class="conteneur">
            
            </div>
            
            <aside class="right "id="profil">
                <a class="zoneCliquable" href="ProfilStagiaire.php">
                    <h3>Bonjour</h3>
                    <h3>Martin Mystère</h3>
                </a>
            </aside>
        </header>
        
        <content>
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Journal de bord</h1>
                </div>
                
                <form action = "JournalBord.php" method = 'post'>
                    <div class = "nouvelleEntree">                   
                        <textarea rows="5" cols="100" maxlength="500" name = "contenu"></textarea>
                    </div>  

                    <div class="commentaireContainer">
                        <input class="bouton" type="submit" name ="submit" value = "Confirmer"/>
                        <input type="hidden" name="idStagiaire" value="<?php echo $idStagiaire; ?>"/>
                        <input class="bouton" type="button" value = 'Joindre un fichier'/>
                    </div> 
                </form>
            </div>
            
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Entrées précédentes</h1>
                </div>
                
                <div class="content">
                
                <?php       
                        try
                        {
                            $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_tests', 'cegepjon_p2017_2', 'madfpfadshdb',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                        }
                        catch(Exception $e)
                        {
                            die('Erreur : ' .$e->getMessage());
                        }
                
                        function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
                        {
                            $datetime1 = date_create($date_1);
                            $datetime2 = date_create($date_2);
                            $interval = date_diff($datetime1, $datetime2);
                            return $interval->format($differenceFormat);
                        }
                
                        $query = $bdd->prepare("SELECT Dates AS DateComplete FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY datecomplete DESC LIMIT 1;");
                        $query2 = $bdd->prepare("SELECT  Entree, Date_Format (Dates, '%d/%m/%Y') AS Dates, Dates AS DateComplete FROM vJournalDeBord WHERE IdStagiaire LIKE $idStagiaire ORDER BY  datecomplete DESC;");
                        
                        $query->execute(array());
                        $result = $query->fetchall();
                        
                        foreach($result as $dateEntree)
                        {
                            $dateComplete = $dateEntree["DateComplete"];
                            echo   '<div class = "entree"><h2>' .dateDifference(date('Y-m-d h:i:s'), $dateComplete).' jour(s) depuis la dernière entrée au journal de bord</h2></div>';
                        }

                        
                        $query2->execute(array());
                        $result = $query2->fetchAll();

                        foreach($result as $entree)
                        {
                            $texte = $entree["Entree"];
                            $dates = $entree["Dates"];
                            $dateComplete = $entree["DateComplete"];

                            echo   '<div class = "entree"><h2>' .  $dates . '</h2><p class = "entreeValeur">' . nl2br($texte) . '</p></div>'; 
                        }
                    ?>
                </div>
            </div>                   
           
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>