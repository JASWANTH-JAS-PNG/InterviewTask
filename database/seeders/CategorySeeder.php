<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Admit Card', 'slug' => 'admit-card'],
            ['name' => 'Result',     'slug' => 'result'],
            ['name' => 'Sarkari Job','slug' => 'sarkari-job'],
            ['name' => 'Syllabus',   'slug' => 'syllabus'],
            ['name' => 'Answer Key', 'slug' => 'answer-key'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
