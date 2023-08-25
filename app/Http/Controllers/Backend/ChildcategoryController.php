<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildCategoryRequest;
use App\Http\Resources\ChildCategoryResource;
use App\Models\Childcategory;
use Illuminate\Http\Request;

class ChildcategoryController extends Controller
{
    public function index(Request $request){
        $show_items = $request->input('showItems');
        $query = $request->input('query');

        if($query == 'index'){
            $childcategories = ChildCategoryResource::collection(Childcategory::latest()->paginate($show_items));
        }else if($query == 'asc'){
            $childcategories = ChildCategoryResource::collection(Childcategory::OrderBy('childcat_title')->paginate($show_items));
        }else if($query == 'trash'){
            $childcategories = ChildCategoryResource::collection(Childcategory::onlyTrashed()->paginate($show_items));
        }else{
            $childcategories = ChildCategoryResource::collection(
                Childcategory::where('childcat_title', 'like' , '%'. $query . '%'  )->paginate($show_items)
            );
        }

        $count = [
            'total' => $childcategories->total(),
            'lastPage' => $childcategories->lastPage() 
        ];

        return response()->json([
           'childcategories' => $childcategories,
            'count' => $count,
        ]);
    }

    public function store(ChildCategoryRequest $request){
        $childcategory = Childcategory::create($request->only('childcat_title'));
        $childcategory->subcategories()->attach($request->subcategory_ids);

    }

    public function update(ChildCategoryRequest $request,Childcategory $childcategory){
        $childcategory->update($request->only('childcat_title'));
        $childcategory->subcategories()->sync($request->subcategory_ids);
    }

    public function delete(Childcategory $childcategory){
        $childcategory->delete();
    }
}
