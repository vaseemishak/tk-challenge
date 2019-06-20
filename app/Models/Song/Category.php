<?php

namespace App\Models\Song;

use App\Models\Song\Translate\Category as Translate;
use Dimsav\Translatable\Translatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Cachable, SoftDeletes, Translatable;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = "categories";

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail'
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
     * Category Relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany(Song::class, 'category_id', 'id');
    }
}
