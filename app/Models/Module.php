<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'module_profiles');
    }
}
