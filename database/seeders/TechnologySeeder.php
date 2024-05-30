<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $technologies = ['html', 'css', 'bootstrap', 'js', 'vue', 'vite', 'laravel', 'npm', 'blade', 'php'];

        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->save();
        }

    }
}
