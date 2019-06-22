<?php

namespace App\Http\Controllers\Api;

use App\Models\Device\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    /**
     * DeviceController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth.api'], ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        event('api.request.device.store.before', $request);

        $device = Device::findByDeviceToken($request->get('device_uuid'));

        if ($device)
        {
            return $this->response(null, 409,'Device ID Already has registered');
        }

        $device = Device::create($request->all([
            'device_uuid', 'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version'
        ]));

        event('api.request.device.store.after', $device, $request);

        return $this->response($device, 201);
    }

    /**
     * Devices New Access Token Generate Endpoint
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAccessToken(Request $request)
    {
        $device = Device::findByDeviceToken($request->get('device_token'));

        if (!$device)
        {
            return $this->response(null, 400, 'Device ID Not Found');
        }

        $device->update(["access_token" => Str::random(32)]);

        return $this->response($device->only('access_token'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        return $this->response($request->attributes->get('api.user'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $device = $request->attributes->get('api.user')->update(array_filter($request->all([
            'language', 'notification_token', 'is_premium', 'region_code',
        ])));

        if ($device)
        {
            return $this->response(null, 204);
        }

        return $this->response(null, 500, 'Device Not Updated');
    }

}
