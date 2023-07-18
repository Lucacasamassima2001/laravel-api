<?php

namespace Database\Seeders;
use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++){
            $title = $faker->sentence();
            $slug = Project::slugger($title);
            // $slug = Project::slugger($title);
            $types = Type::all();
            // pluck scompatta l'array scelto per poter associare i valori
            $technologies = Technology::all()->pluck('id');
            $project = Project::create([
                'type_id' => $faker->randomElement($types)->id,
                'title' => Str::ucfirst($title),
                'slug'          => $slug,
                'url_image'=> $faker->imageUrl(640, 480, 'animals', true),
                // 'image' => $imageIndex ? 'uploads/picsum' .$imageIndex .'jpg' : null,
                'repo'=>  $faker->word(),
                'description'=> $faker->paragraph(),
            ]);

            // associare il projects ad un certo numero di tags
            $project->technologies()->sync($faker->randomElements($technologies, null));
        };
    }
}
