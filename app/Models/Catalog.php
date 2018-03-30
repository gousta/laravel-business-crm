<?php

namespace App\Models;

use App\Models\Traits\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    use SoftDeletes;
    use Shop;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cat',
        'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    public function labor()
    {
        return $this->belongsTo('App\Models\Labor', 'id', 'catalog_id');
    }

    public function scopePopular($query)
    {
        $query->leftJoin('labor', 'catalog.id', '=', 'labor.catalog_id');
        $query->selectRaw('catalog.*, count(labor.catalog_id)');
        $query->groupBy('catalog.id');
        $query->orderBy('count', 'desc');
    }

    public function getNamePublicAttribute()
    {
        return ($this->cat === 'ΠΡΟΣΦΟΡΕΣ' ? 'ΠΡΟΣΦΟΡΑ: ' : '').$this->name;
    }
}
