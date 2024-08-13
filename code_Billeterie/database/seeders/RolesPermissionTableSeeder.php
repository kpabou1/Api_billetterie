<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Vendeur;
use App\Models\Acheteur;
use App\Models\Gerant;
use App\Models\Magasinier;
use HasApiTokens, HasFactory, Notifiable, HasRoles;

use App\Models\User;


class RolesPermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // ppms
            'ppm-list',
            'ppm-create',
            'ppm-edit',
            'ppm-delete',
            // suivi_marches
            'suivi_marches-list',
            'suivi_marches-create',
            'suivi_marches-edit',
            'suivi_marches-delete',
            // annee
            'annee-list',
            'annee-create',
            'annee-edit',
            'annee-delete',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roleAdmin = Role::create(['name' => 'Admin']);

        // Define permissions for each role
        $permissionsAdmin = [
            'ppm-list',
            'ppm-create',
            'ppm-edit',
            'ppm-delete',
            'suivi_marches-list',
            'suivi_marches-create',
            'suivi_marches-edit',
            'suivi_marches-delete',
            'annee-list',
            'annee-create',
            'annee-edit',
            'annee-delete',
        ];

        // Assign permissions to roles
        $roleAdmin->syncPermissions($permissionsAdmin);

        // Create admin user
        $userAdmin = User::create([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'telephone' => '901407134',
            'sexe' => 'M',
            'datenaiss' => '1990-01-01',
            'email' => 'admin@sirius.com',
            'lieu_naissance' => 'Abidjan',
            'username' => 'admin',
            'password' => bcrypt('_123456789'),
        ]);

        // Assign roles to users
        $userAdmin->assignRole($roleAdmin);
      
    }
}
