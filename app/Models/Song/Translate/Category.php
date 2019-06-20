<?php

namespace App\Models\Song\Translate;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Cachable;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'category_translations';

    /**
     * Table Columns
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Timestamp Config
     *
     * @var bool
     */
    public $timestamps = false;
}
