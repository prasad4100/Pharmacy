<?php
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
include('connect_db.php');
session_start();
$c_id=$_SESSION['custId'];
$cname=$_SESSION['custName'];
$age=$_SESSION['age'];
$sex=$_SESSION['sex'];
$postal=$_SESSION['postal_address'];
$phone=$_SESSION['phone'];

$quantity=$_SESSION['quantity'];
$t=time("r");
$user=$_SESSION['username'];
$time=date("l\, F d Y\, h:i:s A", $t);
$invoiceNo=$_SESSION['invoice'];
		
$getPresid=mysqli_query($con,"SELECT 1+MAX(prescription_id) FROM prescription");
$presId=mysqli_fetch_array($getPresid,MYSQLI_NUM);
		if($presId[0]=='')
		{$presIdd=999; }
		else{$presIdd=$presId[0];}
	
	$sqlP=mysqli_query($con,"INSERT INTO prescription(prescription_id,customer_id,customer_name,age,sex,postal_address,invoice_id,phone)
				VALUES('{$presIdd}','{$c_id}','{$cname}','{$age}','{$sex}','{$postal}','{$invoiceNo}','{$phone}')  ");
		$sqlI=mysqli_query($con,"INSERT INTO invoice(invoice_id, customer_name,served_by,status)
				VALUES('{$invoiceNo}','{$cname}','{$user}','Pending') ");
						
$getDetails=mysqli_query($con,"SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
while($item1=mysqli_fetch_array($getDetails,MYSQLI_BOTH))
			{	
				$getDetails1=mysqli_query($con,"SELECT stock_id, cost FROM stock WHERE drug_name='{$item1['drug_name']}'");	
			
				$details=mysqli_fetch_array($getDetails1,MYSQLI_BOTH);
				$sqlId=mysqli_query($con,"INSERT INTO invoice_details(invoice,drug,cost,quantity)
				VALUES('{$invoiceNo}','{$details['stock_id']}','{$details['cost']}','{$item1['quantity']}')");
				$count[]=$details['cost']*$item1['quantity'];
		//	echo $invoiceNo."details".$details['stock_id']."-".$details['cost']."-".$item1['quantity'];
			/*
				
				$sqlIp="INSERT INTO prescription_details(pres_id,drug_name,strength,dose,quantity)
				VALUES('{$presIdd}','{$details['stock_id']}','{$item1['strength']}','{$item1['dose']}','{$item1['quantity']}') ";
				echo $sqlIp ."<br>";
				
				*/
			}
			$tot=array_sum($count);
			$file=fopen("receipts/docs/".$c_id.".txt", "a+");
	fwrite($file, "TOTAL;;;;;".$tot."\n");
	fclose($file);
		$getDetails=mysqli_query($con,"SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
while($item12=mysqli_fetch_array($getDetails,MYSQLI_BOTH))
			{	
			$getDetails12=mysqli_query($con,"SELECT stock_id, cost FROM stock WHERE drug_name='{$item12['drug_name']}'");	
			
				$details2=mysqli_fetch_array($getDetails12,MYSQLI_BOTH);
			$sqlIp=mysqli_query($con,"INSERT INTO prescription_details(pres_id,drug_name,strength,dose,quantity)
				VALUES('{$presIdd}','{$details2['stock_id']}','{$item12['strength']}','{$item12['dose']}','{$item12['quantity']}') ");	
					
			}
		$sqlD=mysqli_query($con,"DELETE FROM tempprescri WHERE customer_id='{$c_id}' ");
				
	
	//select all from temp prescri where cust/Id =$c_id
	 
class MYPDF extends TCPDF {

	// Load table data from file
	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data;
	}

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
		$this->SetDrawColor(255, 255,255);
		$this->SetLineWidth(0);
		$this->SetFont('', 'B');
		// Header
		$w = array(30,15,9,15,15,15);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 5, $header[$i], 1, 0, 'L', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
			$this->Cell($w[0], 4, $row[0], 'LR', 0, 'L', $fill);
					
			$this->Cell($w[1], 4, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 4, $row[2], 'LR', 0, 'L', $fill);
			$this->Cell($w[3], 4, $row[3], 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 4, number_format($row[4],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 4, number_format($row[5],2), 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
	
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_INVOICE_FORMAT, true, 'UTF-8', false);


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pharm Syst');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Payment');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//$pdf->SetHeaderData(PDF_RECEIPT_LOGO, PDF_RECEIPT_LOGO_WIDTH, PDF_RECEIPT_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_RECEIPT, '', PDF_FONT_SIZE_RECEIPT));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


$pdf->SetMargins(PDF_INVOICE_LEFT, PDF_INVOICE_TOP, PDF_INVOICE_RIGHT);
$pdf->SetHeaderMargin(PDF_INVOICE_HEADER);
$pdf->SetFooterMargin(PDF_INVOICE_FOOTER);


$pdf->SetAutoPageBreak(TRUE, PDF_INVOICE_BOTTOM);


$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->setLanguageArray($l);


$pdf->SetFont('times', '', 10, '', true);


$pdf->AddPage();
$spacing = -0.01;
$stretching = 75;
$pdf->setFontStretching($stretching);
				$pdf->setFontSpacing($spacing);
$titling= <<<EOD
<strong> <font style="font-size:11">THE PHARMACY</font> </strong> <br>
NBNSSOE,<br>Ambegaon(bk), PUNE<br> Tel:+91 7030145091 <br> E-mail: krajat02@gmail.com <br>-----------------------------------------
EOD;
$header = array('Drug','Strength', 'Dose' ,'Quantity','Price', 'Total');
$ddt=<<<EOD
<strong>INVOICE N<sup>o</sup>:</strong> $invoiceNo  <br>
$time   
EOD;
$html = <<<EOD
<strong>Name: </strong> $cname <strong>ID N<sup>o</sup>: $c_id
<br>-----------------------------------------
EOD;


$data = $pdf->LoadData('receipts/docs/'.$c_id.'.txt');
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $titling, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $ddt, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

$pdf->ColoredTable($header, $data);

$pdf->SetY(-10);
		
		$pdf->Cell(0, 0, 'You were served by: '.strtoupper($user), 0, false, 'L', 0, '', 0, false, 'T', 'M');

$pdf->Output('receipts/printouts/'.$cname.'-invoice.pdf','F');
//unlink('receipts/docs/'.$c_id.'.txt');
unset($_SESSION['custId'], $_SESSION['custName'], $_SESSION['age'], $_SESSION['sex'], $_SESSION['postal_address'], $_SESSION['phone']);
header('Location: prescription.php');
exit;

?>