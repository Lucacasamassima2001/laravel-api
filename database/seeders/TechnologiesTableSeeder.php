<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'php',
            ],
            [
                'name' => 'js',
            ],
            [
                'name' => 'laravel',
            ],
            [
                'name' => 'java',
            ],
            [
                'name' => 'c++',
            ],
            [
                'name' => 'Python',
            ],
            [
                'name' => 'Nodejs',
            ],
        ];

        
        foreach($technologies as $technology){
            Technology::create($technology);
        }
    }
}
