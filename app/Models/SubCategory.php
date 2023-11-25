<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }


    public function teams()
    {
        return $this->hasMany(Teams::class, "sub_category_id");
    }
    public function source()
    {
        return $this->hasMany(source::class, "subcategory_id");
    }
}
