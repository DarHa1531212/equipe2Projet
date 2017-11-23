<?php 
    /********************************************************************
    * Nom: Hans Darmstadt-Bélanger                                      *
    * Date: 19 Octobre 2017                                             *
    * But: logout automatique d'innactivité pour 10 minutes ou plus     *
    * et vérifier si un utilisateur est autorisé à accéder à une page   *
    *********************************************************************/

    function verifyTimeout()
    {
        if (isset($_SESSION['last_click_time']) && (time() - $_SESSION['last_click_time'] > 10)) 
        {
            header("Location: logout.php");
        }
        else
        {
            $_SESSION['last_click_time'] = time();
        }
    }

    function verifyAuthorisations($expectedId)
    {
        $accessGranted = false; 
        $sizeOfArray = sizeof($expectedId);

        for ($i = 0; $i < $$sizeOfArray; $i ++)
        {
            if($expectedId[$i] == $_SESSION['IdRole'])
            {
              $accessGranted = true; // if the current session is the same as one of the autorised sessions, acess is granted
              return true;
            }
        }

        if ($accessGranted == false)
        {
          echo "You do not have access to this page"; //if access is still not granted at the end of the loop, return an error message
        }
    }
?>