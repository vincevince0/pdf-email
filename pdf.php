<?php

namespace TFPDF;
require('tfpdf.php');
class Pdf extends \tFPDF
{

    function Header()
    {
        //logo
        $this->Image('img\UN256.jpg',10,6,30);
        //arial bold 15
        $this->SetFont('DejaVuB','',15);
        //move to the right
        $this->Cell(80);
        //title
        $this->Cell(30,10,'Megyék listája',0,0,'C');
        //line break
        $this->Ln(20);
    }

    function Footer()
    {
        //position 1.5 cm from the bottom
        $this->SetY(-15);
        //arial italic 8
        $this->SetFont('DejaVuI','',8);
        //page number
        $this->Cell(0,10,'Oldal '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function createCountiesList(array $counties)
    {
        $this->AliasNbPages();
        $this->AddFont('DejaVu','','DejaVuSerif.ttf',true);
        $this->AddFont('DejaVuB','','DejaVuSerif-Bold.ttf',true);
        $this->AddFont('DejaVuI','','DejaVuSerif-Italic.ttf',true);
        $this->AddPage();
        $this->SetFont('DejaVu','',8);

        //$this->Cell(50, $h, 'árvíztűrő tükörfúrógép, ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP');
        $h = 10;
        $this->Ln($h);
        $x=10;
        $y=$this->GetY();
        $this->SetFont('DejaVu','',10);
        for ($i = 0; $i < count($counties); $i++)
        {
            $county = $counties[$i];
            ($i % 2) ? $this->SetFillColor(225) : $this->SetFillColor(255);
            $this->Cell(10,$h, $county['id'],0,0, 'L',true);
            $this->Cell(50,$h, $county['name'],0,0, 'L',true);
            $this->Line($x,$y, $x+60, $y);
            $y += $h;
            $this->Ln($h);
            

        }
    }
}