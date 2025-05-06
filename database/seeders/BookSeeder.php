<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(3)->create();
        Book::factory(20)->hasAttached($tags)->create();

        $authors = Author::factory(5)->create();
        Book::factory(20)->hasAttached($authors)->create();
    }

}
