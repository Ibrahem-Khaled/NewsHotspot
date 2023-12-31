<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class source extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, "subcategory_id");
    }
    public function mainsources()
    {
        return $this->belongsTo(mainSource::class, "main_sources_id");
    }
}
