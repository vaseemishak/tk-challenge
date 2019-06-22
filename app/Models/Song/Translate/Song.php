<?php

namespace App\Models\Song\Translate;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use Cachable;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'song_translations';

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Hidden Objects
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Timestamp Config
     *
     * @var bool
     */
    public $timestamps = false;
}
