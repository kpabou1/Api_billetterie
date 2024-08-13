<?php

namespace App\Exports;

use App\Models\FormeJuridique;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormeJuridiquesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FormeJuridique::select('code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code',
            'libelle',
        ];
    }
}
