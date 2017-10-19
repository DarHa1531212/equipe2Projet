<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tableau de bord - Stagiaire</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/StyleHeader.css">
        <link rel="stylesheet" href="../CSS/StyleFooter.css">
        <link rel="stylesheet" href="../CSS/Style.css">
        <?php include 'vTableauBord.php' ?>
    </head>
    <body>
        <script src="Script/Script.js"></script>
        <?php include('Header.php'); ?>
        
        <section>
            <article class="ressources">
                <div class="ressourceItem">
                    <a class="linkFill" href="../PDF/Cahier%20stagiaire%202017.pdf">
                        <div class="divImage imgPDF"></div>
                        <p>Cahier Stagiaire</p>
                    </a>
                </div>
                
                <div class="ressourceItem">
                    <a class="linkFill" href="../PDF/Offre%20de%20stage%202017.docx">
                        <div class="divImage imgDOC"></div>
                        <p>Offre de stage</p>
                    </a>
                </div>
                
                <div class="ressourceItem">
                    <a class="linkFill" href="../PDF/Lettre%20d'entente%202017.docx">
                        <div class="divImage imgDOC"></div>
                        <p>Lettre d'entente</p>
                    </a>
                </div>          
            </article>
            
            <article class="stagiaire">
                <div class="infoStagiaire">
                    <h2><?php echo "$prenomStagiaire $nomStagiaire" ?></h2>
                    <input class="bouton" type="button" value="Afficher le profil"/>
                    <h3><?php echo "$telPerso" ?></h3>
                </div>
                
                <div class="blocInfo itemHover">
                    <a class="linkFill" href="TBEntreprise.html">
                        <div class="entete">
                            <h2>Enseignant</h2>
                        </div>

                        <div>
                            <p><?php echo "$prenomProf $nomProf" ?></p>
                            <p><?php echo "$telProf" ?></p>
                        </div>
                    </a>
                </div>
                
                <div class="blocInfo itemHover">
                    <a class="linkFill" href="TBEntreprise.html">
                        <div class="entete">
                            <h2>Superviseur</h2>
                        </div>

                        <div>
                            <p><?php echo "$prenomSup $nomSup" ?></p>
                            <p><?php echo "$cellSup" ?></p>
                        </div>
                    </a>
                </div>
                
                <br/><br/><br/><br/>
                
                <table>
                    <thead>
                        <th>Rapport</th>
                        <th>Statut</th>
                        <th>Date limite</th>
                        <th>Date complétée</th>
                    </thead>
                    
                    <tbody>
                        <tr class="itemHover" onclick="window.document.location='';">
                            <td>Rapport 1</td>
                            <td>Non complétée</td>
                            <td>2017-02-15</td>
                            <td></td>
                        </tr>
                        
                        <tr class="itemHover" onclick="window.document.location='';">
                            <td>Rapport 2</td>
                            <td>Complétée</td>
                            <td>2017-03-30</td>
                            <td>2017-03-25</td>
                        </tr>
                    </tbody>
                </table>
                
                <br/><br/>
                
                <table>
                    <thead>
                        <th>Autre</th>
                    </thead>
                    
                    <tbody>
                        <tr class="itemHover" onclick="window.document.location='';">
                            <td>Journal de bord</td>
                        </tr>
                        
                        <tr class="itemHover" onclick="window.document.location='';">
                            <td>Auto-Évaluation</td>
                        </tr>
                    </tbody>
                </table>
            </article>
        </section>
        
        <?php include('Footer.php'); ?>
    </body>
    
</html>