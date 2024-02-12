<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Cashier\Billable;

class Company extends Model
{
    use HasFactory, Billable;

    protected $guarded = [];

    public function categories(): MorphMany
    {
        return $this->morphMany(Category::class, 'categories');
    }

    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'images');
    }

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

    public function settings(): HasOne
    {
        return $this->hasOne(SettingCompany::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function address(): MorphMany
    {

        return $this->morphMany(Address::class, 'address');
    }

    public function notifies(): HasMany
    {
        return $this->hasMany(Notify::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function controlAccessSalePage(): HasMany
    {
        return $this->hasMany(AccessSalesPage::class);
    }
}
