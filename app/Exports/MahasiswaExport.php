<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MahasiswaExport implements FromView

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
        return view('admin.main.excel_admin.indexMahasiswa', [
            'kursus' => Course::where('id_kursus', $this->id_kursus)->first()
        ]);
    }
}

// public function headings():array{
//     return[
//         'Nama',
//         'NPM',
//         'No kartu Mahasiswa'

//     ];
// } 
// public function query()
// {
//     return Course::query()->where('id_kursus', $this->id_kursus)->first()->mahasiswa()->select(['nama', 'npm']);
// }