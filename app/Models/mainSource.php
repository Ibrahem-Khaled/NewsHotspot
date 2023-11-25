<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mainSource extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function source()
    {
        return $this->hasMany(source::class, "main_sources_id");
    }
}
