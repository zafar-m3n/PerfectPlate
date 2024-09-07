<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
            'name' => 'Vegetarian',
            'slug' =>'vegetarian',
            'status' => 1,
            'show_at_home'=>1
            ],

            [
                'name' => 'NonVegetarian',
                'slug' =>'nonvegetarian',
                'status' => 1,
                'show_at_home'=>1
                ]
                ]);
    }
}
