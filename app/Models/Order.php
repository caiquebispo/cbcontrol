<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected  $guarded = [];
    public function order_product(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public  function user(): HasOne
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public  function reason(): HasOne
    {
        return $this->hasOne('reason', 'id','reason_id');
    }
}
