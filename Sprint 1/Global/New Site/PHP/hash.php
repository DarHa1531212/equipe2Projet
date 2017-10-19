
<?php

include 'ConnexionBD.php';

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
