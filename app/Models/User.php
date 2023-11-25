<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use MBarlow\Megaphone\HasMegaphone;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasMegaphone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
        'password' => 'hashed',
    ];

    public function image(): MorphMany
    {

        return $this->morphMany(Image::class, 'images');
    }
    public function address(): MorphMany
    {

        return $this->morphMany(Address::class, 'address');
    }
    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'profile_users');
    }
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_users');
    }
    public function networks(): BelongsToMany
    {
        return $this->belongsToMany(Network::class, 'network_users');
    }
    public function groups(): BelongsToMany
    {
       return $this->belongsToMany(Group::class, 'group_users');
    }
    public function hasPermission($permission): bool
    {
        return $this->doesThisUserHaveThisProfile($permission->profiles);
    }
    public function doesThisUserHaveThisProfile($profiles): bool
    {
        if(is_array($profiles) || is_object($profiles)){
            return !!$profiles->intersect($this->profiles)->count();
        }
        return $this->profiles->contains('name', $profiles->name);
    }
    public function getMenu()
    {
       $menu = [];

       foreach($this->profiles as $profile){

            foreach($profile->permissions as $permission){

                if($permission->is_module){

                    $index_menu = array_search($permission->menu_name, array_column($menu, 'menu'));

                    if($index_menu === false){
                        array_push($menu,['menu' => $permission->menu_name, 'icon' => $permission->icon_class, 'sub_menu' => [Arr::only($permission->toArray(), ['name', 'url'])]]);
                    }else{
                        array_push($menu[$index_menu]['sub_menu'], Arr::only($permission->toArray(), ['name', 'url']));
                    }
                }
            }
       }
       return $menu;
    }
}   

