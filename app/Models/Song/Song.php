<?php

namespace App\Models\Song;

use App\Models\Device\Favorite;
use App\Models\Song\Translate\Song as Translate;
use Dimsav\Translatable\Translatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use Cachable, SoftDeletes, Translatable;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = "songs";

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'thumbnail', 'media'
    ];

    /**
     * Hidden Objects
     *
     * @var array
     */
    protected $hidden = [
        'translations'
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
     * Translate Columns
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Translate Model
     *
     * @var string
     */
    public $translationModel = Translate::class;

    /**
     * Favorite Relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'id', 'song_id');
    }

    /**
     * Category Relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'category_id', 'id');
    }
}
