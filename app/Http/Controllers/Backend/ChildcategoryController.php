<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildCategoryResource;
use App\Models\Childcategory;
use Illuminate\Http\Request;

class ChildcategoryController extends Controller
{
    public function index(Request $request){
        if($request->input('query') == 'all'){
            $childcategories = ChildCategoryResource::collection(Childcategory::latest()->paginate(15));
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
}
