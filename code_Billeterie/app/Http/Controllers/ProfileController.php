<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
      //  dd($request->user());
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user=$request->user();
      // dd($user);
       if ($user->avatar) {
        Storage::delete($user->avatar);
        }
        if ($request->hasFile('profile_picture')) {
            $avatarPath = $request->file('profile_picture')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
      //  $user->save();

       
        $firstname=$request->firstname;
        $lastname=$request->lastname;

        $lastname=$request->lastname;
        $country_code=$request->country_code;
        $phone_number = $request->phone_number;
        $cleaned_phone_number = str_replace(' ', '', $phone_number);
        $numeric_phone_number = intval($cleaned_phone_number);
        //convertion de phone_number en type nombre
       // dd($numeric_phone_number);
      //  $user=$request->user();
        //dd($user);
        $user->lastname = $lastname;
        $user->firstname = $firstname;
        $user->indicatiftel = $country_code;
        $user->telephone = $numeric_phone_number;
        $user->save();
        //modification des données de user
        

     //  dd($request->user());

        $request->user()->fill($request->validated());
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        //modification du mot de passe aussi 
        /*
        // dd($request->all());
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
        
        */
        if ($request->password) {
            //on vérifie si les mots de passe concode d'abor 
            if (!Hash::check($request->current_password, $request->user()->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe fourni ne correspond pas à votre mot de passe actuel.']);
            }
            //on vérifie si le nouveau mot de passe et le mots de passe de confrimation sont identique 
            if ($request->password !== $request->password_confirmation) {
                return back()->withErrors(['password' => 'Les mots de passe ne correspondent pas.']);
            }
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);       
         }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
