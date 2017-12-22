<?php 
 
function Login ($userEmail, $password, $bdd)
{
    $userEmail = strtolower($userEmail);
    $result = $bdd->Request("   SELECT vUtilisateur.Id, vUtilisateur.Courriel, vUtilisateur.MotDePasse, vUtilisateurRole.IdRole 
                                FROM vUtilisateur join vUtilisateurRole on vUtilisateur.Id = vUtilisateurRole.IdUtilisateur  
                                where Courriel like :userEmail",
                                array("userEmail"=>$userEmail),
                                "stdClass");
    foreach($result as $entree)
    {
        $Id = $entree->Id;
        $CourrielBD = $entree->Courriel;
        $MotDePasse = $entree->MotDePasse;
        $IdRole = $entree->IdRole;
 
 
        $CourrielBD = mb_strtolower($CourrielBD);

        if (password_verify($password, $MotDePasse))
        {
            $_SESSION['idConnecte'] = $Id;
            $_SESSION['IdRole'] = $IdRole;
            if($IdRole == 2 || $IdRole == 4)
            {
                $idemp = $bdd->Request("SELECT Id FROM vEmploye WHERE IdUtilisateur = :id",
                                        array("id"=>$_SESSION['idConnecte']),
                                        "stdClass");

                foreach($idemp as $employe)
                {
                    $_SESSION['idEmploye'] = $employe->Id;
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
 