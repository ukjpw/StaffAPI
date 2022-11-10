<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Staff::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 10; $i++) {
            Staff::create([
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'first_name' => $faker->firstName,
                'last_name' => $faker->LastName,
                'status' => $faker->randomElement(['Active', 'Inactive']),
                'squad' => $faker->randomElement(['squad1', 'squad2', 'squad3', 'squad4', 'squad5', 'NA']),
                'start_date' => $faker->date('Y_m_d'),
                'notes' => $faker->paragraph
            ]);
        }
    }
}
