
<?php
//session_start();

<<<<<<< HEAD
$_SESSION['Username'] = "Bouchard.Olga@etu.cegepjonquiere.ca";
$_SESSION['Username'] = strtolower($_SESSION['Username']);
=======
include 'ConnexionBD.php';

$userEmail = "Bouchard.Olga@etu.cegepjonquiere.ca";
$userEmail = strtolower($userEmail);
Login($userEmail, "motpasse", $bdd);
>>>>>>> Francis

function SetPassword ($userEmail, $newPassword, $bdd)
{
    $sessionID = 3; 
    $newPassword = password_hash("newPassword", PASSWORD_DEFAULT);

    $query = $bdd->prepare("update cegepjon_p2017_2_dev.tblUtilisateur set MotDePasse = '$newPassword' where Id like '$sessionID';");
    $query->execute();
}

function Login ($userEmail, $password, $bdd)
{
    $userEmail = strtolower($userEmail);
    $query = $bdd->prepare("SELECT vUtilisateur.Id, vUtilisateur.Courriel, vUtilisateur.MotDePasse, vUtilisateurRole.IdRole FROM vUtilisateur join vUtilisateurRole on vUtilisateur.Id = vUtilisateurRole.IdUtilisateur  where Courriel like :userEmail");
    $query->execute(array("userEmail"=>$_SESSION['Username']));
    $result = $query->fetchall();
    foreach($result as $entree)
    {
        $Id = $entree["Id"];
        $CourrielBD = $entree["Courriel"];
        $MotDePasse = $entree["MotDePasse"];
        $IdRole = $entree["IdRole"];


        $CourrielBD = mb_strtolower($CourrielBD);

        if (password_verify($password, $MotDePasse)) {
       $_SESSION['idConnecte'] = $Id;
       $_SESSION['IdRole'] = $IdRole;
       
        return true;
        } else {
        return false;
        }
    }
}

?>
