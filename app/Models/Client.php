<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birthday' => 'date',
        'password' => 'hashed',
    ];
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
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
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'client_id');
    }
}
