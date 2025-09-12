<?php

namespace Database\Seeders;

use App\Models\Incident_type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incident_type::insert([
            ['name' => 'سرقة'], ['name' => 'اعتداء'], ['name' => 'تهريب'],
            ['name' => 'مخدرات'], ['name' => 'تخريب'],
        ]);
    }
}
