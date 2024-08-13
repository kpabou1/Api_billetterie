<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sqlFilePath = __DIR__ . '/insertion.sql'; // Spécifiez le chemin relatif par rapport au répertoire du sédeur
        $sql = file_get_contents($sqlFilePath);

        DB::unprepared($sql);

        $this->command->info('Script SQL exécuté avec succès.');
    }
}
