<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
      $categories =  CategoryResource::collection(Category::latest()->get());

      return response()->json($categories);
    }

    public function store(CategoryStoreRequest $request){
      return('heelo');
    }
}
