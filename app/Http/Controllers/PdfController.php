<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\Admin;
use App\Models\CourseDetail;
use App\Models\Ijazah;
use App\Models\TranskripNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use phpDocumentor\Reflection\PseudoTypes\True_;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['makePDF']);
    }

    public function index()
    {
        return view('admin.main.pdf_admin.index');
    }

    public function makePDF($id_kursus, $id_mahasiswa_satu, $id_mahasiswa_dua = null)
    {
        // Jika print 2 mahasiswa.
        if ($id_mahasiswa_dua !== null) {
            $this->dataView['product'] = CourseDetail::whereIn('mahasiswa_id', [$id_mahasiswa_satu, $id_mahasiswa_dua])
                ->where('kursus_id', $id_kursus)
                ->get();

            // Jika data 2 mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

                // Custom Footer
                PDF::setFooterCallback(function ($pdf) {

                    // Position at 15 mm from bottom
                    $pdf->SetY(-15);

                    //setLine footer
                    $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

                    $pdf->Line(30, 280, 190, 280, $style);
                    // Set font
                    $pdf->SetFont('helvetica', 'I', 8);
                    // Page number
                    $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 mahasiswa.
        else {
            $this->dataView['product'] = CourseDetail::where('mahasiswa_id', $id_mahasiswa_satu)
                ->where('kursus_id', $id_kursus)
                ->get();

            // Jika data mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 1) {
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
                    $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
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
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF2($id_abstrak, $id_mahasiswa_satu, $id_mahasiswa_dua = null)
    {
        // Jika print 2 mahasiswa.
        if ($id_mahasiswa_dua !== null) {
            $this->dataView['product'] = Abstrak::whereIn('mahasiswa_id', [$id_mahasiswa_satu, $id_mahasiswa_dua])
                ->where('id_abstrak', $id_abstrak)
                ->get();

            // Jika data 2 mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

                // Custom Footer
                PDF::setFooterCallback(function ($pdf) {

                    // Position at 15 mm from bottom
                    $pdf->SetY(-15);

                    //setLine footer
                    $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

                    $pdf->Line(30, 280, 190, 280, $style);
                    // Set font
                    $pdf->SetFont('helvetica', 'I', 8);
                    // Page number
                    $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 mahasiswa.
        else {
            $this->dataView['product'] = Abstrak::where('mahasiswa_id', $id_mahasiswa_satu)
                ->where('id_abstrak', $id_kursus)
                ->get();

            // Jika data mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

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
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF3($id_transkrip_nilai, $id_mahasiswa_satu, $id_mahasiswa_dua = null)
    {
        // Jika print 2 mahasiswa.
        if ($id_mahasiswa_dua !== null) {
            $this->dataView['product'] = TranskripNilai::whereIn('mahasiswa_id', [$id_mahasiswa_satu, $id_mahasiswa_dua])
                ->where('id_transkrip_nilai', $id_transkrip_nilai)
                ->get();

            // Jika data 2 mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

                // Custom Footer
                PDF::setFooterCallback(function ($pdf) {

                    // Position at 15 mm from bottom
                    $pdf->SetY(-15);

                    //setLine footer
                    $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

                    $pdf->Line(30, 280, 190, 280, $style);
                    // Set font
                    $pdf->SetFont('helvetica', 'I', 8);
                    // Page number
                    $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 mahasiswa.
        else {
            $this->dataView['product'] = TranskripNilai::where('mahasiswa_id', $id_mahasiswa_satu)
                ->where('id_transkrip_nilai', $id_transkrip_nilai)
                ->get();

            // Jika data mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

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
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF4($id_ijazah, $id_mahasiswa_satu, $id_mahasiswa_dua = null)
    {
        // Jika print 2 mahasiswa.
        if ($id_mahasiswa_dua !== null) {
            $this->dataView['product'] = Ijazah::whereIn('mahasiswa_id', [$id_mahasiswa_satu, $id_mahasiswa_dua])
                ->where('id_ijazah', $id_ijazah)
                ->get();

            // Jika data 2 mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

                // Custom Footer
                PDF::setFooterCallback(function ($pdf) {

                    // Position at 15 mm from bottom
                    $pdf->SetY(-15);

                    //setLine footer
                    $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

                    $pdf->Line(30, 280, 190, 280, $style);
                    // Set font
                    $pdf->SetFont('helvetica', 'I', 8);
                    // Page number
                    $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 mahasiswa.
        else {
            $this->dataView['product'] = Ijazah::where('mahasiswa_id', $id_mahasiswa_satu)
                ->where('id_ijazah', $id_ijazah)
                ->get();

            // Jika data mahasiswa ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.index', $this->dataView);
                $html_content = $view->render();

                // PDF::setHeaderCallback(function ($pdf) {
                //     // logo
                //     $pdf->Image('images/logo.png', 30, 15, 20, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

                //     // Title
                //     $pdf->SetXY(30, 20);
                //     $pdf->SetFont('helvetica', 'B', 20);

                //     $pdf->Cell(0, 15, 'ITATS LANGUAGE CENTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                //     // ALAMAT
                //     $pdf->SetXY(65, 25);
                //     $pdf->SetFont('helvetica', '', 10);
                //     // Title
                //     $alamat = 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117';
                //     $pdf->MultiCell(100, 5, '' . $alamat, 0, 'C', 0, 0, '', '', true);
                //     // Set Line
                //     $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
                //     $pdf->Line(30, 40, 190, 40, $style);
                // });

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
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data mahasiswa tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
}
