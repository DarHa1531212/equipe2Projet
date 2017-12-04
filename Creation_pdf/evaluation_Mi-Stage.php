
<?php
require('fpdf.php');// Connexion et recherche de données
$base = new PDO('mysql:host=localhost; dbname=bdprojet_equipe2V2', 'root', '');
$retour = $base->query("SELECT * FROM vEvaluationCompletee WHERE IdStagiaire = 15 AND TypeEvaluation = 1;");
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

    function Rotate($angle,$x=-1,$y=-1) { 

        if($x==-1) 
            $x=$this->x; 
        if($y==-1) 
            $y=$this->y; 
        if($this->angle!=0) 
            $this->_out('Q'); 
        $this->angle=$angle; 
        if($angle!=0) 

        { 
            $angle*=M_PI/180; 
            $c=cos($angle); 
            $s=sin($angle); 
            $cx=$x*$this->k; 
            $cy=($this->h-$y)*$this->k; 
             
            $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy)); 
        } 
    } 

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

    function TableauQuestion($xfor = 0,$xmax =3,$lettre = 0){
        global $reponses;
        global $questions;
        global $lettres;
        global $descriptionCategories;
        global $titreCategories;
        global $texteReponses;
        
        
        $this->SetFont('Times','B',15);
        $this->Cell(0,5,$lettres[$lettre].'.   '.$titreCategories[$lettre],0,1);
        $this->SetFont('Times','',12);
        $this->MultiCell(0,5,$descriptionCategories[$lettre],0,'L');
        $this->SetFont('Times','',12);
        
        
        $this->Cell(110,5,'',0,1,'C');
        $this->Cell(110,20,utf8_decode('Critères :'),1,0,'C',true);
        $this->SetFont('Times','',8);
        $this->Cell(15,15,utf8_decode($this->TexteRotation('Généralement')),0,0);
        $this->Rotate(0);
        $this->SetX($this->GetX()+15);
        $this->Cell(15,15,$this->TexteRotation('Souvent'),0,0);
        $this->Rotate(0);
        $this->SetX($this->GetX()+15);
        $this->Cell(15,15,$this->TexteRotation('Parfois'),0,0);
        $this->Rotate(0);
        $this->SetX($this->GetX()+15);
        $this->Cell(15,15,$this->TexteRotation('Rarement'),0,0);
        $this->Rotate(0);
        $this->SetX($this->GetX()+15);
        $this->Cell(15,15,'',0,1);
        $this->SetFont('Times','',12);
        for($x = $xfor;$x<=$xmax;$x++){    
            $this->Cell(110,20,'',1,0,'C',true);
            $this->SetX($this->GetX()-110);
            $this->MultiAlignCell(110,5,$questions[$x],0,0,'L');
            $this->Cell(15,20,$this->ReponseStagiaire($reponses[$x],1),1,0,'C');
            $this->Cell(15,20,$this->ReponseStagiaire($reponses[$x],2),1,0,'C');
            $this->Cell(15,20,$this->ReponseStagiaire($reponses[$x],3),1,0,'C');
            $this->Cell(15,20,$this->ReponseStagiaire($reponses[$x],4),1,1,'C');
        }
        
        switch($lettre){
            case 0:
                $this->Cell(10,10,'',0,1);
                $this->TableauQuestion(4,7,5);
                break;
            case 5:
                $this->Cell(100,10,'',0,1);
                $this->TableauQuestion(8,11,8);
                break;
            case 8:
                $this->Cell(100,10,'',0,1);
                $this->TableauQuestion(12,15,12);
                break;
            case 12:
                $this->Cell(100,115,'',0,1);
                $this->TableauQuestion(16,20,16);
                break;
            case 16:
                $this->Cell(100,10,'',0,1);
                $this->TableauQuestion(21,29,21);
                break;
            case 21:
                $this->Cell(100,115,'',0,1);
                $this->TableauQuestion(30,33,30);
                $this->Cell(100,125,'',0,1);
                $this->SetFont('Times','B',15);
                $this->Cell(0,5,utf8_decode('Évaluation Globale de l\'élève stagiaire.'),0,1);
                $this->SetFont('Times','',12);
                $this->Cell(0,5,utf8_decode('Donnez vos commentaires généraux.'),0,1);
                $this->MultiCell(0,5,$texteReponses[34],1,1,true);
                break;
        }

    }
    function TexteRotation($texte){
        $this->Rotate(90);
        $this->SetX($this->GetX()-15);
        return $texte;
    }
    
    function ReponseStagiaire($reponse='1',$position='1'){
        $retour = '';

        if($reponse == $position){
            $retour = 'X';
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
