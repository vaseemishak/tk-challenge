<?php

namespace App\Http\Controllers\Api;

use App\Models\Device\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'device_uuid', 'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version', 'is_premium'
        ]));

        event('api.request.device.store.after', $device, $request);

        return $this->response($device, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
