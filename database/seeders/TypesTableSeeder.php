<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = [
            [
                'name' => 'Front-end',
                'description' => $faker->words(rand(30, 60), true),
            ],
            [
                'name' => 'Full-Stack',
                'description' => $faker->words(rand(30, 60), true),

            ],
            [
                'name' => 'Back-end',
                'description' => $faker->words(rand(30, 60), true),
            ], 
        ];

        foreach($types as $type){
            Type::create($type);
        }
    }
}
