<?php
class xtcpdf extends TCPDF {
    public function Header() {
        $this->setY(10);
        $this->Cell(0, 15, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(6);
        $this->Cell(0, 15, 'ISABELA STATE UNIVERSITY    ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(3);
        $this->Cell(0, 0, 'Echague, Isabela', 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('timesB', 'B', 15);
        $this->Cell(0, 0, 'PURCHASE ORDER', 0, 0, 'C');
        $this->Line(20, 45, 195, 45);
        $this->Line(20, 46, 195, 46);
    }
    public function Footer() {
        $this->SetY(-15);

        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'ISUS-CCO PuR 0045', 0, 0, 'L');
        $this->Ln(4);
        $this->Cell(0, 0, 'Effectivity: February 3, 2022', 0, 0, 'L');
        $this->Ln(4);
        $this->Cell(0, 0, 'Revision 0', 0, 0, 'L');
    }
}

$pdf = new xtcpdf('P', 'mm', [215.9, 330.2], true, 'UTF-8', false);
$pdf->SetMargins(20, 50, 20, true);
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('times','',12);
$style =['width' => 0.5, 'cap' => 'round', 'join' => 'round', 'dash' => 0];
$pdf->AddPage();

$data = '';
$ctr = 0;
$total = 0;
foreach ($request->requestdetails as $details){
    $data .='<tr>
                <td align="center">'.($ctr+1).'</td>
                <td>'.$details->item->unit->name.'</td>
                <td>'.$details->item->description.'</td>
                <td align="right">'.number_format($details->qty).'</td>
                <td align="right">'.number_format($details->cost,2).'</td>
                <td align="right">'.number_format($details->total,2).'</td>
                </tr>
    ';
    $ctr++;
    $total +=$details->total;
}

$html = '<table width="100%">
    <tr>
        <td width="60%"><p>Entity Name: <b>'.$request->office->name.'</b></p></td>
        <td width="5%"></td>
        <td width="35%"><p>Fund Cluster: <b>______________</b></p></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<table border="1" width="100%" cellpadding="2">
    <tr>
        <td>Office Section</td>
        <td>PR No:</td>
        <td>Date:</td>
    </tr>
    <tr>
        <td></td>
        <td style="font-size: small;">Responsibility Center Code : </td>
        <td></td>
    </tr>
</table>
<table border="1" cellpadding="2" width="100%" style="font-size: 10px;">
    <tr>
        <th width="10%" align="center">Stock/ Property No.</th>
        <th width="10%" align="center">Unit</th>
        <th width="40%" align="center">Item Description</th>
        <th width="10%" align="center">Quantity</th>
        <th width="15%" align="center">Unit Cost</th>
        <th width="15%" align="center">Total Cost</th>
    </tr>
    '.$data.'
    <tr>
        <td colspan="6" align="center">Nothing Follows</td>
    </tr>
    <tr>
        <td align="center"></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"></td>
        <td align="right"><b>Total</b></td>
        <td align="right">'.number_format($total,2).'</td>
    </tr>
     <tr>
        <td colspan="6">Purpose: '.$request->purpose.'</td>
    </tr>
    
</table>
<table border="1" cellpadding="2" width="100%" style="font-size: 10px;">
<tr>
    <td width="20%">Signature</td>
    <td width="40%"></td>
    <td width="40%"></td>
</tr>
<tr>
    <td width="20%">Printed<br>Name:</td>
    <td width="40%" align="center">'.$coordinator->name.'</td>
    <td width="40%" align="center">'.$head->name.'</td>
</tr>
<tr>
    <td width="20%">Designation:</td>
    <td width="40%" align="center">'.$coordinator->position.'</td>
    <td width="40%" align="center">'.$head->position.'</td>
</tr>
</table>';

$pdf->writeHTML($html, true, false, true, false, 'L');
$pdf->LastPage();
$pdf->Output('sample.pdf', 'I');