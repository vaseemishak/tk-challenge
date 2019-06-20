<?php

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
        factory(App\Models\Song\Category::class, 10)->create()->each(function ($category) {
            for ($i = 0; $i < 15; $i++)
            {
                $category->songs()->save(factory(App\Models\Song\Song::class)->make());
            }
        });
    }
}
