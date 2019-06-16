<?php
require_once('fpdf/fpdf.php');

class PDF extends FPDF
{
	private $title = '';
	
	function setReportTitle($title)
	{
		$this->title = $title;
	}

	//Cabecera de página
	function Header()
	{
		$this->SetFont('Arial', 'B', 15);
		$this->Cell(0, 10, $this->title, 0, 0, 'C');
		//Salto de línea
		$this->Ln(20);
	}

	//Pie de página
	function Footer()
	{
		//Posición: a 1,5 cm del final
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		//Número de página
		$this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}

	//Tabla coloreada
	function TablaColores($header, $body, $hColor = array(0,0,0), $fillColor = array(200,200,255), $color = array(255,255,255))
	{
		//Colores, ancho de línea y fuente en negrita
		$this->SetFillColor($hColor[0], $hColor[1], $hColor[2]);
		$this->SetDrawColor($hColor[0], $hColor[1], $hColor[2]);
		$this->SetTextColor($color[0], $color[1], $color[2]);
		$this->SetLineWidth(.3);
		$this->SetFont('', 'B', 12);
		//Cabecera

		for ($i = 0; $i < count($header); $i++)
			$this->Cell(45, 7, $header[$i], 1, 0, 'C', 1);
		$this->Ln();
		//Restauración de colores y fuentes
		$this->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Datos
		foreach($body as $row => $val){
			$fill = $row % 2;
			foreach($val as $v){
				$this->Cell(45, 6, $v, 'LR', 0, 'L', $fill);
			}
			$this->Ln();
		}
		$this->Cell(225, 0, '', 'T');
	}
}

?>