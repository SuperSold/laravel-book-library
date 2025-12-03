<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookCate;

class BookCateSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Fiction',
            'Non-fiction',
            'Science',
            'History',
            'Children',
        ];

        foreach ($categories as $name) {
            BookCate::create(['name' => $name]);
        }
    }
}
