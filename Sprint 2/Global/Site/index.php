<?php
    if($_SERVER["HTTPS"] != "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="sortcut icon" href="Images/LogoDICJ2Petit.ico" type="image/x-icon"/>
    <title>Connexion</title>
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/Site.css">
</head>
<body>
    <div class="container-fluid portail">
        <div class="row">
            <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 col-sx-12 portail-login">
                <img class="logo-portail" src="Images/portail-logo.png" />
                
                <form action="PHP/Connexion.php" method="POST">
                    <div class="form-group">
                        <p class="col-xs-3 control-label">Courriel : </p>

                        <div class="col-xs-9">
                            <input type="text" name="Username" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="col-xs-3 control-label">Mot de passe : </p>

                        <div class="col-xs-9">
                            <input type="Password" name="Password" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/>
                                    Mémoriser le mot de passe?
                                </label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group, portail-submit">
                        <input type="submit" value="Connexion" onClick="document.location.href='PHP/Connexion.php';" class="btn btn-default" />
                    </div>
                    <p class="portail-forgotPassword">
                        <a href="index.php">Vous avez oublié votre mot de passe ?</a>
                    </p>                
                </form>
                
                <div class="portail-associes clearfix">
                    <a href="http://dicj.info">
                        <img class="col-xs-6" src="Images/dicj-logo.png" />
                    </a>
                    <a href="http://cegepjonquiere.ca">
                        <img class="col-xs-6" src="Images/cj-logo.png" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>