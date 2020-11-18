<?php 

   $GLOBALS['payslip'] = json_decode($PaySlip); 
   require(APPPATH.'/libraries/fpdf/fpdf.php');

class PDF extends FPDF
{
  function Table()
  {
      $mode = 'P';
      if($mode == 'P'){
        $cellSize = 19;
        $size = 210;
        $leftSpaceLeftImage = 10;
        $leftSpaceRightImage = 170;
      }
      $this->SetFont('Arial','B',10);
      $payslip = $GLOBALS['payslip']->PaySlip; 
      $leaves = $GLOBALS['payslip']->LeaveType;
      $earningRate = $GLOBALS['payslip']->EarningRates;
            $this->SetFont('Arial','B',16);
            $this->SetDrawColor(180,180,180);
      $this->Image(base_url('assets/images/icons/amigo.jpeg'),$leftSpaceLeftImage,6,60);
      $date = $payslip->Payslip->UpdatedDateUTC;
      $payslips = $payslip->Payslip;
      			preg_match( '/([\d]{10})/', $date, $matches );
      $this->Cell($size,20,'Payslip',0,0,'C');
      $this->Image(base_url('assets/images/icons/Todquest_logo.png'),$leftSpaceRightImage,10,20);
                $this->Ln();
    /* Header*/
    $this->SetFont('Arial','',16);
    $this->Cell($cellSize*3,10,$payslip->Payslip->FirstName." ".$payslip->Payslip->LastName,0,0,'L',0);
    $this->Ln();
      $date = $payslip->Payslip->UpdatedDateUTC;
      $payslips = $payslip->Payslip;
      			preg_match( '/([\d]{10})/', $date, $matches );
    $this->SetFont('Arial','',10);
    $this->SetFillColor(227, 228, 231);
    $this->Cell($cellSize*3,10,'Pay Period','0B 0T',0,'L',1);
    $this->Cell($cellSize*3,10,'Payment Date: '.date('d/m/Y',$matches[0]),'0B 0T',0,'L',1);
    $this->Cell($cellSize*2,10,'Total Earnings','0B 0T',0,'L',1);
    $this->Cell($cellSize*2,10,'Net Pay - $'. $payslips->NetPay,'0B 0T',0,'L',1);
    $this->Ln();

    // Timesheet Earning Lines
    $this->Cell($cellSize*5.5,10,'SALARY & WAGES',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'RatePerUnit',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'Units',0,0,'L',0);
    $price = 0;
    foreach($payslips->TimesheetEarningsLines as $PS){
    	$this->Ln();
    	// $this->SetDrawColor(150,150,150);
    	$this->SetFont('Arial','',10);
    	// TODO : earning name
		    	$price = $price + $PS->RatePerUnit * $PS->NumberOfUnits;
                foreach($earningRate as $ER){
                    if($ER->earningRateId == $PS->EarningsRateID){
		    $this->Cell($cellSize*5.5,10,$ER->name,0,0,'L',0);
                    }
                }
		    $this->Cell($cellSize*1.5,10,$PS->RatePerUnit,0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,$PS->NumberOfUnits,0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'$'.sprintf('%0.02f',$PS->RatePerUnit * $PS->NumberOfUnits),0,0,'L',0);
		    }
		    $this->Ln();
    $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'Total','0B 0T',0,'L',1);
	$this->Cell($cellSize*1.5,7,'$'.sprintf('%0.02f',$price),'0B 0T',0,'L',1);

	// Deductions
	// $this->Ln();
	// $this->SetFont('Arial','',10);
 //    $this->Cell($cellSize*5.5,10,'DEDUCTIONS',0,0,'L',0);
 //    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
 //    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
 //    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
 //    $price = 0;
 //    if(isset($payslips->DeductionLines)){
 //        foreach($payslips->DeductionLines as $DL){
 //        	$this->Ln();
 //        	// $this->SetDrawColor(150,150,150);
 //        	$this->SetFont('Arial','',10);
 //        	// TODO : earning name
 //    		    $this->Cell($cellSize*5.5,10,$DL->DeductionTypeID,0,0,'L',0);
 //    		    $this->Cell($cellSize*1.5,10,$DL->CalculationType,0,0,'L',0);
 //    		    $this->Cell($cellSize*1.5,10,$DL->Amount,0,0,'L',0);
 //    		    $this->Cell($cellSize*1.5,10,'Pay',0,0,'L',0);
 //    		    }
 //    		    $this->Ln();
 //        $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
 //        $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
 //        $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
 //    	$this->Cell($cellSize*1.5,7,$price,'0B 0T',0,'L',1);
 //    }
	// TAX
	$this->Ln();
	$this->SetFont('Arial','',10);
    $this->Cell($cellSize*5.5,10,'TAX',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $price = 0;
    if(isset($payslips->TaxLines)){
        foreach($payslips->TaxLines as $TL){
        	$this->Ln();
        	// $this->SetDrawColor(150,150,150);
        	$this->SetFont('Arial','',8);
        	// TODO : earning name
                $peice = $price + $TL->Amount;
    		    $this->Cell($cellSize*5.5,7,$TL->TaxTypeName,0,0,'L',0);
    		    $this->Cell($cellSize*1.5,7,'',0,0,'L',0);
    		    $this->Cell($cellSize*1.5,7,'',0,0,'L',0);
    		    $this->Cell($cellSize*1.5,7,'$'.sprintf('%0.02f',$TL->Amount),0,0,'L',0);
    		    }
    		    $this->Ln();
        $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
        $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
        $this->Cell($cellSize*1.5,7,'Total','0B 0T',0,'L',1);
    	$this->Cell($cellSize*1.5,7,'$'.sprintf('%0.02f',$price),'0B 0T',0,'L',1);
        }
	// Superannutation
	$this->Ln();
	$this->SetFont('Arial','',10);
    $this->Cell($cellSize*5.5,10,'SUPERANNUTATION',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $price = 0;
    if(isset($payslips->SuperannuationLines)){
    foreach($payslips->SuperannuationLines as $SL){
    	$this->Ln();
    	// $this->SetDrawColor(150,150,150);
    	$this->SetFont('Arial','',8);
    	// TODO : earning name
        $price = $price + $SL->Amount;
		    $this->Cell($cellSize*5.5,10,$SL->ContributionType." - ".$SL->CalculationType,0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'$'.sprintf('%0.02f',$SL->Amount),0,0,'L',0);
		    }
		    $this->Ln();
    $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'Total','0B 0T',0,'L',1);
	$this->Cell($cellSize*1.5,7,'$'.sprintf('%0.02f',$price),'0B 0T',0,'L',1);
    }
	// REIMBURSEMENT LINES
	// TODO : 
	if(isset($payslips->ReimbursementLines)){
	$this->Ln();
	$this->SetFont('Arial','',10);
    $this->Cell($cellSize*5.5,10,'REIMBURSEMENT',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $price = 0;
    foreach($payslips->ReimbursementLines as $RL){
    	$this->Ln();
    	// $this->SetDrawColor(150,150,150);
    	$this->SetFont('Arial','',8);
    	// TODO : earning name
		    $this->Cell($cellSize*5.5,10,$SL->ContributionType." - ".$SL->CalculationType,0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'Pay',0,0,'L',0);
		    }
		    $this->Ln();
    $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'Total','0B 0T',0,'L',1);
	$this->Cell($cellSize*1.5,7,'$'.sprintf('%0.02f',$price),'0B 0T',0,'L',1);
			}

	// LEAVE ACCURALS
	if(isset($payslips->LeaveAccrualLines)){
	$this->Ln();
	$this->SetFont('Arial','',10);
    $this->Cell($cellSize*5.5,10,'LEAVE',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $price = 0;
    foreach($payslips->LeaveAccrualLines as $LL){
    	$this->Ln();
    	// $this->SetDrawColor(150,150,150);
    	$this->SetFont('Arial','',8);
    	// TODO : earning name
        $price = $price + $LL->NumberOfUnits;
        foreach($leaves as $LT){
            if($LT->id == $LL->LeaveTypeID){
		    $this->Cell($cellSize*5.5,10,$LL->LeaveTypeID,0,0,'L',0);
                }
            }
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,$LL->NumberOfUnits,0,0,'L',0);
		    }
		    $this->Ln();
    $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'Total','0B 0T',0,'L',1);
	$this->Cell($cellSize*1.5,7,$price,'0B 0T',0,'L',1);
			}

	// LEAVE EARNING LINES
	// TODO : 
	if(isset($payslips->LeaveEarningsLines) && count($payslips->LeaveEarningsLines) > 0){
	$this->Ln();
	$this->SetFont('Arial','',10);
    $this->Cell($cellSize*5.5,10,'LEAVE EARNING',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
    $price = 0;
    foreach($payslips->LeaveEarningsLines as $LL){
    	$this->Ln();
    	// $this->SetDrawColor(150,150,150);
    	$this->SetFont('Arial','',8);
    	// TODO : earning name
		    $this->Cell($cellSize*5.5,10,$LL->LeaveTypeID,0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'',0,0,'L',0);
		    $this->Cell($cellSize*1.5,10,'Pay',0,0,'L',0);
		    }
		    $this->Ln();
    $this->Cell($cellSize*5.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
    $this->Cell($cellSize*1.5,7,'','0B 0T',0,'L',1);
	$this->Cell($cellSize*1.5,7,$price,'0B 0T',0,'L',1);
			}
	    }
	}

$pdf = new PDF('P','mm','A4');
$pdf->SetTitle('Payslip');
$pdf->AddPage();
$pdf->Table();
$pdf->Output();

// $this->SetFont('Arial','B',25);
// $this->Image(base_url('assets/images/icons/Todquest_logo.png'),$leftSpaceRightImage,10,20);
// $this->SetFillColor(intval($color[0]),intval($color[1]),intval($color[2]));
// $this->Cell($size,7,$ro->areaName,1,0,'L',1);
// $this->Ln();
// $this->Cell($cellSize,7,"",1,0,'L');
?>

<!-- Print part End -->

