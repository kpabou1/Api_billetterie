<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use App\Models\Vendeur;
use App\Models\Magasinier;
use App\Models\Gerant;
use App\Models\Acheteur;



class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();

                $data->whereBetween('created_at', [$fromDate, $toDate]);
            }

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    // Ajoutez toutes les colonnes ou actions supplémentaires ici
                    return '<button class="btn btn-sm btn-info">Détails</button>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'Developpeur')->pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'unique' => 'Le champ :attribute existe déjà.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'min' => 'Le champ :attribute doit contenir au moins :min caractères.',
            'image' => 'Le champ :attribute doit être une image.',
            'mimes' => 'Le champ :attribute doit être une image de type : :values.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
            'roles.required' => 'Vous devez sélectionner au moins un rôle.',

        ];
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'telephone' => 'required|numeric|unique:users,telephone',
            'lieu_naissance' => 'required|string',
            'sexe' => 'required|string',
            'datenaiss' => 'required|date',
            'email' => 'nullable|email|unique:users,email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'roles' => 'required',
        ], $message);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = null;
        }

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'telephone' => $request->input('telephone'),
            'indicatiftel' => $request->input('country_code'),
            'sexe' => $request->input('sexe'),
            'datenaiss' => $request->input('datenaiss'),
            'email' => $request->input('email'),
            'avatar' => $avatarPath,
            'lieu_naissance' => $request->input('lieu_naissance'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->assignRole($request->input('roles'));
        $roles=$request->input('roles');
        //dd($roles[0]);

        //si le role est vendeur créer dans la table vendeur




        if($roles[0] == 'Gerant'){

        }
        if($roles[0] == 'Admin'){

        }

        Session::flash('success', 'Utilisateur ajouté avec succès.');
        return view('users.index');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'unique' => 'Le champ :attribute existe déjà.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'min' => 'Le champ :attribute doit contenir au moins :min caractères.',
            'image' => 'Le champ :attribute doit être une image.',
            'mimes' => 'Le champ :attribute doit être une image de type : :values.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
        ];
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'telephone' => 'required|string',
            'sexe' => 'required|string',
            'lieu_naissance' => 'required|string',
            'datenaiss' => 'required|date',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => ['required', 'string', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:8',
        ], $message);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'telephone' => $request->input('telephone'),
            'sexe' => $request->input('sexe'),
            'datenaiss' => $request->input('datenaiss'),
            'lieu_naissance' => $request->input('lieu_naissance'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password,
        ]);
        $user->assignRole($request->input('roles'));

        Session::flash('success', 'Utilisateur mis à jour avec succès.');
        return view('users.index');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
