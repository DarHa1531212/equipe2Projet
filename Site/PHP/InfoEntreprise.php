<?php
    
    require 'ListeEntreprise.php';
    if(isset($_REQUEST["id"]))
    {
        $entreprise = $entreprises[$_REQUEST["id"]];
    }
    


    if (isset($_REQUEST["post"]))
        {
       //  var_dump($_REQUEST["id"]);
       $data = "";
    //   var_dump($_REQUEST["id"]);
    //   var_dump($entreprises);
    //   var_dump($entreprises[$_REQUEST["id"]]->Id);
        $nbStages = -1;
        $result = $bdd->Request("SELECT count(*) as 'nbStages' from vSuperviseur 
            join vStage on vStage.IdSuperviseur = vSuperviseur.IdUtilisateur
            where IdEntreprise = :id;", array('id'=>$entreprises[$_REQUEST["id"]]->Id),'stdClass');
                foreach($result as $resultat){
                   $nbStages =  $resultat->nbStages;
                }
        
 
          //  var_dump($nbStages);
 
            if ($nbStages == 0)
            {
                $data =$entreprises[$_REQUEST["id"]]->Id;
                $stage = array();
                $result = $bdd->Request(" DELETE FROM tblEntreprise WHERE Id = :id;",
                    array('id'=>$data),'stdClass');
                echo'l\'entreprise a été suprimée';
             }

            else {
                echo'l\'entreprise est liée à un stage et ne peut pas être supprimée';
            }
            
       }
   
    else {
              // var_dump($entreprise->getId());

            $content =
        '
        <article class="stagiaire">
            <div class="infoStagiaire">
                <h2>Consultation de l\'Entreprise</h2>
                <input class="bouton" type="button" value="Modifier" onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?&nomMenu=ModifEntreprise.php&id='.$_REQUEST["id"].'\')"/>
            </div>

            <div class="separateur">
                <h3>Information de l\'entreprise</h3>
            </div>

            <div class="blocInfo infoProfil">
                <div class="champ">
                    <p class="label labelForInput">Nom</p>
                    <p class="value">'.$entreprise->getNom().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Courriel</p>
                    <p class="value">'.$entreprise->getCourriel().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">No. Téléphone</p>
                    <p class="value">'.$entreprise->getNumTel().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Ville</p>
                    <p class="value">'.$entreprise->getVille().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">No. Civique</p>
                    <p class="value">'.$entreprise->getNumCivique().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Rue</p>
                    <p class="value">'.$entreprise->getRue().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Province</p>
                    <p class="value">'.$entreprise->getProvince().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Code Postal</p>
                    <p class="value">'.$entreprise->getCodePostal().'</p>
                </div>
                <div class="champ">
                    <p class="label labelForInput">Logo</p>
                    <p class="value">'.$entreprise->getLogo().'</p>
                </div>
                
                <br/><br/>
            </div>
            
            <br/><br/>
            
            <input class="bouton" type="button" style="width: 100px;" value="   Retour   " onclick="Requete(AfficherPage, \'../PHP/TBNavigation.php?nomMenu=ListeEntreprise.php\')"/>
           

            <input class="bouton" type="button" id="Save" style="width: 100px;" value="  Supprimer  "   onclick= "Requete(ExecuteQuery,\'../PHP/TBNavigation.php?nomMenu=InfoEntreprise.php\',\'&id=\','.$_REQUEST["id"].',\'&post=\',true)" />

           <!-- \'../PHP/TBNavigation.php?nomMenu=InfoEntreprise.php\',\'&idEntreprise =\','.$entreprise->getId().'\')"/> -->



                
        </article>
        ';
        
        return $content;
    }

    

    

    function suprimerEntreprise($bdd, $idEntreprise)
    { 
      echo "i'm in";
      /*$entreprise = $entreprises[$_REQUEST["id"]];
      $data = [$_REQUEST["id"];
      $idEntreprise = $data; */

    }

    function verifierStagesLies($bdd, $idEntreprise)
    {

    }

?>




