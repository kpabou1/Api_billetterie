<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //$this->call(InsertionSeeder::class);
      $this->call(RolesPermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(SourcefinanceSeeder::class);

        //$this->call(NomenclatureSeeder::class);
       // $this->call(CategorieSeeder::class);
        //$this->call(ProfessionSeeder::class);
        //$this->call(TypeCarteSeeder::class);
        //$this->call(RegimeFiscalSeeder::class);
        //$this->call(FormeJuridiqueSeeder::class);
       // $this->call(ExerciceSeeder::class);
        //$this->call(StructureRattachementSeeder::class);
        //$this->call(ActivitePrincipaleSeeder::class);
        //$this->call(NationaliteSeeder::class);
      
       //$this->call(ExcelsSeeder::class);

    }
}
