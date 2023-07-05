<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title' => 'Praia',
            'image_path' => '/assets/posts/beach.jpg',
            'author' => 'Lascabim',
            'longitude' => -8.5294,
            'latitude' => 41.1452,
            'date' => '2023-06-30',
            'expire' => '2024-07-07 14:44:11',
            'url' => 'R5uzDoo99QCkh3F0',
        ]);

        DB::table('posts')->insert([
            'title' => 'Campo',
            'image_path' => '/assets/posts/farm.jpg',
            'author' => 'Lascabim',
            'longitude' => -8.5294,
            'latitude' => 41.1452,
            'date' => '2023-06-30',
            'expire' => '2024-07-07 14:44:11',
            'url' => 'R5uzDoo99QCkh3F0',
        ]);

        DB::table('posts')->insert([
            'title' => 'Campo',
            'image_path' => '/assets/posts/farm.jpg',
            'author' => 'Lascabim',
            'longitude' => -821.5294,
            'latitude' => 451.1452,
            'date' => '2023-06-30',
            'expire' => '2024-07-07 14:44:11',
            'url' => 'R5uzDoo99QCkh3F0',
        ]);
    }
}
