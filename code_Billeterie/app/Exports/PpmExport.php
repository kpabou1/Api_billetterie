<?php

namespace App\Exports;

use App\Models\Ppm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PpmExport implements FromCollection, WithHeadings
{

    protected $subvention;
    protected $annee_id;
    protected $libelle_annee;

    public function __construct($subvention, $annee_id, $libelle_annee)
    {
        $this->subvention = $subvention;
        $this->annee_id = $annee_id;
        $this->libelle_annee = $libelle_annee;
    }

    public function collection()
    {
        return Ppm::select(
            'ligne_budgetaire',
            'libelle_marches',
            'mode_passation',
            'trimestre_sortie_fonds',
            'subvention',
            'montant_previsionnel',
            'libelle_marches'
        )
        ->when($this->subvention, function ($query) {
            return $query->where('subvention', $this->subvention);
        })
        ->when($this->annee_id, function ($query) {
            return $query->where('id_annee', $this->annee_id);
        })
        ->get()
        ->map(function($item) {
            $item->libelle_annee = $this->libelle_annee;
            return $item;
        });
    }

    public function headings(): array
    {
        return [
            'ligne_budgetaire',
            'libelle_marches',
            'mode_passation',
            'subvention',
            'montant_previsionnel',
            'trimestre_sortie_fonds',
            'libelle_marches',
            'libelle_annee',
        ];
    }
}
