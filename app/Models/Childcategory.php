<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    use HasFactory;

    protected $guard = [];

    public function subcategories(){
        return $this->belongsToMany(Subcategory::class,'childcategory_subcategory','childcategory_id');
    }
}
