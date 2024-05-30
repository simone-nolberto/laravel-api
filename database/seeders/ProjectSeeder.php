<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();

            $project->author = $faker->name(4, true);
            $project->project_title = $faker->words(5, true);
            $project->slug = Str::of($project->project_title)->slug('-');
            $project->description = $faker->text(400);
            $project->cover_image = $faker->imageUrl(600, 300, 'Projects', true, $project->title, true, 'jpg');

            $project->save();
        }
    }
}
