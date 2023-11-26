<?php

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Symfony\Component\HttpFoundation\Response;

class CanAccessRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next): Response
  {
    
      $permissions = Module::where('is_module', true)->get()->toArray();
      $has_permission = false;
     
      if (array_search('/' . $request->route()->uri(), array_column($permissions, 'url')) !== false) {
       
        foreach (auth()->user()->profiles as $profile) {

          $has_permission = $profile->permissions->contains('url', '/' . $request->route()->uri());
        }

        if ($has_permission) {
          return $next($request);
        }

        return redirect(auth()->user()->getMenu()[0]['sub_menu'][0]['url']);

      } else {

        return $next($request);
      }
  }
}
