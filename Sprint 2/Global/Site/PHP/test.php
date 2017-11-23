<?php
    
    function test(){
        if (isset($_SESSION['last_click_time']) && (time() - $_SESSION['last_click_time'] > 10)) 
        {
            header("Location: logout.php");
        }
        else
        {
            $_SESSION['last_click_time'] = time();
        }
    }
    
    test();
?>