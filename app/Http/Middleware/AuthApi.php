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
                config()->set('app.locale', $device->language_code);
                config()->set('translatable.locale', $device->language_code);
            } else {
                return $this->unauthorized();
            }

        } else {
            return $this->unauthorized();
        }

        return $next($request);
    }

    public function unauthorized()
    {
        return response()->json([
            'message' => "Unauthorized",
            'status'  => 401,
            'data'    => null,
            'errors'  => [
                'Authorization: Bearer is required'
            ],
        ], 401, []);
    }
}
