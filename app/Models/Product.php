<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function image(): MorphMany
    {
        
        return $this->morphMany(Image::class, 'images');
    }
    public function categories(): HasOne
    {
        return $this->hasOne(Category::class,'id', 'category_id');
    }
    public function company(): HasOne
    {
        return $this->hasOne(Company::class,'id', 'company_id');
    }
}
