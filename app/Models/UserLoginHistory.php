<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserLoginHistory extends Model
{
    use HasFactory;
    public $table = "user_login_histories";
    public $timestamps = false;
    protected $guarded = [];

    public function history_navigation(): HasMany
    {
        return $this->hasMany(UserNavigationHistory::class, 'user_login_history_id');
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class,'id', 'user_id');
    }
}
