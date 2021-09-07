<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PdfController extends Controller
{
    public function index()
    {
        return view('admin.main.pdf_admin.index');
    }
    public function makePDF($id_mahasiswa, $id_kursus)
    {

        $this->dataView['product'] = CourseDetail::where('mahasiswa_id', $id_mahasiswa)
            ->where('kursus_id', $id_kursus)
            ->first();
        $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
        $html_content = $view->render();
      

        PDF::setHeaderCallback(function ($pdf) {
             // logo
            $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

             // Title
            $pdf->SetXY(30, 20);
            $pdf->SetFont('helvetica', 'B', 20);
           
            $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

            // ALAMAT
            $pdf->SetXY(65, 25);
            $pdf->SetFont('helvetica', '', 10);
            // Title
            $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
            $pdf->MultiCell(100, 5, ''.$alamat, 0, 'C', 0, 0, '', '', true);
            // Set Line
            $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $pdf->Line(30, 40, 190, 40, $style);
            

        });

        // Custom Footer
        PDF::setFooterCallback(function ($pdf) {

            // Position at 15 mm from bottom
            $pdf->SetY(-15);

            //setLine
            $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

            $pdf->Line(30, 280, 190, 280, $style);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
           
        });

        PDF::SetTitle('ITATS LANGUAGE CENTER');
        PDF::SetMargins(7, 80, 7);
        $GETY = PDF::GetY();
        PDF::AddPage('P', 'A4');
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::writeHTMLCell(0, 300, 20,$GETY, $html_content, 0, 0, 0, true, 'C', true);

    

        PDF::Output('SamplePDF.pdf');
    }

    public function downloadPDF()
    {
        $product = CourseDetail::where('mahasiswa_id', $id);
        $view = \View::make('admin.main.dashboard_admin.pdf', compact('product'));
        $html_content = $view->render();
      

        PDF::setHeaderCallback(function ($pdf) {
             // logo
            $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

             // Title
            $pdf->SetXY(30, 20);
            $pdf->SetFont('helvetica', 'B', 20);
           
            $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

            // ALAMAT
            $pdf->SetXY(65, 25);
            $pdf->SetFont('helvetica', '', 10);
            // Title
            $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
            $pdf->MultiCell(100, 5, ''.$alamat, 0, 'C', 0, 0, '', '', true);
            // Set Line
            $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $pdf->Line(30, 40, 190, 40, $style);
            

        });

        // Custom Footer
        PDF::setFooterCallback(function ($pdf) {

            // Position at 15 mm from bottom
            $pdf->SetY(-15);

            //setLine
            $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

            $pdf->Line(30, 280, 190, 280, $style);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
           
        });

        PDF::SetTitle('ITATS LANGUAGE CENTER');
        PDF::SetMargins(7, 80, 7);
        $GETY = PDF::GetY();
        PDF::AddPage('P', 'A4');
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::writeHTMLCell(0, 300, 20,$GETY, $html_content, 0, 0, 0, true, 'C', true);

        PDF::Output(uniqid() . '_ILC.pdf', 'D');
    }
}
