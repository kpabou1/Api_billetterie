<?php

namespace App\Exports;

use App\Models\Nationalite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NationalitesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Nationalite::select('code_numero','code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code_numero',
            'code',
            'libelle',
        ];
    }
}
