<?php

namespace App\Exports;

use App\Models\StructureRattachement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StructureRattachementsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StructureRattachement::select('code', 'libelle')->get();
    }

    public function headings(): array
    {
        return [
            'code',
            'libelle',
        ];
    }
}
