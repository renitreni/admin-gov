<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use App\Models\Worker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Ensure at least one agency exists for the WorkerSeeder
        if (! Agency::where('agency_name', 'Test Agency')->exists()) {
            Agency::factory()->create([
                'agency_name' => 'Test Agency',
                'email' => 'agency@example.com',
                'phone' => '123-456-7890',
                'address' => '123 Test St',
            ]);
        }

        $this->call(WorkerSeeder::class);

        if (app()->environment('local')) {
            Agency::factory(10)->has(Worker::factory(100))->create();
        }
    }
}
