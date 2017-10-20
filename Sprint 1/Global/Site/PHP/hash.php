
<?php
//session_start();

$_SESSION['Username'] = strtolower($username);

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
    $query->execute(array("userEmail"=>$userEmail));
    $result = $query->fetchall();
    foreach($result as $entree)
    {
        $Id = $entree["Id"];
        $CourrielBD = $entree["Courriel"];
        $MotDePasse = $entree["MotDePasse"];
        $IdRole = $entree["IdRole"];


        $CourrielBD = mb_strtolower($CourrielBD);

        if (password_verify($password, $MotDePasse))
        {
            $_SESSION['idConnecte'] = $Id;
            $_SESSION['IdRole'] = $IdRole;
            if($IdRole == 2 || $IdRole == 4)
            {
                $query = $bdd->prepare("SELECT Id FROM vEmploye WHERE IdUtilisateur = :id");
                $query->execute(array('id'=>$_SESSION['idConnecte']));
                $idemp = $query->fetchAll();

                foreach($idemp as $employe)
                {
                    $_SESSION['idEmploye'] = $employe['Id'];
                }
            }
            return true;
        } 
        else
        {
            return false;
        }
    }
}

?>
