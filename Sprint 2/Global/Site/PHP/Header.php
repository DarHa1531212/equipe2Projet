<?php

    $idConnecte = "";

    if($_SESSION['IdRole'] == 5)
        $idConnecte = "idStagiaire=";
    else
        $idConnecte = "idEmploye=";

    echo '<header>
            <a href="http://dicj.info/">
                <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
            </a>
            
            <div class="userHeader" onclick="Execute(1, \'../PHP/TBNavigation.php?'.$idConnecte.$_SESSION['idConnecte'].'&nomMenu=Profil\')">
                <p>
                    Bonjour
                    <br/>
                    '.$_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte'].'  
                </p>
            </div>
            
            <a href="logout.php">
                <div class="logout">

                </div>
            </a>
            
            <div class="headerTitre">
                <h1>Tableau de bord</h1>
            </div>
        </header>';

?>