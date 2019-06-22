<?php

namespace App\Models\Song;

use App\Models\Device\Favorite;
use App\Models\Song\Translate\Song as Translate;
use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Song
 * @package App\Models\Song
 *
 * @property integer id
 * @property integer category_id
 * @property string thumbnail
 * @property Category category
 * @property Favorite favorites
 * @property string media
 * @property Translate translations
 * @property Carbon deleted_at
 * @property Carbon updated_at
 * @property Carbon created_at
 */
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
        'translations', 'deleted_at'
    ];

    /**
     * Append custom attributes
     *
     * @var array
     */
    protected $appends = [
        'has_favorite'
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
        return $this->hasMany(Favorite::class, 'song_id', 'id');
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

    /**
     * Filter by Category Scope
     *
     * @param $query
     * @param $category_id
     * @return mixed
     */
    public function scopeFilterByCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }

    /**
     * Media attribute add prefix url
     *
     * @param $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getMediaAttribute($value)
    {
        return url($value);
    }

    /**
     * Current device session song favorite status
     *
     * @return bool
     */
    public function getHasFavoriteAttribute()
    {
        return $this->favorites()
            ->findByDeviceIdAndSongId(request()->attributes->get('api.user')->id, $this->id)
            ->first() ? true : false;
    }
}
