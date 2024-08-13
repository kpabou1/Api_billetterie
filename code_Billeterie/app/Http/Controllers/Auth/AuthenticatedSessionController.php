<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $username=$request->username;
        //recherche de l'utilisateur dans la table user

        //$user_tout = User::where('username', $username)->first();
        $user_tout = User::where('username', $username)->first();

        //$user_tout= User::findOrFail($username);
       
        if($user_tout){
           // dd($user_tout);
        }

        //dd($username);
        //ajout du username dans la session
        //recupération du firstname et du lastname
       // $user = Auth::user();
       // dd($user);
       // $first_name=$user->first_name;
       // $last_name=$user->last_name;
        //ajout du firstname et du lastname dans la session
        //$request->session()->put('first_name', $first_name);
       // $request->session()->put('last_name', $last_name);

        $request->authenticate();

        $request->session()->regenerate();
        //envoie vers le home avec le username

        //return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended(RouteServiceProvider::HOME)->with('username', $username);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
