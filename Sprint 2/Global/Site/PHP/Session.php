<?php 
   
<<<<<<< HEAD
	//include 'SessionTimeout.php';
=======
	include 'SessionTimeout.php';
>>>>>>> f919533d5dcf2dba0255e78eeaae3b5a83a12642
    if(session_id() == '' || !isset($_SESSION))
    {
        session_start();
    }
 ?>