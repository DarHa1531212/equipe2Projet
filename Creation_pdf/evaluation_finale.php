
<?php
require('fpdf.php');// Connexion et recherche de données
$base = new PDO('mysql:host=localhost; dbname=bdprojet_equipe2V2', 'root', '');
$retour = $base->query("SELECT * FROM vEvaluationCompletee WHERE IdStagiaire = 15 AND TypeEvaluation = 2;");
$x = 0;
while ($data = $retour->fetch()){
    $prenoms[$x] = $data['Prenom'];
    $noms[$x] = $data['Nom'];
    $evaluations[$x] = $data['Evaluation'];
    $questions[$x] = $data['Question'];
    $reponses[$x] = $data['IdReponse'];
    $enseignants[$x] = $data['Enseignant']; 
    $responsables[$x] = $data['Responsable']; 
    $superviseurs[$x] = $data['Superviseur']; 
    $entreprises[$x] = $data['Entreprise']; 
    $lettres[$x] = $data['Lettre'];
    $descriptionCategories[$x] = $data['DescriptionCategorie'];
    $titreCategories[$x] = $data['TitreCategorie'];
    $texteReponses[$x] =$data['Reponse'];
    $competences[$x] = $data['Competence'];
    $x++;
} 
$retour = $base->query("SELECT * FROM vReponse WHERE Id>4 AND Id<115;");
$x = 0;
while ($data = $retour->fetch()){
    $texteToutesReponses[$x] = $data['Texte'];
    $x++;
} 
// class pdf
class PDF extends FPDF
{  
   
    private function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
    {
        // Store reset values for (x,y) positions
        $x = $this->GetX() + $w;
        $y = $this->GetY();

        // Make a call to FPDF's MultiCell
        $this->MultiCell($w,$h,$text,$border,$align,$fill);

        // Reset the line position to the right, like in Cell
        if( $ln==0 )
        {
            $this->SetXY($x,$y);
        }
    }
        public $angle = 0; 

    // En-tête
    function Header()
    {
        global $prenoms;
        global $noms;
        global $evaluations;
        global $entreprises;
        global $responsables;
        global $enseignants;
        $this->Image('logo.png',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,$evaluations[0].' de '.$prenoms[0]. ' '.$noms[0],0,0,'C');
        $this->Ln(20);
         if($this->PageNo()==1)
        {   
            $this->SetFillColor(54,95,145);
            $this->Cell(0,4,'',1,1,'C',true);
            $this->SetFillColor(221,217,195);
            $this->Cell(0,8,'IDENTIFICATION',1,1,'C',true);
            $this->Cell(70,20,'Organisation',1,0,'C',true);
            $this->Cell(100 ,20,$entreprises[0],1,1,'C');
            $this->Cell(70,20,'Responsable technique',1,0,'C',true);
            $this->Cell(100 ,20,$responsables[0],1,1,'C');
            $this->Cell(70,20,utf8_decode('Responsable pédagogique'),1,0,'C',true);
            $this->Cell(100 ,20,$enseignants[0],1,1,'C');
            $this->Cell(70,20,utf8_decode('Élève stagiaire'),1,0,'C',true);
            $this->Cell(100 ,20,$prenoms[0].' '.$noms[0],1,1,'C');
            $this->SetFillColor(54,95,145);
            $this->Cell(0,4,'',1,1,'C',true);
        }   
    }
    //Pied de page qui compte les pages
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function TableauQuestion($lettrefor=0,$lettreMax=0,$xfor = 0,$xmax =4,$lettre = 0){
        global $reponses;
        global $questions;
        global $lettres;
        global $descriptionCategories;
        global $titreCategories;
        global $texteReponses;
        global $competences;
        global $texteToutesReponses;        
        
        $this->SetFont('Times','B',15);
        $this->Cell(0,5,$lettres[$lettre].'.   '.$titreCategories[$lettre],0,1);
        $this->SetFont('Times','',12);
        $x=$xfor;   
        for($y=$lettrefor;$y<=$lettreMax;$y++){
            $texte = $questions[$y];
            $this->Cell(10,10,'',0,0);
            $this->SetFillColor(221,217,195);
            $this->SetFont('Times','B',12);
            if ($competences[$y] != $questions[$y]){
                $texte = $competences[$y].'. '.$questions[$y];
                if($competences[$y] == '')
                    $texte = $questions[$y];
            }
            $this->MultiCell(0,5,($y+1).'. '.$texte  ,1,1,'L',true);
            $this->SetFont('Times','',12);
            $posLettre = 0;
            $xmax = ($y*5)+4;
            for($x = $y*5;$x <= $xmax ;$x++){
                    $posLettre++;
                    $this->Cell(10,5,'',0,0);
                    $this->Cell(0,5,$this->DetermineLettre($posLettre).$texteToutesReponses[$x] ,0,1,'L',$this->VerifierReponse($texteToutesReponses[$x],$texteReponses[$y]));            
                }
            
            $this->Cell(10,10,'',0,1);
            
            }
            
        
        switch($lettre){
            case 0:
                $this->TableauQuestion(1,5,5,9,1);
                break;
            case 1:
                $this->TableauQuestion(6,14,10,14,6);
                break;
            case 6:
                $this->TableauQuestion(15,20,15,19,15);
                break;
            case 15:
                $this->TableauQuestion(21,21,21,26,21);
                $this->Cell(10,60,'',0,1);
                $this->SetFont('Times','B',15);
                $this->Cell(0,5,utf8_decode('Commentaires:'),0,1);
                $this->SetFont('Times','',12);
                $this->Cell(0,5,utf8_decode('Veuillez donner ici vos commentaires sur :'),0,1);
                $this->Cell(10,10,'',0,0);
                $this->SetTextColor(0);
                $this->Cell(0,5,utf8_decode('l\'élève stagiaire;'),0,1);
                $this->Cell(10,10,'',0,0);
                $this->Cell(0,5,utf8_decode('l\'organisation des stages;'),0,1);
                $this->Cell(10,10,'',0,0);
                $this->Cell(0,5,utf8_decode('la formation collégiale en informatique;'),0,1);
                $this->Cell(10,10,'',0,0);
                $this->Cell(0,5,utf8_decode('tout autre point qui vous apparaît pertinent.'),0,1);
                $this->SetTextColor(0);
                $this->SetFillColor(221,217,195);
                $this->MultiCell(0,5,$texteReponses[22],1,1,true);
                break;
        }

    }
    function DetermineLettre($lettre){
        
        switch($lettre){
            case 1:
                $lettre = 'a) ';
                break;
            case 2:
                $lettre = 'b) ';
                break;
            case 3:
                $lettre = 'c) ';
                break;
            case 4:
                $lettre = 'd) ';
                break;
            case 5:
                $lettre = 'e) ';
                break;
        }
        return $lettre;
    }
    function VerifierReponse($question, $reponse){
        $this->SetFillColor(255,255,100);
        $retour = false;
        if($question == $reponse){
            $retour = true;
        }
        return $retour;
        
    }
     
}
//contenu du pdf
$pdf = new PDF();
$pdf-> SetMargins(20,20,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetFillColor(221,217,195);
$pdf->Cell(15,15,'',0,1);
$pdf->TableauQuestion();
$pdf->Output();
?>
