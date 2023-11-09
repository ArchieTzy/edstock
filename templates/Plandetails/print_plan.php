<?php
global $title;
global $subtitle;
$title = $plan->title;
$subtitle = $plan->subtitle;
class xtcpdf extends TCPDF {
    public function Header() {
        global $title;
        global $subtitle;
        $image1= 'img/isu_logo.jpg';
        $this->Image($image1, 40, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('timesB', 'B', 12);
        $this->setY(10);
        $this->Cell(0, 15, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(6);
        $this->Cell(0, 15, 'ISABELA STATE UNIVERSITY    ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(3);
        $this->Cell(0, 0, 'Echague, Isabela', 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('timesB', 'B', 15);
        $this->Cell(0, 0, $title, 0, 0, 'C');
        $this->Ln(6);
        $this->SetFont('timesB', 'B', 11);
        $this->Cell(0, 0, $subtitle, 0, 0, 'C');
        $this->Line(5, 47, 292, 47);
        $this->Line(5, 48, 292, 48);
    }
    public function Footer() {
        $this->SetY(-15);

        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'ISUS-CCO PPMP 044', 0, 0, 'L');
        $this->Ln(4);
        $this->Cell(0, 0, 'Effectivity: February 3, 2022', 0, 0, 'L');
        $this->Ln(4);
        $this->Cell(0, 0, 'Revision 0', 0, 0, 'L');
    }
}

$pdf = new xtcpdf('P', 'mm', [215.9, 330.2], true, 'UTF-8', false);
$pdf->SetMargins(5, 50, 5, true);
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('times','',12);
$style =['width' => 0.5, 'cap' => 'round', 'join' => 'round', 'dash' => 0];
$pdf->AddPage('L');
$rows='';
$grandtotal = 0;
foreach ($planitems as $item):
    if(!empty($item['items'])){
        $subtotal = 0;
        $rows.='<tr><td colspan="6"  style="background-color: orange;">'.$item["category"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td></tr>';
        foreach ($item['items'] as $row):
            if(!empty($row['qty'])){
                $total = $row['cost'] * $row['qty'];
                $subtotal += $total;
                $grandtotal +=$subtotal;
            }
            $rows.= '<tr>
                <td>'.$row['code'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.number_format($row['qty']).'</td>
                <td>'.$row['unit'] .'</td>
                <td>'.number_format($row['cost'],2) .'</td>
                <td>'.number_format($row['total'],2).'</td>
                <td>'.$row['method'].'</td>
                <td>'.$row['jan'].'</td>
                <td>'.$row['feb'].'</td>
                <td>'.$row['mar'].'</td>
                <td>'.$row['apr'].'</td>
                <td>'.$row['may'].'</td>
                <td>'.$row['jun'].'</td>
                <td>'.$row['jul'].'</td>
                <td>'.$row['aug'].'</td>
                <td>'.$row['sep'].'</td>
                <td>'.$row['oct'].'</td>
                <td>'.$row['nov'].'</td>
                <td>'.$row['decm'].'</td>
                <td><a href="" class="edit" data-id="'.$row['id'].'" data-item_id="'.$row['item_id'].'"><i class="fa fa-pencil-alt"></i></a></td>
            </tr>';
        endforeach;
        $rows.='<tr style="background-color: yellow;">
            <td colspan="2"> Subtotal</td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.number_format($subtotal,2).'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>';
        }
endforeach;
$rows.='<tr style="background-color: orange;">
            <td colspan="2"> Grand Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.number_format($grandtotal,2).'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>';
$html = '<table border="1" cellpadding="2" style="font-size: 8px;" width="100%">
        <tr>
            <th rowspan="2">Code No</th>
            <th rowspan="2">General Description</th>
            <th rowspan="2">Qty</th>
            <th rowspan="2">Unit</th>
            <th rowspan="2">Unit Cost</th>
            <th rowspan="2">Total Cost</th>
            <th rowspan="2">Procurement Method</th>
            <th colspan="12" scope="colgroup" style="text-align: center;">Schedule/Milestone of Activities</th>
        </tr>
        <tr>
            <th scope="col">Jan</th>
            <th scope="col">Feb</th>
            <th scope="col">Mar</th>
            <th scope="col">Apr</th>
            <th scope="col">May</th>
            <th scope="col">Jun</th>
            <th scope="col">Jul</th>
            <th scope="col">Aug</th>
            <th scope="col">Sep</th>
            <th scope="col">Oct</th>
            <th scope="col">Nov</th>
            <th scope="col">Dec</th>
        </tr>'.$rows.'
</table>
<div style="padding: 10px;"></div>
<table width="100%">
    <tr>
        <td align="center">Prepared By</td>
        <td align="center">Noted By</td>
        <td align="center">Approved By</td>
    </tr>
    <tr>
        <td align="center"></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td align="center"><u>'.$plan->prepared_by.'</u></td>
        <td align="center"><u>'.$coordinator->name.'</u></td>
        <td align="center"><u>'.$executive->name.'</u></td>
    </tr>
    <tr>
        <td align="center">'.$plan->position.'</td>
        <td align="center">'.$coordinator->position.'</td>
        <td align="center">'.$executive->position.'</td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false, true, false, 'L');
$pdf->LastPage();
$pdf->Output('sample.pdf', 'I');