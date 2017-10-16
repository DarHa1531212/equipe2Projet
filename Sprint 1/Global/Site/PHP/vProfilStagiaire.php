<?php

    $id = $_SESSION['idConnecte'];

	$query = $bdd->prepare("SELECT * FROM vStagiaire WHERE Id = :idStagiaire"); //Les ':' servent à mettre un paramètre dans ce cas le paramètre c'est idStagiaire.

    $query->execute(array('idStagiaire'=>$id)); //Lorsqu'on éxecute le query ont peut préciser la valeur des paramètres à l'aide d'un tableau associatif. idStagiaire = à la valeur de la variable $id.
    $stagiaires = $query->fetchAll(); //la fonction fetchAll() met les valeurs du query dans une liste d'objets. J'ai donc fait une liste $stagiaires.
    
    foreach($stagiaires as $stagiaire){ //Puisque $stagiaires est une liste je peux faire une boucle foreach pour récupérer les données.
        $idStagiaire = $stagiaire['Id'];
        $prenomStagiaire = $stagiaire["Prenom"]; //Comme un $stagiaire est un objet je peux récupérer leur valeur de la même manière qu'avec $row['propriété'].
        $nomStagiaire = $stagiaire["Nom"];
        $numTelMaisonStagiaire = $stagiaire["NumTelMaison"];
        $numTelPersonnelStagiaire = $stagiaire["NumTelPersonnel"];
        $courrielPersonnelStagiaire = $stagiaire["CourrielPersonnel"];
        $numTelEntrepriseStagiaire = $stagiaire["NumTelEntreprise"];
        $posteStagiaire = $stagiaire["Poste"];
        $courrielEntrepriseStagiaire = $stagiaire["CourrielEntreprise"];
        $courrielScolaireStagiaire = $stagiaire["CourrielScolaire"];
    }

?>