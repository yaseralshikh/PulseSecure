<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Governorate::insert([
            ['name' => 'وسط جازان'],
            ['name' => 'فرسان'],
            ['name' => 'أبو عريش'],
            ['name' => 'الدائر'],
            ['name' => 'العارضة'],
            ['name' => 'الريث'],
            ['name' => 'الطوال'],
            ['name' => 'صبيا'],
            ['name' => 'بيش'],
            ['name' => 'العيدابي'],
            ['name' => 'الحرث'],
            ['name' => 'صامطة'],
            ['name' => 'المجاردة'],
            ['name' => 'الداير بني مالك'],
        ]);
    }
}
