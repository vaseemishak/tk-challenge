<?php

namespace App\Observers;

use App\Models\Device\Device;

class DeviceObserver
{
    /**
     * Handle the device "created" event.
     *
     * @param  \App\Models\Device\Device  $device
     * @return void
     */
    public function created(Device $device)
    {
        //
    }

    /**
     * Handle the device "updated" event.
     *
     * @param  \App\Models\Device\Device  $device
     * @return void
     */
    public function updated(Device $device)
    {
        //
    }

    /**
     * Handle the device "deleted" event.
     *
     * @param  \App\Models\Device\Device  $device
     * @return void
     */
    public function deleted(Device $device)
    {
        //
    }

    /**
     * Handle the device "restored" event.
     *
     * @param  \App\Models\Device\Device  $device
     * @return void
     */
    public function restored(Device $device)
    {
        //
    }

    /**
     * Handle the device "force deleted" event.
     *
     * @param  \App\Models\Device\Device  $device
     * @return void
     */
    public function forceDeleted(Device $device)
    {
        //
    }
}
