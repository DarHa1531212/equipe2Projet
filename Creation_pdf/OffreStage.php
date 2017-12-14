
<?php
require('fpdf.php');// Connexion et recherche de données
//$base = new PDO('mysql:host=localhost; dbname=bdprojet_equipe2V2', 'root', '');
$base = new PDO('mysql:host=dicj.info; dbname=cegepjon_p2017_2_dev', 'cegepjon_p2017_2', 'madfpfadshdb');//bdd distante
$retour = $base->query("SELECT * FROM vOffre WHERE IdStage = 1");
$Offre = null;
while ($data = $retour->fetch()){ 
    $Offre = new Offre($data['RaisonSociale'],$data['NomEntreprise'],$data['CourrielEntreprise'],$data['NumTel'],$data['AdresseEntreprise'],$data['NomResponsable'],$data['NomSuperviseur'],$data['AnneeSession'],$data['DescriptionStage'],$data['CompetenceRecherche'],$data['HoraireTravail'],$data['DateDebut'],$data['NbHeureSemaine'],$data['SalaireHoraire']);
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
        $this->Image('logo.png',10,6,30);
        $this->SetFont('Arial','',15);
        $this->SetXY($this->GetX()+30,$this->GetY()-10);
        $this->Cell(0,5,'Technique de l\'informatique - Offre de stage.',0,1);
        $this->Cell(80);
        $this->Cell(30,10,'',0,0,'C');
        $this->Ln(20);
         
    }
    //Pied de page qui compte les pages
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','B',10);  
        $this->Cell(0,3,utf8_decode('Cégep de Jonquière'),0,1,'C');  
        $this->SetFont('Arial','',8);     
        $this->Cell(0,3,utf8_decode('2505, rue Saint-Hubert, Jonquière (Québec) G7X 7W2'),0,1,'C');       
    }
    function Body($Offre){
        $this->SetDrawColor(192,192,192);
        $this->SetTextColor(232,155,0);
        $this->SetY($this->GetY()-25);
        $this->SetFont('Arial','B',12); 
        $this->Cell(0,5,$Offre->GetAnneeSession(),0,1);
        $this->SetFont('Arial','B',15); 
        $this->Cell(0,10,'Identification de l\'employeur',1,1);
        $this->SetFont('Arial','',12); 
        $this->SetTextColor(0,0,0);
        $this->Cell(60,10,'Entreprise :',1,0);
        $this->Cell(0,10,$Offre->GetNomEntreprise(),1,1);
        $this->Cell(60,10,'Raison sociale :',1,0);
        $this->Cell(0,10,$Offre->GetRaisonSociale(),1,1);
        $this->Cell(60,10,'Adresse de stage :',1,0);
        $this->Cell(0,10,$Offre->GetAdresseEntreprise(),1,1);
        $this->Cell(60,10,utf8_decode('Téléphone :'),1,0);
        $this->Cell(0,10,$Offre->GetNumTel(),1,1);
        $this->Cell(60,10,utf8_decode('Courriel :'),1,0);
        $this->Cell(0,10,$Offre->GetCourrielEntreprise(),1,1);
        $this->Cell(60,10,utf8_decode('Superviseur de stage :'),1,0);
        $this->Cell(0,10,$Offre->GetNomSuperviseur(),1,1);
        $this->Cell(60,10,utf8_decode('Responsable de stage :'),1,0);
        $this->Cell(0,10,$Offre->GetNomResponsable(),1,1);
        $this->SetFont('Arial','',15); 
        $this->SetTextColor(232,155,0);
        $this->Cell(0,15,'Description du stage et de l\'environnement technique',1,1);
        $this->SetFont('Arial','',12); 
        $this->SetTextColor(0,0,0);
        $this->Cell(0,60,'',1,1);
        $this->SetY($this->GetY()-60);
        $this->MultiCell(0,5,$Offre->GetDescriptionStage(),0,1,0,'L');
        $this->SetFont('Arial','',15); 
        $this->SetTextColor(232,155,0);
        $this->SetXY(20,185);
        $this->Cell(0,15,utf8_decode('Compétences particulières recherchées'),1,1);
        $this->SetFont('Arial','',12); 
        $this->SetTextColor(0,0,0);
        $this->Cell(0,0,'',0,1);
        $this->Cell(0,30,'',1,1);
        $this->SetY($this->GetY()-30);
        $this->MultiCell(0,5,$Offre->GetCompetenceRecherche(),0,1,0,'L');
        $this->SetXY(20,230);
        $this->SetFont('Arial','',15); 
        $this->SetTextColor(232,155,0);
        $this->Cell(0,15,'Conditions de travail',1,1);
        $this->Cell(0,30,'',1,1);
        $this->SetFont('Arial','',12); 
        $this->SetTextColor(0,0,0);
        $this->SetXY(20,245);
        $this->Cell(0,5,'Horaire de travail : '.$Offre->GetHoraireTravail(),0,1);
        $this->Cell(0,5,utf8_decode('Nombre d\'heures par semaine : ').$Offre->GetNbHeureSemaine().'h',0,1);
        $this->Cell(0,5,utf8_decode('Rémunération : ').$Offre->GetSalaireHoraire().'$/h',0,1);
        $this->Cell(0,5,utf8_decode('Date de début : ').$Offre->GetDateDebut(),0,1);

    }

}
// class entente
class Offre{

    private $RaisonSociale;
    private $NomEntreprise;
    private $CourrielEntreprise;
    private $NumTel;
    private $AdresseEntreprise;
    private $NomResponsable;
    private $NomSuperviseur;
    private $AnneeSession;
    private $DescriptionStage;
    private $CompetenceRecherche;
    private $HoraireTravail;
    private $DateDebut;
    private $NbHeureSemaine;
    private $SalaireHoraire;
    
    public  function __construct($RaisonSociale,$NomEntreprise,$CourrielEntreprise,$NumTel,$AdresseEntreprise,$NomResponsable,$NomSuperviseur,$AnneeSession,$DescriptionStage,$CompetenceRecherche,$HoraireTravail,$DateDebut,$NbHeureSemaine,$SalaireHoraire){
        $this->RaisonSociale = $RaisonSociale;
        $this->NomEntreprise = $NomEntreprise;
        $this->CourrielEntreprise = $CourrielEntreprise;
        $this->NumTel = $NumTel;
        $this->AdresseEntreprise = $AdresseEntreprise;
        $this->NomResponsable = $NomResponsable;
        $this->NomSuperviseur = $NomSuperviseur;
        $this->AnneeSession = $AnneeSession;
        $this->DescriptionStage = $DescriptionStage;
        $this->CompetenceRecherche = $CompetenceRecherche;
        $this->HoraireTravail = $HoraireTravail;
        $this->DateDebut = $DateDebut;
        $this->NbHeureSemaine = $NbHeureSemaine;
        $this->SalaireHoraire = $SalaireHoraire;
    }

    public function GetSalaireHoraire(){
        return $this->SalaireHoraire;
    }
    public function GetNbHeureSemaine(){
        return $this->NbHeureSemaine;
    }
    public function GetDateDebut(){
        return $this->DateDebut;
    }
    public function GetHoraireTravail(){
        return $this->HoraireTravail;
    }
    public function GetCompetenceRecherche(){
        return $this->CompetenceRecherche;
    }
    public function GetDescriptionStage(){
        return $this->DescriptionStage;
    }
    public function GetAnneeSession(){
        return $this->AnneeSession;
    }
    public function GetNomSuperviseur(){
        return $this->NomSuperviseur;
    }
    public function GetNomResponsable(){
        return $this->NomResponsable;
    }
    public function GetRaisonSociale(){
        return $this->RaisonSociale;
    }
    public function GetNomEntreprise(){
        return $this->NomEntreprise;
    }
    public function GetCourrielEntreprise(){
        return $this->CourrielEntreprise;
    }
    public function GetNumTel(){
        return $this->NumTel;
    }
    public function GetAdresseEntreprise(){
        return $this->AdresseEntreprise;
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
$pdf->Body($Offre);
$pdf->Output();
?>
