<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
