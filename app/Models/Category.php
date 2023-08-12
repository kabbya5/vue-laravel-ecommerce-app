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

    public function getRouteKeyName(){
        return "slug";
    }
}
