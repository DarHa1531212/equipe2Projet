<?php

    echo '<header>
            <a href="http://dicj.info/">
                <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
            </a>
            
            <div class="userHeader" onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$idStagiaire.'&nomMenu=Profil\')">
                <p>
                    Bonjour
                    <br/>
                    '.$_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte'].'  
                </p>
            </div>
        </header>';

?>