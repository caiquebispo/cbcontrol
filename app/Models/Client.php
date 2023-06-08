<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function groups(): BelongsToMany
    {
       return $this->belongsToMany(Group::class, 'group_clients');
    }
}
