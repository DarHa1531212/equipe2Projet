
<?php
require('fpdf.php');// Connexion et recherche de données
$base = new PDO('mysql:host=localhost; dbname=bdprojet_equipe2V2', 'root', '');
$retour = $base->query("SELECT * FROM vEntente WHERE IdStage = 29");
$entente = null;
while ($data = $retour->fetch()){ 
    $entente = new Entente($data['IdStage'],$data['NomComplet'],$data['AdresseStagiaire'],$data['NumTelStagiaire'],$data['CourrielPersonnel'],$data['NomEntreprise'],$data['AdresseEntreprise'],$data['NumTel'],$data['CourrielEntreprise'],$data['Annee'],$data['Periode'],$data['DateDebut'],$data['DateFin']);    
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
        $this->Cell(0,5,'Technique de l\'informatique - Lettre d\'entente.',0,1);
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
    function Identification($entente){
        $this->SetY($this->GetY()-25);
        $this->SetFont('Arial','B',15);
        $this->Cell(0,15,'Identification',1,1);
        $this->SetFont('Arial','BI',12);
        $this->Cell(30,15,'',1,0);
        $this->Cell(70,15,'Entreprise',1,0);
        $this->Cell(70,15,'Stagiaire',1,1);
        $this->Cell(30,15,'Nom',1,0);
        $this->SetFont('Arial','',12);
        $this->Cell(70,15,$entente->GetNomEntreprise(),1,0);
        $this->Cell(70,15,$entente->GetNomComplet(),1,1);
        $this->SetFont('Arial','BI',12);
        $this->Cell(30,15,'Adresse',1,0);
        $this->SetFont('Arial','',12);
        $this->Cell(70,15,$entente->GetAdresseEntreprise(),1,0);
        $this->Cell(70,15,$entente->GetAdresseStagiaire(),1,1);
        $this->SetFont('Arial','BI',12);
        $this->Cell(30,15,utf8_decode('Téléphone'),1,0);
        $this->SetFont('Arial','',12);
        $this->Cell(70,15,$entente->GetNumTel(),1,0);
        $this->Cell(70,15,$entente->GetNumTelStagiaire(),1,1);
        $this->SetFont('Arial','BI',12);
        $this->Cell(30,15,'Courriel',1,0);
        $this->SetFont('Arial','',12);
        $this->Cell(70,15,$entente->GetCourrielEntreprise(),1,0);
        $this->Cell(70,15,$entente->GetCourrielPersonnel(),1,1);
    }
    function Message($entente){
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,"Nature de l'entente",1,1);
        $this->SetFont('Arial','',12);
        $this->MultiAlignCell(0,5,utf8_decode("L'organisme de stage s'engage à recevoir, au cours de la session ".$entente->GetPeriode(). " ".$entente->GetAnnee()   .", l'élève stagiaire ci-haut mentionné et à lui permettre la participation à des tâches liées à son domaine d'intervention, telles que décrites dans l'offre de stage remise au collège.  L'organisme s'engage également à offrir à l'élève une supervision professionnelle et technique adéquate et à lui donner une rétroaction régulière.

L'élève stagiaire s'engage, pour sa part, à s'impliquer dans l'organisme de stage, à participer aux activités professionnelles de l'organisme, à respecter les exigences du milieu de stage (présence, assiduité, etc.) ainsi qu'à participer activement aux rencontres de supervision.

Le département s'engage enfin à fournir une supervision pédagogique à l'élève stagiaire, à agir comme intermédiaire entre les parties impliquées (cégep, organisme de stage, stagiaire) et à fournir à l'organisme les informations pertinentes concernant le stage.  Le département est également responsable de l'évaluation finale du stage.

Le stage se déroulera entre le ". $entente->GetDateDebut() ." et le ". $entente->GetDateFin()."."),1,0,'L');
        $this->SetFont('Arial','',15);
        $this->SetY($this->GetY()+85);
        $this->Cell(0,12,'Signatures',1,1);        
        $this->SetFont('Arial','',10);
        $this->Cell(0,45,'',1,1);    
        $this->SetY($this->GetY()-30);
        $this->Cell(0,0,'          _____________________________                              _____________________________',0,0);
        $this->SetY($this->GetY()+5);
        $this->Cell(0,0,'          Stagiaire                                                                         Responsable de l\'orgarnisme',0,0);
        $this->SetY($this->GetY()+15);
        $this->Cell(0,0,'          _____________________________                              _____________________________',0,0); $this->SetY($this->GetY()+5);
        $this->Cell(0,0,utf8_decode('          Responsable du stage au cégep                                   Responsable de l\'orgarnisme'),0,0);

        
    }

}
// class entente
class Entente{
    private $Id;
    private $NomComplet;
    private $AdresseStagiaire;  
    private $NumTelStagiaire;
    private $CourrielPersonnel;
    private $NomEntreprise;
    private $AdresseEntreprise;
    private $NumTel;
    private $CourrielEntreprise;
    private $Annee;
    private $Periode;
    private $DateDebut;
    private $DateFin;

      
    public  function __construct($Id,$NomComplet,$AdresseStagiaire,$NumTelStagiaire,$CourrielPersonnel,$NomEntreprise,$AdresseEntreprise,$NumTel,$CourrielEntreprise,$Annee,$Periode,$DateDebut,$DateFin){
        $this->Id = $Id;
        $this->NomComplet = $NomComplet;
        $this->AdresseStagiaire = $AdresseStagiaire;
        $this->NumTelStagiaire = $NumTelStagiaire;
        $this->CourrielPersonnel = $CourrielPersonnel;
        $this->NomEntreprise = $NomEntreprise;
        $this->AdresseEntreprise = $AdresseEntreprise;
        $this->NumTel = $NumTel;
        $this->CourrielEntreprise = $CourrielEntreprise;
        $this->Annee = $Annee;
        $this->Periode = $Periode;
        $this->DateDebut = $DateDebut;
        $this->DateFin = $DateFin;
    }
    
    public function GetId(){
        return $this->Id;
    }    
    public function GetNomComplet(){
        return $this->NomComplet;
    }
    public function GetAdresseStagiaire(){
        return $this->AdresseStagiaire;
    }
    public function GetNumTelStagiaire(){
        return $this->NumTelStagiaire;
    }    
    public function GetCourrielPersonnel(){
        return $this->CourrielPersonnel;
    }
    public function GetNomEntreprise(){
        return $this->NomEntreprise;
    }
    public function GetAdresseEntreprise(){
        return $this->AdresseEntreprise;
    }
    public function GetNumTel(){
        return $this->NumTel;
    }
    public function GetCourrielEntreprise(){
        return $this->CourrielEntreprise;
    }
    public function GetAnnee(){
        return $this->Annee;
    }
    public function GetPeriode(){
        return $this->Periode;
    }
    public function GetDateDebut(){
        return $this->DateDebut;
    }
    public function GetDateFin(){
        return $this->DateFin;
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
$pdf->Identification($entente); 
$pdf->Message($entente);
$pdf->Output();
?>
