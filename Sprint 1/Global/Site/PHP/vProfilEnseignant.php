<?php
    
    $id = $_POST["idProf"];

    $query = $bdd->prepare("SELECT * FROM vEmployeCegep WHERE Id = :idProf");

    $query->execute(array('idProf'=>$id));
    $profs = $query->fetchAll();
    
    foreach($profs as $prof){
        $prenom = $prof["Prenom"];
        $nom = $prof["Nom"];
        $numTelPerso = $prof["NumTelCell"];
        $courrielPerso = $prof["CourrielPersonnel"];
        $codePermanent = $prof["CodePermanent"];
        $courrielProf = $prof["CourrielCegep"];
    }

?>