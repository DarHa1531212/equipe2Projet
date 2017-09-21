<?php
    try
	{
		$bdd = new mysqli("dicj.info","cegepjon_p2017_2","madfpfadshdb","cegepjon_p2017_2_tests"); //Connexion a la bd au serveur.
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}

    function SelectFromView($vue){
        $select = "SELECT * FROM $vue";
    }

    for($i = 0; $i < 4; $i++){
        
        echo    '<div class="infoStagiaire slide">
                                <div class="zoneProfil">
                                        <div class="element">
                                            <div class="entete">
                                                <h2>Stagiaire</h2>
                                            </div>

                                            <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                <p>'.$i.'</p>
                                                <p>(418) 666-7777</p>
                                            </a>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Superviseur</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                    <p>Martin Mystère</p>
                                                    <p>(418) 666-7777</p>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="element">
                                            <div class="entete">
                                                <h2>Enseignant</h2>
                                            </div>

                                            <div class="infoProfil">
                                                <a class="zoneCliquable" href="ProfilEntreprise.html">
                                                    <p>Martin Mystère</p>
                                                    <p>(418) 666-7777</p>
                                                </a>
                                            </div>
                                        </div>
                                </div>

                                <div class="evaluation">
                                    <table class="table" class="tableauEvaluation">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Évaluation
                                                </th>
                                                <th>
                                                    Statut
                                                </th>
                                                <th>
                                                    Date début
                                                </th>
                                                <th>
                                                    Date limite
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Évaluation 1
                                                </td>
                                                <td>
                                                    Complétée
                                                </td>
                                                <td>
                                                    2017-09-07
                                                </td>
                                                <td>
                                                    2017-12-07
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Évaluation 2
                                                </td>
                                                <td>
                                                    Non complétée
                                                </td>
                                                <td>
                                                    2018-01-15
                                                </td>
                                                <td>
                                                    2018-03-15
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="commentaireContainer">
                                    <input class="bouton" id="boutonCommentaire" value="Écrire un commentaire" type="button"/>
                                </div>
                </div>';
        }

?>