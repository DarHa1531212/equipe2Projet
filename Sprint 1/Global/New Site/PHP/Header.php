<?php

    echo '<header>
            <img class="logoHeader" src="../Images/LogoDICJ2.png"/>
            
            <div class="userHeader">
                <p>
                    Bonjour
                    <br/>
                    '.$_SESSION['PrenomConnecte'] . ' ' . $_SESSION['NomConnecte'].'  
                </p>
            </div>
        </header>';

?>