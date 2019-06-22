<?php

namespace App\Models\Device;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string device_uuid
 * @property string language_code
 * @property string region_code
 * @property string platform
 * @property string notification_token
 * @property string notification_tags
 * @property string app_version
 * @property string access_token
 * @property boolean is_premium
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Device extends Model
{
    use SoftDeletes;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = "devices";

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = [
        'device_uuid', 'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version', 'access_token', 'is_premium'
    ];

    /**
     * Hidden Objects
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'notification_token', 'is_premium'
    ];

    /**
     * Table Date Columns
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Device Relation
     *
     * @return HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'device_id', 'id');
    }

    /**
     * @param $deviceToken
     * @return Device
     */
    public static function findByDeviceToken($deviceToken)
    {
        return self::where('device_uuid', $deviceToken)->first();
    }

    /**
     * @param $accessToken
     * @return Device
     */
    public static function findByAccessToken($accessToken)
    {
        return self::where('access_token', $accessToken)->first();
    }
}
