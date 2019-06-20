<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'device_uuid', 'access_token', 'language_code', 'region_code', 'platform', 'notification_token', 'notification_tags', 'app_version', 'is_premium'
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
}
