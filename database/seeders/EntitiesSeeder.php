<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entitie;

class EntitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entitie::insert([
            ['name' => 'الشرطة'],
            ['name' => 'سلاح الحدود'],
            ['name' => 'الأفواج'],
            ['name' => 'المجاهدين'],
        ]);
    }
}
