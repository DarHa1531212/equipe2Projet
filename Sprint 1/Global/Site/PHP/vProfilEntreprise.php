<?php

    $query = $bdd->prepare("SELECT Logo, Nom, NumTel, CourrielEntreprise, NumCivique, Rue, Ville, Province FROM vEntreprise WHERE CourrielEntreprise = '1'");

    $query->execute();
    $entreprises = $query->fetchAll();
    
    foreach($entreprises as $entreprise){
        $logoEntreprise = $entreprise["Logo"]; //Initialisation des variables a afficher dans les balises.
        $nomEntreprise = $entreprise["Nom"]; //Nom de l'entreprise.
        $numTelEntreprise = $entreprise["NumTel"];
        $courrielEntrepriseEnt = $entreprise["CourrielEntreprise"];
        $numCivique = $entreprise["NumCivique"];
        $rue = $entreprise["Rue"];
        $ville = $entreprise["Ville"];
        $province = $entreprise["Province"];
    }

?>