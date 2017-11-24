<?php 
   
	include 'SessionTimeout.php';

    if(session_id() == '' || !isset($_SESSION))
    {
        session_start();
    }
 ?>