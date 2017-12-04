<?php

    function AfficherHeader($Entete, $Left){
        echo '<header>
                <a href="http://dicj.info/">
                    <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
                </a>

                <div class="userHeader" onclick="Execute(1, \'../PHP/TBNavigation.php?id='.$_SESSION['idConnecte'].'&nomMenu=Profil.php\')">
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

                <div class="headerTitre" style="left: calc(50% - '.$Left.'px);">
                    <h1>'.$Entete.'</h1>
                </div>
            </header>';
    }

?>