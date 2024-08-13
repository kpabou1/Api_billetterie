<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\BackgroundImage; // Assurez-vous d'importer le modèle
use Illuminate\Support\Facades\Storage;

class BackgroundImageController extends Controller
{
    //

    public function edit()
    {
        //dd("a");
        // Obtenez l'image d'arrière-plan actuelle
        $backgroundImage = BackgroundImage::first();

        return view('background_image.background_image', compact('backgroundImage'));
    }

   
    public function update(Request $request)
    {
        // Validation des deux images
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Récupère l'entrée actuelle ou crée-en une nouvelle
        $backgroundImage = BackgroundImage::firstOrCreate([], [
            'image_path_welcome' => 'assets_8/img/gallery/hero-bg.png', // Valeur par défaut si aucune image n'est définie
            'image_path_login' => null,
        ]);

        // Mise à jour de l'image d'arrière-plan
        if ($request->hasFile('background_image')) {
            // Stocke l'image téléchargée et obtient le chemin
            $background_image_path = $request->file('background_image')->store('background_images/welcome', 'public');

            // Supprime l'ancienne image si elle existe
            if ($backgroundImage->image_path_welcome && Storage::disk('public')->exists($backgroundImage->image_path_welcome)) {
                Storage::disk('public')->delete($backgroundImage->image_path_welcome);
            }

            // Met à jour le chemin de l'image d'arrière-plan dans la base de données
            $backgroundImage->image_path_welcome = $background_image_path;
        }

        // Mise à jour de l'image de l'utilisateur
        if ($request->hasFile('user_image')) {
            // Stocke l'image téléchargée et obtient le chemin
            $user_image_path = $request->file('user_image')->store('background_images/user', 'public');

            // Supprime l'ancienne image si elle existe
            if ($backgroundImage->image_path_login && Storage::disk('public')->exists($backgroundImage->image_path_login)) {
                Storage::disk('public')->delete($backgroundImage->image_path_login);
            }

            // Met à jour le chemin de l'image de l'utilisateur dans la base de données
            $backgroundImage->image_path_login = $user_image_path;
        }

        $backgroundImage->save();

        return redirect()->back()->with('success', 'Images mises à jour avec succès.');
    }
}
