<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        $permissions = Module::with('profiles')->get();

        if(sizeof($permissions) > 0){
            foreach($permissions as $permission){
                
               Gate::define($permission->label, function(User $user) use ($permission){
                    
                    return  $user->hasPermission($permission);
                });
            }
        }
    }
}
