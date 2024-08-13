<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use HasApiTokens, HasFactory, Notifiable, HasRoles;
use App\Models\Vendeur;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        // Create 1 admin
        $user = User::create([
            'firstname' => 'dev_isidore',
            'lastname' => 'dev_isidore',
            'telephone' => '90101134',
            'sexe' => 'M',
            'datenaiss' => '1990-01-01',
            'email' => 'dev@isidore.com',
            'lieu_naissance' => 'Abidjan',
            'username' => 'dev_isidore',
            'password' => bcrypt('_123456789'),
            ]);
            $role = Role::create(['name' => 'Developpeur']);

            $permissions = Permission::pluck('id','id')->all();
           // dd($permissions);


            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);

            $user_id=$user->id;




            //create 1 vendeur
            //recupérion de l'id de l'utilisateur de l'user créé



    }


}
