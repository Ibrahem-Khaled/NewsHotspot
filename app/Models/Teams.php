<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, "sub_category_id");
    }
    
}
