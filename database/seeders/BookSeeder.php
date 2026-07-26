<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'Laravel Basics',
            'author' => 'Taylor Otwell',
            'price' => 2500,
            'stock' => 10,
            'book_category_id' => 1,
        ]);

        Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'price' => 3500,
            'stock' => 8,
            'book_category_id' => 2,
        ]);

        Book::create([
            'title' => 'The Pragmatic Programmer',
            'author' => 'Andrew Hunt',
            'price' => 4200,
            'stock' => 5,
            'book_category_id' => 3,
        ]);
    }
}