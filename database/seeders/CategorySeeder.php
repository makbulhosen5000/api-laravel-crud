<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Lomen',
            'slug'=>'lomen'

        ]);
        Category::create([
            'name'=>'Node',
            'slug'=>'node'
        ]);
        Category::create([
            'name'=>'Js',
            'slug'=>'js'
        ]);
    }
}
