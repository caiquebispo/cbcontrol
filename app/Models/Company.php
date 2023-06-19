<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_users');
    }
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'company_clients');
    }
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
    public function notifies(): HasMany
    {
        return $this->hasMany(Notify::class);
    }
}
