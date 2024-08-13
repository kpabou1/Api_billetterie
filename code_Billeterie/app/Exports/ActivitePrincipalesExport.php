<?php

namespace App\Exports;

use App\Models\ActivitePrincipale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivitePrincipalesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ActivitePrincipale::select('code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code',
            'libelle',
        ];
    }
}
