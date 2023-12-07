<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        $user = [
            [
                'name' => 'AdminBrosys',
                'email' => 'brosys@gmail.com',
                'password' => bcrypt('Brosys12345678'),
                'level' => '1',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
