<?php

namespace App\Http\Middleware;

use App\Models\Device\Device;
use Closure;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken())
        {
            $device = Device::findByAccessToken($request->bearerToken());

            if ($device && !is_null($device))
            {
                $request->attributes->add(["api.user" => $device]);
                config()->set('app.locale', $device->language);
                config()->set('translatable.locale', $device->language);
            } else {

                return response()->json([
                    'status' => 401,
                    'error'  => 'Unauthorized',
                    'data'   => null
                ], 401);
            }

        }

        return $next($request);
    }
}
