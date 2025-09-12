<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Arrest;
use App\Models\Incident;
use App\Models\Productivity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            EntitiesSeeder::class,
            GovernoratesSeeder::class,
            IncidentTypesSeeder::class,
            IncidentSourcesSeeder::class,
            LaratrustSeeder::class,
        ]);

        Incident::factory()->count(100)->create();
        Arrest::factory()->count(50)->create();
        Productivity::factory()->count(60)->create();
        
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
