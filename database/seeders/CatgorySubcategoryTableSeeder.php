<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CatgorySubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i=0;$i<30;$i++){
            $category_subcategory = [
                'category_id' => Category::all()->random()->id,
                'subcategory_id' => Subcategory::all()->random()->id,
            ];
            DB::table('category_subcategory')->insert($category_subcategory);
        }
        
    }
}
