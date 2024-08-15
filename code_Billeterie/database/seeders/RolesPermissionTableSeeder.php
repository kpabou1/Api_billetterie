<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use HasApiTokens, HasFactory, Notifiable, HasRoles;

use App\Models\User;


class RolesPermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // eventss
            'events-list',
            'events-create',
            'events-edit',
            'events-delete',
            // commandes
            'commandes-list',
            'commandes-create',
            'commandes-edit',
            'commandes-delete',
          
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roleAdmin = Role::create(['name' => 'Admin']);

      
        // Define permissions for each role
        $permissionsAdmin = [
            'events-list',
            'events-create',
            'events-edit',
            'events-delete',
            'commandes-list',
            'commandes-create',
            'commandes-edit',
            'commandes-delete',
            
        ];

        // Assign permissions to roles
        $roleAdmin->syncPermissions($permissionsAdmin);

        $roleUserClient= Role::create(['name' => 'UserClient']);
        //    // Define permissions for each role
        $permissionsUserClient = [
            'events-list',
            'events-create',
            'events-edit',
            'events-delete',
            'commandes-list',
            'commandes-create',
            'commandes-edit',
            'commandes-delete',
            
        ];
        // Assign permissions to roles
        $roleUserClient->syncPermissions($permissionsUserClient);



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
