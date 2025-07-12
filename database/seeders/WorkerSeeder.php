<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Worker::create([
            'first_name' => 'Test',
            'last_name' => 'Worker',
            'middle_name' => 'A',
            'pin' => '1234',
            'passport_number' => '123456789',
            'passport_expiry_date' => '2030-12-31',
            'username' => 'testworker',
            'password' => Hash::make('password'),
            'agency_id' => 1, // Assuming agency with ID 1 exists
        ]);
    }
}
