<?php

namespace App\Http\Controllers;

use App\Models\AbstrakUmum;
use App\Models\CourseDetailUmum;
use App\Models\IjazahUmum;
use App\Models\JurnalUmum;
use App\Models\TranskripNilaiUmum;
use Illuminate\Http\Request;
use PDF;

class PdfUmumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['makePDF']);
    }

    public function index()
    {
        return view('admin.main.pdf_admin.dashboard.index');
    }

    public function makePDF($id_kursus, $id_umum_satu, $id_umum_dua = null)
    {   
       
        // Jika print 2 umum.
        if ($id_umum_dua !== null) {
            $this->dataView['product'] = CourseDetailUmum::whereIn('umum_id', [$id_umum_satu, $id_umum_dua])
                ->where('kursus_id', $id_kursus)
                ->get();

            // Jika data 2 umum ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.dashboard.index', $this->dataView);
                $html_content = $view->render();


                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 umum.
        else {
            $this->dataView['product'] = CourseDetailUmum::where('umum_id', $id_umum_satu)
                ->where('kursus_id', $id_kursus)
                ->get();

            // Jika data umum ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.dashboard.index', $this->dataView);
                $html_content = $view->render();

             
                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 80, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF2($id_abstrak_umum, $id_umum_satu, $id_umum_dua = null)
    {
        // Jika print 2 umum.
        if ($id_umum_dua !== null) {
            $this->dataView['product'] = AbstrakUmum::whereIn('umum_id', [$id_umum_satu, $id_umum_dua])
                ->where('id_abstrak_umum', $id_abstrak_umum)
                ->get();

            // Jika data 2 umum ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.abstract.index', $this->dataView);
                $html_content = $view->render();

                

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 umum.
        else {
            $this->dataView['product'] = AbstrakUmum::where('umum_id', $id_umum_satu)
                ->where('id_abstrak_umum', $id_abstrak_umum)
                ->get();

            // Jika data umum ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.abstract.index', $this->dataView);
                $html_content = $view->render();

               

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 80, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF3($id_transkrip_nilai, $id_umum_satu, $id_umum_dua = null)
    {
        // Jika print 2 umum.
        if ($id_umum_dua !== null) {
            $this->dataView['product'] = TranskripNilaiUmum::whereIn('umum_id', [$id_umum_satu, $id_umum_dua])
                ->where('id_transkrip_nilai_umum', $id_transkrip_nilai)
                ->get();

            // Jika data 2 umum ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.transkrip.index', $this->dataView);
                $html_content = $view->render();

               

     
                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 umum.
        else {
            $this->dataView['product'] = TranskripNilaiUmum::where('umum_id', $id_umum_satu)
                ->where('id_transkrip_nilai_umum', $id_transkrip_nilai)
                ->get();

            // Jika data umum ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.transkrip.index', $this->dataView);
                $html_content = $view->render();

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 80, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
    public function makePDF4($id_ijazah, $id_umum_satu, $id_umum_dua = null)
    {
        // Jika print 2 umum.
        if ($id_umum_dua !== null) {
            $this->dataView['product'] = IjazahUmum::whereIn('umum_id', [$id_umum_satu, $id_umum_dua])
                ->where('id_ijazah_umum', $id_ijazah)
                ->get();

            // Jika data 2 umum ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.ijazah.index', $this->dataView);
                $html_content = $view->render();
         

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 umum.
        else {
            $this->dataView['product'] = IjazahUmum::where('umum_id', $id_umum_satu)
                ->where('id_ijazah_umum', $id_ijazah)
                ->get();

            // Jika data umum ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.ijazah.index', $this->dataView);
                $html_content = $view->render();

        
                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 80, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }

    public function makePDF5($id_jurnal, $id_umum_satu, $id_umum_dua = null)
    {
        // Jika print 2 umum.
        if ($id_umum_dua !== null) {
            $this->dataView['product'] = JurnalUmum::whereIn('umum_id', [$id_umum_satu, $id_umum_dua])
                ->where('id_jurnal_umum', $id_jurnal)
                ->get();

            // Jika data 2 umum ditemukan.
            if ($this->dataView['product']->count() === 2) {
                $view = \View::make('admin.main.pdf_admin.journal.index', $this->dataView);
                $html_content = $view->render();

                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 50, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(True, 0);
                PDF::writeHTMLCell(0, 0, 17, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika salah satu atau kedua data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
        // Jika print hanya 1 umum.
        else {
            $this->dataView['product'] = JurnalUmum::where('umum_id', $id_umum_satu)
                ->where('id_jurnal_umum', $id_jurnal)
                ->get();

            // Jika data umum ditemukan.
            if ($this->dataView['product']->count() === 1) {
                $view = \View::make('admin.main.pdf_admin.journal.index', $this->dataView);
                $html_content = $view->render();
        
                PDF::SetTitle('ITATS LANGUAGE CENTER');
                PDF::SetMargins(7, 80, 7);
                $GETY = PDF::GetY();
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::writeHTMLCell(0, 300, 20, $GETY, $html_content, 0, 0, 0, true, 'C', true);

                PDF::Output('SamplePDF.pdf');
            }
            // Jika data umum tidak ditemukan.
            else {
                return abort(404);
            }
        }
    }
}
