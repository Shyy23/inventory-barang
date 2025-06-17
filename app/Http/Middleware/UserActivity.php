<?php

use Closure;
use App\Traits\Loggable;

class logUserActivity
{
    use Loggable;

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Auth::check()) {
            $this->logUserActivity(
                $request->route()->getActionName(),
                'info',
                null,
                null,
                null,
                null
            );
        }
    }
}