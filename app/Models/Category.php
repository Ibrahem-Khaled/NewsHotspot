<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function subcategory()
    {

        return $this->hasMany(SubCategory::class, "category_id");
    }
    public function livechannel()
    {

        return $this->hasMany(LiveChannels::class, "category_id");
    }
    public function source()
    {

        return $this->hasMany(source::class, "category_id");
    }
}
