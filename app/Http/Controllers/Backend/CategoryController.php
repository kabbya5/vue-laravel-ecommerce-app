<?php

namespace App\Http\Controllers\Backend;

use App\Classes\ImageStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function index(){
      $categories =  CategoryResource::collection(Category::latest()->get());

      return response()->json($categories);
    }

    public function store(CategoryStoreRequest $request){
      if($request->category_img){
        $img = new ImageStore($request->category_img,'category',150,100);
      }
      $data = $request->except('category_img');
      $data['category_img'] = $img->getImagePath();

      Category::create($data);
    }

    public function update(Category $category,CategoryStoreRequest $request){
      $data = $request->only('category_title','category_position',);
      if($request->category_img){
        $img = new ImageStore($request->category_img,'category',150,100);
        $this->unlikImage($request->category_old_img);
        $data['category_img'] = $img->getImagePath();
      }
      $category->update($data);
    }

    public function destory(Category $category){
      $category->delete();
    }

    public function trashCategory(){
      $categories = CategoryResource::collection(Category::onlyTrashed()->get());
      return response()->json($categories);
    }

    public function restoreCategory($slug){
      Category::withTrashed()->where('slug',$slug)->restore();
    }

    public function forchDelete($slug){
      Category::where('slug',$slug)->forceDelete();
    }

    private function unlikImage($img){
      $storage_path = 'app/public/image/category/';
      $img = substr($img,strrpos($img,'/')+1);
      if(file_exists(storage_path($storage_path.$img))){
        unlink(storage_path($storage_path.$img));
      }
    }
}
