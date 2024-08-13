<?php

namespace App\Exports;

use App\Models\SuiviMarche;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class SuiviMarchesExport implements FromCollection, WithHeadings
{protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Numéro de Marché',
            'Ligne budgétaire',
            'Subvention',
            'Libellé Marchés',
            'Mode de Passation',
            'Trimestre de sortie des fonds',
            'Montant Prévisionnel',
            'Montant Attribution',
            'Différence',
            'Titulaire',
            'Adresse',
            'Date d’approbation',
            'Date ordre de service',
            'Délai d\'Exécution',
            'Date probable de réception',
            'État de Paiement',
            'Année'
        ];
    }
}
