<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 1000; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
