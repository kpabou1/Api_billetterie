<?php

// app/Imports/NationalitesImport.php

namespace App\Imports;

use App\Models\Nationalite;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NationalitesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        
        return new Nationalite([
            'code_numero' => $row['code_numero'],
            'code' => $row['code'],
            'libelle' => $row['libelle'],
        ]);
    }
}

