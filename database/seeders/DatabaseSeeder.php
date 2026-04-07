<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        Category::insert([
            ['name' => 'General', 'color' => '#6B7280'],
            ['name' => 'Programación', 'color' => '#2563EB'],
            ['name' => 'Otros', 'color' => '#10B981'],
        ]);
    }
}
