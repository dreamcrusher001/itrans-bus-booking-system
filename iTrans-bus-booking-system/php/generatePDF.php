<?php
require_once("bus.php");
require_once("customer.php");
require('fpdf17/fpdf.php');
require_once("database.php");
$bus=new Bus();
$bus->bus($_POST['busid']);
$ticketcode=$_POST['ticketno'];

class PDF extends FPDF
{
function Header()
{
	$this->Image('../images/logo2.png',10,6,30);
	$pdf->SetFont('Arial','B',12);
   // $pdf->Cell(189,5,$bus->company_name,1,0,'C');
}

function Footer()
{
	$this->SetFont('Arial','B',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$sql="SELECT * FROM transaction WHERE ticketcode='$ticketcode' ";
$result=$database->query($sql);
foreach($result as $row)
{	
	$amount=$row['amount'];
	$bookedseats=$row['seats'];
	$date=$row['date'];

}

$pdf=new FPDF('p','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(189,5,'BUS TICKET',1,0,'C');

//header details
$pdf->SetFont('Arial','',11);
$pdf->Ln();
$pdf->Cell(90,5,'I-trans online bus booking',0,0,'C');
$pdf->Cell(30,5,'ORIGINAL',1,0,'C');
$pdf->Cell(69,5,'Journey date: '.$date,0,0,'R');

$pdf->Ln();
$pdf->Cell(90,5,'In association with',0,0,'C');
$pdf->Cell(30,5,'CUSTOMER ID: '.$customer->customerid,0,0);


$pdf->Ln();
$pdf->Cell(90,5,$bus->company_name,0,0,'C');
$pdf->Cell(30,5,'BUS ID: '.$bus->busid,0,0);
$pdf->Cell(69,5,'Ticket Number: '.$ticketcode,0,0,'R');

//display customer details
$pdf->Ln();
$pdf->Cell(120,5,'CUSTOMER DETAILS',1,0,'C');
$pdf->Cell(69,5,'FARE DETAILS',1,0,'C');
$pdf->Ln();
$pdf->Cell(60,5,'Name: '.$customer->first_name." ". $customer->second_name,0,0);
$pdf->Cell(60,5,'DOB: '.$customer->date_of_birth,0,0);

$pdf->Ln();
$pdf->Cell(60,5,'Email: '.$customer->email,0,0);
$pdf->Cell(60,5,'Gender: '.$customer->gender,0,0);

$pdf->Ln();
$pdf->Cell(60,5,'Mobile: '.$customer->phone_number,0,0);
$pdf->Cell(60,5,'ID: '.$customer->nationalid,0,0);
//fare detail
$pdf->Cell(39,5,'Description',0,0,'R');
$pdf->Cell(30,5,'Amount(Ksh.)',0,0,'R');


//display passenger details
$pdf->Ln();
$pdf->Cell(120,5,'PASSENGER DETAILS',1,0,'C');
//fare detail
$pdf->Cell(39,5,'QTY',1,0,'R');
$pdf->Cell(13,5,'FARE',1,0,'R');
$pdf->Cell(17,5,'TOTAL',1,0,'R');

$pdf->Ln();
$pdf->SetFont('Arial','U',11);
	$pdf->Cell(80,5,'name',0,0);
	$pdf->Cell(30,5,'gender',0,0);
	$pdf->Cell(10,5,'age',0,0);
$pdf->SetFont('Arial','',11);

//fare detail
$pdf->Cell(20,5,'Seats',1,0,'R');
$pdf->Cell(19,5,$bookedseats,1,0,'R');
$pdf->Cell(13,5,$bus->fare,1,0,'R');
$pdf->Cell(17,5,$amount,1,0,'R');	
$pdf->Ln();

	
$sql="SELECT * FROM passenger WHERE ticketcode='$ticketcode' ";
$result=$database->query($sql);
foreach($result as $row)
{	
	$pdf->Cell(80,5,$row['name'],0,0);
	$pdf->Cell(30,5,$row['gender'],0,0);
	$pdf->Cell(10,5,$row['age'],0,0);
	$pdf->Ln();
}


//display bus details
$pdf->Cell(120,5,'BUS DETAILS',1,0,'C');
$pdf->Ln();
$pdf->Cell(60,5,'Plates: '.$bus->plate_number,0,0);
$pdf->Cell(60,5,'Manager: '.$bus->company_manager,0,0);

$pdf->Ln();
$pdf->Cell(60,5,'Sacco: '.$bus->company_name,0,0);
$pdf->Cell(60,5,'Phone: '.$bus->company_phone,0,0);

$pdf->Ln();
$pdf->Cell(60,5,'Seats: '.$bus->seats,0,0);
$pdf->Cell(60,5,'Location: '.$bus->company_location,0,0);

//pick up details and footer
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(120,5,"PICK UP DETAILS: "." Time ".$bus->startA." Station ".$bus->stationA,1,0);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(120,5,"This is a computer generated bus ticket ",1,0,'C');

$pdf->Ln();
$pdf->Ln();
$printing="GENERATION DATE AND TIME :".date('d/m/y').", ".date('h:i:sa');
$pdf->Cell(189,5,"BOOK YOUR TICKETS: iTrans.co.ke "."               ".$printing,1,0);

$pdf->Output($customer->first_name."ticket".$ticketcode.".pdf",'D');
?>