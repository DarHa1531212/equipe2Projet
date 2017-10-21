<?php

    echo '<header>
            <a href="http://dicj.info/">
                <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
            </a>
            
            <div class="userHeader" onclick="AfficherMenu('.$stagiaire['Id'].', \'Stagiaire\', \'Profil\')">
                <p>
                    Bonjour
                    <br/>
                    '.$_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte'].'  
                </p>
            </div>
        </header>';

?>