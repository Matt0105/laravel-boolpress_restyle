<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Model\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $newCategory = new Category();
        $newCategory->name = "Generic";
        $newCategory->slug = Str::slug($newCategory->name, '-');
        $newCategory->save();


        for ($i=0; $i < 10; $i++) { 
            $newCategory = new Category();
            $newCategory->name = $faker->words(2, true);
            $newCategory->slug = Str::slug($newCategory->name . '-' . $i, '-');

            $newCategory->save();
        }
    }
}
