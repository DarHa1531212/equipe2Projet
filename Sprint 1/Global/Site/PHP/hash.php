
<?php

 try{
    $bdd = new PDO('mysql:host=dicj.info;dbname=cegepjon_p2017_2_dev', 'cegepjon_p2017_2', 'madfpfadshdb');
    $bdd->exec("SET NAMES 'utf8';");
    }
    catch(Exception $e)
    {
      echo "erreur de BD";
        die('Erreur : ' .$e->getMessage());
    }

$userEmail = "Bouchard.Olga@etu.cegepjonquiere.ca";
$userEmail = strtolower($userEmail);
Login($userEmail, "motpasse", $bdd);

function SetPassword ($userEmail, $password)
{
    echo "Set Password function";
}

function Login ($userEmail, $password, $bdd)
{
    $userEmail = strtolower($userEmail);
    $query = $bdd->prepare("SELECT Id, Courriel, MotDePasse FROM vUtilisateur where Courriel like '$userEmail' ");
    $query->execute(array());
    $result = $query->fetchall();
    foreach($result as $entree)
    {
        $Id = $entree["Id"];
        $CourrielBD = $entree["Courriel"];
        $MotDePasse = $entree["MotDePasse"];

        echo gettype($CourrielBD), "\n";
        $CourrielBD = mb_strtolower($CourrielBD);
        echo $CourrielBD;   



        if (password_verify($password, $MotDePasse)) {
        echo 'Password is valid!';
        } else {
        echo 'Invalid password.';
        }
    }
}

?>
