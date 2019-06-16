<?php
session_start();

if (!isset($_SESSION['sesion'])) {
    header('Location: usuario_login.php');
    exit();
}


require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	// Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Historial combiXCombis',0,1,'C');
	$this->Ln(10);
	// Ensure table header is printed
	parent::Header();
}
}

// Connect to database
$link = mysqli_connect('localhost','root','','geodrive');

$pdf = new PDF();
$pdf->AddPage();
// First table: output all columns
$pdf->Table($link,'SELECT  usuarioxcombi.ID_UsuarioCombi, combi.ID_Combi, combi.Numero_combi, combi.placas , usuarioxcombi.ID_Combi, usuarioxcombi.Numero_Combi, usuarioxcombi.Placas FROM combi inner join usuarioxcombi on usuarioxcombi.ID_Combi = combi.ID_Combi ');

$prop = array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Output();
?>
