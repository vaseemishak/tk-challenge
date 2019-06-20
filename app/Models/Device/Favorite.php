<?php

namespace App\Models\Device;

use App\Models\Song\Song;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
