<?php

namespace App\Models\Device;

use App\Models\Song\Song;
use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Favorite
 * @package App\Models\Device
 *
 * @property integer id
 * @property integer device_id
 * @property integer song_id
 * @property Carbon deleted_at
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class Favorite extends Model
{
    use Cachable, SoftDeletes;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = "favorites";

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = [
        'device_id', 'song_id'
    ];

    /**
     * Table Date Columns
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Hidden Objects
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Cache Config
     *
     * @var bool
     */
    protected $isCachable = true;

    /**
     * Song Relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function song()
    {
        return $this->hasOne(Song::class, 'song_id', 'id');
    }

    /**
     * Device Relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function device()
    {
        return $this->hasOne(Device::class, 'device_id', 'id');
    }

    /**
     * Filter by Device ID and Song ID
     *
     * @param $query
     * @param $device_id
     * @param $song_id
     * @return Favorite
     */
    public function scopeFindByDeviceIdAndSongId($query, $device_id, $song_id)
    {
        return $query->where('device_id', $device_id)->where('song_id', $song_id);
    }
}
