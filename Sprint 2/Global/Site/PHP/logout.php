<?php

    session_destroy();
    header("Location: ../index.php");
    echo '<script>alert("Vous avez été déconnecté.");</script>'

?>