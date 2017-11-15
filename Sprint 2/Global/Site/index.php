<?php
    /*if($_SERVER["HTTPS"] != "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="sortcut icon" href="Images/DICJIcone.PNG" type="image/x-icon"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="CSS/StyleLogin.css">
        <title>Connexion</title>
    </head>
    <body>
        <section>
            <div class="wrapper">
                <div class="container">
                    <div class="content">
                        <form action="PHP/Connexion.php" method="POST">
                            <div>
                                <img src="Images/cj-logo.png">
                                <img src="Images/dicj-logo.png">
                            </div>

                            <div>
                                <p>Courriel</p>
                                <input type="email" name="Username"/>
                            </div>

                            <div>
                                <p>Mot de passe</p>
                                <input type="password" name="Password"/>
                            </div>

                            <input type="submit" value="Se connecter"/>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>