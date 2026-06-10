<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = [
            ['user', 'test1@example.com', bcrypt('123'), 'user'],
            ['user', 'test2@example.com', bcrypt('123'), 'user'],
            ['staff', 'test3@example.com', bcrypt('123'), 'staff'],
            ['admin', 'test4@example.com', bcrypt('123'), 'admin'],
        ];

        foreach ($users as $user){
            User::factory()->create([
                'full_name' => $user[0],
                'email' => $user[1],
                'password' => $user[2],
                'role' => $user[3],
            ]);
        }

        // User::factory()->create([
        //     'full_name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('123'),
        //     'role' => 'admin',
        // ]);


        $this->call(CategorySeeder::class);
        $this->call(TicketSeeder::class);
    }
}
