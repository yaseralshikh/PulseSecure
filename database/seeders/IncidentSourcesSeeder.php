<?php

namespace Database\Seeders;

use App\Models\Incident_source;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidentSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incident_source::insert([
            ['name' => 'تقرير'], ['name' => 'بلاغ'], ['name' => 'شكوى'],
        ]);
    }
}
