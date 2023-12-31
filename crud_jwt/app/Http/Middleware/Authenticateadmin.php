<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticateadmin extends Middleware
{
    protected function authenticate($request, array $guards){
        if($this->auth->guard('admin-api')->check()){
            return $this->auth->shouldUse('admin-api');
        }
        $this->unauthenticated($request,['admin-api']);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('adminLog');
    }
}
