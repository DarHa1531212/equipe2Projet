<?php

    $idConnecte = "";
    $href = "'../index.php'";

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
            <div class="userHeader" onclick="window.location.replace(' . $href . ');">
                <p>
                    Déconnexion
                </p>
            </div>
        </header>'; 
?>