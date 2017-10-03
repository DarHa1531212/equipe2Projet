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
                <div class="content">
                    
                    <form action = "JournalBord.php" method = 'post'>
                    <div class = "nouvelleEntree">                   
                     
                        <textarea rows="5" cols="100" maxlength="500" name = "contenu"></textarea>
                    </div>  
                
                    <div class="commentaireContainer">
                       
                        <input class="bouton" type="submit" name ='submit'value = 'Confirmer'/>
                        <input class="bouton" type="button" value = 'Joindre un fichier'/>
                    </div> 
                    </form>
                    
                </div>
            </div>
            
            <div class="conteneur">
                <div class="entete" >   
                    <h1>Entrées précédentes</h1>
                </div>
                <?php
                        $host="dicj.info";
                        $user="cegepjon_p2017_2";
                        $password="madfpfadshdb";
                        $dbname="cegepjon_p2017_2_tests";
                
                
                            function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
                            {
                                $datetime1 = date_create($date_1);
                                $datetime2 = date_create($date_2);
                                $interval = date_diff($datetime1, $datetime2);
                                return $interval->format($differenceFormat);
                            }
                            

                        $con = new mysqli($host, $user, $password, $dbname)
                            or die ('Could not connect to the database server' . mysqli_connect_error());

                        //$con->close();
                $query1 = "select Dates as DateComplete from tblJournalDeBord where IdStagiaire like 17 ORDER BY  DateComplete desc limit 1;";
                       
                $result = $con->query($query1);

				if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $dateComplete = $row["DateComplete"];
                                echo  '<div class = "entree">       
                                            <h2>' .dateDifference(date('Y-m-d h:i:s'), $dateComplete).' jours depuis la dernière entrée au journal de bord</h2>
                                        </div>';
                            }
                        }

                        $query = "select  Entree, Date_Format (Dates, '%d/%m/%Y') as Dates, Dates as DateComplete from vJournalDeBord where IdStagiaire like 17 ORDER BY  datecomplete desc;";


                        $result = $con->query($query);

                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $entree = $row["Entree"];
                                $dates = $row["Dates"];
                                $dateComplete = $row["DateComplete"];

                                echo   '<div class = "content"><div class = "entree"><h2>' .  $dates . '</h2><p class = "entreeValeur">' . nl2br($entree) . '</p></div>'; 
                            }
                        }
                        else
                        {
                            ?><script>alert("Les entrées n'ont pas été trouvées...");</script><?php
                        }
                        ?>
          
                  
                    
              
                </div>                   
            </div>
        </content>
        
        <footer>
        
        </footer>
    </body>
</html>