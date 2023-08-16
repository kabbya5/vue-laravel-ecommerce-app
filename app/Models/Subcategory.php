<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function setSubcategoryTitleAttribute($value){
        $this->attributes['subcategory_title'] = $value;
        $this->slug = str_slug($value);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
