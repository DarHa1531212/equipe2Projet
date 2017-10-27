<?php

$content =
'<div class="infoStagiaire">
                    <h2>Votre profil</h2>
                </div>
                
                <div class="separateur">
                    <h3>Informations Personnelles</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Prenom :</p>
                            <input type="text" value="'.$prenom.'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">Nom :</p>
                            <input type="text" value="'.$nom.'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">No. Téléphone :</p>
                            <input type="text" value="'.$numTel.'" id="numTel" name="numTel" class="value" onkeyup="RegexProfilStagiaire()"/>
                            <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                        </div>
                    
                        <div class="champ">
                            <p class="label labelForInput">Courriel :</p>
                            <input type="email" value="'.$courrielPerso.'" id="courrielPersonnel" name="courrielPersonnel" class="value" onkeyup="RegexProfilStagiaire()"/>
                        </div>
                </div>
                
                <div class="separateur">
                    <h3>Informations Professionnelles</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Entreprise :</p>
                            <input type="text" value="'.$entreprise.'" class="value" disabled/>
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">Courriel :</p>
                            <input type="email" value="'.$courrielEntreprise.'" id="courrielEntreprise" name="courrielEntreprise" class="value" onkeyup="RegexProfilStagiaire()"/>
                            
                        </div>
                        
                        <div class="champ">
                            <p class="label labelForInput">No. Téléphone :</p>
                            <input type="text" value="'.$numTelEntreprise.'" id="numEntreprise" name="numEntreprise" class="value" onkeyup="RegexProfilStagiaire()"/>
                            <img class="info" src="../Images/info.png" title="Le numéro de téléphone doit
avoir ce format - (xxx) xxx-xxxx"/>
                        </div>
                    
                        <div class="champ">
                            <p class="label labelForInput">Poste :</p>
                            <input type="text" value="'.$poste.'" id="poste" class="value" onkeyup="RegexProfilStagiaire()"/>
                        </div>
                </div>
                
                <div class="separateur">
                    <h3>Sécurité</h3>
                </div>
                
                <div class="blocInfo infoProfil">
                        <div class="champ">
                            <p class="label labelForInput">Nouveau mot de passe :</p>
                            <input type="password" id="newPwd" class="value"/>
                            <img class="info" src="../Images/info.png" title="Le mot de passe doit contenir
- 8 caractères minimum
- Au moins une majuscule
- Au moins un chiffre(0-9)"/>
                        </div>

                        <div class="champ">
                            <p class="label labelForInput">Confirmer le mot de passe :</p>
                            <input type="password" id="confirmationNewPwd" class="value"/>
                        </div>
                </div>
                
                <br/><br/>
                
                <input class="bouton" type="button" style="width: 100px;" value="   Annuler   " onclick="Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>
                <input class="bouton" type="button" id="Save" style="width: 100px;" value="Sauvegarder" onclick="Execute(2, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=ModifBD\', \'&Poste=\', poste.value, \'&NumTel=\', numTel.value, \'&NumTelEntreprise=\', numEntreprise.value, \'&CourrielEntreprise=\', courrielEntreprise.value, \'&CourrielPersonnel=\', courrielPersonnel.value); Execute(1, \'../PHP/TBNavigation.php?idStagiaire='.$id.'&nomMenu=Main\')"/>';

return $content;

?>