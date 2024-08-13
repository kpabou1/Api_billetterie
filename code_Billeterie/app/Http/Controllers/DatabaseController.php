<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function done(Request $request)
    {
        // Lancer la sauvegarde
        Artisan::call('backup:run --only-db');

        // Attendre quelques secondes pour s'assurer que la sauvegarde est terminée
        sleep(5);

        // Trouver le fichier de sauvegarde le plus récent
        $files = Storage::disk('local')->files('laravel-backup');
        $latestFile = collect($files)->last();
        
        if ($latestFile) {
            // Télécharger le fichier de sauvegarde
            return Storage::disk('local')->download($latestFile);
        }

        return response()->json(['message' => 'No backup found'], 404);
    }
}
