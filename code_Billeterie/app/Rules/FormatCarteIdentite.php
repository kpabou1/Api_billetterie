<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;

class FormatCarteIdentite implements Rule
{
    public function passes($attribute, $value)
    {
        // Vérification si le type de carte est égal à 3
        if (request()->input('type_carte') === '3') {
            // Valider le format de l'identifiant de la carte
            return preg_match('/^\d{4}-\d{3}-\d{4}$/', $value) === 1;
        }
        
        // Si ce n'est pas un type de carte égal à 3, la validation réussit automatiquement
        return true;
    }

    public function message()
    {
        return 'Le format de l\'identifiant de la carte doit être : 4 chiffres - 3 chiffres - 4 chiffres.';
    }
}