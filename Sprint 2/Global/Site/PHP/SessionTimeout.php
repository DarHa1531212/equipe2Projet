<?php 
		/********************************************************************
		* Nom: Hans Darmstadt-Bélanger                                      *
		* Date: 19 Octobre 2017                                             *
		* But: logout automatique d'innactivité pour 10 minutes ou plus     *
		* et vérifier si un utilisateur est autorisé à accéder à une page   *
		*********************************************************************/
		function verifyTimeout()
		{
				if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5))
				{
					session_unset();     // unset $_SESSION variable for the run-time 
					session_destroy();   // destroy session data in storage
					header("Location: ..");
        			exit();
					return false; // the user is no longer authenticated
				}
				else
				{
					$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
					return true; //indicates that the user is still authenticated
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