<?php

namespace App\Imports;

use App\Models\Ppm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PpmImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    //nouvelle funtun model qui prend deux parametre $row et subvenvtion
    private $subvention;
    private $annee_id;

    public function __construct($subvention, $annee_id)
    {
        $this->subvention = $subvention;
        $this->annee_id = $annee_id;
    }

    public function model(array $row)
    {
        return new Ppm([
            'ligne_budgetaire' => $row['ligne_budgetaire'],
            'subvention' => $this->subvention,
            'mode_passation' => $row['mode_passation'],
            'trimestre_sortie_fonds' => $row['trimestre_sortie_fonds'],
            'montant_previsionnel' => $row['montant_previsionnel'],
            'libelle_marches' => $row['libelle_marches'],
            'id_annee' => $this->annee_id,
        ]);
    }

}
