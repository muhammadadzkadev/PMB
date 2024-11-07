<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            ['nama_poli' => 'Poli Anak'],
            ['nama_poli' => 'Poli KIA'],
            ['nama_poli' => 'Poli KB'],
            
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}