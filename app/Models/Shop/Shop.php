<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class School
 * @package App\Models\Shop
 */
class Shop extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo('App\Models\Access\Owner\Owner');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Shop\Item');
    }
}
