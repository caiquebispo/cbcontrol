<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function groups(): BelongsToMany
    {
       return $this->belongsToMany(Group::class, 'group_clients');
    }
    public function image(): MorphMany
    {
        
        return $this->morphMany(Image::class, 'images');
    }
    public function address(): MorphMany
    {
        
        return $this->morphMany(Address::class, 'address');
    }
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_clients');
    }
}
