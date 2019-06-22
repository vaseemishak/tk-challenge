<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Device\Store;
use App\Http\Requests\Api\Device\Update;
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
     * @param Store $request
     * @return JsonResponse
     */
    public function store(Store $request)
    {
        event('api.request.device.store.before', $request);

        $device = Device::create($request->all([
            'device_uuid', 'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version'
        ]));

        event('api.request.device.store.after', $device, $request);

        return $this->response($device, 201, __('Device created.'));
    }

    /**
     * Devices New Access Token Generate Endpoint
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDeviceAccessToken(Request $request)
    {
        $device = Device::findByDeviceToken($request->get('device_token'));

        if (!$device)
        {
            return $this->response(null, 400, __('Device ID Not Found'));
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
     * @param Update $request
     * @return JsonResponse
     */
    public function update(Update $request)
    {
        $device = $request->attributes->get('api.user')->update(array_filter($request->all([
            'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version', 'is_premium'
        ])));

        if ($device)
        {
            // response status 204 no-content
            return $this->response(null, 204, __('Device Updated'));
        }

        return $this->response(null, 500, __('Device Not Updated'), null, [__('Device Not Updated.')]);
    }

}
