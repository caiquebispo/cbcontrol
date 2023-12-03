<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    use HasFactory;
    public $table = "user_login_histories";
    public $timestamps = false;
    protected $guarded = [];
}
