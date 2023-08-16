<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function setCategoryTitleAttribute($value){
        $this->attributes['category_title'] = $value;
        $this->slug = str_slug($value);
    }

    public function subcategories(){
        return $this->belongsToMany(Subcategory::class,'category_subcatgory','category_id','subcategory_id');
    }

    public function getRouteKeyName(){
        return "slug";
    }
}
