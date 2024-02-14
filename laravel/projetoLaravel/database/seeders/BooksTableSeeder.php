<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'A Volta ao Mundo em 80 Dias',
                'author' => 'Júlio Verne',
                'release_date' => '1873-01-30',
                'genre' => 'Fiction',
                'pages' => 234,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Orgulho e Preconceito',
                'author' => 'Jane Austen',
                'release_date' => '1813-01-28',
                'genre' => 'Romance',
                'pages' => 432,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'O Nome da Rosa',
                'author' => 'Umberto Eco',
                'release_date' => '1980-11-10',
                'genre' => 'Mystery',
                'pages' => 512,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'release_date' => '1949-06-08',
                'genre' => 'Fiction',
                'pages' => 328,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Hamlet',
                'author' => 'William Shakespeare',
                'release_date' => '1603-01-01',
                'genre' => 'Drama',
                'pages' => 160,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
