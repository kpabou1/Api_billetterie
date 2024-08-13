<?php

namespace App\Exports;

use App\Models\RegimeFiscal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegimeFiscalsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RegimeFiscal::select('code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code',
            'libelle',
        ];
    }
}
