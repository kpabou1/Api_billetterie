<?php

namespace App\Exports;

use App\Models\Profession;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfessionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Profession::select('code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code',
            'libelle',
        ];
    }
}
