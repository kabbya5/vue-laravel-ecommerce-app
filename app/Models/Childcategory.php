<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Childcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subcategories(){
        return $this->belongsToMany(Subcategory::class,'childcategory_subcategory','childcategory_id');
    }

    public function setChildcatTitleAttribute($value){
        $this->attributes['childcat_title'] = $value;
        $this->slug = str_slug($value);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
