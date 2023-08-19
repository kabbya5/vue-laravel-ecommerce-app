<?php

namespace Database\Seeders;

use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ChildcategorySubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            $childcategory_subcategory = [
                'subcategory_id' => Subcategory::all()->random()->id,
                'childcategory_id' => Childcategory::all()->random()->id,
            ];
            DB::table('childcategory_subcategory')->insert($childcategory_subcategory);
        }
    }
}
