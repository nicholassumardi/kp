<?php

namespace App\Exports;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CampuranExport implements FromView
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(int $id_kursus)
    {
        $this->id_kursus = $id_kursus;
    }


    public function view(): View
    {
        return view('admin.main.excel_admin.indexCampuran', [
            'kursus' => Course::where('id_kursus', $this->id_kursus)->first()
        ]);
    }
}
