<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    
    public function index($query){
        if($query == 'all'){
            $subcategories =  SubcategoryResource::collection(Subcategory::latest()->paginate(15));
            $count = [
                'total' => $subcategories->total(),
                'lastPage' => $subcategories->lastPage() 
            ];
        }else if($query == 'short'){
            $subcategories =  SubcategoryResource::collection(Subcategory::orderBy('subcategory_title')->paginate(15));
            $count = [
                'total' => $subcategories->total(),
                'lastPage' => $subcategories->lastPage() 
            ];
        }
        
        return response()->json([
            'subcategories' => $subcategories,
            'count' => $count,    
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'subcategory_title' => 'required|max:60|unique:subcategories,subcategory_title',
            'category_ids' => 'required',
        ]);

        $subcategory = Subcategory::create($request->except('category_ids'));
        $subcategory->categories()->attach($request->category_ids); 
    }

    public function update(Request $request,Subcategory $subcategory){
        $request->validate([
            'subcategory_title' => 'required|max:60|unique:subcategories,subcategory_title,'.$subcategory->id,
            'category_ids' => 'required',
        ]);

        $subcategory->update($request->only('subcategory_title'));
        $subcategory->categories()->sync($request->category_ids);
    }
}
