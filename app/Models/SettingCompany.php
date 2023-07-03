<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SettingCompany extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
