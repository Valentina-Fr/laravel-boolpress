<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $category_names = ['Html', 'Css', 'JS', 'Bootstrap', 'Vue', 'Laravel', 'PHP'];

        foreach ($category_names as $name) {
            $category = new Category();
            $category->name = $name;
            $category->color = $faker->hexColor();
            $category->save();
        }
    }
}
